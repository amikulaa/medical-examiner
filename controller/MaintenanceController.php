<?php

/**
 * Class MaintenanceController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace ME\Controller;

use ME\Model\entry_model;

class MaintenanceController
{
    function __construct()
    {
        $this->entry_model = new \ME\Model\entry_model();
    }
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/maintenance/index (which is the default page btw)
     */
    public function index()
    {
        $this->table('citystatezip');
    }
    
    /**
     * PAGE: maintenance_controller
     * This method handles what happens when the user wants a different tab in the data entry section
     */
    public function table($table_name)
    {
        if($this->checkIfLogon()){
            // load views
            $_SESSION['curr_tab'] = 'maintenance_tab';
            require APP . 'view/_templates/header.php';
            require APP . 'view/error/access_granted.php';
            require APP . 'view/maintenance/' . $table_name . '.php';
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
}
