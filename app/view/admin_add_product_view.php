<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "style_head.php";
  ?>
    <link href="css/new-product.css" rel="stylesheet">
    <title>Thêm sản phẩm</title>

</head><!--/head-->

<body>
    <?php include "header.php";?>
    <div class='container'>
        <div class='panel panel-primary dialog-panel'>
          <div class='panel-heading'>
            <h4 style="text-align:center">Thêm sản phẩm</h4>
          </div>
          <div class='panel-body'>
            <form class='form-horizontal' role='form' action="#" method="POST" enctype="multipart/form-data">
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="productName">Tên sản phẩm *</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="productName" name="productName" type="text"  required="required"   required="required"  value="<?php echo @$ProductName; ?>">
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="category">Loại hoa *</label>
                <div class="col-md-2">
                  <select class="form-control" id="category" name="category">
                    <?php foreach ($CategoryList as $item):?>
                      <option  required="required"  value="<?php echo $item["CategoryID"]; ?>" <?php echo (($item["CategoryID"] == @$CategoryID) ? "selected=\"selected\"" : ""); ?>>
                        <?php echo $item["CategoryName"];?>
                      </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Màu sắc *</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color"  required="required"  value="<?php echo @$Color; ?>">
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="unit">Đơn vị *</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="unit" name="unit"  required="required"  value="<?php echo @$Unit; ?>">
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="quantity">Số lượng *</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input class="form-control" id="quantity" type="number" min="1" name="quantity"  required="required"  value="<?php echo @$Quantity; ?>" />
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="price">Giá thành *</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input class="form-control" id="price" type="number" min="50000" name="price"  required="required"  value="<?php echo @$Price; ?>" />
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="keyword">Từ khóa</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="keyword" type="text" name="keyword" value="<?php echo @$Keyword; ?>" />
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="description">Mô tả sản phẩm *</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <textarea class="form-control" id="description" type="text" style="width:500px" name="description" /><?php echo @$Description; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="hide">Ẩn</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input id="hide" type="checkbox" name="hide" <?php echo (@$Hide == 1) ? 'checked="checked"' : ''; ?> />
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="active">Kích hoạt</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input id="active" type="checkbox" name="active" <?php echo (@$Active == 1) ? 'checked="checked"' : ''; ?> />
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="home">Trang chủ</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input id="home" type="checkbox" name="home" <?php echo (@$Home == 1) ? 'checked="checked"' : ''; ?> />
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="picture">Hình ảnh</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-4">
                      <input id="picture" type="file" name="picture"/>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <div class="col-md-offset-4 col-md-3">
                  <button type="submit" name="add" class="btn btn-success">Thêm sản phẩm</button>
                  <button type="reset" name="reset" class="btn btn-success btn-responsive">Nhập lại</button>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-4 col-md-3">
                  <a href="admin-dashboard.php" class="btn btn-danger">Quay lai</a>
                </div>
              </div>
                   
            </form>
          </div>
        </div>
    </div>

    <?php include "footer.php";?>
	
  <script>
   var js_data = '<?php echo json_encode($ProductsList); ?>';
   console.log(JSON.stringify(js_data));
//   var js_obj_data = JSON.parse(js_data);
//   console.log(JSON.stringify(js_obj_data))
  </script>

  
</body>
</html>
