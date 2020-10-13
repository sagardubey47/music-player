<?php 

ob_start();
session_start();

$timeZone = date_default_timezone_set("Asia/Kolkata");
$con = mysqli_connect("localhost","root", "","music_player");


if(mysqli_connect_errno()) {
    echo "failed to connect database:" . mysqli_connect_errno();
}

?>