<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "view/style_head.php";
  ?>

  <title>Trang chủ</title>
</head><!--/head-->

<body>
    <?php 
        require_once 'header.php';
        require_once '../api/model/Pagination.php';
        require_once '../api/model/database.php';
        require_once '../api/model/slideshow_db.php';
        require_once '../api/model/product_db.php';
        require_once '../api/model/functions.php';
    ?>
    
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
    						<div class="item active" style="height: 300px;">
								<div class="col-sm-6">
                  <h1>Website Bán Hoa Điện Tử</h1>
                  <h2>Công nghệ Web và ứng dụng</h2>
                  <h2>Lớp: SE341.H11</h2>
									
									<a href="./shop.php" class="btn btn-default get">Xem ngay</a>
								</div>
								<div class="col-sm-6">
									<img src="" class="girl img-responsive" alt="" />
									<img src="images/home/Theme-Flower.jpg"  class="pricing" alt="" width="50%"  />
								</div>
							</div>
							<?php 
                                $SlideShow  = new SlideShowDB();
                                $result = $SlideShow->getSlideShowsByKey();
                                
                                foreach ($result as $slide) :
							?>
							<div class="item" style="height: 300px">
								<div class="col-sm-6">
									<h1><?php echo $slide['Title']; ?></h1>
									<!-- <h2>100% Responsive Design</h2> -->
									<p><?php echo $slide['Description']; ?></p>
									<a href="./<?php echo $slide['Link']; ?>"><button type="button" class="btn btn-default get">Xem ngay</button></a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo $slide['LinkImage']; ?>" class="girl img-responsive" alt="" />
                                <!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
            <?php
              include "category_bar.php";   
            ?>								
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Một số sản phẩm mẫu</h2>
						<?php 
    						$numberItemsPerPage = 12;
    						$currentPage        = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
    						$pageRange          = 5;
    						
    						$db = Database::getDB();
    						
    						//Lấy sản phẩm cho phân trang hiện tại.
    						$Products   = ProductDB::getProductsPagination($currentPage, $numberItemsPerPage, array('Home'=>'1'), 'Name');

    						if (count($Products) == 0){
    						    echo 'Dữ liệu đang cập nhật!';
    						} else {
        						$result   = ProductDB::getProductsHome('Name');
        						$totalProducts      = count($result) - 1;

                                $paginator  = new Pagination($totalProducts, $numberItemsPerPage, $currentPage, $pageRange);
                                $paginator->show();
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

							</div>
						</div>
						<?php 
        						endforeach;
    						}
						?>
                  </div>					
                  <?php $paginator->show(); ?>
					<!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Mua nhiều nhất</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">							            

								<?php
    								$product=ProductDB::getMostSellingProducts();
    								foreach ($product as $key=>$chunk): 
                                        if($key == 0)
                                           echo "<div class='item active'>";
                                        else
                                           echo "<div class='item'>";
        								
        								$product=$chunk;
        								foreach ($product as $value):
								?>
    								<div class="col-sm-4">
            							<div class="product-image-wrapper">
            								<div class="single-products">
            									<div class="productinfo text-center">
            										<img src="<?php echo '../' . $value['LinkImage']; ?>" alt="" />
            										<h2><?php echo number_format($value['Price']);?></h2>
            										<p><b><?php echo $value['ProductName'];?></b></p>
            										<p><?php echo $value['CategoryName'];?></p>
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
            							</div>
            						</div>
										<?php endforeach; ?>
								  </div>
								<?php endforeach; ?>
				
							</div>
					
						
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
				    
				    </div>	
				</div>
			</div>
		</div>
	</section>
	
    <?php include "footer.php";?>
  
	<script src="js/price-range.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
