<?php 
require_once("settings.php");

$filetype=$_GET['filetype'];

if ($filetype=='image'){
    $location = IMAGE_UPLOAD_PATH. $_FILES[$filetype]["name"]; //this is where the file will go
}else if ($filetype=='song'){
    $location = SONG_UPLOAD_PATH. $_FILES[$filetype]["name"]; //this is where the file will go
}

$temp=$_FILES[$filetype]["tmp_name"];
//$file = $_FILES[$filetype]; // 'image' because that was the name we set in the javascript code
move_uploaded_file($_FILES[$filetype]["tmp_name"], $location); // move the file there
echo $_FILES[$filetype]["name"];; //send the file location back to the javascript
?>