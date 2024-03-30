<!-- view/data_entry/inv_form.php -->
<body onload='check_table("data_entry_inv_form");'>
    <div class="container">
        <div id="invoice-form" class="col-sm-10">
        <?php 
        if(isset($_POST['case_number']) &&
			    (isset($_POST['first_mi_name']) || isset($_POST['last_name']) || isset($_POST['current_facility_address'])
			        || isset($_POST['decedent_phone']) || isset($_POST['decedent_date_of_birth'])
			        || isset($_POST['decedent_age_noninfant']) || isset($_POST['decedent_age_infant'])
			        || isset($_POST['decedent_sex']) || isset($_POST['decedent_race'])
			        || isset($_POST['decedent_height']) || isset($_POST['decedent_weight'])
			        || isset($_POST['date_of_death']) || isset($_POST['time_of_death'])
			        || isset($_POST['where_pronounced_facility'])
			        || isset($_POST['where_pronounced_physician']) || isset($_POST['sign_dc_physician'])
			        || isset($_POST['family_physician']) || isset($_POST['id_results']) || isset($_POST['id_by'])
			        || isset($_POST['id_method']) || isset($_POST['kin_full_name']) || isset($_POST['kin_phone'])
			        || isset($_POST['kin_address']) || isset($_POST['kin_citystatezip'])
			        || isset($_POST['kin_relationship']) || isset($_POST['kin_notified_by'])
			        || isset($_POST['decedent_funeral_home']) || isset($_POST['donor_agency_notified'])
			        || isset($_POST['donor_agency_notified_date']) || isset($_POST['donor_agency_notified_time']) || isset($_POST['donor_agency_notified_name'])
			        || isset($_POST['donor_agency_reference_num']) || isset($_POST['donor_agency_referenced_by'])
			        || isset($_POST['disposition_option']) || isset($_POST['disposition_aut_ext_by'])
			        || isset($_POST['disposition_referred_to']) || isset($_POST['disposition_wisconsin_county'])
			        || isset($_POST['scene']) || isset($_POST['cremation']) || isset($_POST['cremation_only'])
			        || isset($_POST['dead_24']) || isset($_POST['traffic_fatality']) || isset($_POST['in_custody'])
			        || isset($_POST['anthro_case']) || isset($_POST['disinterment']) || isset($_POST['suicide'])
			        || isset($_POST['homicide']) || isset($_POST['drug_related']) || isset($_POST['accident'])
			        || isset($_POST['WFCAP']) || isset($_POST['mutual_aid']) || isset($_POST['indigent']) )){
			            $case_number = $_POST['case_number'];
			            $column1 = $_POST['first_mi_name'];
			            $column2 = $_POST['last_name'];
			            $column3 = $_POST['current_facility_address'];
			            $column4 = $_POST['decedent_phone'];
			            $column5 = $_POST['decedent_date_of_birth'];
			            $column6 = $_POST['decedent_age_noninfant'];
			            $column7 = $_POST['decedent_age_infant'];
			            $column8 = $_POST['decedent_sex'];
			            $column9 = $_POST['decedent_race'];
			            $column10 = $_POST['decedent_height'];
			            $column11 = $_POST['decedent_weight'];
			            $column12 = $_POST['date_of_death'];
			            $column13 = $_POST['time_of_death'];
			            $column14 = $_POST['where_pronounced_facility'];
			            $column15 = $_POST['where_pronounced_physician'];
			            $column16 = $_POST['sign_dc_physician'];
			            $column17 = $_POST['family_physician'];
			            $column18 = $_POST['id_results'];
			            $column19 = $_POST['id_by'];
			            $column20 = $_POST['id_method'];
			            $column21 = $_POST['kin_full_name'];
			            $column22 = $_POST['kin_phone'];
			            $column23 = $_POST['kin_address'];
			            $column24 = $_POST['kin_citystatezip'];
			            $column25 = $_POST['kin_relationship'];
			            $column26 = $_POST['kin_notified_by'];
			            $column27 = $_POST['decedent_funeral_home'];
			            $column28 = $_POST['donor_agency_notified'];
			            $column29 = $_POST['donor_agency_notified_date'];
			            $column30 = $_POST['donor_agency_notified_time'];
			            $column31 = $_POST['donor_agency_notified_name'];
			            $column32 = $_POST['donor_agency_reference_num'];
			            $column33 = $_POST['donor_agency_referenced_by'];
			            $column34 = $_POST['disposition_option'];
			            $column35 = $_POST['disposition_aut_ext_by'];
			            $column36 = isset($_POST['disposition_referred_to']);
			            $column37 = $_POST['disposition_wisconsin_county'];
			            $column38 = isset($_POST['scene']);
			            $column39 = isset($_POST['cremation']);
			            $column40 = isset($_POST['cremation_only']);
			            $column41 = isset($_POST['dead_24']);
			            $column42 = isset($_POST['traffic_fatality']);
			            $column43 = isset($_POST['in_custody']);
			            $column44 = isset($_POST['anthro_case']);
			            $column45 = isset($_POST['disinterment']);
			            $column46 = isset($_POST['suicide']);
			            $column47 = isset($_POST['homicide']);
			            $column48 = isset($_POST['drug_related']);
			            $column49 = isset($_POST['accident']);
			            $column50 = isset($_POST['WFCAP']);
			            $column51 = isset($_POST['mutual_aid']);
			            $column52 = isset($_POST['indigent']);
			            $column_arr = [
			                "first_mi_name" => $column1,
			                "last_name" => $column2,
			                "current_facility_address" => $column3,
			                "decedent_phone" => $column4,
			                "decedent_date_of_birth" => $column5,
			                "decedent_age_noninfant" => $column6,
			                "decedent_age_infant" => $column7,
			                "decedent_sex" => $column8,
			                "decedent_race" => $column9,
			                "decedent_height" => $column10,
			                "decedent_weight" => $column11,
			                "date_of_death" => $column12,
			                "time_of_death" => $column13,
			                "where_pronounced_facility" => $column14,
			                "where_pronounced_physician" => $column15,
			                "sign_dc_physician" => $column16,
			                "family_physician" => $column17,
			                "id_results" => $column18,
			                "id_by" => $column19,
			                "id_method" => $column20,
			                "kin_full_name" => $column21,
			                "kin_phone" => $column22,
			                "kin_address" => $column23,
			                "kin_citystatezip" => $column24,
			                "kin_relationship" => $column25,
			                "kin_notified_by" => $column26,
			                "decedent_funeral_home" => $column27,
			                "donor_agency_notified" => $column28,
			                "donor_agency_notified_date" => $column29,
			                "donor_agency_notified_time" => $column30,
			                "donor_agency_notified_name" => $column31,
			                "donor_agency_reference_num" => $column32,
			                "donor_agency_referenced_by" => $column33,
			                "disposition_option" => $column34,
			                "disposition_aut_ext_by" => $column35,
			                "disposition_referred_to" => $column36,
			                "disposition_wisconsin_county" => $column37,
			                "scene" => $column38,
			                "cremation" => $column39,
			                "cremation_only" => $column40,
			                "dead_24" => $column41,
			                "traffic_fatality" => $column42,
			                "in_custody" => $column43,
			                "anthro_case" => $column44,
			                "disinterment" => $column45,
			                "suicide" => $column46,
			                "homicide" => $column47,
			                "drug_related" => $column48,
			                "accident" => $column49,
			                "WFCAP" => $column50,
			                "mutual_aid" => $column51,
			                "indigent" => $column52
			            ];
			            
			            $this->entry_model->insert_db('data_entry_inv_form', $case_number, $column_arr);
			}
			?>
	        <div id="bottom-buttons">
    	        <form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>DataEntry/print_page' target='_blank'>
                    	<input id='case_number_hide' name='case_number_hide' type='hidden' value='unchanged'></input>
                    	<input id='table_name_hide' name='table_name_hide' type='hidden' value='unchanged table'></input>
                    	<button name="print_button" id="print_button" class="btn" value='inv_form'><b><i class="fa fa-solid fa-print"></i></b></button>
                </form></div>
            <div id="bottom-buttons">
                <form action="" method="POST" id="form" class='form'>
                     <!-- Save to database -->
                    <button name="save_button" id="save_button" class="btn" type="submit"><b>Save Record</b></button>
        	</div>
    		<h2 id="title"><b>Investigative Form</b></h2>
    		<input id='table_name' name='table_name' value='data_entry_inv_form' type='hidden'></>
			<hr/>
				
			<!-- Decedent Basic Info -->
			<h3 id="form-section-header"><b>Decedent</b></h3>
			<label>Case #:<input name="case_number" id="case_number" class="case-input"
					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000"
					onkeyup="get_form_details(this.value, 'data_entry_inv_form')" required></label> 
			<row> <label>First Name:<input name="first_mi_name" id="first_mi_name" type="text" placeholder='first name mi'></label></row>
			<row> <label>Last Name:<input name="last_name" id="last_name" type="text" placeholder='last name'></label></row>

			<!-- Facility Fill -->
			<row> <label>Address:<input name="current_facility_address" id="current_facility_address" class="long-input" list="current-facility" 
				placeholder="select or input" /> <datalist name="current_facility" id="current-facility">
					<?php echo $this->entry_model->fill_options("facility", "name_address");?>
			</datalist></label> </row>

			<!-- Basic Decedent Input -->
			<row> <label>Phone #:<input name="decedent_phone" id="decedent_phone" type="text" placeholder="000-000-0000" pattern="\d{3}[\-]\d{3}[\-]\d{4}"></label>
			<label>Date of Birth:<input name="decedent_date_of_birth" id="decedent_date_of_birth" type="date"></label></row>
			<row> <label>Age:<input name="decedent_age_noninfant" id="decedent_age_noninfant" class="short-input" type="number" min="0" max="125"></label>
			<label>Age, if < 1:<input name="decedent_age_infant" id="decedent_age_infant" type="text"></label>
			<label>Sex:<select name="decedent_sex" id="decedent_sex">
					<option value="?">?</option>
					<option value="M">M</option>
					<option value="F">F</option>
			</select></label> </row><br>
			
			<!-- Race Fill -->
			<row> <label>Race:<input name="decedent_race" id="decedent_race" list="race" placeholder="select or input"  /> 
			<datalist name="decedent_race" id="race">
					<?php echo $this->entry_model->fill_options("race", "name");?>
			</datalist></label> </row>
			
			<!-- Basic Decedent Input -->
			<row> <label>Height:<input name="decedent_height" id="decedent_height" class="short-input" type="text"></label></row>
			<row> <label>Weight:<input name="decedent_weight" id="decedent_weight" class="short-input" type="number" min="0"></label></row>
			<row> <label>Date of Death:<input name="date_of_death" id="date_of_death" type="date"></label></row>
			<row> <label>Time of Death:<input name="time_of_death" id="time_of_death" type="time"></label></row>
			<!-- Facility Fill -->
			<row> <label>Where Pronounced:<input name="where_pronounced_facility" id="where_pronounced_facility" class="long-input" list="where_pronounced" 
				placeholder="select or input" /> <datalist name="where_pronounced" id="where_pronounced">
					<?php echo $this->entry_model->fill_options("facility", "name_address");?>
			</datalist></label> </row>
			
			<!-- Physician Fill -->
			<row> <label>Pronounced By:<input name="where_pronounced_physician" id="where_pronounced_physician" class="long-input"
				list="physician-options" placeholder="select or input"  /> <datalist
				id="physician-options" id="physician-options">
        			<?php echo $this->entry_model->fill_options("physician", "name");?>
        	</datalist></label> </row>
			<row> <label>Who Will Sign DC?:<input name="sign_dc_physician" id="sign_dc_physician" class="long-input"
				list="physician-options" placeholder="select or input"  /> <datalist
				id="physician-options" id="physician-options" >
        			<?php echo $this->entry_model->fill_options("physician", "name");?>
        		</datalist></label> </row>
			<row> <label>Family Physician:<input name="family_physician" id="family_physician" class="long-input"
				list="physician-options" placeholder="select or input"  /> <datalist
				name="physician-options" id="physician-options" >
        			<?php echo $this->entry_model->fill_options("physician", "name");?>
        		</datalist></label> </row>
			<hr />

			<!-- Identification -->
			<h3 id="form-section-header"><b>Identification</b></h3>
			<row> <label>Identification: <select name="id_results" id="id_results">
					<option value="Tentative">Tentative</option>
					<option value="Positive">Positive</option>
			</select></label>
			<label>ID By:<input name="id_by" id="id_by" type="text"></label>
			<!-- Method Fill -->
			<label>ID Method: <input name="id_method" id="id_method" list="id" placeholder="select or input"
				 /> <datalist name="id" id="id">
					<?php echo $this->entry_model->fill_options("id_method", "name");?>
				</datalist></label> </row>
			<hr />

			<!-- Next of Kin -->
			<h3 id="form-section-header"><b>Next of Kin</b></h3>
			<row> <label>Kin Name:<input name="kin_full_name" id="kin_full_name" type="text" placeholder='full name'></label>
			<label>Phone #:<input name="kin_phone" id="kin_phone" type="text" placeholder="000-000-0000" pattern="\d{3}[\-]\d{3}[\-]\d{4}"></label>
				
			<label>Address:<input name="kin_address" id="kin_address" type="text" class="medium-input"></label>
			<!-- City, State Zip Fill --> 
			<label>City, State Zip: <input name="kin_citystatezip" id="kin_citystatezip" list="citystatezip" class="medium-input" placeholder="select or input"/>
				<datalist id="citystatezip">
					<?php echo $this->entry_model->fill_options("citystatezip", "name");?>
				</datalist></label> 
			<!-- Relationship Fill -->
			<row> <label>Relationship: <input name="kin_relationship" id="kin_relationship"
				list="relationship-options" placeholder="select or input"  /> 
				<datalist id="relationship-options">
					<?php echo $this->entry_model->fill_options("relationship", "name");?>
				</datalist></label> 
			<label>Notified By:<input name="kin_notified_by" id="kin_notified_by" type="text" class='medium-input'></label></row>
			<hr />

			<!-- Funeral Home -->
			<h3 id="form-section-header"><b>Funeral Home</b></h3>
			<!-- Funeral Home Fill -->
			<row> <label>Funeral Home: <input name="decedent_funeral_home" id="decedent_funeral_home" class="long-input" 
				list="funeral-home-options" placeholder="select or input"  /> 
				<datalist id="funeral-home-options">
					<?php echo $this->entry_model->fill_options("funeral_home", "name");?>
				</datalist></label> </row>
			<hr />

			<!-- Donor Agency -->
			<h3 id="form-section-header"><b>Donor Agency</b></h3>
			<row> <label>Donor Agency Notified:<select name="donor_agency_notified" id="donor_agency_notified" >
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					<option value="Unknown">Unknown</option>
					<option value="Not Applicable">Not Applicable</option>
			</select></label> </row>
			<row> <label>Date:<input name="donor_agency_notified_date" id="donor_agency_notified_date" type="date"></label>
			<label>Time:<input name="donor_agency_notified_time" id="donor_agency_notified_time" type="time"></label></row>
			<!-- Donor Agency Fill -->
			<row> <label>Agency Notified:<input name="donor_agency_notified_name" id="donor_agency_notified_name" class="medium-input"
				list="agency-notified-options" placeholder="select or input"/> 
				<datalist id="agency-notified-options">
					<?php echo $this->entry_model->fill_options("donor_agency", "name");?>
				</datalist></label> </row>
			<row> <label>Reference #:<input name="donor_agency_reference_num" id="donor_agency_reference_num" type="text"></label></row>
			<row> <label>By Whom:<input name="donor_agency_referenced_by" id="donor_agency_referenced_by" type="text" class='medium-input'></label></row>
			<hr />

			<!-- Disposition -->
			<h3 id="form-section-header"><b>Disposition</b></h3>
			<label>Disposition:<input name="disposition_option" id="disposition_option" list='disposition_list'>
			<datalist id='disposition_list' name='disposition_list'>
					<option value=''>Select</option>
					<option value="Records Review">Records Review</option>
					<option value="Released">Released</option>
					<option value="Autopsy">Autopsy</option>
					<option value="External">External</option>
				<option value="Storage">Storage</option>
			</datalist>
			</select></label>
			<!-- Deputy Fill -->
			<label>Aut/Etx By:<input name="disposition_aut_ext_by" id="disposition_aut_ext_by" list="deputy-options" 
				placeholder="select or input" class="medium-input" /> 
				<datalist id="deputy-options">
					<?php echo $this->entry_model->fill_options("person", "name");?>
			</datalist></label> 
			<br/>
			<label>Referred To?:<input name="disposition_referred_to" id="disposition_referred_to" type="checkbox" onclick="change_checkbox_value(this.id)"></label>
			<label>Referred County:<input name="disposition_wisconsin_county" id="disposition_wisconsin_county"
				list="wisconsin_counties" placeholder="select or input" class='medium-input'/> 
				<datalist id="wisconsin_counties" >
					<?php echo $this->entry_model->fill_options("wisconsin_counties", "name");?>
			</datalist></label> 
			<hr />
				
			<!-- Misc. Check Boxes -->
			<row> <label>Scene<input name="scene" id="scene" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Cremation<input name="cremation" id="cremation" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Cremation Only<input name="cremation_only" id="cremation_only" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Dead > 24<input name="dead_24" id="dead_24" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Traffic Fatality<input name="traffic_fatality" id="traffic_fatality" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>In Custody<input name="in_custody" id="in_custody" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Anthro Case<input name="anthro_case" id="anthro_case" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Disinterment<input name="disinterment" id="disinterment" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Suicide<input name="suicide" id="suicide" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Homicide<input name="homicide" id="homicide" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Drug Related<input name="drug_related" id="drug_related" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Accident<input name="accident" id="accident" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>WFCAP<input name="WFCAP" id="WFCAP" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Mutual Aid<input name="mutual_aid" id="mutual_aid" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<row> <label>Indigent<input name="indigent" id="indigent" type="checkbox" onclick="change_checkbox_value(this.id)"></label></row>
			<hr/>
			</form>
		</div>
    </div>