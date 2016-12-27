<?php
    session_start();
    
    require_once '../api/model/database.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/product_db.php';
    
    if (empty($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    require_once('../api/model/cart_db.php');
    
    /* if (isset($_POST['sort'])) {
        $sortKey    = $_POST['sort'];
    } else {
        $sortKey    = 'Name';
    } */
    
    $method = $_SERVER['REQUEST_METHOD'];
    $action = '';
    switch ($method){
        case 'GET':
            $action = @$_GET['action'];
            break;
        case 'POST':
            $action = @$_POST['action'];
            break;
    }
    
    switch($action) {
        case 'add':
            addItem(@$_REQUEST['ProductID'], @$_REQUEST['Quantity']);
            include('view/cart_view.php');
            break;
        case 'update':
            $ProductID  = @$_REQUEST['ProductID'];
            $Quantity   = @$_REQUEST['Quantity'];
            if (@$_SESSION['cart'][$ProductID]['Quantity'] != $Quantity) {
                updateItem($ProductID, $Quantity);
            }
            include('view/cart_view.php');
            break;
        case 'empty':
            unset($_SESSION['cart']);
            include('view/cart_view.php');
            break;
        case 'delete':
            $ProductID  = $_REQUEST['ProductID'];
            unset($_SESSION['cart'][$ProductID]);
            include('view/cart_view.php');
            break;
        default:
            include('view/cart_view.php');
            break;
            
    }
?>