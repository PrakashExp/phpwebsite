<?php
require_once ("../../api/controller/mail.php");
require_once ("../../api/model/functions.php");
require_once("../../api/model/account_db.php");
require_once("../../api/model/user_db.php");
if(isset($_POST['submit_get_pass']))
{
	$username=$_POST['Username'];
	if(UserDB::checkAvailableUsername($username))
	{
		$check=false;
		$password=randomString(implode(array_merge(range('0','9')),''),6);
		$email=AccountDB::getUserEmail($username);
		$check=sendEmail("admin@shopflower.com",$email,$username,$password);
		if($check)
		{
			AccountDB::setNewPassword($username,$password);	
			echo "<script>alert('Email đã được gửi tới hộp thư mà bạn đăng ký trong tài khoản. Hãy check lại mail');</script>";
		echo "<meta http-equiv='refresh' content='0;url=../../app/index.php'>";	
		}		
		
	}
	else
	{
		echo "<script>alert('Tài khoản bạn nhập không tồn tại hoặc đã bị xóa!');</script>";
		echo "<meta http-equiv='refresh' content='0;url=../../app/index.php'>";	
	}
}
?>