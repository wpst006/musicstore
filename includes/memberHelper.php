<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class memberHelper{
    public static function selectAll() {
        $sql = "SELECT * " .
                "FROM members " .
                "ORDER BY member_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'member_id' => $row['member_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'DOB' => $row['DOB'],
                'contact_phone' => $row['contact_phone'],
                'contact_email' => $row['contact_email'],
                'country' => $row['country'],
                'zipcode' => $row['zipcode'],
            );
        }

        return $output;
    }

    public static function getMemberByMemberID($member_id) {
        $sql = "SELECT members.*,users.username,users.email,users.password,users.role " .
                "FROM members " .
                "INNER JOIN `users` " .
                "ON members.member_id=users.user_id " .
                "WHERE member_id='" . $member_id . "'";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'member_id' => $row['member_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'DOB' => $row['DOB'],
                'contact_phone' => $row['contact_phone'],
                'contact_email' => $row['contact_email'],
                'country' => $row['country'],
                'zipcode' => $row['zipcode'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => $row['password'],
                'role' => $row['role']
            );
        }

        return $output;
    }
    
    public static function searchMember($searchKey) {
        $sql = "SELECT * " .
                "FROM members " .
                "WHERE member_id LIKE '%" . $searchKey . "%' " .
                "OR firstname LIKE '%" . $searchKey . "%' " .
                "OR lastname LIKE '%" . $searchKey . "%' " .
                "ORDER BY members.member_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'member_id' => $row['member_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'DOB' => $row['DOB'],
                'contact_phone' => $row['contact_phone'],
                'contact_email' => $row['contact_email'],
                'country' => $row['country'],
                'zipcode' => $row['zipcode'],
            );
        }

        return $output;
    }
    
    public static function isUserNameAlreadyExist($username){
        $sql = "SELECT * " .
                "FROM users " .                
                "WHERE username='" . $username . "'";

        $result = mysql_query($sql) or die(mysql_error());

        if (mysql_num_rows($result)>0){
            return true;
        }else{
            return false;
        }
    }
}
?>
