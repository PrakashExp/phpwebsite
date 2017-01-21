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
		
	<div class='container'>
        <div class='panel panel-primary dialog-panel'>
          <div class='panel-heading'>
            <h4 style="text-align:center">Thông tin cá nhân</h4>
          </div>
          <div class='panel-body'>
            <form class='form-horizontal' role='form' action="./profile.php?action=update" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="UserID">Mã người dùng</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="UserID" name="UserID" type="text" value="<?php echo $UserID; ?>" disabled >
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Name">Họ và tên</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Name" name="Name" value="<?php echo $Name; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Sex">Giới tính</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Sex" name="Sex" value="<?php echo $Sex; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Birthday">Ngày sinh </label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Birthday" name="Birthday" value="<?php echo $Birthday; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="IDCard">CMND</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="IDCard" name="IDCard" value="<?php echo $IDCard; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Address">Địa chỉ</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Address" name="Address" value="<?php echo $Address; ?>">
                    </div>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="TelNumber">Số điện thoại</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="TelNumber" name="TelNumber" value="<?php echo $TelNumber; ?>">
                    </div>
                  </div>
                </div>
              </div>


               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Email">Email</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

                 <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Active">Trạng thái hoạt động</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Active" name="Active" value="<?php echo (($Active == 1) ? 'Đang hoạt động' : 'Đã tạm ngưng hoạt động'); ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="TypeUser">Nhóm người dùng</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="TypeUser" name="TypeUser" value="<?php echo $TypeUser; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
              
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Username">Tên tài khoản</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="Username" name="Username" type="text" value="<?php echo $Username; ?> " disabled>
                    </div>
                  </div>
                </div>
              </div>
              
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="OldPassword">Mật khẩu</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="OldPassword" name="OldPassword" style="margin-bottom: 10px" type="password" placeholder='Mật khẩu cũ' />
                      <input class="form-control" id="NewPassword" name="NewPassword" style="margin-bottom: 10px" type="password" placeholder='Mật khẩu mới' />
                      <input class="form-control" id="NewPasswordRetype" name="NewPasswordRetype" style="margin-bottom: 10px" type="password" placeholder='Nhập lại mật khẩu mới' />
                    </div>
                  </div>
                </div>
            </div>
            
            <button type='submit' name='UpdateProfile' class='btn btn-default center-block'>Cập nhật</button>
        </form>

          </div>
        </div>
    </div>
	
    <?php include "footer.php";?>
	

</body>
</html>