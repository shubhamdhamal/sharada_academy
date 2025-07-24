<?php
namespace App\Controllers\Admin;
use App\Controllers\My_Controller;
class Auth extends My_Controller {
    private $module_name = 'auth';
    private $table = TBL_ADMIN;
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('authantication');
        if(!in_array(service('router')->methodName(), array('lock','unlock','logout','crud'))){
            $session = session();
            $web_auth_key = session('web_auth_key');
            if($web_auth_key!=''){
                app_redirect('dashboard');
            }
        }
    }
    public function index() {
        return admin_view($this->module_name.'/login');
    }
    public function forgot_password() {
        return admin_view($this->module_name.'/forgot');
    }
    public function reset_password() {
        $token = $this->request->getGet('token');
        $user = $this->Crud_model->get_data_row($this->table,array('is_active'=>'1','password_token'=>$token));
        if(!empty($user) && $token!=''){
            $page_data = array();
            $page_data['token'] = $token;
            return admin_view($this->module_name.'/reset',$page_data);
        }else{
            app_redirect('/');
        }
    }
    public function register() {
        return admin_view($this->module_name.'/register');
    }
    public function lock() {
        $session = session();
        if(session('authentication_status')=='1'){
            $session->set('locked',true);
            app_redirect('auth/unlock');
        }else{
            app_redirect('dashboard');
        }
    }
    public function unlock() {
        $session = session();
        if(session('authentication_status')=='1'){
            $session = session();
            $user = $this->Crud_model->get_data_row($this->table,array('id'=>$session->get('admin_id')));
            return admin_view($this->module_name.'/unlock',array('user'=>$user));
        }else{
            app_redirect('dashboard');
        }
    }
    public function logout() {
        $session = session();
        $language = $session->get('language')!='' ? $session->get('language') : 'en';
        $session->destroy();
        $session->set($language);
        app_redirect('/');
    }
    public function crud(){
        $json['status'] = false;
        $json['type'] = 'error';
        $json['title'] = $this->module_title;
        $json['message'] = translate('invalid_request');
        if ($this->request->isAJAX()) {
            $action = $this->request->getPost('action');
            if($action=='login'){
                $validation = array();
                $validation['username'] = ['label' => translate('captcha'), 'rules' => 'required'];
                $validation['password'] = ['label' => translate('captcha'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                if(app_setting('captcha_status','off')!='off'){
                    $captcha_type = app_setting('captcha_status','default');
                    if($captcha_type=='default'){
                        $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[login_captcha]'];
                    }else{
                        $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                    }
                }
                $this->validate_submitted_data($this->module_title, $validation);

                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                
                $where = array();
                $where['username'] = $username;
                if(strpos($username, '@')){
                    $where['email_id'] = $username;
                }
                elseif (is_numeric($username)) {
                    $where['mobile_no'] = $username;
                }
                else{
                    $where['username'] = $username;
                }
                $where['password'] = sha1($password);

                $user = $this->Crud_model->get_data_row($this->table,$where);
                if(!empty($user)){
                    if(!$user->is_active){
                        $json['message'] = translate('user_account_is_not_active');
                    }else{
                        $web_auth_key = md5($user->id.random_string('alnum', 16));
                        
                        $data = array();
                        $data['admin_id'] = $user->id;
                        $data['user_id'] = $user->id;
                        $data['web_auth_key'] = $web_auth_key;
                        $data['authentication_status'] = $user->authentication_status;
                        $data['locked'] = $user->authentication_status=='1' ? true : false;
                        if($user->authentication_status=='1'){
                            //$session->setTempdata('locked', true, 300);
                        }
                        $session = session();
                        $session->set($data);

                        $up_data = array();
                        $up_data['password_token'] = '';
                        $up_data['web_auth_key'] = $web_auth_key;
                        $this->Crud_model->update_data($this->table,$up_data,array('id'=>$user->id));

                        add_app_log($this->table,'1',$user->id,array('Login Success'));

                        $json['status'] = true;
                        $json['type'] = 'success';
                        $json['message'] = translate('login_success');
                        $json['url'] = admin_site_url('dashboard');
                    }
                }else{
                    $json['message'] = translate('invalid_user_details');
                }
            }else if($action=='forgot'){
                $validation = array();
                $validation['username'] = ['label' => translate('captcha'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                if(app_setting('captcha_status','off')!='off'){
                    $captcha_type = app_setting('captcha_type','default');
                    if($captcha_type=='default'){
                        $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[forgot_captcha]'];
                    }else{
                        $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                    }
                }
                $this->validate_submitted_data($this->module_title, $validation);
                
                $username = $this->request->getPost('username');
                
                $where = array();
                $where['username'] = $username;
                if(strpos($username, '@')){
                    $where['email_id'] = $username;
                }
                elseif (is_numeric($username)) {
                    $where['mobile_no'] = $username;
                }
                else{
                    $where['username'] = $username;
                }

                $user = $this->Crud_model->get_data_row($this->table,$where);
                if(!empty($user)){
                    if(!$user->is_active){
                        $json['message'] = translate('user_account_is_not_active');
                    }else{
                        $token = md5($user->id.random_string('alnum', 16));
                        
                        $up_data = array();
                        $up_data['password_token'] = $token;
                        $update = $this->Crud_model->update_data($this->table,$up_data,array('id'=>$user->id));

                        if($update){
                            $updated = array();
                            $updated['type'] = 'admin';
                            $updated['id'] = 0;
                            add_app_log($this->table,'2',$user->id,array('Request Sent Success'),array(),$updated);

                            $json['status'] = true;
                            $json['type'] = 'success';
                            $json['msg'] = translate('forgot_password_details_send_successfully');
                            $json['url'] = admin_site_url('auth');
                        }else{
                            $json['message'] = translate('unabal_to_send_forgot_password_instructions');
                        }
                    }
                }else{
                    $json['message'] = translate('invalid_user_details');
                }
            }else if($action=='reset'){
                $validation = array();
                $validation['new_password'] = ['label' => translate('new_password'), 'rules' => 'required'];
                $validation['confirm_password'] = ['label' => translate('confirm_password'), 'rules' => 'required|matches[new_password]'];
                $validation['token'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                if(app_setting('captcha_status','off')!='off'){
                    $captcha_type = app_setting('captcha_type','default');
                    if($captcha_type=='default'){
                        $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[reset_captcha]'];
                    }else{
                        $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                    }
                }
                $this->validate_submitted_data($this->module_title, $validation);
                
                $token = $this->request->getPost('token');
                $password = $this->request->getPost('new_password');
                
                $user = $this->Crud_model->get_data_row($this->table,array('is_active'=>'1','password_token'=>$token));
                
                if(!empty($user)){
                    if(!$user->is_active){
                        $json['message'] = translate('user_account_is_not_active');
                    }else if($user->password==sha1($password)){
                        $json['message'] = translate('password_is_already_exist_in_our_history');
                    }else{                        
                        $up_data = array();
                        $up_data['password_token'] = '';
                        $up_data['password'] = sha1($password);
                        $update = $this->Crud_model->update_data($this->table,$up_data,array('id'=>$user->id));

                        if($update){
                            $updated = array();
                            $updated['type'] = 'admin';
                            $updated['id'] = 0;
                            add_app_log($this->table,'3',$user->id,array('Reset Success'),array(),$updated);

                            $json['status'] = true;
                            $json['type'] = 'success';
                            $json['msg'] = translate('password_reset_successfully');
                            $json['url'] = admin_site_url('auth');
                        }else{
                            $json['message'] = translate('unabal_to_reset_password');
                        }
                    }
                }else{
                    $json['message'] = translate('invalid_user_details');
                }
            }else if($action=='register'){
                $validation = array();
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
                $validation['username'] = ['label' => translate('username'), 'rules' => 'required|is_unique['.$this->table.'.username]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['email_id'] = ['label' => translate('email_id'), 'rules' => 'required|is_unique['.$this->table.'.email_id]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['mobile_no'] = ['label' => translate('mobile_no'), 'rules' => 'required|is_unique['.$this->table.'.mobile_no]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['password'] = ['label' => translate('password'), 'rules' => 'required'];
                $validation['country_code'] = ['label' => translate('country_code'), 'rules' => 'required'];
                $validation['confirm_password'] = ['label' => translate('confirm_password'), 'rules' => 'required|matches[password]'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                if(app_setting('captcha_status','off')!='off'){
                    $captcha_type = app_setting('captcha_type','default');
                    if($captcha_type=='default'){
                        $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[register_captcha]'];
                    }else{
                        $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                    }
                }
                $this->validate_submitted_data($this->module_title, $validation);
                
                $updated = array();
                $updated['type'] = 'admin';
                $updated['id'] = $this->Crud_model->get_tbl_details($this->table,'AUTO_INCREMENT');
                
                $uis = array('username','name','country_code','email_id','password');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $key=='password' ? sha1($this->request->getPost($key)) : $this->request->getPost($key);;
                }
                $up_data['mobile_no'] = str_replace(" ", "", $this->request->getPost('mobile_no'));
                $up_data['role_id'] = app_setting('default_role');
                $up_data['created_by'] = json_encode($updated);
                $up_data['created_on'] = date(DB_DATETIME_FORMAT);
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->insert_data($this->table,$up_data);
                if($ins_id){
                    add_app_log($this->table,'4',$ins_id,array('Registration Success'),array(),$updated);

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['msg'] = translate('user_registred_successfully');
                    $json['url'] = admin_site_url('auth');
                }else{
                    $json['message'] = translate('unabal_to_reguster_user');
                }
            }else if($action=='unlock'){
                $session = session();
                $where = array();
                $where['is_active'] = '1';
                $where['id'] = session('admin_id');
                $user = $this->Crud_model->get_data_row($this->table,$where);

                $validation = array();
                $validation['totp'] = ['label' => translate('TOTP'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                
                if($user->authentication_type!='f'){
                    if(app_setting('captcha_status','off')!='off'){
                        $captcha_type = app_setting('captcha_type','default');
                        if($captcha_type=='default'){
                            $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[login_captcha]'];
                        }else{
                            $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                        }
                    }
                }
                if($user->authentication_type=='f'){
                    $validation['token'] = ['label' => translate('captcha'), 'rules' => 'required'];
                }

                $this->validate_submitted_data($this->module_title, $validation);
                
                $totp = $this->request->getPost('totp');
                
                if(!empty($user)){
                    if(!$user->is_active){
                        $json['message'] = translate('user_account_is_not_active');
                    }else{
                        $is_valid_totp = false;
                        if($user->authentication_type=='d'){
                            $where = array();
                            $where['authentication_details'] = md5($totp);
                            $where['id'] = $user->id;
                            $is_valid_totp = $this->CRUD->get_data_row($this->table,$where);
                        }else if($user->authentication_type=='g'){
                            $this->load->library('GoogleAuthenticator');
                            $is_valid_totp = verify_auth_qr('g',$user->authentication_details, $totp);
                        }else if($user->authentication_type=='f'){
                            $firebase_status = app_setting('firebase_status','off');
                            $firebase_details = app_setting('firebase_details','[]');
                            $firebase_details = !empty(json_decode($firebase_details)) ? json_decode($firebase_details) : array();

                            $token = $this->request->getPost('token');
                            $api_key = $firebase_status=='on' && isset($firebase_details->api_key) ? $firebase_details->api_key : '';

                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=".$api_key."&idToken=" . $token,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_HTTPHEADER => array(
                                    "Content-length:0"
                                )
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $array_response = json_decode($response, true);
                            if (array_key_exists("users", $array_response)) {
                                $user_res = $array_response["users"];
                                if (count($user_res) > 0) {
                                    $user_res_1 = $user_res[0];
                                    if(array_key_exists("phoneNumber", $user_res_1)){
                                        if($user->mobile_no==$user_res_1['phoneNumber']){
                                            $is_valid_totp = true;
                                        }
                                    }
                                }
                            }
                            
                        }
                        if($is_valid_totp){
                            add_app_log($this->table,'5',$user->id,array('Unlock Success'));

                            $session = session();
                            $session->set('locked',false);
                            
                            $json['status'] = true;
                            $json['type'] = 'success';
                            $json['message'] = translate('TOTP_verified_successfully');
                            $json['url'] = admin_site_url('dashboard');
                        }else{
                            $json['message'] = translate('invalid_TOTP');
                        }
                    }
                }else{
                    $json['message'] = translate('invalid_user_details');
                }
            }
        }
        echo encode_json($json);exit;
    }
    public function generate_captcha(){
        if ($this->request->isAJAX()) {
            $json = array();
            $json['status'] = false;
            $json['type'] = 'error';
            $json['title'] = $this->module_title;
            $json['msg'] = translate('invalid_request');
            $action = $this->request->getPost('action');
            if($action=='captcha'){
                $json['status'] = true;
                $json['type'] = 'success';
                $json['message'] = translate('captcha_generate_successfully');
                $json['details'] = get_captcha('default',$this->request->getPost('type'))->img;
            }
            echo encode_json($json);exit;
        }else{
            //$this->fourzerofour();
        }
    }
}
/* End of file Auth.php */
/* Location: ./app/controllers/Auth.php */