<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();
require_once './classes/Auth.class.php';

$user = new Auth\User();

$all_news = $user->getNews($_GET['id']);
$comments = $user->getComments($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<div class="container-fluid">
    <?php include('header.php');?>


    <div class="news">
        <span> Title: <?=$all_news['title'];?></span>

        <br />
        <span><p> Description: <br /><?=$all_news['description']?></p></span>
    </div>
    <div class="comment">
        <h4>User comments</h4>
        <ul class="commentlist" id="commentlist">
            <?php
            foreach ($comments as $key=>$comment):?>
                <li class="item">
                    <span class="commentauthor" style="font-weight: normal;">Author: <?=$comment['author']?></span>
                    <span><p><?=$comment['COMMENT']?></p></span>
                </li>
                <hr />
                <?php endforeach;?>
        </ul>

    </div>
    <?php if (Auth\User::isAuthorized()):?>
    <form action="classes/comment.php" method="post"  >
        <input type="text" name="news_id" style="visibility: hidden" value="<?=$_GET['id']?>"><br>
        <textarea name="comment"  class="input-textarea" placeholder="Comment" autofocus></textarea><br />
        <input type="submit" value="Add comment" class="save_button"><br>
    </form>
    <?endif;?>