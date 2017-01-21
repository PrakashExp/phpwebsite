<?php
    session_start();
    require_once '../api/model/database.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/product_db.php';
    
    $ProductID = (isset($_GET['ProductID']) ? $_GET['ProductID'] : 'NULL');
    $Product    = ProductDB::getProductsByKey(array('ProductID'=>$ProductID));
        
    if ($Product == NULL){
        header('location: admin-dashboard.php');
    }
    else {
        $Product    = $Product[0];
        require_once "view/admin_detail_of_product_view.php";        
    }
?>