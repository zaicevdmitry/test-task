<?php
include 'Auth.class.php';


if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();

$user = new Auth\User();
$error = '';
$host  = $_SERVER['HTTP_HOST'];

function clean($value = "")
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

if(isset($_POST)) {
    $title = $_POST['title'];
    $description= $_POST["description"];

    if (empty(clean($title))) {
        $error = $error.'<li>Enter the title</li>'."\n";
    }

    if (empty(clean($description))) {
        $error = $error.'<li>Enter the description</li>'."\n";
    }

    if ( !empty( $error ) ) {
        $_SESSION['NewsForm'] = array();
        $_SESSION['NewsForm']['error'] = '<p class="errorMsg">When filling out the form mistakes had been made:</p>'.
            "\n".'<ul class="errorMsg">'."\n".$error.'</ul>'."\n";
        header('Location: http://'.$host.'/account.php');
    }


    if($user->addNews($_SESSION['user_id'], $title,$description)){
        header('Location: http://'.$host.'/account.php');
    }
}