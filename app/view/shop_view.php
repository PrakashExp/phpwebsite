<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "style_head.php";
  ?>

  <title>Cửa hàng</title>
</head><!--/head-->

<body>
    <?php
        include "header.php";
    ?>
	<section id="advertisement">
		<div class="container">
			<!-- <img src="images/shop/advertisement.jpg" alt="" /> -->
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
            <?php
                include "category_bar.php";   
            ?>				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php 
    						if (count($Products) == 0){
    						    echo 'Dữ liệu đang cập nhật!';
    						} else {
                                $paginator->show(@$_GET['category']);
                                echo '<br />';
                                
                                foreach ($Products as $value):
                        ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo '../' . $value['LinkImage']; ?>" alt="" />
										<h2><?php echo number_format($value['Price']);?></h2>
										<p><b><?php echo $value['ProductName'];?></b></p>
										<p><?php echo $value['CategoryName'];?></p>
<!-- 										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> -->
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
    										<a href="product-detail.php?ProductID=<?php echo $value['ProductID'];?>" class="btn btn-default add-to-cart">Chi tiết sản phẩm</a>
											<h2><?php echo number_format($value['Price']) . ' VNĐ';?></h2>
											<p><b><?php echo $value['ProductName'];?></b></p>
											<p><?php echo $value['ProductID'];?></p>
                      <a href="cart.php?action=add&ProductID=<?php echo $value['ProductID']; ?>&Quantity=1" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php 
                                endforeach;
                        ?>
					</div><!--features_items-->
    					<?php
                                $paginator->show(@$_GET['category']);
    						}
    					?>
				</div>
			</div>
		</div>
	</section>
	
    <?php include "footer.php";?>


</body>
</html>
