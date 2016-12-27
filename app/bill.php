<?php
 require_once '../api/model/database.php';
 require_once '../api/model/functions.php';
  require_once '../api/model/bill_db.php';
  
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
BillDB::addBill($_SESSION['cart']);
echo "<script type='text/javascript'>alert('Your receipt has been submitted!')</script>";
echo "<meta http-equiv=Refresh content=0;url=../app/home.php>";
unset($_SESSION['cart']);
?>