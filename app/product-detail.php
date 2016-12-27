<?php 
    session_start();
    
    require_once '../api/model/functions.php';
    require_once '../api/model/database.php';
    require_once '../api/model/product_db.php';
    
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method){
        case 'GET':
            $productID = @$_GET['ProductID'];
            break;
    }
    
    $productItem    = ProductDB::getProductsByKey(array('ProductID' => $productID));

    if(empty($productItem)) {
      require_once '404.php';
    }
    else {
      $productItem    = $productItem[0];
      $ProductsList   = ProductDB::getProductsPagination(1, 10);

      require_once './view/product_detail_view.php';
    }


    

?>