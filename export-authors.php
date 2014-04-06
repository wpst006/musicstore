<?php

require('includes/includefiles.php');
require('myPDF.php');
require('includes/authorHelper.php');

class routePDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(75, 7, 'author ID', 1);
        $this->Cell(75, 7, 'Name', 1);
        $this->Cell(75, 7, 'Gender', 1);
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(75, 7, $row['author_id'], 1);
            $this->Cell(75, 7, $row['authorname'], 1);
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
$pdf->Cell(0, 10, 'Author Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
//***************************************************************************************************************
if (isset($_GET['searchKey'])){
    $authorData= authorHelper::searchauthor($_GET['searchKey']);
}else{
    $authorData= authorHelper::selectAll();
}
//***************************************************************************************************************

// Column headings
$header = array('Title','Duration','Remark');

foreach ($authorData as $key => $value) {
    $data[] = array(
        'author_id'=>$value['author_id'],        
        'authorname'=>$value['authorname'],
        'gender'=>$value['gender'],
        );
}

$pdf->BasicTable($header, $data);
$pdf->Output();
?>