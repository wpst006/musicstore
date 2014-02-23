<?php
class logIn {

    function isLogInOK($userName, $password) {
        $sql = "SELECT * FROM users " .
                "WHERE username='$userName' " .
                "AND password='$password'";

        $result = mysql_query($sql) or die(mysql_error());
        $numOfRows = mysql_num_rows($result);

        if ($numOfRows == 0)
            return false;
        else {
            $row = mysql_fetch_array($result);
            $userID = $row['user_id'];
            $role = $row['role'];

            $_SESSION['user']['user_id'] = $userID;
            $_SESSION['user']['username'] = $userName;
            $_SESSION['user']['password'] = $password;
            $_SESSION['user']['role'] = $role;

            header("Location:index.php");
            return true;
        }
    }

    function isAdminLogIn() {
        return $this->isLoggedIn("admin");
    }

    function isMemberLogIn() {
        return $this->isLoggedIn("member");
    }

    function isLoggedIn($role=null) {
        if (!isset($_SESSION['user']))
            return false;

        if (!isset($_SESSION['user']['role']))
            return false;

        if (!isset($role)){
            return true;
        }
        //Checking "role"
        //such as "member" or "admin"			
        if ($role !== $_SESSION['user']['role'])
            return false;

        return true;
    }
}
?>