<?php 
session_start(); 

require_once '../api/model/user_db.php';

if(!isset($_SESSION['User']['UserID'])){
  header('location: ./login.php');
}

switch (@$_GET['action']){
  default:
    $groupID = UserDB::getGroupID()['GroupID'];


      switch ($groupID) {
        case 10:
          require_once './view/admin_dashboard.php';
          break;

        case 9:
          require_once './view/admin_dashboard.php';
          break;

        case 4:
          require_once './view/agent_dashboard.php';
          break;

        default:
          require_once './view/customer_dashboard.php';
          break;

      }

}

?>
