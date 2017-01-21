<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "style_head.php"; ?>
    <script src="js/angular.min.js"></script>  
    <script src="js/controller-customer.js"></script>
    <link href="css/admin-page.css" rel="stylesheet">
    <title>Quản lý</title>
  </head>
  <body ng-app="starter">
    <?php include "header.php"; ?>
    <section ng-controller="AdminCtrl" ng-init="initUserID('<?php echo $_SESSION['User']['UserID'];?>')">		
      <div class="container property-table">
        <br /><br />
        <div ng-switch on="title">
          <div ng-switch-when="product">
            <bill options="billList"></bill>
          </div>
        </div>
      </div>
    </section>
    <?php include "footer.php";?>
  </body>
</html>
