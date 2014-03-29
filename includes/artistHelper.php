<?php
class artistHelper{
    
    public static function selectAll(){
        $sql = "SELECT * FROM artists ORDER BY artistname";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'artist_id'=>$row['artist_id'],
                'artistname'=>$row['artistname'],
                'gender'=>$row['gender'],            
            );
        }
        
        return $output;
    }        
        
    public static function getArtistByArtistID($artist_id){
        $sql = "SELECT * FROM artists WHERE artist_id='" . $artist_id . "'";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'artist_id'=>$row['artist_id'],
                'artistname'=>$row['artistname'],
                'gender'=>$row['gender'],            
            );
        }
        
        return $output;
    }   
    
    public static function searchArtist($searchKey) {
        $sql = "SELECT * " .
                "FROM artists " .
                "WHERE artist_id LIKE '%" . $searchKey . "%' " .
                "OR artistname LIKE '%" . $searchKey . "%' " .
                "ORDER BY artists.artistname";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'artist_id'=>$row['artist_id'],
                'artistname'=>$row['artistname'],
                'gender'=>$row['gender'],            
            );
        }

        return $output;
    }
}

