<!DOCTYPE html>
<html lang="en">
  <head>

    <?php
    include "style_head.php";
    ?>

    <script src="js/angular.min.js"></script>  
    <script src="js/controller-admin.js"></script>

    <link href="css/admin-page.css" rel="stylesheet">

    <title>Quản lý</title>

  </head><!--/head-->

  <body ng-app="starter">
    <?php
    include "header.php";   

    ?>

    <section ng-controller="AdminCtrl" ng-init="initUserID('<?php echo $_SESSION['User']['UserID'];?>')">		

      <div class="container property-table">

        <div class="mainmenu pull-left">
			    <ul class="nav navbar-nav collapse navbar-collapse">

				    <li class="active" ng-click="chooseTitle('product')">
              <a href="">Sản phẩm</a>
            </li>

				    <li class="active" ng-click="chooseTitle('bill')">
              <a href="">Đơn hàng</a>
            </li>

				    <!-- <li class="dropdown"> -->
            <!--   <a href="#">Loc danh sach -->
            <!--     <i class="fa fa-angle-down"></i> -->
            <!--   </a> -->
            <!--   <ul role="menu" class="sub-menu"> -->
            <!--     <li><a href="shop.php">Hoa tinh yeu</a></li> -->
						<!--     <li><a href="checkout.php">Hoa khai truong</a></li>  -->
						<!--     <li><a href="cart.php">Hoa van phong</a></li>  -->
            <!--   </ul> -->
            <!-- </li>  -->
			    </ul>
		    </div>

			  <!-- <div class="mainmenu pull-left">
				     <ul class="nav navbar-nav collapse navbar-collapse">
					   <li ng-click="chooseTitle('product')">
             Sản phẩm
             </li>
					   <li ng-click="chooseTitle('bill')">
             Đơn hàng
             </li>
					   <li ng-click="chooseTitle('member')">
             Khach hang
             </li>
					   <li ng-click="chooseTitle('agent')">
             Nhan vien
             </li>
				     </ul>
			       </div> -->

        <br>
        <br>

        <div ng-switch on="title">
          <div ng-switch-when="productGroup">
            <category options="categoryList">
            </category>
          </div>
          <div ng-switch-when="product">
            <product options="productList">
            </product>
          </div>
          <div ng-switch-when="bill">
            <bill options="billList">
            </bill>
          </div>

        </div>

        
      </div>
    </section>

    <?php include "footer.php";?>
    
  </body>
</html>
