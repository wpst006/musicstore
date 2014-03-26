<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/purchaseHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header2 = array('Song ID', 'Title', 'Length', 'Song Type', 'Price');

//***************************************************************************************************************
$purchase_id = $_GET['purchase_id'];
$purchaseData = purchaseHelper::getPurchaseByPurchaseID($purchase_id);
$purchaseDetailData = purchaseHelper::getPurchasedetailsByPurchaseID($purchase_id);
//***************************************************************************************************************

excelHelper::export2Excel2($purchaseData[0], $header2,$purchaseDetailData, "purchase-data");
?>

