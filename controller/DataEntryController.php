<?php

/**
 * Class DataEntryController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace ME\Controller;

use ME\Model\entry_model;

class DataEntryController
{
    function __construct()
    {
        $this->entry_model = new \ME\Model\entry_model();
    }
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/data_entry/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        $_SESSION['curr_inner_tab'] = 'data_entry_cause_manner';
        $this->data_entry('cause_manner');
    }
    
    /**
     * PAGE: data_entry
     * This method handles what happens when the user wants a different tab in the data entry section
     */
    public function data_entry($tab_name)
    {
        if($this->checkIfLogon()){
            // load views
            $_SESSION['curr_tab'] = 'data_entry_tab';
            require APP . 'view/_templates/header.php';
            require APP . 'view/error/access_granted.php';
            require APP . 'view/data_entry/index.php';
            require APP . 'view/data_entry/' . $tab_name . '.php';
            require APP . 'view/_templates/footer.php';
        } else {
            $_SESSION['curr_tab'] = '';
            require APP . 'view/_templates/header.php';
            require APP . 'view/error/access_denied.php';
            require APP . 'view/_templates/footer.php';
        }
    }
    
    /**
     * Makes sure user is an uthorized user of Medical Examiner.
     */
    public function checkIfLogon(){
        return $this->entry_model->is_authorized_user('AMikula');
        //         $valid = false;
        //         require 'e:/inc/auth.php';
        //         $auth = new \modAuth();
        //         if($auth->userName>''){
        //             $username = explode('@',$auth->userName);
        //             $rs = $this->entry_model->is_authorized_user($username[0]);
        //             if($rs){
        //                 $valid = true;
        //             }
        //         }else {
        //             require 'e:/inc/graph.php';
        //             $Graph = new \modGraph();
        //             $profile = $Graph->getProfile();
        //             if($profile) {
        //                 $userPrincipalName = $profile->userPrincipalName;
        //                 $username = explode('@',$userPrincipalName);
        //                 $rs = $this->entry_model->is_authorized_user($username[0]);
        //                 if($rs){
        //                     $valid = true;
        //                 }
        //             }
        //         }
        //         // true? entry fine, else, display error page
        //         if(!$valid){
        //             header('Location: ' . URL . "Home/access_denied");
        //         }
        }
    
    /**
     * PDF/Prints the specified form for the user
     */
    public function print_page(){
       $case_number = ($_POST['case_number_hide']);
       $print_type = ($_POST['table_name_hide']);
       $table_name = 'data_entry_' . $print_type;
       $results = $this->entry_model->search_for_print($case_number, $table_name);
       // check to make sure results is OK
       if($results == 1){
           echo 'No Results : Please enter valid case number.';
       } else {
           // load pdf file
           require APP . 'view/data_entry/print_' . $print_type . '.php';
       }
    }
    
    /*
     * Call to entry_model search_db
     */
    public function search_db()
    {
        echo $this->entry_model->search_db();
    }
    
    /*
     * Call to entry_model update_checkbox
     */
    public function update_checkbox()
    {
        echo $this->entry_model->update_checkbox();
    }
    
    /*
     * Onkeyup set current case num for session var
     */
    public function set_case_num()
    {
        if (isset($_POST['case_number_case']) && strlen($_POST['case_number_case']) >= 6 && strlen($_POST['case_number_case']) <= 7) {
            // CASE: 'data_entry_case', 'case_number_case'
            $_SESSION['curr_case_number'] = $_POST['case_number_case'];
            if (isset($_SESSION['curr_table_name'])) {
                $parameters = [$_SESSION['curr_case_number'], $_SESSION['curr_table_name']];
                echo json_encode($parameters); // success, return to function call for call to get_form_details(case_num, table_name)
            } else {
                echo 1; // case num set, table name not
            }
        } else if(isset($_POST['case_number']) && strlen($_POST['case_number']) >= 6 && strlen($_POST['case_number']) <= 7){
            // CASE: 'data_entry_*', 'case_number'
            $_SESSION['curr_case_number'] = $_POST['case_number'];
            if (isset($_SESSION['curr_table_name'])) {
                $parameters = [$_SESSION['curr_case_number'], 'data_entry_case'];
                 echo json_encode($parameters); // success, return to function call for call to get_form_details(case_num, table_name)
            } else {
                 echo 1; // case num set, table name not
            }
        } else {
           echo 0; // case num not set
        }
    }
    
    /*
     * Onload for data entry, set new table name for filling form
     */
    public function set_table_name()
    {
        if (isset($_POST['table_name'])) {
            $_SESSION['curr_table_name'] = $_POST['table_name'];
            if (isset($_SESSION['curr_case_number']) && strlen($_SESSION['curr_case_number']) >= 6 && strlen($_SESSION['curr_case_number']) <= 7) {
                $parameters = [$_SESSION['curr_case_number'], $_SESSION['curr_table_name']];
                echo json_encode($parameters); // success, return to function call for call to get_form_details(case_num, table_name)
            } else {
                echo 0; // case num not set or valid
            }
        }
    }
    
    /*
     * Call to entry_model get_active_case_files
     */
    public function get_active_case_files(){
        echo $this->entry_model->get_active_case_files();
    }
    
    /*
     * Opens data entry page from home with specified case num
     */
    public function open_with_case($case_num){
        if($case_num != null){
            //grab only case num from text
            $split_case = explode(",", $case_num, 2);
            $_SESSION['curr_case_number'] = $split_case[0];
        }
        //load start page for data entry
        $_SESSION['curr_tab'] = 'data_entry_tab';
        $_SESSION['curr_inner_tab'] = 'data_entry_cause_manner';
        $this->data_entry('cause_manner');
    }
    
    /*
     * Sets the current tab variable for view purposes
     */
    public function set_current_tab(){
        if(isset($_POST['tab_name'])){
            $_SESSION['curr_tab'] = $_POST['tab_name'];
            echo 0; //success
        } else {
            echo 1;//unknown error, should always be a tab name passed
        }
    }
    
    /*
     * Gets the current tab variable for view purposes
     */
    public function get_current_tab(){
        if(isset($_SESSION['curr_tab'])){
            echo $_SESSION['curr_tab'];//success
        } else {
            echo 1;//unknown error, should always be a tab name passed
        }
    }
    
    /*
     * Sets the current INNER tab variable for view purposes
     */
    public function set_current_inner_tab(){
        if(isset($_POST['inner_tab_name'])){
            $_SESSION['curr_inner_tab'] = $_POST['inner_tab_name'];
            echo 0; //success
        } else {
            echo 1;//unknown error, should always be a tab name passed
        }
    }
    
    /*
     * Gets the current INNER tab variable for view purposes
     */
    public function get_current_inner_tab(){
        if(isset($_SESSION['curr_inner_tab'])){
            echo $_SESSION['curr_inner_tab'];//success
        } else {
            echo 1;//unknown error, should always be a tab name passed
        }
    }
    
    /*
     * Updates total docs session value
     */
    public function update_total_docs(){
        if(isset($_POST['total_docs_index'])){
            $_SESSION['curr_total_docs'] = $_POST['total_docs_index'];
            echo 0; 
        } else {
            echo 1;
        }
    }
    
    /*
     * Updates total items session value
     */
    public function update_total_items(){
        if(isset($_POST['total_items_index'])){
            $_SESSION['curr_total_items'] = $_POST['total_items_index'];
            echo 0; 
        } else {
            echo 1;
        }
    }
    
    /*
     * Updates total meds session value
     */
    public function update_total_meds(){
        if(isset($_POST['total_meds_index'])){
            $_SESSION['curr_total_meds'] = $_POST['total_meds_index'];
            echo 0; 
        } else {
            echo 1;
        }
    }
    
    /*
     * Updates total forms session value
     */
    public function update_total_forms(){
        if(isset($_POST['total_forms_index'])){
            $_SESSION['curr_total_forms'] = $_POST['total_forms_index'];
            echo 0; 
        } else {
            echo 1;
        }
    }
    
}