<?php
    session_start();
    
    if (isset($_SESSION['User'])){
        header('location: ./index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta id="" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id="" name="description" content="">
    <meta id="" name="author" content="">
    <title>Forgot Password ? | E-Shopper</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/prettyPhoto.css" rel="stylesheet">
    <link href="./css/price-range.css" rel="stylesheet">
    <link href="./css/animate.css" rel="stylesheet">
	<link href="./css/main.css" rel="stylesheet">
	<link href="./css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="./images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="./js/jquery-1.12.4.js"></script>
    <script src="./js/jquery-ui.js"></script>

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
						<h2>Quên mật khẩu ?</h2>
						<form method="post" action="../api/controller/forgotpassword.php">
							<input type="text" name="Username" placeholder="Tên đăng nhập" />
							<!--<input type="email" id="Email" name = "Email" placeholder="Địa chỉ mail của tài khoản"/>-->
							<button type="submit" name="submit_get_pass" class="btn btn-default">Get Password Back</button>
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
