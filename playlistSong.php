<?php
include("includes/config.php");
include("includes/components/includedFiles.php");

                
        if(isset($_SESSION['userLoggedIn'])) {
            $username = $_SESSION['userLoggedIn'];
        }

        if(isset($_GET['id'])) {
            $playlistId = $_GET['id'];

        } else {
            header("Location: index.php");
        }

?>


        <div id="mainPage">
            <div id="mainContent">
        
                <?php
                    
                    $playlistSongObj = new PlaylistSong($con, $playlistId);
                    $playlistObj = new Playlist($con, $playlistId);

                ?>

                <div id="albumContainer">
                    <div class="rightContainer playlistIcon">
                            <img src="includes\Assets\icons\icons8-lounge-music-playlist-96.png" alt="albumIcon">
                            
                     </div>
                    <div class="leftContainer">
                    <h1><?php echo $playlistObj->getName() ;?></h1>
                    <p>By <?php echo $playlistObj->getOwner() ;?></p>
                    <p><?php echo $playlistSongObj->getNumOfSongs() > 1 ? 'Songs' : 'Song';?> : <?php echo $playlistSongObj->getNumOfSongs(); ?> </p>
                    <button class="btn " onclick="deletePlaylist(<?php echo $playlistId ;?>)"> Delete</button>
                    </div>
                </div>

                <div id="songTrackContainer">
                    <?php

                        $songIds = $playlistSongObj->getSongIds();
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
                     <div class="items" onclick="removeFromPlaylist(this, <?php echo $playlistId ?>)">Remove from playlist</div>
                </nav>
            </div> 
        </div>
