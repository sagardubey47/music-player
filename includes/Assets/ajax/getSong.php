<?php 
include("../../config.php");

if(isset($_POST['songId'])) {

    $id = $_POST['songId'];

    $query = mysqli_query($con, "SELECT * FROM songs WHERE id='$id' ");

    $resultArray = mysqli_fetch_array($query);

    echo json_encode($resultArray);
}


?>