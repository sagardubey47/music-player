<?php

include("../../config.php");

if(isset($_POST['songId']) && isset($_POST['playlistId'])) {

    $songId = $_POST['songId'];
    $playlistId = $_POST['playlistId'];

    $query = mysqli_query($con, "DELETE FROM playlistsongs WHERE songId='$songId' AND playlistId='$playlistId'");
    

} else {
    echo "parameters might not be set";
}
?>