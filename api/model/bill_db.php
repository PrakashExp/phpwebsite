<?php
    class BillDB{
        /*========================================= BILL =========================================*/
        /**
         * Lấy thông tin hóa đơn từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * Các trạng thái đơn hàng:
         * Unverified   Chưa xác nhận   1
         * Verified     Đã xác nhận     2
         * Packed       Đã đóng gói     3
         * Shipping     Đang chuyển đi  4
         * Shipped      Đang giao hàng  5
         * Delivered    Đã giao hàng    6
         * Cancelled    Đã hủy          7
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getBillsByKey($KeyGet = array(), $OrderBy = 'BillID'){
            $db = Database::getDB();
            
            //LIMIT
            $Limit  = '';
            if (isset($KeyGet['Limit'])){
                $Limit  = 'LIMIT ' . $KeyGet['Limit']['Position'] . ', ' . $KeyGet['Limit']['Number'];
                $KeyGet['Limit']    = null;
                array_pop($KeyGet);
            }
        
            $WhereCondition = '';
            
            foreach ($KeyGet as $Colunm => $Value){
                $WhereCondition .= ' AND `bills`.`' . $Colunm . '`=\'' . $Value . '\'';
            }
            
            $WhereCondition = substr($WhereCondition, 5);   //Loại bỏ ' AND ' đầu tiên.
            
            if (checkEmpty($WhereCondition)){
                $WhereCondition = '1';
            }
        
            $sql    = 'SELECT `BillID`, `usersOne`.`Name` as \'CustomerName\', `CustomerID`, `usersTwo`.`Name` as \'EmployeeName\', `EmployeeID`, `BillValue`, `Status`
                            FROM `bills` LEFT JOIN `users` usersOne ON 
`usersOne`.`UserID` = `bills`.`CustomerID` LEFT JOIN `users` usersTwo ON 
`usersTwo`.`UserID` = `bills`.`EmployeeID`
                            WHERE ' . $WhereCondition . '
                            ORDER BY  `bills`.`' . $OrderBy . '`' . $Limit;

            //                        echo $sql;
        
            Database::setQuery($sql);
            $stmt   = Database::execute();
        
            return Database::loadAllRows($stmt);
        }
        
        /**
         * Lấy thông tin hóa đơn theo phân trang
         * @param unknown $currentPage  Phân trang hiện tại
         * @param unknown $numberItemsPerPage       Số hóa đơn trên một phân trang
         * @param unknown $KeyGet       Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy       Trường được sắp xếp
         * @return Ambigous <Ambigous, boolean, multitype:>
         */

        public static function getBillsPagination($currentPage, $numberItemsPerPage, $KeyGet = array(), $CategoryID = '0', $OrderBy = 'BillID'){
            $Position   = ($currentPage - 1) * $numberItemsPerPage;
            return BillDB::getBillsByKey(array_merge($KeyGet, array('Limit' => array('Position' => $Position, 'Number' => $numberItemsPerPage))), $OrderBy);
        }
        
        /**
         * Tạo mới đơn hàng
         * @param unknown $DetailOfBill Mảng chi tiết đơn hàng.
         * @param string $CustomerID    NULL: Khách hàng đặt hàng online | != NULL: Nhân viên đặt hàng cho khách (trạng thái đã xác nhận)
         * @return boolean
         */
        public static function addBill($DetailOfBill, $CustomerID = null){
			$EmployeeID = "NULL";
			$time=date("Y-m-d H:i:s");
            if ($CustomerID == null){   //Khách hàng mua online (vãng lai/đã đăng ký).
			
                if (isset($_SESSION['User'])){ //Khách hàng đã đăng ký
                    $CustomerID     = $_SESSION['User']['UserID'];
                }    
				$Status         = '1';           
            } else {    //Nhân viên thêm hóa đơn (mua tại cửa hàng)
                $EmployeeID     = '\''.$_SESSION['User']['UserID'].'\'';
                $Status         = '2';
            }
                        
            $BillID     = 'B' . randomString(str_repeat(implode('', range('0', '9')), 4), 7);
           
            $BillValue  = 0;
			       
            $db = Database::getDB();

            $db->beginTransaction();

            //Tạo đơn hàng
            /*$sqlBills   = 'INSERT INTO `bills`(
                            `BillID`,
                            `Time`,
                            `CustomerID`,
                            `EmployeeID`,
                            `BillValue`,
                            `Status`
                        )
                        VALUES(
                            \'' . $BillID . '\',
                            $time,
                            \'' . $CustomerID . '\',
                            \'' . $EmployeeID . '\,
                            \'' . $BillValue . '\',
                            \'' . $Status . '\'
                        )';*/
						$sqlBills   = 'INSERT INTO `bills`(
                            `BillID`,
                            `Time`,
                            `CustomerID`,
                            `EmployeeID`,
                            `BillValue`,
                            `Status`
                        )
                        VALUES('.'\''.$BillID.'\''.','.'\''.$time.'\''.','.'\''.$CustomerID.'\''.','.$EmployeeID.','.'\''.$BillValue.'\''.','.'\''.$Status.'\''.')';
			
            Database::setQuery($sqlBills);
           	Database::execute();
            
            //Chèn các chi tiết đơn hàng.
            //$nDetailOfBill  = count($DetailOfBill);
            foreach($DetailOfBill as $ProductID => $product)
			{
            //for ($j = 1; $j <= $nDetailOfBill; $j++):
                /*$ProductID  = $DetailOfBill[$j]['ProductID'];
                $Price      = $DetailOfBill[$j]['Price'];
                $Quantity   = $DetailOfBill[$j]['Quantity'];
                $BillValue  += $Price * $Quantity;*/
				$ProductID  = $ProductID;
                $Price      = $product['Price'];
                $Quantity   = $product['Quantity'];
                $BillValue  += $Price * $Quantity;
                $sqlDetailOfBill     = 'INSERT INTO `detailofbill`(
                                            `BillID`,
                                            `ProductID`,
                                            `Quantity`)
                                        VALUES(
                                            \'' . $BillID . '\',
                                            \'' . $ProductID . '\',
                                            \'' . $Quantity . '\'
                                        );';
                Database::setQuery($sqlDetailOfBill);
                Database::execute();			
			}
            //endfor;
            
            //Update giá trị đơn hàng.            
            $sqlUpdateBillValue = 'UPDATE
                                  `bills`
                                SET
                                  `BillValue` = \'' . $BillValue . '\'
                                WHERE
                                  `BillID`=\'' . $BillID . '\'';
            Database::setQuery($sqlUpdateBillValue);
            Database::execute();
            
            return $db->commit();
        }
        
        /**
         * Cập nhật trạng thái đơn hàng.
         * @param unknown $BillID   Mã đơn hàng
         * @param unknown $Status   Trạng thái mới
         */
        public function updateStatus($BillID, $Status, $EmployeeID){
            /*
             * Các trạng thái đơn hàng
             * Unverified   Chưa xác nhận   1
             * Verified     Đã xác nhận     2
             * Packed       Đã đóng gói     3
             * Shipping     Đang chuyển đi  4
             * Shipped      Đang giao hàng  5
             * Delivered    Đã giao hàng    6
             * Cancelled    Đã hủy          7
             */
            $db = Database::getDB();
            
            if (!checkEmpty($Status)){
                switch ($Status){
                    case 'Unverified':
                        $iStatus   = 1;
                        break;
                    case 'Verified':
                        $iStatus   = 2;
                        break;
                    case 'Packed':
                        $iStatus   = 3;
                        break;
                    case 'Shipping':
                        $iStatus   = 4;
                        break;
                    case 'Shipped':
                        $iStatus   = 5;
                        break;
                    case 'Delivered':
                        $iStatus   = 6;
                        break;
                    case 'Cancelled':
                        $iStatus   = 7;
                        break;
                }
                
                $Status = $iStatus;
            }
            
            $sqlUpdateStatus    = 'UPDATE
                                      `bills`
                                    SET
                                      `Status` = \'' . $Status . '\',
                                      `EmployeeID` = \'' . $EmployeeID . '\'
                                    WHERE
                                      `BillID` = \'' . $BillID . '\'';

            Database::setQuery($sqlUpdateStatus);
            $stmt = Database::execute();
        }
        
        /*==================================== DETAIL OF BILL ====================================*/ 
        
        /**
         * Xóa một chi tiết hóa đơn của đơn hàng.
         * @param unknown $BillID       Mã hóa đơn
         * @param unknown $ProductID    Mã sản phẩm
         * @return boolean
         */
        public function deleteDetailOfBill($BillID, $ProductID){
            $db = Database::getDB();
            
            $sqlNumberDetail  = 'SELECT
                                  COUNT(`ProductID`) AS \'NumberDetail\'
                                FROM
                                  `detailofbill`
                                WHERE
                                  `BillID` = \'' . $BillID . '\'';

            Database::setQuery($sqlNumberDetail);
            $stmt   = Database::execute();
            $nDetailOfBill  = Database::loadRow($stmt);
            $nDetailOfBill  = $nDetailOfBill['NumberDetail'];
            
            if ($nDetailOfBill == 1){
                echo 'Không thể xóa! Đơn hàng chỉ có một loại sản phẩm.';
                return false;
            } else {
                $db = Database::getDB();
                
                $db->beginTransaction();
                
                //Xoá chi tiết hóa đơn.
                $sqlDeleteDetailOfBill  = 'DELETE FROM
                                              `detailofbill`
                                            WHERE
                                              `BillID` = \'' . $BillID . '\' AND `ProductID` = \'' . $ProductID . '\'';

                Database::setQuery($sqlDeleteDetailOfBill);
                Database::execute();
                
                //Tính lại giá trị đơn hàng.
                $BillValue  = 0;
                
                $sqlNumberDetail  = 'SELECT
                                      `ProductID`, `Quantity`
                                    FROM
                                      `detailofbill`
                                    WHERE
                                      `BillID` = \'' . $BillID . '\'';

                Database::setQuery($sqlNumberDetail);
                $stmt   = Database::execute();
                $Products = Database::loadAllRows($stmt);
                
                foreach ($Products as $Product){
                    $ProductID  = $Product['ProductID'];
                    $Quantity   = $Product['Quantity'];
                    
                    $sqlProduct     = 'SELECT `Price` FROM `products` WHERE `ProductID`=\'' . $ProductID . '\'';
                    Database::setQuery($sqlProduct);
                    $stmt       = Database::execute();
                    $Price      = Database::loadRow($stmt);
                    $Price      = $Price['Price'];
                    
                    $BillValue  += $Price * $Quantity;
                }
                
                //Update giá trị đơn hàng.
                $sqlUpdateBillValue = 'UPDATE
                                  `bills`
                                SET
                                  `BillValue` = \'' . $BillValue . '\'
                                WHERE
                                  `BillID`=\'' . $BillID . '\'';
                Database::setQuery($sqlUpdateBillValue);
                Database::execute();
                
                return $db->commit();
            }
        }
        
        /**
         * Cập nhật số lượng sản phẩm trong chi tiết đơn hàng.
         * @param unknown $BillID       Mã hóa đơn
         * @param unknown $ProductID    Mã sản phẩm
         * @param unknown $Quantity     Số lượng mới
         * @return boolean
         */
        public function updateDetailOfBill($BillID, $ProductID, $Quantity){
            $db = Database::getDB();
            
            if ($Quantity < 1 || checkEmpty($Quantity)){
                return false;
            }
            
            $db->beginTransaction();
            
            //Cập nhật số lượng sản phẩm trong chi tiết đơn hàng
            $sqlUpdateQuantity = 'UPDATE
                                      `detailofbill`
                                    SET
                                      `Quantity` =\'' . intval($Quantity) . '\'
                                    WHERE
                                      `BillID`=\'' . $BillID . '\' AND `ProductID`=\'' . $ProductID . '\'';
            Database::setQuery($sqlUpdateQuantity);
            Database::execute();
            
            //Tính lại giá trị đơn hàng.
            $BillValue  = 0;
            
            $sqlNumberDetail  = 'SELECT
                                      `ProductID`, `Quantity`
                                    FROM
                                      `detailofbill`
                                    WHERE
                                      `BillID` = \'' . $BillID . '\'';
            
            Database::setQuery($sqlNumberDetail);
            $stmt   = Database::execute();
            $Products = Database::loadAllRows($stmt);
            
            foreach ($Products as $Product){
                $ProductID  = $Product['ProductID'];
                $Quantity   = $Product['Quantity'];
            
                $sqlProduct     = 'SELECT `Price` FROM `products` WHERE `ProductID`=\'' . $ProductID . '\'';
                Database::setQuery($sqlProduct);
                $stmt       = Database::execute();
                $Price      = Database::loadRow($stmt);
                $Price      = $Price['Price'];
            
                $BillValue  += $Price * $Quantity;
            }
            
            //Update giá trị đơn hàng.
            $sqlUpdateBillValue = 'UPDATE
                                  `bills`
                                SET
                                  `BillValue` = \'' . $BillValue . '\'
                                WHERE
                                  `BillID`=\'' . $BillID . '\'';
            Database::setQuery($sqlUpdateBillValue);
            Database::execute();
            
            return $db->commit();
        }
        /*Lay thong tin chi tiet cua hoa don */
        public static function getBillInfosByBillID($UserID, $billID=null){
            $db = Database::getDB();
            $sql = 'SELECT `bills`. `BillID`, `bills`. `Time`, `usersTwo`.`Name` as \'EmployeeName\', `EmployeeID`, `BillValue`, `Status`, `products`.`ProductID`, `products`.`Name`, `products`.`LinkImage` as \'Image\' , `products`.`Price`, `products`.`Quantity`
                            FROM `bills` LEFT JOIN `users` usersTwo ON 
`usersTwo`.`UserID` = `bills`.`EmployeeID` inner join detailofbill on bills.BillID=detailofbill.BillID inner join products on products.ProductID=detailofbill.ProductID
where CustomerID='.'\''.$UserID.'\' AND
     `bills`. `BillID` ='.'\'' . $billID . '\'';

//             //            $sql='select * from bills inner join users on bills.EmployeeID=users.UserID inner join detailofbill on bills.BillID=detailofbill.BillID inner join products on products.ProductID=detailofbill.ProductID
// where CustomerID='.'\''.$UserID.'\'';
            Database::setQuery($sql);
            $stmt   = Database::execute();
            return Database::loadAllRows($stmt);
        }

         /* Lay thong tin hoa don theo UserID*/
          public static function getBillsInfo($UserID, $billID=null){
            $db = Database::getDB();
            $sql = 'SELECT `bills`. `BillID`, `usersTwo`.`Name` as \'EmployeeName\', `EmployeeID`, `BillValue`, `Status`
                            FROM `bills` LEFT JOIN `users` usersTwo ON 
`usersTwo`.`UserID` = `bills`.`EmployeeID` inner join detailofbill on bills.BillID=detailofbill.BillID inner join products on products.ProductID=detailofbill.ProductID
where CustomerID='.'\''.$UserID.'\'';
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            return Database::loadAllRows($stmt);
        }


        public static function getBillsInfoByUser($UserID){
            $db = Database::getDB();
            $sql = 'SELECT distinct `bills`. `BillID`, `usersTwo`.`Name` as \'EmployeeName\', `EmployeeID`, `BillValue`, `Status`
                            FROM `bills` LEFT JOIN `users` usersTwo ON 
`usersTwo`.`UserID` = `bills`.`EmployeeID` inner join detailofbill on bills.BillID=detailofbill.BillID inner join products on products.ProductID=detailofbill.ProductID
where CustomerID='.'\''.$UserID.'\'';

//             //            $sql='select * from bills inner join users on bills.EmployeeID=users.UserID inner join detailofbill on bills.BillID=detailofbill.BillID inner join products on products.ProductID=detailofbill.ProductID
// where CustomerID='.'\''.$UserID.'\'';
            Database::setQuery($sql);
            $stmt   = Database::execute();
            //                        echo $sql;
            return Database::loadAllRows($stmt);
        }


}
   
?>        