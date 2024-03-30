<!-- view/maintenance/physician.php -->
 <body>
	<div class="container">
		<div id="table-view" class="col-sm-10">
        	<h2><b>Physician</b></h2>
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
                    		<input name='add_row_value' id='add_row_value' type='text' placeholder='Physician' required/>
                    		<button name="add_row" id='add_row_button' class="user_option_button" type="submit"><i class="fa-solid fa-circle-plus"></i></button>
                		</form></row>
    				</div>
    				<div class='update_row_container' id='update_row_container'>
        				<row><form action="" method="POST">
        					<input name='update_row_id' id='update_row_id' type="number" min="1" class="short-input" placeholder='ID' required/>
            				<input name='update_row_value' id='update_row_value' type='text' placeholder='Update Physician' required/>
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
            <!-- Load View echo $this->entry_model->fill_maintenence_view("physician", "name", "");?> -->
				<?php if(isset($_POST['search'])){
    				    $search_filter = $_POST['search'];
    				    $column_headers = ["physician_name"];
    				    echo $this->entry_model->fill_maintenance_view("physician", $search_filter, $column_headers);
				    } else if(isset($_POST['show-all-button'])) {
    				    echo $this->entry_model->fill_maintenance_view("physician", "", "");
    				} else if(isset($_POST['add_row_value'])){
    				    $data = $_POST['add_row_value'];
    				    $add_vals = ["physician_name" => $data];
    				    $this->entry_model->add_row('physician', $add_vals);
    				    echo $this->entry_model->fill_maintenance_view("physician", "", "");
    				} else if(isset($_POST['update_row_id']) && isset($_POST['update_row_value'])){
    				    $row_id = $_POST['update_row_id'];
    				    $updated_data = $_POST['update_row_value'];
    				    $updated_vals = ["physician_name" => $updated_data];
    				    $this->entry_model->update_row('physician', $row_id, $updated_vals);
    				    echo $this->entry_model->fill_maintenance_view("physician", "", "");
    				} else if(isset($_POST['delete_row_id'])){
    				    $row_id = $_POST['delete_row_id'];
    				    $this->entry_model->delete_row('physician', $row_id);
    				    echo $this->entry_model->fill_maintenance_view("physician", "", "");
    				} else {
    				    echo $this->entry_model->fill_maintenance_view("physician", "", "");
    				}
			     ?>
		</div>
	</div>
