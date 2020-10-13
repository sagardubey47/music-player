 
   <?php

     include("includes/config.php");
     include("includes/components/includedFiles.php"); 
  
     // main content 

     

    
    if(isset($_SESSION['userLoggedIn'])) {
        $username = $_SESSION['userLoggedIn'];
    }

     if(isset($_GET['id'])) {
         $id = $_GET['id'];
         
     } else {
         header("Location: index.php");
     }
        $albumObj = new Album($con, $id);
        $artistObjByAlbum = $albumObj->getArtist();
       
        $artistNamebyAlbum = $artistObjByAlbum->getName();
        $artistId = $artistObjByAlbum->getId();

        $albumName = $albumObj->getName();
        $artworkPath = $albumObj->getArtworkPath();
        $numOfSongs = $albumObj->getNumOfSongs();
        $songIds = $albumObj->getSongIds();

     ?>

             <!-- album page -->
        <div id="mainPage">
            <div id="mainContent">
                <div id="albumContainer">
                    <div class="rightContainer albumIcon">
                    <img src="<?php echo $artworkPath ;?>" alt="albumIcon">
                    </div>
                    <div class="leftContainer">
                    <h1><?php echo $albumName ;?></h1>
                    <p>by <span class='getArtist' onclick='openPage("artist.php?id=<?php echo $artistId ?>")'><?php echo $artistNamebyAlbum ;?></span></p>
                    </div>
                </div>

        
                <div id="songTrackContainer">
             
                    <?php
                        $count = 1;
                        foreach( $songIds as $songId) {
                            $songObj = new Song($con, $songId);
                            $songName = $songObj->getName();
                            $duration = $songObj->getDuration();

                            $artistBySongObj = $songObj->getArtist();
                            $artistNamebySong =  $artistBySongObj->getName();
                            
                        echo "
                        <div class='songTrackRow' >
                        <div class='leftIcon' onclick='setTrack(\"".$songObj->getSongId()."\", tempPlaylist, true)'>
                        <img class='playicon' src='includes\Assets\icons\play-white.png' alt='' onclick='setTrack(\"".$songObj->getSongId()."\", tempPlaylist, true)'/>
                        <span id='count'> ". $count ."</span>
                        </div>
                        <div class='info' onclick='setTrack(\"".$songObj->getSongId()."\", tempPlaylist, true)'>
                        <span class='songTitle'>". $songName."</span>
                        <span class='songArtist' > ". $artistNamebySong." </span>
                        </div>
                        <div class='rightIcon'>
                        <input type='hidden' class='songId' value='".$songObj->getSongId()."'>
                        <img class='moreicon' src='includes\Assets\icons\more.png' alt='' onclick='showOptionMenu(this)'/>
                        <span class='duration'>". $duration."</span>
                        </div>
                        </div>
                        ";

                        $count++;
                        }
                    ?>

                    <script>

                        tempIds = '<?php echo json_encode($songIds);?>';
                        tempPlaylist = JSON.parse(tempIds);
                    </script>

                </div>

                <nav class="optionsMenu">
                    <input type="hidden" class="songId">
                   <?php echo Playlist::getPlaylistDropdown($con, $username);?>
                </nav>
              </div>
         </div>
    </div>
    <!-- footer -->
    
 