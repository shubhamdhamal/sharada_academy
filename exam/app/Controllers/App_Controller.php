<?php
namespace App\Controllers;
use App\Controllers\My_Controller;
class App_Controller extends My_Controller {
    public function __construct($redirect = true) {
        parent::__construct();
        $session = session();

        $user = array();
        $is_valid = false;

        $web_auth_key = session('web_auth_key');
        $user_id = session('client_id');
        if($web_auth_key!=''){
            $customer = $this->Crud_model->get_data_row(TBL_ADMIN,array('web_auth_key'=>$web_auth_key,'id'=>$user_id,'is_active'=>'1'));
            if(!empty($customer)){
                $is_valid = true;
            }
        }
        if($is_valid){ 
            $login_client = array();
            $login_client['timezone'] = $customer->timezone;
            $login_client['date_format'] = $customer->date_format;
            $login_client['time_format'] = $customer->time_format;
            
            $login_client['client_id'] = $customer->id;
            $login_client['client_name'] = $customer->name;
            $login_client['username'] = $customer->username;
            $login_client['client_email'] = $customer->email_id;
            $login_client['client_country'] = $customer->country_code;
            $login_client['client_mobile'] = $customer->mobile_no;
            $login_client['role_id'] = $customer->role_id;
            $login_client['profile_image'] = app_file_exists(uploads_url('profile/'.$customer->profile_image),uploads_url('profile/default.png'));
            config('abGorad')->app_login_client_array = $login_client;
        }

        $exclude_url= array(
            home_site_url('manifest.json'),
            home_site_url('pwa.js'),
            home_site_url('sitemap.xml'),
            home_site_url('offline'),
            home_site_url('service-worker.js'),
            home_site_url('assets/admin/root.css'),
            home_site_url('assets/admin/root.js'),
            home_site_url('api/web')
        );
        if(!in_array(current_url(), $exclude_url)){
            if(app_setting('front_page_access')=='off'){
                $this->front_page();exit;
            }
            $session = session();
            if(app_setting('app_maintenance_mode')=='on' && session('admin_id')==''){
                $this->maintenance();exit;
            }
        }
    }
    public function front_page() {
        app_redirect(admin_site_url('auth'),true);
    }
    public function maintenance() {
        echo home_view('maintenance');
    }
}
