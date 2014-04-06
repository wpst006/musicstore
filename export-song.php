<?php

require('includes/includefiles.php');
require('myPDF.php');
require('includes/songHelper.php');

class routePDF extends myPDF {
                    
    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(40, 7, 'Song ID', 1);
        $this->Cell(75, 7, 'Title', 1);
        $this->Cell(75, 7, 'Artists', 1);
        $this->Cell(75, 7, 'Authors', 1);
        
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(40, 7, $row['song_id'], 1);
            $this->Cell(75, 7, $row['title'], 1);
            $this->Cell(75, 7, $row['artists'], 1);
            $this->Cell(75, 7, $row['authors'], 1);
            $this->Ln();
        }
    }

}

// Instanciation of inherited class
$pdf = new routePDF("L");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Songs Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
//***************************************************************************************************************
if (isset($_GET['album_id'])){
    $songData= songHelper::getSongByAlbumID2($_GET['album_id']);
}
//***************************************************************************************************************

// Column headings
$header = array('Title','Duration','Remark');

foreach ($songData as $key => $value) {
    $data[] = array(
        'song_id'=>$value['song_id'],        
        'title'=>$value['title'],
        'artists'=>$value['artists'],
        'authors'=>$value['authors'],
        'unitprice'=>$value['unitprice'],
        'vote_count'=>$value['vote_count']
        );
}

$pdf->BasicTable($header, $data);
$pdf->Output();
?>