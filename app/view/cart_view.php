<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "style_head.php";
  ?>

  <title>Giỏ hàng</title>

</head><!--/head-->

<body>

    <?php
        include "header.php";
    ?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
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
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					   foreach ($_SESSION['cart'] as $ProductID => $product): 
                            $numProductMax = ProductDB::getProductsByKey(array('ProductID'=>$ProductID));
                            $numProductMax  = $numProductMax[0]['Quantity'];
				   ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="../<?php echo trim($product['Image']);?>" alt="" width="100px"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $product['Name'];?></a></h4>
								<p>Mã sản phẩm: <?php echo $ProductID;?></p>
							</td>
							<td class="cart_price">
								<p><?php    echo number_format($product['Price']);?> VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_down" <?php if ($product['Quantity'] > 1):?>href="cart.php?action=update&ProductID=<?php echo $ProductID; ?>&Quantity=<?php echo ($product['Quantity'] - 1);?>"<?php endif;?>> - </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo number_format($product['Quantity']);?>" autocomplete="off" size="2">
									<a class="cart_quantity_up" <?php if ($product['Quantity'] < $numProductMax):?>href="cart.php?action=update&ProductID=<?php echo $ProductID; ?>&Quantity=<?php echo ($product['Quantity'] + 1);?>"<?php endif;?>> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo number_format($product['Total']);?> VNĐ</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="cart.php?action=delete&ProductID=<?php echo $ProductID; ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                    <?php endforeach;?>
					</tbody>
				</table>
                <div style="text-align: right">
                  <a class="btn btn-default update" href="./checkout.php">Tiếp tục</a>
                </div>
				<?php endif;?>
			</div>
		</div>
	</section> <!--/#cart_items-->

    <?php include "footer.php";?>	


</body>
</html>
