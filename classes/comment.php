<?php
include 'Auth.class.php';


if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();
$host  = $_SERVER['HTTP_HOST'];


if(isset($_POST)){
    $comment = $_POST['comment'];
    $news_id = $_POST['news_id'];

    $addComment = new \Auth\User();
    if($addComment->addComment($news_id, $comment, $_SESSION['login'])){
        header('Location: http://'.$host.'/account.php');
    }




}