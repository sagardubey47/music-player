<?php

include("../../config.php");

if(isset($_POST['playlistId']) && isset($_POST['songId'])) {

    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];

    $playlistOrderQuery = mysqli_query($con, "SELECT IFNULL( MAX(playlistOrder) + 1, 1) AS playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");
    $row = mysqli_fetch_array($playlistOrderQuery);
    $playlistOrder = $row['playlistOrder'];
    $addSongQuery = mysqli_query($con, "INSERT INTO playlistsongs VALUES ( '', '$songId','$playlistId','$playlistOrder')");
    
} else {
    echo "parameters might not be set";
}
?>