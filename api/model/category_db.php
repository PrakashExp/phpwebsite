<?php
    class CategoryDB{ 
        /**
         * Lấy thông tin nhóm sản phẩm từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getCategoriesByKey($KeyGet = array('Hide' => '0', 'Active' => '1'), $OrderBy = 'CategoryID'){
            $db = Database::getDB();
        
            if (!isset($KeyGet['Hide']) && !isset($KeyGet['Active'])){
                $KeyGet = array_merge($KeyGet, array('Hide' => '0', 'Active' => '1'));
            }
        
            $WhereCondition = '';
             
            foreach ($KeyGet as $Colunm => $Value){
                $WhereCondition .= ' AND `categories`.`' . $Colunm . '`=\'' . $Value . '\'';
            }
        
            $WhereCondition = substr($WhereCondition, 5);   //Loại bỏ ' AND ' đầu tiên.
        
            $sql    = 'SELECT  `CategoryID`, `Time`, `categories`.`Name` as \'CategoryName\', `Priority`, `Keyword`, `LastTime` 
                        FROM `categories`
                        WHERE ' . $WhereCondition . '
                        ORDER BY  `categories`.`' . $OrderBy . '`';
        
            Database::setQuery($sql);
            $stmt   = Database::execute();
        
            return Database::loadAllRows($stmt);
        }
        
        /**
         * Lấy ID nhóm sản phẩm từ tên sản phẩm
         * @param unknown $CategoryName
         * @return Ambigous <>|boolean
         */
        public static function getCategoryIdByName($value){
            $db = Database::getDB();

            $CategoriesList = CategoryDB::getCategoriesByKey();            
            
            foreach ($CategoriesList as $Category){
                $CategoryName   = strtolower(stripUnicode($Category['CategoryName']));
                
                if ($value == $CategoryName) {
                    return $Category['CategoryID'];
                }
            }
            
            return '0';
        }
        
        /**
         * Lấy thông tin nhóm sản phẩm ẩn từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getCategoriesHidden($KeyGet = array(), $OrderBy = 'CategoryID'){
            return self::getCategoryByKey(array_merge($KeyGet, array('Hide' => '1')), $OrderBy);
        }
        
        /**
         * Lấy thông tin nhóm sản phẩm đã xóa từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getCategoriesDeleted($KeyGet = array(), $OrderBy = 'CategoryID'){
            return self::getCategoryByKey(array_merge($KeyGet, array('Active' => '0')), $OrderBy);
        }
        
        /**
         * Thêm nhóm sản phẩm
         * @param unknown $Category     Thông tin nhóm sản phẩm sẽ thêm bao gồm: `Name`, `Priority`, `Hide`, `Active`, `Keyword`
         * @return boolean              True: thêm thành công || False: thêm thất bại
         */
        public static function addCategory($category){
            @$UserID = $_SESSION['UserID'];
        
            $db = Database::getDB();
        
            $sql    = 'SELECT `UserID` FROM `users` WHERE `UserID`=\'' . $UserID . '\' AND `GroupID` > 4';
        
            Database::setQuery($sql);
            $stmt   = Database::execute();
        
            if (Database::loadRow($stmt) == false){
                echo $err   = "ID người dùng không hợp lệ";
                return false;
            } else {
                $db->beginTransaction();
                $sql    = 'INSERT INTO  `categories`(`Time`, `Name`, `Priority`, `Hide`, `Active`, `Keyword`, `LastTime`)
                           VALUES(NOW(), \'' . $category['Name'] . '\', \'100000\', \'' . $category['Hide'] . '\', \'' . $category['Active'] . '\', \'' . @$category['Keyword'] . '\', NOW())';

                Database::setQuery($sql);
                $stmt   = Database::execute();
                
                $CategoryID = (int)$db->lastInsertId();
                
                CategoryDB::updateCategoryPriority($CategoryID, $category['Priority']);
                                
                $db->commit();
                return true;
            }
        }
        
        /**
         * Cập nhật mức ưu tiên
         * @param unknown $CategoryID   Nhóm sản phẩm cần cập nhật mức ưu tiên
         * @param unknown $value        Giá trị cập nhật: + 1/- 1 hoặc giá trị mức ưu tiên cụ thể
         */
        public static function updateCategoryPriority($CategoryID, $value){
            $db = Database::getDB();
                
            if(!is_numeric($value)){        //+ 1, - 1
                $data   = explode(' ', trim($value));   //[0]: +/-, [1]: 1
                
                $sql    = 'SELECT `priority` FROM `categories` WHERE `CategoryID` = \'' . $CategoryID . '\'';
                Database::setQuery($sql);
                $stmt   = Database::execute();
                $priority   = Database::loadRow($stmt);
                $priority   = $priority['priority'];
                
                if ($data[0] == '+'){
                    $value  = (int)$priority + (int)$data[1];
                } else {
                    $value  = (int)$priority - (int)$data[1];
                }                
            }
            
            $sql    = 'SELECT `CategoryID` FROM `categories` WHERE `CategoryID` != \'' . $CategoryID . '\' AND `priority` = \'' . $value . '\'';
            Database::setQuery($sql);
            $stmt   = Database::execute();
            if (Database::loadRow($stmt)){     //Mức ưu tiên 'a' đã tồn tại (va ko phai la nhom dang update) => Dịch chuyển các nhóm sản phẩm, có độ ưu tiên từ 'a' trở lên, thêm 1 mức ưu tiên trước khi thêm nhóm sản phẩm
                $sql    = 'SELECT `CategoryID`
                                FROM `categories`
                                WHERE `priority` >= \'' . $value . '\'
                                ORDER BY `Priority` DESC';
                Database::setQuery($sql);
                $stmt   = Database::execute();
            
                $result    = Database::loadAllRows($stmt);
                
                foreach ($result as $Catergory){
                    $sql    = 'UPDATE `categories` SET `Priority` = `Priority` + 1, `LastTime` = NOW() WHERE `CategoryID` = \'' . $Catergory['CategoryID'] . '\'';

                    Database::setQuery($sql);
                    $stmt   = Database::execute();
                }
            }
            
            $sql    = 'UPDATE `categories` SET `Priority` = \'' . $value . '\', `LastTime` = NOW() WHERE `CategoryID` = \'' . $CategoryID . '\'';
            Database::setQuery($sql);
            $stmt   = Database::execute();
        }
        
        /**
         * Cập nhật nhóm sản phẩm
         * @param unknown $CategoryID    Mã nhóm sản phẩm cần cập nhật
         * @param unknown $data         Mảng các (Cột=>Giá trị) dùng để cập nhật (trong mệnh đề SET)
         * @return boolean              True: cập nhật thành công || False: cập nhật thất bại
         */
        public static function updateCategory($CategoryID, $data){
            @$UserID = $_SESSION['UserID'];
        
            $db = Database::getDB();
        
            $sql    = "SELECT `UserID` FROM `users` WHERE `UserID`='" . $UserID . "' AND `Active` = '1' AND `GroupID` >= '4'";
        
            Database::setQuery($sql);
            $stmt   = Database::execute();
        
            if (Database::loadRow($stmt) == false){
                echo $err   = "ID người dùng không hợp lệ";
                return false;
            } else {
                $db->beginTransaction();
                
                if (isset($data['Priority'])){
                    CategoryDB::updateCategoryPriority($CategoryID, $data['Priority']);
                    unset($data['Priority']);
                }
                
                $colSet  = '';
                foreach ($data as $Colunm => $Value){
                    $colSet .= '`' . $Colunm . '` = \'' . $Value . '\', ';
                }
        
                echo $sql        = 'UPDATE `categories`
                                SET
                                    ' . $colSet . '
                                    `LastTime`=NOW()
                                WHERE `CategoryID` = \'' . $CategoryID . '\'';
        
                Database::setQuery($sql);
                $stmt   = Database::execute();
                
                $db->commit();
                return true;
            }
        }
        
        /**
         * Xoá nhóm sản phẩm (cập nhật trạng thái hoạt động = 0)
         * @param unknown $CategoryID    Mã nhóm sản phẩm cần thiết lập: ngưng trạng hoạt động của nhóm sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function deleteCategory($CategoryID){
            return CategoryDB::updateCategory($CategoryID, array('Active' => '0'));
        }
        
        /**
         * Khôi phục nhóm sản phẩm đã xóa (cập nhật trạng thái hoạt động = 1)
         * @param unknown $CategoryID    Mã nhóm sản phẩm cần thiết lập: khôi phục hoạt động của nhóm sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function activeCategory($CategoryID){
            return CategoryDB::updateCategory($CategoryID, array('Active' => '1'));
        }
        
        /**
         * Ẩn nhóm sản phẩm
         * @param unknown $CategoryID    Mã nhóm sản phẩm cần thiết lập: ẩn nhóm sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function hideCategory($CategoryID){
            return CategoryDB::updateCategory($CategoryID, array('Hide' => '1'));
        }
        
        
        /**
         * Hiện nhóm sản phẩm (đã ẩn)
         * @param unknown $CategoryID    Mã nhóm sản phẩm cần thiết lập: hiện nhóm sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function showCategory($CategoryID){
            return CategoryDB::updateCategory($CategoryID, array('Hide' => '0'));
        }
    }
?>