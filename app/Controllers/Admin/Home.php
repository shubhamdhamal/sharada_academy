<?php
namespace App\Controllers\Admin;
use App\Controllers\My_Controller;
class Home extends My_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        app_redirect(admin_site_url('auth'),true);
    }
}
/* End of file Home.php */
/* Location: ./app/controllers/Home.php */