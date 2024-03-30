<!-- view/data_entry/document_tracking.php -->
<body onload='check_table("data_entry_document_tracking");'>
	<div class="container">
		<div id="document-tracking-page" class="col-sm-10">
		 <?php
		 if (isset($_POST['case_number']) && $_SESSION['curr_total_docs'] != null) {
                for ($i = 1; $i <= $_SESSION['curr_total_docs']; $i ++) {
                    if (isset($_POST['doc_title' . $i]) || isset($_POST['event_date' . $i]) 
                        || isset($_POST['status_options' . $i]) || isset($_POST['party_name' . $i]) 
                        || isset($_POST['party_relation' . $i]) || isset($_POST['party_address' . $i]) 
                        || isset($_POST['party_phone' . $i]) || isset($_POST['party_fax' . $i]) 
                        || isset($_POST['party_email' . $i]) || isset($_POST['AUT' . $i]) 
                        || isset($_POST['TOX' . $i]) || isset($_POST['COD' . $i]) 
                        || isset($_POST['PHOTOS' . $i]) || isset($_POST['IR' . $i]) 
                        || isset($_POST['CHARGES' . $i]) || isset($_POST['PAID' . $i]) 
                        || isset($_POST['notes' . $i])) {
                                $case_number = $_POST['case_number'];
                                $column1 = $i;
                                $column2 = $_POST['doc_title' . $i];
                                $column3 = $_POST['event_date' . $i];
                                $column4 = $_POST['status_options' . $i];
                                $column5 = $_POST['party_name' . $i];
                                $column6 = $_POST['party_relation' . $i];
                                $column7 = $_POST['party_address' . $i];
                                $column8 = $_POST['party_phone' . $i];
                                $column9 = $_POST['party_fax' . $i];
                                $column10 = $_POST['party_email' . $i];
                                $column11 = isset($_POST['AUT' . $i]);
                                $column12 = isset($_POST['TOX' . $i]);
                                $column13 = isset($_POST['COD' . $i]);
                                $column14 = isset($_POST['PHOTOS' . $i]);
                                $column15 = isset($_POST['IR' . $i]);
                                $column16 = isset($_POST['CHARGES' . $i]);
                                $column17 = isset($_POST['PAID' . $i]);
                                $column18 = $_POST['notes' . $i];
                                $column_arr = [
                                    "doc_num" => $column1,
                                    "doc_title" => $column2,
                                    "event_date" => $column3,
                                    "status_options" => $column4,
                                    "party_name" => $column5,
                                    "party_relation" => $column6,
                                    "party_address" => $column7,
                                    "party_phone" => $column8,
                                    "party_fax" => $column9,
                                    "party_email" => $column10,
                                    "AUT" => $column11,
                                    "TOX" => $column12,
                                    "COD" => $column13,
                                    "PHOTOS" => $column14,
                                    "IR" => $column15,
                                    "CHARGES" => $column16,
                                    "PAID" => $column17,
                                    "notes" => $column18
                                ];
                                $this->entry_model->insert_changing_db('data_entry_document_tracking', $case_number, $column_arr);
                    }
                }
            }
            ?>
			<form action="" method="POST" id="form">
        		<div id="bottom-buttons">
            		<!-- Save to database -->
            		<button type="submit" id="save-button" class="btn"><b>Save Record</b></button>
        		</div>
        	
    			<h2 name="title"><b>Document Tracking</b></h2>
    			<input id='table_name' name='table_name' value='data_entry_document_tracking' type='hidden'></>
    			<hr />
    			<label>Case #:<input name="case_number" id="case_number" class="case-input"
    					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000" onkeyup="get_form_details(this.value, 'data_entry_document_tracking')" required></label> 
    			<hr/>
    			
    			<!-- div JS interacts with to fill -->
    			<div class="document-tracking-table">
    				<div id="new_doc"></div>
                    <input type="hidden" value="0" id="total_docs">
    			</div>
            </form>
            <div id="bottom-buttons">
                    <button class="add-doc-track-button"><i class="fa-solid fa-plus fa-lg"></i></button>
                </div>
		</div>
	</div>