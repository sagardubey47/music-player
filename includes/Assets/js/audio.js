
var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement ;
var mouseDown = false;
var touchStart = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;
var menu = false;
var term = '';

function logout() {
    $.post("includes/Assets/ajax/logout.php", function(){
        location.reload();
    });
}

function updateEmail(id) {
    emailValue = $("#" + id).val()
     
    $.post("includes/Assets/ajax/updateEmail.php", {email: emailValue})
    .done(function(response) {
        $("#" + id).nextAll("#msg1").text(response);
    });  
}

function updatePassword(oldPasswordId, newPasswordId1, newPasswordId2) {

     oldPassword = $("#" + oldPasswordId).val();
     newPassword1 = $("#" + newPasswordId1).val();
     newPassword2 = $("#" + newPasswordId2).val();

    $.post("includes/Assets/ajax/updatePassword.php", 
    {  
        oldPassword: oldPassword, 
        newPassword1: newPassword1,
        newPassword2: newPassword2 
    })
    .done(function(response) {
       
        $("#" + newPasswordId2).nextAll("#msg2").text(response);
    });  
}



function setMenu() {
      menu = !menu;
      
      if(menu) {
        document.getElementById("setMenu").classList.toggle("navLinksHide");
        $(".menu img").attr("src", "includes/Assets/icons/icons8-multiply-48.png")
      } else {
        document.getElementById("setMenu").classList.toggle("navLinksHide");
        $(".menu img").attr("src", "includes/Assets/icons/menu.png")
      }
}




$(document).click(function(click) {
    var target = $(click.target);
    if( !target.hasClass("items") && !target.hasClass("optionsMenu") && !target.hasClass("moreicon")) {
        hideOptionMenu();
    }
});

$(document).on("change", "select.playlist", function() {
      var select = $(this);
      var playlistId = select.val();
      var songId = select.prev(".songId").val();
      
      $.post("includes/Assets/ajax/addToPlaylist.php", {playlistId: playlistId, songId: songId })
      .done(function(error) {
        if(error != "") {
            alert(error);
        }

        hideOptionMenu();
        select.val("");
      });
}); 


$(window).scroll(function() {
    hideOptionMenu();
});

function openPage(url) {
    
    if(timer != null) {
        clearTimeout(timer);
    }

    if(url.indexOf("?") == -1) {
       url = url + "?";
    }
   
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}

function createPlaylist() {
    var playlistName = prompt("input the name of playlist");
    if(playlistName != null) {
        
        $.post("includes/Assets/ajax/createPlaylist.php", {  name: playlistName})
        .done(function(error){
            if(error != "") {
                alert(error);
            }
          
            openPage("yourMusic.php");
        });
    }
}

function deletePlaylist(playlistId) {

    console.log(playlistId);
    var prompt = confirm("Are you sure, you want to delete this playlist");
    if (prompt) {
        $.post("includes/Assets/ajax/deletePlaylist.php", {  playlistId: playlistId})
        .done(function(error){
            if(error != "") {
                alert(error);
            }
            openPage("yourMusic.php");
        });
    }
}

function removeFromPlaylist(button, playlistId) {
    var songId = $(button).prevAll(".songId").val();

    $.post("includes/Assets/ajax/removeFromPlaylist.php", {  playlistId: playlistId, songId: songId})
     .done(function(error){
        if(error != "") {
            alert(error);
        }
        openPage("playlistSong.php?id=" + playlistId);
     });

}

function showOptionMenu(button) {

    var songId = $(button).prevAll(".songId").val();
    var menu = $(".optionsMenu");
    var menuWidth = menu.width();
    menu.find(".songId").val(songId); 

    var scrollTop = $(window).scrollTop();
    var elementOffset = $(button).offset().top;

    var top = elementOffset - scrollTop;
    var left = $(button).position().left;

    menu.css({ "top": top + "px", "left": left - menuWidth + "px", "display": "block"});


}

function hideOptionMenu() {
    var menu = $(".optionsMenu");
    if(menu.css("display") != "none") {
        menu.css({"display" : "none"});
    }
}

function formateTime(second) {
    var time  = Math.round(second );
    var minute = Math.floor((time / 60));
    var remainingSecond = (time - minute*60);
    var extraZero = (remainingSecond > 9) ? "": "0" ;
    return minute + ":" + extraZero + remainingSecond ; 
}

function updateProgressBar(audio) {
    $("#time").text(formateTime(audio.currentTime));

    var progress = audio.currentTime / audio.duration *100 ;
    $("#progressCurrent").css("width", progress + "%");
}

function updateVolumeBar(audio) {
    var volume = audio.volume * 100;
    $(".barprogress").css("width", volume + "%");
}
function Audio () {
    this.currentPlaying ;
    this.audio = document.createElement('audio');
    this.audio.addEventListener("canplay", function () {
        var duration = formateTime(this.duration);
        $("#remainingTime").text(duration);
    });

    this.audio.addEventListener("timeupdate", function() {
         if(this.duration) {
             updateProgressBar(this);
         }
    });

    this.audio.addEventListener("volumechange", function() {
       updateVolumeBar(this);
   });

   this.audio.addEventListener("ended", function() {
       playNext();
    });


    this.setTrack = function(track) {
        this.currentPlaying = track;
        this.audio.src =track.path;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }

    this.setTime = function(seconds) {
        
        this.audio.currentTime = seconds;
    }
}
