<!-- view/data_entry/index.php -->
<body>
	<div class="container">
		<div class="col-sm-10">
		<div id="error_message_div"><input id="error_message" disabled></div>
		<!-- Call to fill database -->
    	<?php  if(isset($_POST['case_number_case']) && isset($_POST['reported_to'])
    	       && isset($_POST['date_reported']) && isset($_POST['time_reported'])
    	       && isset($_POST['reported_by'])){
    	           $case_number = $_POST['case_number_case'];
    	           $column1 = $_POST['reported_to'];
    	           $column2 = $_POST['date_reported'];
    	           $column3 = $_POST['time_reported'];
    	           $column4 = $_POST['reported_by'];
    	           $column_arr = [
    	               "reported_to" => $column1,
    	               "date_reported" => $column2,
    	               "time_reported" => $column3,
    	               "reported_by" => $column4
    	           ];
    	           
    	           $this->entry_model->insert_db('data_entry_case', $case_number, $column_arr);
    	       } 
    	  ?>
			<hr />
			<!-- onsubmit = add case -->
			<div id="case-info" class="row">
			<form action="" method="POST" id="index_form">
    				<label>Case #:<input name="case_number_case" id="case_number_case" class="case-input"
    					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000" 
    					onkeyup="get_form_details(this.value, 'data_entry_case')" required></label> 
    				<label>Reported To:<input id="reported_to" name="reported_to" class="medium-input"
    					placeholder="select or input" list="deputy-options" required /> 
    					<datalist id="deputy-options">
        						<?php echo $this->entry_model->fill_options("person", "name");?>
        				</datalist></label>
    				<label>Date Reported:<input name="date_reported" id="date_reported" type="date" required></label> 
    				<label>Time Reported:<input name="time_reported" id="time_reported" type="time" required></label> 
    				<label>Reported By:<input name="reported_by" id="reported_by" type="text" required></label>
    				<!--  Add or Search Case -->
    				<button id="case-info-add-button" class="btn" type="submit"/>Add</button>
    		</form>
		<hr/>
		<div id="data-entry-forms" class='inner_tabs'>
			<a href="<?php echo URL; ?>DataEntry/data_entry/cause_manner" id='data_entry_cause_manner' onclick='set_current_inner_tab(this.id);'>Cause/Manner</a>
			<a href="<?php echo URL; ?>DataEntry/data_entry/cremation_view" id='data_entry_cremation_view' onclick='set_current_inner_tab(this.id);'>Cremation View</a> 
			<a href="<?php echo URL; ?>DataEntry/data_entry/disinterment_release" id='data_entry_disinterment_release' onclick='set_current_inner_tab(this.id);'>Disinterment Release</a> 
			<a href="<?php echo URL; ?>DataEntry/data_entry/document_tracking" id='data_entry_document_tracking' onclick='set_current_inner_tab(this.id);'>Document Tracking</a>
			<a href="<?php echo URL; ?>DataEntry/data_entry/embalm_permit" id='data_entry_embalm_permit' onclick='set_current_inner_tab(this.id);'>Embalm Permit</a> 
			<a href="<?php echo URL; ?>DataEntry/data_entry/evidence" id='data_entry_evidence' onclick='set_current_inner_tab(this.id);'>Evidence</a>
			<a href="<?php echo URL; ?>DataEntry/data_entry/inv_form" id='data_entry_inv_form' onclick='set_current_inner_tab(this.id);'>Investigative Form</a> 
			<a href="<?php echo URL; ?>DataEntry/data_entry/medication_inventory" id='data_entry_medication_inventory' onclick='set_current_inner_tab(this.id);'>Medication Inventory</a> 
			<a href="<?php echo URL; ?>DataEntry/data_entry/narrative" id='data_entry_narrative' onclick='set_current_inner_tab(this.id);'>Narrative</a>
		</div>
		<hr />
	</div>
	</div>