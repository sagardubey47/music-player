<?php 
include("../../config.php");

if(isset($_POST['artistId'])) {

    $id = $_POST['artistId'];

    $query = mysqli_query($con, "SELECT * FROM artists WHERE id='$id' ");

    $resultArray = mysqli_fetch_array($query);

    echo json_encode($resultArray);
}


?>