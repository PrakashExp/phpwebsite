<?php
session_start();
if (!isset($_SESSION['User'])){
        header('location: ./index.php');
    }

$getUserIDFromAdmin = htmlspecialchars(@$_GET["userID"]); 
$billID       = htmlspecialchars(@$_GET["billID"]); 

require_once"view/admin_detail_of_bill_view.php";
?>