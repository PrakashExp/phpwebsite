<?php
require_once '../api/model/database.php';
require_once '../api/model/functions.php';
require_once '../api/model/bill_db.php';
  
session_start();

if (isset($_POST['Address']) && isset($_SESSION['cart'])){
    $address    = $_POST['Address'];
    BillDB::addBill($_SESSION['cart'], $address);
    
    echo "<script type='text/javascript'>alert('Đơn hàng của bạn đã được tiếp nhận!')</script>";
    echo "<meta http-equiv=Refresh content=0;url=../app/home.php>";
    
    unset($_SESSION['cart']);    
}
else {
    header("location: home.php");
}

?>