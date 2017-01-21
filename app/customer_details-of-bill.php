<?php
session_start();
if (!isset($_SESSION['User'])){
        header('location: ./index.php');
    }

$billID       = htmlspecialchars(@$_GET["billID"]); 
require_once"view/customer_details-of-bill_view.php";
?>