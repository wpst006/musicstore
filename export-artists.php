<?php

require('includes/includefiles.php');
require('myPDF.php');
require('includes/artistHelper.php');

class routePDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(75, 7, 'Artist ID', 1);
        $this->Cell(75, 7, 'Name', 1);
        $this->Cell(75, 7, 'Gender', 1);
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(75, 7, $row['artist_id'], 1);
            $this->Cell(75, 7, $row['artistname'], 1);
            $this->Cell(75, 7, $row['gender'], 1);
            $this->Ln();
        }
    }

}

// Instanciation of inherited class
$pdf = new routePDF("L");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Artist Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
//***************************************************************************************************************
if (isset($_GET['searchKey'])){
    $artistData= artistHelper::searchArtist($_GET['searchKey']);
}else{
    $artistData= artistHelper::selectAll();
}
//***************************************************************************************************************

// Column headings
$header = array('Title','Duration','Remark');

foreach ($artistData as $key => $value) {
    $data[] = array(
        'artist_id'=>$value['artist_id'],        
        'artistname'=>$value['artistname'],
        'gender'=>$value['gender'],
        );
}

$pdf->BasicTable($header, $data);
$pdf->Output();
?>