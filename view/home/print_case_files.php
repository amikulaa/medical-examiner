<?php
require_once("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Case #' . $case_num . ' Files');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';

// add new page for all results returned
// base add page and logo
for($i = 0; $i < count($results); $i++){
    for($j = 0; $j < 2; $j++){
        switch($i){
            case 0:
                if($results[$i][$j]->case_number != null){
                    $pdf->AddPage();
                    $pdf->Image(LOGO, 20, 5, 35);
                    $pdf->SetFont($font,'', $font3);
                    $pdf->SetY(5);
                    $pdf->SetX(160);
                    $pdf->Write(10, 'Case #: ');
                    $pdf->SetFont($font,'U', $font3);
                    $pdf->Write(10, $results[$i][$j]->case_number);
                    
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
                    $pdf->Cell(0, 10, 'Case #: ' . $results[$i][$j]->case_number, 0, 2, 'C');
                    $pdf->SetFont($font,'B', 18);
                    $pdf->Cell(0, 10, $results[$i][$j]->last_name . ", " . $results[$i][$j]->first_name, 0, 0, 'C');
                    $pdf->Ln(25);
                    $cause_manner_width = 70;
                    
                    $x = $pdf->GetX() + $cause_manner_width;
                    $y = $pdf->GetY();
                    //base information of cause_manner
                    if($results[$i][$j]->cause_of_death != null){
                        $pdf->SetFont($font,'UB', 16);
                        $pdf->Cell(95, 10, 'Cause of Death:', 0, 0, 'R');
                        $pdf->SetFont($font,'', 16);
                        $pdf->MultiCell($cause_manner_width, 10, $results[$i][$j]->cause_of_death, 0, 'L', false);
                        $pdf->Ln(10);
                    }
                    
                    $x = $pdf->GetX() + $cause_manner_width;
                    $y = $pdf->GetY();
                    if($results[$i][$j]->due_to != null){
                        $pdf->SetFont($font,'UB', 16);
                        $pdf->Cell(95, 10, 'Due To:', 0, 0, 'R');
                        $pdf->SetFont($font,'', 16);
                        $pdf->MultiCell($cause_manner_width, 10, $results[$i][$j]->due_to, 0, 'L', false);
                        $pdf->Ln(10);
                    }
                    
                    $x = $pdf->GetX() + $cause_manner_width;
                    $y = $pdf->GetY();
                    if($results[$i][$j]->cause_of_death_other != null){
                        $pdf->SetFont($font,'UB', 16);
                        $pdf->Cell(95, 10, 'Other Significant Conditions:', 0, 0, 'R');
                        $pdf->SetFont($font,'', 16);
                        $pdf->MultiCell($cause_manner_width, 10, $results[$i][$j]->cause_of_death_other, 0, 'L', false);
                        $pdf->Ln(10);
                    }
                    
                    $x = $pdf->GetX() + $cause_manner_width;
                    $y = $pdf->GetY();
                    if($results[$i][$j]->manner_of_death != null){
                        $pdf->SetFont($font,'UB', 16);
                        $pdf->Cell(95, 10, 'Manner of Death:', 0, 0, 'R');
                        $pdf->SetFont($font,'', 16);
                        $pdf->MultiCell($cause_manner_width, 10, $results[$i][$j]->manner_of_death, 0, 'L', false);
                    }
                    $j += 1;
                }
                break;
            case 1:
                if($results[$i][$j]->case_number != null){
                    $pdf->AddPage();
                    $pdf->Image(LOGO, 20, 5, 35);
                    $pdf->SetFont($font, '', $font3);
                    $pdf->SetY(5);
                    $pdf->SetX(160);
                    $pdf->Write(10, 'Case #: ');
                    $pdf->SetFont($font, 'U', $font3);
                    $pdf->Write(10, $results[$i][$j]->case_number);
                    // $pdf->Cell(0, 0, 'Case #: ' . $results[$i][$j]->case_number, 0, 2, 'R');
                    
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
                    $pdf->Cell(0, 5, '                                                  ', 0, 1, '');
                    
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
                    $pdf->Cell(20, 5, $results[$i][$j]->first_mi_name, 'B', 0, 'L');
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->Cell(20, 5, $results[$i][$j]->last_name, 'B', 0, 'L');
                    
                    // date of death
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(35, 5, '2. Date of Death: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->date_of_death, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // age noninfant
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, '3. Age: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(5, 5, $results[$i][$j]->decedent_age_noninfant, 'B', 0, 'L');
                    
                    // age infant
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(23, 5, 'Age, if < 1: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->age_infant, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // current cemetery lot
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(40, 5, '4. Now Interred in: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->current_cemetery_lot, 'B', 0, 'L');
                    
                    // current cemetery name
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(50, 5, '5. Name of Current Cemetery:  ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(50, 5, $results[$i][$j]->current_cemetery_name, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // current citystatezip
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(30, 5, '6. Located in: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(70, 5, $results[$i][$j]->current_cemetery_citystatezip, 'B', 0, 'L');
                    
                    // current county
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(28, 5, '7. County of: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(40, 5, $results[$i][$j]->current_cemetery_country, 'B', 0, 'L');
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
                    $pdf->Cell(20, 5, '', 0, 0);
                    $pdf->Cell(5, 5, $results[$i][$j]->new_dispo == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(72, 5, 'Cremated Remains Being Disintered?', 0, 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // creamted?
                    $pdf->Cell(5, 5, '', 0, 0);
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->new_cremated == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(80, 5, '8a. Disintered Remains Will be Cremated', 0, 0, 'L');
                    $pdf->SetFont($font, 'BI', $font3);
                    $pdf->Cell(75, 5, '(If yes, Cremation Permit is required)', 0, 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 5, '', 0, 1, '');
                    
                    // cremains will be...
                    $pdf->Cell(20, 5, '', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(40, 5, 'Cremains will be: ', 0, 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // interred
                    $pdf->Cell(25, 5, '                 ', 0, 0);
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->new_cremated_interred == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(18, 5, 'Interred', 0, 0, 'l');
                    $pdf->SetFont($font, 'BI', $font3);
                    $pdf->Cell(40, 5, '(complete items 9-13)', 0, 0, 'L');
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    // masoleum
                    $pdf->Cell(25, 5, '                 ', 0, 0);
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->new_cremated_mausoleum == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(40, 5, 'Placed in Mausoleum', 0, 0, 'L');
                    $pdf->SetFont($font, 'BI', $font3);
                    $pdf->Cell(40, 5, '(complete items 9-13)', 0, 0, 'L');
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    // delegated
                    $pdf->Cell(25, 5, '                 ', 0, 0);
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->new_cremated_delegated == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(60, 5, 'Given to Family or Other Person', 0, 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // re interred?
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->new_reinterred == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(82, 5, '8b. Disintered Remains Will be Re-Interred', 0, 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // new cemetery lot
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(70, 5, '9. New Cemetery or Mausoleum Location: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(40, 5, $results[$i][$j]->new_cemetery_lot, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // new cemetery name
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(70, 5, '10. Name of Cemetery or Mausoleum: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(80, 5, $results[$i][$j]->new_cemetery_name, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // new cemetery located in
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(28, 5, '11. Located in: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->new_cemetery_citystatezip, 'B', 0, 'L');
                    
                    // new cemetery county of
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(28, 5, '12. County of: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->new_cemetery_county, 'B', 0, 'L');
                    
                    // new cemetery state or country
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(38, 5, '13. State or Country: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(20, 5, $results[$i][$j]->new_cemetery_state_country, 'B', 0, 'L');
                    
                    // header 3 - Permit Issued To
                    $pdf->Ln(7);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Permit Issued To', 1, 1, 'C');
                    $pdf->Ln(5);
                    
                    // name of applicant
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(45, 5, '14. Name of Applicant: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(20, 5, $results[$i][$j]->applicant_name, 'B', 0, 'L');
                    
                    // liscence
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, '15. License: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(20, 5, $results[$i][$j]->applicant_license, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // mailing address
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(40, 5, '16. Mailing Address: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(80, 5, $results[$i][$j]->applicant_fulladdress, 'B', 0, 'L');
                    
                    // phone
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, '17. Phone ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->applicant_phone, 'B', 0, 'L');
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // fee
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(40, 5, '18. Fee Payment Paid?', 0, 0, 'L');
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->applicant_payment == true ? 4 : "", 1, 0);
                    
                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');
                    
                    // supplied
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(55, 5, '19. Applicant Has Supplied:', 0, 0, 'L');
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->applicant_nnok == true ? 4 : "", 1, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(55, 5, 'Notarized Next of Kin Request', 0, 0, 'L');
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->applicant_agreement == true ? 4 : "", 1, 0);
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
                    $pdf->Cell(50, 5, $results[$i][$j]->issuing_official_name, 'B', 0, 'L');
                    
                    // title
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, '21. Title ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(15, 5, $results[$i][$j]->issuing_official_title, 'B', 0, 'L');
                    
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
                    $pdf->Cell(20, 5, $results[$i][$j]->issuing_official_signature_date, 'B', 0, 'L');
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
                }
                $j += 1;
                break;
            case 2:
                if($results[$i][$j]->case_number != null){
                    $pdf->AddPage();
                    $pdf->Image(LOGO, 20, 5, 35);
                    $pdf->SetFont($font,'', $font3);
                    $pdf->SetY(5);
                    $pdf->SetX(160);
                    $pdf->Write(10, 'Case #: ');
                    $pdf->SetFont($font,'U', $font3);
                    $pdf->Write(10, $results[$i][$j]->case_number);
                    //$pdf->Cell(0, 0, 'Case #: ' . $results[$i][$j]->case_number, 0, 2, 'R');
                    
                    // title page header
                    $pdf->SetY(5);
                    
                    $pdf->SetFont($font,'B', $font1);
                    $pdf->Cell(0, 10, 'Embalm Permit', 0, 1, 'C');
                    $pdf->Ln(2);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
                    $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
                    $pdf->SetY(60);
                    //first_mi_name and last_name
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(25, 5, 'Decedent: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(70, 5, $results[$i][$j]->first_mi_name, 'B', 0, 'L');
                    $pdf->Cell(75, 5, $results[$i][$j]->last_name, 'B', 2, 'L');
                    $pdf->SetFont($font,'I', $font4);
                    $pdf->SetX(40);
                    $pdf->Write(5, '(First Name MI)');
                    $pdf->SetX(110);
                    $pdf->Write(5, '(Last Name)');
                    
                    //line break
                    $pdf->Cell(0, 20, '', 0, 1, '');
                    //full_address
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(25, 5, 'Address:  ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(145, 5, $results[$i][$j]->full_address, 'B', 0, 'L');
                    $pdf->Cell(0, 10, '', 0, 1, '');//line break
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->Cell(25, 5, '', 0, 0, 'L');
                    $pdf->Cell(145, 5, '', 'B', 0, 'L');
                    
                    //line break
                    $pdf->Cell(0, 20, '', 0, 1, '');
                    
                    //pronounced_citystatezip and pronounced_county
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(30, 5, 'Place of Death: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(70, 5, $results[$i][$j]->pronounced_citystatezip, 'B', 0, 'L');
                    $pdf->Cell(70, 5, $results[$i][$j]->pronounced_county, 'B', 2, 'L');
                    $pdf->SetFont($font,'I', $font4);
                    $pdf->SetX(45);
                    $pdf->Write(5, '(Municipality)');
                    $pdf->SetX(115);
                    $pdf->Write(5, '(County)');
                    
                    //line break
                    $pdf->Cell(0, 20, '', 0, 1, '');
                    
                    //pronounced_physician
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(30, 5, 'Pronounced By: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(140, 5, $results[$i][$j]->pronounced_physician, 'B', 0, 'L');
                    
                    //line break
                    $pdf->Cell(0, 10, '', 0, 1, '');
                    
                    //date_of_death and time_of_death
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(30, 5, 'Date Pronounced: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(20, 5, $results[$i][$j]->date_of_death, 'B', 0, 'L');
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(30, 5, 'Time Pronounced: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(20, 5, $results[$i][$j]->time_of_death, 'B', 0, 'L');
                    
                    //line break
                    $pdf->Cell(0, 10, '', 0, 1, '');
                    
                    //sign_dc_physician
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(55, 5, 'Death Certificate to be Signed by: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(115, 5, $results[$i][$j]->sign_dc_physician, 'B', 0, 'L');
                    
                    //line break
                    $pdf->Cell(0, 10, '', 0, 1, '');
                    $pdf->Ln(7);
                    $pdf->SetFont($font,'B', $font2);
                    $pdf->Cell(0, .5, '', 1, 1, 'C', true);
                    $pdf->Cell(0, 5, '', 0, 1, '');
                    
                    $pdf->SetFont($font,'B', 14);
                    $pdf->Cell(0, 5, 'Permission to Embalm', 0, 1, 'C');
                    $pdf->Ln(10);
                    
                    // permission to embalm statement
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Write(5, 'To Funeral Director, Embalmer, or Person Acting as Such:');
                    $pdf->Cell(0, 10, '', 0, 1, '');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Write(5, 'This constitutes the release required by section 979.01(4) of Wisconsin statutes and certifies that all necessary evidence has been removed from the above named person and the body may now be embalmed, buried, or otherwise disposed of. This certificate does not override the wishes of the next of kin regarding embalming or final disposition of the deceased. Cremation will require further authorization.');
                    
                    //line break
                    $pdf->Cell(0, 20, '', 0, 1, '');
                    
                    //embalm_date
                    $pdf->Cell(10, 7, '', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(15, 5, 'Date: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->embalm_date, 'B', 0, 'L');
                    $pdf->Cell(20, 7, '', 0, 0);
                    $pdf->Cell(100, 5, '', 'B', 2, 'L');
                    $pdf->SetFont($font,'I', $font4);
                    $pdf->Write(5, '(Signature of Medical Examiner or Deputy)');
                    
                    //line break
                    $pdf->Cell(0, 15, '', 0, 1, '');
                    
                    //embalm_recieved_by
                    $pdf->Cell(10, 5, '', 0, 0);
                    $pdf->SetFont($font,'B', $font3);
                    $pdf->Cell(25, 5, 'Recieved By: ', 0, 0, 'L');
                    $pdf->SetFont($font,'', $font3);
                    $pdf->Cell(70, 5, $results[$i][$j]->embalm_recieved_by, 'B', 2, 'L');
                    $pdf->SetFont($font,'I', $font4);
                    $pdf->Write(5, '(Funeral Home Representative)');
                }
                $j += 1;
                break;
            case 3:
                if ($results[$i][$j]->case_number != null) {
                    $pdf->AddPage();
                    $pdf->Image(LOGO, 20, 5, 35);
                    $pdf->SetFont($font, '', $font3);
                    $pdf->SetY(5);
                    $pdf->SetX(160);
                    $pdf->Write(10, 'Case #: ');
                    $pdf->SetFont($font, 'U', $font3);
                    $pdf->Write(10, $results[$i][$j]->case_number);

                    // title page header
                    $pdf->SetY(5);
                    $pdf->SetFont($font, 'B', $font1);
                    $pdf->Cell(0, 10, 'Investigative Form', 0, 1, 'C');
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
                    $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
                    $pdf->SetY(45);

                    // SECTION 0 - Case Information ADD to results in entry_model
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Case Information', 1, 1, 'C');
                    $pdf->Ln(2);
                    // Reported To: reported_to
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Reported To: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(50, 5, $results[$i][$j]->reported_to, 'B', 0, 'L');

                    // Date Reported: date_reported
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(28, 5, 'Date Reported: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->date_reported, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Time Reported: time_reported
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(28, 5, 'Time Reported: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(10, 5, $results[$i][$j]->time_reported, 'B', 0, 'L');

                    // Reported By: reported_by
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Reported By: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(50, 5, $results[$i][$j]->reported_by, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // SECTION 1 - Current Decedent Interment Information
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Current Decedent Interment Information', 1, 1, 'C');
                    $pdf->Ln(2);

                    // First/MI: first_mi_name and Last: last_name
                    $pdf->Cell(5, 7, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(35, 5, 'Name of Decedent: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->first_mi_name, 'B', 0, 'L');
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->Cell(30, 5, $results[$i][$j]->last_name, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Address: current_facility_address
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Address: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(160, 5, $results[$i][$j]->current_facility_address, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Phone #: decedent_phone
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Phone #: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->decedent_phone, 'B', 0, 'L');

                    // Date of Birth: decedent_date_of_birth
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Date of Birth: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->decedent_date_of_birth, 'B', 0, 'L');

                    // age noninfant
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, 'Age: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(5, 5, $results[$i][$j]->decedent_age_noninfant, 'B', 0, 'L');

                    // age infant
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Age, if < 1: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->decedent_age_infant, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Sex: decedent_sex
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(10, 5, 'Sex: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(5, 5, $results[$i][$j]->decedent_sex, 'B', 0, 'L');

                    // Race: decedent_race
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(12, 5, 'Race:', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(15, 5, $results[$i][$j]->decedent_race, 'B', 0, 'L');

                    // Height: decedent_height
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, 'Height:', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(15, 5, $results[$i][$j]->decedent_height, 'B', 0, 'L');

                    // Weight: decedent_weight
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, 'Weight:', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(15, 5, $results[$i][$j]->decedent_weight, 'B', 0, 'L');

                    // Date of Death: date_of_death
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Date of Death: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->date_of_death, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Time of Death: time_of_death
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(30, 5, 'Time of Death: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(10, 5, $results[$i][$j]->time_of_death, 'B', 0, 'L');

                    // Where Pronounced: where_pronounced_facility
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(35, 5, 'Where Pronounced: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(100, 5, $results[$i][$j]->where_pronounced_facility, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Pronounced By: where_pronounced_physician
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(30, 5, 'Pronounced By: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(150, 5, $results[$i][$j]->where_pronounced_physician, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Who Will Sign DC? sign_dc_physician
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Sign DC: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(160, 5, $results[$i][$j]->sign_dc_physician, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Family Physician: family_physician
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(35, 5, 'Family Physician: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(145, 5, $results[$i][$j]->family_physician, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // SECTION 2 - Identification
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Identification', 1, 1, 'C');
                    $pdf->Ln(2);
                    // Identification: id_results
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Identification: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(15, 5, $results[$i][$j]->id_results, 'B', 0, 'L');

                    // ID By: id_by
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, 'ID By: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(50, 5, $results[$i][$j]->id_by, 'B', 0, 'L');

                    // ID Method: id_method
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'ID Method: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(40, 5, $results[$i][$j]->id_method, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // SECTION 3 - Next of Kin
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Next of Kin', 1, 1, 'C');
                    $pdf->Ln(2);
                    // Name: kin_full_name
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Full Name: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(40, 5, $results[$i][$j]->kin_full_name, 'B', 0, 'L');

                    // Phone #: kin_phone
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Phone #: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->kin_phone, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Address: kin_address and City, State Zip: kin_citystatezip
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Address: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(90, 5, $results[$i][$j]->kin_address, 'B', 0, 'L');
                    $pdf->Cell(70, 5, $results[$i][$j]->kin_citystatezip, 'B', 2, 'L');
                    $pdf->SetFont($font, 'I', $font4);
                    $pdf->SetX(35);
                    $pdf->Write(5, '(Street Address)');
                    $pdf->SetX(125);
                    $pdf->Write(5, '(City/St/Zip)');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Relationship: kin_relationship
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(30, 5, 'Relationship: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->kin_relationship, 'B', 0, 'L');

                    // Notified By: kin_notified_by
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Notified By: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->kin_notified_by, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // SECTION 4 - Funeral Home
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Funeral Home', 1, 1, 'C');
                    $pdf->Ln(2);
                    // Funeral Home: decedent_funeral_home
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(35, 5, 'Funeral Home: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(145, 5, $results[$i][$j]->decedent_funeral_home, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // SECTION 5 - Donor Agency
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Donor Agency', 1, 1, 'C');
                    $pdf->Ln(2);
                    // Donor Agency Notified: donor_agency_notified
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Notified: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(20, 5, $results[$i][$j]->donor_agency_notified, 'B', 0, 'L');

                    // Date: donor_agency_notified_date
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, 'Date: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(25, 5, $results[$i][$j]->donor_agency_notified_date, 'B', 0, 'L');

                    // Time: donor_agency_notified_time
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(15, 5, 'Time: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(10, 5, $results[$i][$j]->donor_agency_notified_time, 'B', 0, 'L');

                    // Agency Notified: donor_agency_notified_name
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(30, 5, 'Agency Notified: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->donor_agency_notified_name, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Reference #: donor_agency_reference_num
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Reference #: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->donor_agency_reference_num, 'B', 0, 'L');

                    // By Whom: donor_agency_referenced_by
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'By Whom: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->donor_agency_referenced_by, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // SECTION 6 - Disposition
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Disposition', 1, 1, 'C');
                    $pdf->Ln(2);
                    // Disposition: disposition_option
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(20, 5, 'Disposition: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(30, 5, $results[$i][$j]->disposition_option, 'B', 0, 'L');

                    // Aut/Etx By: disposition_aut_ext_by
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(22, 5, 'Aut/Etx By: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(50, 5, $results[$i][$j]->disposition_aut_ext_by, 'B', 0, 'L');

                    // line break
                    $pdf->Cell(0, 8, '', 0, 1, '');

                    // Referred To? disposition_referred_to
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(25, 5, 'Referred To?', 0, 0, 'l');
                    $pdf->SetFont('ZapfDingbats', '', 10);
                    $pdf->Cell(5, 5, $results[$i][$j]->disposition_referred_to == true ? 4 : "", 1, 0);

                    // Referred County: disposition_wisconsin_county
                    $pdf->Cell(5, 5, '     ', 0, 0);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(30, 5, 'Referred County: ', 0, 0, 'L');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(40, 5, $results[$i][$j]->disposition_wisconsin_county, 'B', 0, 'L');
                }
                $j += 1;
                break;
            case 4:
                if ($results[$i][$j]->narrative != null) {
                    // narrative
                    $pdf->AddPage();
                    $pdf->Image(LOGO, 20, 5, 35);
                    $pdf->SetFont($font, '', $font3);
                    $pdf->SetY(5);
                    $pdf->SetX(160);
                    $pdf->Write(10, 'Case #: ');
                    $pdf->SetFont($font, 'U', $font3);
                    $pdf->Write(10, $results[$i][$j]->case_number);
                    
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
                    
                    // SECTION 7 - Narrative
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Narrative', 1, 1, 'C');
                    $pdf->Ln(2);
                    
                    // narrative
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Write(5, $results[$i][$j]->narrative);
                }
                $j += 1;
                break;
           case 5:
                // SECTION 8 - supplemental report(s)
                // may have more than 1 result so prints outside of loop
                if ($results[$i][$j]->supp_text != null) {
                    $pdf->AddPage();
                    $pdf->Image(LOGO, 20, 5, 35);
                    $pdf->SetFont($font, '', $font3);
                    $pdf->SetY(5);
                    $pdf->SetX(160);
                    $pdf->Write(10, 'Case #: ');
                    $pdf->SetFont($font, 'U', $font3);
                    $pdf->Write(10, $results[$i][$j]->case_number);
                    
                    // title page header
                    $pdf->SetY(5);
                    $pdf->SetFont($font, 'B', $font1);
                    $pdf->Cell(0, 10, 'Supplemental Report #' . $results[$i][$j]->doc_num, 0, 1, 'C');
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font3);
                    $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
                    $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
                    $pdf->SetY(45);
                    
                    // SECTION 1 - supp report
                    $pdf->Ln(2);
                    $pdf->SetFont($font, 'B', $font2);
                    $pdf->Cell(0, 5, 'Supplemental Report #' . $results[$i][$j]->doc_num, 1, 1, 'C');
                    $pdf->Ln(2);
                    
                    // supp report
                    $pdf->SetFont($font, '', $font3);
                    $pdf->Write(5, $results[$i][$j]->supp_text);
                }
                break;
        }
    }
}
// save and output
ob_end_clean();
$pdf->Output();
?>