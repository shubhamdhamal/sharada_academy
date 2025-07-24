<?php
namespace App\Controllers\Admin;
class Profile extends App_Controller {
    private $module_name = 'profile';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('profile');
    }
    public function index() {
        $page_css = array(
            "plugins/intl-tel-input/css/intlTelInput.min.css"
        );
        $page_js = array(
            "plugins/intl-tel-input/js/intlTelInput.min.js"
        );

        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'profile';
        $page_data['page_title'] = 'profile';
        $page_data['page_css'] = $page_css;
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }
    public function crud(){
        $json['status'] = false;
        $json['type'] = 'error';
        $json['title'] = $this->module_title;
        $json['message'] = translate('invalid_request');
        if ($this->request->isAJAX()) {
            $updated = array();
            $updated['type'] = 'admin';
            $updated['id'] = user_setting('admin_id');

            $action = $this->request->getPost('action');
            if($action=='profile_image'){
                $validation = array();
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $is_profile_upload = false;
                if (isset($_FILES['profile_image'])){
                    $path = FCPATH."writable/uploads/profile/".user_setting('username').".png";
                    if(move_upload_file_if_ok('profile_image',$path)){
                        app_image_resize($path,400,400,$path);
                        $is_profile_upload = true;
                    }
                }
                if($is_profile_upload){
                    $up_data = array();
                    $up_data['profile_image'] = user_setting('username').".png";
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('profile_image_updated_successfully');
                    $json['url'] = admin_site_url('profile');
                }else{
                    $json['message'] = translate('unable_to_upload_profile_image');
                }
            }else if($action=='remove_profile'){
                $this->module_title = translate('profile_image');
                $validation = array();
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                if(file_exists(FCPATH."writable/uploads/profile/".user_setting('username').".png")){
                    unlink(FCPATH."writable/uploads/profile/".user_setting('username').".png");
                }

                $up_data = array();
                $up_data['profile_image'] = "default.png";
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $is_update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));
                
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                    $json['url'] = admin_site_url('profile');
                }else{
                    $json['message'] = translate('unable_to_upload_profile_image');
                }
            }else if($action=='basic'){
                $this->module_title = translate('basic_settings');
                $validation = array();
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
                $validation['email_id'] = ['label' => translate('email_id'), 'rules' => 'required|is_unique['.TBL_ADMIN.'.email_id,id,'.user_setting('user_id').']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['mobile_no'] = ['label' => translate('mobile_no'), 'rules' => 'required|is_unique['.TBL_ADMIN.'.mobile_no,id,'.user_setting('user_id').']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['country_code'] = ['label' => translate('country_code'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $uis = array('name','email_id','country_code');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['mobile_no'] = str_replace(" ", "", $this->request->getPost('mobile_no'));
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $is_update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));
                
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='timezone'){
                $this->module_title = translate('timezone_settings');
                $validation = array();
                $validation['timezone'] = ['label' => translate('timezone'), 'rules' => 'required'];
                $validation['date_format'] = ['label' => translate('date_format'), 'rules' => 'required'];
                $validation['time_format'] = ['label' => translate('time_format'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $uis = array('timezone','date_format','time_format');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }                
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $is_update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));
                
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='security'){
                $this->module_title = translate('security_settings');

                $authentication_type = $this->request->getPost('authentication_type');
                $validation = array();

                if($authentication_type=='default'){
                    $validation['totp'] = ['totp' => translate('TOTP'), 'rules' => 'required|is_natural|exact_length[6]'];
                    $validation['confirm_totp'] = ['confirm_totp' => translate('confirm_TOTP'), 'rules' => 'required|is_natural|exact_length[6]|matches[totp]'];
                }else if($authentication_type=='google'){
                    $validation['gsecret'] = ['gsecret' => translate('secret'), 'rules' => 'required'];
                    $validation['gtotp'] = ['gtotp' => translate('TOTP'), 'rules' => 'required'];
                    $validation['confirm_gtotp'] = ['confirm_gtotp' => translate('confirm_TOTP'), 'rules' => 'required|matches[gtotp]'];
                }else if($authentication_type=='message'){
                    $validation['mode'] = ['mode' => translate('OTP_mode'), 'rules' => 'required'];
                    $validation['length'] = ['length' => translate('OTP_length'), 'rules' => 'required'];
                    $validation['type'] = ['type' => translate('type'), 'rules' => 'required'];
                    $validation['mtotp'] = ['mtotp' => translate('TOTP'), 'rules' => 'required'];
                    $validation['confirm_mtotp'] = ['confirm_,totp' => translate('confirm_TOTP'), 'rules' => 'required|matches[gtotp]'];
                }else if($authentication_type=='firebase'){
                    $validation['mode'] = ['mode' => translate('OTP_mode'), 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $result = false;

                $up_data = array();
                $up_data['authentication_status'] = '1';
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                if($authentication_type=='default'){
                    $up_data['authentication_type'] = 'd';
                    $up_data['authentication_details'] = md5($this->request->getPost('totp'));
                    $result = true;
                }else if($authentication_type=='google'){
                    $totp = $this->request->getPost('gtotp');
                    $secret = $this->request->getPost('gsecret');

                    $up_data['authentication_type'] = 'g';
                    $up_data['authentication_details'] = $secret;
                    $result = verify_auth_qr('g',$secret, $totp);
                }else if($authentication_type=='message'){
                    $details = array();
                    $details['mode'] = $this->request->getPost('mode');
                    $details['length'] = $this->request->getPost('length');
                    $details['type'] = $this->request->getPost('type');
                    
                    $up_data['authentication_type'] = 'm';
                    $up_data['authentication_details'] = json_encode($details);
                    $result = true;
                }
                else if($authentication_type=='firebase'){
                    $details = array();
                    $details['mode'] = $this->request->getPost('mode');
                    
                    $up_data['authentication_type'] = 'f';
                    $up_data['authentication_details'] = json_encode($details);
                    $result = true;
                }
                if($result){
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);

                    $is_update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));
                    
                    if($is_update){
                        $json['status'] = true;
                        $json['type'] = 'success';
                        $json['message'] = translate('details_updated_successfully');
                        $json['url'] = admin_site_url('profile');
                    }else{
                        $json['message'] = translate('unable_to_update_details');
                    }
                }else{
                    $json['message'] = translate('unable_to_update_details_or_invalid_TOTP');
                }
            }else if($action=='disable_authentication'){
                $validation = array();
                $validation['password'] = ['label' => translate('password'), 'rules' => 'required'];
                $validation['confirm_password'] = ['label' => translate('confirm_password'), 'rules' => 'required|matches[password]'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                
                $this->validate_submitted_data($this->module_title, $validation);
                                
                $up_data = array();
                $up_data['authentication_status'] = '0';
                $up_data['authentication_details'] = '';
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);                
                $is_update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                    $json['url'] = admin_site_url('profile');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='change_password'){
                $validation = array();
                $validation['current_password'] = ['label' => translate('current_password'), 'rules' => 'required'];
                $validation['new_password'] = ['label' => translate('new_password'), 'rules' => 'required|min_length[6]'];
                $validation['confirm_new_password'] = ['label' => translate('confirm_new_password'), 'rules' => 'required|matches[new_password]','errors' => [
                'matches' => '{field} '.translate('matches_with_new_password')]];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                
                $this->validate_submitted_data($this->module_title, $validation);
                
                $pwd = $this->Crud_model->get_data_row(TBL_ADMIN,array('id'=>user_setting('user_id'),'password'=>sha1($this->request->getPost('current_password'))));
                if($pwd){
                    $up_data = array();
                    $up_data['password'] = sha1($this->request->getPost('new_password'));
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);                
                    $is_update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>user_setting('user_id')));
                    if($is_update){
                        $json['status'] = true;
                        $json['type'] = 'success';
                        $json['message'] = translate('password_updated_successfully');
                    }else{
                        $json['message'] = translate('unable_to_update_password');
                    }
                }else{
                    $json['message'] = translate("current_password_doesn't_match");
                }
            }
        }
        echo encode_json($json);exit;
    }
    function page($slug=''){
        if ($this->request->isAJAX()) {
            if($slug=='change-password'){
                $page_data = array();
                $page_data['page_title'] = translate('change_password');
                $page_data['page_action'] = 'change_password';
                $page_data['id'] = user_setting('user_id');
                echo admin_view($this->module_name.'/popup-change_password',$page_data);
            }
        }
    }
}
/* End of file Profile.php */
/* Location: ./app/controllers/Profile.php */