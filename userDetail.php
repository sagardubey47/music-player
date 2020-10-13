<?php
include("includes/config.php");
include("includes/components/includedFiles.php");


if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
}

$userLoggedIn = new User($con, $userLoggedIn);
$email = $userLoggedIn->getEmail();

?>



        <div class="userDetailContainer">
            <div class="firstCOntainer">
                <h1 class="userDetailH1" >Email</h1>
               <input id="email" class="userDetailInput" type="text" name="email" placeholder="email" value="<?php echo $email ?>">
               <span id="msg1" class="userDetailSpan" ></span>
               <button class="btn userDetailButton" onclick="updateEmail('email')">Save</button>
            </div>
            <div class="secondContiner">
               <h1 class="userDetailH1">Password</h1>
               <input id="oldPassword" class="userDetailInput" type="password" name="oldPassword" placeholder="old Password">
               <input id="newPassword1" class="userDetailInput" type="password" name="newPassword1" placeholder="new Password">
               <input id="newPassword2" class="userDetailInput" type="password" name="newPassword2" placeholder="confirm Password">
               <span id="msg2" class="userDetailSpan"> </span>
               <button class="btn userDetailButton" onclick="updatePassword('oldPassword', 'newPassword1', 'newPassword2')">Save</button>
            </div>
        
        </div>
    
