<!-- view/data_entry/evidence.php -->
<body onload='check_table("data_entry_evidence");'>
	<div class="container-fluid">
		<div id="evidence-page" class="col-sm-10">
		<?php
		if (isset($_POST['case_number']) && $_SESSION['curr_total_items'] != null) {
                for ($i = 1; $i <= $_SESSION['curr_total_items']; $i ++) {
                    if (isset($_POST['item_text' . $i])) {
                        $case_number = $_POST['case_number'];
                        $column1 = $i;
                        $column2 = $_POST['item_text' . $i];
                        $column3 = $_POST['item_notes' . $i];
                        $column_arr = [
                            "doc_num" => $column1,
                            "item_text" => $column2,
                            "item_notes" => $column3
                        ];
                        $this->entry_model->insert_changing_db('data_entry_evidence', $case_number, $column_arr);
                    }
                }
            }
        ?>	
	     <form action="" method="POST" id="form">
				<div id="bottom-buttons">
					<!-- Save to database -->
					<button type="submit" id="save-button" class="btn" onsubmit="#">
						<b>Save Record</b>
					</button>
				</div>
				<h2 name="title"><b>Evidence</b></h2>
				<input id='table_name' name='table_name' value='data_entry_evidence' type='hidden'></>
				<hr />
				<label>Case #:<input name="case_number" id="case_number"
					class="case-input" type="text" pattern="[0-9]{2}-[0-9]{3,4}"
					placeholder="00-000"
					onkeyup="get_form_details(this.value, 'data_entry_evidence')"
					required></label>
				<hr />
			<div class="document-tracking-table">
				<div id="new_evidence"></div>
				<input type="hidden" value="0" id="total_items">
			</div>
			
			</form>
			<div id="bottom-buttons">
				<button class="add-evidence-button"><i class="fa-solid fa-plus fa-lg"></i></button>
			</div>
		</div>
	</div>
