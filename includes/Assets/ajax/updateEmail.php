<?php 

  include("../../config.php");

  
  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    }

   if(isset($_POST['email']) && $_POST['email'] != "") {

       $email = $_POST['email'];

       if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           echo "email is invalid !!";
           exit();
       }

       $emailCheck = mysqli_query($con, "SELECT email FROM user_table WHERE email='$email' AND user_name !='$userLoggedIn'");

       if(mysqli_num_rows($emailCheck) > 0 ) {
           echo "email already exists.";
           exit();
       }

       $updateQuery = mysqli_query($con, "UPDATE user_table set email = '$email' WHERE user_name = '$userLoggedIn'");

       echo "updated succesfully";

   } else {
       echo "you must provide an email";
   }
?>