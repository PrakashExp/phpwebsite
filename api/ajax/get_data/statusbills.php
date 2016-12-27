<?php
session_start();
require_once '../../model/functions.php';
require_once '../../model/database.php';
require_once '../../model/statusbills_db.php';

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

          case 'getAllStatus':
              $ProductsList = StatusBillsDB::getStatusBillsByKey(array('Active' => '1'));
              echo json_encode($ProductsList);
              break;
                            
          default:
              echo json_encode('You might do wrong action.');
              break;
      }
      break;

  case 'PUT':
      break;
  case 'POST':
      break;
  case 'DELETE':
      break;
}
?>