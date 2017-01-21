<!DOCTYPE html>
<html lang="en">
<head>
  <?php  
    include 'view/style_head.php';
  ?>
    <link href="css/new-product.css" rel="stylesheet">
    <title>Chi tiết sản phẩm - Quản lý</title>

</head><!--/head-->

<body>
    <?php include 'view/header.php';?>
        
    <div class='container'>
        <div class='panel panel-primary dialog-panel'>
          <div class='panel-heading'>
            <h4 style="text-align:center">Chi tiết sản phẩm</h4>
          </div>          
          
          <div class='panel-body'>
            <div class='form-horizontal'>
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="ProductID">Mã sản phẩm</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="ProductID" name="ProductID" type="text" value="<?php echo $Product['ProductID']; ?>"  >
                    </div>
                  </div>
                </div>
              </div>
                  
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Name">Tên sản phẩm</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Name" name="Name" value="<?php echo $Product['ProductName']; ?>" >
                    </div>
                  </div>
                </div>
              </div>
                  
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="CategoryName">Nhóm sản phẩm</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="CategoryName" name="CategoryName" value="<?php echo $Product['CategoryName']; ?>" >
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Time">Thời gian thêm</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                    <?php $Time   = date_parse_from_format('Y-m-d H:i:s', $Product['Time']); ?>
                      <input  type="text" class="form-control" id="Time" name="Time" value="<?php echo date('d/m/Y', mktime(0, 0, 0, $Time['month'], $Time['day'], $Time['year'])); ?>" >
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Price">Đơn giá</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Price" name="Price" value="<?php echo number_format($Product['Price']) . ' VNĐ'; ?>" >
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Quantity">Số lượng còn lại</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Quantity" name="Quantity" value="<?php echo number_format($Product['Quantity']); ?>" >
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Unit">Đơn vị</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Unit" name="Unit" value="<?php echo $Product['Unit']; ?>" >
                    </div>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Description">Mô tả sản phẩm</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                        <textarea class="form-control" id="description" type="text" style="width:500px; height: 200px;" name="description" ><?php echo $Product['Description']; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>


               <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Color">Màu sắc</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Color" name="Color" value="<?php echo $Product['Color']; ?>" >
                    </div>
                  </div>
                </div>
              </div>

                 <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Keyword">Từ khoá sản phẩm</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Keyword" name="Keyword" value="<?php echo $Product['Keyword']; ?>" >
                    </div>
                  </div>
                </div>
              </div>

            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Active">Đang hoạt động</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Active" name="Active" value="<?php echo $Product['Active']; ?>" >
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Hide">Đã ẩn</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Hide" name="Hide" value="<?php echo $Product['Hide']; ?>" >
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="Home">Hiển thị trên trang chủ</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="Home" name="Home" value="<?php echo $Product['Home']; ?>" >
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="UpdatedBy">Cập nhật bởi</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="UpdatedBy" name="UpdatedBy" value="<?php echo $Product['UpdatedBy']; ?>" >
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="LastTime">Lần cập nhật cuối</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                    <?php $LastTime   = date_parse_from_format('Y-m-d H:i:s', $Product['LastTime']); ?>
                      <input  type="text" class="form-control" id="LastTime" name="LastTime" value="<?php echo date('H:i:s - d/m/Y', mktime($LastTime['hour'], $LastTime['minute'], $LastTime['second'], $LastTime['month'], $LastTime['day'], $LastTime['year'])); ?>" >
                    </div>
                  </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="LastTime">Hình ảnh</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <img src="../<?php echo trim($Product['LinkImage']);?>" alt="" width="300px">
                    </div>
                  </div>
                </div>
            </div>

            
            <a href="admin-dashboard.php"><button class='btn btn-danger center-block'>Quay lại</button></a>
            </div>
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
