<?php

class purchaseHelper{
    public static function getPurchase($fromDate=null,$toDate=null,$customer=null){
        $filter='';
        $customerFilter=null;
        $dateFilter=null;
        
        if (isset($fromDate) || isset($toDate) || isset($customer)){
            $filter="WHERE ";
        }
        
        if (isset($customer)){
            $customerFilter="members.firstname LIKE '%" . $customer . "%' ";            
        }
        
        if (isset($fromDate) && isset($toDate)){
            $dateFilter="purchases.purchasedate BETWEEN '$fromDate' AND '$toDate' ";
        }
        
        if (isset($customerFilter) && isset($dateFilter)){
            $filter.=$customerFilter . " AND " . $dateFilter;
        }else if (isset($customerFilter)){
            $filter.=$customerFilter;
        }else if (isset($dateFilter)){
            $filter.=$dateFilter;
        }
        
        $sql = "SELECT purchases.*,members.* " .
                "FROM purchases " .
                "INNER JOIN members " . 
                "ON purchases.member_id=members.member_id " .
                $filter . 
                "ORDER BY purchases.purchasedate DESC";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array();
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                         
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'purchase_id'=>$row['purchase_id'],
                'purchasedate'=>$row['purchasedate'],
                'member_id'=>$row['member_id'],
                'firstname'=>$row['firstname'],
                'lastname'=>$row['lastname'],
                'total'=>$row['total'],                            
            );
        }
        
        return $output;
    }  
    
    public static function getPurchaseByPurchaseID($purchase_id){
        $sql = "SELECT purchases.*,members.* " .
                "FROM purchases " .
                "INNER JOIN members " . 
                "ON purchases.member_id=members.member_id " .
                "WHERE purchases.purchase_id='" . $purchase_id . "' " .
                "ORDER BY purchases.purchasedate DESC";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array();
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                         
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'purchase_id'=>$row['purchase_id'],
                'purchasedate'=>$row['purchasedate'],
                'member_id'=>$row['member_id'],
                'firstname'=>$row['firstname'],
                'lastname'=>$row['lastname'],
                'total'=>$row['total'],                          
            );
        }
        
        return $output;
    }
    
    public static function getPurchasedetailsByPurchaseID($purchase_id){
        $sql = "SELECT * " .
                "FROM purchasedetails_view " .                
                "WHERE purchasedetails_view.purchase_id='" . $purchase_id . "' " .
                "ORDER BY purchasedetails_view.purchase_id";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array();
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                         
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'purchase_id'=>$row['purchase_id'],
                'song_id'=>$row['song_id'],
                'title'=>$row['title'],
                'length'=>$row['length'],
                'song_type'=>$row['song_type'],
                'price'=>$row['price'],
            );
        }
        
        return $output;
    }
}
?>
