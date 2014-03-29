<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/authorHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header = array('Author ID','Author Name','Gender');

if (isset($_GET['searchKey'])) {
    $authorData = authorHelper::searchAuthor($_GET['searchKey']);
} else {
    $authorData = authorHelper::selectAll();
}

excelHelper::export2Excel($header, $authorData, "author-data");
?>

