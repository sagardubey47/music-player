<?php 

  include("../../config.php");

  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    }

   if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {
       echo "not all the fields are set!";
       exit();
   }

   if( $_POST['oldPassword'] == "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {
    echo "please fill all the fields";
    exit();
   }

   $oldPassword = $_POST['oldPassword'];
   $newPassword1 = $_POST['newPassword1'];
   $newPassword2 = $_POST['newPassword2'];

   $oldPassMd5 = md5($oldPassword);
   $passCheck = mysqli_query($con, "SELECT * from user_table WHERE user_name='$userLoggedIn' AND password='$oldPassMd5' ");
   if(mysqli_num_rows($passCheck) != 1 ) {
       echo "your password is incorrect!!";
       exit();
   }

   if($newPassword1 != $newPassword2) {
       echo " new password do not match !!";
       exit();
   }

   if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
       echo "your password must contain letters and/or numbers only";
       exit();
   }

   if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5 ) {
       echo "your password must be between 5 to 30 characters";
       exit();
   }

   $newPassMd5 = md5($newPassword1);

   $updateQuery = mysqli_query($con, "UPDATE user_table SET password='$newPassMd5' WHERE user_name='$userLoggedIn'");

     echo "succesfully updated password";
?>