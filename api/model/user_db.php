<?php
	require_once "database.php";
    class UserDB{ 
        /**
         * Lấy profile cá nhân.
         * @return Ambigous <boolean, multitype:>
         */
        public static function getProfile($UserID = NULL){
            if ($UserID == NULL){
                $UserID = $_SESSION['User']['UserID'];
            }
            
            $GroupID    = UserDB::getGroupID();
            $GroupID    = $GroupID['GroupID'];
            
            $charComp   = ($GroupID >= 4) ? "<=" : "=";
            
            $db = Database::getDB();
            
            $sql    = 'SELECT
                          `users`.`UserID`,
                          `accounts`.`Username`,
                          `users`.`Name`,
                          `Sex`,
                          `Birthday`,
                          `IDCard`,
                          `Address`,
                          `TelNumber`,
                          `Email`,
                          `users`.`Active`,
                          `groups`.`Name` AS \'TypeUser\',
                          `Revenue`
                        FROM
                          `users` JOIN `groups` ON `users`.`GroupID` = `groups`.`GroupID`
                                  JOIN `accounts` ON `users`.`UserID` = `accounts`.`UserID`
                        WHERE
                          `users`.`GroupID` ' . $charComp . ' \'' . $GroupID . '\' AND `users`.`UserID` = \'' . $UserID . '\'';
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            return Database::loadRow($stmt);
        }
        
        /**
         * Lấy mã nhóm người dùng
         * @return Ambigous <boolean, mixed>
         */
        public static function getGroupID(){
            if (isset($_SESSION['User'])){
                $UserID = $_SESSION['User']['UserID'];
            }
            else {
                return false;
            }
            
            $db = Database::getDB();
            
            $sql    = 'SELECT `GroupID` FROM `users` WHERE `UserID` = \'' . $UserID . '\'';
            
            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            return Database::loadRow($stmt);
        }
        
        /**
         * Lấy thông tin người dùng từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getUsersByKey($KeyGet = array('Active' => '1'), $OrderBy = 'UserID'){
            $db = Database::getDB();
            
            $GroupID    = UserDB::getGroupID();
            $GroupID    = $GroupID['GroupID'];
            
            //LIMIT
            $Limit  = '';
            if (isset($KeyGet['Limit'])){
                $Limit  = 'LIMIT ' . $KeyGet['Limit']['Position'] . ', ' . $KeyGet['Limit']['Number'];
                $KeyGet['Limit']    = null;
                array_pop($KeyGet);
            }

            if (!isset($KeyGet['Active'])){
                $KeyGet = array_merge($KeyGet, array('Active' => '1'));
            }
            
            $WhereCondition = '';

            foreach ($KeyGet as $Colunm => $Value){
                $WhereCondition .= ' AND `users`.`' . $Colunm . '`=\'' . $Value . '\'';
            }
            
            $WhereCondition = substr($WhereCondition, 5);   //Loại bỏ ' AND ' đầu tiên.
            
            $sql    = 'SELECT
                              `users`.`UserID`,
                              `accounts`.`Username`,
                              `users`.`Name`,
                              `Sex`,
                              `Birthday`,
                              `IDCard`,
                              `Address`,
                              `TelNumber`,
                              `Email`,
                              `users`.`Active`,
                              `groups`.`Name` AS \'TypeUser\',
                              `Revenue`
                            FROM
                              `users` JOIN `groups` ON `users`.`GroupID` = `groups`.`GroupID`
                                      JOIN `accounts` ON `users`.`UserID` = `accounts`.`UserID`
                            WHERE `users`.`GroupID` < \'' . $GroupID . '\' AND ' . $WhereCondition . '
                            ORDER BY  `users`.`' . $OrderBy . '` ' . $Limit;

            Database::setQuery($sql);
            $stmt   = Database::execute();
            
            return Database::loadAllRows($stmt);
        }
        
        /**
         * Lấy thông tin người dùng theo phân trang
         * @param unknown $currentPage  Phân trang hiện tại
         * @param unknown $numberItemsPerPage       Số người dùng trên một phân trang
         * @param unknown $KeyGet       Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy       Trường được sắp xếp
         * @return Ambigous <Ambigous, boolean, multitype:>
         */
        public static function getUsersPagination($currentPage, $numberItemsPerPage, $KeyGet = array(), $CategoryID = '0', $OrderBy = 'UserID'){
            $Position   = ($currentPage - 1) * $numberItemsPerPage;
            return UserDB::getUsersByKey(array_merge($KeyGet, array('Limit' => array('Position' => $Position, 'Number' => $numberItemsPerPage))), $OrderBy);
        }
        
        /**
         * Lấy thông tin người dùng đã xóa từ KeyGet.
         * @param unknown $KeyGet   Mảng các (Cột=>Giá trị) dùng trong mệnh đề WHERE
         * @param string $OrderBy   Trường được sắp xếp
         * @return Ambigous <boolean, multitype:>
         */
        public static function getUsersDeleted($KeyGet = array(), $OrderBy = 'UserID'){
            return self::getProductByKey(array_merge($KeyGet, array('Active' => '0')), $OrderBy);
        }
        
        /**
         * Thêm người dùng
         * @param unknown $product      Thông tin người dùng
         * @return boolean              True: thêm thành công || False: thêm thất bại
         */
        public static function addUser($user){
            $db = Database::getDB();
            
            $db->beginTransaction();
            
           $str    = str_repeat(implode('', array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'))), 4);
           $UserID = randomString($str,8);
                     
            $userSql    = 'INSERT INTO `users`(`UserID`, `Time`, `Name`, `Sex`, `Birthday`, `IDCard`, `Address`, `TelNumber`, `Email`, `Active`, `GroupID`, `Revenue`, `LastTime`)
                            VALUES (\'' . $UserID . '\', NOW(), \'' . $user['Name'] . '\', \'' . $user['Sex'] . '\', \'' . $user['Birthday'] . '\', \'' . $user['IDCard'] . '\', \'' . $user['Address'] . '\', \'' . $user['TelNumber'] . '\', \'' . $user['Email'] . '\', 1, \'' . $user['GroupID'] . '\', 0, NOW())';
            $accountSql = 'INSERT INTO `accounts`(`UserID`, `Username`, `Password`) VALUES (\'' . $UserID . '\', \'' . $user['Username'] . '\' , \'' . md5($user['Password']) . '\')';
            
            Database::setQuery($userSql);
            $stmt   = Database::execute();
            
            Database::setQuery($accountSql);
            $stmt   = Database::execute();
            
            return $db->commit();
        }
        
        /**
         * Cập nhật thông tin người dùng (giới hạn cho phép cập nhật: địa chỉ, số điện thoại, mật khẩu (nếu cần))
         * @param unknown $ProductID    Mã người dùng cần cập nhật
         * @param unknown $data         Mảng các (Cột=>Giá trị) dùng để cập nhật (trong mệnh đề SET)
         * @return boolean              True: cập nhật thành công || False: cập nhật thất bại
         */
        public static function updateUser($UserID, $data){
            $GroupID    = UserDB::getGroupID(); //Group người dùng đang gọi phương thức
            $GroupID    = $GroupID['GroupID'];
            
            $tmpChar    = ($GroupID >= 4) ? '<=' : '=';
            
            $db = Database::getDB();
            
            $db->beginTransaction();

            if (empty($data['Address'])) {   // just update Active or Block user

               $userSql        = 'UPDATE
                                  `users`
                                SET
                                  `users`.`Active` = \'' . $data['Active'] . '\',
                                  `users`.`LastTime` = NOW()
                                WHERE
                                  `users`.`UserID` = \'' . $UserID . '\' AND `users`.`GroupID` ' . $tmpChar . ' \'' . $GroupID . '\'';

            }

            else {       // update profile user

              $userSql        = 'UPDATE
                                  `users`
                                SET
                                  `users`.`Address` = \'' . $data['Address'] . '\',
                                  `users`.`TelNumber` = \'' . $data['TelNumber'] . '\',
                                  `users`.`LastTime` = NOW()
                                WHERE
                                  `users`.`UserID` = \'' . $UserID . '\' AND `users`.`GroupID` ' . $tmpChar . ' \'' . $GroupID . '\'';

              if (!checkEmpty($data['OldPassword'])){
                  AccountDB::setNewPassword($UserID, $data['NewPassword']);
              }

            }
                        
            Database::setQuery($userSql);
            $stmt   = Database::execute();
       
                        
            return $db->commit();
        }

        /**
         * Xoá người dùng (cập nhật trạng thái hoạt động = 0)
         * @param unknown $ProductID    Mã sản phẩm cần thiết lập: ngưng trạng hoạt động của sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function deleteUser($UserID){
            return UserDB::updateUser($UserID, array('Active' => '0'));
        }
        
        /**
         * Khôi phục sản phẩm đã xóa (cập nhật trạng thái hoạt động = 1)
         * @param unknown $ProductID    Mã sản phẩm cần thiết lập: khôi phục hoạt động của sản phẩm
         * @return boolean              True: thiết lập thành công || False: thiết lập thất bại
         */
        public static function activeUser($UserID){
            return UserDB::updateUser($UserID, array('Active' => '1'));
        }
        
        /**
         * Kiểm tra tồn tại Username trong CSDL
         * @param unknown $Username     Username cần kiểm tra
         * @return boolean              True: đã tồn tại || False: chưa tồn tại
         */
        public static function checkAvailableUsername($Username){
            $db     = Database::getDB();
            
            $sql    = 'SELECT `Username` FROM `accounts` WHERE `Username` = \'' . $Username . '\'';
            
            Database::setQuery($sql);            
            $result = Database::loadRow(Database::execute());
            
            if (count($result) == 0 || $result == false){
                return false;
            }
            
            return true;
        }
        
        /**
         * Kiểm tra tồn tại Email trong CSDL
         * @param unknown $Username     Email cần kiểm tra
         * @return boolean              True: đã tồn tại || False: chưa tồn tại
         */
        public static function checkAvailableEmail($Email){
            $db     = Database::getDB();
        
            $sql    = 'SELECT
                          `Email`
                        FROM
                          `users`
                        WHERE
                          `Email`=\'' . $Email . '\'';
        
            Database::setQuery($sql);
            $result = Database::loadRow(Database::execute());
        
            if (count($result) == 0 || $result == false){
                return false;
            }
        
            return true;
        }
        
        /**
         * Kiểm tra tồn tại CMND trong CSDL
         * @param unknown $Username     Số CMND cần kiểm tra
         * @return boolean              True: đã tồn tại || False: chưa tồn tại
         */
        public static function checkAvailableIDCard($IDCard){
            $db     = Database::getDB();
        
            $sql    = 'SELECT
                          `IDCard`
                        FROM
                          `users`
                        WHERE
                          `IDCard`=\'' . $IDCard . '\'';
        
            Database::setQuery($sql);
            $result = Database::loadRow(Database::execute());
        
            if (count($result) == 0 || $result == false){
                return false;
            }
        
            return true;
        }
    }
?>