
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Music On Mood</title>
    
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleindex.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleMainPage.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleAlbumPage.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleSongTrackRow.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleNav.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleFooter.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleArtistPage.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleSearchPage.css" />
    <link rel="stylesheet" type="text/css" href="includes/Assets/css/styleUserDetail.css" />
 

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="includes/Assets/js/audio.js"></script>
</head>
<body>

<?php 

include('includes/classes/SearchHead.php');

$query = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

$arrayId = array();

while($row = mysqli_fetch_array($query)) {
  array_push($arrayId, $row['id']);
}

$jsonId = json_encode($arrayId);



?>

<script> 

  $(document).ready(function(){
    var newPlaylist = <?php echo $jsonId ; ?> ;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist ,false);
    updateVolumeBar( audioElement.audio);


    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
      e.preventDefault();
    });
    
   $("#progress").mousedown(function() {
         mouseDown  = true;
   });
   
   $("#progress").on("touchstart", function(e) {
         touchStart  = true;
         timeFromOffsetTouch(e, this);
   });

   $("#progress").mousemove(function(e) {
    
     if(mouseDown) {
       timeFromOffset(e, this);
     }
     });

     
   $("#progress").on("touchmove", function(e) {
    
     if(touchStart) {
      timeFromOffsetTouch(e, this);
     }
     });

   $("#progress").mouseup(function(e) {
    timeFromOffset(e, this);
    });

    //  volume bar
     
   $(".bar").mousedown(function() {
         mouseDown  = true;
   });

   $(".bar").on("touchstart", function(e) {
         touchStart  = true;
         var percentage = (e.targetTouches[0].pageX - e.target.offsetLeft) / $(this).width();
         audioElement.audio.volume = percentage;
   });

   
   $(".bar").mousemove(function(e) {
     if(mouseDown) {
       var percentage = e.offsetX / $(this).width();
       audioElement.audio.volume = percentage;
     }
     });

     $(".bar").on("touchmove", function(e) {
         if(touchStart) {
         var percentage = (e.targetTouches[0].pageX - e.target.offsetLeft) / $(this).width();
         audioElement.audio.volume = percentage;
        }
   });

   $(".bar").mouseup(function(e) {
       var percentage = e.offsetX / $(this).width();
       audioElement.audio.volume = percentage;
    });

    $(document).mouseup(function(){
      mouseDown = false;
    });
  });

  function timeFromOffset(mouse, progress) {
     var percentage = mouse.offsetX / $(progress).width() * 100;
     var seconds  = audioElement.audio.duration * (percentage /100);
     audioElement.setTime(seconds);
  }

  
  function timeFromOffsetTouch(mouse, progress) {
     var percentage = (mouse.targetTouches[0].pageX - mouse.target.offsetLeft)/ $(progress).width() * 100;
     var seconds  = audioElement.audio.duration * (percentage /100);
     audioElement.setTime(seconds);
  }

  function setRepeat() {
    repeat = !repeat ;
    image = repeat ? "includes/Assets/icons/repeat-active.png" : "includes/Assets/icons/repeat.png";
    $(".controlButton.repeat img").attr("src", image);
  }

  function playNext() {
    if(repeat) {
      audioElement.setTime(0);
      playSong();
      return;
    }

    if(currentIndex == currentPlaylist.length - 1) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex]:currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
  }

  function playPrev() {
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0 ) {
      audioElement.setTime(0);
    } else {
      currentIndex--;
    }
    setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
  }

  function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var img = audioElement.audio.muted ? "includes/Assets/icons/volume-mute.png":"includes/Assets/icons/volume.png" ;
    $("#nowPlayingBarRight .icon img").attr("src", img);
  }

  function setShuffle() {
    shuffle = !shuffle;
    var img = shuffle ? "includes/Assets/icons/shuffle-active.png":"includes/Assets/icons/shuffle.png" ;
    $(".controlButton.shuffle img").attr("src", img);

    if(shuffle) {
      shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentPlaying.id);
    } else {
      currentIndex = currentPlaylist.indexOf(audioElement.currentPlaying.id);
    }
  }

  function shuffleArray(a) {
    var i,j,k;
    for( i = a.length; i; i--) {
      j= Math.floor(Math.random() * i);
      x = a[i - 1];
      a[i - 1] = a[j];
      a[j] = x;
    }
  }

  function setTrack(trackId, newPlaylist , play) {

    if(newPlaylist != currentPlaylist) {
      currentPlaylist = newPlaylist;
      shufflePlaylist = currentPlaylist.slice();
      shuffleArray(shufflePlaylist);
    }

    if(shuffle) {
      currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
      currentIndex = currentPlaylist.indexOf(trackId);
    }

     pauseSong();
     
      $.post("includes/Assets/ajax/getSong.php", {songId : trackId}, function(data) {
          track = JSON.parse(data);
          $(".footerInfo h2").text(track.title);
          audioElement.setTrack(track);

          $.post("includes/Assets/ajax/getArtist.php", {artistId : track.artist}, function(data) {

            artist = JSON.parse(data);
            $(".footerInfo p").text(artist.name);
            $(".footerInfo p").attr("onclick", "openPage('artist.php?id="+ artist.id +"')")
          });

          $.post("includes/Assets/ajax/getAlbum.php", {albumId : track.album}, function(data) {

              album = JSON.parse(data);
              $(".footerIcon img").attr("src", album.artworkPath);
              $(".footerIcon img").attr("onclick", "openPage('albumid.php?id="+ album.id +"')")
             });

             
      if(play) {
        playSong();
      }
      });

  }
  

  function playSong() {
    // $(".controlButton.play").hide();
    // $(".controlButton.pause").show();
    if(audioElement.audio.currentTime == 0) {
      $.post("includes/Assets/ajax/updatePlays.php",{songId: audioElement.currentPlaying.id });
    }
    document.getElementById("playDisplay").style.display = "none";
    document.getElementById("pauseDisplay").style.display = "block";
    audioElement.play();
  }

  function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
  }

</script>

  <div class="mainContainer">

      <div id="topContainer">

           <!-- navbar -->

           <nav id="navigationContainer">
                <div class="navbar">
                      <div class="navIconWrapper">
                          <div id="logo" roll="link"  onclick="openPage('index.php')">
                                <img src="includes\Assets\icons\logo1.png" alt="logo">
                                <h1>MARS</h1>
                                <h3>music ON mood</h3>
                          </div>

                          <div class="searchBarHead">
                          <input type="text" id ="clearMe" class="searchHead"  value= "<?php echo SearchHead::getTerm();?>" >
                          <img src="includes\Assets\icons\searchgray.png" alt="">
                          </div>
                                 
                              <script>

                                $(function() {
                                    
                                    $(".searchHead").keyup( function() {
                                        
                                        clearTimeout(timer);

                                        timer = setTimeout(function() {
                                        var val = $(".searchHead").val();
                                        console.log(val);
                                        openPage("searchHead.php?term=" + val);
                                        }, 1500);
                                });
                                });

                              </script>

                          <div  class="menu" onclick="setMenu()">
                            <img src="includes\Assets\icons\menu.png" alt="menu">
                          </div>
                      </div>

                         

                        <div id="setMenu" class="navLinksHide">
                            <div class="title " id="active">
                                  <img src="includes\Assets\icons\homegray.png" alt="">
                                  <span class="text" roll="link"  onclick="openPage('index.php')">Home</span>
                              </div>
                              <div class="title searchBarSearchPage">
                                  <img src="includes\Assets\icons\searchgray.png" alt="">
                                  <span class="text" roll="link"  onclick="openPage('search.php')">Search</span>
                              </div>
                              <div class="title">
                                  <img src="includes\Assets\icons\librarygray.png" alt="">
                                  <span class="text" roll="link"  onclick="openPage('yourMusic.php')">Library</span>
                              </div>
                              <div class="title">
                                  <img src="includes\Assets\icons\logout-32.png" alt="">
                                  <span class="text" roll="link"  onclick="openPage('settings.php')">LogOut</span>
                              </div>
                         </div>
                </div>
            </nav> 
            
            <div id="mainPage">
               <div id="mainContent">
