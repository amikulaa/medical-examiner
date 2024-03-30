<?php
require_once("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Cause/Manner PDF');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';

// add new page for all results returned
foreach($results as $row){
    // base add page and logo
    $pdf->AddPage();
    $pdf->Image(LOGO, 20, 5, 35);
    $pdf->SetFont($font,'', $font3);
    $pdf->SetY(5);
    $pdf->SetX(160);
    $pdf->Write(10, 'Case #: ');
    $pdf->SetFont($font,'U', $font3);
    $pdf->Write(10, $row->case_number);
    
    // title page header
    $pdf->SetY(5);
    $pdf->SetFont($font,'B', $font1);
    $pdf->Cell(0, 10, 'Cause/Manner of Death', 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->SetFont($font,'B', $font3);
    $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
    $pdf->SetFont($font,'', $font3);
    $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
    $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
    $pdf->SetFont($font, 'I', 11);
    $pdf->Cell(0, 10, 'jeffersoncountywi.gov', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Nichol Tesch - Medical Examiner', 0, 1, 'C');
    
    // case num and name
    $pdf->Ln(15);
    $pdf->SetFont($font,'B', 24);
    $pdf->Cell(0, 10, 'Case #: ' . $row->case_number, 0, 2, 'C');
    $pdf->SetFont($font,'B', 18);
    $pdf->Cell(0, 10, $row->last_name . ", " . $row->first_name, 0, 0, 'C');
    $pdf->Ln(25); 
    $cause_manner_width = 70;
    
    $x = $pdf->GetX() + $cause_manner_width;
    $y = $pdf->GetY();
    //base information of cause_manner
    if($row->cause_of_death != null){
        $pdf->SetFont($font,'UB', 16);
        $pdf->Cell(95, 10, 'Cause of Death:', 0, 0, 'R');
        $pdf->SetFont($font,'', 16);
        $pdf->MultiCell($cause_manner_width, 10, $row->cause_of_death, 0, 'L', false);
        $pdf->Ln(10);
    }
    
    $x = $pdf->GetX() + $cause_manner_width;
    $y = $pdf->GetY();
    if($row->due_to != null){
        $pdf->SetFont($font,'UB', 16);
        $pdf->Cell(95, 10, 'Due To:', 0, 0, 'R');
        $pdf->SetFont($font,'', 16);
        $pdf->MultiCell($cause_manner_width, 10, $row->due_to, 0, 'L', false);
        $pdf->Ln(10);
    }
    
    $x = $pdf->GetX() + $cause_manner_width;
    $y = $pdf->GetY();
    if($row->cause_of_death_other != null){
        $pdf->SetFont($font,'UB', 16);
        $pdf->Cell(95, 10, 'Other Significant Conditions:', 0, 0, 'R');
        $pdf->SetFont($font,'', 16);
        $pdf->MultiCell($cause_manner_width, 10, $row->cause_of_death_other, 0, 'L', false);
        $pdf->Ln(10);
    }
    
    $x = $pdf->GetX() + $cause_manner_width;
    $y = $pdf->GetY();
    if($row->manner_of_death != null){
        $pdf->SetFont($font,'UB', 16);
        $pdf->Cell(95, 10, 'Manner of Death:', 0, 0, 'R');
        $pdf->SetFont($font,'', 16);
        $pdf->MultiCell($cause_manner_width, 10, $row->manner_of_death, 0, 'L', false);
    }
}

// save and output
ob_end_clean();
$pdf->Output();
?>