<?php 
      include("includes/config.php");
      include("includes/components/includedFiles.php"); 
      
if(isset($_GET['id'])) {
         $id = $_GET['id'];

     } else {
         header("Location: index.php");
     }

     $artistObj = new Artist($con, $id);
?>

        <div class="artistMainContainer">
             
                <div class="artistContainer">

                    <h1><?php echo $artistObj->getName() ?></h1>
                    <button class="btn green" onclick="setTrack(tempPlaylist[0], tempPlaylist , true)">PLAY</button>
                </div>
                

                <div id="songTrackContainer">
             
                    <?php
                        
                        $songIds = $artistObj->getSongIds();
                        $count = 1;
                        foreach( $songIds as $songId) {
                            $songObj = new Song($con, $songId);
                            $songName = $songObj->getName();
                            $duration = $songObj->getDuration();

                            $artistBySongObj = $songObj->getArtist();
                            $artistNamebySong =  $artistBySongObj->getName();
                            
                        echo "
                        <div class='songTrackRow' onclick='setTrack(\"".$songObj->getSongId()."\", tempPlaylist, true)'>
                        <div class='leftIcon'>
                        <img class='playicon' src='includes\Assets\icons\play-white.png' alt='' onclick='setTrack(\"".$songObj->getSongId()."\", tempPlaylist, true)'/>
                        <span id='count'> ". $count ."</span>
                        </div>
                        <div class='info'>
                        <span class='songTitle'>". $songName."</span>
                        <span class='songArtist' > ". $artistNamebySong." </span>
                        </div>
                        <div class='rightIcon'>
                        <img class='moreicon' src='includes\Assets\icons\more.png' alt='' />
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


        </div>