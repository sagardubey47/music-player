<?php

class Playlist {

    private $con;
    private $id;
    private $name;
    private $owner;


    public function __construct($con, $id) {
       $this->con = $con;
       $this->id = $id;

       $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE id='$id'");
       while($row = mysqli_fetch_array($playlistQuery)) {
           $this->name = $row['name'];
           $this->owner = $row['owner'];

       }
    }

    public function getId() {
        return $this->id;

    }

    public function getName() {
        return $this->name;

    }

    public function getOwner() {
        return $this->owner;
        
    }

    public static function getPlaylistDropdown($con, $username) {

        $dropdown = ' <select class=" items playlist">
                        <option value="">
                            Add to playlist
                        </option>';
        
            $query = mysqli_query($con, "SELECT id, name FROM playlists WHERE owner='$username'");
            while($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $playlist = $row['name'];
                $dropdown = $dropdown . '<option value="'.$id.'">'. $playlist.' </option>';
            }          

              return $dropdown . '</select>';        
    }
}

?>