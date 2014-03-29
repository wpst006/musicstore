<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/artistHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header = array('Artist ID','Artist Name','Gender');

if (isset($_GET['searchKey'])) {
    $artistData = artistHelper::searchArtist($_GET['searchKey']);
} else {
    $artistData = artistHelper::selectAll();
}

excelHelper::export2Excel($header, $artistData, "artist-data");
?>

