<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/memberHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header

        $this->Cell(30, 7, 'Customer ID', 1);
        $this->Cell(30, 7, 'Name', 1);
        $this->Cell(25, 7, 'DOB', 1);
        $this->Cell(100, 7, 'Contact Info', 1);

        $this->Ln();
        // Data
        foreach ($data as $row) {

            $this->SetFont('Times', '', 12);
            $this->Cell(30,28, $row['member_id'], 1);
            $this->Cell(30,28, $row['name'], 1);
            $this->Cell(25, 28, $row['DOB'], 1);
            $this->MultiCell(100, 7, $row['address'], 1);
            //$this->Ln();
        }
    }

}

//***************************************************************************************************************
if (isset($_GET['searchKey'])){
    $data= memberHelper::searchMember($_GET['searchKey']);
}else{
    $data= memberHelper::selectAll();
}
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Member Report', 0, 1, 'C');

$pdf->Ln();

// Column headings
//$header = array('Package','Duration','No of People','Price');
$header=array();

foreach ($data as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);
    
    $name= $value['lastname'] . ", " . $value['firstname'];    
    $address= "Phone No : " . $value['contact_phone'] . "\n" .
            "Email : " . $value['contact_email'] . "\n" .
            "Country : " . $value['country'] . "\n" .
            "Zip Code : " . $value['zipcode'];
    
    $result[] = array(
        'member_id' => $value['member_id'],
        'name' => $name,
        'DOB' =>  substr($value['DOB'], 0,10) ,
        'address' =>$address       
    );
}

$pdf->BasicTable($header, $result);
$pdf->Ln();
$pdf->Output();
?>