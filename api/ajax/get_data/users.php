<?php
session_start();
require_once '../../model/functions.php';
require_once '../../model/database.php';
require_once '../../model/user_db.php';

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

 
// create SQL based on HTTP method
switch ($method) {
    case 'GET':
        $action       = htmlspecialchars(@$_GET["action"]); 
        $pageIndex    = htmlspecialchars(@$_GET["page-index"]);
        $numberItems  = htmlspecialchars(@$_GET["number-items"]);
        
        switch ($action){

            case 'getAllUsers':
                $UsersListActive   = UserDB::getUsersPagination($pageIndex, $numberItems);
                $UsersListBlock   = UserDB::getUsersPagination($pageIndex, $numberItems, array('Active'=>'0'));

                $UsersList = array_merge($UsersListBlock, $UsersListActive);
                echo json_encode($UsersList);
                break;

            case 'getActiveUsers':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems);
                echo json_encode($UsersList);
                break;
        
            case 'getBlockedUsers':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('Active'=>'0'));
                echo json_encode($UsersList);
                break;
        
            case 'getKHM':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'0'));
                echo json_encode($UsersList);
                break;
                
            case 'getKHTT':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'1'));
                echo json_encode($UsersList);
                break;
            
            case 'getKHTV':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'2'));
                echo json_encode($UsersList);
                break;
                
            case 'getKHVIP':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'3'));
                echo json_encode($UsersList);
                break;
                
            case 'getAllAgent':

                $UsersListActive   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'4'));
                $UsersListBlock   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'4', 'Active'=>'0'));

                $UsersList = array_merge($UsersListBlock, $UsersListActive);
                echo json_encode($UsersList);
                break;

                // $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'4'));
                // echo json_encode($UsersList);
                // break;
                
            case 'getQTV':
                $UsersList   = UserDB::getUsersPagination($pageIndex, $numberItems, array('GroupID'=>'9'));
                echo json_encode($UsersList);
                break;
                
            default:
                echo 'You might do wrong action.';
                break;
        }
        break;
        
    case 'PUT':
        break;
        
  case 'POST':

      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $ListUserIDs = $request->listUserIDs;

      $action = htmlspecialchars(@$_GET["action"]);

      switch($action){
      case 'Active':
          foreach ($ListUserIDs as $key=>$UserID){
              UserDB::activeUser($UserID);
          }
          echo json_encode("Active complete");
          break;
            
      case 'Block':
          foreach ($ListUserIDs as $key=>$UserID){
              UserDB::deleteUser($UserID);
          }
          echo json_encode("Block complete");
          break;
      }
     

      break;
        
    case 'DELETE':
        break;
}
?>