<?php
class authorHelper{
    
    public static function selectAll(){
        $sql = "SELECT * FROM authors ORDER BY authorname";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'author_id'=>$row['author_id'],
                'authorname'=>$row['authorname'],
                'gender'=>$row['gender'],            
            );
        }
        
        return $output;
    }        
        
    public static function getAuthorByAuthorID($author_id){
        $sql = "SELECT * FROM authors WHERE author_id='" . $author_id . "'";
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'author_id'=>$row['author_id'],
                'authorname'=>$row['authorname'],
                'gender'=>$row['gender'],            
            );
        }
        
        return $output;
    }   
    
    public static function searchAuthor($searchKey) {
        $sql = "SELECT * " .
                "FROM authors " .
                "WHERE author_id LIKE '%" . $searchKey . "%' " .
                "OR authorname LIKE '%" . $searchKey . "%' " .
                "ORDER BY authors.authorname";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'author_id'=>$row['author_id'],
                'authorname'=>$row['authorname'],
                'gender'=>$row['gender'],            
            );
        }

        return $output;
    }
}

