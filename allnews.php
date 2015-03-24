<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();
require_once './classes/Auth.class.php';

$user = new Auth\User();
$all_news = $user->getAllNews();


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
<?php include'header.php';?>
<table class="table">
    <tr>
        <td style="  width: 300px;">Title</td>
        <td>Description</td>
    </tr>
    <?php
    foreach ($all_news as $key=>$news):?>
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