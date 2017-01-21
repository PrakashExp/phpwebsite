<?php
    session_start();
    require_once '../api/model/database.php';
    require_once '../api/model/user_db.php';
    
    $UserID = @$_GET['UserID'];
    $Profile    = UserDB::getProfile($UserID);
        
    require_once"view/admin_detail_of_user_view.php";
?>