<?php
    class ProductDB{
        /**
         * Lấy thông tin sản phẩm từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getProductsByKey($KeyGet = array('Hide' => '0', 'Active' => '1'), $OrderBy = 'ProductID'){
            $db = Database::getDB();
            
            //LIMIT
            $Limit  = '';
            if (isset($KeyGet['Limit'])){
                $Limit  = 'LIMIT ' . $KeyGet['Limit']['Position'] . ', ' . $KeyGet['Limit']['Number'];
                $KeyGet['Limit']    = null;
                array_pop($KeyGet);
            }
            
            //BETWEEN
            $Between    = '';
            if (isset($KeyGet['Between'])){
                $Between  = $KeyGet['Between']['Key'] . ' BETWEEN ' . $KeyGet['Between']['Min'] . ' AND ' . $KeyGet['Between']['Max'];
                $KeyGet['$Between']    = null;
                array_pop($KeyGet);
            }
            
            //WHERE
            $Where = '';
            if (!isset($KeyGet['Hide']) && !isset($KeyGet['Active'])){
                $KeyGet = array_merge($KeyGet, array('Hide' => '0', 'Active' => '1'));
            }            
            foreach ($KeyGet as $Colunm => $Value){
                $Where .= ' AND `products`.`' . $Colunm . '`=\'' . $Value . '\'';
            }
            $Where = substr($Where, 5);   //Loại bỏ ' AND ' đầu tiên.
            
            //Nối điều kiện BETWEEN vào mệnh đề WHERE (nếu có).
            if (!checkEmpty($Between)){
                $Where .= ' AND ' . $Between;
            }

            $sql = 'SELECT`categories`.`CategoryID`, `categories`.`Name` as \'CategoryName\', `ProductID`, `products`.`Name` as \'ProductName\',
                        `products`.`Time`, `Unit`, `Price`, `Description`, `Color`, `Quantity`, `LinkImage`, `products`.`Active`, `products`.`Keyword`,
                        `products`.`Hide`, `products`.`Active`, `products`.`Home`, `products`.`UpdatedBy`, `products`.`LastTime` 
                    FROM `products` JOIN `categories`
                    ON `products`.`CategoryID` = `categories`.`CategoryID`
                    WHERE ' . $Where . '
                    ORDER BY  `products`.`' . $OrderBy . '` ' . $Limit;
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            return Database::loadAllRows($stmt);
        }
        public static function getMostSellingProducts()
        {
            $db=Database::getDB();
            $querry="select products.Name, products.Price, products.ProductID, products.LinkImage from detailofbill 
                    inner join products on products.ProductID=detailofbill.ProductID
                    inner join categories on products.CategoryID=categories.CategoryID
                    GROUP BY detailofbill.ProductID
                    HAVING COUNT(detailofbill.BillID)>0
                    LIMIT 50";
            Database::setQuery($querry);
            $stmt   = Database::execute();

            $divideArray = array_chunk(Database::loadAllRows($stmt), 3);

            return $divideArray;
        }
        /**
         * Lấy thông tin sản phẩm hiển thị trên trang chủ.
         * @param string $OrderBy       Trường được sắp xếp
         * @return Ambigous <Ambigous, boolean, multitype:>
         */
        public static function getProductsHome($OrderBy = 'Name'){
            return ProductDB::getProductsByKey(array('Home'=>1), $OrderBy);
        }
        
        /**
         * Lấy thông tin sản phẩm theo phân trang
         * @param unknown $currentPage  Phân trang hiện tại
         * @param unknown $numberItemsPerPage       Số sản phẩm trên một phân trang
         * @param unknown $KeyGet       Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy       Trường được sắp xếp
         * @return Ambigous <Ambigous, boolean, multitype:>
         */
        public static function getProductsPagination($currentPage, $numberItemsPerPage, $KeyGet = array(), $OrderBy = 'ProductID'){
            $Position   = ($currentPage - 1) * $numberItemsPerPage;
            return ProductDB::getProductsByKey(array_merge($KeyGet, array('Limit' => array('Position' => $Position, 'Number' => $numberItemsPerPage))), $OrderBy);
        } 
        
        /**
         * Lấy thông tin sản phẩm ẩn từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getProductsHidden($KeyGet = array(), $OrderBy = 'ProductID'){
            return self::getProductsByKey(array_merge($KeyGet, array('Hide' => '1')), $OrderBy);
        }
        
        /**
         * Lấy thông tin sản phẩm đã xóa từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getProductsDeleted($KeyGet = array(), $OrderBy = 'ProductID'){
            return self::getProductsByKey(array_merge($KeyGet, array('Active' => '0')), $OrderBy);
        }
        
        /**
         * Thêm sản phẩm
         * @param unknown $product      Thông tin sản phẩm sẽ thêm bao gồm: `Name`, `CategoryID`, `Unit`, `Price`, `Description`, `Color`, `Quantity`, `LinkImage`, `Hide`, `Active`, `Keyword`, `Home`
         * @return boolean              True: thêm thành công || False: thêm thất bại
         */
        public static function addProduct($product){
            @$UserID = $_SESSION['User']['UserID'];
            
            $db = Database::getDB();
            
            $sql    = "SELECT `UserID` FROM `users` WHERE `UserID`='" . $UserID . "' AND `GroupID`>=4";
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            if (Database::loadRow($stmt) == false){
                echo '<pre>';
                print_r($stmt);
                echo '</pre>';
                echo $err   = "ID người dùng không hợp lệ";
                return false;
            } else {
                $ProductID  = 'P' . randomString(str_repeat(implode('', range('0', '9')), 4), 7);
                $sql    = 'INSERT INTO  `products`(`Time`, `ProductID`, `Name`, `CategoryID`, `Unit`, `Price`, `Description`, `Color`, `Quantity`, `LinkImage`, `Hide`, `Active`, `Keyword`, `Home`, `UpdatedBy`, `LastTime`)
                           VALUES(NOW(), \'' . $ProductID . '\' , \'' . $product['Name'] . '\', \'' . $product['CategoryID'] . '\', \'' . $product['Unit'] . '\', \'' . $product['Price'] . '\', \'' . $product['Description'] . '\', \'' . $product['Color'] . '\', \'' . $product['Quantity'] . '\', \'' . $product['LinkImage'] . '\', \'' . $product['Hide'] . '\', \'' . $product['Active'] . '\', \'' . $product['Keyword'] . '\', \'' . $product['Home'] . '\', \'' . $UserID . '\', NOW())';
                
                Database::setQuery($sql);
                $stmt   = Database::execute();
                return true;
            }
        }
        
        /**
         * Cập nhật sản phẩm
         * @param unknown $ProductID    Mã sản phẩm cần cập nhật
         * @param unknown $data         Mảng các (Cột=>Giá trị) dùng để cập nhật (trong mệnh đề SET)
         * @return boolean              True: cập nhật thành công || False: cập nhật thất bại
         */
        public static function updateProduct($ProductID, $data){
            @$UserID = $_SESSION['User']['UserID'];
            
            $db = Database::getDB();
            
            $sql    = "SELECT `UserID` FROM `users` WHERE `UserID`='" . $UserID . "' AND `Active` = '1' AND `GroupID` >= '4'";
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            if (Database::loadRow($stmt) == false){
                echo $err   = "ID người dùng không hợp lệ";
                return false;
            } else {
                $colSet  = '';
                foreach ($data as $Colunm => $Value){
                        $colSet .= '`' . $Colunm . '` = \'' . $Value . '\', ';
                }
                
                $sql        = 'UPDATE `products`
                                SET
                                    ' . $colSet . '
                                    `UpdatedBy`=\'' . $UserID . '\',
                                    `LastTime`=NOW()
                                WHERE `ProductID` = \'' . $ProductID . '\'';
            
                Database::setQuery($sql);
                $stmt   = Database::execute();
                return true;
            }
        }

        /**
         * Xoá sản phẩm (cập nhật trạng thái hoạt động = 0)
         * @param unknown $ProductID    Mã sản phẩm cần thiết lập: ngưng trạng hoạt động của sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function deleteProduct($ProductID){
            return ProductDB::updateProduct($ProductID, array('Active' => '0'));
        }
        
        /**
         * Khôi phục sản phẩm đã xóa (cập nhật trạng thái hoạt động = 1)
         * @param unknown $ProductID    Mã sản phẩm cần thiết lập: khôi phục hoạt động của sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function activeProduct($ProductID){
            return ProductDB::updateProduct($ProductID, array('Hide' => '0'));
        }
        
        /**
         * Ẩn sản phẩm
         * @param unknown $ProductID    Mã sản phẩm cần thiết lập: ẩn sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function hideProduct($ProductID){
            return ProductDB::updateProduct($ProductID, array('Hide' => '1'));
        }
        
        
        /**
         * Hiện sản phẩm (đã ẩn)
         * @param unknown $ProductID    Mã sản phẩm cần thiết lập: hiện sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function showProduct($ProductID){
            return ProductDB::updateProduct($ProductID, array('Hide' => '0'));
        }
    }
?>