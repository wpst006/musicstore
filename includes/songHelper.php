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

}

?>
