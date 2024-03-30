<!-- view/data_entry/narrative.php -->
<body onload='check_table("data_entry_narrative");'>
    <div class="container">
        <div id="narrative-form" class="col-sm-10">
        <?php 
        if (isset($_POST['case_number']) && $_SESSION['curr_total_forms'] != null) {
                for ($i = 1; $i <= $_SESSION['curr_total_forms']; $i ++) {
                    if (isset($_POST['supp_report'.$i])) {
                        $case_number = $_POST['case_number'];
                        $column1 = $i;
                        $column2 = $_POST['supp_report' . $i];
                        $column_arr = [
                            "doc_num" => $column1,
                            "supp_text" => $column2
                        ];
                        $this->entry_model->insert_changing_db('data_entry_supp_report', $case_number, $column_arr);
                    } 
                }
            } 
            if (isset($_POST['case_number']) && isset($_POST['narrative'])) {
                $case_number = $_POST['case_number'];
                $column_arr = ["narrative" => $_POST['narrative']];
                $this->entry_model->insert_db('data_entry_narrative', $case_number, $column_arr);
            } 
        ?>
        <div id="bottom-buttons">
            <form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>DataEntry/print_page' target='_blank'>
                   <input id='case_number_hide' name='case_number_hide' type='hidden' value='unchanged'></input>
                   <input id='table_name_hide' name='table_name_hide' type='hidden' value='unchanged table'></input>
                   <button name="print_button" id="print_button" class="btn" value='narrative'><b><i class="fa fa-solid fa-print"></i></b></button>
            </form>
        </div>
        <form action="" method="POST" id="form" class='form'>
        	<div id="bottom-buttons">
                <!-- Save to database -->
                <button name="save_button" id="save_button" class="btn" type="submit"><b>Save Record</b></button>
        	</div>
    		<h2><b>Narrative</b></h2>
    		<input id='table_name' name='table_name' value='data_entry_narrative' type='hidden'></>
			<hr/>
        	<label>Case #:<input name="case_number" id="case_number" class="case-input"
					type="text" pattern="[0-9]{2}-[0-9]{3,4}" placeholder="00-000"
					onkeyup="get_form_details(this.value, 'data_entry_narrative')" required>
			</label> 
        	<div class="comment-container">
					<h3 id="form-section-header"><b>Narrative</b></h3>
					<textarea name="narrative" id="narrative" rows="10"></textarea>
			</div>
        	<hr/>
        	<h3 id='form-section-header'><b>Supplemental Report</b></h3>
        	 <!-- div JS interacts with to fill -->
    		<div id="new_form"></div>
            <input type="hidden" value="0" id="total_forms">
        </form>
        <div id="bottom-buttons">
               <button class="add-supp-report" id='add-supp-report'><i class="fa-solid fa-plus fa-lg"></i></button>
        </div>
       </div>
    </div>