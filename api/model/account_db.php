<?php
require_once"database.php";
class AccountDB
{
    /**
     * Kiểm tra mật khẩu cũ
     * @param unknown $UserID   ID người dùng
     * @param unknown $value    Giá trị cần kiểm tra
     * @return boolean          True: trùng khớp || False: không trùng khớp
     */
    public static function checkOldPassword($UserID, $value){
        Database::getDB();
        $sql    = 'SELECT
                      `Password`
                    FROM
                      `accounts`
                    WHERE
                      `UserID`=\'' . $UserID . '\'';
        Database::setQuery($sql);
        $stmt   = Database::execute();
        $OldPassword    = Database::loadRow($stmt);
        
        return ($OldPassword['Password'] == md5($value)) ? true : false;        
    }
    
    /**
     * Cập nhật mật khẩu
     * @param unknown $Username
     * @param unknown $NewPassword
     */
    public static function setNewPassword($Username, $NewPassword){
        Database::getDB();
        $accountSql     = 'UPDATE
                              `accounts`
                            SET
                              `accounts`.`Password` = \'' . md5($NewPassword) . '\'
                            WHERE
                              `accounts`.`Username`	= \'' . $Username . '\'';
        
        Database::setQuery($accountSql);
        $stmt   = Database::execute();
    }
    
	/*
	Đặt mật khẩu mới cho tài khoản
	 	
	public static function getUserID($username)
	{
		Database::getDB();
		$querry="SELECT UserID from accounts where Username = $username ";
		Database::setQuery($querry);
		$stmt=Database::execute();
		$result=Database::loadRow($stmt);
		return $result['UserID'];
	}
	*/
	public static function getUserEmail($username)
	{
		Database::getDB();
		 $sql    = 'SELECT
                          `Email`
                        FROM
                          `users` JOIN `accounts` ON `users`.`UserID` = `accounts`.`UserID`
                        WHERE
                          `accounts`.`Username` = \'' . $username . '\'';
		Database::setQuery($sql);
		$stmt=Database::execute();
		$result=Database::loadRow($stmt);
		return $result['Email'];
	} 
}
?>