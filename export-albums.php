<?php

require('includes/includefiles.php');
require('myPDF.php');
require_once("includes/albumHelper.php");

class albumPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);

        // Header
        $this->Cell(50, 7, 'Album ID', 1);
        $this->Cell(75, 7, 'Title', 1);
        $this->Cell(50, 7, 'Publishing Date', 1);
        $this->Cell(50, 7, 'Publisher', 1);
        $this->Cell(25, 7, 'Type', 1);
        
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(50, 7, $row['album_id'], 1);
            $this->Cell(75, 7, $row['title'], 1);
            $this->Cell(50, 7, $row['publishing_date'], 1);
            $this->Cell(50, 7, $row['publisher'], 1);
            $this->Cell(25, 7, $row['cd_dvd'], 1);
            $this->Ln();
        }
    }

}

// Instanciation of inherited class
$pdf = new albumPDF("L");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Album Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
//***************************************************************************************************************
if (isset($_GET['searchKey'])) {
    $albumData = albumHelper::searchalbum($_GET['searchKey']);
} else {
    $albumData = albumHelper::selectAll();
}
//***************************************************************************************************************

// Column headings
$header = array('Album ID', 'Title', 'Publishing Date', 'Publisher', 'Type');

foreach ($albumData as $key => $value) {
    $data[] = array(
            'album_id'=>$value['album_id'],        
            'title'=>$value['title'],
            'publishing_date'=>  substr($value['publishing_date'], 0,10) ,
            'publisher'=>$value['publisher'],
            'cd_dvd'=>$value['cd_dvd'],
        );
}

$pdf->BasicTable($header, $data);
$pdf->Output();
?>