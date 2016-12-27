<header id="header"><!--header-->
	<!-- <div class="header_top"><\!--header_top-\-> -->
	<!-- 	<div class="container"> -->
	<!-- 		<div class="row"> -->
	<!-- 			<div class="col-sm-6"> -->
	<!-- 				<div class="contactinfo"> -->
	<!-- 					<ul class="nav nav-pills"> -->
	<!-- 						<li><a href="#"><i class="fa fa-phone"></i> +84 123456789</a></li> -->
	<!-- 						<li><a href="#"><i class="fa fa-envelope"></i> info@flowershop.com</a></li> -->
	<!-- 					</ul> -->
	<!-- 				</div> -->
	<!-- 			</div> -->
	<!-- 			<div class="col-sm-6"> -->
	<!-- 				<div class="social-icons pull-right"> -->
	<!-- 					<ul class="nav navbar-nav"> -->
	<!-- 						<li><a href="#"><i class="fa fa-facebook"></i></a></li> -->
	<!-- 						<li><a href="#"><i class="fa fa-twitter"></i></a></li> -->
	<!-- 						<li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->
	<!-- 						<li><a href="#"><i class="fa fa-dribbble"></i></a></li> -->
	<!-- 						<li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
	<!-- 					</ul> -->
	<!-- 				</div> -->
	<!-- 			</div> -->
	<!-- 		</div> -->
	<!-- 	</div> -->
	<!-- </div> --><!--/header_top-->
	
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href="../index.php">
              <img src="images/home/logo.jpeg" alt="" style="width:150px;height:84px" />
            </a>
					</div>					
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
              <li><a href="index.php"><i class="fa fa-home"></i> Trang chủ</a></li>

                <?php 
                  require_once '../api/model/user_db.php';
                    if(isset($_SESSION['User'])){
                            echo '<li><a href="dashboard.php"><i class="fa fa-crosshairs"></i>Quản lý</a></li>';
                    	if(UserDB::getGroupID()['GroupID'] >= 4){
                            
                            if(UserDB::getGroupID()['GroupID'] == 4){
                                echo '<li><a href="profile.php"><i class="fa fa-user"></i>' . $_SESSION['User']['FullName'] . ' (Nhân viên)</a></li>';
                            }
                            else if(UserDB::getGroupID()['GroupID'] == 9){
                                echo '<li><a href="profile.php"><i class="fa fa-user"></i>' . $_SESSION['User']['FullName'] . ' (Quản trị viên)</a></li>';
                            }
                            else if(UserDB::getGroupID()['GroupID'] == 10){
                                echo '<li><a href="profile.php"><i class="fa fa-user"></i>' . $_SESSION['User']['FullName'] . ' (Admin)</a></li>';
                            }
                    	}
                        else {
                            echo '<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>';
                            echo '<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>';
                            
                            echo '<li><a href="profile.php"><i class="fa fa-user"></i>' . $_SESSION['User']['FullName'] . '</a></li>';
                        }
                    
                        echo '<li><a href="./logout.php"><i class="fa fa-lock"></i>Đăng xuất</a></li>';
                    }
                    else {    
                        echo '<li><a href="login.php"><i class="fa fa-lock"></i>Đăng nhập</a></li>';
                    }
              ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->
	
	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="../index.php" class="active">Trang Chủ</a></li>
							<li class="dropdown"><a href="#">Cửa Hàng<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                  <li><a href="shop.php">Sản Phẩm</a></li>
									<li><a href="checkout.php">Thanh Toán</a></li> 
									<li><a href="cart.php">Giỏ Hàng</a></li> 
                </ul>
              </li> 
							<li><a href="contact-us.php">Liên Hệ</a></li>
						</ul>
					</div>

				</div>
				<div class="col-sm-3">
					<div class="search_box pull-right">
						<input type="text" placeholder="Search"/>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->
