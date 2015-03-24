<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();
require_once './classes/Auth.class.php';

$user = new Auth\User();
$data_user = $user->getUser($_SESSION['login']);
$user_news = $user->getUserNews($_SESSION['user_id']);
$user_hobby = $user->getUserHobby($_SESSION['user_id']);
$user_education = $user->getUserEducation($_SESSION['user_id']);

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

    <h2>MY ACCOUNT</h2>

    <?php if($_SESSION['avatar']):?>
        <img src="/upload/<?=$_SESSION['avatar']?> " width='150' height='150'>
    <?php else:?>
        <img src="http://placehold.it/150x150">
    <?php endif;?>
    <?php foreach($data_user as $key=>$user):?>
        <br /><span> <?= $key.":";?></span>
        <span> <?=$user;?></span>
    <?php endforeach;?>
    <?php if($user_education):?>
        <br />
        <span>Education: <?=$user_education['value'];?></span>
    <?endif;?>

    <?php if(!empty($user_hobby)):?>
        <br />
        <span>Hobby: <?php  foreach ($user_hobby as $key=>$hobby){
                echo $hobby['value'].", ";
            }?>
    </span>

    <?endif;?>
    <br />
    <a href="edit.php?id=<?=$_SESSION['user_id'];?>">Edit user data</a>
    <div class="clear"></div>
    <hr/>
    <h3>Form to add news</h3>

    <div class="error">
        <?php
        if ( isset( $_SESSION['NewsForm'] ) ) {
            echo '<font color=red>'.$_SESSION['NewsForm']['error'].'</font>';
            unset($_SESSION['NewsForm']);
        }
        ?>
    </div>

    <form action="classes/news.php" method="post"  >
        <input name="title" type="text" class="input-block-level" placeholder="Title"><br />
        <textarea name="description"  class="input-textarea" placeholder="Description" autofocus></textarea><br />
        <input type="submit" value="Add news" class="save_button"><br>
    </form>

    <h3>User news</h3>
    <table class="table">
        <tr>
            <td style="  width: 300px;">Title</td>
            <td>Description</td>
        </tr>
        <?php
        foreach ($user_news as $key=>$news):?>
            <tr>
                <td style="  width: 300px;"><a href="readnews.php?id=<?=$news['id'];?>"><?=$news['title'].': '?></a></td>
                <td><?php
                    $string = strip_tags($news['description']);
                    $string = substr($string, 0, 200);
                    $string = rtrim($string, "!,.-");
                    $string = substr($string, 0, strrpos($string, ' '));
                    echo $string."… ";
                    ?>

                </td>
            </tr>
        <?php endforeach;?>
    </table>

</div>
</body>
</html>