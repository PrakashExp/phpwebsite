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
                
                <li class="active" ng-click="chooseTitle('member')">
                    <a href="">Khách hàng</a>
                </li>
                
                <li class="active" ng-click="chooseTitle('agent')">
                    <a href="">Nhân viên</a>
                </li>
            </ul>
        </div>
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
          <div ng-switch-when="member">
            <member options="memberList">
            </member>
          </div>
          <div ng-switch-when="agent">
            <agent options="agentList">
            </agent>
          </div>
        </div>

        
      </div>
    </section>

    <?php include "footer.php";?>
    
  </body>
</html>
