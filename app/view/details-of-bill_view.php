<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "style_head.php";
  ?>
    <link href="css/new-product.css" rel="stylesheet">
    <title>Thêm sản phẩm</title>

</head><!--/head-->
<?php
require_once "../api/model/bill_db.php";
?>
<body>
    <?php include "header.php";?>

    <?php
      
    ?>

    <div class='container'>
        <div class='panel panel-primary dialog-panel'>
          <div class='panel-heading'>
            <h4 style="text-align:center">Thêm sản phẩm</h4>
          </div>
          <div class='panel-body'>

          <?php 
          if (empty($getUserIDFromAdmin))

            $BillInf=BillDB::getBillInfosByBillID($_SESSION['User']['UserID'], $billID);
          else  // not empty
            $BillInf=BillDB::getBillInfosByBillID($getUserIDFromAdmin, $billID);            
          ?> 
          <!-- Hien thong tin Don hang-->
            <form class='form-horizontal' role='form' action="#" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="productName">Mã hóa đơn</label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input class="form-control" id="productName" name="productName" type="text"  required="required"   required="required"  value="<?php echo $billID?>" disabled >
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="category">Mã nhân viên</label>
                <div class="col-md-2">
                   <input class="form-control" id="productName" name="productName" type="text"  required="required"   required="required"  value="<?php echo $BillInf[0]['EmployeeID']; ?> " disabled>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Tên nhân viên </label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color"  required="required"  value="<?php echo $BillInf[0]['EmployeeName']; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-md-offset-2" for="color">Ngày đặt hàng </label>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <input  type="text" class="form-control" id="color" name="color"  required="required"  value="<?php echo $BillInf[0]['Time']; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
          <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Sản phẩm</td>
              <td class="description"></td>
              <td class="price">Giá</td>
              <td class="quantity">Số lượng</td>
              <td class="total">Tổng</td>
            </tr>
          </thead>
          <tbody>
          <!-- tinh tong tien-->
          <?php
            $totalPrice=0;
            foreach ($BillInf as $ProductID => $product):
                $totalPrice=$totalPrice+($product['Price'] * $product['Quantity']);?>
          <?php endforeach;?>


      <!-- Hien thong tin san pham-->
             <?php 
             foreach ($BillInf as $ProductID => $product): ?>
            <tr>
              <td class="cart_product">
                <a href=""><img src="../<?php echo trim($product['Image']);?>" alt="" width="100px"></a>
              </td>
              <td class="cart_description">
                <h4><a href=""><?php echo $product['Name'];?></a></h4>
                <p>Mã sản phẩm: <?php echo $ProductID;?></p>
              </td>
              <td class="cart_price">
                <p><?php    echo number_format($product['Price']); ?></p>
              </td>
              <td class="cart_quantity">
                <p class="cart_quantity"><?php echo number_format($product['Quantity']);?></p>
                </div>
              </td>
              <td class="cart_quantity">
                <p class="cart_quantity"><?php echo number_format($product['Quantity']*$product['Price']);?></p>
                </div>
              </td>
            </tr>   
            <?php endforeach; ?>      
            </tbody>
            </table>
    
    <!-- Hien thong tin san pham-->
            <tr>
              <td colspan="4">&nbsp;</td>
              <td colspan="2">
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Tổng đơn hàng</td>
                    <td><?php echo number_format($totalPrice); ?> VNĐ</td>
                  </tr>
                  <tr>
                    <td>Thuế (10% VAT)</td>
                    <td><?php echo number_format($totalPrice*0.1); ?></td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Hình thức</td>
                    <td>Thu tại nhà</td>                    
                  </tr>
                  <tr class="shipping-cost">
                    <td>Tiền vận chuyển</td>
                    <td>Miễn phí</td>                   
                  </tr>
                  <tr>
                    <td>Tổng cộng</td>
                    <td><span><?php echo number_format($totalPrice*1.1); ?> VNĐ</span></td>
                  </tr>

                </table>
              </td>
            </tr>

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
