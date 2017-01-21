<?php
require_once"../../api/controller/mail.php";
if(isset($_POST['submit_feed_back']))
{
	$sender=$_POST['email'];
	$name=$_POST['name'];
	$subject=$_POST['subject'];
	$content=$_POST['message'];
	$feedback=sendFeedBack($sender,$content,$name,$subject);
	echo "<script>alert('Cảm ơn bạn đã đóng góp ý kiến ! Chúng tôi trân trọng những ý kiến đóng góp của bạn!');</script>";
	echo "<meta http-equiv='refresh' content='0;url=../../app/index.php'>";		
}
?>