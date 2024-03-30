<!-- view/data_entry/embalm_permit.php -->
 <body onload='check_table("data_entry_embalm_permit");'>
	<div class="container-fluid">
        <div id="embalm-permit-form" class="col-sm-10">
        <?php  if(isset($_POST['case_number']) && 
    		          (isset($_POST['first_mi_name']) || isset($_POST['last_name']) 
    		            || isset($_POST['full_address']) || isset($_POST['pronounced_citystatezip']) 
			            || isset($_POST['pronounced_county']) || isset($_POST['pronounced_physician']) 
    		            || isset($_POST['date_of_death']) || isset($_POST['time_of_death']) 
            	        || isset($_POST['sign_dc_physician']) || isset($_POST['embalm_date']) 
    		            || isset($_POST['embalm_recieved_by']))){
            	           $case_number = $_POST['case_number'];
            	           $column1 = $_POST['first_mi_name'];
            	           $column2 = $_POST['last_name'];
            	           $column3 = $_POST['full_address'];
            	           $column4 = $_POST['pronounced_citystatezip'];
            	           $column5 = $_POST['pronounced_county'];
            	           $column6 = $_POST['pronounced_physician'];
            	           $column7 = $_POST['date_of_death'];
            	           $column8 = $_POST['time_of_death'];
            	           $column9 = $_POST['sign_dc_physician'];
            	           $column10 = $_POST['embalm_date'];
            	           $column11 = $_POST['embalm_recieved_by'];
            	           $column_arr = [
            	               "first_mi_name" => $column1,
            	               "last_name" => $column2,
            	               "full_address" => $column3,
            	               "pronounced_citystatezip" => $column4,
            	               "pronounced_county" => $column5,
            	               "pronounced_physician" => $column6,
            	               "date_of_death" => $column7,
            	               "time_of_death" => $column8,
            	               "sign_dc_physician" => $column9,
            	               "embalm_date" => $column10,
            	               "embalm_recieved_by" => $column11
            	           ];
            	           
            	           $this->entry_model->insert_db('data_entry_embalm_permit', $case_number, $column_arr);
            		  }  
            		  ?>
	        <div id="bottom-buttons">
    	        <form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>DataEntry/print_page' target='_blank'>
                    	<input id='case_number_hide' name='case_number_hide' type='hidden' value='unchanged'></input>
                    	<input id='table_name_hide' name='table_name_hide' type='hidden' value='unchanged table'></input>
                    	<button name="print_button" id="print_button" class="btn" value='embalm_permit'><b><i class="fa fa-solid fa-print"></i></b></button>
                </form></div>
            <div id="bottom-buttons">
                <form action="" method="POST" id="form" class='form'>
                     <!-- Save to database -->
                    <button name="save_button" id="save_button" class="btn" type="submit"><b>Save Record</b></button>
        	</div>
    		<h2 name="title"><b>Embalm Permit</b></h2>
    		<input id='table_name' name='table_name' value='data_entry_embalm_permit' type='hidden'></>
			<hr/>
    		<label>Case #:<input name="case_number" id="case_number" class="case-input"
					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000"
					onkeyup="get_form_details(this.value, 'data_entry_embalm_permit')" required></label> 
    			<h4><b>Embalm Permit</b></h4>
    			<h3><b>Office of the Medical Examiner</b></h3>
    			<h3><b>Jefferson County</b></h3>
    			<h3>311 S. Center Ave.</h3>
    			<h3>Jefferson, WI 53549</h3>
    			<h3>Phone:(920) 674-7119</h3>
    			<h3>Fax:(920) 674-7602</h3>
    		<hr/>
    				
    		<!-- Embalm Permit Form -->
    		<row><label>Decedent Full Name:<input name="first_mi_name" id="first_mi_name" type="text" placeholder='first name mi'><input name="last_name" id="last_name" type="text" placeholder='last name mi'></label></row>
			<row><label>Decedent Address:<input name="full_address" id="full_address" class="long-input" type="text"></label></row>
			<label>Municipality of Death:<input name="pronounced_citystatezip" id="pronounced_citystatezip" class="medium-input" list="citystatezip" 
				placeholder="select or input" /> <datalist id="citystatezip" >
					<?php echo $this->entry_model->fill_options("citystatezip", "name");?>
				</datalist></label> 
			<label>County:<input name="pronounced_county" id="pronounced_county" list="wisconsin_counties" 
				placeholder="select or input" /> <datalist id="wisconsin_counties" >
					<?php echo $this->entry_model->fill_options("wisconsin_counties" , "name");?>
				</datalist></label> </row>
    		<label>Pronounced By: <input name="pronounced_physician" id="pronounced_physician" class="long-input" list="physician-options" 
				placeholder="select or input" /> <datalist id="physician-options" >
					<?php echo $this->entry_model->fill_options("physician", "name");?>
				</datalist></label> 
			<row><label>Date Pronounced:<input name="date_of_death" id="date_of_death" type="date"></label>
			<label>Time Pronounced:<input name="time_of_death" id="time_of_death" type="time"></label></row>	
			<row><label>Death Certificate to be Signed by: <input name="sign_dc_physician" id="sign_dc_physician" class="long-input" list="physician-options" 
				placeholder="select or input" /> <datalist id="physician-options" >
					<?php echo $this->entry_model->fill_options("physician", "name");?>
				</datalist></label> </row>
			<hr/>
					
			<!-- Permission to Embalm -->
			<h3 id="form-section-header"><b>Permission to Embalm</b></h3>
    		<h5><b>To Funeral Director, Embalmer, or Person Acting as Such: </b></h5>
    		<h5> This constitutes the release by section 979.01 (4) of Wisconsin 
    			statutes and certifies that all necessary evidence has been removed from the above-named person 
    			and the body may now be embalmed, buried, or otherwise disposed of. This certificate does not 
    			override the wishes of the next of kin regarding embalming or final disposition of the deceased.
    			Cremation will require further authorization.</h5>
    		<br>
    		<br>
    		<label>Date Pronounced:<input name="embalm_date" id="embalm_date" type="date"></label>
    		<label>Signature of Medical Examinar or Deputy:<input class="hide-me" disabled></label>
    		<label>Recieved By: <input name="embalm_recieved_by" id="embalm_recieved_by" type="text"></label>
    		 <hr />
    		</form> 
		</div>
	</div>
 