<?php

    include("../../config.php");

    
    if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    }
   
   if(isset($_POST['name'])) {

    $playlistName = $_POST['name'];
    $userName = $userLoggedIn;
    $date = date("Y-m-d");

    $query = mysqli_query($con, "INSERT INTO playlists VALUES ( '', '$playlistName', '$userName', '$date')");
 

   } else {
       echo "username or playlist name not passed";
   }

?>