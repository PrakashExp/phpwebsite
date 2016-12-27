<?php
	session_start();
    /*session_start();
    
    if (isset($_SESSION['User'])){
        header('location: ./index.php');
    }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta id="" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id="" name="description" content="">
    <meta id="" name="author" content="">
    <title>Register | E-Shopper</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="./css/animate.css" rel="stylesheet">
	<link href="./css/main.css" rel="stylesheet">
	<link href="./css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       

    <link rel="shortcut icon" href="./images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="./css/jquery-ui.css">

    <script src="./js/jquery-1.12.4.js"></script>
    <script src="./js/jquery-ui.js"></script>

    <script>
    $(document).ready(function() {
		$("#Username").blur(function(){
			$giatri=this.value;
			$("#UsernameErr").load("../api/ajax/checkInput.php", "type=Username&Username="+ this.value);
		});
		
		$("#Password").blur(function(){
			$giatri=this.value;
			$("#PasswordErr").load("../api/ajax/checkInput.php", "type=Password&Password="+ this.value);
		});
		
		$("#IDCard").blur(function(){
			$giatri=this.value;
			$("#IDCardErr").load("../api/ajax/checkInput.php", "type=IDCard&IDCard="+ this.value);
		});
				
		$("#Email").blur(function(){
			$giatri=this.value;
			$("#EmailErr").load("../api/ajax/checkInput.php", "type=Email&Email="+ this.value);   
		});
    });
    
    $( function() {
        $("#Birthday").datepicker(
        {
        	dateFormat: "dd/mm/yy",
        	yearRange: "1990:2070",
        	changeMonth: true,
        	changeYear: true,
        	monthNames: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
        	monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          	dayNames: [ "Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy" ],
          	dayNamesMin: [ "CN", "T2", "T3", "T4", "T5", "T6", "T7" ]
        });
    } );
    </script>
</head><!--/head-->

<body>
     <?php include "header.php";?>
   
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-sm-offset-1">

				</div>
				<div class="col-sm-1">
				</div>
				<div class="col-sm-5">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản Nhân viên</h2>
						<form method="post" action="../api/controller/register.php">
                        <input type="hidden" name="GroupId" value="4" />
							<input type="text" id="Username" name="Username" placeholder="Tên đăng nhập" value=""/>
							<div id="UsernameErr"></div>
                            <select name="Sex">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                            </select>
                            <br>
                            <br>
							<input type="password" id="Password" placeholder="Mật khẩu" name="Password" value="" />
							<div id="PasswordErr"></div>
							<input type="password" id="PasswordRetype" placeholder="Nhập lại mật khẩu" name="PasswordRetype"value="" />
							<input type="text" id="Name" name="Name" placeholder="Họ tên" />
							<input type="text" id="Birthday" name="Birthday" placeholder="Ngày sinh" readonly value="<?php echo @$Birthday;?>" /> 
							<input type="text" id="IDCard" name="IDCard" placeholder="Số CMND/Hộ chiếu" value="<?php echo @$IDCard;?>" />
							<div id="IDCardErr"></div>
							<input type="text" id="Address" name="Address" placeholder="Địa chỉ" value="<?php echo @$Address;?>" />
							<input type="text" id="TelNumber" name="TelNumber" placeholder="Số điện thoại" value="<?php echo @$TelNumber;?>" />
							<input type="email" id="Email" name="Email" placeholder="Email" value="<?php echo @$Email;?>" />
							<div id="EmailErr"></div>
							<button type="submit" name="Register" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
  
    <?php include "footer.php";?>
	 
<!--     <script src="js/jquery.js"></script> -->
	<script src="./js/price-range.js"></script>
    <script src="./js/jquery.scrollUp.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>
