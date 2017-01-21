<?php
session_start();
require_once '../../model/functions.php';
require_once '../../model/database.php';
require_once '../../model/product_db.php';

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

 
// create SQL based on HTTP method
switch ($method) {
  case 'GET':
      $action       = htmlspecialchars(@$_GET["action"]);
      $pageIndex    = htmlspecialchars(@$_GET["page-index"]);
      $numberItems  = htmlspecialchars(@$_GET["number-items"]);
      $KeyGet       = array();
      
      if (isset($_GET["category"])){
          $KeyGet['CategoryID'] = $_GET["category"];
      }
      
      switch ($action){
          default:
          case 'getAllProducts':
              $ProductListActive   = ProductDB::getProductsPagination($pageIndex, $numberItems, array('Active'=>'1'));
              $ProductListBlock   = ProductDB::getProductsPagination($pageIndex, $numberItems, array('Active'=>'0'));

              $ProductList = array_merge($ProductListBlock, $ProductListActive);
              echo json_encode($ProductList);
              return;
              break;

          case 'getActiveProducts':
              $KeyGet['Active'] = 1;
              break;
              
          case 'getHiddenProducts':
              $KeyGet['Hide'] = 1;
              break;
              
          case 'getDeletedProducts':
              $KeyGet['Active'] = 0;
              break;
      }
      
      $ProductsList = ProductDB::getProductsPagination($pageIndex, $numberItems, $KeyGet);
      echo json_encode($ProductsList);
      
      break;

  case 'PUT':
      break;
  case 'POST':

      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $ListProductIDs = $request->listProductIDs;

      $action = htmlspecialchars(@$_GET["action"]);

      switch($action){
      case 'Active':
          foreach ($ListProductIDs as $ProductID){
              ProductDB::activeProduct($ProductID);
          }
          echo json_encode("Active complete");
          break;
            
      case 'Hide':
          foreach ($ListProductIDs as $ProductID){
              ProductDB::hideProduct($ProductID);
          }
          echo json_encode("Hide complete");
          break;
          
      case 'Show':
          foreach ($ListProductIDs as $ProductID){
              ProductDB::showProduct($ProductID);
          }
          echo json_encode("Show complete");
          break;
            
      case 'Delete':
          foreach ($ListProductIDs as $ProductID){
              ProductDB::deleteProduct($ProductID);
          }
          echo json_encode("Delete complete");
          break;
      default:
          echo json_encode("Not found action. Failed");
          break;
      }
      
      // if($action == "removeElements") {
      //     $postdata = file_get_contents("php://input");
      //     $request = json_decode($postdata);
      //     $data = $request->mydata;
      //     echo json_encode($data);
      //     //          echo json_encode(htmlspecialchars($_POST["data"]));
      //     //          echo json_encode(htmlspecialchars($_POST["data"]));
      // }

      // echo "this is post";
      // echo "this is your name ", htmlspecialchars($_POST["name"]);
      // echo "this is your age ", htmlspecialchars($_POST["age"]);
      // echo json_encode($data);
      break;
  case 'DELETE':
      break;
}
?>