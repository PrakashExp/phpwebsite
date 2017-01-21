<?php
require_once"../Mail-1.3.0/Mail.php";
function sendEmail($sender,$receiver,$username,$password)
{
	$option=array();
	$option['host']='ssl://smtp.gmail.com';
	$option['port']=465;
	$option['auth']=true;
	$option['username']='flower.shopuit2016@gmail.com';
	$option['password']='11031996';
	
	$mailer=Mail::factory('smtp',$option);
	
	$mail=AccountDB::getUserEmail($username);
	$header=array();
	$header['From']=$sender;
	$header['To']=$receiver;
	$header['Subject']='Reset Password for'.$username;
	
	$recipient=$mail;
	$body="Hello ".$username."!\n"."Your recovery password is: ".$password."\n"."Please immediately change your password after using this!"."\n\n"."Sincerely !\n"."Flower Shop Admin";
	$result=$mailer->send($recipient,$header,$body);
	if(PEAR::isError($result))
	{
		$error='Error sending mail: '.$result->getMessage();
		echo htmlspecialchars($error);
		return false;
	}
	return true;
}
function sendFeedBack($sender,$content,$name,$subject)
{
	$option=array();
	$option['host']='ssl://smtp.gmail.com';
	$option['port']=465;
	$option['auth']=true;
	$option['username']='flower.shopuit2016@gmail.com';
	$option['password']='11031996';
	
	$mailer=Mail::factory('smtp',$option);
	
	$header=array();
	$header['From']=$sender;
	$header['To']='thanhnguyen.yongkoo@gmail.com';
	$header['Subject']='Feed back from: '.$name.":".$subject;
	
	$recipient='thanhnguyen.yongkoo@gmail.com';
	$body=$content."\n"."Sincerely !\n".$name."\n".$sender;
	$result=$mailer->send($recipient,$header,$body);
	if(PEAR::isError($result))
	{
		$error='Error sending mail: '.$result->getMessage();
		echo htmlspecialchars($error);
		return false;
	}
	return true;
}
?>