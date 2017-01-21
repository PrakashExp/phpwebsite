<?php 
    session_start();
    require_once '../api/model/database.php';
    require_once '../api/model/functions.php';
    require_once '../api/model/account_db.php';
    
    if(!isset($_SESSION['User']['UserID'])){
        header('location: ./login.php');
    }
 
    require_once '../api/model/user_db.php';
    
    $UserInfo   = UserDB::getProfile();

    $UserID = $UserInfo['UserID'];
    $Username = $UserInfo['Username'];
    $Name = $UserInfo['Name'];
    $Sex = ($UserInfo['Sex'] == 0) ? 'Nam' : 'Nữ';
    $DateBD   = date_parse_from_format('Y-m-d', $UserInfo['Birthday']);
    $TimeStamp  = mktime(0, 0, 0, $DateBD['month'], $DateBD['day'], $DateBD['year']);
    $Birthday   = date('d/m/Y', $TimeStamp); 
    $IDCard = $UserInfo['IDCard'];
    $Address = $UserInfo['Address'];
    $TelNumber = $UserInfo['TelNumber'];
    $Email = $UserInfo['Email'];
    $TypeUser = $UserInfo['TypeUser'];
    $Active = $UserInfo['Active'];
    $Revenue = $UserInfo['Revenue'];
        
    switch (@$_GET['action']){
        case 'update':
            if (isset($_POST)){
                $OldPassword    = '';
                $NewPassword    = '';
                
                if (!checkEmpty($_POST['NewPassword'])){               
                    if (AccountDB::checkOldPassword($UserID, $_POST['OldPassword'])) {
                        $OldPassword    = $_POST['OldPassword'];
                        $NewPassword    = $_POST['NewPassword'];
						AccountDB::setNewPassword($Username,$NewPassword);
                    }
                }
                
                $Address    = $_POST['Address'];
                $TelNumber  = $_POST['TelNumber'];
                
                $data   = array('Address'=>$Address, 'TelNumber'=>$TelNumber, 'OldPassword'=>$OldPassword, 'NewPassword'=>$NewPassword);
                UserDB::updateUser($UserID, $data);
            }
            require_once './view/profile_view.php';
            break;
        default:
            require_once './view/profile_view.php';
            break;
    }
?>