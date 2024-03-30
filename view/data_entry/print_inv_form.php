<?php
require_once("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle('Inv Form PDF');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';
$loop_count = 1;

// add new page for all results returned
foreach($results as $row) {
    if($loop_count == 1){
        $pdf->AddPage();
        $pdf->Image(LOGO, 20, 5, 35);
        $pdf->SetFont($font,'', $font3);
        $pdf->SetY(5);
        $pdf->SetX(160);
        $pdf->Write(10, 'Case #: ');
        $pdf->SetFont($font,'U', $font3);
        $pdf->Write(10, $row->case_number);
        //$pdf->Cell(0, 0, 'Case #: ' . $row->case_number, 0, 2, 'R');
        
        // title page header
        $pdf->SetY(5);
        $pdf->SetFont($font,'B', $font1);
        $pdf->Cell(0, 10, 'Investigative Form', 0, 1, 'C');
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font3);
        $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
        $pdf->SetFont($font,'', $font3);
        $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
        $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
        $pdf->SetY(45);
        
        // SECTION 0 - Case Information ADD to results in entry_model
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Case Information', 1, 1, 'C');
        $pdf->Ln(2);
            //Reported To: reported_to
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Reported To: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(50, 5, $row->reported_to, 'B', 0, 'L');
            
            //Date Reported: date_reported
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(28, 5, 'Date Reported: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->date_reported, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Time Reported: time_reported
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(28, 5, 'Time Reported: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(10, 5, $row->time_reported, 'B', 0, 'L');
            
            //Reported By: reported_by
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Reported By: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(50, 5, $row->reported_by, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
        // SECTION 1 - Current Decedent Interment Information
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Current Decedent Interment Information', 1, 1, 'C');
        $pdf->Ln(2);
        
            //First/MI: first_mi_name and Last: last_name
            $pdf->Cell(5, 7, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(35, 5, 'Name of Decedent: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(30, 5, $row->first_mi_name, 'B', 0, 'L');
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->Cell(30, 5, $row->last_name, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Address: current_facility_address
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Address: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(160, 5, $row->current_facility_address, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Phone #: decedent_phone
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Phone #: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->decedent_phone, 'B', 0, 'L');
            
            //Date of Birth: decedent_date_of_birth
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Date of Birth: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->decedent_date_of_birth, 'B', 0, 'L');
            
            //age noninfant
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(15, 5, 'Age: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(5, 5, $row->decedent_age_noninfant, 'B', 0, 'L');
            
            //age infant
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Age, if < 1: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(30, 5, $row->decedent_age_infant, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Sex: decedent_sex
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(10, 5, 'Sex: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(5, 5, $row->decedent_sex, 'B', 0, 'L');
            
            //Race: decedent_race
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(12, 5, 'Race:', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(15, 5, $row->decedent_race, 'B', 0, 'L');
            
            //Height: decedent_height
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(15, 5, 'Height:', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(15, 5, $row->decedent_height, 'B', 0, 'L');
            
            //Weight: decedent_weight
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(15, 5, 'Weight:', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(15, 5, $row->decedent_weight, 'B', 0, 'L');
            
            //Date of Death: date_of_death
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Date of Death: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->date_of_death, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Time of Death: time_of_death
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(30, 5, 'Time of Death: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(10, 5, $row->time_of_death, 'B', 0, 'L');
            
            //Where Pronounced: where_pronounced_facility
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(35, 5, 'Where Pronounced: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(100, 5, $row->where_pronounced_facility, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Pronounced By: where_pronounced_physician
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(30, 5, 'Pronounced By: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(150, 5, $row->where_pronounced_physician, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Who Will Sign DC? sign_dc_physician
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Sign DC: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(160, 5, $row->sign_dc_physician, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Family Physician: family_physician
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(35, 5, 'Family Physician: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(145, 5, $row->family_physician, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
        // SECTION 2 - Identification
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Identification', 1, 1, 'C');
        $pdf->Ln(2);
            //Identification: id_results
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Identification: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(15, 5, $row->id_results, 'B', 0, 'L');
            
            //ID By: id_by
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(15, 5, 'ID By: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(50, 5, $row->id_by, 'B', 0, 'L');
            
            //ID Method: id_method
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'ID Method: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(40, 5, $row->id_method, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
        // SECTION 3 - Next of Kin
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Next of Kin', 1, 1, 'C');
        $pdf->Ln(2);
            //Name: kin_full_name
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Full Name: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(40, 5, $row->kin_full_name, 'B', 0, 'L');
            
            //Phone #: kin_phone
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Phone #: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->kin_phone, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Address: kin_address and City, State Zip: kin_citystatezip
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Address: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(90, 5, $row->kin_address, 'B', 0, 'L');
            $pdf->Cell(70, 5, $row->kin_citystatezip, 'B', 2, 'L');
            $pdf->SetFont($font,'I', $font4);
            $pdf->SetX(35);
            $pdf->Write(5, '(Street Address)');
            $pdf->SetX(125);
            $pdf->Write(5, '(City/St/Zip)');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Relationship: kin_relationship
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(30, 5, 'Relationship: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->kin_relationship, 'B', 0, 'L');
            
            //Notified By: kin_notified_by
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Notified By: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->kin_notified_by, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
        
        // SECTION 4 - Funeral Home
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Funeral Home', 1, 1, 'C');
        $pdf->Ln(2);
            //Funeral Home: decedent_funeral_home
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(35, 5, 'Funeral Home: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(145, 5, $row->decedent_funeral_home, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
        // SECTION 5 - Donor Agency
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Donor Agency', 1, 1, 'C');
        $pdf->Ln(2);
            //Donor Agency Notified: donor_agency_notified
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Notified: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(20, 5, $row->donor_agency_notified, 'B', 0, 'L');
            
            //Date: donor_agency_notified_date
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(15, 5, 'Date: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(25, 5, $row->donor_agency_notified_date, 'B', 0, 'L');
            
            //Time: donor_agency_notified_time
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(15, 5, 'Time: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(10, 5, $row->donor_agency_notified_time, 'B', 0, 'L');
            
            //Agency Notified: donor_agency_notified_name
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(30, 5, 'Agency Notified: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(30, 5, $row->donor_agency_notified_name, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Reference #: donor_agency_reference_num
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Reference #: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(30, 5, $row->donor_agency_reference_num, 'B', 0, 'L');
            
            //By Whom: donor_agency_referenced_by
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'By Whom: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(30, 5, $row->donor_agency_referenced_by, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
        // SECTION 6 - Disposition
        $pdf->Ln(2);
        $pdf->SetFont($font,'B', $font2);
        $pdf->Cell(0, 5, 'Disposition', 1, 1, 'C');
        $pdf->Ln(2);
            //Disposition: disposition_option
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(20, 5, 'Disposition: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(30, 5, $row->disposition_option, 'B', 0, 'L');
            
            //Aut/Etx By: disposition_aut_ext_by
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(22, 5, 'Aut/Etx By: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(50, 5, $row->disposition_aut_ext_by, 'B', 0, 'L');
            
            //line break
            $pdf->Cell(0, 8, '', 0, 1, '');
            
            //Referred To? disposition_referred_to
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(25, 5, 'Referred To?', 0, 0, 'l');
            $pdf->SetFont('ZapfDingbats','', 10);
            $pdf->Cell(5, 5, $row->disposition_referred_to == true ? 4 : "", 1, 0);
            
            
            //Referred County: disposition_wisconsin_county
            $pdf->Cell(5, 5, '     ', 0, 0);
            $pdf->SetFont($font,'B', $font3);
            $pdf->Cell(30, 5, 'Referred County: ', 0, 0, 'L');
            $pdf->SetFont($font,'', $font3);
            $pdf->Cell(40, 5, $row->disposition_wisconsin_county, 'B', 0, 'L');
            
            // if exists, print narrative
            if($row->narrative != null){
                // narrative
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
                $pdf->Cell(0, 10, 'Narrative', 0, 1, 'C');
                $pdf->Ln(2);
                $pdf->SetFont($font,'B', $font3);
                $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
                $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
                $pdf->SetFont($font,'', $font3);
                $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
                $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
                $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
                $pdf->SetY(45);
            
                // SECTION 7 - Narrative
                $pdf->Ln(2);
                $pdf->SetFont($font,'B', $font2);
                $pdf->Cell(0, 5, 'Narrative', 1, 1, 'C');
                $pdf->Ln(2);
                
                //narrative
                $pdf->SetFont($font,'', $font3);
                $pdf->Write(5, $row->narrative);
            }
            $loop_count += 1;
       }
   
       // SECTION 8 - supplemental report(s) 
       // may have more than 1 result so prints outside of loop
       if($row->supp_text != null){
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
           $pdf->Cell(0, 10, 'Supplemental Report #' . $row->doc_num, 0, 1, 'C');
           $pdf->Ln(2);
           $pdf->SetFont($font,'B', $font3);
           $pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
           $pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
           $pdf->SetFont($font,'', $font3);
           $pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
           $pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
           $pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
           $pdf->SetY(45);
           
           // SECTION 1 - supp report
           $pdf->Ln(2);
           $pdf->SetFont($font,'B', $font2);
           $pdf->Cell(0, 5, 'Supplemental Report #' . $row->doc_num, 1, 1, 'C');
           $pdf->Ln(2);
           
           //supp report
           $pdf->SetFont($font,'', $font3);
           $pdf->Write(5, $row->supp_text);
       }
} 

// we need the narrative to print on next page
// we also need all supplemental reports to print with this as well

// save and output
ob_end_clean();
$pdf->Output();
?>