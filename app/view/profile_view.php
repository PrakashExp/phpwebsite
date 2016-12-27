<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "style_head.php";
  ?>

  <title>Thông tin người dùng</title>
</head><!--/head-->
<body>	
    <?php
        include "header.php";
    ?>
	<section id="form">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="signup-form">
						<h2 style="text-align:center">Thông tin cá nhân</h2>
						<form action="./profile.php?action=update" method="post">
                        Họ tên<input type="text" name="Name" value="<?php echo $Name; ?>" placeholder="Họ tên" readonly="readonly" />
                        Giới tính<input type="text" name="Sex" value="<?php echo $Sex; ?>" placeholder="Giới tính" readonly="readonly" />
                        Địa chỉ<input type="text" name="Address" value="<?php echo $Address; ?>" placeholder="Địa chỉ" />
                        Số CMND<input type="text" name="IDCard" value="<?php echo $IDCard; ?>" placeholder="CMND/Hộ chiếu" readonly="readonly" />
                        Ngày sinh<input type="datetime" name="Birthday" value="<?php echo $Birthday; ?>" placeholder="Ngày sinh" readonly="readonly" />
                        Số điện thoại<input type="tel" name="TelNumber" value="<?php echo $TelNumber; ?>" placeholder="Số điện thoại" />
                        Email<input type='email' name='Email' value="<?php echo $Email; ?>" placeholder='Địa chỉ Email' readonly="readonly" />
                        Tên đăng nhập<input type='text' name='Username' value="<?php echo $Username; ?>" placeholder='Tên đăng nhập' readonly="readonly" />
                        Mật khẩu<input type='password' name='OldPassword' placeholder='Mật khẩu cũ'/>
                        <input type='password' name='NewPassword' placeholder='Mật khẩu mới'/>
                        <input type='password' name='NewPasswordRetype' placeholder='Nhập lại mật khẩu mới'/>
                        <button type='submit' name='UpdateProfile' class='btn btn-default center-block'>Cập nhật</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
    <?php include "footer.php";?>
	

</body>
</html>