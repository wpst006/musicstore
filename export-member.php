<?php include("includes/includefiles.php"); ?>
<?php require_once("includes/memberHelper.php"); ?>
<?php require_once("includes/excelHelper.php"); ?>

<?php

$header = array('Member ID', 'First Name', 'Last Name', 'DOB','Phone No','Contact Email','Country','Zip Code');

if (isset($_GET['searchKey'])){
    $data= memberHelper::searchMember($_GET['searchKey']);
}else{
    $data= memberHelper::selectAll();
}
//***************************************************************************************************************

excelHelper::export2Excel($header, $data, "member-data");
?>

