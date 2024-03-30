<?php
require_once ("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Blank Embalm Permit PDF');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';

// add new page for all results returned
$pdf->AddPage();
$pdf->Image(LOGO, 20, 5, 35);
$pdf->SetFont($font, '', $font3);
$pdf->SetY(5);
$pdf->SetX(160);
$pdf->Write(10, 'Case #: ');
$pdf->SetFont($font, 'U', $font3);
$pdf->Write(10, '');
// $pdf->Cell(0, 0, 'Case #: ' . $row->case_number, 0, 2, 'R');

// title page header
$pdf->SetY(5);

$pdf->SetFont($font, 'B', $font1);
$pdf->Cell(0, 10, 'Embalm Permit', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
$pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
$pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
$pdf->SetY(60);
// first_mi_name and last_name
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(25, 5, 'Decedent: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(70, 5, '', 'B', 0, 'L');
$pdf->Cell(75, 5, '', 'B', 2, 'L');
$pdf->SetFont($font, 'I', $font4);
$pdf->SetX(40);
$pdf->Write(5, '(First Name MI)');
$pdf->SetX(110);
$pdf->Write(5, '(Last Name)');

// line break
$pdf->Cell(0, 20, '', 0, 1, '');
// full_address
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(25, 5, 'Address:  ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(145, 5, '', 'B', 0, 'L');
$pdf->Cell(0, 10, '', 0, 1, ''); // line break
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->Cell(25, 5, '', 0, 0, 'L');
$pdf->Cell(145, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 20, '', 0, 1, '');

// pronounced_citystatezip and pronounced_county
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(30, 5, 'Place of Death: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(70, 5, '', 'B', 0, 'L');
$pdf->Cell(70, 5, '', 'B', 2, 'L');
$pdf->SetFont($font, 'I', $font4);
$pdf->SetX(45);
$pdf->Write(5, '(Municipality)');
$pdf->SetX(115);
$pdf->Write(5, '(County)');

// line break
$pdf->Cell(0, 20, '', 0, 1, '');

// pronounced_physician
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(30, 5, 'Pronounced By: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(140, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 10, '', 0, 1, '');

// date_of_death and time_of_death
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(30, 5, 'Date Pronounced: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(30, 5, 'Time Pronounced: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 10, '', 0, 1, '');

// sign_dc_physician
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(55, 5, 'Death Certificate to be Signed by: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(115, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 10, '', 0, 1, '');
$pdf->Ln(7);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, .5, '', 1, 1, 'C', true);
$pdf->Cell(0, 5, '', 0, 1, '');

$pdf->SetFont($font, 'B', 14);
$pdf->Cell(0, 5, 'Permission to Embalm', 0, 1, 'C');
$pdf->Ln(10);

// permission to embalm statement
$pdf->SetFont($font, 'B', $font3);
$pdf->Write(5, 'To Funeral Director, Embalmer, or Person Acting as Such:');
$pdf->Cell(0, 10, '', 0, 1, '');
$pdf->SetFont($font, '', $font3);
$pdf->Write(5, 'This constitutes the release required by section 979.01(4) of Wisconsin statutes and certifies that all necessary evidence has been removed from the above named person and the body may now be embalmed, buried, or otherwise disposed of. This certificate does not override the wishes of the next of kin regarding embalming or final disposition of the deceased. Cremation will require further authorization.');

// line break
$pdf->Cell(0, 20, '', 0, 1, '');

// embalm_date
$pdf->Cell(10, 7, '', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(15, 5, 'Date: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(30, 5, '', 'B', 0, 'L');
$pdf->Cell(20, 7, '', 0, 0);
$pdf->Cell(100, 5, '', 'B', 2, 'L');
$pdf->SetFont($font, 'I', $font4);
$pdf->Write(5, '(Signature of Medical Examiner or Deputy)');

// line break
$pdf->Cell(0, 15, '', 0, 1, '');

// embalm_recieved_by
$pdf->Cell(10, 5, '', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(25, 5, 'Recieved By: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(70, 5, '', 'B', 2, 'L');
$pdf->SetFont($font, 'I', $font4);
$pdf->Write(5, '(Funeral Home Representative)');

// save and output
ob_end_clean();
$pdf->Output();
?>