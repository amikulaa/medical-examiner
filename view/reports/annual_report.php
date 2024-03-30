<!-- view/reports/annual_reports.php -->
<!-- This page has specific querires requested by JeffCo ME -->
<body>
	<div class="container">
		<div class="col-sm-10">
		<div id="error_message_div">
				<input id="error_message" disabled>
			</div>
	           <div id="bottom-buttons">
                    <form id="printForm" name='printForm' method="POST" action='<?php echo URL;?>Reports/print_table' target='_blank'>
                        	<input id='table_html' name='table_html' type='hidden' value='unchanged'></input>
                        	<input id='table_html_name' name='table_html_name' type='hidden' value='unchanged'></input>
                        	<button name="print_table_button" id="print_table_button" class="btn" value='Annual'><b><i class="fa fa-solid fa-print"></i></b></button>
                    </form>
                </div>
        <h2 name="title"><b>Annual Report</b></h2>
		<hr/>
		<!-- Call to fill database -->
    	<div id='tables'><?php echo $this->entry_model->get_report();?></div>
	</div>
	</div>