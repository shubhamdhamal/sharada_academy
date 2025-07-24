<?php
namespace App\Controllers\Admin;
use OzdemirBurak\Iris\Color\Hex;
class Settings extends App_Controller {
    private $module_name = 'settings';
    private $table = TBL_SETTINGS;
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('settings');
    }
    public function index() {
        $permissions =user_setting('permissions');
        $tabs = isset($permissions['settings']) && !empty($permissions['settings']) ? $permissions['settings'] : array('basic' => 'on');
        $value = reset($tabs);
        $key = key($tabs);
        $tab = $this->request->getGet('tab')=='' ? $key : $this->request->getGet('tab');
        
        valid_session($this->module_name,$tab);

        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'settings';
        $page_data['page_title'] = 'settings';
        $page_data['tab'] = $tab;
        $page_data['page_data']['tab'] = $tab;
        $page_data['Crud_model'] = $this->Crud_model;
        if($tab=='basic'){
            $page_data['page_data']['language'] = $this->Crud_model->get_data(TBL_LANGUAGE,array('is_active'=>'1'));
        }elseif($tab=='theme'){
            $page_js = array(
                "plugins/spectrum-colorpicker/spectrum.js"
            );
            $page_data['page_js'] = $page_js;
        }elseif($tab=='pwa'){
            $page_js = array(
                "plugins/spectrum-colorpicker/spectrum.js"
            );
            $page_data['page_js'] = $page_js;
        }elseif($tab=='updates'){
            $page_data['page_data']['updates'] = get_update_info();
        }elseif($tab=='payment_gateway'){
            $page_js = array(
                "plugins/clipboard/clipboard.min.js",
            );
            $page_data['page_js'] = $page_js;
        }elseif($tab=='seo'){
            $page_js = array(
                "plugins/inputtags/inputtags.js"
            );
            $page_data['page_js'] = $page_js;
        }else if($tab=='application'){
            $page_data['page_data']['page'] = $this->Crud_model->get_data(TBL_PAGES,array('is_active'=>'1'));
        }elseif($tab=='plugins'){
            $page_js = array(
                "plugins/datatable/datatables.min.js",
                "plugins/datatable/dataTables.responsive.min.js",
                "plugins/datatable/responsive.bootstrap5.min.js"
            );
            $page_data['page_js'] = $page_js;
        }
        return admin_view('index',$page_data);
    }
    public function download_updates() {
        valid_session();
        $json = array();
        $json['status'] = false;
        $json['type'] = 'error';
        $json['title'] = translate('download_updates');
        $json['message'] = translate("something_went_wrong");

        $version = $this->request->getPost('version');
        $salt = $this->request->getPost('salt');
        if($version=='' || $salt==''){
            $json['title'] = $this->module_title;
            echo encode_json($json);exit;
        }
        $local_updates_dir = app_setting("app_updates_path");
        $update_zip = $local_updates_dir . $version . ".zip";
        if (is_file($update_zip)) {
            $json['message'] = translate("file_already_exists");
        } else {
            $new_update = download_update_file($salt);
            if ($new_update) {
                if (!is_dir($local_updates_dir)) {
                    if (!@mkdir($local_updates_dir)) {
                        $json['message'] = "Permission denied: $local_updates_dir directory is not writeable! Please set the writeable permission to the directory";
                        $json['title'] = $this->module_title;
                        echo encode_json($json);exit;
                    }
                }
                if (file_put_contents($update_zip, $new_update)) {
                    $json['status'] = true;
                    $json['type'] = 'succss';
                    $json['message'] = "Downloaded version-" . $version;
                }
            } else {
                $json['message'] = "Sorry, Version - $version download has been failed!";
            }
        }
        echo encode_json($json);
    }
    function do_update($version = "") {
        ini_set('max_execution_time', 300); 
        valid_session(array(0));
        $json = array();
        $json['status'] = false;
        $json['type'] = 'error';
        $json['title'] = translate('install_updates');
        $json['message'] = translate("something_went_wrong");

        $version = $this->request->getPost('version');

        if ($version) {
            $updates_info = get_update_info();
            if ($updates_info->next_installable_version != $version) {
                $json['message'] = translate("please_install_the_version").' - '.$updates_info->next_installable_version.' '.translate("first");
                $json['title'] = $this->module_title;
                echo encode_json($json);exit;
            }
            $local_updates_dir = app_setting("app_updates_path");
            if (!function_exists("zip_open")) {
                $json['message'] = translate("please_instal_the_ZIP_extension_in_your_server");
                $json['title'] = $this->module_title;
                echo encode_json($json);exit;
            }
            $local_update_url = $local_updates_dir . $version . '.zip';
            $zip = zip_open($local_update_url);
            $executeable_file = "";
            while ($active_file = zip_read($zip)) {
                $file_name = zip_entry_name($active_file);
                $dir = dirname($file_name);

                if (substr($file_name, -1, 1) == '/')
                    continue;

                if (!is_dir('././' . $dir)) {
                    mkdir('././' . $dir, 0755, true);
                }
                if (!is_dir('././' . $file_name)) {
                    $contents = zip_entry_read($active_file, zip_entry_filesize($active_file));
                    if ($file_name == 'execute.php') {
                        file_put_contents($file_name, $contents);
                        $executeable_file = $file_name;
                    } else {
                        file_put_contents($file_name, $contents);
                    }
                }
            }
            if ($executeable_file) {
                include ($executeable_file);
                unlink($executeable_file);
            }
            unlink($local_update_url);
            $json['status'] = true;
            $json['type'] = 'succss';
            $json['message'] = translate("version").' - '.$version.' '.translate("installed_successfully!");
        } else {
            $json['message'] = translate("something_went_wrong");
        }
        $json['title'] = $this->module_title;
        echo encode_json($json);exit;
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
            if($action=='basic'){
                if(!valid_session($this->module_name,'basic',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('basic_settings');
                $uis = array('app_title','app_short_title','app_language','app_timezone','app_date_format','app_time_format');

                $validation = array();
                foreach ($uis as $key) {
                    $validation[$key] = ['label' => translate($key), 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                array_push($uis,'app_footer_credit');
                foreach ($uis as $key) {
                    $up_data = array();
                    $up_data['value'] = $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }
                
                $ui = array('app_disable_password_reset','app_disable_registration','app_disable_google_font','app_maintenance_mode');
                foreach ($ui as $key) {
                    $up_data = array();
                    $up_data['value'] = $this->request->getPost($key)=='on' ? 'on' : 'off';
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='captcha'){
                if(!valid_session($this->module_name,'captcha',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('captcha_settings');

                $captcha_type = $this->request->getPost('captcha_type');
                if($captcha_type=='default'){
                    $validation['default'] = ['label' => $this->module_title, 'rules' => 'required'];
                }else if($captcha_type=='gv2'){
                    $validation['gv2'] = ['label' => $this->module_title, 'rules' => 'required'];
                }else if($captcha_type=='gv3'){
                    $validation['gv3'] = ['label' => $this->module_title, 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $up_data = array();
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                
                $up_data['value'] = 'off';
                if($captcha_type=='default'){
                    $up_data['value'] = 'default';
                }else if($captcha_type=='gv2'){
                    $up_data['value'] = 'gv2';
                }else if($captcha_type=='gv3'){
                    $up_data['value'] = 'gv3';
                }
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'captcha_status'));

                $up_data['value'] = '[]';
                if($captcha_type!='off'){
                    $up_data['value'] = json_encode($this->request->getPost($captcha_type));
                }
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'captcha_details'));

                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='firebase'){ 
                if(!valid_session($this->module_name,'firebase',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('firebase_settings');

                $firebase_status = $this->request->getPost('firebase_status');

                if($firebase_status=='on'){
                    $validation['firebase'] = ['label' => $this->module_title, 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $up_data = array();
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                
                $up_data['value'] = 'off';
                if($firebase_status=='on'){
                    $up_data['value'] = 'firebase';
                }
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'firebase_status'));

                $up_data['value'] = '[]';
                if($firebase_status!='off'){
                    $up_data['value'] = 'on';
                }
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'firebase_details'));

                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='theme'){
                if(!valid_session($this->module_name,'theme',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('theme_settings');
                $uis = array('app_color','menubar');

                $validation = array();
                foreach ($uis as $key) {
                    $validation[$key] = ['label' => translate($key), 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $uis = array('app_color','menubar');
                foreach ($uis as $key) {
                    $up_data = array();
                    $up_data['value'] = $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }

                $uis = array('app_color');
                foreach ($uis as $key) {
                    $hex = new Hex($this->request->getPost($key));
                    
                    $up_data = array();
                    $up_data['value'] = $hex->darken(5);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key.'_dark'));
                }

                $ui = array('app_rtl');
                foreach ($ui as $key) {
                    $up_data = array();
                    $up_data['value'] = $this->request->getPost($key)=='on' ? 'on' : 'off';
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }

                if(isset( $_FILES['app_logo'])){
                    if(move_upload_file_if_ok('app_logo',FCPATH."writable/uploads/logo.png")){
                        generate_logo();
                    }
                }

                if (isset($_FILES['app_favicon'])){
                    if(move_upload_file_if_ok('app_favicon',FCPATH."writable/uploads/favicon.png")){
                        generate_favicon();
                    }
                }
              
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='pop_up'){
                if(!valid_session($this->module_name,'pop_up',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('pop_up_settings');
                $uis = array('popup_banner');

                $validation = array();
                foreach ($uis as $key) {
                    $validation[$key] = ['label' => translate($key), 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
     
                $ui = array('popup_status','popup_banner');
                foreach ($ui as $key) {
                    $up_data = array();
                    $up_data['value'] = $key=='popup_status' ? ($this->request->getPost($key)=='on' ? 'on' : 'off') : $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='pwa'){
                if(!valid_session($this->module_name,'pwa',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('PWA_settings');
                
                if(isset($_FILES['pwa'])){
                    if(move_upload_file_if_ok('pwa',FCPATH."writable/uploads/pwa.png")){
                        generate_pwa();
                        $successmsg = "Image and";
                        $is_update =true;
                    }else{
                        $errormsg = " but image upload failed";
                    }
                }

                $uis = array('app_pwa_status','app_pwa_details');
                foreach ($uis as $key) {
                    $up_data = array();
                    $up_data['value'] = $key=='app_pwa_details' ? json_encode($this->request->getPost($key)) : $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }

                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='email'){
                if(!valid_session($this->module_name,'email',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('e-Mail_settings');

                $email_protocol = $this->request->getPost('email_protocol');

                $uis = array('email_from_name','email_from_user','email_protocol');
                if($email_protocol=='smtp'){ 
                    $uis = array_merge($uis,array('email_host','email_port','email_security_type','email_user','email_password'));
                }
                
                $validation = array();
                foreach ($uis as $key) {
                    $validation[$key] = ['label' => translate($key), 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                
                foreach ($uis as $key) {
                    $up_data = array();
                    $up_data['value'] = $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='payment_gateway'){
                if(!valid_session($this->module_name,'payment_gateway',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('payment_gateway_settings');
                $payment_gateway_type = $this->request->getPost('payment_gateway_type');

                if($payment_gateway_type=='razorpay'){
                    $validation['payment_gateway_type'] = ['label' => $this->module_title, 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $up_data = array();
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                
                $up_data['value'] = 'off';
                if($payment_gateway_type=='razorpay'){
                    $up_data['value'] = 'razorpay';
                }
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'payment_gateway_status'));

                $up_data['value'] = '[]';
                if($payment_gateway_type!='off'){
                    $up_data['value'] = json_encode($this->request->getPost('payment_gateway'));
                }
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'payment_gateway_details'));

                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='seo'){
                if(!valid_session($this->module_name,'seo',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('SEO_settings');
                $uis = array('seo_author','seo_visit_after','google_analytics_id','facebook_pixel_id','seo_title','seo_description','seo_keywords','seo_noscript');
                foreach ($uis as $key) {
                    $up_data = array();
                    $up_data['value'] = $key=='seo_noscript' ? json_encode($this->request->getPost($key)) : $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='license'){
                if(!valid_session($this->module_name,'license',false)){
                    $json['title'] = $this->module_title;
                    //echo encode_json($json);exit;
                }
                $this->module_title = translate('license_settings');
                $validation = array();
                $validation['license_key'] = ['label' => translate('license_key'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                
                $up_data = array();
                $up_data['value'] = base64_encode($this->request->getPost('license_key'));
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'license_key'));
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                    $json['url'] = admin_site_url('settings').'?tab=license';
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='remove_license'){
                if(!valid_session($this->module_name,'license',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('license_settings');
                $validation = array();
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                
                $up_data = array();
                $up_data['value'] = "";
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>'license_key'));
            
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                    $json['url'] = admin_site_url('settings').'?tab=license';
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }else if($action=='application'){
                if(!valid_session($this->module_name,'application',false)){
                    $json['title'] = $this->module_title;
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('application_settings');

                $uis = array('terms_and_conditions_page','return_refund_and_cancellation_policy_page','privacy_policy_page','disclaimer_page','app_maintenance_mode','app_maintenance_mode_details','front_page_access','app_translator');

                $validation = array();
                foreach ($uis as $key) {
                    $validation[$key] = ['label' => translate($key), 'rules' => 'required'];
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                array_push($uis,'header_custom_script');
                array_push($uis,'footer_custom_script');
                foreach ($uis as $key) {
                    $up_data = array();
                    $up_data['value'] = $key=='app_maintenance_mode_details' ? json_encode($this->request->getPost($key)) : $this->request->getPost($key);
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $is_update = $this->Crud_model->update_data($this->table,$up_data,array('key'=>$key));
                }
                if($is_update){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_details');
                }
            }
        }
        $json['title'] = $this->module_title;
        echo encode_json($json);exit;
    }
}
/* End of file Settings.php */
/* Location: ./app/controllers/Settings.php */