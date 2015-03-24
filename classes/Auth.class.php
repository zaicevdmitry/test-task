<?php

namespace Auth;

use PDO;

class User
{
    private $id;
    private $username;
    private $db;
    private $user_id;

    private $db_host = "localhost";
    private $db_name = "test-task";
    private $db_user = "root";
    private $db_pass = "";

    private $is_authorized = false;

    public function __construct($username = null, $password = null)
    {
        $this->username = $username;
        $this->connectDb($this->db_name, $this->db_user, $this->db_pass, $this->db_host);
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public static function isAuthorized()
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool) $_SESSION["user_id"];
        }
        return false;
    }

    public function passwordHash($password, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function getSalt($login) {
        $query = "select salt from user where login = :login limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":login" => $login
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["salt"];
    }

    public function getUser($login){

        $query = "select username, surname, email, date_of_birth, avatar  from user where
            login = :login limit 1";
        $sth = $this->db->prepare($query);
        $salt = $this->getSalt($login);

        if (!$salt) {
            return false;
        }

        $sth->execute(
            array(
                ":login" => $login,
            )
        );
        $this->user = $sth->fetch();

        $result = [
            'Username' => $this->user['username'],
            'Surname'  => $this->user['surname'],
            'Email'    => $this->user['email'],

            'Date of birth' => $this->user['date_of_birth']
        ];

        return $result;
    }

    public function getNews($id){

        $query = "select id, title, description from news where
            id = :id limit 1";
        $sth = $this->db->prepare($query);

        $sth->execute(
            array(
                ":id" => $id,
            )
        );
        $result = $sth->fetch();


        return $result;
    }

    public function getComments($news_id){

        $query = "select id, COMMENT, author from comment where
            news_id = :news_id";
        $sth = $this->db->prepare($query);

        $sth->execute(
            array(
                ":news_id" => $news_id,
            )
        );
        $result = $sth->fetchAll();


        return $result;
    }

    public function getUserNews($user_id){
        $query = "select id, title, description  from news where
            user_id = :user_id";
        $sth = $this->db->prepare($query);

        $sth->execute(
            array(
                ":user_id" => $user_id,
            )
        );
        $result = $sth->fetchAll();


        return $result;
    }

    public function getUserHobby($user_id){
        $query = "select value  from hobby where
            user_id = :user_id";
        $sth = $this->db->prepare($query);

        $sth->execute(
            array(
                ":user_id" => $user_id,
            )
        );
        $result = $sth->fetchAll();


        return $result;
    }

    public function getUserEducation($user_id){
        $query = "select value  from education where
            user_id = :user_id";
        $sth = $this->db->prepare($query);

        $sth->execute(
            array(
                ":user_id" => $user_id,
            )
        );
        $result = $sth->fetch();


        return $result;
    }


    public function getAllNews(){
        $query = "select id, title, description from news ORDER BY id";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }

    public function authorize($login, $password, $remember=false)
    {
        $query = "select id, username, surname, email, login, avatar from user where
            login = :login and password = :password limit 1";
        $sth = $this->db->prepare($query);
        $salt = $this->getSalt($login);

        if (!$salt) {
            return false;
        }

        $hashes = $this->passwordHash($password, $salt);
        $sth->execute(
            array(
                ":login" => $login,
                ":password" => $hashes['hash'],
            )
        );
        $this->user = $sth->fetch();

        if (!$this->user) {
            $this->is_authorized = false;
        } else {
            $this->is_authorized = true;
            $this->user_id = $this->user['id'];
            $this->username = $this->user['username'];
            $this->login = $this->user['login'];
            $this->surname = $this->user['surname'];
            $this->date_of_birth = $this->user['date_of_birth'];
            $this->email = $this->user['email'];
            $this->avatar = $this->user['avatar'];
            $this->saveSession($remember);
        }

        return $this->is_authorized;
    }

    public function addNews($user_id, $title, $description){

        $query = "insert into news (user_id, title, description)
            values (:user_id, :title, :description)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $hobby = $sth->execute(
                array(
                    ':user_id' => $user_id,
                    ':title' => $title,
                    ':description' => $description,
                )
            );
            $this->db->commit();
            $result = true;

        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$hobby) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }

    public function  addComment($news_id, $comment, $author){
        $query = "insert into comment (news_id, comment, author)
            values (:news_id, :comment, :author)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $hobby = $sth->execute(
                array(
                    ':news_id' => $news_id,
                    ':comment' => $comment,
                    ':author' => $author
                )
            );

            $this->db->commit();
            $result = true;

        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$hobby) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }


    public function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["user_id"] = $this->user_id;
        $_SESSION["user_name"] = $this->username;
        $_SESSION["date_of_birth"] = $this->date_of_birth;
        $_SESSION["login"] = $this->login;
        $_SESSION["surname"] = $this->surname;
        $_SESSION["email"] = $this->email;
        $_SESSION["avatar"] = $this->avatar;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function update($username,  $surname, $date_of_birth, $avatar , $email, $id) {
        $user_exists = $this->getSalt($_SESSION['login']);

        if (!$user_exists) {
            throw new \Exception("User is not exists", 1);
        }

        $query="UPDATE USER SET username='.$username.', email='.$email.', surname='.$surname.', date_of_birth='.$date_of_birth.', avatar='.$avatar.' WHERE id='.$id.'";

        $sth = $this->db->prepare($query);


        try {
            $this->db->beginTransaction();
            $result = $sth->execute();
            $this->db->commit();

        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }



    public function create($username, $password, $surname, $date_of_birth, $avatar , $email, $login) {
        $user_exists = $this->getSalt($login);

        if ($user_exists) {
            throw new \Exception("User exists: " . $username, 1);
        }

        $query = "insert into user (username, email, surname, date_of_birth, login, password, avatar, salt)
            values (:username, :email, :surname, :date_of_birth, :login, :password, :avatar, :salt)";
        $hashes = $this->passwordHash($password);
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':username' => $username,
                    ':email' => $email,
                    ':surname' => $surname,
                    ':date_of_birth' => $date_of_birth,
                    ':login' => $login,
                    ':password' => $hashes['hash'],
                    ':avatar' => $avatar,
                    ':salt' => $hashes['salt'],
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }

    public function saveHobby($user_id, $value){

        $query = "insert into hobby (value, user_id)
            values (:value, :user_id)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $hobby = $sth->execute(
                array(
                    ':value' => $value,
                    ':user_id' => $user_id,
                )
            );
            $this->db->commit();
            $result = true;

        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$hobby) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }
    public function updateHobby($user_id, $value){

        $query = "UPDATE hobby SET value=:value WHERE user_id=:user_id";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $hobby = $sth->execute(
                array(
                    ':value' => $value,
                    ':user_id' => $user_id,
                )
            );
            $this->db->commit();
            $result = true;

        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$hobby) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $result;
    }

    public function saveEducation($user_id, $value){

        $query = "insert into education (value, user_id)
            values (:value, :user_id)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $education = $sth->execute(
                array(
                    ':value' => $value,
                    ':user_id' => $user_id,
                )
            );
            $this->db->commit();


        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$education) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $education;
    }

    public function updateEducation($user_id, $value){

        $query = "UPDATE education SET value=:value WHERE user_id=:user_id";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $education = $sth->execute(
                array(
                    ':value' => $value,
                    ':user_id' => $user_id,
                )
            );
            $this->db->commit();
            var_dump($education);
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$education) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        }

        return $education;
    }

    function check_code($code)
    {
        $code = trim($code);
        $cap = $_SESSION['user_code'];

        if ($code == $cap) {
            return true;
        } else {
            return false;
        }
    }


    public function connectdb($db_name, $db_user, $db_pass, $db_host = "localhost")
    {
        try {
            $this->db = new \pdo("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        } catch (\pdoexception $e) {
            echo "database error: " . $e->getmessage();
            die();
        }
        $this->db->query('set names utf8');

        return $this;
    }
}
