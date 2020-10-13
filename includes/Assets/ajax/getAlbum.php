<?php 
include("../../config.php");

if(isset($_POST['albumId'])) {

    $id = $_POST['albumId'];

    $query = mysqli_query($con, "SELECT * FROM albums WHERE id='$id' ");

    $resultArray = mysqli_fetch_array($query);

    echo json_encode($resultArray);
}


?>