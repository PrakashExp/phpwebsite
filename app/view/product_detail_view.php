<!DOCTYPE html>
<html lang="en">
<head>
  <?php
      include "style_head.php";
  ?>

  <title>Chi tiết sản phẩm</title>
</head><!--/head-->

<body>
    <?php include "header.php";?>
	<section>
		<div class="container">
			<div class="row">
            <?php
                include "category_bar.php";   
            ?>								
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="../<?php echo $productItem['LinkImage'];?>" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $productItem['ProductName'];?></h2>
								<p>Mã sản phẩm: <?php echo $productItem['ProductID'];?></p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>VNĐ: <?php echo number_format($productItem['Price']);?></span>
									<label>Số lượng:</label>
									<input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										<a href="cart.php?action=add&ProductID=<?php echo $productItem['ProductID']; ?>&Quantity=1" >Thêm vào giỏ hàng</a>
									</button>
								</span>
								<p><b>Tình trạng sản phẩm: </b>Còn <?php echo $productItem['Quantity'];?></p>
								<p><b>Đơn vị: </b><?php echo $productItem['Unit'];?></p>
								<p><b>Màu sắc: </b><?php echo $productItem['Color'];?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<!-- <li><a href="#companyprofile" data-toggle="tab">Thông tin xuất xứ</a></li> -->
								<!-- <li><a href="#reviews" data-toggle="tab">Nhận xét</a></li> -->
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
                                <div class="col-sm-12">
									<p><?php echo $productItem['Description'];?></p>
								</div>		
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>ABC</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Code này để hiển thị cái j z -->
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <!-- ================ -->
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
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
								?>
								  
									<?php
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
					
				</div>
			</div>
		</div>
	</section>
	
    <?php include "footer.php";?>

</body>
</html>
