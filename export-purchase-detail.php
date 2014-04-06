<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/purchaseHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        
        $this->Cell(40, 7, 'Song ID', 1);
        $this->Cell(100, 7, 'Title', 1);
        $this->Cell(40, 7, 'Length', 1);
        $this->Cell(40, 7, 'Sont Type', 1);
        $this->Cell(40, 7, 'Price', 1);

        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(40,7, $row['song_id'], 1);
            $this->Cell(100, 7, $row['title'], 1);
            $this->Cell(40, 7, $row['length'], 1);  
            $this->Cell(40, 7, $row['song_type'], 1);
            $this->Cell(40, 7, $row['price'], 1);  
                      
            $this->Ln();
        }
    }

}

//***************************************************************************************************************
$purchase_id = $_GET['purchase_id'];
$purchaseData = purchaseHelper::getPurchaseByPurchaseID($purchase_id);
$purchaseDetailData = purchaseHelper::getPurchasedetailsByPurchaseID($purchase_id);
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Purchase Report', 0, 1, 'C');

$pdf->Ln();

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'purchase ID :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $purchaseData[0]['purchase_id'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'purchase Date :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $purchaseData[0]['purchasedate'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Member ID :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $purchaseData[0]['member_id'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'First Name :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $purchaseData[0]['firstname'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Last Name :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $purchaseData[0]['lastname'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Total :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50,7, $purchaseData[0]['total'], 0, 1, 'L');

$pdf->Ln();
// Column headings
$header = array('Song ID', 'Title', 'Length', 'Song Type', 'Price');

foreach ($purchaseDetailData as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);

    $data[] = array(
        'song_id' => $value['song_id'],
        'title' => $value['title'],
        'length' => $value['length'],
        'song_type' => $value['song_type'],
        'price' => $value['price'],
    );
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>