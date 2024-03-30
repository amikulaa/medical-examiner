<!-- view/data_entry/medication_inventory.php -->
<body onload='check_table("data_entry_medication_inventory");'>
	<div class="container">
		<div id="medication-inventory-page" class="col-sm-10">
			<?php  if(isset($_POST['case_number']) && $_SESSION['curr_total_meds'] != null){
			    for($i = 1; $i <= $_SESSION['curr_total_meds']; $i++){
    		         if(isset($_POST['inventory_date'.$i])
    		             || isset($_POST['inventory_by'.$i])
    		             || isset($_POST['collected_by'.$i])
    		             || isset($_POST['medication_name'.$i])
    		             || isset($_POST['perscription_num'.$i])
    		             || isset($_POST['perscriber_num'.$i])
    		             || isset($_POST['pharmacy_name'.$i])
    		             || isset($_POST['directions'.$i])
    		             || isset($_POST['medication_notes'.$i])){
        		             $case_number = $_POST['case_number'];
        		             $column1 = $i;
        		             $column2 = $_POST['inventory_date'.$i];
        		             $column3 = $_POST['inventory_by'.$i];
        		             $column4 = $_POST['inventory_by'.$i];
        		             $column5 = $_POST['medication_name'.$i];
        		             $column6 = $_POST['perscription_num'.$i];
        		             $column7 = $_POST['perscriber_num'.$i];
        		             $column8 = $_POST['pharmacy_name'.$i];
        		             $column9 = $_POST['directions'.$i];
        		             $column10 = $_POST['medication_notes'.$i];
        		             $column_arr = [
        		                 "doc_num" => $column1,
        		                 "inventory_date" => $column2,
        		                 "inventory_by" => $column3,
        		                 "collected_by" => $column4,
        		                 "medication_name" => $column5,
        		                 "perscription_num" => $column6,
        		                 "perscriber_num" => $column7,
        		                 "pharmacy_name" => $column8,
        		                 "directions" => $column9,
        		                 "medication_notes" => $column10
        		             ];
        		             
    		                 $this->entry_model->insert_changing_db('data_entry_medication_inventory', $case_number, $column_arr);
    		         }
    		       }
                }     
	       ?>	
			<form action="" method="POST" id="form">
        		<!-- Save to database -->
        		<div id='bottom-buttons'>
            		<button type="submit" id="save-button" class="btn"><b>Save Record</b></button>
        		</div>
        	
			<h2><b>Medication Inventory</b></h2>
			<input id='table_name' name='table_name' value='data_entry_medication_inventory' type='hidden'></>
			<hr />
			<label>Case #:<input name="case_number" id="case_number" class="case-input"
    					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000" onkeyup="get_form_details(this.value, 'data_entry_medication_inventory')" required></label>
			<hr/>
				
			<div class="document-tracking-table">
				<div id="new_med"></div>
                <input type="hidden" value="0" id="total_meds">
			</div>
			
			</form>
			<div id="bottom-buttons">
                 <button class="add-med-button"><i class="fa-solid fa-plus fa-lg"></i></button>
            </div>
		</div>
	</div>