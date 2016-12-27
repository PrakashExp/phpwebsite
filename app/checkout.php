<?php 
    session_start();
 	require_once '../api/model/database.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/product_db.php';
    
    if(!isset($_SESSION['User']['UserID'])){
        header('location: ./login.php');
    }
		
    switch (@$_GET['action']){
        default:
            require_once './view/checkout_view.php';
            break;
    }	
?>

