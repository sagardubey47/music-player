<?php 
 
  function sanitizeFormDataString($input) {
      $input = strip_tags($input);
      $input = str_replace(" ","",$input);
      $input = ucfirst(strtolower($input));
       return $input;
  }

function sanitizeFormDataUsername($input) {
    $input = strip_tags($input);
    $input = str_replace(" ","",$input);
    return $input;
}

function sanitizeFormDataPassword($input) {
    $input = strip_tags($input);
    return $input;
}

if(isset($_POST['register'])) {

    $username = sanitizeFormDataUsername($_POST['user_name']);
    $firstName = sanitizeFormDataString($_POST['First_name']);
    $lastName = sanitizeFormDataString($_POST['Last_name']);
    $email = sanitizeFormDataString($_POST['email']);
    $password1 = sanitizeFormDataPassword($_POST['password1']);
    $password2 = sanitizeFormDataPassword($_POST['password2']);

    $result = $account->register($username, $firstName, $lastName, $email, $password1, $password2 );

    if($result == true) {
        
        $_SESSION['userLoggedIn'] = $username;
        header("Location:index.php");
    } 

}


?>