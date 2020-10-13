<?php 

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
        
        
        include('includes/classes/Playlist.php'); 
        include('includes/classes/PlaylistSong.php'); 
        include('includes/classes/User.php'); 
        include('includes/classes/Artist.php');
        include('includes/classes/Album.php');
        include('includes/classes/Song.php');
        include('includes/classes/SearchHead.php');

        // if(isset($_GET['userLoggedIn'])) {
        //     echo $_GET['userLoggedIn'];
        //     $userLoggedIn = new User($con, $_GET['userLoggedIn']);
        // } else {
        //     echo "user not passed ";
        //     exit();
        // } 
        
} else {
   
    
if(isset($_SESSION['userLoggedIn'])) {
    
    include("includes/components/navbar.php");
    include("includes/components/mainPage.php");
    include("includes/components/footer.php");
} else {
    header("Location: Register.php");
}

   
    
    
    $url = $_SERVER['REQUEST_URI'];
    echo $url ;
    echo "<script> openPage('$url') </script>";
    exit();
}

?>


