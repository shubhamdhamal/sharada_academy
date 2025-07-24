<?php
namespace App\Controllers\Admin;
class Dl extends App_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        $data = $this->request->getGet('data');
        $data = json_decode(decode_string($data));

        $name = isset($data->name) && $data->name!='' ? $data->name : '';
        $file = isset($data->file) && $data->file!='' ? $data->file : '';
        $ext = isset($data->ext) && $data->ext!='' ? $data->ext : '';
        $path = $file.'.'.$ext;
        if($path!='.'){
            //$filepath = WRITEPATH.'uploads\files\\'.$path;
            $filepath = "./writable/uploads/files/".$path;
            if(file_exists($filepath)) {
                return $this->response->download($filepath, null)->setFileName($name);die();
            }
        }
        app_redirect(home_site_url(),true);
	}
}
/* End of file Dl.php */
/* Location: ./app/controllers/Dl.php */