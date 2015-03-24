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
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $date_of_birth = $_POST["date_of_birth"];
    $education = $_POST["education"];
    $hobby = $_POST["hobby"];
    $avatar = $_FILES["filename"]["name"];
    $username = $_POST["username"];

    if (!empty(clean($email))) {
        $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email_validate) {
            $error = $error.'<li>Email is invalid</li>'."\n";
        }
    } else {
        $error = $error.'<li>Enter the email</li>'."\n";
    }
    if($_FILES["filename"]['name'] != '' && empty($_FILES["filename"]['name'])){
        if ($_FILES["filename"]["size"] > 1024 * 2 * 1024) {
            $error = $error.'<li>File size exceeds two megabytes</li>'."\n";
        }
        if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
            move_uploaded_file($_FILES["filename"]["tmp_name"], '..'. DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR . $_FILES["filename"]["name"]);
        } else {
            $error = $error.'<li>Error loading file</li>'."\n";
        }
    }

    if (empty(clean($date_of_birth))) {
        $date_of_birth = $_SESSION['date_of_birth'];
        if(!$date_of_birth)$date_of_birth = '2015-03-24';
    }
    if (empty(clean($username))) {
        $username = $_SESSION['user_name'];
        if($username)$username = ' ';
    }
    if (empty(clean($surname))) {
        $surname = $_SESSION['surname'];
        if(!$surname)$surname = ' ';
    }
  if (empty(clean($avatar))) {
      $avatar = $_SESSION['avatar'];
      if(!$avatar)$avatar = ' ';
    }

    if (empty($hobby)) {
        if (is_array($hobby)) {
            foreach ($hobby as $key => $value) {
                $user->saveHobby($_SESSION["user_id"], $value);
            }
        } else {
            $user->saveHobby($_SESSION["user_id"], $hobby);
        }
    }
    if (empty($education)) {
        $user->updateEducation($_SESSION["user_id"], $education);
    }
    if ( !empty( $error ) ) {
        $_SESSION['editUserForm'] = array();
        $_SESSION['editUserForm']['error'] = '<p class="errorMsg">Required fields:</p>'.
            "\n".'<ul class="errorMsg">'."\n".$error.'</ul>'."\n";
        header('Location: http://'.$host.'/edit.php');
    }else{
        $update = $user->update($username, $surname, $date_of_birth, $avatar, $email,  $_SESSION['user_id']);
        if($update){
            header('Location: http://'.$host.'/account.php');
        }
    }
}

?>