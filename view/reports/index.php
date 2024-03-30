<!-- view/reports/index.php -->
<!-- This page creates the reports in the reports tab -->
<body>
	<div class="container">
		<div class="col-sm-10">
			<div id="error_message_div">
				<input id="error_message" disabled>
			</div>
			<hr />
			<div id="tables">
    			<?php 
    			if($_SESSION['curr_total_filters'] == null){
    			    $_SESSION['curr_total_filters'] = 0;
    			}
    			if (isset($_POST['report_table']) && isset($_POST['search-report-button'])) {
        			    $filter_arr = [];
        			    $index = 0;
        			    for ($i = 1; $i <= $_SESSION['curr_total_filters']; $i ++) {
        			        if(isset($_POST['input_name' . $i]) && isset($_POST['filter_type' . $i]) && isset($_POST['filter_text' . $i])){
        			            $input_name = $_POST['input_name' . $i];
        			            $filter_type = $_POST['filter_type' . $i];
        			            $filter_text = $_POST['filter_text' . $i];
        			            
        			            $filter_arr[$index] = [$input_name, $filter_type, $filter_text];
        			            $index += 1;
        			        }
        			    }
        			    $table_name = $_POST['report_table'];
        			    $start_date = $_POST['start_case_date_reported'];
        			    $end_date = $_POST['end_case_date_reported'];
        			    $start_age = $_POST['start_age'];
        			    $end_age = $_POST['end_age'];
        			    $is_separate = isset($_POST['seperate_filters_checkbox']) ? 1 : 0;
        			    
        			    echo $this->entry_model->reports_search($table_name, $filter_arr, $start_date, $end_date, $start_age, $end_age, $is_separate);
        			}
    			?>
			</div>
			<div id="bottom-buttons">
                <form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>Reports/print_table' target='_blank'>
                    <input id='table_html' name='table_html' type='hidden' value='unchanged'></input>
                    <input id='table_html_name' name='table_html_name' type='hidden' value='unchanged'></input>
                    <button name="print_table_button" id="print_table_button" class="btn" value='Filter'><b><i class="fa fa-solid fa-print"></i></b></button>
               </form>
            </div>
			<form method="POST" id="form">
				<!-- div JS interacts with to fill -->
				<div class="reports_filters">
				<div id="bottom-buttons">
					<!-- Save to database -->
					<label><input name="seperate_filters_checkbox" id="seperate_filters_checkbox" type="checkbox"><i class="fa fa-regular fa-object-ungroup fa-lg"></i></input></label>
					<button type="submit" id="search-report-button" name='search-report-button' class="btn"><b>Create Report</b></button>
				</div>
                <div id='base_case_info'>
    				<row><label>Start Date Reported:<input name="start_case_date_reported" id="case_date_reported" type="date" value="<?php $this->keep_input_filter_set("start_case_date_reported")?>">&mdash;</label> 
    				<label>End Date Reported:<input name="end_case_date_reported" id="case_date_reported" type="date" value="<?php $this->keep_input_filter_set("end_case_date_reported")?>"></label> </row>
    				</br>
    				<row><label>Start Age Noninfant:<input name="start_age" id="start_age" type="number" min='1' max='125' value="<?php $this->keep_input_filter_set("start_age")?>">&mdash;</label> 
    				<label>End Age Noninfant:<input name="end_age" id="end_age" type="number" min='1' max='125' value="<?php $this->keep_input_filter_set("end_age")?>"></label> </row>
                </div>
				<div id="table_type_report_container">
						<table class='tb' id='table_type_report'>
							<thead></thead>
							<tbody><tr><td>
								<label>REPORT TABLE<select id='report_table' name='report_table' value='' onchange='get_input_fields(1)' required>
									<option value='' selected disabled hidden>Select</option>
									<option value='data_entry_case'>Base Case</option>
									<option value='data_entry_cause_manner'>Cause/Manner</option>
									<option value='data_entry_cremation_view'>Cremation View</option> 
									<option value='data_entry_disinterment_release'>Disinterment Release</option> 
									<option value='data_entry_document_tracking'>Document Tracking</option> 
									<option value='data_entry_embalm_permit'>Embalm Permit</option> 
									<option value='data_entry_inv_form'>Inv Form</option></select></label>
							</td></tr></tbody>
						</table>
					</div>
					<div id="new_filter"></div>
					<input type="hidden" value="0" id="total_filters">
				</div>
				<div id="bottom-buttons">
            		<button class="add-filter-button" type='button'>
            			<i class="fa-solid fa-plus fa-lg"></i>
            		</button>
    			</div>
			</form>
		</div>
	</div>