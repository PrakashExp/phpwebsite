<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include "style_head.php";
    ?>
    <title>Thanh toán</title>
  </head>
  <body>
    <?php include "view/header.php";?>

    <!--Tinh tong so tien trong danh sach san pham $product -->
    <?php if (count(@$_SESSION['cart']) > 0):?>
      <?php
		  $totalPrice=0;
		  foreach ($_SESSION['cart'] as $ProductID => $product):
					        $totalPrice=$totalPrice+($product['Price'] * $product['Quantity']);?>
      <?php endforeach;?>
    <?php endif; ?>
    <?php if (count(@$_SESSION['cart']) == 0) $totalPrice=0; ?>

	  <section id="cart_items">
		  <div class="container">
			  <div class="review-payment">
				  <h2>Hóa đơn thanh toán</h2>
			  </div>
			  
			  <div class="table-responsive cart_info">
              <form method="post" action="bill.php">
          <?php if (count(@$_SESSION['cart']) > 0):?>
                  
				    <table class="table table-condensed">
					    <thead>
						    <tr class="cart_menu">
							    <td class="image">Sản phẩm</td>
							    <td class="description"></td>
							    <td class="price">Giá</td>
							    <td class="quantity">Số lượng</td>
							    <td class="total">Tổng</td>
							    <td class="total">Hủy</td>
						    </tr>
					    </thead>
					    <tbody>
                <?php
					      foreach ($_SESSION['cart'] as $ProductID => $product): ?>
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
							      <td class="cart_total">
								      <p class="cart_total_price"><?php echo number_format($product['Total']);?></p>
							      </td>
							      <td class="cart_delete">
								      <a class="cart_quantity_delete" href="cart.php?action=delete&ProductID=<?php echo $ProductID; ?>"><i class="fa fa-times"></i></a>
							      </td>
						      </tr>					
                <?php endforeach;?>
                
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
                
					    </tbody>
				    </table>
                  <?php endif;?>
    			</div>
    			
      			<div class="form-group">
                    <label class="control-label col-md-2 col-md-offset-2" for="Address">Địa chỉ giao hàng</label><br>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="col-md-7">
                          <textarea class="form-control" id="Address" name="Address" type="text" style="width:500px; height: 100px;"  placeholder="Địa chỉ giao hàng" required></textarea>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="form-group">
                <div class="col-md-offset-4 col-md-3">
                    <button type="submit"  class="btn btn-success check_out pull-right" >Thanh toán</button>
                </div>
              </div>
            </form>                         
		</div>
	  </section> <!--/#cart_items-->
    <?php include "view/footer.php";?>
  </body>
</html>
