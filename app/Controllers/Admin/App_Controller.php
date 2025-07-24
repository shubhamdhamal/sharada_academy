<?php
namespace App\Controllers\Admin;
use App\Controllers\My_Controller;
class App_Controller extends My_Controller {
    public $admin_id;
    public $user_id;
    public $user_name;
    public $username;
    public $user_email;
    public $user_mobile;
    public $role_id;
    public $role_name;
    public $profile_image;
    public $timezone;
    public $date_format;
    public $time_format;
    public $permissions;
    public $authentication_status;
    public $locked;
    public function __construct($redirect = true) {
        parent::__construct();
        $session = session();

        $user = array();
        $is_valid = false;

        $web_auth_key = session('web_auth_key');
        $admin_id = session('admin_id');
        $user_id = session('user_id');
        if($web_auth_key!=''){
            $admin = $this->Crud_model->get_data_row(TBL_ADMIN,array('web_auth_key'=>$web_auth_key,'id'=>$admin_id,'is_active'=>'1'));
            if(!empty($admin)){
                $user = $admin;
                $role = $this->Crud_model->get_data_row(TBL_ROLE,array('id'=>$user->role_id, 'is_active' => '1'));
                if(!empty($role)){
                    $is_valid = true;
                }
            }
        }
        if($is_valid){ 
            if(session('locked')==true){
                app_redirect('auth/unlock');
            }
            $login_user = array();

            $permissions = array();
            if($admin->role_id!=1){
                $permissions = json_decode($role->permissions,true);
            }
            $login_user['authentication_status'] = $user->authentication_status;
            $login_user['locked'] = session('locked');

            $login_user['timezone'] = $admin->timezone;
            $login_user['date_format'] = $admin->date_format;
            $login_user['time_format'] = $admin->time_format;
            
            $login_user['permissions'] = $permissions;
            $login_user['admin_id'] = $admin->id;
            $login_user['user_id'] = $user->id;
            $login_user['user_name'] = $user->name;
            $login_user['username'] = $user->username;
            $login_user['user_email'] = $user->email_id;
            $login_user['user_mobile'] = $user->mobile_no;
            $login_user['role_id'] = $user->role_id;
            $login_user['role_name'] = $role->name;
            
            $login_user['profile_image'] = app_file_exists(uploads_url('profile/'.$user->profile_image),uploads_url('profile/default.png'));
            
            config('abGorad')->app_login_user_array = $login_user;
        }else{
            /*$action = $this->request->getPost('action');
            if($action!=''){
                $json = array();
                $json['status'] = false;
                $json['message'] = translate('session_expired');
                echo encode_json($json);exit;
            }
            else{*/
                //$redirect_url = $this->session->userdata('redirect_url');
                //$this->session->sess_destroy();
                //$session->set('redirect_url',$redirect_url);
                app_redirect('auth/logout');
            //}
        }

        $session->set('permissions',$this->permissions);
        $session->set('role_id',$this->role_id);
        $session->set('authentication_status',$this->authentication_status);
    }
}
