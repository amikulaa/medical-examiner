<!-- view/forms/index.php -->
<body>
	<div class="container">
		<!-- Forms -->
    	<div id="blank-forms-select" class="col-sm-10">
    	<div id="error_message_div"><input id="error_message" disabled></div>
			<hr/>
			<form method='POST' action='<?php echo URL;?>Forms/blank_form' target='_blank'>
    			<label><b>Select Blank Report:</b> <select name="report_type" id='report_type' required>
    					<option value="" selected disabled>Select</option>
    					<option value="cause_manner">Cause/Manner</option>
    					<option value="disinterment_release">Disinterment Release</option>
    					<option value="embalm_permit">Embalm Permit</option>
    					<option value="inv_form">Inv Form</option>
    					<option value="narrative">Narrative</option>
    					<option value="supp_report">Supplemental Report</option>
    			</select>
    			<input id='report_type_hidden' name='report_type_hidden' type='hidden' value='unchanged'></input>
    			<button type="submit" id="form-print" name="form-print" class="btn"><b><i class="fa fa-print pull-left"></i> Print</b></button></label>
			</form>
			<hr/>
		</div>
	</div>	