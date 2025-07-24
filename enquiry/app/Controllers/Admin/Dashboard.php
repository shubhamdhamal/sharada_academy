<?php
namespace App\Controllers\Admin;
//use OzdemirBurak\Iris\Color\Hex;
use App\Controllers\Admin\App_Controller;
class Dashboard extends App_Controller {
    private $module_name = 'dashboard';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('dashboard');
    }
    public function index() {
        $chart = array();
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_title'] = 'dashboard';
        $page_data['page_name'] = 'dashboard';
        return admin_view('index',$page_data);
    }
}
/* End of file Dashboard.php */
/* Location: ./app/controllers/Dashboard.php */