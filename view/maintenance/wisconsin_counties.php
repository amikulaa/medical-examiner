<!-- view/maintenance/wisconsin_counties.php -->
 <body>
	<div class="container">
		<div id="table-view" class="col-sm-10">
        	<h2><b>Wisconsin Counties</b></h2>
    		<hr/>
    		<div id="search-top" class="row">
    			<form action="" method="POST">
            		<input id="search-bar" type="text" name="search" required value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" 
            		placeholder="Search">
            		<button type="submit" id="search-button" class="btn">Search</button>
                </form>
                <form action="" method="POST">
                	<button type="submit" id="show-all-button" name="show-all-button" class="btn">Show All</button>
                </form>
    		</div>
    		<div id="maintenance-editing">
    			<button onclick='show_add_row();' class="user_option_button" id='open_add'>Add Row</button>
    			<button onclick='show_update_row();' class="user_option_button" id='open_update'>Update Row</button>
    			<button onclick='show_delete_row();' class="user_option_button" id='open_delete'>Delete Row</button>
    			<br/>
    				<div class='add_row_container' id='add_row_container'>
    					<row><form action="" method="POST">
                    		<input name='add_row_value' id='add_row_value' type='text' placeholder='Name' class="county-input" required/>
                    		<input name='add_row_value2' id='add_row_value2' type='text' placeholder='Coroner' class="county-input" required/>
                    		<input name='add_row_value3' id='add_row_value3' type='text' placeholder='Phone' class="county-input" required/>
                    		<input name='add_row_value4' id='add_row_value4' type='text' placeholder='Dispatch' class="county-input" required/>
                    		<input name='add_row_value5' id='add_row_value5' type='text' placeholder='Fax' class="county-input" required/>
                    		<button name="add_row" id='add_row_button' class="user_option_button" type="submit"><i class="fa-solid fa-circle-plus"></i></button>
                		</form></row>
    				</div>
    				<div class='update_row_container' id='update_row_container'>
        				<row><form action="" method="POST">
        					<input name='update_row_id' id='update_row_id' type="number" min="1" class="short-input" placeholder='ID' required/>
            				<input name='update_row_value' id='update_row_value' type='text' placeholder='Name' class="county-input"/>
            				<input name='update_row_value2' id='update_row_value2' type='text' placeholder='Coroner' class="county-input"/>
            				<input name='update_row_value3'id='update_row_value3'  type='text' placeholder='Phone' class="county-input"/>
            				<input name='update_row_value4' id='update_row_value4' type='text' placeholder='Dispatch' class="county-input"/>
            				<input name='update_row_value5' id='update_row_value5' type='text' placeholder='Fax' class="county-input"/>
                    		<button name="update_row" id='update_row_button' class="user_option_button" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                    	</form></row>
    				</div>
    				<div class='delete_row_container' id='delete_row_container'>
        				<row><form action="" method="POST">
                    		<input name='delete_row_id' id='delete_row_id' type="number" min="1" class="short-input" placeholder='ID' required/>
                    		<button name="delete_row" id='delete_row_button' class="user_option_button" type="submit"><i class="fa-solid fa-trash"></i></button>
                    	</form></row>
    				</div>
			</div>
            <!-- Load View echo $this->entry_model->fill_maintenence_view("wisconsin_counties", "name", "");?> -->
				<?php if(isset($_POST['search'])){
    				    $search_filter = $_POST['search'];
    				    $column_headers = ["wisconsin_counties_name", "wisconsin_counties_coroner", "wisconsin_counties_phone",
    				        "wisconsin_counties_dispatchPhone", "wisconsin_counties_fax"];
    				    echo $this->entry_model->fill_maintenance_view("wisconsin_counties", $search_filter, $column_headers);
				    } else if(isset($_POST['show-all-button'])) {
    				    echo $this->entry_model->fill_maintenance_view("wisconsin_counties", "", "");
    				} else if(isset($_POST['add_row_value']) && isset($_POST['add_row_value2']) && isset($_POST['add_row_value3'])
    				    && isset($_POST['add_row_value4']) && isset($_POST['add_row_value5'])){
    				    $data = $_POST['add_row_value'];
    				    $data2 = $_POST['add_row_value2'];
    				    $data3 = $_POST['add_row_value3'];
    				    $data4 = $_POST['add_row_value4'];
    				    $data5 = $_POST['add_row_value5'];
    				    $add_vals = ["wisconsin_counties_name" => $data, "wisconsin_counties_coroner" => $data2, "wisconsin_counties_phone" => $data3, 
    				        "wisconsin_counties_dispatchPhone" => $data4, "wisconsin_counties_fax" => $data5];
    				    $this->entry_model->add_row('wisconsin_counties', $add_vals);
    				    echo $this->entry_model->fill_maintenance_view("wisconsin_counties", "", "");
    				} else if(isset($_POST['update_row_id']) && isset($_POST['update_row_value'])
    				    && isset($_POST['update_row_value2']) && isset($_POST['update_row_value3'])
    				    && isset($_POST['update_row_value4']) && isset($_POST['update_row_value5'])){
    				    $row_id = $_POST['update_row_id'];
    				    $updated_data = $_POST['update_row_value'];
    				    $updated_data2 = $_POST['update_row_value2'];
    				    $updated_data3 = $_POST['update_row_value3'];
    				    $updated_data4 = $_POST['update_row_value4'];
    				    $updated_data5 = $_POST['update_row_value5'];
    				    $updated_vals = ["wisconsin_counties_name" => $updated_data, "wisconsin_counties_coroner" => $updated_data2, "wisconsin_counties_phone" => $updated_data3,
    				        "wisconsin_counties_dispatchPhone" => $updated_data4, "wisconsin_counties_fax" => $updated_data5];
    				    $this->entry_model->update_row('wisconsin_counties', $row_id, $updated_vals);
    				    echo $this->entry_model->fill_maintenance_view("wisconsin_counties", "", "");
    				} else if(isset($_POST['delete_row_id'])){
    				    $row_id = $_POST['delete_row_id'];
    				    $this->entry_model->delete_row('wisconsin_counties', $row_id);
    				    echo $this->entry_model->fill_maintenance_view("wisconsin_counties", "", "");
    				} else {
    				    echo $this->entry_model->fill_maintenance_view("wisconsin_counties", "", "");
    				}
			     ?>
		</div>
	</div>
