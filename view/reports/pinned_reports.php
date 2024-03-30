<!-- view/reports/pinned_reorts.php -->
<!-- This page has specific querires requested by JeffCo ME -->
<body>
	<div class="container">
		<div class="col-sm-10">
			<div id="error_message_div">
				<input id="error_message" disabled>
			</div>
			<h2 name="title">
				<b>Pinned Reports</b>
			</h2>
			<hr />
			<!-- Records Requested -->
			<div id='tables'>
				<h6>1. Requested Document Tracking</h6>
				<?php echo $this->entry_model->get_requested_records();?>
			</div>
			<hr />
			<!-- Searching 3 inputs for cause manner -->
			<form method="POST" id='cause_manner_pinned_container'>
				<div id='cause_manner_pinned_report'>
				<h6>2. Search Cause/Due/Other</h6>
					<input id='search_cause_manner_text' name='search_cause_manner_text' type='text' placeholder='Search' 
						value="<?php if(isset($_POST['search_cause_manner_text'])){echo $_POST['search_cause_manner_text'];}?>" required>
					<button id='search_cause_manner_button' name='search_cause_manner_button' class='btn'>Search</button>
					<div id='cause_manner_table' name='cause_manner_table'></div>
				</div>
			</form>
			<hr />
		</div>
	</div>