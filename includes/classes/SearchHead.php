
<?php

class SearchHead {

    private static $term = "";

    public static function setTerm($term) {
           self::$term = $term;
    }

    public static function getTerm() {
       return self::$term;
 }
}

?>