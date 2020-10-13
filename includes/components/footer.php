        
        </div>
     </div>     
        
        <div id="nowPlayingBarContainer">
            <div id="nowPlayingBar">

             <!-- left container -->
                <div id="nowPlayingBarLeft">
                    <div class="footerIcon">
                        <img src="" alt="footerIcon">
                    </div>
                    <div class="footerInfo">
                        <h2>
                            
                        </h2>
                        <p class="getArtist">
                            
                        </p>
                    </div> 
                </div>

             <!-- middle container -->
                <div id="nowPlayingBarMiddle">
                        <div class="controls">
                            <div class="controlButton shuffle">
                                <button> <img src="includes\Assets\icons\shuffle.png" alt="shuffle" onclick='setShuffle()' ontouchstart='setShuffle()'></button>
                            </div>
                            <div class="controlButton previous">
                                <button> <img src="includes\Assets\icons\previous.png" alt="previous" onclick='playPrev()' ontouchstart='playPrev()'></button>
                            </div>
                            <div class="controlButton play" id="playDisplay">
                                <button> <img src="includes\Assets\icons\play.png" alt="play" onclick='playSong()' ontouchstart='playSong()' ></button>
                            </div>
                            <div class="controlButton pause" id="pauseDisplay" style="display:none;">
                                <button> <img src="includes\Assets\icons\pause.png" alt="pause" onclick='pauseSong()' ontouchstart='pauseSong()'></button>
                            </div>
                            <div class="controlButton next">
                                <button> <img src="includes\Assets\icons\next.png" alt="next" onclick="playNext()" ontouchstart='playNext()'></button>
                            </div>
                            <div class="controlButton repeat">
                                <button> <img src="includes\Assets\icons\repeat.png" alt="repeat" onclick="setRepeat()" ontouchstart='setRepeat()'></button>
                            </div>
                       </div>
                        <div id="progressBar">
                            <div id="time">00.0</div>
                            <div id="progress">
                                <div id="progressCurrent"></div>
                            </div>
                            <div id="remainingTime">00.0</div>
                        </div>
                </div>

             <!--  Right Container-->
                <div id="nowPlayingBarRight">
                    <div id="volume">
                        <div class="icon">
                            <img src="includes\Assets\icons\volume.png" alt="volumeIcon" onclick="setMute()" ontouchstart='setMute()'>     
                        </div>
                        <div class="bar">
                            <div class="barprogress"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>