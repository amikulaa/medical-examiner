<?php
require_once ("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Blank Disinterment Release PDF');
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

// title page header
$pdf->SetY(5);
$pdf->SetFont($font, 'B', $font1);
$pdf->Cell(0, 10, 'Disinterment Release', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
$pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
$pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
$pdf->SetY(45);
$pdf->Write(5, 'This permit, when properly completed, signed, and dated, constitutes authority under s. 69.18 (4) for disinterment, removal, transportation, and reburial of the remains of: ');
$pdf->SetFont($font, 'U', $font3);
$pdf->Cell(0, 5, '', 0, 1, '');

// SECTION 1 - Current Decedent Interment Information
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, 5, 'Current Decedent Interment Information', 1, 1, 'C');

// name of decedent
$pdf->Ln(2);
$pdf->Cell(5, 7, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(42, 5, '1. Name of Decedent: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->Cell(20, 5, '', 'B', 0, 'L');

// date of death
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(35, 5, '2. Date of Death: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(25, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// age noninfant
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(15, 5, '3. Age: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(5, 5,'', 'B', 0, 'L');

// age infant
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(23, 5, 'Age, if < 1: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(30, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// current cemetery lot
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(40, 5, '4. Now Interred in: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(30, 5, '', 'B', 0, 'L');

// current cemetery name
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(60, 5, '5. Name of Current Cemetery:  ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(40, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// current citystatezip
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(30, 5, '6. Located in: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(40, 5, '', 'B', 0, 'L');

// current county
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(28, 5, '7. County of: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(30, 5, '', 'B', 0, 'L');
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(10, 5, ', WI', 0, 0, 'L');

// SECTION 2 - Place of Re-Interment or Cremation Information
$pdf->Ln(7);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, 5, 'Place of Re-Interment or Cremation Information', 1, 1, 'C');
$pdf->Ln(5);

// cremains disintered?
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(40, 5, '8. New Disposition: ', 0, 0, 'C');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(20, 5, '                  ', 0, 0);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(72, 5, 'Cremated Remains Being Disintered?', 0, 0, 'C');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// creamted?
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(80, 5, '8a. Disintered Remains Will be Cremated', 0, 0, 'C');
$pdf->SetFont($font, 'BI', $font3);
$pdf->Cell(75, 5, '(If yes, Cremation Permit is required)', 0, 0, 'L');

// line break
$pdf->Cell(0, 5, '', 0, 1, '');

// cremains will be...
$pdf->Cell(20, 5, '                 ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(40, 5, 'Cremains will be: ', 0, 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// interred
$pdf->Cell(25, 5, '                 ', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(18, 5, 'Interred', 0, 0, 'l');
$pdf->SetFont($font, 'BI', $font3);
$pdf->Cell(40, 5, '(complete items 9-13)', 0, 0, 'L');
// line break
$pdf->Cell(0, 8, '', 0, 1, '');
// masoleum
$pdf->Cell(25, 5, '                 ', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(40, 5, 'Placed in Mausoleum', 0, 0, 'L');
$pdf->SetFont($font, 'BI', $font3);
$pdf->Cell(40, 5, '(complete items 9-13)', 0, 0, 'L');
// line break
$pdf->Cell(0, 8, '', 0, 1, '');
// delegated
$pdf->Cell(25, 5, '                 ', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(60, 5, 'Given to Family or Other Person', 0, 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// re interred?
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(82, 5, '8b. Disintered Remains Will be Re-Interred', 0, 0, 'C');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// new cemetery lot
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(75, 5, '9. New Cemetery or Mausoleum Location: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(40, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// new cemetery name
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(70, 5, '10. Name of Cemetery or Mausoleum: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(50, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// new cemetery located in
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(28, 5, '11. Located in: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(30, 5,'', 'B', 0, 'L');

// new cemetery county of
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(28, 5, '12. County of: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(30, 5, '', 'B', 0, 'L');

// new cemetery state or country
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(38, 5, '13. State or Country: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');

// header 3 - Permit Issued To
$pdf->Ln(7);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, 5, 'Permit Issued To', 1, 1, 'C');
$pdf->Ln(5);

// name of applicant
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(45, 5, '14. Name of Applicant: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');

// liscence
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(25, 5, '15. License: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// mailing address
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(40, 5, '16. Mailing Address: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(80, 5, '', 'B', 0, 'L');

// phone
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(20, 5, '17. Phone ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(25, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// fee
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(45, 5, '18. Fee Payment Paid?', 0, 0, 'L');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// supplied
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(55, 5, '19. Applicant Has Supplied:', 0, 0, 'L');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(55, 5, 'Notarized Next of Kin Request', 0, 0, 'L');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(55, 5, 'Agreement of Cemetery Offical', 0, 0, 'L');

// header 4 - No Title
$pdf->Ln(7);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, 1, '', 1, 1, 'C', true);
$pdf->Ln(5);

// name of issuing offical
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(45, 5, '20. Name of Issuing Offical: ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(50, 5, '', 'B', 0, 'L');

// title
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(20, 5, '21. Title ', 0, 0, 'L');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(15, 5, '', 'B', 0, 'L');

// line break
$pdf->Cell(0, 8, '', 0, 1, '');

// signature (no data)
$pdf->SetFont($font, '', $font3);
$pdf->Cell(50, 5, "", 'B', 0, 'L');
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(50, 5, '22. Signature of Issuing Offical', 0, 0, 'L');

// date signed
$pdf->Cell(5, 5, '     ', 0, 0);
$pdf->SetFont($font, '', $font3);
$pdf->Cell(20, 5, '', 'B', 0, 'L');
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(20, 5, 'Date Signed', 0, 0, 'L');

// header 5 - No Title (fine print)
$pdf->Ln(7);
$pdf->SetFont($font, 'B', $font2);
$pdf->Cell(0, 1, '', 1, 1, 'C', true);
$pdf->Ln(5);

// fine print
$pdf->SetFont($font, '', $font4);
$pdf->write(5, 'The applicant for the disinterment permit is obligated to arrange for the legal disposal of the remains in accordance with applicable state and local laws and local health department rules. If the remains of the decedent will be cremated after disinterment, the applicant must obtain a signed Cremation Permit from the Coroner or Medical Examiner of jurisdiction in accordance with s.979.10 Wis.');
$pdf->Ln(7);
$pdf->write(5, 'This disinterment permit is not required if the disinterment is done to correct an error in the placement of the corpse and the decedent is reinterred in the same cemetery per s.69.18 (4), Wis. Stats.');

// save and output
ob_end_clean();
$pdf->Output();
?>