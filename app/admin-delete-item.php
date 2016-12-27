<?php 
    session_start(); 
    
    require_once '../api/model/user_db.php';

    if(!isset($_SESSION['User']['UserID']) || (UserDB::getGroupID()['GroupID'] < 4)){
        header('location: ./login.php');
    }

    switch (@$_GET['action']){
        default:
            require_once './view/admin_dashboard.php';
            break;
    }

?>