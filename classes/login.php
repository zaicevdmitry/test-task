<?php
//
//include 'Auth.class.php';
//
//
//if (!empty($_COOKIE['sid'])) {
//    // check session id in cookies
//    session_id($_COOKIE['sid']);
//}
//header("Content-Type: text/html; charset=UTF-8");
//session_start();
//
//$error = '';
//
//$host  = $_SERVER['HTTP_HOST'];
//
//if(isset($_POST)) {
//    $login = $_POST['login'];
//    $password = $_POST["password"];
//    $remember = !!$_POST["remember"];
//
//
//    $user = new Auth\User();
//    $auth_result = $user->authorize($login, $password, $remember);
//
//    if (!$auth_result) {
//        $error = $error . 'Invalid username or password' . "\n";
//        $_SESSION['loginForm'] = array();
//        $_SESSION['loginForm']['error'] = $error;
//        header('Location: http://' . $host . '/index.php');
//    }
//}
//?>