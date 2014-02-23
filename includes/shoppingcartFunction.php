<?php

class ShoppingCart {

    //Constructor
    public function _construct() {
        if (!isset($_SESSION['shoppingcart'])) {
            //Creating Session "Array"
            $_SESSION['shoppingcart'] = array();
        }
    }

    function getShoppingCart(){
        return $_SESSION['shoppingcart'];
    }
    
    /**
     * 
     * return values
     * 0 - Error
     * 1 - Success
     * 2 - Duplicated
     */
    function insert($song_id,$title,$artists,$price) {
        //Function Call to check
        //If the "Item" already existed in "Session"
        $index = $this->indexOf($song_id);

        //index=1 means "Item" is not existed in "Session"
        if ($index == -1) {            
            $_SESSION['shoppingcart'][]=array('song_id'=>$song_id,'title'=>$title,'artists'=>$artists,'price'=>$price); 

            return 1;
        } else {
            return 2;
        }
        
        return 0;
    }

    function remove($itemID) {
        $index = $this->indexOf($itemID);

        if ($index > -1) {
            unset($_SESSION['shoppingcart'][$index]);
        }        
    }

    function clear() {
        $_SESSION['shoppingcart'] = array();
    }

    //function to find the index of an item in the shopping cart
    //if "Item" is found, return "Item" Index in the shopping cart
    //if "Item" is not found, return "-1"
    function indexOf($itemID) {
        //var_dump($_SESSION['shoppingcart']);exit();
        if (!isset($_SESSION['shoppingcart']))
            return -1;

        $size = count($_SESSION['shoppingcart']);

        if ($size == 0)
            return -1;

        foreach ($_SESSION['shoppingcart'] as $key=>$value){
            if ($itemID==$value['song_id']){
                return $key;
            }
        }

        return -1;
    }
    
    function getSubTotal(){
        if (!isset($_SESSION['shoppingcart']))
            return 0.00;

        $size = count($_SESSION['shoppingcart']);

        if ($size == 0)
            return 0.00;

        $subTotal=0.00;
        
        foreach ($_SESSION['shoppingcart'] as $key=>$value){
            $subTotal+=(float)$value['price'];
        }

        return number_format((float)$subTotal, 2, '.', '');
    }

}

?>