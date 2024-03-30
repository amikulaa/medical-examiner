<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace ME\Controller;

use ME\Model\entry_model;

class HomeController
{
    
    function __construct()
    {
        $this->entry_model = new \ME\Model\entry_model();
    }
    /**
     * PAGE: index  
     * This method handles what happens when you move to http://yourproject/error/index (which is the default page btw)
     */
    public function index()
    {
        if($this->checkIfLogon()){
            // load views
            $_SESSION['curr_tab'] = 'home_tab';
            require APP . 'view/_templates/header.php';
            require APP . 'view/error/access_granted.php';
            require APP . 'view/home/index.php';
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
     * Calls entry_model todo_list function to fill todo list and create view
     */
    public function todo_list()
    {
        echo $this->entry_model->todo_list();
    }
    
    /*
     * Saves task to database for user
     */
    public function save_task()
    {
        echo $this->entry_model->save_task();
    }
    
    /*
     * Gets active cases for year OR specified case num
     */
    public function search_cases(){
        echo $this->entry_model->search_cases();
    }
    
    /*
     * Call to entry_model get_websites
     */
    public function get_websites()
    {
        echo $this->entry_model->get_websites();
    }
    
    /*
     * Resets session vars and clears page
     */
    public function reset_page(){
        $_SESSION['curr_case_number'] = '';
        echo 0; //success
    }

    /*
     * Prints entire case file for case number
     */
    public function print_entire_case($case_num)
    {
        if ($case_num != null) {
            $table_names = [
                'data_entry_cause_manner',
                'data_entry_disinterment_release',
                'data_entry_embalm_permit',
                'data_entry_inv_form',
                'data_entry_narrative',
                'data_entry_supp_report'
            ];
            $results = [];
            $i = 0;
            foreach ($table_names as $table_name) {
                $results[$i] = $this->entry_model->search_for_print_full_case($case_num, $table_name);
                $i += 1;
            }
            if($results != null){
                require APP . 'view/home/print_case_files.php';
            } else {
                require APP . 'view/error/index.php';
            }
        }
    }
}
