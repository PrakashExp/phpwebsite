<?php
    session_start();
    $lifetime = 60 * 60 * 24 * 7; //1 week
    $path = '/';
    session_set_cookie_params($lifetime, $path);
    
    if (isset($_SESSION['User'])){
        header('location: ./index.php');
    }
    
	require_once '../api/model/database.php';
	require_once '../api/model/functions.php';
	
	$action = (isset($_GET['action'])) ? $_GET['action'] : 'login';
	
	switch ($action){
	    case 'login':
	        if(!checkEmpty(@$_POST['Username']) && !checkEmpty(@$_POST['Password'])) {
	            $Username = $_POST['Username'];
	            $Password = md5($_POST['Password']);
	        
	            $db       = Database::getDB();
	        
	            $query    = 'SELECT   `users`.`UserID`, `Name`, `GroupID`, `Active`, `Username`, `Password`
		              FROM    `accounts` INNER JOIN `users`
		              ON      `accounts`.`UserID` = `users`.`UserID`
		              WHERE   `Username` = \'' . $Username . '\'';
	        
	            Database::setQuery($query);
	            $userInfo      = Database::loadRow(Database::execute());
	        
	            if($Password != $userInfo['Password']){
	                echo "<script>alert('Invalid Name or Password!');</script>";
	                echo "<meta http-equiv='refresh' content='0;url=../app/login.php'>";
	            } else {
	                if($userInfo['Active'] == 0){
	                    echo "<script>alert('The Account has been deactivated! Please contact with the administrator!');</script>";
						echo "<meta http-equiv='refresh' content='0;url=../app/login.php'>";
	                } else {
	                    $_SESSION['User']['FullName']   = $userInfo['Name'];
	                    $_SESSION['User']['UserID']     = $userInfo['UserID'];
	                    $_SESSION['User']['GroupID']    = $userInfo['GroupID'];
	        
	                    /*if($_SESSION['User']['GroupID'] == '10'){
	                        header('location: ./admin-dashboard.php');
	                    } else {
	                        header('location: ./shop.php');
	                    }*/
						switch($_SESSION['User']['GroupID'])
						{
							case '10':
							{
								header('location: ./dashboard.php');
								break;
							}
							case '4':
							{
								header('location: ./dashboard.php');
								break;
							}
							case '0':
							{
								header('location: ./shop.php');
								break;
							}
						}
	                }
	            }
	        }
	        break;
        default:
            if ($_POST != null){
                $Name = trim($_POST['Name']);
                $dateArr = date_parse_from_format("d/m/Y", $_POST['Birthday']);
                $Birthday = date("Y-m-d", mktime(0, 0, 0, $dateArr["month"], $dateArr["day"], $dateArr["year"]));
                $IDCard = trim($_POST['IDCard']);
                $Address = trim($_POST['Address']);
                $TelNumber = trim($_POST['TelNumber']);
                $Email = trim($_POST['Email']);
                $Username = trim($_POST['Username']);
                $Password = trim($_POST['Password']);
            }
            break;
	}
	
	require_once './view/login_view.php';
?>