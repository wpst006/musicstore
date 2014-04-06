<?php

class songHelper {

    public static function getSongByAlbumID($album_id) {
        $sql = "SELECT * " .
                "FROM songs " .
                "WHERE album_id='" . $album_id . "' " .
                "ORDER BY songs.song_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'song_id' => $row['song_id'],
                'title' => $row['title'],
                'length' => $row['length'],
                'album_id' => $row['album_id'],
                'song_type' => $row['song_type'],
                'filename' => $row['filename'],
                'unitprice' => $row['unitprice'],
                'vote_count' => $row['vote_count']
            );
        }

        return $output;
    }

    public static function getTop10Songs() {
        $artists_songs_Array =songHelper::get_artists_songs_Array();        
        $authors_songs_Array =songHelper::get_authors_songs_Array();
        
        $sql = "SELECT songs.song_id,songs.title,songs.`length`,songs.song_type,songs.unitprice,temp.`purchase_count`
                FROM 
                songs
                INNER JOIN 
                (SELECT
                    song_id,COUNT(*) AS `purchase_count`
                FROM 
                `purchasedetails`
                GROUP BY song_id               
                LIMIT 10) as temp
                ON
                songs.song_id=temp.song_id 
                ORDER BY `purchase_count` DESC";

        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'song_id' => $row['song_id'],
                'title' => $row['title'],
                'length' => $row['length'],
                'song_type' => $row['song_type'],
                'artists' =>  songHelper::get_artists_name($artists_songs_Array, $row['song_id']),
                'authors' => songHelper::get_authors_name($authors_songs_Array, $row['song_id']),
                'unitprice' => $row['unitprice'],
                'purchase_count' => $row['purchase_count']
            );
        }

        return $output;
    }

    public static function getSongBySongID($song_id) {
        $sql = "SELECT * " .
                "FROM songs " .
                "WHERE song_id='" . $song_id . "' " .
                "ORDER BY songs.song_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'song_id' => $row['song_id'],
                'title' => $row['title'],
                'length' => $row['length'],
                'album_id' => $row['album_id'],
                'song_type' => $row['song_type'],
                'filename' => $row['filename'],
                'unitprice' => $row['unitprice'],
                'vote_count' => $row['vote_count']
            );
        }

        return $output;
    }

    public function getSongByAlbumID2($album_id) {
        $song_sql = "SELECT * FROM `songs` " .
                "WHERE album_id='" . $album_id . "' " .
                "ORDER BY `title`";
        $song_result = mysql_query($song_sql) or die(mysql_error());

        $artists_songs_Array =songHelper::get_artists_songs_Array();        
        $authors_songs_Array =songHelper::get_authors_songs_Array();
                
        $song_Array = array();

        while ($song_row = mysql_fetch_array($song_result)) {
            $song_Array[] = array(
                'song_id' => $song_row['song_id'],
                'title' => $song_row['title'],
                'length' => $song_row['length'],
                'album_id' => $song_row['album_id'],
                'song_type' => $song_row['song_type'],
                'artists' =>  songHelper::get_artists_name($artists_songs_Array, $song_row['song_id']),
                'authors' => songHelper::get_authors_name($authors_songs_Array, $song_row['song_id']),
                'filename' => $song_row['filename'],
                'unitprice' => $song_row['unitprice'],
                'vote_count' => $song_row['vote_count']
            );
        }

        return $song_Array;
    }

    public static function get_artists_songs_Array() {
        $artists_songs_sql = "SELECT `artists_songs`.`song_id`,`artists_songs`.`artist_id`,`artists`.`artistname` " .
                "FROM `artists_songs` " .
                "INNER JOIN " .
                "`artists`" .
                "ON `artists_songs`.`artist_id`=`artists`.`artist_id` " .
                "ORDER BY `song_id`, `artistname`";
        $artists_songs_result = mysql_query($artists_songs_sql) or die(mysql_error());

        $artists_songs_Array = array();

        while ($row = mysql_fetch_array($artists_songs_result)) {
            $artists_songs_Array[] = array(
                'song_id' => $row['song_id'],
                'artist_id' => $row['artist_id'],
                'artistname' => $row['artistname']
            );
        }

        return $artists_songs_Array;
    }

    public static function get_artists_name($artists_songs_Array, $song_id) {
        $artists_name = '';

        foreach ($artists_songs_Array as $item) {
            if ($item['song_id'] == $song_id) {
                $artists_name.=$item['artistname'] . ', ';
            }
        }

        //Remove last "comma" from the string
        $artists_name = rtrim($artists_name, ', ');

        return $artists_name;
    }

    public static function get_authors_songs_Array() {
        $authors_songs_sql = "SELECT `authors_songs`.`song_id`,`authors_songs`.`author_id`,`authors`.`authorname` " .
                "FROM `authors_songs` " .
                "INNER JOIN " .
                "`authors`" .
                "ON `authors_songs`.`author_id`=`authors`.`author_id` " .
                "ORDER BY `song_id`, `authorname`";
        $authors_songs_result = mysql_query($authors_songs_sql) or die(mysql_error());

        $authors_songs_Array = array();

        while ($row = mysql_fetch_array($authors_songs_result)) {
            $authors_songs_Array[] = array(
                'song_id' => $row['song_id'],
                'author_id' => $row['author_id'],
                'authorname' => $row['authorname']
            );
        }

        return $authors_songs_Array;
    }

    public static function get_authors_name($authors_songs_Array, $song_id) {
        $authors_name = '';

        foreach ($authors_songs_Array as $item) {
            if ($item['song_id'] == $song_id) {
                $authors_name.=$item['authorname'] . ', ';
            }
        }

        //Remove last "comma" from the string
        $authors_name = rtrim($authors_name, ', ');

        return $authors_name;
    }

}

?>
