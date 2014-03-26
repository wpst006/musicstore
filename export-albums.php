<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/albumHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header = array('Album ID', 'Title', 'Publishing Date', 'Publisher', 'Type');

if (isset($_GET['searchKey'])) {
    $albumData = albumHelper::searchalbum($_GET['searchKey']);
} else {
    $albumData = albumHelper::selectAll();
}

excelHelper::export2Excel($header, $albumData, "album-data");
?>

