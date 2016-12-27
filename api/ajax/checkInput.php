<?php
    require_once '../../api/model/user_db.php';
    require_once '../../api/model/functions.php';
    require_once '../../api/model/database.php';
    if (isset($_GET['type'])){
        $type   = @$_GET['type'];
        
        switch ($type){
            default:
                echo $Username   = @$_GET['Username'];
                if (checkEmpty($Username)){
                    echo 'Tên đăng nhập không được rỗng';
                } else {
                    if (!checkInvalidLength($Username, 4, 50)){
                        if (checkFormat($Username, 'Username')){
                            if (UserDB::checkAvailableUsername($Username)){
                                echo 'Tên đăng nhập đã tồn tại';
                            }
                        } else {
                            echo 'Tên đăng nhập bao gồm các ký tự A-Z, a-z, 0-9 và _';
                        }
                    } else {
                        echo 'Tên đăng nhập có độ dài từ 4 đến 50 ký tự';
                    }
                }
                break;
            case 'Password':
                $Password   = @$_GET['Password'];
                if (checkEmpty($Password)){
                    echo 'Mật khẩu không được rỗng';
                } else {
                    if (!checkInvalidLength($Password, 4, 20)){
                        if (checkFormat($Password, 'Password')){
                            if(!checkInvalidLength($Password, 8, 20)){
                                echo 'Mật khẩu mạnh';
                            } else {
                                echo 'Mật khẩu yếu';
                            }
						}
                        
						else {
                            echo 'Mật khẩu phải bao gồm ký tự in hoa và số';
                        }
                    } else {
                        echo 'Mật khẩu phải có độ dài từ 4 đến 20 ký tự';
                    }
                }
                break;
            case 'IDCard':
                $IDCard   = @$_GET['IDCard'];
                if (checkEmpty($IDCard)){
                    echo 'Số CMND/Hộ Chiếu không được rỗng';
                } else {
                    if (checkFormat($IDCard, 'IDCard')){
                        if (UserDB::checkAvailableIDCard($IDCard)){
                            echo 'Số CMND/Hộ Chiếu đã tồn tại';
                        }
                    } else {
                        echo 'Số CMND/Hộ Chiếu không hợp lệ';
                    }
                }
                break;
            case 'Email':
                $Email   = @$_GET['Email'];
                if (checkEmpty($Email)){
                    echo 'Địa chỉ email không được rỗng';
                } else {
                    if (checkFormat($Email, 'Email')){
                        if (UserDB::checkAvailableEmail($Email)){
                            echo 'Địa chỉ email đã tồn tại';
                        }
                    } else {
                        echo 'Địa chỉ email không hợp lệ';
                    }
                }
                break;
        }
    }
?>