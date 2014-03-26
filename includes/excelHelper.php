<?php

class excelHelper {

    public static function export2Excel($header,$data,$filename="musicstore") {
        //header info for browser
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        //*******Start of Formatting for Excel********
        //define separator (defines columns in excel & tabs in word)
        $sep = "\t"; //tabbed character
        //start of printing column names as names of MySQL fields
        foreach ($header as $value){
            echo $value . "\t";
        }
        //foreach ($result)
                print("\n");
        //end of printing column names

        //start while loop to get data
        foreach ($data as $row) {
            $schema_insert = "";
            foreach ($row as $key => $value) {
                if (!isset($value))
                    $schema_insert .= "NULL" . $sep;
                elseif ($value != "")
                    $schema_insert .= "$value" . $sep;
                else
                    $schema_insert .= "" . $sep;
            }
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }
    }
    
    public static function export2Excel2($data1,$header2,$data2,$filename="musicstore") {
        //header info for browser
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        
        foreach ($data1 as $key=>$value){
            echo $key . "\t";
        }

        print("\n");
        
        foreach ($data1 as $key=>$value){
            echo $value . "\t";
        }
        
        print("\n\n");
        //*******Start of Formatting for Excel********
        //define separator (defines columns in excel & tabs in word)
        $sep = "\t"; //tabbed character
        //start of printing column names as names of MySQL fields
        foreach ($header2 as $value){
            echo $value . "\t";
        }
        //foreach ($result)
                print("\n");
        //end of printing column names

        //start while loop to get data
        foreach ($data2 as $row) {
            $schema_insert = "";
            foreach ($row as $key => $value) {
                if (!isset($value))
                    $schema_insert .= "NULL" . $sep;
                elseif ($value != "")
                    $schema_insert .= "$value" . $sep;
                else
                    $schema_insert .= "" . $sep;
            }
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }
    }

}
?>