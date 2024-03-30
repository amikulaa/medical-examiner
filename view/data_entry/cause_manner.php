<!-- view/data_entry/cause_manner.php -->
<body onload='check_table("data_entry_cause_manner");'>
	<div class="container">
        <div id="cause-manner-page" class="col-sm-10">
        <?php  if(isset($_POST['case_number']) && (isset($_POST['first_name']) || isset($_POST['last_name']) 
                || isset($_POST['medical_certifier']) || isset($_POST['signed_date']) 
                || isset($_POST['manner_of_death']) || isset($_POST['cause_of_death']) 
                || isset($_POST['due_to']) || isset($_POST['cause_of_death_other']))){
            	           $case_number = $_POST['case_number'];
            	           $column1 = $_POST['first_name'];
            	           $column2 = $_POST['last_name'];
            	           $column3 = $_POST['medical_certifier'];
            	           $column4 = $_POST['signed_date'];
            	           $column5 = $_POST['manner_of_death'];
            	           $column6 = $_POST['cause_of_death'];
            	           $column7 = $_POST['due_to'];
            	           $column8 = $_POST['cause_of_death_other'];
            	           $column_arr = [
            	               "first_name" => $column1,
            	               "last_name" => $column2,
            	               "medical_certifier" => $column3,
            	               "signed_date" => $column4,
            	               "manner_of_death" => $column5,
            	               "cause_of_death" => $column6,
            	               "due_to" => $column7,
            	               "cause_of_death_other" => $column8
            	           ];
            	           $this->entry_model->insert_db('data_entry_cause_manner', $case_number, $column_arr);
                    } 
                ?>
	           	<div id="bottom-buttons">
    	           	<form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>DataEntry/print_page' target='_blank'>
                    	<input id='case_number_hide' name='case_number_hide' type='hidden' value='unchanged'></input>
                    	<input id='table_name_hide' name='table_name_hide' type='hidden' value='unchanged table'></input>
                    	<button name="print_button" id="print_button" class="btn" value='cause_manner'><b><i class="fa fa-solid fa-print"></i></b></button>
                    </form></div>
                <div id="bottom-buttons">
                	<form action="" method="POST" id="form" class='form'>
                    	<!-- Save to database -->
                    	<button name="save_button" id="save_button" class="btn" type="submit"><b>Save Record</b></button>
        		</div>
        		<h2 name="title"><b>Cause/Manner</b></h2>
        		<input id='table_name' name='table_name' value='data_entry_cause_manner' type='hidden'></>
    			<hr/>
    			<!-- Cause and Manner of Death Information -->
    				<h3 id="form-section-header"><b>Cause and Manner of Death Information</b></h3>
    				<label>Case #:<input name="case_number" id="case_number" class="case-input"
    					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000" 
    					onkeyup="get_form_details(this.value, 'data_entry_cause_manner')" required></label>
    				<row><label>First Name:<input id="first_name" name="first_name" type="text" placeholder='first name mi' ></label>
    				<label>Last Name:<input id="last_name" name="last_name" type="text" placeholder='last name'></label></row>
        			<row><label>Medical Certifier:<input id="medical_certifier" name="medical_certifier" class="long-input"
        				list="physician-options" placeholder="select or input" /> 
        				<datalist id="physician-options" name="physician-options">
                				<?php echo $this->entry_model->fill_options("physician", "name");?>
                		</datalist></label></row>
        			<row><label>Date Certificate Signed:<input id="signed_date" name="signed_date" type="date" ></label></row>
        			<row><label>Manner of Death:<select id="manner_of_death" name="manner_of_death">
        						<?php echo $this->entry_model->fill_options("manner_of_death", "name");?>
        			</select></label> </row>
        			<row><label>Cause of Death: <input id="cause_of_death" name="cause_of_death" class="long-input"></input></label></row>
        			<row><label>Due To: <input id="due_to" name="due_to" class="long-input"></input></label></row>
        			
        			<row><label>Other Significant Conditions: <input id="cause_of_death_other" name="cause_of_death_other" class="long-input" ></input></label></row>
        			<hr />
    		</form>
		</div>
	</div>