<?php 
class Album {

    private $id ;
    private $connection;

    private $artistId ;
    private $genreId ;
    private $albumName ;
    private $artworkPath ;

    public function __construct($con, $id) {
        $this->id = $id;
        $this->connection = $con;

        
        $albumQuery = mysqli_query($this->connection, "SELECT * FROM albums WHERE id='$this->id'");
        $album = mysqli_fetch_array($albumQuery);
        
        $this->artistId = $album['artist'];
        $this->genreId = $album['genre'];
        $this->albumName = $album['title'];
        $this->artworkPath = $album['artworkPath'];
    }

    public function getName() {
        return $this->albumName;
    }

    public function getArtworkPath() {
        return $this->artworkPath;
    }

    public function getArtist() {
        return new Artist($this->connection, $this->artistId);
    }

    public function getNumOfSongs() {

        $albumQuery = mysqli_query($this->connection, "SELECT id FROM songs WHERE id='$this->id'");
        $NumOfSongs = mysqli_num_rows($albumQuery);
        
        return $NumOfSongs;
    }

    public function getSongIds () {  
       
        $songQuery = mysqli_query($this->connection, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");
        $array = array();

        while( $row = mysqli_fetch_array($songQuery)) {

           array_push($array, $row['id']);
        }
          return $array;
    }
   //TODO:genre object
}



?>