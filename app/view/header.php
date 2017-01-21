<header id="header">	
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
                                	if(UserDB::getGroupID()['GroupID'] >= 4){
                                	    echo '<li><a href="dashboard.php"><i class="fa fa-crosshairs"></i>Quản lý</a></li>';
                                	    
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
                                        echo '<li><a href="dashboard.php"><i class="fa fa-crosshairs"></i>Đơn hàng</a></li>';                            
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
							<li class="dropdown"><a href="shop.php">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.php">Tất cả</a></li>
                                    <li><a href="shop.php?category=hoa_tinh_yeu">Hoa tình yêu</a></li>
                                    <li><a href="shop.php?category=hoa_khai_truong">Hoa khai trương</a></li>
                                    <li><a href="shop.php?category=hoa_van_phong">Hoa văn phòng</a></li>
                                    <li><a href="shop.php?category=hoa_cuoi">Hoa cưới</a></li>
                                    <li><a href="shop.php?category=hoa_sinh_nhat">Hoa sinh nhật</a></li>
                                    <li><a href="shop.php?category=hoa_chia_buon">Hoa chia buồn</a></li>
                                </ul>
                            </li> 
							<li><a href="contact-us.php">Liên Hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->
