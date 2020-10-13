<?php

class PlaylistSong {

    private $con;
    private $playlistId;
    private $songIds = array();
    //private $playlistOrder;
    private $numOfSongs;


    public function __construct($con, $playlistId) {
        $this->con = $con;
        $this->playlistId = $playlistId;

        $playlistSongQuery = mysqli_query($con, "SELECT * FROM playlistsongs WHERE playlistId='$playlistId'");
        $this->numOfSongs = mysqli_num_rows($playlistSongQuery);

        while($row = mysqli_fetch_array($playlistSongQuery)) {
            array_push($this->songIds, $row['songId']);
           // $this->playlistOrder = $row['playlistOrder'];
 
        }
    }

    public function getPlaylistId() {
        return $this->playlistId;
    }

    public function getSongIds() {
        return $this->songIds;
    }

    public function getNumOfSongs() {
        return $this->numOfSongs;
    }

    // public function getPlaylistOrder() {
    //     return $this->playlistOrder;
    // } 
}

?>