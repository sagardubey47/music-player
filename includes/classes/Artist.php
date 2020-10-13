<?php

class Artist {

    private $id ;
    private $connection;

    public function __construct($con, $id) {
        $this->id = $id;
        $this->connection = $con;
    }

    public function getName() {
        
        $artistQuery = mysqli_query($this->connection, "SELECT name FROM artists WHERE id='$this->id'");

        $artist = mysqli_fetch_array($artistQuery);
        return $artist['name'];
    
    }

    public function getId() { 
        return $this->id;
    }

    public function getSongIds () {  
       
        $songQuery = mysqli_query($this->connection, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY albumOrder ASC");
        $array = array();

        while( $row = mysqli_fetch_array($songQuery)) {

           array_push($array, $row['id']);
        }
          return $array;
    }
}

?>
