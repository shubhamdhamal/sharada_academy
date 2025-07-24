<?php
namespace App\Controllers;
use App\Controllers\App_Controller;
class Home extends App_Controller {
    private $module_name = 'customer';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = app_setting('app_title');
    }
    public function index() {
        $page_data = array();
        $page_data['page_name'] = 'exam_registration_form';
        $page_data['page_title'] = 'Exam Registration Form';
        $page_data['is_inquiry'] = true;
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
}