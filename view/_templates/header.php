<!DOCTYPE html>
<html lang="en">
<head class="head">
    <meta charset="utf-8">
    <title>Medical Examiner</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- JS -->
<!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
<!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

<!-- CSS -->
<!-- MY CSS Sheet -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css"
	integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css"
	integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://kit.fontawesome.com/a5a01e0e99.js" crossorigin="anonymous"></script>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10" id="time_nav">
		<button onclick="topFunction()" id="top_button" class='btn' title="TOP"><i class="fa-solid fa-arrows-up-to-line"></i></button>
			<div class="title"><h1>Jefferson County Medical Examiner's Office</h1></div>
			<div id="time"></div><script id="time-top"> 
				var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'};
				var datetime = new Date().toLocaleDateString("en-US", options); 
            	document.getElementById("time").textContent = datetime;</script>
        	 <div class="navigation">
        	 	<a href="<?php echo URL; ?>Home" id='home_tab' onclick='set_current_tab(this.id);'>Home</a>
           	 	<a href="<?php echo URL; ?>DataEntry" id='data_entry_tab' onclick='set_current_tab(this.id);'>Data Entry</a>
           	 	<!-- Dropdown Reports -->
                <div class="dropdown3">
           	 	<button class="dropbtn3" onclick="show_dropdown('3')" id='reports_tab'>Reports <i class="fa fa-caret-down"></i>
           	 	</button>
           	 		<div class="dropdown-content3" id="myDropdown3">
                         <a href="<?php echo URL; ?>Reports/report/pinned_reports" onclick='set_current_tab("reports_tab");'><i class="fa-solid fa-thumbtack"></i> Pinned Reports</a>
                         <a href="<?php echo URL; ?>Reports/report/annual_report" onclick='set_current_tab("reports_tab");'>Annual Report</a>
           	 			 <a href="<?php echo URL; ?>Reports/index" onclick='set_current_tab("reports_tab");'>Create Report</a>
           	 		</div>
           	 	</div>
           	 	<!-- Dropdown Maintenance -->
                <div class="dropdown1">
           	 	<button class="dropbtn1" onclick="show_dropdown('1')" id='maintenance_tab'>Maintenance <i class="fa fa-caret-down"></i>
           	 	</button>
           	 		<div class="dropdown-content1" id="myDropdown1">
           	 			 <a href="<?php echo URL; ?>Maintenance/table/citystatezip" onclick='set_current_tab("maintenance_tab");'>City, State Zip</a>
                         <a href="<?php echo URL; ?>Maintenance/table/crematory" onclick='set_current_tab("maintenance_tab");'>Crematory</a>
                         <a href="<?php echo URL; ?>Maintenance/table/deputy" onclick='set_current_tab("maintenance_tab");'>Deputy</a>
                         <!--  <a href="Maintenance/table/donor_agency">Donor Agency</a>-->
                         <a href="<?php echo URL; ?>Maintenance/table/facility" onclick='set_current_tab("maintenance_tab");'>Facility</a>
                         <!--  <a href="Maintenance/table/funeral_director">Funeral Director</a> -->
                         <a href="<?php echo URL; ?>Maintenance/table/funeral_home" onclick='set_current_tab("maintenance_tab");'>Funeral Home</a>
                         <a href="<?php echo URL; ?>Maintenance/table/person" onclick='set_current_tab("maintenance_tab");'>Person</a>
                         <a href="<?php echo URL; ?>Maintenance/table/physician" onclick='set_current_tab("maintenance_tab");'>Physician</a>
                         <a href="<?php echo URL; ?>Maintenance/table/websites" onclick='set_current_tab("maintenance_tab");'>Websites</a>
                         <a href="<?php echo URL; ?>Maintenance/table/wisconsin_counties" onclick='set_current_tab("maintenance_tab");'>Wisconsin Counties</a>
           	 		</div>
           	 	</div>
           	 	<!-- Dropdown Websites -->
                <div class="dropdown2">
           	 	<button class="dropbtn2" onclick="websites()" id='websites_tab' onclick='set_current_tab(this.id);'>Websites <i class="fa fa-caret-down"></i>
           	 	</button>
           	 		<div class="dropdown-content2" id="myDropdown2">
           	 		</div>
           	 	</div>
           	 	<a href="<?php echo URL; ?>Forms" id='forms_tab' onclick='set_current_tab(this.id);'>Forms</a>
           	 	<a href="<?php echo URL; ?>FAQS" id='faqs_tab' onclick='set_current_tab(this.id);'><i class="fa-solid fa-person-circle-question fa-xl"></i></a>
				<button type="button" class='btn' onclick="reset_page();"><i class="fa-solid fa-rotate"></i></button>
           	</div>
		</div>
	</div>
</div>
</head>