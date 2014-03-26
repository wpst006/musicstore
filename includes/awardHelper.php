<?php
class awardHelper{
    
    public static function selectAll(){
        $sql = "SELECT * FROM awards_view ORDER BY award_id";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'award_id'=>$row['award_id'],
                'award_year'=>$row['award_year'],
                'vote_count'=>$row['vote_count'],
                'song_id'=>$row['song_id'],
                'title'=>$row['title'],               
            );
        }
        
        return $output;
    }                      
}

