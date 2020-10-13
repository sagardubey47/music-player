<?php 


include("includes/classes/Account.php");
include("includes/classes/Constants.php");
include("includes/config.php");

 $account = new Account($con);

 include("includes/handler/loginHandler.php");
 include("includes/handler/registerHandler.php");
 
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music on Mood</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="includes\Assets\css\styleregister.css" />
</head>
<body>

  <div class="container">
        <div class="main-container">
            <div id="login-form">
                <h2>Login to your Account</h2>
                <form  action="Register.php" method="POST">
                  <p>
                  <span class="error">
                    <?php  echo $account-> getError(Constants::$loginProblem); ?>
                    </span>
                  <label for="login_user_name" class="label"> Username</label>
                  <input type="text" name="login_user_name" placeholder="sagar47" require/>
                  </p>
                  <p>
                  <label for="login_email" class="label"> Email</label>
                  <input type="email" name="login_email" placeholder="sagar47@gmail.com" require/>
                  </p>
                  <p>
                  <label for="login_password" class="label"> Password</label>
                  <input type="password" name="login_password" placeholder="your password" require/>
                  </p>
                  <button type="submit" name="login">Log in</button>
                  <div class="haveAccount">
                  <span id="hideLogin">Don't have an account ? signUp here</span>
                  </div>
                </form>
              </div>
              <div id="register-form">
                <h2>Register for free </h2>
                <form  action="Register.php" method="POST" >
                  <p>
                  <span class="error">
                  <?php  echo $account-> getError(Constants::$usernameCharacter); ?>
                  <?php  echo $account-> getError(Constants::$userExists); ?>
                  </span>
                 
                  <label for="user_name" class="label"> Username</label>
                  <input type="text" name="user_name" placeholder="sagar47" require/>
                  </p>
                  <p>
                  <span class="error">
                  <?php  echo $account-> getError(Constants::$firstnameCharacter); ?>
                  </span>
                  

                  <label for="First_name"> First name</label>
                  <input type="text" name="First_name" placeholder="sagar" require/>
                  </p>
                  <p>
                  <span class="error">
                  <?php  echo $account-> getError(Constants::$lastnameCharacter); ?>
                  </span>
                  
                  
                  <label for="Last_name"> Last name</label>
                  <input type="text" name="Last_name" placeholder="dubey"/>
                  </p>
                  <p>
                  <span class="error">
                  <?php  echo $account-> getError(Constants::$emailInvalid); ?>
                  <?php  echo $account-> getError(Constants::$emailExists); ?>
                  </span>
                  
                  <label for="email"> Email</label>
                  <input type="email" name="email" placeholder="sagar47@gmail.com" require/>
                  </p>
                  <p>
                  <span class="error">
                  <?php  echo $account-> getError(Constants::$passwordCharacter); ?>
                  <?php  echo $account-> getError(Constants::$passwordAlphaNumeric); ?>
                  </span>
                  
                  <label for="password1"> Password</label>
                  <input type="password" name="password1" placeholder="set password" require/>
                  </p>
                  <p>
                  <span class="error">
                  <?php  echo $account-> getError(Constants::$passwordCharacter); ?>
                  <?php  echo $account-> getError(Constants::$passwordAlphaNumeric); ?>
                  <?php  echo $account-> getError(Constants::$passwordNotMatch); ?>
                  </span>
            
                  <label for="password2"> Confirm Password </label>
                  <input type="password" name="password2" placeholder="confirm password" require/>
                  </p>
                  <button type="submit" name="register">Resister</button>
                  <div class="haveAccount">
                      <span id="hideRegister">Already have an Account ? login here</span>
                   </div>
                </form>
              </div>
         </div>
         <div id="right-section">

            <h1>Where words fail, music speaks</h1>
            <h2>Get on the track. </h2>
            <ul>
              <li>discover music you will fall in love with</li>
              <li>Create your own playlists</li>
              <li>Follow artists to keep up to date</li>
            </ul>
          </div>

  </div>
  
  
<?php 
  if(isset($_POST['register'])) {
   
    echo '<script type="text/javascript" >
     $(document).ready(function() {
      $("#login-form").hide();
      $("#register-form").show();
      }); 
    </script >';
  } else {
    
    echo '<script  type="text/javascript" >
      $(document).ready(function() {
        $("#login-form").show();
        $("#register-form").hide();
      });
    </script >';
  }
  ?>

  <script type="text/javascript">
     document.getElementById("login-form").style.display = "block";
     document.getElementById("register-form").style.display = "none"; 
     
    document.getElementById("hideLogin").onclick = function() {
     document.getElementById("login-form").style.display = "none";
     document.getElementById("register-form").style.display = "block";
   }

   document.getElementById("hideRegister").onclick = function() {
     document.getElementById("register-form").style.display = "none";
     document.getElementById("login-form").style.display = "block";
   }

  </script>
</body>
</html>