<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/purchaseHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header = array('Purchase ID', 'Purchase Date', 'Member ID', 'First Name', 'Last Name', 'Total');

//***************************************************************************************************************
$member = null;
$fromDate = null;
$toDate = null;

if (isset($_GET['member'])) {
    $member = $_GET['member'];
}

if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];
}
//***************************************************************************************************************
$purchaseData = purchaseHelper::getPurchase($fromDate, $toDate, $member);

excelHelper::export2Excel($header, $purchaseData, "purchase-data");
?>

