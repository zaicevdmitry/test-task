<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();
require_once './classes/Auth.class.php';

if ( isset( $_SESSION['addNewUserForm'] ) ) {
    echo '<font color=red>'.$_SESSION['addNewUserForm']['error'].'</font>';
    unset($_SESSION['addNewUserForm']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="css/datepicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/datepicker/datepicker.js"></script>
    <script type="text/javascript" src="js/datepicker/eye.js"></script>
    <script type="text/javascript" src="js/datepicker/utils.js"></script>
    <script type="text/javascript" src="js/datepicker/layout.js?ver=1.0.2"></script>
</head>

<body>
<div class="container-fluid">
    <?php include('header.php');?>
        <h2>User registration</h2>
        <form action="classes/registration.php" method="post"  class="form_registration" enctype="multipart/form-data">
            <input name="login" type="text" class="input-block-level" placeholder="Login"><br />
            <input name="username" type="text" class="input-block-level" placeholder="Username" autofocus><br />
            <input name="surname" type="text" class="input-block-level" placeholder="Surname"><br />
            <input name="password1" type="password" class="input-block-level" placeholder="Password"><br />
            <input name="password2" type="password" class="input-block-level" placeholder="Confirm password"><br />
            <input name="email" type="email" class="input-block-level" placeholder="Email"><br />


            <input name="date_of_birth" type="date" class="input-block-level"  placeholder="Date of birth"><br />

            <div class="upload">
                <input type="file" name="filename" value=""/>
            </div>

            <div class="education">
                <label>Education</label>
                <select name="education">
                    <option value="Select">--- Select your education ---</option>
                    <option value="1">Preschool</option>
                    <option value="2">General basic</option>
                    <option value="3">General secondary</option>
                    <option value="4">Primary professional</option>
                    <option value="5">Specialized secondary</option>
                    <option value="6">Higher professional</option>
                </select>
            </div>
            <div class="hobby">
                <label>Hobby:</label>
                <br />
                <input type="checkbox" name="hobby[]" value="1" />photographer<br />
                <input type="checkbox" name="hobby[]" value="2" />tennis<br />
                <input type="checkbox" name="hobby[]" value="3" />running<br />
                <input type="checkbox" name="hobby[]" value="4" />stamp collecting<br />
            </div>
            <div class="captcha">
                <img src= 'captcha.php' />
                <br />
                <input type= 'text' name= 'user_code' class="input-block-level" >
            </div>
            <input type="hidden" name="act" value="register">
            <br />
            <input type="submit" value="Save" class="save_button"><br>
        </form>
</div>
</body>
</html>
