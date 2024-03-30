<!-- view/data_entry/cremation_view.php -->
<body onload='check_table("data_entry_cremation_view");'>
	<div class="container">
        <div id="cremation-view-page" class="col-sm-10">
        <?php  if(isset($_POST['case_number']) && (isset($_POST['cremation']) || isset($_POST['cremation_only']) || isset($_POST['view_by']) 
            	        || isset($_POST['funeral_home']) || isset($_POST['trauma_noted']) || isset($_POST['internal_foreign_object']) 
            	        || isset($_POST['internal_foreign_object_text']) || isset($_POST['issue_permit']) || isset($_POST['cremation_memo']))){
            	           $case_number = $_POST['case_number'];
            	           $column1 = isset($_POST['cremation']);
            	           $column2 = isset($_POST['cremation_only']);
            	           $column4 = $_POST['view_by'];
            	           $column5 = $_POST['funeral_home'];
            	           $column6 = isset($_POST['trauma_noted']);
            	           $column7 = $_POST['internal_foreign_object'];
            	           $column8 = $_POST['internal_foreign_object_text'];
            	           $column9 = isset($_POST['issue_permit']);
            	           $column10 = $_POST['cremation_memo'];
            	           $column_arr = [
            	               "cremation" => $column1,
            	               "cremation_only" => $column2,
            	               "view_by" => $column4,
            	               "funeral_home" => $column5,
            	               "trauma_noted" => $column6,
            	               "internal_foreign_object" => $column7,
            	               "internal_foreign_object_text" => $column8,
            	               "issue_permit" => $column9,
            	               "cremation_memo" => $column10
            	           ];
            	           $this->entry_model->insert_db('data_entry_cremation_view', $case_number, $column_arr);
            		  }    
	           ?>
        	<form action="" method="POST" id="form">
        	<div id="bottom-buttons">
        		<!-- Save to database -->
        		<button type="submit" id="save-button" class="btn"><b>Save Record</b></button>
        	</div>
        	
    		<h2 name="title"><b>Cremation View</b></h2>
    		<input id='table_name' name='table_name' value='data_entry_cremation_view' type='hidden'></>
			<hr/>
			<label>Case #:<input name="case_number" id="case_number" class="case-input"
					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000"
					onkeyup="get_form_details(this.value, 'data_entry_cremation_view')" required></label> 
			<p><label>Cremation<input name="cremation" id="cremation" type="checkbox" onclick="change_checkbox_value(this.id)"></label></p>
			<p><label>Cremation Only<input name="cremation_only" id="cremation_only" type="checkbox" onclick="change_checkbox_value(this.id)"></label></p>
			<row><label>View By:<input name="view_by" id="view_by" class="medium-input" list="deputy-options" placeholder="select or input"/>
        		<datalist id="deputy-options">
					<?php echo $this->entry_model->fill_options("person", "name");?>
				</datalist></label> </row>
			<row><label>View Location:<input name="funeral_home" id="funeral_home" class="Xlong-input" 
				list="funeral-home-options" placeholder="select or input"/> 
				<datalist id="funeral-home-options">
					<?php echo $this->entry_model->fill_options("funeral_home", "name");?>
				</datalist></label> </row>
			<p><label>Trauma Noted? <input name="trauma_noted" id="trauma_noted" type="checkbox" onclick="change_checkbox_value(this.id)"></label></p>
			<h7>
				<select name="internal_foreign_object" id="internal_foreign_object">
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					<option value="Unknown">Unknown</option>
				</select> INTERNAL FOREIGN OBJECT ALERT: Is there any internal
				electromechanical device or any other foreign object noted in the
				Coroner/Medical Examiner case file for the decedent named on this
				form? <b>If “Yes”, describe the object(s):</b></h7>
			<row><textarea name="internal_foreign_object_text" id="internal_foreign_object_text"></textarea></row>
			<p><label>OK to issue permit?<input name="issue_permit" id="issue_permit" type="checkbox" onclick="change_checkbox_value(this.id)"></label></p>
			<div class="comment-container">
				<label>Additonal Comments</label>
				<row><textarea name="cremation_memo" id="cremation_memo" rows="10"></textarea></row>
			</div>
			 <hr />
			</form>
		</div>
	</div>