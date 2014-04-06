<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/purchaseHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(50, 7, 'Purchase ID', 1);
        $this->Cell(50, 7, 'Date', 1);
        $this->Cell(50, 7, 'Member ID', 1);
        $this->Cell(50, 7, 'First Name', 1);
        $this->Cell(50, 7, 'Last Name', 1);
        $this->Cell(30, 7, 'Total', 1);
        
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(50, 7, $row['purchase_id'], 1);
            $this->Cell(50, 7, $row['purchasedate'], 1);
            $this->Cell(50, 7, $row['member_id'], 1);
            $this->Cell(50, 7, $row['firstname'], 1);
            $this->Cell(50, 7, $row['lastname'], 1);
            $this->Cell(30, 7, $row['total'], 1);
            $this->Ln();
        }
    }
}

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
$purchasesData = purchaseHelper::getPurchase($fromDate, $toDate, $member);

// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Purchase Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

// Column headings
$header = array('Purchase ID', 'Date', 'Member ID', 'First Name', 'Last Name', 'Total');

foreach ($purchasesData as $purchasesKey => $purchasesValue) {

    $pdf->SetFont('Times', 'B', 14);

    $data[] = array(
        'purchase_id' => $purchasesValue['purchase_id'],
        'purchasedate' => $purchasesValue['purchasedate'],
        'member_id' => $purchasesValue['member_id'],
        'firstname' => $purchasesValue['firstname'],
        'lastname' => $purchasesValue['lastname'],
        'total' => $purchasesValue['total'],
    );    
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>