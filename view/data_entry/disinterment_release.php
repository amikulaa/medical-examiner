<!-- view/data_entry/disinterment_release.php -->
 <body onload='check_table("data_entry_disinterment_release");'>
	<div class="container">
        <div id="disinterment-form" class="col-sm-10">
        <?php  if(isset($_POST['case_number']) && 
			         (isset($_POST['first_mi_name']) || isset($_POST['last_name']) || isset($_POST['date_of_death']) 
			            || isset($_POST['decedent_age_noninfant']) || isset($_POST['age_infant']) || isset($_POST['current_cemetery_lot']) || isset($_POST['current_cemetery_name']) 
            	        || isset($_POST['current_cemetery_citystatezip']) || isset($_POST['current_cemetery_country']) || isset($_POST['new_dispo'])
            	        || isset($_POST['new_cremated']) || isset($_POST['new_cremated_interred']) || isset($_POST['new_cremated_mausoleum'])
            	        || isset($_POST['new_cremated_delegated']) || isset($_POST['new_reinterred']) || isset($_POST['new_cemetery_lot'])
            	        || isset($_POST['new_cemetery_name']) || isset($_POST['new_cemetery_citystatezip']) || isset($_POST['new_cemetery_county'])
            	        || isset($_POST['new_cemetery_state_country']) || isset($_POST['applicant_name']) || isset($_POST['applicant_license'])
            	        || isset($_POST['applicant_fulladdress']) || isset($_POST['applicant_phone']) || isset($_POST['applicant_payment'])
            	        || isset($_POST['applicant_nnok']) || isset($_POST['applicant_agreement']) || isset($_POST['issuing_official_name'])
            	        || isset($_POST['issuing_official_title']) || isset($_POST['issuing_official_signature_date']))){
            	           $case_number = $_POST['case_number'];
            	           $column1 = $_POST['first_mi_name'];
            	           $column2 = $_POST['last_name'];
            	           $column3 = $_POST['date_of_death'];
            	           $column4 = $_POST['decedent_age_noninfant'];
            	           $column5 = $_POST['age_infant'];
            	           $column6 = $_POST['current_cemetery_lot'];
            	           $column7 = $_POST['current_cemetery_name'];
            	           $column8 = $_POST['current_cemetery_citystatezip'];
            	           $column9 = $_POST['current_cemetery_country'];
            	           
            	           $column10 = isset($_POST['new_dispo']);
            	           $column11 = isset($_POST['new_cremated']);
            	           $column12 = isset($_POST['new_cremated_interred']);
            	           $column13 = isset($_POST['new_cremated_mausoleum']);
            	           $column14 = isset($_POST['new_cremated_delegated']);
            	           $column15 = isset($_POST['new_reinterred']);
            	           $column16 = $_POST['new_cemetery_lot'];
            	           $column17 = $_POST['new_cemetery_name'];
            	           $column18 = $_POST['new_cemetery_citystatezip'];
            	           $column19 = $_POST['new_cemetery_county'];
            	           $column20 = $_POST['new_cemetery_state_country'];
            	           
            	           $column21 = $_POST['applicant_name'];
            	           $column22 = $_POST['applicant_license'];
            	           $column23 = $_POST['applicant_fulladdress'];
            	           $column24 = $_POST['applicant_phone'];
            	           $column25 = isset($_POST['applicant_payment']);
            	           $column26 = isset($_POST['applicant_nnok']);
            	           $column27 = isset($_POST['applicant_agreement']);
            	           $column28 = $_POST['issuing_official_name'];
            	           $column29 = $_POST['issuing_official_title'];
            	           $column30 = $_POST['issuing_official_signature_date'];
            	           
            	           $column_arr = [
            	               "first_mi_name" => $column1,
            	               "last_name" => $column2,
            	               "date_of_death" => $column3,
            	               "decedent_age_noninfant" => $column4,
            	               "age_infant" => $column5,
            	               "current_cemetery_lot" => $column6,
            	               "current_cemetery_name" => $column7,
            	               "current_cemetery_citystatezip" => $column8,
            	               "current_cemetery_country" => $column9,
            	               "new_dispo" => $column10,
            	               "new_cremated" => $column11,
            	               "new_cremated_interred" => $column12,
            	               "new_cremated_mausoleum" => $column13,
            	               "new_cremated_delegated" => $column14,
            	               "new_reinterred" => $column15,
            	               "new_cemetery_lot" => $column16,
            	               "new_cemetery_name" => $column17,
            	               "new_cemetery_citystatezip" => $column18,
            	               "new_cemetery_county" => $column19,
            	               "new_cemetery_state_country" => $column20,
            	               "applicant_name" => $column21,
            	               "applicant_license" => $column22,
            	               "applicant_fulladdress" => $column23,
            	               "applicant_phone" => $column24,
            	               "applicant_payment" => $column25,
            	               "applicant_nnok" => $column26,
            	               "applicant_agreement" => $column27,
            	               "issuing_official_name" => $column28,
            	               "issuing_official_title" => $column29,
            	               "issuing_official_signature_date" => $column30
            	           ];
            	           
            	           $this->entry_model->insert_db('data_entry_disinterment_release', $case_number, $column_arr);
                }
                
            ?>
	      	<div id="bottom-buttons">
    	        <form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>DataEntry/print_page' target='_blank'>
                    	<input id='case_number_hide' name='case_number_hide' type='hidden' value='unchanged'></input>
                    	<input id='table_name_hide' name='table_name_hide' type='hidden' value='unchanged table'></input>
                    	<button name="print_button" id="print_button" class="btn" value='disinterment_release'><b><i class="fa fa-solid fa-print"></i></b></button>
                </form></div>
            <div id="bottom-buttons">
                <form action="" method="POST" id="form" class='form'>
                     <!-- Save to database -->
                    <button name="save_button" id="save_button" class="btn" type="submit"><b>Save Record</b></button>
        	</div>
    		<h2 name="title"><b>Disinterment Release</b></h2>
    		<input id='table_name' name='table_name' value='data_entry_disinterment_release' type='hidden'></>
			<hr/>
    		<div id="formatted-top">
    			<label>Case #:<input name="case_number" id="case_number" class="case-input"
					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000"
					onkeyup="get_form_details(this.value, 'data_entry_disinterment_release')" required></label> 
    			<h4><b>Disinterment Release</b></h4>
    			<h3><b>Jefferson County</b></h3>
    			<h3><b>Office of the Medical Examiner</b></h3>
    			<h3>311 S. Center Ave.</h3>
    			<h3>Jefferson, WI 53549</h3>
    			<h3>Phone:(920) 674-7119</h3>
    			<h3>Fax:(920) 674-7602</h3>
    			<h5>This permit, when properly completed, signed, and dated,
    				constitutes authority under s. 69.18 (4) for disinterment, 
    				removal, transportation, and reburial of the remains of: <input id="deceased-full-name" class="hide-me" disabled></input></h5>
    		</div>
    		<br/>
    		<hr/>
    		
    		<!-- Current Decedent Interment Information: -->
    		<row><h3 id="form-section-header"><b>Current Decedent Interment Information</b></h3></row>
    		<row><label>1. Name of Decedent:<input name="first_mi_name" id="first_mi_name" type="text" placeholder='first name mi'><input name="last_name" id="last_name" type="text" placeholder='last name'></label></row>
			<label>2. Date of Death:<input name="date_of_death" id="date_of_death" type="date"></label>
			<label>3. Age:<input name="decedent_age_noninfant" id="decedent_age_noninfant" class="short-input" type="number" min="0" max="125"></label>
			<label>Age, if < 1:<input name="age_infant" id="age_infant" type="text"></label>
			<label>4. Now Interred in:<input name="current_cemetery_lot" id="current_cemetery_lot" type="text" placeholder='vault or lot number'></label>
			<label>5. Name of Current Cemetery:<input name="current_cemetery_name" id="current_cemetery_name" type="text" class="long-input"></label>
			<label>6. Located in:<input name="current_cemetery_citystatezip" id="current_cemetery_citystatezip" class="medium-input" type="text"></label>
			<label>7. County of:<input name="current_cemetery_country" id="current_cemetery_country" type="text" class="medium-input">, WI</label>
			<hr/>	
			
			<!-- Place of Re-Interment or Cremation Information -->
			<row><h3 id="form-section-header"><b>Place of Re-Interment or Cremation Information</b></h3></row>
			<row><label>8. New Disposition:<input name="new_dispo" id="new_dispo" type="checkbox" onclick="change_checkbox_value(this.id)">Cremated Remains Being Disintered?</label></row>
			<row><label><input name="new_cremated" id="new_cremated" type="checkbox" onclick="change_checkbox_value(this.id)">8a. Disinterred Remains Will be Cremated 
				<b>(If yes, Cremation Permit is required)</b></label></row>
    		<div id="indent-text">
    			<label>Cremains will be: </label>
    			<br/>
    			<label><input name="new_cremated_interred" id="new_cremated_interred" type="checkbox" onclick="change_checkbox_value(this.id)">Interred <i>(complete items 9-13)</i></input></label>
    			<br/>
    			<label><input name="new_cremated_mausoleum" id="new_cremated_mausoleum" type="checkbox" onclick="change_checkbox_value(this.id)">Placed in Mausoleam <i>(complete items 9-13)</i></input></label>
    			<br/>
    			<label><input name="new_cremated_delegated" id="new_cremated_delegated" type="checkbox" onclick="change_checkbox_value(this.id)">Given to Delegated Individual</input></label>
    		</div>
			<row><label><input name="new_reinterred" id="new_reinterred" type="checkbox" onclick="change_checkbox_value(this.id)">8b. Disinterred Remains Will be Re-Interred</label></row>
			<br/><row><label>9. New Cemetery or Mausoleum Location:<input name="new_cemetery_lot" id="new_cemetery_lot" type="text" placeholder='vault or lot number'></label></row>
			<row><label>10. Name of Cemetary Mausoleum:<input name="new_cemetery_name" id="new_cemetery_name" type="text"  class="long-input"></label></row>
			<label>11. Located in:<input name="new_cemetery_citystatezip" id="new_cemetery_citystatezip" class="long-input" type="text"></label>
			<label>12. County of:<input name="new_cemetery_county" id="new_cemetery_county" type="text" class="medium-input"></label>
			<label>13. State or Country:<input name="new_cemetery_state_country" id="new_cemetery_state_country" type="text" class="medium-input"></label>
			<hr />
					
			<!-- Permit Issued To -->
			<row><h3 id="form-section-header"><b>Permit Issued To</b></h3></row>
			<label>14. Name of Applicant:<input name="applicant_name" id="applicant_name" type="text" placeholder='full name' class="medium-input"></label>
			<label>15. License #:<input name="applicant_license" id="applicant_license" type="text" class="medium-input"></label
			<row><label>16. Mailing Address:<input name="applicant_fulladdress" id="applicant_fulladdress" class="long-input" type="text"></label></row>
			<label>17. Phone #:<input name="applicant_phone" id="applicant_phone" type="text" placeholder="000-000-0000" pattern="\d{3}[\-]\d{3}[\-]\d{4}"></label>
			<label>18. Fee Payment:<input name="applicant_payment" id="applicant_payment" type="checkbox" onclick="change_checkbox_value(this.id)">Paid</label>
			<br/>
			<row><label>19. Applicant Has Supplied:</label>
				<label><input name="applicant_nnok" id="applicant_nnok" type="checkbox" onclick="change_checkbox_value(this.id)">Notarized Next of Kin Request</input></label>
				<label><input name="applicant_agreement" id="applicant_agreement" type="checkbox" onclick="change_checkbox_value(this.id)">Agreement of Cemetery Offical</input></label>
			</row>
			<p><label>20. Name of Issuing Official:<input name="issuing_official_name" id="issuing_official_name" type="text" class="medium-input"></label>
			<label>21. Title:<input name="issuing_official_title" id="issuing_official_title" type="text"></label></p>
			<p><label>22. Signature of Issuing Official:<input id="permit-issuing-official-signature" class="hide-me" disabled></label>
			<label>Date Signed<input name="issuing_official_signature_date" id="issuing_official_signature_date" type="date"></label></p>
				
			<!-- Fine Terms -->
			<hr />
			<h5>The applicant for the disinterment permit is obligated to arrange for the legal disposal 
				of the remains in accordance with applicable state and local laws and local health department rules.
				If the remains of the decedent will be cremated after disinterment, the applicant must obtain a signed 
				Cremation Permit from the Coroner or Medical Examiner of jurisdiction in accordance with s.979.10 Wis.</h5>
			<h5>This disinterment permit is not required if the disinterment is done to correct
				an error in the placement of the corpse and the decedent is reinterred in the same cemetery per s.69.18 (4), Wis. Stats.</h5>
			<hr />
			</form>
		</div>
	</div>