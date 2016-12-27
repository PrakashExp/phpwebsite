<?php
require_once("../../api/model/user_db.php");
require_once("../../api/ajax/check_data.php");
require_once("../../api/model/functions.php");

$dateArr = date_parse_from_format("d/m/Y", $_POST['Birthday']);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$userId="";
$userSex="";
$userTime="";
$userName="";
$userBirth="";
$userIdcard="";
$userAddress="";
$userTel="";
$userEmail="";
$userGroupid="";
$userActive="1";
$userRevenue="0";

$accUsername="";
$accUserPass="";
$accUserPassRetype=""; 
if(isset($_POST['Register']))
{
	$userId=randomString("",8);
	$userName = trim($_POST['Name']);
	$userSex=$_POST['Sex'];
    $birth = date_parse_from_format("d/m/Y", $_POST['Birthday']);
	$userBirth=$birth['year']."-".$birth['month']."-".$birth['day'];
    $userTime = date("Y-m-d", mktime(0, 0, 0, $dateArr["month"], $dateArr["day"], $dateArr["year"]));
    $userIdcard = trim($_POST['IDCard']);
    $userAddress = trim($_POST['Address']);
    $userTel = trim($_POST['TelNumber']);
    $userEmail = trim($_POST['Email']);
	$userGroupid=trim($_POST['GroupId']);
	
	$accUserName=trim($_POST['Username']);
	$accUserPass=trim($_POST['Password']);
	$accUserPassRetype=trim($_POST['PasswordRetype']);
	
	if(!checkEmpty($accUserName) && checkPass($accUserPass,$accUserPassRetype) 
	&& !UserDB::checkAvailableUsername($accUsername) 
	&& !UserDB::checkAvailableEmail($userEmail) && !UserDB::checkAvailableIDCard($userIdcard)
	&& !checkInvalidLength($accUserPass, 4, 20) && checkFormat($accUserPass, 'Password'))
	{
		$arrayUser=array("UserID"=>$userId,"Time"=>$userTime,"Name"=>$userName,"Sex"=>$userSex,"Birthday"=>$userBirth,"IDCard"=>$userIdcard,"Address"=>$userAddress,"TelNumber"=>$userTel,"Email"=>$userEmail,"Active"=>$userActive,"GroupID"=>$userGroupid,"Revenue"=>$userRevenue,"LastTime"=>$userTime,"Username"=>$accUserName,"Password"=>$accUserPass);
		UserDB::addUser($arrayUser);
		
		echo "<script>alert('Đăng ký thành công');</script>";
		echo "<meta http-equiv='refresh' content='0;url=../../app/index.php'>";
	}
	else
	{
		$Alert='Đăng ký thất bại! ';
		if(checkEmpty($accUserName))
		{
			$Alert=$Alert.'Tên đăng nhập không được trống';
		}
		else
		if(!checkPass($accUserPass,$accUserPassRetype))
		{
			$Alert=$Alert.'Mật khẩu không đúng! ';
		}
		else
		if(checkInvalidLength($accUserPass, 4, 20))
		{
			$Alert=$Alert.'Mật khẩu quá ngắn! ';
		}
		else
		if(!checkFormat($accUserPass, 'Password'))
		{
			$Alert=$Alert.'Mật khẩu phải gồm chữ hoa, số và chữ thường ';
		}
		else
		if(UserDB::checkAvailableUsername($accUsername))
		{
			$Alert=$Alert.'Tên đăng nhập đã tồn tại! ';
		}
		else
		if(UserDB::checkAvailableEmail($userEmail))
		{
			$Alert=$Alert.'Email đã tồn tại! ';
		}
		else
		if(UserDB::checkAvailableIDCard($userIdcard))
		{
			$Alert=$Alert.'Chứng minh thư đã tồn tại! ';
		}
		//echo $Alert;
		echo "<script>alert('$Alert');</script>";
		echo "<meta http-equiv='refresh' content='0;url=../../app/index.php'>";
	}
}	
 
?>