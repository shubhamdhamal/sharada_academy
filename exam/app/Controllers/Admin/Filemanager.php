<?php
namespace App\Controllers\Admin;
class Filemanager extends App_Controller {
    private $module_name = 'filemanager';
    function __construct() {
        parent::__construct();
        $this->module_title = translate('filemanager');
    }
    public function index() {
        valid_session($this->module_name,'filemanager');
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'filemanager';
        $page_data['page_title'] = 'filemanager';
        return admin_view('index',$page_data);
    }
}
/* End of file Filemanager.php */
/* Location: ./app/controllers/Filemanager.php */