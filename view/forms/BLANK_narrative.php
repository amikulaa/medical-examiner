<?php
require_once ("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Blank Narrative PDF');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';

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
$pdf->Cell(0, 10, 'Narrative', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
$pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
$pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
$pdf->SetY(45);

// SECTION 1 - Narrative
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, 5, 'Narrative', 1, 1, 'C');
$pdf->Ln(2);

// narrative
$pdf->SetFont($font, '', $font3);
$pdf->Write(5, '');

// save and output
ob_end_clean();
$pdf->Output();
?>