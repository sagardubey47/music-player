<?php 

class Song {

    private $id ;
    private $connection;
    
    private $artistId ;
    private $genreId ;
    private $songId ;
    private $duration ;
    private $title ;
    private $songPath ;

    public function __construct($con, $id) {
        $this->id = $id;
        $this->connection = $con;

        $songQuery = mysqli_query($this->connection, "SELECT * FROM songs WHERE id='$this->id' ORDER BY albumOrder ASC");
        $song = mysqli_fetch_array($songQuery);

        $this->artistId = $song['artist'];
        $this->genreId = $song['genre'];
        $this->songId = $song['id'];
        $this->duration = $song['duration'];
        $this->title = $song['title'];
        $this->songPath = $song['path'];
    }

    public function getName() {  
       
        return $this->title;
    }

    public function getDuration() {  
       
        return $this->duration;
    }

    public function getSongId() {  
       
        return $this->songId;
    }

    public function getSongPath() {  
       
        return $this->songPath;
    }

    public function getArtist() {  
       
        return new Artist($this->connection, $this->artistId);
    }

    
}
?>
