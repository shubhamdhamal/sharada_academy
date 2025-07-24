<?php
namespace App\Controllers\Admin;
use App\Controllers\Admin\App_Controller;
class Api extends App_Controller {
    public function __construct($redirect = true) {
        parent::__construct();
    }
    public function change_language() {
        $json['status'] = false;
        $json['type'] = 'error';
        $json['message'] = translate('something_went_wrong');
        $action = $this->request->getPost('action');
        if($action=='change_language' && $slug!=''){
            $slug = $this->request->getPost('language');
            if ($slug != '') {
                $session = session();
                $session->set('language', $slug);
                $json['status'] = true;
                $json['type'] = 'success';
                $json['message'] = translate('language_updated_successfully');
            }
        }
        echo encode_json($json);exit;
    }
}
