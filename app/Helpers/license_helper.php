<?php
use App\Models\Crud_model;
if (!function_exists('get_update_info')){
    function get_update_info(){
        $app_update_url = 'https://applic.hariomlabs.com/api/update/'.app_setting('app_code').'?version='.app_setting('app_version');
        $update = app_remote_get($app_update_url);
        $update = json_decode($update);
        $next_installable_version = "";
        $change_log = "";
        $description = "";
        $none_installed_versions = array();
        $installable_updates = array();
        $downloadable_updates = array();
        if(isset($update->status) && $update->status){
            $releases = decryptLicObj($update->details,app_setting('app_code'));
            foreach ($releases as $key => $value) {
                $version = $value['version'];
                $salt = encryptLic($value['update_file'],app_setting('app_code'));
                if (version_compare($value['version'], app_setting('app_version')) > 0) {
                    if (!$next_installable_version) {
                        $next_installable_version = $version;
                        $change_log = $value['change_log'];
                        $description = $value['description'];
                    }
                    $none_installed_versions[$version] = $salt;
                }
            }
            foreach ($none_installed_versions as $version => $salt) {
                $update_zip = app_setting('app_updates_path') . $version . '.zip';
                if (is_file($update_zip)) {
                    $installable_updates[$version] = $salt;
                } else {
                    $downloadable_updates[$version] = $salt;
                }
            }
        }
        $info = new stdClass();
        $info->current_version = app_setting('app_version');
        $info->next_installable_version = $next_installable_version;
        $info->change_log = $change_log;
        $info->description = $description;
        $info->none_installed_versions = $none_installed_versions;
        $info->installable_updates = $installable_updates;
        $info->downloadable_updates = $downloadable_updates;
        return $info;
    }
}
if (!function_exists('get_license_info')){
    function get_license_info(){
        $Crud_model = new Crud_model();

        $info = new stdClass();
        $host = $_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $host = rtrim($host,"/");
        $license = '';
        $license_str = app_setting('license_str');
        $app_license_url = 'https://applic.hariomlabs.com/api/validate/'.app_setting('app_code').'/'.base64_decode(app_setting('license_key')).'?host='.$host;
        $license = app_remote_get($app_license_url);
        $key = str_replace("-", "", base64_decode(app_setting('license_key')));
        if($license!=''){
            $license = json_decode($license);
            $license_str = isset($license->details) ? $license->details : '';
            $Crud_model->update_data(TBL_SETTINGS,array('value' => $license_str),array('key' => 'license_str'));

            $license = decryptLicObj($license_str,$key);
            $hosts = isset($license['host']) && $license['host']!='' ? explode(",", $license['host']) : array();
            $info->status = isset($license['status']) ? $license['status'] : false;
            $info->message = isset($license['message']) ? translate($license['message']) : translate('unknown');
            $info->key = isset($license['key']) ? get_lic_hidden_star_string($license['key']) : translate('unknown');
            $info->expire_on = isset($license['expire_on']) ? utc_to_local_datetime($license['expire_on'],'date') : translate('unknown');
            $info->host = in_array($host, $hosts) ? (isset($_SERVER['HTTPS']) ? "https://" : "http://").$host : translate('unknown');
            $info->support = isset($license['support']) ? $license['support'] : '<a href="https://support.hariomlabs.com" target="_blank">'.translate('click_here_for_support').'</a>';
        }else{
            $license = decryptLicObj($license_str,$key);
            $hosts = isset($license['host']) && $license['host']!='' ? explode(",", $license['host']) : array();
            $info->status = isset($license['status']) ? $license['status'] : false;
            $info->message = isset($license['message']) ? translate($license['message']) : translate('unknown');
            $info->host = in_array($host, $hosts) ? (isset($_SERVER['HTTPS']) ? "https://" : "http://").$host : translate('unknown');
            if (isset($license['expire_on']) && ($license['expire_on'] < date(DB_DATE_FORMAT))){
                $info->status = false;
                $info->message = translate('license_key_is_expired');
            }
            if(!in_array($host, $hosts) || empty($hosts)){
            	$info->status = false;
            	$info->message = translate('invalid_host_with_license_key');
                $info->host = translate('unknown');
            }
			$info->key = isset($license['key']) ? get_lic_hidden_star_string($license['key']) : translate('unknown');
            $info->expire_on = isset($license['expire_on']) ? utc_to_local_datetime($license['expire_on'],'date') : translate('unknown');
            $info->support = isset($license['support']) ? $license['support'] : '<a href="https://support.hariomlabs.com" target="_blank">'.translate('click_here_for_support').'</a>';
        }
        $info->support = '<a href="https://support.deepmindsit.com" target="_blank">'.translate('click_here_for_support').'</a>';
		$info->status = true;
        return $info;
    }
}
if(!function_exists('valid_session')){
    function valid_session($module = '',$action = '',$redirect = true) {
        $admin_id = user_setting('admin_id');
        $role_id = user_setting('role_id');
        $locked = user_setting('locked');
        $enable_2fa = user_setting('authentication_status');
        if($admin_id!=''){
            $permissions = array();
            if($role_id!=1){
                $permissions = user_setting('permissions');
            }
            $lic_url = admin_site_url('settings').'?tab=license';
            if(!get_license_info()->status){
                $current_url = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if($current_url!=$lic_url){
                    if(empty($permissions) || isset($permissions['settings']['license'])){
                        if($module=='dashboard' || $module=='profile'){
                            return true;
                        }else{
                            if($redirect){
                                app_redirect($lic_url, 'refresh');exit;
                            }else{
                                return false;
                            }
                        }
                    }else{
                        if($redirect){
                            app_redirect(admin_site_url('dashboard'), 'refresh');exit;
                        }else{
                            return false;
                        }
                    }
                }
            }
            if($enable_2fa=='1' && $locked=='1'){
                if($redirect){
                    app_redirect(admin_site_url('auth/lock'), 'refresh');exit;
                }else{
                    return false;
                }
            }
            if($module=='dashboard' || $module=='profile'){ return true; }
            if(empty($permissions) || (isset($permissions[$module][$action]) || isset($permissions[$module][strtoupper($action)]) || isset($permissions[strtolower($module)][$action]) )){ }
            else{
                if($redirect){
                    app_redirect(admin_site_url('dashboard'), 'refresh');exit;
                }else{
                    return false;
                }
            } return true;
        }
        else{
            app_redirect(admin_site_url('login'), 'refresh');exit;
        }
    }
}
if (!function_exists('download_update_file')){
    function download_update_file($salt){
        $url = decryptLic($salt,app_setting('app_code'));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-type: text/plain'));
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
if(!function_exists("app_remote_get")) {
    function app_remote_get($url) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_FOLLOWLOCATION=>true
        ));
        $data = curl_exec($ch);
        return $data;
    }
}
if(!function_exists("encryptLic")) {
    function encryptLic($plaintext,$key){
        $plaintext=rand(10, 99).$plaintext.rand(10, 99);
        $ivlen = openssl_cipher_iv_length("AES-256-CBC");
        $ivstr=hash('sha256',$key);
        if($ivlen>64 && $ivlen <=128){
            $ivstr.=hash('sha256',$ivstr);
        }elseif($ivlen>256 && $ivlen <=512){
            $ivstr.=hash('sha256',$ivstr);
            $ivstr.=$ivstr;
        }
        $iv=substr($ivstr, 0,$ivlen);
        $key=md5($key);
        $ciphertext_raw = openssl_encrypt($plaintext, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $ciphertext = base64_encode($ciphertext_raw );
        return $ciphertext;
    }
}
if(!function_exists("decryptLic")) {
    function decryptLic($ciphertext,$key){
        $ivlen = openssl_cipher_iv_length("AES-256-CBC");
        $ivstr=hash('sha256',$key);
        if($ivlen>64 && $ivlen <=128){
            $ivstr.=hash('sha256',$ivstr);
        }elseif($ivlen>256 && $ivlen <=512){
            $ivstr.=hash('sha256',$ivstr);
            $ivstr.=$ivstr;
        }
        $iv=substr($ivstr, 0,$ivlen);
        $key=md5($key); 
        $c = base64_decode($ciphertext);
        $original_plaintext = openssl_decrypt($c, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);  
        $original_plaintext=substr($original_plaintext, 2,-2);
        return $original_plaintext;
    }
}
if(!function_exists("encryptLicObj")) {
    function encryptObj($obj,$key=''){
        $text=serialize($obj);
        return encryptLic($text,$key);
    }
}
if(!function_exists("decryptLicObj")) {
    function decryptLicObj($ciphertext,$key=''){
        $text=decryptLic($ciphertext,$key);
        return unserialize($text);
    }
}
if(!function_exists("get_lic_hidden_star_string")){
    function get_lic_hidden_star_string($string){
        $str_length=strlen($string);
        return $str_length>10?substr($string, 0,4).str_repeat("*", ($str_length-4)).substr($string, -4):substr($string, 0,2)."****".substr($string, -2);   
    }
}