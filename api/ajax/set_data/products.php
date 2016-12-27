<?php
session_start();
require_once '../../model/functions.php';
require_once '../../model/database.php';
require_once '../../model/product_db.php';

if (isset($_GET)){
    $action = htmlspecialchars($_GET["action"]);
}
else {
    $action = 'Active'; 
}

if (isset($_POST['ListUserID'])){
    $ListProductIDs    = $_POST['ListProductID'];
    
    switch($action){
        case 'Active':
            foreach ($ListProductIDs as $key=>$ProductID){
                ProductDB::activeProduct($ProductID);
            }
            break;
            
        case 'Hide':
            foreach ($ListProductIDs as $key=>$ProductID){
                ProductDB::hideProduct($ProductID);
            }
            break;
            
        case 'Delete':
            foreach ($ListProductIDs as $key=>$ProductID){
                ProductDB::deleteProduct($ProductID);
            }
            break;
    }
}
?>