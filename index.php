<?php
include("includes/config.php");

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script> userLoggedIn = '$userLoggedIn'; </script>";
} else {
    header("Location: Register.php");
}

?>
     
     <?php include("includes/components/includedFiles.php"); ?>
                   
    <?php include("includes/components/mainPage.php"); ?>