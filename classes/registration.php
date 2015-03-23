<?php
include 'Auth.class.php';


if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Method Not Allowed
    http_response_code(405);
    header("Allow: POST");
    $this->setFieldError("main", "Method Not Allowed");
    return;
}

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

if(isset($_POST)){
    $login = $_POST['login'];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $date_of_birth = $_POST["date_of_birth"];
    $education = $_POST["education"];
    $hobby = $_POST["hobby"];
    $avatar = $_FILES["filename"]["name"];
    $username = $_POST["username"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    if (empty(clean($login))) {
        $error = $error.'<li>Enter the login</li>'."\n";
    }
    if (empty(clean($username))) {
        $error = $error.'<li>Enter the your name</li>'."\n";
    }
    if (empty(clean($surname))) {
        $error = $error.'<li>Enter the your surname</li>'."\n";
    }
    if (empty($password1)) {
        $error = $error.'<li>Enter the password</li>'."\n";
    }
    if (empty($password2)) {
        $error = $error.'<li>Confirm the password</li>'."\n";
    }
    if ($password1 !== $password2) {
        $error = $error.'<li>Confirm password is not match</li>'."\n";
    }
    if (!empty(clean($email))) {
        $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email_validate) {
            $error = $error.'<li>Email is invalid</li>'."\n";
        }
    } else {
        $error = $error.'<li>Enter the email</li>'."\n";
    }
    if (empty($date_of_birth)) {
        $error = $error.'<li>Select an date of birth</li>'."\n";
    }
    if ($_FILES["filename"]["size"] > 1024 * 2 * 1024) {
        $error = $error.'<li>File size exceeds two megabytes</li>'."\n";
    }
    if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        move_uploaded_file($_FILES["filename"]["tmp_name"], '..'. DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR . $_FILES["filename"]["name"]);
    } else {
        $error = $error.'<li>Error loading file</li>'."\n";
    }
    if ($_POST['user_code'] == '') {
        $error = $error.'<li>Enter the captcha</li>'."\n";
    }
    if (!$user->check_code($_POST['user_code'])) {
        $error = $error.'<li>Captcha is invalid</li>'."\n";
    }
    if ( !empty( $error ) ) {
        $_SESSION['addNewUserForm'] = array();
        $_SESSION['addNewUserForm']['error'] = '<p class="errorMsg">При заполнениии формы были допущены ошибки:</p>'.
            "\n".'<ul class="errorMsg">'."\n".$error.'</ul>'."\n";
        $_SESSION['addNewUserForm']['login'] = $login;
        $_SESSION['addNewUserForm']['password1'] = $password1;
        $_SESSION['addNewUserForm']['email'] = $email;
        header('Location: http://'.$host.'/register.php');
    }
    try {
        $create = $user->create($username, $password1, $surname, $date_of_birth, $avatar, $email, $login);
        if($create){
            $user->authorize($username, $password1);

            if (empty($hobby)) {
                $this->setFieldError("username", "Select an hobby");
                return;
            } else {
                if (is_array($hobby)) {
                    foreach ($hobby as $key => $value) {
                        $user->saveHobby($_SESSION["user_id"], $value);
                    }
                } else {
                    $user->saveHobby($_SESSION["user_id"], $hobby);
                }
            }
            if (empty($education)) {
                $this->setFieldError("username", "Select an education");
                return;
            } else {
                $user->saveEducation($_SESSION["user_id"], $education);
            }
            header('Location: http://'.$host.'/index.php');
        }
    } catch (\Exception $e) {
        $this->setFieldError("username", $e->getMessage());
        return;
    }
}

?>