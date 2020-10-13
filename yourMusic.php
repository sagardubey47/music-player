<?php
include("includes/config.php");
include("includes/components/includedFiles.php");

?>

   <div id="mainPage">
     <div id="mainContent">
         <button class="btn" id="yourMusicBtn" onclick="createPlaylist()">create playlist</button>

         <?php
    
    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }

    $userLoggedIn = new User($con, $userLoggedIn);
    $userName = $userLoggedIn->getUser();
    $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$userName'");

    if(mysqli_num_rows($playlistQuery) == 0) {
        echo "<h1>no playlist</h1>";
    }


    
    while($row = mysqli_fetch_array($playlistQuery)) {

           $playlistObj = new Playlist($con, $row['id']);

        echo  "<div class = 'gridItem playlistContainer' onclick='openPage(\"playlistSong.php?id=".$playlistObj->getId()."\")'>
            <img src='includes\Assets\icons\icons8-lounge-music-playlist-96.png' alt='img' />
            <h1> " . $playlistObj->getName(). " </h1>
        
        </span>
    </div>";
    }
    ?>
     </div> 
    </div>


    