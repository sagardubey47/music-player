<?php 


  $username = '';
  $email = '';
  $password = '';
    
  if(isset($_POST['login'])) {
    
    $username = $_POST['login_user_name'];
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
  

   $result = $account->login($username, $password);

   if($result) {
     $_SESSION['userLoggedIn'] = $username;
     header("Location: index.php");
   } 
  }
?>