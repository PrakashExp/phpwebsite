<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "style_head.php";
  ?>

  <title>Đăng nhập</title>      

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
    <?php
        include "header.php";
    ?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form  method="post" action="login.php?action=login">
							<input type="text" id="" name="Username" placeholder="Tên đăng nhập" />
							<input type="password" id="" name="Password" placeholder="Mật khẩu" />
							<span>
								<p><input type="checkbox" id="" name="Remember" class="checkbox" value="Remember"> Ghi nhớ</p>
                                <a href="../app/forgotpassword.php">Quên mật khẩu</a>
							</span>
							<button type="submit" id="" name="Login" class="btn btn-default">Đăng nhập</button>
						</form>
                     
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản</h2>
						<form method="post" action="../app/register.php">
							<input type="text" id="Username" name="Username" placeholder="Tên đăng nhập" />
							<div id="UsernameErr"></div>
							<input type="password" id="Password" name="Password" placeholder="Mật khẩu"/>
							<div id="PasswordErr"></div>
							<input type="password" id="PasswordRetype" name="PasswordRetype" placeholder="Nhập lại Mật khẩu"/>
							<button type="submit" name="Register" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
    <?php include "footer.php";?>
	 

</body>
</html>
