<?php
require_once ("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Blank Cause/Manner PDF');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';

// base add page and logo
$pdf->AddPage();
$pdf->Image(LOGO, 20, 5, 35);
$pdf->SetFont($font, '', $font3);
$pdf->SetY(5);
$pdf->SetX(160);
$pdf->Write(10, 'Case #: ');
$pdf->SetFont($font, 'U', $font3);
$pdf->Write(10, '');

// title page header
$pdf->SetY(5);
$pdf->SetFont($font, 'B', $font1);
$pdf->Cell(0, 10, 'Cause/Manner of Death', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
$pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
$pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
$pdf->SetFont($font, 'I', 11);
$pdf->Cell(0, 10, 'jeffersoncountywi.gov', 0, 1, 'C');
$pdf->Cell(0, 10, 'Nichol Tesch - Medical Examiner', 0, 1, 'C');

// case num and name
$pdf->Ln(15);
$pdf->SetFont($font, 'B', 24);
$pdf->Cell(0, 10, 'Case #: ' . '', 1, 2, 'C');
$pdf->SetFont($font, 'B', 18);
$pdf->Cell(0, 10, '' . ", " . '', 1, 0, 'C');
$pdf->Ln(25);

// base information of cause_manner
$pdf->SetFont($font, 'UB', 16);
$pdf->Write(10, 'Cause of Death:');
$pdf->SetFont($font, '', 16);
$pdf->Write(10, "");
$pdf->Ln(20);
$pdf->SetFont($font, 'UB', 16);
$pdf->Write(10, 'Due To:');
$pdf->SetFont($font, '', 16);
$pdf->Write(10, "");
$pdf->Ln(25);
$pdf->SetFont($font, 'UB', 16);
$pdf->Write(10, 'Other Significant Conditions:');
$pdf->SetFont($font, '', 16);
$pdf->Write(10, "   ");
$pdf->Ln(25);
$pdf->SetFont($font, 'UB', 16);
$pdf->Write(10, 'Manner of Death:');
$pdf->SetFont($font, '', 16);
$pdf->Write(10, "");

// save and output
ob_end_clean();
$pdf->Output();
?>