<?php

/**
 * Class ReportsController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace ME\Controller;

use ME\Model\entry_model;

class ReportsController
{
    function __construct()
    {
        $this->entry_model = new \ME\Model\entry_model();
    }
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/reports/index (which is the default page btw)
     */
    public function index()
    {
        $this->report('index');
    }
    
    /**
     * PAGE: this handles what tab the user is in in reports
     */
    public function report($report_name)
    {
        // load views
        
        if($this->checkIfLogon()){
            // load views
            $_SESSION['curr_tab'] = 'reports_tab';
            $_SESSION['curr_total_filters'] = 0;
            require APP . 'view/_templates/header.php';
            require APP . 'view/error/access_granted.php';
            require APP . 'view/reports/' . $report_name . '.php';
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
    
    /*
     * Updates total meds session value
     */
    public function update_total_filters(){
        if(isset($_POST['total_filters_index'])){
            $_SESSION['curr_total_filters'] = $_POST['total_filters_index'];
            echo 0;
        } else {
            echo 1;
        }
    }
    
    /**
     * Set curr tab to reports
     */
    public function set_curr_tab(){
        $_SESSION['curr_tab'] = 'reports_tab';
    }
    
    /*
     * Prints the reports table that is in the html view
     */
    public function print_table(){
        $table_html = ($_POST['table_html']);
        $table_html_name = $_POST['table_html_name'];
        require APP . 'view/reports/print_table.php';
    }
    
    /*
     * Keeps the inputted case info set for easier use of multiple reports with same filters
     */
    public function keep_input_filter_set($name_of_element){
        if(isset($_POST[$name_of_element])){
            echo $_POST[$name_of_element]; 
        } 
        $this->set_curr_tab();
    }
    
    /*
     * Gets input values for table for reports
     */
    public function get_input_fields(){
        echo $this->entry_model->get_input_fields();
        $this->set_curr_tab();
    }
    
    /*
     * Gets text placeholde for input for table in reports
     */
    public function get_text_placeholder(){
        echo $this->entry_model->get_text_placeholder();
        $this->set_curr_tab();
    }
    
    /*
     * Gets pinned cause/manner table
     */
    public function get_cause_manner(){
        echo $this->entry_model->get_cause_manner();
        $this->set_curr_tab();
    }
    
}
