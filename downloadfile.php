<?php

$fileType = $_GET['filetype'];
$file = $_GET['file'];

if ($fileType == 'song') {
    $filePath = 'files/songs/';

    header("Content-type: octet/stream");
    header("Content-disposition: attachment; filename=" . $file . ";");
    //header("Content-disposition: attachment; filename=ShweLayPhyu.mp3;");
    header("Content-Length: " . filesize($filePath . $file));
    readfile($filePath . $file);
}

exit();
?>
