<?php
class albumHelper{
    
    public static function selectAll(){
        $sql = "SELECT * FROM albums ORDER BY album_id";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'album_id'=>$row['album_id'],
                'title'=>$row['title'],
                'publishing_date'=>$row['publishing_date'],
                'publisher'=>$row['publisher'],
                'cd_dvd'=>$row['cd_dvd'],               
            );
        }
        
        return $output;
    }        
    
    public static function searchAlbum($searchKey) {
        $sql = "SELECT * " .
                "FROM albums " .
                "WHERE title LIKE '%" . $searchKey . "%' " .
                "OR publisher LIKE '%" . $searchKey . "%' " .
                "ORDER BY albums.album_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)) {
            $output[]=array(
                'album_id'=>$row['album_id'],
                'title'=>$row['title'],
                'publishing_date'=>$row['publishing_date'],
                'publisher'=>$row['publisher'],
                'cd_dvd'=>$row['cd_dvd'],               
            );
        }

        return $output;
    }
        
    public static function getAlbumByAlbumID($album_id){
        $sql = "SELECT * FROM albums WHERE album_id='" . $album_id . "'";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'album_id'=>$row['album_id'],
                'title'=>$row['title'],
                'publishing_date'=>$row['publishing_date'],
                'publisher'=>$row['publisher'],
                'cd_dvd'=>$row['cd_dvd'],               
            );
        }
        
        return $output;
    }        
}

