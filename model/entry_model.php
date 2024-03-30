<?php
/**
 * Medical Examiner Model
 Some code is removed for privacy conerns.
 * 
 * Author: Anna Mikula, January 2023
 *
 */
namespace ME\Model;

use ME\Core\Model;

class entry_model extends Model
{
    /**
     * Makes sure an int val is said int val.
     * 
     * @param unknown $val
     * @return string|unknown
     */
    public function int_input($val) {
        $val = filter_var($val, FILTER_VALIDATE_INT);
        if ($val === false) {
            return "ERROR";
        }
        return $val;
    }
    
    /**
     * Cleans a string from unwanted chars and html entities.
     * 
     * @param unknown $val
     * @return string|unknown
     */
    public function str_input($val) {
        if (!is_string($val)) {
            return "ERROR";
        } else {
            $val = stripslashes($val);
            $val = strip_tags($val);
            $val = htmlentities($val);
            $val = str_replace('%20',' ',$val);
            $val = str_replace('&amp;','&', $val);
            $val = str_replace('&#039;',"'", $val);
            $val = str_replace('&quot;','"', $val);
            $val = trim($val);
        }
        return $val;
    }
    
    /**
     * This function very simply counts the amount of filters the user has selected
     * within the reports tab for display purposes.
     * 
     * @param arr $search_vals1
     * @param arr $search_vals2
     * @return boolean true if <= 1 filter OR false if > 1 filter
     */
    public function count_filters($search_vals1, $search_vals2){
        $count = 0;
        if($search_vals1 != null){
            foreach ($search_vals1 as $curr_filter_header => $filter_value) {
                if($filter_value != null){
                    $count += 1;
                    if($count > 1){
                        return false;
                    }
                }
            }
        }
        if($search_vals2 != null){
            foreach ($search_vals2 as $curr_filter_header => $filter_value) {
                if($filter_value != null){
                    $count += 1;
                    if($count > 1){
                        return false;
                    }
                }
            }
        }
        return true;
    }
    
    /**
     * This function cleans the given array of data.
     *
     * @param $column_arr the cleaned assosiative array of data
     */
    public function clean_post_vars($column_arr){
        // clean post variables
        $cleaned_arr = $column_arr;
        if($column_arr != null){
            foreach ($column_arr as $curr_header => $curr_value) {
                if (is_string($curr_value)) {
                    $cleaned_arr[$curr_header] = $this->str_input($curr_value);
                } else if (filter_var($curr_value, FILTER_VALIDATE_INT)) {
                    $cleaned_arr[$curr_header] = $this->int_input($curr_value);
                }                
            }
        }
        return $cleaned_arr;
    }
    
    /**
     * This function scripts the output to the html of error or success.
     *
     * @param string $message the message to be outputted
     * @param boolean $is_error true if error message or false if success
     */
    public function output_message($message, $is_error){
        $output_message = "";
        $success_icon = "<i class='fa-regular fa-circle-check fa-shake fa-lg' style='color: green;'></i>";
        if($is_error){
            $output_message .= '<script type="text/javascript">document.getElementById("error_message").style.color = "red";';
            return $output_message . ' document.getElementById("error_message").value = "' . $message . '"</script>';
        } else {
            $output_message .= '<script type="text/javascript">document.getElementById("error_message").style.color = "green";';
            return $output_message . ' document.getElementById("error_message").value = "' . $message . '"</script>';
        }
    }
    
    /**
     * Authorized user
     */
    public function is_authorized_user($username)
    {
       //removed for privacy conerns
    }
    
    
    /**
     * This function fills the table input options for select.
     * 
     * @param string $table_name the table to pull from
     * @param string $type the column name from the table to pull
     * @return $html_statement the htm options to be outputted
     */    
    public function fill_options($table_name, $type){
        $id = $table_name . "_id";
        $value = $table_name . "_" . $type;
        
        $sql = "SELECT * FROM $table_name WHERE `show_row` = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $html_statement = "";
        
        foreach ($result as $row){
            $html_statement .=  "<option value=\"" . $row->$value . "\">"
                . $row->$value . "</option>";
        }
        
        return $html_statement;
    }
    
    /**
     * This function fills the options for select in data entry.
     * 
     * @param string $table_name the table to pull from
     * @param string $type the in
     * @return resultsset
     */
    public function get_websites(){
        $sql = "SELECT * FROM `website` WHERE `show_row` = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return json_encode($query->fetchAll());
    }
    
    /**
     * This function fills the selected maintence view of the database table.
     * 
     * @param string $table_name  the name of the table to be searched
     * @param string $search_val  the value that is being searched through the table rows
     */
    public function fill_maintenance_view($table_name, $search_val, $column_headers){
        $id = $table_name . "_id";
        $search_val = $this->str_input($search_val);
        $html_statement = "";
        
        // if wanting to search a value
        if ($search_val != null) {
            $statement_count = 0;
            $sql = "SELECT * FROM $table_name";
            foreach($column_headers as $curr_header){
                if($statement_count == 0){
                    $sql .= " WHERE ";
                    $statement_count = $statement_count + 1;
                } else {
                    $sql .= " OR ";
                }
                $sql .= " `$curr_header` ";
            }
            $sql .= "LIKE '%$search_val%' AND `show_row` = 1";
        } else {
            $sql = "SELECT * FROM $table_name WHERE `show_row` = 1";
        }
        // build table
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        
        if(($query->rowCount() != 0)){
            $html_statement = "<br/><table class=tb><thead><tr>";
            foreach($result as $row){
                foreach($row as $column_header => $row_value){
                    if($column_header != 'show_row'){
                        if($column_header == $id){
                            $html_statement .= "<th class='th-num'>" . ucwords(str_replace('_', ' ', $column_header)). "</th>";
                        } else {
                            $html_statement .= "<th class='th-long'>" . ucwords(str_replace('_', ' ', $column_header)). "</th>";
                        }
                    }
                }
                break;
            }
            $html_statement .= "</tr></thead><tbody>";
            foreach($result as $row){
                $html_statement .= "<tr>";
                foreach($row as $column_header => $row_value){
                    if($column_header != 'show_row'){
                        $html_statement .= "<td>" . $row_value . "</td>";
                    }
                }
                $html_statement .= "</tr>";
            }
            $html_statement .= "</tbody><table>";
        } 
        
        return $html_statement;
    }
    
    /**
     * This function outputs the OR filter(s) table(s), aka, seperate table for all filters.
     * Used by reports_search();
     * 
     * @param pdo $query the current query to grab row information from
     * @param string $curr_filter_header the current column header aka field name
     * @param string $filter_value the current value to be outputted for that column
     * @param string $filter_type EQUALS or CONTAINS currently are only 2 options
     * @param string $start_date start date of querying
     * @param string $end_date end date of querying
     * @param string $start_age start age from inv form data
     * @param string $end_age end age from inv form data 
     * 
     * @return string the html table to be outputted 
     */
    public function output_separate_report_table($query, $curr_filter_header, $filter_value, $filter_type, $start_date, $end_date, $start_age, $end_age)
    {
        $html_table = "";
        $SYMBOL = "";
        switch($filter_type){
            case 0:
                $SYMBOL = '⊆';
                break;
            case 1:
                $SYMBOL = '=';
                break;
        }
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $html_table .= "<table class=tb id=report>";
            $html_table .= "<thead><tr><th>";
            if($curr_filter_header != null && $filter_value != null){
                $html_table .= ucwords(str_replace('_', ' ', $curr_filter_header)) . " $SYMBOL " . $filter_value;
            }
            if ($start_age != null && $end_age != null) {
                $html_table .= "[Age Range = " . $start_age . " to " . $end_age . "]";
            }
            if ($start_date != null && $end_date != null) {
                $html_table .= "[" . $start_date . " to " . $end_date . "]";
            }
            $html_table .= "</th></tr></thead>";
            $html_table .= "<tbody>";
            foreach ($result as $row) {
                foreach ($row as $row_header => $value) {
                    $html_table .= "<tr><td><a href=" . URL . "DataEntry/open_with_case/$value target='_blank'>" . $value . "</a></td><tr>";
                }
            }
            $html_table .= "<tr><th class=th-count>Count = " . $query->rowCount() . "</th></tr>";
            $html_table .= "</tbody>";
            $html_table .= "</table></br>";
        } else {
            // no results
            $html_table .= "<table class=tb id=report>";
            $html_table .= "<thead><tr><th>";
            if($curr_filter_header != null && $filter_value != null){
                $html_table .= ucwords(str_replace('_', ' ', $curr_filter_header)) . " $SYMBOL " . $filter_value;
            }
            if ($start_age != null && $end_age != null) {
                $html_table .= "[Age Range = " . $start_age . " to " . $end_age . "]";
            }
            if ($start_date != null && $end_date != null) {
                $html_table .= "[" . $start_date . " to " . $end_date . "]";
            }
            $html_table .= "</th></tr></thead>";
            $html_table .= "<tbody>";
            $html_table .= "<tr><th class=th-count>Count = 0</th></tr>";
            $html_table .= "</tbody>";
            $html_table .= "</table></br>";
        }
        return $html_table;
    }
    
    /**
     * This function outputs the OR filter(s) table(s), aka, seperate table for all filters.
     * Used by reports_search();
     *
     * @param pdo $query the current query to grab row information from
     * @param arr $filter_arr the array of column names and values to be outputted
     * @param string $start_date start date of querying
     * @param string $end_date end date of querying
     * @param string $start_age start age from inv form data
     * @param string $end_age end age from inv form data
     *
     * @return string the html table to be outputted
     */
    public function output_all_report_table($query, $filter_arr, $start_date, $end_date, $start_age, $end_age)
    {
        $html_table = "";
        $SYMBOL = "";
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $html_table .= "<table class=tb id=report>";
            $html_table .= "<thead><tr><th>";
            if($filter_arr != null){
                for($i = 0; $i < count($filter_arr); $i++){
                    if($filter_arr[$i][0] != null && $filter_arr[$i][1] != null && $filter_arr[$i][2] != null){
                        $curr_filter_header = $filter_arr[$i][0];
                        $filter_type = $filter_arr[$i][1];
                        $filter_value = $filter_arr[$i][2];
                        switch($filter_type){
                            case 0:
                                $SYMBOL = '⊆';
                                break;
                            case 1:
                                $SYMBOL = '=';
                                break;
                        }
                        $html_table .= "[" . ucwords(str_replace('_', ' ', $curr_filter_header)) . " $SYMBOL " . $filter_value . "]";
                    }
                }
            }
            if ($start_age != null && $end_age != null) {
                $html_table .= "[Age Range = " . $start_age . " to " . $end_age . "]";
            }
            if ($start_date != null && $end_date != null) {
                $html_table .= "[" . $start_date . " to " . $end_date . "]";
            }
            $html_table .= "</th></tr></thead>";
            $html_table .= "<tbody>";
            foreach ($result as $row) {
                foreach ($row as $row_header => $value) {
                    $html_table .= "<tr><td><a href=" . URL . "DataEntry/open_with_case/$value target='_blank'>" . $value . "</a></td><tr>";
                }
            }
            $html_table .= "<tr><th class=th-count>Count = " . $query->rowCount() . "</th></tr>";
            $html_table .= "</tbody>";
            $html_table .= "</table></br>";
        } else {
            $html_table .= "<table class=tb id=report>";
            $html_table .= "<thead><tr><th>";
            if($filter_arr != null){
                for($i = 0; $i < count($filter_arr); $i++){
                    if($filter_arr[$i][0] != null && $filter_arr[$i][1] != null && $filter_arr[$i][2] != null){
                        $curr_filter_header = $filter_arr[$i][0];
                        $filter_type = $filter_arr[$i][1];
                        $filter_value = $filter_arr[$i][2];
                        switch($filter_type){
                            case 0:
                                $SYMBOL = '⊆';
                                break;
                            case 1:
                                $SYMBOL = '=';
                                break;
                        }
                        $html_table .= "[" . ucwords(str_replace('_', ' ', $curr_filter_header)) . " $SYMBOL " . $filter_value . "]";
                    }
                }
            }
            if ($start_age != null && $end_age != null) {
                $html_table .= "[Age Range = " . $start_age . " to " . $end_age . "]";
            }
            if ($start_date != null && $end_date != null) {
                $html_table .= "[" . $start_date . " to " . $end_date . "]";
            }
            $html_table .= "</th></tr></thead>";
            $html_table .= "<tbody>";
            $html_table .= "<tr><th class=th-count>Count = 0</th></tr>";
            $html_table .= "</tbody>";
            $html_table .= "</table></br>";
        }
        return $html_table;
    }

    /**
     * This function builds the sql that the user requests for the reports tab.
     * 
     * This is used by reports/index.php
     * Found under the Reports tab -> Create Report
     * 
     * @param string $table_name      the table being queried
     * @param 2d arr $filter_arr      the filters and values user wants
     * @param string $start_date      the start date of query, if selected
     * @param string $end_date        the end date of query, if selected
     * @param string $start_age       the start age of query, if selected 
     * @param string $end_age         the end age of query, if selected
     * @param bool $is_separate       the tables are separated, if desired
     * 
     * @return string              the html table(s) to be outputted
     */
    public function reports_search($table_name, $filter_arr, $start_date, $end_date, $start_age, $end_age, $is_separate)
    {
        // clean inputted variables
        for($i = 0; $i < count($filter_arr); $i++){
            for($j = 0; $j < count($filter_arr[$i]); $j++){
                $filter_arr[$i][$j] = $this->str_input($filter_arr[$i][$j]);
            }
        }
        
        if($start_date != null) {
            $start_date = $this->str_input($start_date);
        }
        if($end_date != null) {
            $end_date = $this->str_input($end_date);
        }
        if($start_age != null) {
            $start_age = $this->str_input($start_age);
        }
        if($end_age != null) {
            $end_age = $this->str_input($end_age);
        }
        
        // basic vars used for outputting purposes
        $html_table = "";
        $year_val = substr(Date('YY'), -2);
        
        // if user wants all filters in their own table, or if there is naturally only one filter
        if($is_separate || count($filter_arr) == 1 || $filter_arr == null){
            $is_separate = 1;
            if($filter_arr != null){
                for($i = 0; $i < count($filter_arr); $i++){
                    $sql = '';
                    if($filter_arr[$i][0] != null && $filter_arr[$i][1] != null && $filter_arr[$i][2] != null){
                        $curr_filter_header = $filter_arr[$i][0];
                        $filter_type = $filter_arr[$i][1];
                        $filter_value = $filter_arr[$i][2];
                        switch($filter_value){
                            case 'true':
                                $filter_value = '1';
                                break;
                            case 'false':
                                $filter_value = '0';
                                break;
                        }
                        switch($filter_type){
                            case 0:
                                $SYMBOL = "LIKE '%$filter_value%'";
                                break;
                            case 1:
                                $SYMBOL = "= '$filter_value'";
                                break;
                        }
                        if ($start_date != null && $end_date != null && $table_name == 'data_entry_case') {
                            $sql = "SELECT DISTINCT";
                            if ($start_age != null && $end_age != null) {
                                $sql .= " $table_name.`case_number` FROM $table_name, `data_entry_inv_form`";
                                $sql .= " WHERE (`data_entry_inv_form`.`decedent_age_noninfant` >= '$start_age' AND  `data_entry_inv_form`.`decedent_age_noninfant` <= '$end_age')";
                                $sql .= " AND $table_name.`$curr_filter_header` $SYMBOL";
                                $sql .= " AND (`data_entry_case`.`date_reported` >= '$start_date' AND `data_entry_case`.`date_reported` <= '$end_date')";
                                $sql .= " AND ($table_name.`case_number` = `data_entry_inv_form`.`case_number`)";
                                $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                                $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
                            } else {
                                $sql .= " `case_number` FROM $table_name";
                                $sql .= " WHERE `$curr_filter_header` $SYMBOL";
                                $sql .= " AND (`date_reported` >= '$start_date' AND `date_reported` <= '$end_date')";
                                $sql .= " AND `case_number` LIKE '$year_val%'";
                                $sql .= " ORDER BY length(`case_number`), `case_number`";
                            }
                        } else if ($start_date != null && $end_date != null) {
                            $sql = "SELECT DISTINCT $table_name.`case_number` FROM $table_name, `data_entry_case`";
                            if ($start_age != null && $end_age != null) {
                                $sql .= ", `data_entry_inv_form`";
                                $sql .= " WHERE (`data_entry_inv_form`.`decedent_age_noninfant` >= '$start_age' AND  `data_entry_inv_form`.`decedent_age_noninfant` <= '$end_age')";
                                $sql .= " AND $table_name.`$curr_filter_header` $SYMBOL";
                            } else {
                                $sql .= " WHERE $table_name.`$curr_filter_header` $SYMBOL";
                            }
                            $sql .= " AND (`data_entry_case`.`date_reported` >= '$start_date' AND `data_entry_case`.`date_reported` <= '$end_date')";
                            $sql .= " AND ($table_name.`case_number` = `data_entry_case`.`case_number`)";
                            $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                            $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
                        } else {
                            $sql = "SELECT DISTINCT";
                            if ($start_age != null && $end_age != null && $table_name == 'data_entry_inv_form') {
                                $sql .= " `case_number` FROM $table_name, `data_entry_inv_form`";
                                $sql .= " WHERE (`decedent_age_noninfant` >= '$start_age' AND `decedent_age_noninfant` <= '$end_age')";
                                $sql .= " AND `$curr_filter_header` $SYMBOL";
                                $sql .= " AND (`case_number` = `case_number`)";
                                $sql .= " AND `case_number` LIKE '$year_val%'";
                                $sql .= " ORDER BY length(`case_number`), `case_number`";
                            } else  if ($start_age != null && $end_age != null) {
                                $sql .= " $table_name.`case_number` FROM $table_name, `data_entry_inv_form`";
                                $sql .= " WHERE (`data_entry_inv_form`.`decedent_age_noninfant` >= '$start_age' AND  `data_entry_inv_form`.`decedent_age_noninfant` <= '$end_age')";
                                $sql .= " AND $table_name.`$curr_filter_header` $SYMBOL";
                                $sql .= " AND ($table_name.`case_number` = `data_entry_inv_form`.`case_number`)";
                                $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                                $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
                            } else {
                                $sql .= " `case_number` FROM $table_name";
                                $sql .= " WHERE `$curr_filter_header` $SYMBOL";
                                $sql .= " AND `case_number` LIKE '$year_val%'";
                                $sql .= " ORDER BY length(`case_number`), `case_number`";
                            }
                        }
                        $query = $this->db->prepare($sql);
                        $query->execute();
                        $html_table .= $this->output_separate_report_table($query, $curr_filter_header, $filter_value, $filter_type, $start_date, $end_date, $start_age, $end_age);
                    }
                }
            } else {
                if($start_date != null && $end_date != null && $start_age != null && $end_age != null){
                    $sql = "SELECT DISTINCT `data_entry_case`.`case_number` FROM `data_entry_case`, `data_entry_inv_form`";
                    $sql .= " WHERE (`data_entry_case`.`date_reported` >= '$start_date' AND `data_entry_case`.`date_reported` <= '$end_date')";
                    $sql .= " AND (`data_entry_inv_form`.`decedent_age_noninfant` >= '$start_age' AND `data_entry_inv_form`.`decedent_age_noninfant` <= '$end_age')";
                    $sql .= " AND (`data_entry_case`.`case_number` = `data_entry_inv_form`.`case_number`)";
                    $sql .= " AND `data_entry_case`.`case_number` LIKE '$year_val%'";
                    $sql .= " ORDER BY length(`data_entry_case`.`case_number`), `data_entry_case`.`case_number`";
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $html_table .= $this->output_separate_report_table($query, '', '', '', $start_date, $end_date, $start_age, $end_age);
                } else if($start_date != null && $end_date != null){
                    $sql = "SELECT DISTINCT `case_number` FROM `data_entry_case`";
                    $sql .= " WHERE (`date_reported` >= '$start_date' AND `date_reported` <= '$end_date')";
                    $sql .= " AND `case_number` LIKE '$year_val%'";
                    $sql .= " ORDER BY length(`case_number`), `case_number`";
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $html_table .= $this->output_separate_report_table($query, '', '', '', $start_date, $end_date, $start_age, $end_age);
                } else if($start_age != null && $end_age != null){
                    $sql = "SELECT `case_number` FROM `data_entry_inv_form`";
                    $sql .= " WHERE (`decedent_age_noninfant` >= '$start_age' AND `decedent_age_noninfant` <= '$end_age')";
                    $sql .= " AND `case_number` LIKE '$year_val%'";
                    $sql .= " ORDER BY length(`case_number`), `case_number`";
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $html_table .= $this->output_separate_report_table($query, '', '', '', $start_date, $end_date, $start_age, $end_age);
                }
            }
        } else {
            //ALL FILTERS APPLIED
            $is_separate = 0;
            $sql_statement_index = 0;
            $sql = "SELECT DISTINCT";
            if($start_date != null && $end_date != null && $start_age != null && $end_age != null){
                if($table_name == 'data_entry_case' || $table_name == 'data_entry_inv_form'){
                    $sql .= " $table_name.`case_number` FROM `data_entry_case`, `data_entry_inv_form`";
                } else {
                    $sql .= " $table_name.`case_number` FROM $table_name, `data_entry_case`, `data_entry_inv_form`";
                }
            } else if($start_date != null && $end_date != null && $table_name == 'data_entry_case'){
                $sql .= " `case_number` FROM `data_entry_case`";
            } else if ($start_age != null && $end_age != null && $table_name == 'data_entry_inv_form'){
                $sql .= " `case_number` FROM `data_entry_inv_form`";
            } else if($start_date != null && $end_date != null){
                $sql .= " $table_name.`case_number` FROM $table_name, `data_entry_case`";
            } else if ($start_age != null && $end_age != null){
                $sql .= " $table_name.`case_number` FROM $table_name, `data_entry_inv_form`";
            } else {
                $sql .= " $table_name.`case_number` FROM $table_name";
            }
            
            for($i = 0; $i < count($filter_arr); $i++){
                if($filter_arr[$i][0] != null && $filter_arr[$i][1] != null && $filter_arr[$i][2] != null){
                    $curr_filter_header = $filter_arr[$i][0];
                    $filter_type = $filter_arr[$i][1];
                    $filter_value = $filter_arr[$i][2];
                    switch($filter_value){
                        case 'true':
                            $filter_value = '1';
                            break;
                        case 'false':
                            $filter_value = '0';
                            break;
                    }
                    switch($filter_type){
                        case 0:
                            $SYMBOL = "LIKE '%$filter_value%'";
                            break;
                        case 1:
                            $SYMBOL = "= '$filter_value'";
                            break;
                    }
                    if ($sql_statement_index == 0) {
                        $sql .= " WHERE (";
                        $sql_statement_index = $sql_statement_index + 1;
                    } else {
                        $sql .= " AND (";
                    }
                    if (filter_var($filter_value, FILTER_VALIDATE_INT)) {
                        $sql .= "$table_name.`$curr_filter_header` = $filter_value)";
                    } else {
                        $sql .= "$table_name.`$curr_filter_header` $SYMBOL)";
                    }
                }
            }
            // get proper filters 
            if ($start_date != null && $end_date != null && $table_name == 'data_entry_case') {
                 $sql .= " AND (`date_reported` >= '$start_date' AND `date_reported` <= '$end_date')";
            } else if($start_date != null && $end_date != null){
                $sql .= " AND (`data_entry_case`.`date_reported` >= '$start_date' AND `data_entry_case`.`date_reported` <= '$end_date')";
            }
            
            if($start_age != null && $end_age != null && $table_name == 'data_entry_inv_form'){
                $sql .= " AND (`decedent_age_noninfant` >= '$start_age' AND `decedent_age_noninfant` <= '$end_age')";
            } else if($start_age != null && $end_age != null){
                $sql .= " AND (`data_entry_inv_form`.`decedent_age_noninfant` >= '$start_age' AND `data_entry_inv_form`.`decedent_age_noninfant` <= '$end_age')";
            }
            
            // get correct ending
            if($start_date != null && $end_date != null && $start_age != null && $end_age != null){
                $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
            } else if($start_date != null && $end_date != null && $table_name == 'data_entry_case'){
                $sql .= " AND `case_number` LIKE '$year_val%'";
                $sql .= " ORDER BY length(`case_number`), `case_number`";
            } else if ($start_age != null && $end_age != null && $table_name == 'data_entry_inv_form'){
                $sql .= " AND `case_number` LIKE '$year_val%'";
                $sql .= " ORDER BY length(`case_number`), `case_number`";
            } else if($start_date != null && $end_date != null){
                $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
            } else if ($start_age != null && $end_age != null){
                $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
            } else {
                $sql .= " AND $table_name.`case_number` LIKE '$year_val%'";
                $sql .= " ORDER BY length($table_name.`case_number`), $table_name.`case_number`";
            }
            
            $query = $this->db->prepare($sql);
            $query->execute();
            $html_table .= $this->output_all_report_table($query, $filter_arr, $start_date, $end_date, $start_age, $end_age);
        }
        return $html_table;
    }
    
    /**
     * This function fills the input field(s) for reports reports/index.php
     *
     * @return arr of html <options>
     */
    public function get_input_fields(){
        $table_name = $_POST['table_name'];
        $filter_id = $_POST['filter_id'];
        $html_options = ["<option id='select' selected disabled hidden>Select</option>"];
        $i = 1;
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$table_name'";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            foreach ($result as $row) {
                foreach ($row as $row_header => $value) {
                    if($value != 'case_number'){
                        $html_options[$i] = "<option id='option_value" . $filter_id . "' value='" . $value ."'>" . ucwords(str_replace('_', ' ', $value)) . "</option>";
                        $i += 1;
                    }
                }
            }
        }
        
        return json_encode($html_options);
    }
    
    /**
     * This function fills the placeholder for the input field for reports reports/index.php
     *
     * @return arr of strings with the data type associated with the column name
     */
    public function get_text_placeholder(){
        $table_name = $_POST['table_name'];
        $filter_id = $_POST['filter_id'];
        $text_options = [];
        $i = 0;
        
       //removed for privacy conerns
        $query = $this->db->prepare($sql);
        $query->execute();
        
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            foreach ($result as $row) {
                foreach ($row as $row_header => $value) {
                    if($value != 'case_number'){
                        $text_options[$i] = $value;
                        $i += 1;
                    }
                }
            }
        }
        
        $i = 0;
       //removed for privacy conerns
        $query = $this->db->prepare($sql);
        $query->execute();
        
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            foreach ($result as $row) {
                foreach ($row as $row_header => $value) {
                    if($value != 'varchar'){
                        $text_options[$i] = [$text_options[$i], $value];
                        $i += 1;
                    }
                }
            }
        }
        
        return json_encode($text_options);
    }

    /**
     * This function gets the requested document tracking reports, specially made for JeffCo.
     * 
     * @return the output table of requested records
     */
    public function get_requested_records()
    {
        $year_val = substr(Date('YY'), -2);
        $sql = "SELECT CONCAT_WS(', ', `case_number`, `doc_title`, `event_date`, `party_name`) AS `document` FROM `data_entry_document_tracking`";
        $sql .= " WHERE `status_options` = 'Requested'";
        $sql .= " AND `case_number` LIKE '$year_val%'";
        $sql .= " ORDER BY length(`case_number`), `case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $this->output_separate_report_table($query, 'Status', 'Requested', 1, '', '', '', '');
    }
    
    /**
     * This function allows easy query-ing of 3 cause matter inputs, specially made for JeffCo.
     * 
     * @return the output table of the searched cause/manner/other fields
     */
    public function get_cause_manner()
    {
        $year_val = substr(Date('YY'), -2);
        $input = $this->str_input($_POST['user_input']);
        $sql = "SELECT CONCAT_WS(', ', `case_number`, `cause_of_death`, `due_to`, `cause_of_death_other`) AS `full_cause` FROM `data_entry_cause_manner`";
        $sql .= " WHERE (`cause_of_death` LIKE '%$input%' OR `due_to` LIKE '%$input%' OR `cause_of_death_other` LIKE '%$input%')";
        $sql .= " AND `case_number` LIKE '$year_val%'";
        $sql .= " ORDER BY length(`case_number`), `case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $this->output_separate_report_table($query, 'Cause/Manner', $input, 0, '', '', '', '');
    }
    
    /**
     * This function search and fills form from case number by form type. 
     * Uses js function fill_form_details().
     *
     * @return arr of data associated with the case num to fill form with.
     */
    public function search_db(){
        $case_num = $this->str_input($_POST['case_number']);
        $table_name = $this->str_input($_POST['table_name']);
        
        // make sure base case exists
        $sql = "SELECT * FROM `data_entry_case` WHERE `case_number` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$case_num]);
        if($query->rowCount() == 0){
            return json_encode("CASE #$case_num DOES NOT EXIST : ADD CASE");
        } else {
            if($table_name == 'data_entry_narrative'){
                $sql = "SELECT data_entry_narrative.`case_number`,
                data_entry_supp_report.`doc_num`, data_entry_narrative.`narrative`,
                data_entry_supp_report.`supp_text` FROM data_entry_narrative, data_entry_supp_report
                WHERE (data_entry_narrative.`case_number` = ?)
                AND (data_entry_supp_report.`case_number` = ?)";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num, $case_num]);
                if($query->rowCount() == 0){
                    $sql = "SELECT * FROM data_entry_narrative WHERE data_entry_narrative.`case_number` = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$case_num]);
                }
            } else {
                $sql = "SELECT * FROM $table_name WHERE `case_number` = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num]);
            }
            if($query->rowCount() == 0){
                //CASE #$case_num EXISTS : FILE NOT YET STARTED"
                return json_encode("CASE #$case_num EXISTS : FILE NOT YET STARTED");
            } else {
                return json_encode($query->fetchAll());
            }
        } 
    } 
    
    /**
     * Used by home to print full case with all started files.
     * 
     * @param string $case_num
     * @param string $table_name
     */
    public function search_for_print_full_case($case_num, $table_name){
        // make sure it exists and they didn't just bypass the case insert
        $sql = "SELECT * FROM `data_entry_case` WHERE `case_number` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$case_num]);
        if($query->rowCount() == 0){
            return 1;
        } else {
            $sql = "SELECT * FROM $table_name WHERE `case_number` = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$case_num]);
        }
        //return to controller
        if($query->rowCount() == 0){
            return 1;
        } else {
            return $query->fetchAll();
        }
    }
    
    /**
     * This function searches for data for printing for data entry tabs.
     * Called by DataEntryController/print_page().
     * 
     * @param string $case_num
     * @param string $table_name
     * @return arr of the data to print that speciic data table for that case OR 1 if null
     */
    public function search_for_print($case_num, $table_name){
        // make sure it exists and they didn't just bypass the case insert
        $sql = "SELECT * FROM `data_entry_case` WHERE `case_number` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$case_num]);
        
        if($query->rowCount() == 0){
            return 1;
        } else {
            if($table_name == 'data_entry_inv_form'){
                // HAS INV_FORM, NARRATIVE, AND SUPP REPORT?
                $sql = "SELECT * FROM data_entry_inv_form, data_entry_case, data_entry_narrative, data_entry_supp_report";
                $sql .= " WHERE `data_entry_inv_form`.`case_number` = ? AND `data_entry_case`.`case_number` = ? AND `data_entry_narrative`.`case_number` = ? AND `data_entry_supp_report`.`case_number` = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num, $case_num, $case_num, $case_num]);
                if($query->rowCount() == 0){
                    // HAS INV_FORM AND NARRATIVE?
                    $sql = "SELECT * FROM data_entry_inv_form, data_entry_case, data_entry_narrative";
                    $sql .= " WHERE `data_entry_inv_form`.`case_number` = ? AND `data_entry_case`.`case_number` = ? AND `data_entry_narrative`.`case_number` = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$case_num, $case_num, $case_num]);
                    if($query->rowCount() == 0){
                        // HAS INV_FORM?
                        $sql = "SELECT * FROM data_entry_inv_form, data_entry_case";
                        $sql .= " WHERE `data_entry_inv_form`.`case_number` = ? AND `data_entry_case`.`case_number` = ?";
                        $query = $this->db->prepare($sql);
                        $query->execute([$case_num, $case_num]);
                    }
                }
                // HAS NARRATIVE AND SUPP_REPORT?
            } else if($table_name == 'data_entry_narrative'){
                $sql = "SELECT * FROM data_entry_narrative, data_entry_supp_report WHERE `data_entry_narrative`.`case_number` = ? AND `data_entry_supp_report`.`case_number` = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num, $case_num]);
                // HAS NARRATIVE?
                if($query->rowCount() == 0){
                    $sql = "SELECT * FROM data_entry_narrative WHERE `data_entry_narrative`.`case_number` = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$case_num]);
                    // HAS SUPP REPORT?
                    if($query->rowCount() == 0){
                        $sql = "SELECT * FROM data_entry_supp_report WHERE `data_entry_supp_report`.`case_number` = ?";
                        $query = $this->db->prepare($sql);
                        $query->execute([$case_num]);
                    }
                }
            } else {
                $sql = "SELECT * FROM $table_name WHERE `case_number` = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num]);
            }
            //return to controller
            if($query->rowCount() == 0){
                return 1;
            } else {
                return $query->fetchAll();
            }
        }
    }

     /**
     * This function inserts and updates("saves") "changing" db forms in data entry.
     * Indexes or inserts by: (case_number, doc_num)
     * 
     * @param $table_name  the tabe to be inserted into
     * @param $case_num  the case number to update/insert
     * @param $column_arr   the assosiative array of data values as "column_header" => $new_value
     */
    public function insert_changing_db($table_name, $case_num, $column_arr)
    {
        $case_num = $this->str_input($case_num);
        $column_arr = $this->clean_post_vars($column_arr);
        $doc_num = $column_arr['doc_num'];
        if($doc_num == 0){
            return $this->output_message("", true);
        }
        
        $sql = "SELECT * FROM `data_entry_case` WHERE `case_number` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$case_num]);
        
        if ($query->rowCount() == 0) {
            echo $this->output_message("DOES NOT EXIST", true);
        } else {
            $sql = "SELECT * FROM $table_name WHERE `case_number` = ? AND `doc_num` = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$case_num, $doc_num]);
            if ($query->rowCount() == 0) {
                $sql = "INSERT INTO $table_name (`case_number`, `doc_num`) VALUES (?, ?)";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num, $doc_num]);
            }
            foreach ($column_arr as $column_header => $value) {
                if ($value != null) {
                    $sql = "UPDATE $table_name SET $column_header = ? WHERE `case_number` = ? AND `doc_num` = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$value, $case_num, $doc_num]);
                }
            }
            // this output of table name expects the format: data_entry_<table_name>
            $user_table_name = explode('_', $table_name);
            $outputtable = "";
            for ($i = 2; $i < count($user_table_name); $i ++) {
                $outputtable = $outputtable . strtoupper($user_table_name[$i]) . " ";
            }
            echo $this->output_message("SAVED", false);
        }
    }
    
    /**
     * This function inserts and updates("saves") forms in data entry.
     * 
     * Indexes or inserts by: (case_number)
     *      
     * @param $table_name  the tabe to be inserted into
     * @param $case_num  the case number to update/insert
     * @param $column_arr   the assosiative array of data values as "column_header" => $new_value
     */
    public function insert_db($table_name, $case_num, $column_arr){
        $case_num = $this->str_input($case_num);
        $column_arr = $this->clean_post_vars($column_arr);
        $sql = "SELECT * FROM `data_entry_case` WHERE `case_number` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$case_num]);
        
        // if return is empty
        if($query->rowCount() == 0){
            // if return is empty but it is for inserting a new case
            if($table_name == 'data_entry_case'){
                $sql = "INSERT INTO $table_name (`case_number`) VALUES (?)";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num]);
                foreach($column_arr as $column_header => $value){
                    if($value != null){
                        $sql = "UPDATE $table_name SET $column_header = ? WHERE `case_number` = ?";
                        $query = $this->db->prepare($sql);
                        $query->execute([$value, $case_num]);
                        echo $this->output_message("ADDED", false); 
                    }
                }
            } 
         // else, case exists, now check if file for case exists
        } else {
            $sql = "SELECT * FROM $table_name WHERE `case_number` = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$case_num]);
            if($query->rowCount() == 0){
                $sql = "INSERT INTO $table_name (`case_number`) VALUES (?)";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num]);
            } 
            foreach($column_arr as $column_header => $value){
                if($value != null){
                    $sql = "UPDATE $table_name SET $column_header = ? WHERE `case_number` = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$value, $case_num]);
                }
            }
            echo $this->output_message("SAVED", false); 
        }
    }
    
    /**
     * This function inserts and updates("saves") checkboxes
     *
     * Indexes or inserts by: (case_number)
     *
     * @param $table_name  the tabe to be inserted into
     * @param $case_num  the case number to update/insert
     * @param $column_arr   the assosiative array of data values as "checkbox_id" => $new_value
     */
    public function update_checkbox(){
        $table_name = $_POST['table_name']; // set by me, no need to clean
        $case_num = $_POST['case_num']; // set by me, no need to clean
        $column_arr = $_POST['column_arr']; // set by me, no need to clean
        
        // make sure the case exists
        $sql = "SELECT * FROM `data_entry_case` WHERE `case_number` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$case_num]);
        // if return is empty, return case num does not exist
        if($query->rowCount() == 0){
            return 1;
        // else, case exists, now check if file for case exists
        } else {
            // check if this is the start of a new file
            $sql = "SELECT * FROM $table_name WHERE `case_number` = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$case_num]);
            // if so, new file created
            if($query->rowCount() == 0){
                $sql = "INSERT INTO $table_name (`case_number`) VALUES (?)";
                $query = $this->db->prepare($sql);
                $query->execute([$case_num]); 
            }
            // update/add new values to the file for the case num
            foreach($column_arr as $column_header => $value){
                if($value != null){
                    $sql = "UPDATE $table_name SET `$column_header` = ? WHERE `case_number` = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$value, $case_num]); 
                }
            }
            return 0;
        }
    }
    
    /**
     * This function inserts a row into the specified table in maintenance.
     * 
     * @param $table_name  the maintenance table to add a row to
     * @param $add_vals  array of values to be added as ["column_name" => add_value]
     */
    public function add_row($table_name, $add_vals){ 
        $table_id = $table_name . "_id";
        // get next table id
        $sql = "SELECT MAX(`$table_id`) + 1 AS new_table_id FROM $table_name";
        $query = $this->db->prepare($sql);
        $query->execute();
        $results = $query->fetch();
        $new_table_id = $results->new_table_id;
        
        //insert into database
        $sql = "INSERT INTO $table_name (`$table_id`) VALUES ($new_table_id)";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // update specified row and column
        foreach($add_vals as $column_header => $updated_value){
            if($updated_value != null){
                $sql = "UPDATE $table_name SET `$column_header` = ? WHERE $table_id = $new_table_id";
                $query = $this->db->prepare($sql);
                $query->execute([$this->str_input($updated_value)]);
            }
        }
     }
     
    /**
     * This function updates the specified row for the user in maintenance.
     * 
     * @param $table_name  the maintenance table to update a row of
     * @param $row_id  the id of the row to update
     * @param $updated_vals  the updated values for the row as ["column_name" => updated_value]
     */
     public function update_row($table_name, $row_id, $updated_vals){
        $table_id = $table_name . "_id";
        $updated_vals = $this->clean_post_vars($updated_vals);
        if($updated_vals != null){
            foreach($updated_vals as $column_header => $updated_value){
                if($updated_value != null){
                    $sql = "UPDATE $table_name SET $column_header = ? WHERE $table_id = ?";
                    $query = $this->db->prepare($sql);
                    $query->execute([$updated_value, $row_id]);
                }
            }
        }
    }
    
    /**
     * This function hides the specified row, aka "deleting" the row to the user. 
     * 
     * The row cannot be deleted actually since the row may be referenced in another 
     * table. Therefore, "show_row" is set to 0 to hide it from outputting to the 
     * user. 
     * 
     * @param $table_name  the maintenance table to "delete"
     * @param $row_id  the row to hide from user view in the table
     */
    public function delete_row($table_name, $row_id){
        $table_id = $table_name . "_id";
        $sql = "UPDATE $table_name SET `show_row` = 0 WHERE $table_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$row_id]);
    }
    
    /**
     * This function will fill the today todo list for the user.
     * Used to fill home todo list.
     */
    public function todo_list(){
        $date = $_POST['date']; //passed by me
        $today = date("j M Y");
        
        // update todo to have uncompleted tasks moved to today if necessary
        $sql = "SELECT * FROM `todo_list` WHERE `todays_date` < ? AND `completed` = 0";
        $query = $this->db->prepare($sql);
        $query->execute([$today]);
        if($query->rowCount() != 0){
            $new_task_num = 1;
            $task_num_sql = "SELECT MAX(`task_num`) AS 'MAX_TASK' FROM `todo_list` WHERE `todays_date` = '$today'";
            $task_num_query = $this->db->prepare($task_num_sql);
            $task_num_query->execute([$today]);
            if($task_num_query->rowCount() != 0){
                $task_num_max = $task_num_query->fetchAll();
                $new_task_num = $task_num_max[0]->MAX_TASK == null ? 1 : $task_num_max[0]->MAX_TASK + 1;
            }
            $result = $query->fetchAll();
            foreach ($result as $row) {
                //insert into today as incomplete
                $sql = "INSERT INTO `todo_list` (`todays_date`, `task_num`, `task`, `completed`) VALUES (?, ?, ?, ?)";
                $query = $this->db->prepare($sql);
                $query->execute([$today, $new_task_num, $row->task, 0]);
                $new_task_num += 1;
                
                //update as complete for yesterday
                $sql = "UPDATE `todo_list` SET `completed` = 1 WHERE `todays_date` = ? AND `task_num` = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$row->todays_date, $row->task_num]);
            }
        }
        $sql = "SELECT * FROM `todo_list` WHERE `todays_date` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$date]);
        if($query->rowCount() == 0){
            return json_encode(0);
        } else {
            return json_encode($query->fetchAll());
        }
    }
    
    /**
     * This function will save the today todo list for the user.
     * Saves the current task and then outputs the new home via js.
     */
    public function save_task()
    {
        $task = $this->str_input($_POST['task']);
        $date = $_POST['date']; //sent by me
        $task_num = $_POST['task_num']; //sent by me
        $completed = $_POST['completed']; //sent by me
        $table_name = 'todo_list';
        $column_arr = [
            "task" => $task,
            "completed" => $completed 
        ];

        $sql = "SELECT * FROM $table_name WHERE `todays_date` = ? AND `task_num` = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$date, $task_num]);
        if ($query->rowCount() == 0) {
            $sql = "INSERT INTO $table_name (`todays_date`, `task_num`) VALUES (?, ?)";
            $query = $this->db->prepare($sql);
            $query->execute([$date, $task_num]);
        }
        foreach ($column_arr as $column_header => $value) {
            if ($value != null) {
                $sql = "UPDATE $table_name SET $column_header = ? WHERE `todays_date` = ? AND `task_num` = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$value, $date, $task_num]);
            }
        }
        return 0; //success
    }
    
    /*
     * Gets all the files for the case number for viewing purposes.
     * Changes color of tab if that case has that file started in js.
     */
    public function get_active_case_files(){
        // grab post variables 
        $case_num = $this->str_input($_POST['case_num']);
        $table_names = [
            'data_entry_cause_manner' => 0,
            'data_entry_cremation_view' => 0,
            'data_entry_disinterment_release' => 0,
            'data_entry_document_tracking' => 0,
            'data_entry_embalm_permit' => 0,
            'data_entry_evidence' => 0,
            'data_entry_inv_form' => 0,
            'data_entry_medication_inventory' => 0,
            'data_entry_narrative' => 0
        ];
        foreach($table_names as $curr_table => $is_active){
            $sql = "SELECT * FROM $curr_table WHERE `case_number` = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$case_num]);
            // if return is empty, return case num does not exist
            if($query->rowCount() != 0){
               $table_names[$curr_table] = 1;
            }
        }
        return json_encode($table_names);
    }
    
    /*
     * Grabs SPECIFIC case for home.
     * Can search for even a past year case here, does not matter.
     */
    public function search_cases(){
        $search_case = $this->str_input($_POST['case_num']);
        $year_val = substr(Date('YY'), -2);
        $html_table = "";
        
        // all cases start with curr year ex. 23-000
        if($search_case == null){
            $sql = "SELECT `case_number` FROM `data_entry_case` WHERE `case_number` LIKE '$year_val%' ORDER BY length(`case_number`), `case_number` DESC";
            $search_case = Date('Y');
        } else {
            $sql = "SELECT `case_number` FROM `data_entry_case` WHERE `case_number` LIKE '%$search_case%' ORDER BY length(`case_number`), `case_number` DESC";
        }
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // if return is empty, return case num does not exist
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $html_table .= "<table class=tb id=case_table>";
            $html_table .= "<thead><tr><th>";
            $html_table .= "CASE RESULTS FOR " . $search_case;
            $html_table .= "</th>";
            $html_table .= "</tr></thead>";
            $html_table .= "<tbody>";
            foreach ($result as $row) {
                $html_table .= "<tr>";
                foreach ($row as $row_header => $value) {
                    $html_table .= "<td><a href=" . URL . "DataEntry/open_with_case/$value>" . $value . "</a>";
                    $html_table .= " <a id='" . $value . "' class='case_print_all_button' href='" . URL ."/Home/print_entire_case/". $value ."' target='_blank'><b><i class='fa fa-solid fa-print'></i></b></a</td>";
                }
                $html_table .= "<tr>";
            }
            $html_table .= "<tr><th class=th-count>Count = " . $query->rowCount() . "</th></tr>";
            $html_table .= "</tbody>";
            $html_table .= "</table></br>";
            return $html_table;
        } else {
            // no results
            $html_table .= "<table class=tb id=case_table>";
            $html_table .= "<thead><tr>";
            $html_table .= "<th>";
            $html_table .= "NO CASES EXIST";
            $html_table .= "</th>";
            $html_table .= "</th></tr></thead>";
            $html_table .= "<tbody>";
            $html_table .= "<tr><th class=th-count>Count = 0</th></tr>";
            $html_table .= "</tbody>";
            $html_table .= "</table></br>";
            return $html_table;
        }
        return 1; //unknown error
    }
    
    /**
     * This function builds the ANNUAL report statistics to date.
     * This is the last function of this ME entry_model.
     * 
     * @return string of all the annual table statistics
     */
    public function get_report()
    {
        $year = date("Y");
        
        // Monthly Case Totals
        $months = [
            'JAN' => $year . '-01-01',
            'FEB' => $year . '-02-01',
            'MAR' => $year . '-03-01',
            'APR' => $year . '-04-01',
            'MAY' => $year . '-05-01',
            'JUN' => $year . '-06-01',
            'JUL' => $year . '-07-01',
            'AUG' => $year . '-08-01',
            'SEP' => $year . '-09-01',
            'OCT' => $year . '-10-01',
            'NOV' => $year . '-11-01',
            'DEC' => $year . '-12-01',
            'JAN_START' => $year - 1 . '-12-31',
            'FEB_START' => $year . '-01-31',
            'MAR_START' => ($year % 4 == 0) && ($year % 100 == 0 && $year % 400 == 0) ? $year . '-02-29' : $year . '-02-28',
            'APR_START' => $year . '-03-31',
            'MAY_START' => $year . '-04-30',
            'JUN_START' => $year . '-05-31',
            'JUL_START' => $year . '-06-30',
            'AUG_START' => $year . '-07-31',
            'SEP_START' => $year . '-08-31',
            'OCT_START' => $year . '-09-30',
            'NOV_START' => $year . '-10-31',
            'DEC_START' => $year . '-11-30',
            'JAN_FINISH' => $year + 1 . '-01-01'
        ];
        
        // JAN
        $JAN_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'JAN' FROM `data_entry_case` WHERE `date_reported` >'" . $months['JAN_START'] . "' AND `date_reported` < '" . $months['FEB'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $JAN_COUNT = $result[0]->JAN;
        }
        
        // FEB
        $FEB_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'FEB' FROM `data_entry_case` WHERE `date_reported` >'" . $months['FEB_START'] . "' AND `date_reported` < '" . $months['MAR'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $FEB_COUNT = $result[0]->FEB;
        }
        
        // MAR
        $MAR_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'MAR' FROM `data_entry_case` WHERE `date_reported` >'" . $months['MAR_START'] . "' AND `date_reported` < '" . $months['APR'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $MAR_COUNT = $result[0]->MAR;
        }
        
        // APR
        $APR_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'APR' FROM `data_entry_case` WHERE `date_reported` >'" . $months['APR_START'] . "' AND `date_reported` < '" . $months['MAY'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $APR_COUNT = $result[0]->APR;
        }
        
        // MAY
        $MAY_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'MAY' FROM `data_entry_case` WHERE `date_reported` >'" . $months['MAY_START'] . "' AND `date_reported` < '" . $months['JUN'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $MAY_COUNT = $result[0]->MAY;
        }
        
        // JUN
        $JUN_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'JUN' FROM `data_entry_case` WHERE `date_reported` >'" . $months['JUN_START'] . "' AND `date_reported` < '" . $months['JUL'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $JUN_COUNT = $result[0]->JUN;
        }
        
        // JUL
        $JUL_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'JUL' FROM `data_entry_case` WHERE `date_reported` >'" . $months['JUL_START'] . "' AND `date_reported` < '" . $months['AUG'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $JUL_COUNT = $result[0]->JUL;
        }
        
        // AUG
        $AUG_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'AUG' FROM `data_entry_case` WHERE `date_reported` >'" . $months['AUG_START'] . "' AND `date_reported` < '" . $months['SEP'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $AUG_COUNT = $result[0]->AUG;
        }
        
        // SEP
        $SEP_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'SEP' FROM `data_entry_case` WHERE `date_reported` >'" . $months['SEP_START'] . "' AND `date_reported` < '" . $months['OCT'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $SEP_COUNT = $result[0]->SEP;
        }
        
        // OCT
        $OCT_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'OCT' FROM `data_entry_case` WHERE `date_reported` >'" . $months['OCT_START'] . "' AND `date_reported` < '" . $months['NOV'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $OCT_COUNT = $result[0]->OCT;
        }
        
        // NOV
        $NOV_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'NOV' FROM `data_entry_case` WHERE `date_reported` >'" . $months['NOV_START'] . "' AND `date_reported` < '" . $months['DEC'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $NOV_COUNT = $result[0]->NOV;
        }
        
        // DEC
        $DEC_COUNT = 0;
        $sql = "SELECT COUNT(`case_number`) AS 'DEC' FROM `data_entry_case` WHERE `date_reported` >'" . $months['DEC_START'] . "' AND `date_reported` < '" . $months['JAN_FINISH'] . "'";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $DEC_COUNT = $result[0]->DEC;
        }
        
        $month_counts = [
            'Total' => $JAN_COUNT + $FEB_COUNT + $MAR_COUNT + $APR_COUNT + $MAY_COUNT + $JUN_COUNT + $JUL_COUNT + $AUG_COUNT + $SEP_COUNT + $OCT_COUNT + $NOV_COUNT + $DEC_COUNT,
            'JAN' => $JAN_COUNT,
            'FEB' => $FEB_COUNT,
            'MAR' => $MAR_COUNT,
            'APR' => $APR_COUNT,
            'MAY' => $MAY_COUNT,
            'JUN' => $JUN_COUNT,
            'JUL' => $JUL_COUNT,
            'AUG' => $AUG_COUNT,
            'SEP' => $SEP_COUNT,
            'OCT' => $OCT_COUNT,
            'NOV' => $NOV_COUNT,
            'DEC' => $DEC_COUNT
        ];
        
        $html_table_1 = "<h6>" . $year . " Monthly Case Totals</h6>";
        $html_table_1 .= "<table class=tb id=report>";
        $html_table_1 .= "<tr>";
        foreach ($month_counts as $row_header => $value) {
            $html_table_1 .= "<th>" . $row_header . "</th>";
        }
        $html_table_1 .= "</tr></thead>";
        $html_table_1 .= "<tbody>";
        $html_table_1 .= "<tr>";
        foreach ($month_counts as $row_header => $value) {
            $html_table_1 .= "<td>" . $value . "</td>";
        }
        $html_table_1 .= "</tr>";
        $html_table_1 .= "</tbody>";
        $html_table_1 .= "</table></br>";
        
        // CASE TYPE TOTALS
        // scene
        $SCENE = 0;
        $sql = "SELECT COUNT(`data_entry_inv_form`.`case_number`) AS 'Scene' FROM `data_entry_inv_form`, `data_entry_case` WHERE `data_entry_inv_form`.`scene` = 1";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_inv_form`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $SCENE = $result[0]->Scene;
        }
        
        // Phone
        $PHONE = 0;
        $sql = "SELECT COUNT(`data_entry_narrative`.`case_number`) AS 'Phone' FROM `data_entry_narrative`, `data_entry_case` WHERE `data_entry_narrative`.`narrative` LIKE '%Phone Investigation%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_narrative`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $PHONE = $result[0]->Phone;
        }
        
        // Cremation
        $CREMATION = 0;
        $sql = "SELECT COUNT(`data_entry_inv_form`.`case_number`) AS 'Cremation' FROM `data_entry_inv_form`, `data_entry_case` WHERE `data_entry_inv_form`.`cremation_only` = 1";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_inv_form`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $CREMATION = $result[0]->Cremation;
        }
        
        // Mutual
        $MUTUAL = 0;
        $sql = "SELECT COUNT(`data_entry_inv_form`.`case_number`) AS 'Mutual' FROM `data_entry_inv_form`, `data_entry_case` WHERE `data_entry_inv_form`.`mutual_aid` = 1";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_inv_form`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $MUTUAL = $result[0]->Mutual;
        }
        
        $case_counts = [
            "Scene Investigation" => $SCENE,
            "Phone Investigation" => $PHONE,
            "Cremation Only" => $CREMATION,
            "Mutual Aid" => $MUTUAL
        ];
        
        $html_table_5 = "<h6>" . $year . " Case Type</h6>";
        $html_table_5 .= "<table class=tb id=report2>";
        $html_table_5 .= "<tr>";
        foreach ($case_counts as $row_header => $value) {
            $html_table_5 .= "<th>" . $row_header . "</th>";
        }
        $html_table_5 .= "</tr></thead>";
        $html_table_5 .= "<tbody>";
        $html_table_5 .= "<tr>";
        foreach ($case_counts as $row_header => $value) {
            $html_table_5 .= "<td>" . $value . "</td>";
        }
        $html_table_5 .= "</tr>";
        $html_table_5 .= "</tbody>";
        $html_table_5 .= "</table></br>";
       
        
        // MANNERS OF DEATH
        // Natural
        $Natural = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Natural' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`manner_of_death` LIKE '%Natural%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Natural = $result[0]->Natural;
        }
        
        // Accident
        $Accident = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Accident' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`manner_of_death` LIKE '%Accident%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Accident = $result[0]->Accident;
        }
        
        // Suicide
        $Suicide = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Suicide' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`manner_of_death` LIKE '%Suicide%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Suicide = $result[0]->Suicide;
        }
        
        // Homicide
        $Homicide = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Homicide' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`manner_of_death` LIKE '%Homicide%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Homicide = $result[0]->Homicide;
        }
        
        // Undetermined
        $Undetermined = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Undetermined' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`manner_of_death` LIKE '%Undetermined%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Undetermined = $result[0]->Undetermined;
        }
        
        // Pending
        $Pending = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Pending' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`manner_of_death` LIKE '%Pending%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Pending = $result[0]->Pending;
        }
        
        $case_counts = [
            "Total" => $Natural + $Accident + $Suicide + $Homicide + $Undetermined + $Pending,
            "Natural" => $Natural,
            "Accident" => $Accident,
            "Suicide" => $Suicide,
            "Homicide" => $Homicide,
            "Undetermined" => $Undetermined,
            "Pending" => $Pending
        ];
        
        $html_table_2 = "<h6>" . $year . " Manners of Death</h6>";
        $html_table_2 .= "<table class=tb id=report2>";
        $html_table_2 .= "<tr>";
        foreach ($case_counts as $row_header => $value) {
            $html_table_2 .= "<th>" . $row_header . "</th>";
        }
        $html_table_2 .= "</tr></thead>";
        $html_table_2 .= "<tbody>";
        $html_table_2 .= "<tr>";
        foreach ($case_counts as $row_header => $value) {
            $html_table_2 .= "<td>" . $value . "</td>";
        }
        $html_table_2 .= "</tr>";
        $html_table_2 .= "</tbody>";
        $html_table_2 .= "</table></br>";
        
        // Drug Death Statistics
        // Opiates
        $Opiates = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Opiates' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%Opiates%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Opiates = $result[0]->Opiates;
        }
        
        // Heroin
        $Heroin = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Heroin' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%Heroin%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Heroin = $result[0]->Heroin;
        }
        
        // Fentanyl or Fentanyl Analogs
        $Fentanyl = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Fentanyl' FROM `data_entry_cause_manner`, `data_entry_case` WHERE (`data_entry_cause_manner`.`cause_of_death` LIKE '%Fentanyl%' OR `data_entry_cause_manner`.`cause_of_death` LIKE '%Fentanyl Analogs%')";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Fentanyl = $result[0]->Fentanyl;
        }
        
        // Cocaine
        $Cocaine = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Cocaine' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%Cocaine%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Cocaine = $result[0]->Cocaine;
        }
        
        // Methamphetamine
        $Methamphetamine = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'Methamphetamine' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%Methamphetamine%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $Methamphetamine = $result[0]->Methamphetamine;
        }
        
        $drug_statistics = [
            "Total" => $Opiates + $Heroin + $Fentanyl + $Cocaine + $Methamphetamine,
            "Opiates" => $Opiates,
            "Heroin" => $Heroin,
            "Fentanyl and/or Fentanyl Analogs" => $Fentanyl,
            "Cocaine" => $Cocaine,
            "Methamphetamine" => $Methamphetamine
        ];
        
        $html_table_3 = "<h6>" . $year . " Drug Death Statistics</h6>";
        $html_table_3 .= "<table class=tb id=report2>";
        $html_table_3 .= "<tr>";
        foreach ($drug_statistics as $row_header => $value) {
            $html_table_3 .= "<th>" . $row_header . "</th>";
        }
        $html_table_3 .= "</tr></thead>";
        $html_table_3 .= "<tbody>";
        $html_table_3 .= "<tr>";
        foreach ($drug_statistics as $row_header => $value) {
            $html_table_3 .= "<td>" . $value . "</td>";
        }
        $html_table_3 .= "</tr>";
        $html_table_3 .= "</tbody>";
        $html_table_3 .= "</table></br>";
        
        // COVID-19
        // COVID_JAN
        $COVID_JAN_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_JAN' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JAN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['FEB'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_JAN_COUNT = $result[0]->COVID_JAN;
        }
        
        // COVID_FEB
        $COVID_FEB_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_FEB' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['FEB_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['MAR'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_FEB_COUNT = $result[0]->COVID_FEB;
        }
        
        // COVID_MAR
        $COVID_MAR_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_MAR' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['MAR_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['APR'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_MAR_COUNT = $result[0]->COVID_MAR;
        }
        
        // COVID_APR
        $COVID_APR_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_APR' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['APR_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['MAY'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_APR_COUNT = $result[0]->COVID_APR;
        }
        
        // COVID_MAY
        $COVID_MAY_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_MAY' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['MAY_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JUN'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_MAY_COUNT = $result[0]->COVID_MAY;
        }
        
        // COVID_JUN
        $COVID_JUN_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_JUN' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JUN_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JUL'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_JUN_COUNT = $result[0]->COVID_JUN;
        }
        
        // COVID_JUL
        $COVID_JUL_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_JUL' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['JUL_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['AUG'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_JUL_COUNT = $result[0]->COVID_JUL;
        }
        
        // COVID_AUG
        $COVID_AUG_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_AUG' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['AUG_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['SEP'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_AUG_COUNT = $result[0]->COVID_AUG;
        }
        
        // COVID_SEP
        $COVID_SEP_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_SEP' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['SEP_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['OCT'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_SEP_COUNT = $result[0]->COVID_SEP;
        }
        
        // COVID_OCT
        $COVID_OCT_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_OCT' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['OCT_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['NOV'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_OCT_COUNT = $result[0]->COVID_OCT;
        }
        
        // COVID_NOV
        $COVID_NOV_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_NOV' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['NOV_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['DEC'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_NOV_COUNT = $result[0]->COVID_NOV;
        }
        
        // COVID_DEC
        $COVID_DEC_COUNT = 0;
        $sql = "SELECT COUNT(`data_entry_case`.`case_number`) AS 'COVID_DEC' FROM `data_entry_cause_manner`, `data_entry_case` WHERE `data_entry_cause_manner`.`cause_of_death` LIKE '%COVID-19%'";
        $sql .= " AND `data_entry_case`.`date_reported` >'" . $months['DEC_START'] . "' AND `data_entry_case`.`date_reported` < '" . $months['JAN_FINISH'] . "'";
        $sql .= " AND `data_entry_cause_manner`.`case_number` = `data_entry_case`.`case_number`";
        $query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() != 0) {
            $result = $query->fetchAll();
            $COVID_DEC_COUNT = $result[0]->COVID_DEC;
        }
        
        $covid_statistics = [
            'Total' => $COVID_JAN_COUNT + $COVID_FEB_COUNT + $COVID_MAR_COUNT + $COVID_APR_COUNT + 
            $COVID_MAY_COUNT + $COVID_JUN_COUNT + $COVID_JUL_COUNT + $COVID_AUG_COUNT + $COVID_SEP_COUNT + 
            $COVID_OCT_COUNT + $COVID_NOV_COUNT + $COVID_DEC_COUNT,
            'JAN' => $COVID_JAN_COUNT,
            'FEB' => $COVID_FEB_COUNT,
            'MAR' => $COVID_MAR_COUNT,
            'APR' => $COVID_APR_COUNT,
            'MAY' => $COVID_MAY_COUNT,
            'JUN' => $COVID_JUN_COUNT,
            'JUL' => $COVID_JUL_COUNT,
            'AUG' => $COVID_AUG_COUNT,
            'SEP' => $COVID_SEP_COUNT,
            'OCT' => $COVID_OCT_COUNT,
            'NOV' => $COVID_NOV_COUNT,
            'DEC' => $COVID_DEC_COUNT
        ];
        
        $html_table_4 = "<h6>" . $year . " COVID-19 Statistics</h6>";
        $html_table_4 .= "<table class=tb id=report2>";
        $html_table_4 .= "<tr>";
        foreach ($covid_statistics as $row_header => $value) {
            $html_table_4 .= "<th>" . $row_header . "</th>";
        }
        $html_table_4 .= "</tr></thead>";
        $html_table_4 .= "<tbody>";
        $html_table_4 .= "<tr>";
        foreach ($covid_statistics as $row_header => $value) {
            $html_table_4 .= "<td>" . $value . "</td>";
        }
        $html_table_4 .= "</tr>";
        $html_table_4 .= "</tbody>";
        $html_table_4 .= "</table></br>";
        
        return $html_table_1 . $html_table_5 . $html_table_2 . $html_table_3 . $html_table_4;
    }

}
