<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/songHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header = array('Song ID','Title','Length','Album ID','Song Type','File Name','Unit Price','Vote Count');

$data= songHelper::getSongByAlbumID($_GET['album_id']);
//***************************************************************************************************************

excelHelper::export2Excel($header, $data, "song-data");
?>

