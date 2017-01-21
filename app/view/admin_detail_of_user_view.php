<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include 'view/style_head.php';
  ?>
    <link href="css/new-product.css" rel="stylesheet">
    <title>Chi tiết người dùng - Quản lý</title>

</head><!--/head-->

<body>
    <?php include 'view/header.php';?>

    <div class='container'>
        <div class='panel panel-primary dialog-panel'>
          <div class='panel-heading'>
            <h4 style="text-align:center">Thông tin người dùng</h4>
          </div>
          <div class='panel-body'>

          <!-- Hien thong tin Don hang-->
            <form class='form-horizontal' role='form' action="#" method="POST" enctype="multipart/form-data">


              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="productName">Mã người dùng</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="productName" name="productName" type="text" value="<?php echo $Profile['UserID']; ?>" disabled >
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="category">Tên tài khoản</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="productName" name="productName" type="text" value="<?php echo $Profile['Username']; ?> " disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Họ và tên</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo $Profile['Name']; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Giới tính</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo (($Profile['Sex'] == 1) ? 'Nam' : 'Nữ'); ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Ngày sinh</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                    <?php 
                        $Birthday   = date_parse_from_format('Y-m-d', $Profile['Birthday']);
                    ?>
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo date('d/m/Y', mktime(0, 0, 0, $Birthday['month'], $Birthday['day'], $Birthday['year'])); ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">CMND</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo $Profile['IDCard']; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Địa chỉ</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo $Profile['Address']; ?>">
                    </div>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Số điện thoại</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo $Profile['TelNumber']; ?>">
                    </div>
                  </div>
                </div>
              </div>


               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Email</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo $Profile['Email']; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

                 <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Trạng thái hoạt động</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo (($Profile['Active'] == 1) ? 'Đang hoạt động' : 'Đã tạm ngưng hoạt động'); ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Nhóm người dùng</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo $Profile['TypeUser']; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Doanh số</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color" value="<?php echo number_format($Profile['Revenue']) . ' VNĐ'; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>

            </form>

          </div>
        </div>
    </div>

    <?php include "view/footer.php";?>
	
  <script>
   var js_data = '<?php echo json_encode($ProductsList); ?>';
   console.log(JSON.stringify(js_data));
//   var js_obj_data = JSON.parse(js_data);
//   console.log(JSON.stringify(js_obj_data))
  </script>

  
</body>
</html>
