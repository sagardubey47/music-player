<?php

include("includes/config.php");
include("includes/components/includedFiles.php");


if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
}

$userLoggedIn = new User($con, $userLoggedIn);

$userName = $userLoggedIn->getUserFullName();


?>

    <div id="mainPage">
        <div id="mainContent">
                <h1 style="margin: 20px; text-align: center;"><?php  echo $userName ?></h1>
                <button class="btn" id="yourMusicBtn" onclick="openPage('userDetail.php')" style="margin: 20px auto;">User Detail</button>
                <button class="btn" id="yourMusicBtn" onclick="logout()" style="margin: 20px auto;">LogOut</button>

        </div>
    </div>