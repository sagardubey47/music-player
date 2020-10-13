<?php
 include("includes/config.php");
 include("includes/components/includedFiles.php");

  
 if(isset($_SESSION['userLoggedIn'])) {
    $username = $_SESSION['userLoggedIn'];
}

if(isset($_GET['term'])) {

    $term = urldecode($_GET['term']);
    SearchHead::setTerm($term);
}  else {
    $term = "";
    SearchHead::setTerm($term);
}




?>
<!-- 
<div class="searchBar">
     <h1>search for songs , artist or album</h1>
     <input class="searchInput" type="text" value=""
      placeholder="start typing here"   />
     
</div> -->
<!-- 
<script>

    $(function() {
       
        $(".searchInput").keyup( function() {
            
            clearTimeout(timer);

            timer = setTimeout(function() {
            var val = $(".searchInput").val();
            openPage("search.php?term=" + val);
            }, 1500);
    });
    });

</script> -->

        <?php  if($term == "") exit(); ?>

        <!-- song search page -->
           <div class="artistMainContainer">
               <h1 class="titleSearchPage">SONGS</h1>
               <hr/>
                <div id="songTrackContainer">
                        <?php 
                        $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%'");

                        if(mysqli_num_rows($songsQuery) == 0) {
                            echo "<span class='noResult'> no results maching ". $term ."</span>";
                        }
                        $songIds = array();

                        $count = 1;
                        while( $row = mysqli_fetch_array($songsQuery)) {
                            array_push($songIds, $row['id']);
                        }  
                                
                        
                        $count = 1;
                        foreach( $songIds as $songId) {
                            $songObj = new Song($con, $songId);
                            $songName = $songObj->getName();
                            $duration = $songObj->getDuration();

                            $artistBySongObj = $songObj->getArtist();
                            $artistNamebySong =  $artistBySongObj->getName();
                            
                            echo "
                            <div class='songTrackRow' >
                            <div class='leftIcon' onclick='setTrack(\"".$songObj->getSongId()."\", tempPlaylist, true) '>
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
                    <nav class="optionsMenu">
                            <input type="hidden" class="songId">
                            <?php echo Playlist::getPlaylistDropdown($con, $username);?>
                    </nav>
                </div>
            </div>

           

            <!-- artist search page -->

            <div class="artistMainContainer">
                  <h1 class="titleSearchPage">Artist</h1>
                  <hr/>

                <div id="songTrackContainer">
             
                    <?php
                        $artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%'");

                        if(mysqli_num_rows($artistsQuery) == 0) {
                            echo "<span class='noResult'> no results maching ". $term ."</span>";
                        }
                        $artistIds = array();

                        $count = 1;
                        while( $row = mysqli_fetch_array($artistsQuery)) {
                            array_push($artistIds, $row['id']);
                        }  

                        foreach($artistIds as $artistId) {
                            $artistObj = new Artist($con, $artistId);
                            $artistName = $artistObj->getName();
                            echo "<h1 class='artistRow' > <span onclick='openPage(\"artist.php?id= $artistId ?>\")' >". $artistName  ."</span></h1>";
                        }
                    ?>                   
                </div>
            </div>

           <!-- album search page -->

        <div class="artistMainContainer">
           <h1 class="titleSearchPage">Album</h1>
              <hr/> 
                <?php
                                    
                    $albumquery = mysqli_query($con, "SELECT * FROM  albums WHERE title LIKE '%$term%'");

                    if(mysqli_num_rows($albumquery) == 0) {
                        echo "<span class='noResult'> no results maching ". $term ."</span>";
                    }

                    while($row = mysqli_fetch_array($albumquery)) {
                        echo  "<div class = 'gridItem'>
                        <span  onclick='openPage(\"".'albumId.php?id='. $row['id']."\" )' >
                        <img src='" .$row['artworkPath'] . "'/>
                        <h1> " . $row['title']. " </h1>                               
                        </span>
                        </div>";
                    }
                                    
                ?>
        </div>