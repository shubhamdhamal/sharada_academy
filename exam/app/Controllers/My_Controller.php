<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Libraries\Template;
class My_Controller extends Controller {
    protected $template;
    public $session;
    public $form_validation;
    public $parser;
    public function __construct() {
        //main template to make frame of this app
        $this->template = new Template();

        //load helpers
        helper(array('url', 'text', 'form', 'general','license'));

        //models
        $models_array = $this->get_models_array();
        foreach ($models_array as $model) {
            $this->$model = model("App\Models\\" . $model);
        }

        //assign settings from database
        $settings = $this->Settings_model->get_all_required_settings()->getResult();
        foreach ($settings as $setting) {
            config('abGorad')->app_settings_array[$setting->key] = $setting->value;
        }
        $this->session = \Config\Services::session();
        $this->form_validation = \Config\Services::validation();
        $this->parser = \Config\Services::parser();
    }
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger); //don't edit this line
    }

    private function get_models_array() {
        return array(
            'Crud_model',
            'Settings_model'
        );
    }
    
    //validate submitted data
    protected function validate_submitted_data($title, $fields=array(), $return_errors=false) {
        $final_fields = array();

        foreach ($fields as $field => $validate) {
            //we've to add permit_empty rule if the field is not required
            if (strpos($validate['rules'], 'required') !== false) {
                //this is required field
            } else {
                //so, this field isn't required, add permit_empty rule
                $validate .= "|permit_empty";
            }
            $final_fields[$field] = $validate;
        }
        if (!$final_fields) {
            //no fields to validate in this context, so nothing to validate
            return true;
        }
        $validate = $this->validate($final_fields);
        if (!$validate) {
            $msg_str = '';
            if (ENVIRONMENT === 'production') {
                $msg_str = translate('something_went_wrong');
            } else {
                $validation = \Config\Services::validation();
                $message = $validation->getErrors();
                //$message = $validation->listErrors();
                foreach ($message as $key => $value) {
                    $msg_str .= ' '.esc($value);
                }
            }
            if ($return_errors) {
                return $message;
            }
            echo encode_json(array("status"=>false, 'type'=>'error', 'title'=>$title, 'message' => encode_json($msg_str)));exit();
        }
    }
}
