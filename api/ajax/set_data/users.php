<?php
session_start();
require_once '../../model/functions.php';
require_once '../../model/database.php';
require_once '../../model/user_db.php';

if (isset($_GET)){
    $action = htmlspecialchars($_GET["action"]);
}
else {
    $action = 'Active'; 
}

if (isset($_POST['ListUserID'])){
    $ListUserIDs    = $_POST['ListUserID'];
    
    switch($action){
        case 'Active':
            foreach ($ListUserIDs as $key=>$UserID){
                UserDB::activeUser($UserID);
            }
            break;
            
        case 'Block':
            foreach ($ListUserIDs as $key=>$UserID){
                UserDB::deleteUser($UserID);
            }
            break;
    }
}
        
?>