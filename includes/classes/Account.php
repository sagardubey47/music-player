<?php

class Account {

    private $errorArray;
    private $connection;


    public function __construct($con) {
        $this->errorArray = array();
        $this->connection = $con;
    }

   // login handler function

    public function login($un, $pw) {
        $pw = md5($pw);
        $query = mysqli_query($this->connection, "SELECT * FROM `user_table` WHERE user_name='$un' AND password='$pw'");
        
        if(mysqli_num_rows($query) == 1) {
            
            return true;
        } else {
           
            array_push($this->errorArray, Constants::$loginProblem);
            return false;
        }
    }

   // register handler function

    public function register($un, $fn, $ln, $email, $pw1, $pw2 ) {
        $this-> validateUsername($un);
        $this-> validateFirstname($fn);
        $this-> validateLastname($ln);
        $this-> validateEmail($email);
        $this-> validatePassword($pw1, $pw2);

        if(empty($this->errorArray)) {
            return $this->insertUserData($un, $fn, $ln, $email, $pw1);
        } else {
            return false;
        }
    }

    // checking error

    public function getError($error){
         if(!in_array($error,$this->errorArray)) {
             $error = "";
         } else {
             return "<span>$error</span>";
         }
    }

    // validation of data

    private function validateUsername ($un) {
      if(strlen($un) > 25 || strlen($un) < 4) {
          array_push($this->errorArray, Constants::$usernameCharacter);
          return;
      } 
      // check whether username exists or not
      $usernameCheck = mysqli_query( $this->connection,"SELECT user_name FROM user_table WHERE user_name='$un'");
      if(mysqli_num_rows($usernameCheck) != 0) {
          array_push($this->errorArray, Constants::$userExists);
          return;
      }
    }
    
    private function validateFirstname ($fn) {
        if(strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstnameCharacter);
            return;
        }
    }
    
    private function validateLastname ($ln) {
        if(strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->errorArray, Constants::$lastnameCharacter);
            return;
        }
    }
    
    private function validateEmail ($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

      $emailCheck = mysqli_query($this->connection," SELECT email FROM user_table WHERE email='$email'");
      if(mysqli_num_rows($emailCheck) != 0) {
          array_push($this->errorArray, Constants::$emailExists);
          return;
      }
    }
    
    private function validatePassword ($pw1, $pw2) {
        
        if(strlen($pw1) > 25 || strlen($pw2) < 3) {
            array_push($this->errorArray, Constants::$passwordCharacter);
            return;
        }

        if(preg_match('/[^A-Za-z0-9]/',$pw1)) {
            array_push($this->errorArray, Constants::$passwordAlphaNumeric);
           return;
        }

        if($pw1 != $pw2) {
            array_push($this->errorArray, Constants::$passwordNotMatch);
            return;
        }

    }

    // Inserting data finally into database

    
    private function insertUserData($un, $fn, $ln, $email, $pw1) {
        $encryptPass = md5($pw1);
        $profilePic = null;
        $date = date('y-m-d');

        $result = mysqli_query($this->connection, "INSERT INTO user_table VALUES ( '', '$un', '$fn', '$ln', '$email', '$encryptPass', '$date','$profile_pic')");
       
        return $result;
        

     }

    
}

?>