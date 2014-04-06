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
        $sql = "SELECT songs.song_id,songs.title,songs.`length`,songs.song_type,songs.unitprice,temp.`purchase_count`
                FROM 
                songs
                INNER JOIN 
                (SELECT
                    song_id,COUNT(*) AS `purchase_count`
                FROM 
                `purchasedetails`
                GROUP BY song_id
                ORDER BY `purchase_count` DESC
                LIMIT 10) as temp
                ON
                songs.song_id=temp.song_id;";

        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'song_id' => $row['song_id'],
                'title' => $row['title'],
                'length' => $row['length'],
                'song_type' => $row['song_type'],
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
}

?>
