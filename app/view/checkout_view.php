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

	  <!-- <section id="do_action"> -->
	  <!-- 	<div class="container"> -->
		<!-- <div class="heading"> -->
		<!-- 	<h3>What would you like to do next?</h3> -->
		<!-- 	<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p> -->
		<!-- </div> -->
		<!-- <div class="row"> -->
		<!-- <div class="col-sm-6"> -->
		<!-- 	<div class="chose_area"> -->
		<!-- 		<ul class="user_option"> -->
		<!-- 			<li> -->
		<!-- 				<input type="checkbox"> -->
		<!-- 				<label>Use Coupon Code</label> -->
		<!-- 			</li> -->
		<!-- 			<li> -->
		<!-- 				<input type="checkbox"> -->
		<!-- 				<label>Use Gift Voucher</label> -->
		<!-- 			</li> -->
		<!-- 			<li> -->
		<!-- 				<input type="checkbox"> -->
		<!-- 				<label>Estimate Shipping & Taxes</label> -->
		<!-- 			</li> -->
		<!-- 		</ul> -->
		<!-- 		<ul class="user_info"> -->
		<!-- 			<li class="single_field"> -->
		<!-- 				<label>Country:</label> -->
		<!-- 				<select> -->
		<!-- 					<option>United States</option> -->
		<!-- 					<option>Bangladesh</option> -->
		<!-- 					<option>UK</option> -->
		<!-- 					<option>India</option> -->
		<!-- 					<option>Pakistan</option> -->
		<!-- 					<option>Ucrane</option> -->
		<!-- 					<option>Canada</option> -->
		<!-- 					<option>Dubai</option> -->
		<!-- 				</select> -->
		
		<!-- 			</li> -->
		<!-- 			<li class="single_field"> -->
		<!-- 				<label>Region / State:</label> -->
		<!-- 				<select> -->
		<!-- 					<option>Select</option> -->
		<!-- 					<option>Dhaka</option> -->
		<!-- 					<option>London</option> -->
		<!-- 					<option>Dillih</option> -->
		<!-- 					<option>Lahore</option> -->
		<!-- 					<option>Alaska</option> -->
		<!-- 					<option>Canada</option> -->
		<!-- 					<option>Dubai</option> -->
		<!-- 				</select> -->
		
		<!-- 			</li> -->
		<!-- 			<li class="single_field zip-field"> -->
		<!-- 				<label>Zip Code:</label> -->
		<!-- 				<input type="text"> -->
		<!-- 			</li> -->
		<!-- 		</ul> -->
		<!-- 		<a class="btn btn-default update" href="">Get Quotes</a> -->
		<!-- 		<a class="btn btn-default check_out" href="">Continue</a> -->
		<!-- 	</div> -->
		<!-- </div> -->

		<!-- <div class="col-sm-6"> -->
		<!-- 	<div class="total_area"> -->
		<!-- 		<ul> -->
		<!-- 			<li>Cart Sub Total <span><?php echo number_format($totalPrice); ?></span></li> -->
		<!-- 			<li>Eco Tax <span>$2</span></li> -->
		<!-- 			<li>Shipping Cost <span>Free</span></li> -->
		<!-- 			<li>Total <span><?php echo number_format($totalPrice+2); ?></span></li> -->
		<!-- 		</ul> -->
		<!-- 			<a class="btn btn-default update" href="">Update</a> -->
		<!-- 			<a class="btn btn-default check_out" href="../app/bill.php">Buy</a> -->
		<!-- 	</div> -->
		<!-- </div> -->
		<!-- </div> -->
		<!-- </div> -->
	  <!-- </section> --><!--/#do_action-->

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
			  <!-- <div class="breadcrumbs"> -->
			  <!-- 	<ol class="breadcrumb"> -->
			  <!-- 	  <li><a href="#">Home</a></li> -->
			  <!-- 	  <li class="active">Check out</li> -->
			  <!-- 	</ol> -->
			  <!-- </div><\!--/breadcrums-\-> -->

			  <!-- <div class="step-one"> -->
			  <!-- 	<h2 class="heading">Step1</h2> -->
			  <!-- </div> -->
			  <!-- <div class="checkout-options"> -->
			  <!-- 	<h3>New User</h3> -->
			  <!-- 	<p>Checkout options</p> -->
			  <!-- 	<ul class="nav"> -->
			  <!-- 		<li> -->
			  <!-- 			<label><input type="checkbox"> Register Account</label> -->
			  <!-- 		</li> -->
			  <!-- 		<li> -->
			  <!-- 			<label><input type="checkbox"> Guest Checkout</label> -->
			  <!-- 		</li> -->
			  <!-- 		<li> -->
			  <!-- 			<a href=""><i class="fa fa-times"></i>Cancel</a> -->
			  <!-- 		</li> -->
			  <!-- 	</ul> -->
			  <!-- </div><\!--/checkout-options-\-> -->

			  <!-- <div class="register-req"> -->
			  <!-- 	<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p> -->
			  <!-- </div><\!--/register-req-\-> -->

			  <div class="shopper-informations">
				  <div class="row">
					  <!-- <div class="col-sm-3"> -->
					  <!-- 	<div class="shopper-info"> -->
					  <!-- 		<p>Shopper Information</p> -->
					  <!-- 		<form> -->
					  <!-- 			<input type="text" placeholder="Display Name"> -->
					  <!-- 			<input type="text" placeholder="User Name"> -->
					  <!-- 			<input type="password" placeholder="Password"> -->
					  <!-- 			<input type="password" placeholder="Confirm password"> -->
					  <!-- 		</form> -->
					  <!-- 		<a class="btn btn-primary" href="">Get Quotes</a> -->
					  <!-- 		<a class="btn btn-primary" href="">Continue</a> -->
					  <!-- 	</div> -->
					  <!-- </div> -->
					  <!-- <div class="col-sm-5 clearfix"> -->
					  <!-- 	<div class="bill-to"> -->
					  <!-- 		<p>Bill To</p> -->
					  <!-- 		<div class="form-one"> -->
					  <!-- 			<form> -->
					  <!-- 				<input type="text" placeholder="Company Name"> -->
					  <!-- 				<input type="text" placeholder="Email*"> -->
					  <!-- 				<input type="text" placeholder="Title"> -->
					  <!-- 				<input type="text" placeholder="First Name *"> -->
					  <!-- 				<input type="text" placeholder="Middle Name"> -->
					  <!-- 				<input type="text" placeholder="Last Name *"> -->
					  <!-- 				<input type="text" placeholder="Address 1 *"> -->
					  <!-- 				<input type="text" placeholder="Address 2"> -->
					  <!-- 			</form> -->
					  <!-- 		</div> -->
					  <!-- 		<div class="form-two"> -->
					  <!-- 			<form> -->
					  <!-- 				<input type="text" placeholder="Zip / Postal Code *"> -->
					  <!-- 				<select> -->
					  <!-- 					<option>-- Country --</option> -->
					  <!-- 					<option>United States</option> -->
					  <!-- 					<option>Bangladesh</option> -->
					  <!-- 					<option>UK</option> -->
					  <!-- 					<option>India</option> -->
					  <!-- 					<option>Pakistan</option> -->
					  <!-- 					<option>Ucrane</option> -->
					  <!-- 					<option>Canada</option> -->
					  <!-- 					<option>Dubai</option> -->
					  <!-- 				</select> -->
					  <!-- 				<select> -->
					  <!-- 					<option>-- State / Province / Region --</option> -->
					  <!-- 					<option>United States</option> -->
					  <!-- 					<option>Bangladesh</option> -->
					  <!-- 					<option>UK</option> -->
					  <!-- 					<option>India</option> -->
					  <!-- 					<option>Pakistan</option> -->
					  <!-- 					<option>Ucrane</option> -->
					  <!-- 					<option>Canada</option> -->
					  <!-- 					<option>Dubai</option> -->
					  <!-- 				</select> -->
					  <!-- 				<input type="password" placeholder="Confirm password"> -->
					  <!-- 				<input type="text" placeholder="Phone *"> -->
					  <!-- 				<input type="text" placeholder="Mobile Phone"> -->
					  <!-- 				<input type="text" placeholder="Fax"> -->
					  <!-- 			</form> -->
					  <!-- 		</div> -->
					  <!-- 	</div> -->
					  <!-- </div> -->
					  <!-- <div class="col-sm-4"> -->
					  <!-- 	<div class="order-message"> -->
					  <!-- 		<p>Shipping Order</p> -->
					  <!-- 		<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea> -->
					  <!-- 		<label><input type="checkbox"> Shipping to bill address</label> -->
					  <!-- 	</div>	 -->
					  <!-- </div> -->					
				  </div>
			  </div>
			  <div class="review-payment">
				  <h2>Hóa đơn thanh toán</h2>
			  </div>
			  
			  <div class="table-responsive cart_info">
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
			<div class="payment-options">

        <a class="btn btn-default check_out pull-right" href="../app/bill.php">Thanh toán</a>                                    

			</div>
		</div>
	  </section> <!--/#cart_items-->
    <?php include "view/footer.php";?>
  </body>
</html>
