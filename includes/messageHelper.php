<?php

class messageHelper {

    public static function getSuccessMessage($message) {
        return '<div class="alert alert-success">' . $message . '</div>';
    }

    public static function getErrorMessage($message) {
        return '<div class="alert alert-danger">' . $message . '</div>';
    }

    public static function getWarningMessage($message) {
        return '<div class="alert alert-warning">' . $message . '</div>';
    }

    public static function getInfoMessage($message) {
        return '<div class="alert alert-info">' . $message . '</div>';
    }
    
    public static function setMessage($message,$type=null){
        
        if (!isset($type)){
            $type=MESSAGE_TYPE_INFO;
        }
        
        $messageArray=array(
            'text' => $message,
            'type' => $type,
            'displayed' => 0 // "0" means message is not yet displayed to the user
        );
                
        $_SESSION['message']=$messageArray;
    }
    
    public static function getMessage(){
        if (!isset($_SESSION['message'])){
            return null;
        }
               
        $messageArray=$_SESSION['message'];
        
        if ($messageArray['type']==MESSAGE_TYPE_SUCCESS){
            return messageHelper::getSuccessMessage($messageArray['text']);
        }else if ($messageArray['type']==MESSAGE_TYPE_INFO){
            return messageHelper::getInfoMessage($messageArray['text']);
        }else if ($messageArray['type']==MESSAGE_TYPE_ERROR){
            return messageHelper::getErrorMessage($messageArray['text']);
        }
    }
    
    public static function clearMessage(){
        //Clear the message
        unset($_SESSION['message']);
    }

}

?>
