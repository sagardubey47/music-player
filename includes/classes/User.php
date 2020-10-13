<?php

class User {

    private $con;
    private $user;

    public function __construct($con, $user) {
        $this->con = $con;
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }
    
    public function getEmail() {

        $query = mysqli_query($this->con, "SELECT email FROM user_table WHERE user_name = '$this->user' ");
        $row = mysqli_fetch_array($query);
        return $row['email'];
    }

    public function getUserFullName() {

        $query = mysqli_query($this->con, "SELECT CONCAT(first_name, ' ', last_name) AS 'name' FROM user_table WHERE user_name = '$this->user' ");
        $row = mysqli_fetch_array($query);
        return $row['name'];
    }
}

?>
