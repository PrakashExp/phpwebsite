<?php
session_start();
require_once '../../model/functions.php';
require_once '../../model/database.php';
require_once '../../model/bill_db.php';

function updateStatusBill($ListBillIDs, $userID, $status, $msg) {
    foreach ($ListBillIDs as $key=>$BillID){
        BillDB::updateStatus($BillID, $status, $userID);
    }
    echo json_encode($msg);
}

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
            case 'getAllBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems);
                echo json_encode($UsersList);
                break;

            case 'getAllCustomerBills':
                $userID    = htmlspecialchars(@$_GET["userid"]);
                $UsersList   = BillDB::getBillsInfoByUser($userID);
                echo json_encode($UsersList);
                break;
        
            case 'getUnverifiedBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'1'));
                echo json_encode($UsersList);
                break;
        
            case 'getVerifiedBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'2'));
                echo json_encode($UsersList);
                break;
                
            case 'getPackedBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'3'));
                echo json_encode($UsersList);
                break;
            
            case 'getShippingBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'4'));
                echo json_encode($UsersList);
                break;
            
            case 'getShippedBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'5'));
                echo json_encode($UsersList);
                break;
                
            case 'getDeliveredBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'6'));
                echo json_encode($UsersList);
                break;
                
            case 'getCancelledBills':
                $UsersList   = BillDB::getBillsPagination($pageIndex, $numberItems, array('Status'=>'7'));
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
        $ListBillIDs = $request->listBillIDs;
        $userID = $request->userID;

        //        echo "this is user id ";
        //        echo $userID;

        $action = htmlspecialchars(@$_GET["action"]);

        switch($action){

        case 'Verify':
            updateStatusBill($ListBillIDs, $userID, "Verified", "Verify complete!");
            break;
            
        case 'Pack':
            updateStatusBill($ListBillIDs, $userID, "Packed", "Packed complete!");
            break;

        case 'Shipping':
            updateStatusBill($ListBillIDs, $userID, "Shipping", "Shipping complete!");
            break;

        case 'Shipped':
            updateStatusBill($ListBillIDs, $userID, "Shipped", "Shipped complete!");
            break;
            
        case 'Deliver':
            updateStatusBill($ListBillIDs, $userID, "Delivered", "Delivered complete!");
            break;

        case 'Cancel':
            updateStatusBill($ListBillIDs, $userID, "Cancelled", "Cancelled complete!");
            break;

        default:
            echo json_encode("Not found action. Failed");
            break;
        }


        break;
        
    case 'DELETE':
        break;
}
?>