<?php
    session_start();

    //Xóa cookie theo phiên khỏi trình duyệt.
    $name   = session_name();
    $expire = strtotime('-1 week');
    $params = session_get_cookie_params();
    $path   = $params['path'];
    $domain = $params['domain'];
    $secure = $params['secure'];
    $httponly = $params['httponly'];
    setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
    //Kết thúc phiên.
    $_SESSION   = array();
    session_destroy();
    
    unset($_SESSION[User]);
    
    header('location: ./index.php');
?>