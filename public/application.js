/** MEDICAL EXAMINER APPLICATION.JS */
/* Scroll to top button */
let top_button = document.getElementById("top_button");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    top_button.style.display = "block";
  } else {
    top_button.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

/* Header Dropdowns for Maintenance and Websties */
function show_dropdown(num) {
	document.getElementById("myDropdown" + num).classList.toggle("show" + num);
}

// Grab case number value on current document
function get_case_number(){
	return document.getElementById('case_number').value;
}

/* Reports user options */
function show_add_row(){
	document.getElementById("add_row_container").style.display = "inline-block";
}

/* Reports user options */
function show_update_row(){
	document.getElementById("update_row_container").style.display = "block";
}

/* Reports user options */
function show_delete_row(){
	document.getElementById("delete_row_container").style.display = "block";
}

/* FAQ Slideshow */
let slideIndex = [1, 1, 1, 1, 1];
let slideId = ["mySlides1", "mySlides2", "mySlides3", "mySlides4","mySlides5"];

/* (slide to show, slide id) */
function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

/* (slide to show, slide id) */
function showSlides(n, no) {
  let i;
  let x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {
	  slideIndex[no] = 1
	}    
  if (n < 1) {
	  slideIndex[no] = x.length
	}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}

/* Clear ALL tables from specified view */
function clear_page(total_name, new_name){
	// clear previously drawn tables 
	for(var i = $('#total_' + total_name).val(); i > 0; i--){
			$('#new_' + new_name + i).remove();
			$('#total_' + total_name).val(i - 1);
	}
}

/* Clear SPECIFIED (num) table from specified view */
function remove_input(num, total_name, new_name){
	var last_num = $('#total_' + total_name).val();

	if (num >= 1) {
		$('#new_' + new_name + num).remove()
		$('#total_' + total_name).val(last_num - 1);
	}
}

/* Makes sure that if an input is undefined or null, it is not showing that, just showing nothing*/
function set_value(curr_value){
	if(curr_value != null){
		return curr_value;
	} else {
		return "";
	}
}

// onclick anywhere in window, if not equal to this parent object, close the child object(s)
window.onclick = function(event) {
	if (!event.target.matches('.dropbtn1')) {
		var dropdowns = document.getElementsByClassName("dropdown-content1");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show1')) {
				openDropdown.classList.remove('show1');
			}
		}
	}
	if (!event.target.matches('.dropbtn2')) {
		var dropdowns = document.getElementsByClassName("dropdown-content2");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show2')) {
				openDropdown.classList.remove('show2');
			}
		}
	}
	if (!event.target.matches('.dropbtn3')) {
		var dropdowns = document.getElementsByClassName("dropdown-content3");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show3')) {
				openDropdown.classList.remove('show3');
			}
		}
	}
	if (!event.target.matches('#open_add') &&  !event.target.matches('#add_row_value')
		&& !event.target.matches('#add_row_button') && !event.target.matches('#add_row_value2')
		&& !event.target.matches('#add_row_value3') && !event.target.matches('#add_row_value4')
		&& !event.target.matches('#add_row_value5')) {
			try{
				document.getElementById("add_row_container").style.display = "none";
				document.getElementById("open_add").style.background = "transparent";
			} catch (error){
			}
	} else {
		document.getElementById("open_add").style.background = "#ffffff"; 
	}
	
	if (!event.target.matches('#open_update') &&  !event.target.matches('#update_row_id')
		&& !event.target.matches('#update_row_value') && !event.target.matches('#update_row_button')
		&& !event.target.matches('#update_row_value2') && !event.target.matches('#update_row_value3')
		&& !event.target.matches('#update_row_value4') && !event.target.matches('#update_row_value5')) {
			try{
				document.getElementById("update_row_container").style.display = "none";
				document.getElementById("open_update").style.background = "transparent";
			} catch (error){
			}
	} else {
		document.getElementById("open_update").style.background = "#ffffff"; 
	}
	
	if (!event.target.matches('#open_delete') &&  !event.target.matches('#delete_row_id')
		&& !event.target.matches('#delete_row_button')) {
			try{
				document.getElementById("delete_row_container").style.display = "none";
				document.getElementById("open_delete").style.background = "transparent";
			} catch (error){
			}
	} else {
		document.getElementById("open_delete").style.background = "#ffffff"; 
	}
}

// any window on load, make sure session variabels are updated
window.addEventListener("load", () => {
  get_current_tab();
  get_current_inner_tab();
});

/* Sets curr tab session var */
function set_current_tab(tab_name){
	var postUrl = url + 'DataEntry/set_current_tab';
	var postData = {
				tab_name : tab_name
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				// DEBUG:
				// document.getElementById("error_message").style.color = "red";
				// document.getElementById("error_message").value = response;
			}
        }	 
    });
}

/* Gets the current tab */
function get_current_tab(){
	var tab_arr = ['home_tab', 'data_entry_tab', 'reports_tab', 'maintenance_tab', 'websites_tab', 'forms_tab'];
	var postUrl = url + 'DataEntry/get_current_tab';
	$.ajax({
        url: postUrl,
        type: 'POST',
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 1){
				for(var i = 0; i < tab_arr.length; i++){
					if(response == tab_arr[i]){
						document.getElementById(tab_arr[i]).style.color = '#FFFFFF';
					} 
				}
			}
        }	 
    });
}

/* Sets curr tab session var */
function set_current_inner_tab(inner_tab_name){
	var postUrl = url + 'DataEntry/set_current_inner_tab';
	var postData = {
				inner_tab_name : inner_tab_name
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				// DEBUG: no curr inner tab to set
				// document.getElementById("error_message").style.color = "red";
				// document.getElementById("error_message").value = response;
			}
        }	 
    });
}

/* Gets the current tab */
function get_current_inner_tab(){
	var tab_arr = ['data_entry_cause_manner', 'data_entry_cremation_view', 'data_entry_disinterment_release', 'data_entry_document_tracking', 'data_entry_embalm_permit', 'data_entry_evidence',
	'data_entry_inv_form', 'data_entry_medication_inventory', 'data_entry_narrative'];
	var postUrl = url + 'DataEntry/get_current_inner_tab';
	$.ajax({
        url: postUrl,
        type: 'POST',
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 1){
				for(var i = 0; i < tab_arr.length; i++){
					if(response == tab_arr[i]){
						if(document.getElementById(tab_arr[i]) != null){
							document.getElementById(tab_arr[i]).style.background = '#FFFFFF';
							break;
						}
					} 
				}
			} else {
				// tab is unset, fine
			}
        }	 
    });
}

/* Resets the page by resetting session var and refreshing */
function reset_page(){
	var postUrl = url + 'Home/reset_page';
	$.ajax({
        url: postUrl,
        type: 'POST',
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response == 0){
				window.location.href = window.location.href;
			} 
        }	 
    });
}

// gets websites for dropdown from database
function websites() {
		var postUrl = url + 'Home/get_websites';
		$.ajax({
            url: postUrl,
            type: 'POST',
            dataType: 'json',
            error: function (xhr, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
            success: function(response) {
				if(document.getElementById("site1") == null){
					for(var i = 0; i < response.length; i++){
						$('#myDropdown2').append("<a id='site" + i + "'target='_blank' rel='noopener' href='" + response[i].website_url + "'>" + response[i].website_name + "</a>")
					}
				}
				document.getElementById("myDropdown2").classList.toggle("show2");
            }	 
		});
}

/* Document Tracking Document Status fulfilled or requested changes color */
function get_status(num) {
	element = document.getElementById("status_options" + num);
	if (element != null) {
		if (element.value == "Requested") {
			document.getElementById("status_options" + num).style.backgroundColor = "red";
			document.getElementById("status_options" + num).style.color = "#ffffff";
		} else {
			document.getElementById("status_options" + num).style.backgroundColor = "green";
			document.getElementById("status_options" + num).style.color = "#ffffff";
		}
	}
}

/* Add Blank Document Tracking Table */
$('.add-doc-track-button').on('click', add_doc_track);
function add_doc_track() {
	var new_doc_track_num = parseInt($('#total_docs').val()) + 1;
	var new_input = "<table class=tb  id='new_doc" + new_doc_track_num + "'>"
	+ "<thead><tr><th class='th-data-entry-num'></th>"
	+ "<th class='th-long'>Document Title</th>"
	+ "<th>Event Date</th><th class='th-long'>Status</th>"
	+ "<th class='th-long'>Party Name</th>"
	+ "<th class='th-long'>Relation</th><th class='th-long'>Address</th>"
	+ "<th class='th-long'>Phone</th><th class='th-long'>Fax</th><th class='th-long'>Email</th>"
	+ "<th>AUT</th><th>TOX</th><th>COD</th><th>PHOTOS</th><th>IR</th><th>CHARGES</th><th>PAID</th><th class='th-long'>Notes</th>"
	+ "</tr></thead><tbody><tr><td>" + new_doc_track_num + "</td>"
	+ "<td><input name='doc_title" + new_doc_track_num + "' id='doc_title" + new_doc_track_num + "' type='text' required></td>"
	+ "<td><input name='event_date" + new_doc_track_num + "' id='event_date" + new_doc_track_num + "' type='date'></td>"
	+ "<td><select onclick='get_status(" + new_doc_track_num + ")' id='status_options" + new_doc_track_num + "' name='status_options" + new_doc_track_num + "'>"
	+ "<option value='Requested' selected>Requested</option>"
	+ "<option value='Fulfilled'>Fulfilled</option></select></td>"
	+ "<td><input name='party_name" + new_doc_track_num + "' id='party_name" + new_doc_track_num + "' type='text'></td>"
	+ "<td><input name='party_relation" + new_doc_track_num + "' id='party_relation" + new_doc_track_num + "' type='text'></td>"
	+ "<td><input name='party_address" + new_doc_track_num + "' id='party_address" + new_doc_track_num + "' type='text'></td>"
	+ "<td><input name='party_phone" + new_doc_track_num + "' id='party_phone" + new_doc_track_num + "' type='text'></td>"
	+ "<td><input name='party_fax" + new_doc_track_num + "' id='party_fax" + new_doc_track_num + "' type='text'></td>"
	+ "<td><input name='party_email" + new_doc_track_num + "' id='party_email" + new_doc_track_num + "' type='text'></td>"
	+ "<td><input name='AUT" + new_doc_track_num + "' id='AUT" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><input name='TOX" + new_doc_track_num + "' id='TOX" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><input name='COD" + new_doc_track_num + "' id='COD" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><input name='PHOTOS" + new_doc_track_num + "' id='PHOTOS" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><input name='IR" + new_doc_track_num + "' id='IR" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><input name='CHARGES" + new_doc_track_num + "' id='CHARGES" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><input name='PAID" + new_doc_track_num + "' id='PAID" + new_doc_track_num + "' type='checkbox' onclick='change_checkbox_value(this.id)'></td>"
	+ "<td><textarea name='notes" + new_doc_track_num + "' id='notes" + new_doc_track_num + "' type='text' class='th-long'></textarea></td></td></tr></tbody></table>";

	$('#new_doc').append(new_input);
	$('#total_docs').val(new_doc_track_num);
	get_status(new_doc_track_num);
	
	let total_docs_element = document.getElementById("total_docs");
	total_docs_element.addEventListener('change', function () {
		update_total_docs();
	});
	total_docs_element.dispatchEvent(new Event('change'));
}

/* Add Blank Evidence Table */
$('.add-evidence-button').on('click', add_evidence);
function add_evidence() {
	var new_evidence_num = parseInt($('#total_items').val()) + 1;
	var new_input = "<table class=tb  id='new_evidence" + new_evidence_num + "'";
	new_input += "><thead><tr>";
	new_input += "<th class='th-data-entry-num'></th>";
	new_input += "<th class='th-long'>Item Description</th>";
	new_input += "<th class='th-long'>Notes</th>";
	new_input += "</tr></thead><tbody><tr>";
	new_input += "<td>" + new_evidence_num + "</td>";
	new_input += "<td><textarea name='item_text" + new_evidence_num + "' id='item_text" + new_evidence_num + "' type='text' required></textarea></td>";
	new_input += "<td><textarea name='item_notes" + new_evidence_num + "' id='item_notes" + new_evidence_num + "' type='text'></textarea></td>";
	new_input += "</tr></tbody></table>";

	$('#new_evidence').append(new_input);
	$('#total_items').val(new_evidence_num);
	let total_items_element = document.getElementById("total_items");
	total_items_element.addEventListener('change', function () {
		update_total_items();
	});
	total_items_element.dispatchEvent(new Event('change'));
}

/* Add Blank Medication Inventory Table */
$('.add-med-button').on('click', add_med);
function add_med() {
	var new_med_num = parseInt($('#total_meds').val()) + 1;
	var new_input = "<table class=tb  id='new_med" + new_med_num + "'>"
								+ "<thead><tr>"
								+ "<th class='th-data-entry-num'></th>"
								+ "<th class='th-long'>Medication</th>"
								+ "<th class='th-long'>Inventory Date</th>"
								+ "<th class='th-long'>Inventory By</th>"
								+ "<th class='th-long'>Collected By</th>"
								+ "<th class='th-long'>Perscription #</th>"
								+ "<th class='th-long'>Perscriber</th>"
								+ "<th class='th-long'>Pharmacy</th>"
								+ "<th class='th-long'>Directions</th>"
								+ "<th class='th-long'>Notes</th>"
								+ "</tr></thead><tbody><tr>";
	new_input += "<td>" + (new_med_num) + "</td>";
	new_input += "<td><input name='medication_name" + new_med_num + "' id='medication_name" + new_med_num + "' type='text' required></td>";
	new_input += "<td><input name='inventory_date" + new_med_num + "' id='inventory_date" + new_med_num + "' type='date'></td>";
	new_input += "<td><input name='inventory_by" + new_med_num + "' id='inventory_by" + new_med_num + "' type='text'></td>";
	new_input += "<td><input name='collected_by" + new_med_num + "' id='collected_by" + new_med_num + "' type='text'></td>";
	new_input += "<td><input name='perscription_num" + new_med_num + "' id='perscription_num" + new_med_num + "' type='text'></td>";
	new_input += "<td><input name='perscriber_num" + new_med_num + "' id='perscriber_num" + new_med_num + "' type='text'></td>";
	new_input += "<td><input name='pharmacy_name" + new_med_num + "' id='pharmacy_name" + new_med_num + "' type='text'></td>";
	new_input += "<td><input name='directions" + new_med_num + "' id='directions" + new_med_num + "' type='text'></td>";
	new_input += "<td><textarea name='medication_notes" + new_med_num + "' id='medication_notes" + new_med_num + "' type='text' class='th-long'></textarea></td>";
	new_input += "</tr></tbody></table>";
							
	$('#new_med').append(new_input);
	$('#total_meds').val(new_med_num);	
	let total_meds_element = document.getElementById("total_meds");
	total_meds_element.addEventListener('change', function () {
		update_total_meds();
	});
	total_meds_element.dispatchEvent(new Event('change'));
}

/* Add Blank Narrative Supplemental Report */
$('.add-supp-report').on('click', add_supp_report);
function add_supp_report() {
	var new_supp_report_num = parseInt($('#total_forms').val()) + 1;
	var new_input = "<table class=tb  id='new_form" + new_supp_report_num + "'>"
	+ "<thead><th>Supplemental Report #" + new_supp_report_num + "</th></thead><tbody><tr>";
	new_input += "<td><textarea name='supp_report" + new_supp_report_num + "' id='supp_report" + new_supp_report_num + "' rows=10 required></textarea></td>";
	new_input += "</tr></tbody></table>";
	
	$('#new_form').append(new_input);
	$('#total_forms').val(new_supp_report_num);
	let total_forms_element = document.getElementById("total_forms");
	total_forms_element.addEventListener('change', function () {
		update_total_forms();
	});
	total_forms_element.dispatchEvent(new Event('change'));
}

/* Add Blank Filter Input Reports */
$('.add-filter-button').on('click', add_filter);
function add_filter() {
	if(document.getElementById('report_table') == null || document.getElementById('report_table') == ''){
		return;
	} 
	var new_filter_num = parseInt($('#total_filters').val()) + 1;
	var new_input = "<table class='tb' id='new_filter" + new_filter_num + "'>"
								+ "<tbody><tr>"
								+ "<td><label>INPUT<select id='input_name" + new_filter_num + "' name='input_name" + new_filter_num + "' class='report_input' value='' onchange='get_text_placeholder(" + new_filter_num + ")' required>"
								+ "</select></label></td>"
								+ "<td><label><select id='filter_type" + new_filter_num + "' name='filter_type" + new_filter_num + "' value='' required>"
									+ "<option value='0' selected>CONTAINS</option>"
									+ "<option value='1'>EQUALS</option>" 
								+ "</select></label></td>"
								+ "<td><label><input id='filter_text" + new_filter_num + "' name='filter_text" + new_filter_num + "' type='text' class='report_input' value='' required></input></label></td>"
								+ "<label><input id='total_filter_items" + new_filter_num + "' value='0' type='text' hidden></input></label>"
								+ "</tr></tbody></table>";
	$('#new_filter').append(new_input);
	$('#total_filters').val(new_filter_num);
	
	let total_filters_element = document.getElementById("total_filters");
	total_filters_element.addEventListener('change', function () {
		update_total_filters();
	});
	total_filters_element.dispatchEvent(new Event('change'));
	
	get_input_fields(new_filter_num);
}

/* Fill form onkeyup by case num for Data Entry*/
function get_form_details(case_num, table_name) {
	if (case_num.length < 6 || case_num.length > 7) {
		return;
	} else {
		var postUrl = url + 'DataEntry/search_db';
		var postData = {
				case_number: case_num,
				table_name: table_name
		};
		$.ajax({
            url: postUrl,
            type: 'POST',
            data: postData,
            dataType: 'json',
            error: function (xhr, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
            success: function(response) {
				// common default use variables
				var checked = "checked";
				var unchecked = "";
				var selected = "selected";
				
				// check if error message, if so, display
				if(!response[0].hasOwnProperty('case_number')){
					// clear page before showing error message
					switch (table_name) {
			            case "data_entry_document_tracking":
							clear_page('docs', 'doc');
							$('#case_number').val(case_num);
			                break;
			            case "data_entry_evidence":
							clear_page('items', 'evidence');
							$('#case_number').val(case_num);
			                break;
			            case "data_entry_medication_inventory":
							clear_page('meds', 'med');
							$('#case_number').val(case_num);
			                break;
			            case "data_entry_narrative":
							clear_page('forms', 'form');
							document.getElementById("narrative").value = "";
							$('#case_number').val(case_num);
			                break;
			            case "data_entry_case":
							$('#index_form')[0].reset();
							$('#case_number_case').val(case_num);
							break;
						default:
							$('#form')[0].reset();
							$('#case_number').val(case_num);
					}
					// display error message
					document.getElementById("error_message").style.color = "red";
					document.getElementById("error_message").value = response;
				} else {
					switch (table_name) {
						case "data_entry_case":
							document.getElementById("case_number_case").value = response[0].case_number;
			            	document.getElementById("reported_to").value = response[0].reported_to;
							document.getElementById("date_reported").value = response[0].date_reported;
							document.getElementById("time_reported").value = response[0].time_reported;
							document.getElementById("reported_by").value = response[0].reported_by;
							break;
			            case "data_entry_cause_manner":
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
			                document.getElementById("first_name").value = response[0].first_name;
			                document.getElementById("last_name").value = response[0].last_name;
			                document.getElementById("medical_certifier").value = response[0].medical_certifier;
			            	document.getElementById("medical_certifier").value = response[0].medical_certifier;
							document.getElementById("signed_date").value = response[0].signed_date;
							document.getElementById("manner_of_death").value = response[0].manner_of_death;
							document.getElementById("cause_of_death").value = response[0].cause_of_death;
							document.getElementById("due_to").value = response[0].due_to;
							document.getElementById("cause_of_death_other").value = response[0].cause_of_death_other;
			                break;
			            case "data_entry_cremation_view":
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							document.getElementById("cremation").checked = response[0].cremation == 1 ? true : false;
							document.getElementById("cremation_only").checked = response[0].cremation_only == 1 ? true : false;
							document.getElementById("view_by").value = response[0].view_by;
							document.getElementById("funeral_home").value = response[0].funeral_home;
							document.getElementById("trauma_noted").checked = response[0].trauma_noted == 1 ? true : false;
							document.getElementById("internal_foreign_object").value = response[0].internal_foreign_object;
							document.getElementById("internal_foreign_object_text").value = response[0].internal_foreign_object_text;
							document.getElementById("issue_permit").checked = response[0].issue_permit == 1 ? true : false;
							document.getElementById("cremation_memo").value = response[0].cremation_memo;
			                break;
			            case "data_entry_disinterment_release":
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							document.getElementById("first_mi_name").value = response[0].first_mi_name;
							document.getElementById("last_name").value = response[0].last_name;
							document.getElementById("date_of_death").value = response[0].date_of_death;
							document.getElementById("decedent_age_noninfant").value = response[0].decedent_age_noninfant;
							document.getElementById("age_infant").value = response[0].age_infant;
							document.getElementById("current_cemetery_lot").value = response[0].current_cemetery_lot;
							document.getElementById("current_cemetery_name").value = response[0].current_cemetery_name;
							document.getElementById("current_cemetery_citystatezip").value = response[0].current_cemetery_citystatezip;
							document.getElementById("current_cemetery_country").value = response[0].current_cemetery_country;
							document.getElementById("new_dispo").checked = response[0].new_dispo == 1 ? true : false;
							document.getElementById("new_cremated").checked = response[0].new_cremated == 1 ? true : false;
							document.getElementById("new_cremated_interred").checked = response[0].new_cremated_interred == 1 ? true : false;
							document.getElementById("new_cremated_mausoleum").checked = response[0].new_cremated_mausoleum == 1 ? true : false;
							document.getElementById("new_cremated_delegated").checked = response[0].new_cremated_delegated == 1 ? true : false;
							document.getElementById("new_reinterred").checked = response[0].new_reinterred == 1 ? true : false;
							document.getElementById("new_cemetery_lot").value = response[0].new_cemetery_lot;
							document.getElementById("new_cemetery_name").value = response[0].new_cemetery_name;
							document.getElementById("new_cemetery_citystatezip").value = response[0].new_cemetery_citystatezip;
							document.getElementById("new_cemetery_county").value = response[0].new_cemetery_county;
							document.getElementById("new_cemetery_state_country").value = response[0].new_cemetery_state_country;
							document.getElementById("applicant_name").value = response[0].applicant_name;
							document.getElementById("applicant_license").value = response[0].applicant_license;
							document.getElementById("applicant_fulladdress").value = response[0].applicant_fulladdress;
							document.getElementById("applicant_phone").value = response[0].applicant_phone;
							document.getElementById("applicant_payment").checked = response[0].applicant_payment == 1 ? true : false;
							document.getElementById("applicant_nnok").checked = response[0].applicant_nnok == 1 ? true : false;
							document.getElementById("applicant_agreement").checked = response[0].applicant_agreement == 1 ? true : false;
							document.getElementById("issuing_official_name").value = response[0].issuing_official_name;
							document.getElementById("issuing_official_title").value = response[0].issuing_official_title;
							document.getElementById("issuing_official_signature_date").value = response[0].issuing_official_signature_date;
			                break;
			            case "data_entry_embalm_permit":
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							document.getElementById("first_mi_name").value = response[0].first_mi_name;
							document.getElementById("last_name").value = response[0].last_name;
							document.getElementById("full_address").value = response[0].full_address;
							document.getElementById("pronounced_citystatezip").value = response[0].pronounced_citystatezip;
							document.getElementById("pronounced_county").value = response[0].pronounced_county;
							document.getElementById("pronounced_physician").value = response[0].pronounced_physician;
							document.getElementById("date_of_death").value = response[0].date_of_death;
							document.getElementById("time_of_death").value = response[0].time_of_death;
							document.getElementById("sign_dc_physician").value = response[0].sign_dc_physician;
							document.getElementById("embalm_date").value = response[0].embalm_date;
							document.getElementById("embalm_recieved_by").value = response[0].embalm_recieved_by;
							break;
			            case "data_entry_inv_form":
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							document.getElementById("first_mi_name").value = response[0].first_mi_name;
							document.getElementById("last_name").value = response[0].last_name;
							document.getElementById("current_facility_address").value = response[0].current_facility_address;
							document.getElementById("decedent_phone").value = response[0].decedent_phone;
							document.getElementById("decedent_date_of_birth").value = response[0].decedent_date_of_birth;
							document.getElementById("decedent_age_noninfant").value = response[0].decedent_age_noninfant;
							document.getElementById("decedent_age_infant").value = response[0].decedent_age_infant;
							document.getElementById("decedent_sex").value = response[0].decedent_sex;
							document.getElementById("decedent_race").value = response[0].decedent_race;
							document.getElementById("decedent_height").value = response[0].decedent_height;
							document.getElementById("decedent_weight").value = response[0].decedent_weight;
							document.getElementById("date_of_death").value = response[0].date_of_death;
							document.getElementById("time_of_death").value = response[0].time_of_death;
							document.getElementById("where_pronounced_facility").value = response[0].where_pronounced_facility;
							document.getElementById("where_pronounced_facility").value = response[0].where_pronounced_facility;
							document.getElementById("where_pronounced_physician").value = response[0].where_pronounced_physician;
							document.getElementById("sign_dc_physician").value = response[0].sign_dc_physician;
							document.getElementById("family_physician").value = response[0].family_physician;
							document.getElementById("id_results").value = response[0].id_results;
							document.getElementById("id_by").value = response[0].id_by;
							document.getElementById("id_method").value = response[0].id_method;
							document.getElementById("kin_full_name").value = response[0].kin_full_name;
							document.getElementById("kin_phone").value = response[0].kin_phone;
							document.getElementById("kin_address").value = response[0].kin_address;
							document.getElementById("kin_citystatezip").value = response[0].kin_citystatezip;
							document.getElementById("kin_relationship").value = response[0].kin_relationship;
							document.getElementById("kin_notified_by").value = response[0].kin_notified_by;
							document.getElementById("decedent_funeral_home").value = response[0].decedent_funeral_home;
							document.getElementById("donor_agency_notified").checked = response[0].donor_agency_notified;
							document.getElementById("donor_agency_notified_date").value = response[0].donor_agency_notified_date;
							document.getElementById("donor_agency_notified_time").value = response[0].donor_agency_notified_time;
							document.getElementById("donor_agency_notified_name").value = response[0].donor_agency_notified_name;
							document.getElementById("donor_agency_reference_num").value = response[0].donor_agency_reference_num;
							document.getElementById("donor_agency_referenced_by").value = response[0].donor_agency_referenced_by;
							document.getElementById("disposition_option").value = response[0].disposition_option;
							document.getElementById("disposition_aut_ext_by").value = response[0].disposition_aut_ext_by;
							document.getElementById("disposition_referred_to").checked = response[0].disposition_referred_to == 1 ? true : false;
							document.getElementById("disposition_wisconsin_county").value = response[0].disposition_wisconsin_county;
							document.getElementById("scene").checked= response[0].scene == 1 ? true : false;
							document.getElementById("cremation").checked = response[0].cremation == 1 ? true : false;
							document.getElementById("cremation_only").checked = response[0].cremation_only == 1 ? true : false;
							document.getElementById("dead_24").checked = response[0].dead_24 == 1 ? true : false;
							document.getElementById("traffic_fatality").checked = response[0].traffic_fatality == 1 ? true : false;
							document.getElementById("in_custody").checked = response[0].in_custody == 1 ? true : false;
							document.getElementById("anthro_case").checked = response[0].anthro_case == 1 ? true : false;
							document.getElementById("disinterment").checked = response[0].disinterment == 1 ? true : false;
							document.getElementById("suicide").checked = response[0].suicide == 1 ? true : false;
							document.getElementById("homicide").checked = response[0].homicide == 1 ? true : false;
							document.getElementById("drug_related").checked = response[0].drug_related == 1 ? true : false;
							document.getElementById("accident").checked = response[0].accident == 1 ? true : false;
							document.getElementById("WFCAP").checked = response[0].WFCAP == 1 ? true : false;
							document.getElementById("mutual_aid").checked = response[0].mutual_aid  == 1 ? true : false;
							document.getElementById("indigent").checked = response[0].indigent == 1 ? true : false;
			                break;
			            case "data_entry_document_tracking":
							clear_page('docs', 'doc');
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							for(var i = 0; i < response.length; i++){
								var doc_num = parseInt(response[i].doc_num);
								if(doc_num != 0){
									var new_input = "<table class=tb  id='new_doc" + doc_num + "'>"
									+ "<thead><tr><th class='th-data-entry-num'></th>"
									+ "<th class='th-long'>Document Title</th>"
									+ "<th>Request Date</th><th class='th-long'>Status</th>"
									+ "<th class='th-long'>Party Name</th>"
									+ "<th class='th-long'>Relation</th><th class='th-long'>Address</th>"
									+ "<th class='th-long'>Phone</th><th class='th-long'>Fax</th><th class='th-long'>Email</th>"
									+ "<th>AUT</th><th>TOX</th><th>COD</th><th>PHOTOS</th><th>IR</th><th>CHARGES</th><th>PAID</th><th class='th-long'>Notes</th>"
									+ "</tr></thead><tbody><tr><td>" + doc_num + "</td>"
									+ "<td><input name='doc_title" + doc_num + "' id='doc_title" + doc_num + "' type='text' value='" + set_value(response[i].doc_title) + "'></td>"
									+ "<td><input name='event_date" + doc_num + "' id='event_date" + doc_num + "' type='date' value='" + set_value(response[i].event_date) + "'></td>"
									+ "<td><select onclick='get_status(" + doc_num + ")' id='status_options" + doc_num + "' name='status_options" + doc_num + "' value=" + set_value(response[i].status_options) + ">"
									+ "<option value='Requested' " + (response[i].status_options == 'Requested' ? selected : unchecked) + ">Requested</option>"
									+ "<option value='Fulfilled' " + (response[i].status_options == 'Fulfilled' ? selected : unchecked) + ">Fulfilled</option></select></td>";
									new_input += "<td><input name='party_name" + doc_num + "' id='party_name" + doc_num + "' type='text' value='" + set_value(response[i].party_name) + "'></td>";
									new_input += "<td><input name='party_relation" + doc_num + "' id='party_relation" + doc_num + "' type='text' value='" + set_value(response[i].party_relation) + "'></td>";
									new_input += "<td><input name='party_address" + doc_num + "' id='party_address" + doc_num + "' type='text' value='" + set_value(response[i].party_address) + "'></td>";
									new_input += "<td><input name='party_phone" + doc_num + "' id='party_phone" + doc_num + "' type='text' value='" + set_value(response[i].party_phone) + "'></td>";
									new_input += "<td><input name='party_fax" + doc_num + "' id='party_fax" + doc_num + "' type='text' value='" + set_value(response[i].party_fax) + "'></td>";
									new_input += "<td><input name='party_email" + doc_num + "' id='party_email" + doc_num + "' type='text' value=" + set_value(response[i].party_email) + "></td>";
									new_input += "<td><input name='AUT" + doc_num + "' id='AUT" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].AUT == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><input name='TOX" + doc_num + "' id='TOX" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].TOX == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><input name='COD" + doc_num + "' id='COD" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].COD == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><input name='PHOTOS" + doc_num + "' id='PHOTOS" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].PHOTOS == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><input name='IR" + doc_num + "' id='IR" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].IR == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><input name='CHARGES" + doc_num + "' id='CHARGES" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].CHARGES == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><input name='PAID" + doc_num + "' id='PAID" + doc_num + "' type='checkbox' onclick='change_checkbox_value(this.id)' " + (response[i].PAID == 1 ? checked : unchecked) + "></td>";
									new_input += "<td><textarea name='notes" + doc_num + "' id='notes" + doc_num + "' type='text' class='th-long' value='" + set_value(response[i].notes) + "'>" + set_value(response[i].notes) + "</textarea></td></td></tr></tbody></table>";
									$('#new_doc').append(new_input);
									$('#total_docs').val(doc_num);
									get_status(doc_num);
								}
							}
							let total_docs_element = document.getElementById("total_docs");
							total_docs_element.addEventListener('change', function () {
								update_total_docs();
							});
							total_docs_element.dispatchEvent(new Event('change'));
			                break;
			            case "data_entry_evidence":
							clear_page('items', 'evidence');
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							for(var i = 0; i < response.length; i++){
								var doc_num = parseInt(response[i].doc_num);
								var new_input = "<table class=tb  id='new_evidence" + doc_num + "'><thead><tr>";
								new_input += "<th class='th-data-entry-num'></th>"
								+ "<th class='th-long'>Item Description</th>"
								+ "<th class='th-long'>Notes</th>"
								+ "</tr></thead><tbody><tr>";
								new_input += "<td>" + (doc_num) + "</td>";
								new_input += "<td><textarea name='item_text" + doc_num + "' id='item_text" + doc_num + "' type='text' value='" + response[i].item_text + "'>" + response[i].item_text + "</textarea></td>";
								new_input += "<td><textarea name='item_notes" + doc_num + "' id='item_notes" + doc_num + "' type='text' value='" + response[i].item_notes + "'>" + set_value(response[i].item_notes) + "</textarea></td>";
								new_input += "</tr></tbody></table>";
							
								$('#new_evidence').append(new_input);
								$('#total_items').val(doc_num);
							}
							let total_items_element = document.getElementById("total_items");
							total_items_element.addEventListener('change', function () {
								update_total_items();
							});
							total_items_element.dispatchEvent(new Event('change'));
			                break;
			            case "data_entry_medication_inventory":
							clear_page('meds', 'med');
							document.getElementById("error_message").value = "";
							document.getElementById("case_number").value = response[0].case_number;
							for(var i = 0; i < response.length; i++){
								var doc_num = parseInt(response[i].doc_num);
								var new_input = "<table class=tb  id='new_med" + doc_num + "'>"
								+ "<thead><tr>"
								+ "<th class='th-data-entry-num'></th>"
								+ "<th class='th-long'>Medication</th>"
								+ "<th class='th-long'>Inventory Date</th>"
								+ "<th class='th-long'>Inventory By</th>"
								+ "<th class='th-long'>Collected By</th>"
								+ "<th class='th-long'>Perscription #</th>"
								+ "<th class='th-long'>Perscriber</th>"
								+ "<th class='th-long'>Pharmacy</th>"
								+ "<th class='th-long'>Directions</th>"
								+ "<th class='th-long'>Notes</th>"
								+ "</tr></thead><tbody><tr>";
								new_input += "<td>" + (doc_num) + "</td>";
								new_input += "<td><input name='medication_name" + doc_num + "' id='medication_name" + doc_num + "' type='text' value='" + set_value(response[i].medication_name) + "'></td>";
								new_input += "<td><input name='inventory_date" + doc_num + "' id='inventory_date" + doc_num + "' type='date' value='" + set_value(response[i].inventory_date) + "'></td>";
								new_input += "<td><input name='inventory_by" + doc_num + "' id='inventory_by" + doc_num + "' type='text' value='" + set_value(response[i].inventory_by) + "'></td>";
								new_input += "<td><input name='collected_by" + doc_num + "' id='collected_by" + doc_num + "' type='text' value='" + set_value(response[i].collected_by) + "'></td>";
								new_input += "<td><input name='perscription_num" + doc_num + "' id='perscription_num" + doc_num + "' type='text' value='" + set_value(response[i].perscription_num) + "'></td>";
								new_input += "<td><input name='perscriber_num" + doc_num + "' id='perscriber_num" + doc_num + "' type='text' value='" + set_value(response[i].perscriber_num) + "'></td>";
								new_input += "<td><input name='pharmacy_name" + doc_num + "' id='pharmacy_name" + doc_num + "' type='text' value='" + set_value(response[i].pharmacy_name) + "'></td>";
								new_input += "<td><input name='directions" + doc_num + "' id='directions" + doc_num + "' type='text' value='" + set_value(response[i].directions) + "'></td>";
								new_input += "<td><textarea name='medication_notes" + doc_num + "' id='medication_notes" + doc_num + "' type='text' class='th-long' value='" + set_value(response[i].medication_notes) + "'>" + set_value(response[i].medication_notes) + "</textarea></td>";
								new_input += "</tr></tbody></table>";
								
								$('#new_med').append(new_input);
								$('#total_meds').val(doc_num);
							}
							let total_meds_element = document.getElementById("total_meds");
							total_meds_element.addEventListener('change', function () {
								update_total_meds();
							});
							total_meds_element.dispatchEvent(new Event('change'));
			                break;
			            case "data_entry_narrative":
							clear_page('forms', 'form');
							document.getElementById("case_number").value = response[0].case_number;
							document.getElementById("narrative").value = response[0].narrative;
							document.getElementById("error_message").value = "";
							if(response[0].hasOwnProperty('supp_text')){
								 for(var i = 0; i < response.length; i++){
									var doc_num = parseInt(response[i].doc_num);
									var new_input = "<table class=tb id='new_form" + doc_num + "'>"
									+ "<thead><tr><th>Supplemental Report #" + doc_num + "</th></tr></thead><tbody><tr>";
									new_input += "<td><textarea style='width: 100%;' name='supp_report" + doc_num + "' id='supp_report" + doc_num + "' rows=10 value='" + response[i].supp_text + "'>" + response[i].supp_text + "</textarea></td>";
									new_input += "</tr></tbody></table>";
									$('#new_form').append(new_input);
									$('#total_forms').val(doc_num);
								}
							}
							let total_forms_element = document.getElementById("total_forms");
							total_forms_element.addEventListener('change', function () {
								update_total_forms();
							});
							total_forms_element.dispatchEvent(new Event('change'));
			                break;
			        }//end of switch
				}//end of else
            }//end of success
		});//end of ajax
	}//end of case num length validation
}

// HOME -> todo list
// today's date
const today = new Date().toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
// previous day
var temp_yesterday = new Date(today);
temp_yesterday.setDate(temp_yesterday.getDate() - 1);
const yesterday = temp_yesterday.toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
// next day
var temp_tomorrow = new Date(today);
temp_tomorrow.setDate(temp_tomorrow.getDate() + 1);
const tomorrow = temp_tomorrow.toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
// current date tracker
var curr_date;

// getting output header for the date
function set_header_name(){
	if(curr_date == today){
		document.getElementById("day").textContent = 'Today';
	} else if (curr_date == yesterday){
		document.getElementById("day").textContent = 'Yesterday';
	} else if (curr_date == tomorrow){
		document.getElementById("day").textContent = 'Tomorrow';
	} else {
		var day_num = new Date(curr_date).getDay();
		var day_of_week;
		switch(day_num){
			case 0:
				day_of_week = "Sunday";
				break;
			case 1:
				day_of_week = "Monday";
				break;
			case 2:
				day_of_week = "Tuesday";
				break;
			case 3:
				day_of_week = "Wednesday";
				break;
			case 4:
				day_of_week = "Thursday";
				break;
			case 5:
				day_of_week = "Friday";
				break;
			case 6:
				day_of_week = "Saturday";
				break;
				
		}
		document.getElementById("day").textContent = day_of_week;
	}
}

// onload of home, load today's tasks
function load_todo_today(){
	const today = new Date().toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
    var date = today.toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
    document.getElementById("today_todo").textContent = date;
    curr_date = date;
    document.getElementById("day").textContent = 'Today';
    get_todo(date);
}

// get the previous days tasks
$('#previous_day').on('click', get_previous_day);
function get_previous_day(){
	var previous_day = new Date(curr_date);
	previous_day.setDate(previous_day.getDate() - 1).toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
	previous_day = previous_day.toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
	document.getElementById("today_todo").textContent = previous_day;
	curr_date = previous_day;
	set_header_name();
	get_todo(curr_date);
}

// get the next days tasks
$('#next_day').on('click', get_next_day);
function get_next_day(){
	var next_day = new Date(curr_date);
	next_day.setDate(next_day.getDate() + 1);
	next_day = next_day.toLocaleString("en-GB", {day: "numeric", month: "short", year: "numeric"});
	document.getElementById("today_todo").textContent = next_day;
	curr_date = next_day;
	set_header_name();
	get_todo(curr_date);
}

// get the todo tasks for the home page
function get_todo(date) {
	var postUrl = url + 'Home/todo_list';
	var postData = {
				date: date
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'json',
        error: function (xhr, thrownError) {
           	alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {
			// clear previous date tasks
			for(var i = $('#total_tasks').val(); i > 0; i--){
					$('#list'+ i).remove();
					$('#total_tasks').val(i - 1);
			}
			if(response != 0 && !response[0].hasOwnProperty('task')){
				document.getElementById("error_message").style.color = "red";
				document.getElementById("error_message").value = 'ERROR: An Error Has Occurred Getting Todos';
			} else {
				var todays_tasks = "";
				// common default use variables
				var checked = "checked";
				var unchecked = "";
				var task_num = 1;
				for(var i = 0; i < response.length; i++){
					if(response[i].completed == 0){
						todays_tasks += "<li id='list" + task_num + "' class='list-group-item border-0 d-flex align-items-center ps-0'>"
						+ "<input id='checkbox" + task_num + "' name='task" + task_num + "' class='form-check-input me-3' type='checkbox' onchange='save_task(" + task_num + ")' value=\"" + (response[i].task) + "\"" 
						+ (response[i].completed == 1 ? checked : unchecked) + " onchange='save_task(" + task_num + ")'/>" 
						+ "<input id='task" + task_num + "' for=='task" + task_num + "' onchange='save_task(" + task_num + ")' class='strikethrough' value=\"" + (response[i].task) + "\" type='text'></input>"
						+ "</li>";
					}
						task_num++;
				}
				$('#total_tasks').val(task_num);
				$('#todo_list').append(todays_tasks);
			}	
        }	 
    });
}

// save the todo tasks for the home page
function save_task(task_num) {
	var date = document.getElementById('today_todo').textContent;
	var task = document.getElementById('task' + task_num).value;
	var completed = 0;
	if (task_num == 0){
		task_num = document.getElementById('total_tasks').value;
		// first task of the day
		if(task_num == 0){
			task_num = 1;
		}
	} else {
		completed = document.getElementById('checkbox' + task_num).checked == true ? 1 : 0;
	}
	var postUrl = url + 'Home/save_task';
	var postData = {
				date: date,
				task_num: task_num,
				task: task,
				completed: completed
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'html',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				document.getElementById("error_message").style.color = "red";
				document.getElementById("error_message").value = 'ERROR: An Error Occured Adding Task';
			}
        }	 
    });
}

// onclick changes checkbox value in the database
function change_checkbox_value(id){
	var table_name = document.getElementById('table_name').value;
	var case_num = document.getElementById('case_number').value;
	var is_checked = document.getElementById(id).checked == 1 ? 1 : 0;
	document.getElementById(id).checked = is_checked;
	var column_header = id;
	// remove nums from changing adding table forms for querying the database 
	if(table_name == 'data_entry_document_tracking' || table_name == 'data_entry_evidence'
		|| table_name == 'data_entry_medication_inventory' || table_name == 'data_entry_supp_report'){
		column_header = id.replace(/[0-9]/g, '');
	} 
	
	var column_arr = {[column_header] : is_checked};
	var postUrl = url + 'DataEntry/update_checkbox';
	var postData = {
				table_name: table_name,
				case_num : case_num,
				column_arr : column_arr
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'html',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response == 1){
				document.getElementById("error_message").style.color = "red";
				document.getElementById("error_message").value = "CASE #" + case_num + " DOES NOT EXIST : ADD CASE";
			} else if(response != 0){
				// DEBUG: case doesn't exist OR pdo cannot find column in field list 
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in change_checkbox_value(id);[' + response + '] END.');
			} 
        }	 
    });
}

// print function for data entry forms
$('#print_button').on('click', function(){     
	$('#case_number_hide').val($('#case_number').val());
	$('#table_name_hide').val(document.getElementById('print_button').value);
});

// print function for report tables
$('#print_table_button').on('click', function(){     
	$('#table_html').val(document.getElementById('tables').innerHTML);
	$('#table_html_name').val(document.getElementById('print_table_button').value);
});

// print function for forms blank forms
$('#form-print').on('click', function(){     
	$('#report_type_hidden').val($('#report_type').val());
});

// onclick for case num case, pre-input some of the necessary information
$('#case_number_case').on('click', function (){
	if(document.getElementById('case_number_case').value == ""){
		var year_abbr = new Date().toLocaleDateString('en', {year: '2-digit'});
		document.getElementById('case_number_case').value = year_abbr + "-";
	}
});

// onclick for case num, pre-input some of the necesarry information 
$('#case_number').on('click', function (){
	if(document.getElementById('case_number').value == ""){
		var year_abbr = new Date().toLocaleDateString('en', {year: '2-digit'});
		document.getElementById('case_number').value = year_abbr + "-";
	}
});

/* onkeyup of case number top section of data entry, fill data in data entry form */
$('#case_number_case').on('keyup', function (){
	var temp_case_num = document.getElementById('case_number_case').value;
	if (temp_case_num.length < 6 || temp_case_num.length > 7) {
		return;
	} else {
		var postUrl = url + 'DataEntry/set_case_num';
		$.ajax({
	        url: postUrl,
	        type: 'POST',
	        data: $("#index_form").serialize(),
	        dataType: 'json',
	        error: function (xhr, thrownError) {
	            alert(xhr.status);
	            alert(thrownError);
	        },
	        success: function(response) {	
				if(response != 0 && response != 1){
					// fill page
					get_form_details(response[0], response[1]);
					get_active_case_files(response[0]);
				} else {
					// DEBUG: case num not set or table num not set or error
					//document.getElementById("error_message").style.color = "red";
					//document.getElementById("error_message").value = response;
				}
	        }	 
	    });
	}
});

/* onkeyup of case number in data entry, fill top section with data */
$('#case_number').on('keyup', function (){
	var temp_case_num = document.getElementById('case_number').value;
	if (temp_case_num.length < 6 || temp_case_num.length > 7) {
		return;
	} else {
		var postUrl = url + 'DataEntry/set_case_num';
		$.ajax({
	        url: postUrl,
	        type: 'POST',
	        data: $("#form").serialize(),
	        dataType: 'json',
	        error: function (xhr, thrownError) {
	            alert(xhr.status);
	            alert(thrownError);
	        },
	        success: function(response) {	
				if(response != 0 && response != 1){
					// fill page
					get_form_details(response[0], response[1]);
					get_active_case_files(response[0]);
				} else {
					// DEBUG: case num not set or table num not set or error
					//document.getElementById("error_message").style.color = "red";
					//document.getElementById("error_message").value = response;
				}
	        }	 
	    });
	}
});

/* onload each form in data entry, load curr form (and table) */
function check_table(table_name){
	var postUrl = url + 'DataEntry/set_table_name';
	var postData = {
				table_name: table_name
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'json',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0 && response != 1){
				// get_form_details(case num, table name)
				get_form_details(response[0], 'data_entry_case');
				get_form_details(response[0], response[1]);
				get_active_case_files(response[0]);
			} else {
				// DEBUG: case num not set or table name not set or error
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
			}
        }	 
    });
}

/* Grabs active case files for data entry, used for coloring purposes */
function get_active_case_files(case_num){
	var postUrl = url + 'DataEntry/get_active_case_files';
	var postData = {
				case_num : case_num
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'json',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != null){
				for(var curr_table_name in response){
					if(response[curr_table_name] == 1){
						document.getElementById(curr_table_name).style.color = "green";
					} else {
						document.getElementById(curr_table_name).style.color = "red";
					}
				}
			} 
        }	 
    });
}

/* Grabs specified case from the database for the home page OR all if null (onload)*/
function search_cases(){
	var postUrl = url + 'Home/search_cases';
	var postData = {
				case_num : document.getElementById('case_list_search_bar').value == null ? "" : document.getElementById('case_list_search_bar').value
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 1){
				$("#case_list").append(response);
			} else {
				// DEBUG: 
				// document.getElementById("error_message").style.color = "red";
				// document.getElementById("error_message").value = response;
				console.log('ERROR in search_cases();[' + response + '] END.');
			}
        }	 
    });
}

/* Fills report filter builder with field list names for selected form*/
function get_input_fields(filter_id){
	if(document.getElementById('report_table') == null || document.getElementById('report_table') == ''){
		return;
	} else if(filter_id == 1) {
		var total_filters = document.getElementById('total_filters').value;
		for(i = 2; i <= total_filters; i++){
			get_input_fields(i);
		}
	} 
	var table_name = document.getElementById('report_table').value;
	var postUrl = url + 'Reports/get_input_fields';
	var postData = {
				table_name : table_name,
				filter_id : filter_id
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'json',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 1){
				for(var i = 0; i < $('#total_filter_items'+filter_id).val(); i++){
					$('#option_value'+filter_id).remove();
				}
				for(var i = 0; i < response.length; i++){
					if(response[i] != null){
						$('#input_name'+filter_id).append(response[i]);
					}
					$('#total_filter_items'+filter_id).val(response.length);
				}
			} else {
				// DEBUG: can't find table
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in get_input_fields(filter_id);[' + response + '] END.');
			}
        }	 
    });
}

/* Fills report text with input type to help user remember */
function get_text_placeholder(filter_id){
	if(document.getElementById('input_name'+filter_id).value == null || document.getElementById('input_name'+filter_id).value == ''){
		document.getElementById('filter_text'+filter_id).placeholder = '';
		return;
	}
	var table_name = document.getElementById('report_table').value;
	var postUrl = url + 'Reports/get_text_placeholder';
	var postData = {
				table_name : table_name,
				filter_id : filter_id
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'json',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 1){
				document.getElementById('filter_text'+filter_id).placeholder = '';
				for(var i = 0; i < response.length; i++){
					if(document.getElementById('input_name'+filter_id).value == response[i][0]){
						var placeholder = '';
						switch(response[i][1]){
							case 'int':
								placeholder = 'number';
								break;
							case 'tinyint':
								placeholder = 'true or false';
								break;
							case 'text':
								placeholder = 'text';
								break;
							case 'mediumtext':
								placeholder = 'text';
								break;
							default:
								placeholder = 'error';
								break;
						}
					}
				}
				document.getElementById('filter_text'+filter_id).placeholder = placeholder;
			} else {
				// DEBUG: can't find table or column
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in get_text_placeholder(filter_id);[' + response + '] END.');
			}
        }	 
    });
}

/* Gets cause manner table for reports */
$('#cause_manner_pinned_container').on('submit', get_cause_manner());
function get_cause_manner(){
	if(document.getElementById('search_cause_manner_text') == null || document.getElementById('search_cause_manner_text').value == ''){
		return;
	}
	var postUrl = url + 'Reports/get_cause_manner';
	var postData = {
				user_input : document.getElementById('search_cause_manner_text').value
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'html',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 1){
				document.getElementById('cause_manner_table').innerHTML = response;
			} else {
				// DEBUG:
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in get_cause_manner();[' + response + '] END.');
			}
        }	 
    });
}

/* Update session var for TOTAL DOCS in data entry, used for looping */
function update_total_docs(){
	var postUrl = url + 'DataEntry/update_total_docs';
	var postData = {
				total_docs_index : $('#total_docs').val()
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in update_total_docs();[' + response + ']');
			}
        }	
    });
}

/* Update session var for TOTAL ITEMS in data entry, used for looping */
function update_total_items(){
	var postUrl = url + 'DataEntry/update_total_items';
	var postData = {
				total_items_index : $('#total_items').val()
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in update_total_items();[' + response + ']');
			}
        }	
    });
}

/* Update session var for TOTAL MEDS in data entry, used for looping */
function update_total_meds(){
	var postUrl = url + 'DataEntry/update_total_meds';
	var postData = {
				total_meds_index : $('#total_meds').val()
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in update_total_meds();[' + response + ']');
			}
        }	
    });
}

/* Update session var for TOTAL FORMS in data entry, used for looping */
function update_total_forms(){
	var postUrl = url + 'DataEntry/update_total_forms';
	var postData = {
				total_forms_index : $('#total_forms').val()
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in update_total_forms();[' + response + ']');
			}
        }	
    });
}

/* Update session var for TOTAL FILTERS in reports, used for looping */
function update_total_filters(){
	var postUrl = url + 'Reports/update_total_filters';
	var postData = {
				total_filters_index : $('#total_filters').val()
		};
	$.ajax({
        url: postUrl,
        type: 'POST',
        data: postData,
        dataType: 'text',
        error: function (xhr, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        },
        success: function(response) {	
			if(response != 0){
				//document.getElementById("error_message").style.color = "red";
				//document.getElementById("error_message").value = response;
				console.log('ERROR in update_total_filters();[' + response + ']');
			}
        }	
    });
}

/* Update the UPDATE variable in the data_entry_updates table */
function update_update_table(){
	
}