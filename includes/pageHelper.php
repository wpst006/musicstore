<?php

class pageHelper {

    public static function getCurrentPageName() {
        $rawURL = $_SERVER['PHP_SELF'];
        $temp = explode("/", $rawURL);

        return $temp[count($temp) - 1];
    }

}

?>
