<?php
use App\Models\Crud_model;
use Gregwar\Captcha\CaptchaBuilder;
use claviska\SimpleImage;

if(!function_exists('is_valid_client_user')){
    function is_valid_client_user($client_id='',$user_id=''){
        if($user_id==''){
            $user_id = user_setting('admin_id');
        }
        if($client_id!=''){
            return get_column_value(TBL_ACCESS,array('client_id'=>$client_id,'user_id'=>$user_id),'id',false);
        }
        return false;
    }
}
if(!function_exists('get_unique_slug')){
    function get_unique_slug($tbl,$name='', $id= '', $i=0){
        $Crud_model = new Crud_model();
        $exceptions = array();
        $data = trim($name);
        if($i!=0){ $data = $name.' '.$i; }
        $url =  url_title($data,'-',true);

        $where = array();
        $where['slug'] = $url;
        if($id!=''){
            $where['id!='] = $id;
        }

        if(in_array($url, $exceptions)){
            return get_unique_slug($tbl,$name,$id,$i+1);
        }
        if($Crud_model->get_data_row($tbl,$where)){
            return get_unique_slug($tbl,$name,$id,$i+1);
        }
        return $url;
    }
}
if(!function_exists("get_hidden_star_string")){
    function get_hidden_star_string($string){
        $str_length=strlen($string);
        return $str_length>10?substr($string, 0,4).str_repeat("*", ($str_length-4)).substr($string, -4):substr($string, 0,2)."****".substr($string, -2);
        
    }
}
if(!function_exists('get_currency_with_amt')){
    function get_currency_with_amt($amount='',$position='l',$code='₹'){
        if($position=='r'){
            return $amount.$code;
        }else{
            return $code.$amount;
        }
    }
}
if(!function_exists('get_crud_user_details')){
    function get_crud_user_details($data,$column){
        $Crud_model = new Crud_model();

        $data = json_decode($data);
        $type = isset($data->type) ? $data->type : '';
        $id = isset($data->id) ? $data->id : '';
        if($type!='' && $id!=''){
            $tbl = '';
            switch (strtolower($type)) {
                case 'admin':$tbl = TBL_ADMIN;break;
                default:$tbl = '';break;
            }
            if($tbl!=''){
                return $Crud_model->get_column_value($tbl,array('id'=>$id),$column,translate('unknown'));
            }
        }
        return translate('unknown');
    }
}
if(!function_exists('get_parent_categories')){
    function get_parent_categories($id=0,$data=array()){
        $Crud_model = new Crud_model();
        $category = $Crud_model->get_data_row(TBL_CATEGORY,array('id'=>$id));
        if(isset($category) && !empty($category)){
            $data[] = $category->id;
            return get_parent_categories($category->parent_id,$data);
        }
        return array_reverse($data);
    }
}

if(!function_exists('rearrange_categories')){
    function rearrange_categories(){
        $Crud_model = new Crud_model();
        $category = $Crud_model->get_data(TBL_CATEGORY);
        if(isset($category) && !empty($category)){
            $cat = array();
            foreach ($category as $key => $value) {
                $path_array = get_parent_categories($value->parent_id);
                $path = !empty($path_array) ? implode('-', $path_array) : 0;

                $Crud_model->update_data(TBL_CATEGORY,array('path'=>$path),array('id'=>$value->id));
            }
        }

    }
}

if(!function_exists('get_category_path_name_string')){
    function get_category_path_name_string($path=0,$id=0){
        if($path!=0){
            $list = array();
            $paths = explode('-', $path);
            foreach ($paths as $key => $value) {
                $list[] = get_column_value(TBL_CATEGORY,array('id'=>$value),'name');
            }
            if($id!=0){
                $list[] = get_column_value(TBL_CATEGORY,array('id'=>$id),'name');
            }
            return implode(' » ', $list);
        }else{
            if($id!=0){
                return get_column_value(TBL_CATEGORY,array('id'=>$id),'name');
            }else{
                return translate('no_parent');
            }
        }
    }
}

if(!function_exists('app_file_manager')){
    function app_file_manager($name,$id,$type=1,$default='',$required=true){ //0 = Filemanager,1 = Image,2 = File,3 = Video
        $req = $required==true ? 'required' : '';
        if($type==1){
            $default = $default!='' ? $default : 'default.png';
            $html = '<a href="javascript:void(0);" data-url="'.base_url('filemanager/dialog.php?type='.$type.'&field_id='.$id).'" class="btn-iframe" data-original-title="'.translate('click_on_the_image_to_change').'" data-placement="top" data-toggle="tooltip" title="'.translate('click_on_the_image_to_change').'">
            <img src="'.uploads_url($default).'" class="img-thumbnail" id="img_'.$id.'" alt="'.$name.'"></a><input name="'.$name.'" value="'.$default.'" id="'.$id.'" type="text" style="display:none;" data-parsley-errors-container="#error_'.$id.'" '.$required.'><span id="error_'.$id.'"></span>';
        }else{
            $html = '<div class="input-group">
                    <textarea rows="1" aria-describedby="'.$id.'" aria-label="'.translate('select_'.$name).'" class="form-control" placeholder="'.translate('select_'.$name).'" id="'.$id.'" name="'.$name.'" data-parsley-errors-container="#error_'.$id.'" '.$required.'>'.$default.'</textarea>
                    <div class="input-group-btn">
                        <a class="btn ripple btn-primary rounded-start-0 btn-iframe" href="javascript:void(0);" data-url="'.base_url('filemanager/dialog.php?type='.$type.'&field_id='.$id).'"><i class="fa fa-folder-open-o"></i></a>
                    </div>
                </div>
                <span id="error_'.$id.'"></span>';
        }
        return $html;
    }
}
/**
 * return file upload success or not 
 * 
 * @param string $name
 * @param string $destination_path
 * @return bool success
 */
if(!function_exists("move_upload_file_if_ok")){
    function move_upload_file_if_ok($name,$destination_path){
        if(isset($_FILES[$name]) && empty($_FILES[$name]['error'])){
            $dirname=dirname($destination_path);
            if(!is_dir($dirname)){
                if(!mkdir($dirname,0755,true)){
                    return false;
                }
            }
            return move_uploaded_file($_FILES[$name]['tmp_name'], $destination_path);;
        }
        return false;
    }
}
if (!function_exists('generate_pwa')) {
    function generate_pwa($filename="") {
        if(empty($filename)){
            $filename=FCPATH.'writable/uploads/pwa.png';
        }
        app_image_resize_by_width($filename,180,FCPATH.'writable/uploads/pwa.png');
        app_image_resize_by_height($filename,192,FCPATH.'writable/uploads/pwa.png');
        copy($filename, FCPATH.'writable/uploads/pwa.png');
        copy($filename, FCPATH.'writable/uploads/pwa-light.png');
        
        $sizes = array('192'=>'pwa-192x192','256'=>'pwa-256x256','384'=>'pwa-384x384','512'=>'pwa-512x512');
        foreach ($sizes as $key => $value) {
            app_image_resize($filename,$key,$key,FCPATH."writable/uploads/".$value.".png");
        }
    }
}
if (!function_exists('generate_logo')) {
    function generate_logo($filename="") {
        if(empty($filename)){
            $filename=FCPATH.'writable/uploads/logo.png';
        }
        copy($filename, FCPATH.'writable/uploads/logo-light.png');
    }
}
if (!function_exists('generate_favicon')) {
    function generate_favicon($filename="") {
        if(empty($filename)){
            $filename=FCPATH.'writable/uploads/favicon.png';
        }
        copy($filename, FCPATH.'writable/uploads/favicon-light.png');
    }
}
if (!function_exists('app_image_resize')) {
    function app_image_resize($filename,$width,$height,$newfilename=null,$position='top left') {
        if(!empty($newfilename)){
            if(file_exists($newfilename) && $filename!=$newfilename){
                unlink($newfilename);
            }
        }
        $m = new \claviska\SimpleImage($filename);
        if ($width != '' || $height != '') {
            $m->thumbnail($width, $height, $position);
            $m->save($newfilename);
        }
    }
}
if (!function_exists('app_image_resize_by_width')) {
    function app_image_resize_by_width($filename,$width,$newfilename=null) {
        $isForceSave=false;
        if(!empty($newfilename) && $filename!=$newfilename){
            if(file_exists($newfilename)){
                unlink($newfilename);
            }
            $isForceSave=true;
        }
        $m = new \claviska\SimpleImage($filename);
        if ($isForceSave || $width != '') {
            $m->fit_to_width($width);
            $m->save($newfilename);
        }
    }
}
if (!function_exists('app_image_resize_by_height')) {
    function app_image_resize_by_height($filename,$height,$newfilename=null) {
        $isForceSave=false;
        if(!empty($newfilename)){
            if(file_exists($newfilename) && $filename!=$newfilename){
                unlink($newfilename);
            }
            $isForceSave=true;
        }
        $m = new \claviska\SimpleImage($filename);
        if ($isForceSave || $height != '') {
            $m->fit_to_height($height);
            $m->save($newfilename);
        }
    }
}
if (! function_exists ( "clean_html" )) {
    function clean_html($html){
        if ($html != '') {
            $html = preg_replace('/<\s*head.+?<\s*\/\s*head.*?>/si', ' ', $html);
            $html = preg_replace('/<\s*style.+?<\s*\/\s*style.*?>/si', ' ', $html);
            $html = preg_replace('/<\s*javascript.+?<\s*\/\s*javascript.*?>/si', ' ', $html);
            $html = strip_tags($html, '<h1><h2><h3><h4><strong><b><br><pre><span><ul><ol><u><font><li><table><tr><img><div><td><th><tbody><thead><tfoot><hr><p><a><iframe><figure><figcaption><video>');
            $ckHtml = check_html($html);
            if (empty($ckHtml) && !empty($html)) {
                $ckHtml = check_html($html, true);
            }
            if (!empty($ckHtml)) {
                $html = $ckHtml;
            }
            $html = preg_replace('/p class=\"MsoNormal\"\>/si', ' ', $html);
        }
        return $html;
    }
}
if (! function_exists ( "check_html" )) {
    function check_html( $html ,$force_not_mb_string=false ) {
        if(function_exists("libxml_use_internal_errors") && class_exists("DOMDocument") &&  (defined('LIBXML_HTML_NOIMPLIED') || defined('LIBXML_HTML_NODEFDTD'))) {
            libxml_use_internal_errors( true ); //use this to prevent warning messages from displaying because of the bad HTML
            $doc = new DOMDocument();
            if(!$force_not_mb_string && function_exists("mb_convert_encoding")) {
                $doc->loadHTML( mb_convert_encoding( $html, 'HTML-ENTITIES', 'UTF-8' ), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
            }else{
                $doc->loadHTML( '<?xml encoding="utf-8" ?>'.$html,  LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
            }
            $html = @$doc->saveHTML();
        }
        return $html;
    }
}
/**
 * send mail
 * 
 * @param string $to
 * @param string $subject
 * @param string $message
 * @param array $optoins
 * @return true/false
 */
if (!function_exists('send_app_mail')) {

    function send_app_mail($to, $subject, $message, $optoins = array(), $convert_message_to_html = true) {
        $email_config = Array(
            'charset' => 'utf-8',
            'mailType' => 'html'
        );

        //check mail sending method from settings
        if (get_setting("email_protocol") === "smtp") {
            $email_config["protocol"] = "smtp";
            $email_config["SMTPHost"] = get_setting("email_smtp_host");
            $email_config["SMTPPort"] = get_setting("email_smtp_port");
            $email_config["SMTPUser"] = get_setting("email_smtp_user");
            $email_config["SMTPPass"] = decode_password(get_setting('email_smtp_pass'), "email_smtp_pass");
            $email_config["SMTPCrypto"] = get_setting("email_smtp_security_type");

            if (!$email_config["SMTPCrypto"]) {
                $email_config["SMTPCrypto"] = "tls"; //for old clients, we have to set this by default
            }

            if ($email_config["SMTPCrypto"] === "none") {
                $email_config["SMTPCrypto"] = "";
            }
        }

        $email = \CodeIgniter\Config\Services::email();
        $email->initialize($email_config);
        $email->clear(true); //clear previous message and attachment

        $email->setNewline("\r\n");
        $email->setCRLF("\r\n");
        $email->setFrom(get_setting("email_sent_from_address"), get_setting("email_sent_from_name"));

        $email->setTo($to);
        $email->setSubject($subject);

        if ($convert_message_to_html) {
            $message = htmlspecialchars_decode($message);
        }

        $email->setMessage($message);

        //add attachment
        $attachments = get_array_value($optoins, "attachments");
        if (is_array($attachments)) {
            foreach ($attachments as $value) {
                $file_path = get_array_value($value, "file_path");
                $file_name = get_array_value($value, "file_name");
                $email->attach(trim($file_path), "attachment", $file_name);
            }
        }

        //check reply-to
        $reply_to = get_array_value($optoins, "reply_to");
        if ($reply_to) {
            $email->setReplyTo($reply_to);
        }

        //check cc
        $cc = get_array_value($optoins, "cc");
        if ($cc) {
            $email->setCC($cc);
        }

        //check bcc
        $bcc = get_array_value($optoins, "bcc");
        if ($bcc) {
            $email->setBCC($bcc);
        }

        //send email
        if ($email->send()) {
            return true;
        } else {
            //show error message in none production version
            if (ENVIRONMENT !== 'production') {
                throw new \Exception($email->printDebugger());
            }
            return false;
        }
    }

}


/**
 * get users ip address
 * 
 * @return ip
 */
if (!function_exists('get_real_ip')) {

    function get_real_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
if (! function_exists ("add_parser_varialbes")) {
    function text_parser_varialbes($template) {
        return $template;
        /*$search = base_url("writable/uploads/");
        $replace = '{APP_BASE_URL}';
        echo preg_replace($search,$replace,$template);
        /*$parser = \Config\Services::parser();
        $parser->setDelimiters('','');

        $parser_data = array();
        $parser_data['APP_BASE_URL']   = base_url('writable/uploads/');
        $parser_data[base_url('writable/uploads/')]   = 'APP_BASE_URL';
        echo $parser->setData($parser_data)->renderString($template);exit;
        return $parser->setData($parser_data)->renderString($template);*/
    }
}
if (! function_exists ("remove_parser_varialbes")) {
    function remove_parser_varialbes($template) {
        $parser = \Config\Services::parser();
        $parser_data = array();
        $parser_data['APP_BASE_URL']   = base_url('writable/uploads/');
        return $parser->setData($parser_data)->renderString($template);
    }
}
/**
 * use this to return settings key value
 *
 * @param string $rpp
 * @return string array
 */
if(!function_exists('create_dt_length_menu')){
    function create_dt_length_menu($rpp = ''){
        $list = array(10,20,25,50,100,500);
        if($rpp!=''){ $list[] = $rpp; }
        $list = array_unique($list); sort($list);
        $list = implode(",",$list);
        return '['.$list.']';
    }
}
if(!function_exists('app_html_editor')){
    function app_html_editor($name,$id,$placeholder='',$default_text='',$required=true,$height='350'){
        $req = $required==true ? 'required' : '';
        $html ='<textarea class="form-control html_editor" name="'.$name.'" id="'.$id.'" placeholder="'.$placeholder.'" data-height="'.$height.'" data-parsley-errors-container="#error_html_editor_'.$id.'" '.$req.'>'.text_parser_varialbes($default_text).'</textarea>'
            .'<span id="error_html_editor_'.$id.'"></span>';
        return $html;
    }
}

if(!function_exists('get_user_details')){
    function get_user_details($data,$column){
        $Crud_model = new Crud_model();

        $data = json_decode($data);
        $type = isset($data->type) ? $data->type : '';
        $id = isset($data->id) ? $data->id : '';
        if($type!='' && $id!=''){
            $tbl = '';
            switch (strtolower($type)) {
                case 'admin':$tbl = TBL_ADMIN;break;
                default:$tbl = '';break;
            }
            if($tbl!=''){
                return $Crud_model->get_column_value($tbl,array('id'=>$id),$column,translate('unknown'));
            }
        }
        return translate('unknown');
    }
}

if(!function_exists('utc_to_local_datetime')){
    function utc_to_local_datetime($datetime,$type='datetime'){
        $session = session();
        $user_id = $session->get('admin_id');
        
        $timezone = get_column_value(TBL_ADMIN,array('id'=>$user_id),'timezone',DEFAULT_TIMEZONE);
        $date_format = get_column_value(TBL_ADMIN,array('id'=>$user_id),'date_format',DB_DATE_FORMAT);
        $time_format = get_column_value(TBL_ADMIN,array('id'=>$user_id),'time_format',DB_TIME_FORMAT);
        
        switch ($type) {
            case 'datetime': $format = $date_format.' '.$time_format; break;
            case 'date': $format = $date_format; break;
            case 'time': $format = $time_format; break;
            default: $format = DB_DATETIME_FORMAT; break;
        }
        
        $date = new DateTime($datetime . ' +00:00');
        $date->setTimezone(new DateTimeZone($timezone));
        return $date->format($format);
    }
}
if (!function_exists('local_to_utc_datetime')) {
    function local_to_utc_datetime($datetime,$type='datetime') {
        $session = session();
        $user_id = $session->get('admin_id');
        
        switch ($type) {
            case 'datetime': $format = DB_DATETIME_FORMAT; break;
            case 'date': $format = DB_DATE_FORMAT; break;
            case 'time': $format = DB_TIME_FORMAT; break;
            default: $format = DB_DATETIME_FORMAT; break;
        }
        $date = new DateTime($datetime, new DateTimeZone(get_column_value(TBL_ADMIN,array('id'=>$user_id),'timezone',DEFAULT_TIMEZONE)));
        $date->setTimezone(new DateTimeZone("UTC"));
        return $date->format($format);
    }
}
if(!function_exists('encode_string')){
    function encode_string($string, $url_safe = TRUE) {
        /*$CI = & get_instance();
        $CI->load->library('encryption');
        $string = $CI->encryption->encrypt($string);
        if ($url_safe) {
            $string = strtr(
                $string, array(
                    '+' => '.',
                    '=' => '-',
                    '=' => '_',
                    '/' => '~'
                )
            );
        }*/
        $string = base64_encode($string);
        return $string;
    }
}
if(!function_exists('decode_string')){
    function decode_string($string) {
        /*$CI = & get_instance();
        $CI->load->library('encryption');
        $string = strtr(
            $string, array(
                '.' => '+',
                '-' => '=',
                '_' => '=',
                '~' => '/'
            )
        );
        $string = $CI->encryption->decrypt($string);*/
        $string = base64_decode($string);
        return $string;
    }
}
/**
 * use this to return settings key value
 *
 * @param string $key
 * @param string $default
 * @return string value
 */
if (!function_exists('app_setting')) {
    function app_setting($key,$default='') {
        $value = get_array_value(config('abGorad')->app_settings_array, $key);
        if ($value !== NULL) {
            return $value;
        } else {
            if (isset(config('abGorad')->$key)) {
                return config('abGorad')->$key;
            }else {
                return $default;
            }
        }
    }
}

/**
 * use this to return logged user key value
 *
 * @param string $key
 * @param string $default
 * @return string value
 */
if (!function_exists('user_setting')) {
    function user_setting($key,$default='') {
        $value = get_array_value(config('abGorad')->app_login_user_array, $key);
        if ($value !== NULL) {
            return $value;
        } else {
            if (isset(config('abGorad')->$key)) {
                return config('abGorad')->$key;
            }else {
                return $default;
            }
        }
    }
}

if (!function_exists('client_setting')) {
    function client_setting($key,$default='') {
        $value = get_array_value(config('abGorad')->app_login_client_array, $key);
        if ($value !== NULL) {
            return $value;
        } else {
            if (isset(config('abGorad')->$key)) {
                return config('abGorad')->$key;
            }else {
                return $default;
            }
        }
    }
}

/**
 * link the css files 
 * 
 * @param array $array
 * @return print css links
 */
if (!function_exists('load_home_css')) {
    function load_home_css(array $array) {
        $version = app_setting("app_version");
        $pre_uri = 'assets/home/';
        foreach ($array as $uri) {
            echo "<link rel='stylesheet' type='text/css' href='" . base_url($pre_uri.$uri) . "?v=$version' />";
        }
    }
}

/**
 * link the javascript files 
 * 
 * @param array $array
 * @return print js links
 */
if (!function_exists('load_home_js')) {
    function load_home_js(array $array) {
        $version = app_setting("app_version");
        $pre_uri = 'assets/home/';
        foreach ($array as $uri) {
            echo "<script type='text/javascript'  src='" . base_url($pre_uri.$uri) . "?v=$version'></script>";
        }
    }
}

if (!function_exists('home_assets_url')) {
    function home_assets_url($uri='') {
        $pre_uri = 'assets/home/';
        if($uri!='') {
            return base_url($pre_uri.$uri);
        }
    }
}

/**
 * link the css files 
 * 
 * @param array $array
 * @return print css links
 */
if (!function_exists('load_admin_css')) {
    function load_admin_css(array $array) {
        $version = app_setting("app_version");
        $pre_uri = 'assets/admin/';
        foreach ($array as $uri) {
            echo "<link rel='stylesheet' type='text/css' href='" . base_url($pre_uri.$uri) . "?v=$version' />";
        }
    }
}

/**
 * link the javascript files 
 * 
 * @param array $array
 * @return print js links
 */
if (!function_exists('load_admin_js')) {
    function load_admin_js(array $array) {
        $version = app_setting("app_version");
        $pre_uri = 'assets/admin/';
        foreach ($array as $uri) {
            echo "<script type='text/javascript'  src='" . base_url($pre_uri.$uri) . "?v=$version'></script>";
        }
    }
}

/**
 * use this to return table column value
 *
 * @param string $tbl
 * * @param string $where
 * * @param string $column
 * @param string $default
 * @return string value
 */
if (!function_exists('get_column_value')) {
    function get_column_value($tbl,$where,$column,$default='') {
        $Crud_model = new Crud_model();
        return $Crud_model->get_column_value($tbl,$where,$column,$default);
    }
}

/**
 * return file upload success or not 
 * 
 * @param string $name
 * @param string $destination_path
 * @return bool success
 */
/*if(!function_exists("move_upload_file_if_ok")){
    function move_upload_file_if_ok($name,$destination_path){
        if(isset($_FILES[$name]) && empty($_FILES[$name]['error'])){
            $dirname=dirname($destination_path);
            if(!is_dir($dirname)){
                if(!mkdir($dirname,0755,true)){
                    return false;
                }
            }
            return move_uploaded_file($_FILES[$name]['tmp_name'], $destination_path);;
        }
        return false;
    }
}*/

if (!function_exists('app_image_resize')) {
    function app_image_resize($filename,$width,$height,$newfilename=null,$position='top left') {
        if(!empty($newfilename)){
            if(file_exists($newfilename) && $filename!=$newfilename){
                unlink($newfilename);
            }
        }
        $m = new \claviska\SimpleImage($filename);
        if ($width !='' || $height != '') {
            $m->thumbnail($width, $height, $position);
            $m->save($newfilename);
        }
    }
}
if (!function_exists('app_image_resize_by_width')) {
    function app_image_resize_by_width($filename,$width,$newfilename=null) {
        $isForceSave=false;
        if(!empty($newfilename) && $filename!=$newfilename){
            if(file_exists($newfilename)){
                unlink($newfilename);
            }
            $isForceSave=true;
        }
        $m = new \claviska\SimpleImage($filename);
        if ($isForceSave || $im_width != '') {
            $m->fit_to_width($width);
            $m->save($newfilename);
        }
    }
}
if (!function_exists('app_image_resize_by_height')) {
    function app_image_resize_by_height($filename,$height,$newfilename=null) {
        $isForceSave=false;
        if(!empty($newfilename)){
            if(file_exists($newfilename) && $filename!=$newfilename){
                unlink($newfilename);
            }
            $isForceSave=true;
        }
        $m = new \claviska\SimpleImage($filename);
        $im_height = $m->getHeight();
        if ($isForceSave || $im_height != $height) {
            $m->fit_to_height($height);
            $m->save($newfilename);
        }
    }
}

if (!function_exists('admin_view')) {
    function admin_view($view,$params = array()) {
        return view('admin/'.$view,$params);
    }
}
if (!function_exists('client_view')) {
    function client_view($view,$params = array()) {
        return view('client/'.$view,$params);
    }
}

if (!function_exists('home_view')) {
    function home_view($view,$params = array()) {
        return view($view,$params);
    }
}

if (!function_exists('home_site_url')) {
    function home_site_url($url="") {
        return site_url($url);
    }
}

/**
 * use this to translate text
 *
 * @param string $type
 * * @param string $data
 * @return string word
 */
if ( ! function_exists('add_app_log')){
    function add_app_log($table,$type='0',$data_id=0,$new_data=array(),$old_data=array(),$updated=array()){
        $request = \Config\Services::request();
        $Crud_model = new Crud_model();
        $session = session();
        if(empty($updated)){
            $updated = array();
            $updated['type'] = 'admin';
            $updated['id'] = $session->get('admin_id');
        }

        $agent = $request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser().' '.$agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->robot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified';
        }

        $up_data = array();
        $up_data['type']        = $type;
        $up_data['agent']       = $currentAgent;
        $up_data['platform']    = $agent->getPlatform();
        $up_data['ip']          = get_real_ip();
        $up_data['data_id']     = $data_id;
        $up_data['table']       = strtoupper($table);
        $up_data['old_data']    = json_encode($old_data);
        $up_data['new_data']    = json_encode($new_data);
        $up_data['created_by']  = json_encode($updated);
        $up_data['created_on']  = date(DB_DATETIME_FORMAT);
        $Crud_model->insert_data(TBL_ACTIVITY_LOGS,$up_data);
        return true;
    }
}

/**
 * return full admin URL 
 * 
 * @param string $url
 * @return string url
 */
if (!function_exists('admin_site_url')) {
    function admin_site_url($url="") {
        return site_url('admin/'.$url);
    }
}
/**
 * redirect to a location within the app
 * 
 * @param string $url
 * @return void
 */
if (!function_exists('app_redirect')) {
    function app_redirect($url, $global_link = false, $is_home = false) {
        if ($global_link) {
            header("Location:$url");
        } else {
            if($is_home){
                header("Location:" . home_site_url($url));
            }else{
                header("Location:" . admin_site_url($url));
            }
        }
        exit;
    }
}

/**
 * check the array key and return the value 
 * 
 * @param array $array
 * @return extract array value safely
 */
if (!function_exists('get_array_value')) {
    function get_array_value($array, $key) {
        if (is_array($array) && array_key_exists($key, $array)) {
            return $array[$key];
        }
    }

}

/**
 * use this to load admin css file
 *
 * @param string $uri
 * @param string $version
 * @return string uri
 */
if (!function_exists('admin_css_url')){
    function admin_css_url($uri = '',$version=''){

        if(!empty($version)){
            $version = app_setting("app_version");
            if (strpos($uri, '?')!==FALSE){
                $version="&v=$version";
            }else{
                $version="?v=$version";
            }
        }
        return base_url($pre_uri.$uri).$version;
    }
}

/**
 * use this to load admin js file
 *
 * @param string $uri
 * @param string $version
 * @return string uri
 */
if (!function_exists('admin_js_url')){
    function admin_js_url($uri = '',$version=''){
        $pre_uri = 'assets/admin/';
        if(!empty($version)){
            $version = app_setting("app_version");
            if (strpos($uri, '?')!==FALSE){
                $version="&v=$version";
            }else{
                $version="?v=$version";
            }
        }
        return base_url($pre_uri.$uri).$version;
    }
}

/**
 * use this to load admin js file
 *
 * @param string $uri
 * @param string $version
 * @return string uri
 */
if (!function_exists('uploads_url')){
    function uploads_url($uri = ''){
        $uri = $uri!='' ? $uri : 'default.png';
        return base_url('writable/uploads/'.$uri);
    }
}

/**
 * use this to check file exist
 *
 * @param string $file
 * @param string $default
 * @return string file
 */
if (!function_exists('app_file_exists')) {
    function app_file_exists($file='',$default='') {
        if($file!='' && strpos($file, '.') && file_exists(str_replace(base_url(), FCPATH, $file))){
            return $file;
        }
        if($default!=''){
            return $default;
        }
        return false;
    }
}

if(!function_exists('get_all_languages')){
    function get_all_languages(){
        $Crud_model = new Crud_model();
        return $Crud_model->get_data(TBL_LANGUAGE,array('is_active'=>'1'));
    }
}

if(!function_exists('get_active_language')){
    function get_active_language(){
        $Crud_model = new Crud_model();
        $session = session();

        $slug = $session->get('language')!='' ? $session->get('language') : 'en';
        return $Crud_model->get_data_row(TBL_LANGUAGE,array('slug'=>$slug,'is_active'=>'1'));
    }
}

/**
 * use this to translate text
 *
 * @param string $word
 * @return string word
 */
if ( ! function_exists('translate')){
    function translate($word){
        $Crud_model = new Crud_model();
        $session = session();

        $set_lang = $session->get('language');
        if($set_lang != $session->get('language') || $set_lang==''){
            $set_lang = app_setting('app_language','en');
        }
        $r = $Crud_model->get_data_row(TBL_LANGUAGE,array('slug'=>$set_lang,'is_active'=>'1'));
        if(empty($r)){
            $set_lang = app_setting('app_language','en');
            $session->set('language',$set_lang);
        }
        $result = $Crud_model->get_data_row(TBL_LANGUAGE_TRANSLATION,array('word'=>$word));
        if(!empty($result)){
            if($result->$set_lang !== NULL && $result->$set_lang !== ''){
                $return = $result->$set_lang;
                $lang = $set_lang;
            }
            else {
                $return = $result->en;
                $lang = 'en';
            }
        } else {
            $data['word'] = $word;
            $data['en'] = ucwords(str_replace('_', ' ', $word));
            $Crud_model->insert_data(TBL_LANGUAGE_TRANSLATION,$data);
            $return = ucwords(str_replace('_', ' ', $word));
            $lang = 'en';
        }
        return $return;
    }
}

/**
 * use this to get captcha
 *
 * @param string $type
 * @param string $key
 * @return string html or base64
 */
if(!function_exists('get_captcha')){
    function get_captcha($type,$key){
        $details = app_setting('captcha_details');
        $details = json_decode($details);
        if($type=='default'){
            $session = session();

            $keystr = random_string($details->str, $details->len);
            $captcha = new Gregwar\Captcha\CaptchaBuilder($keystr);
            $captcha->setBackgroundColor(255,255,255);  
            $keystr=$captcha->getPhrase();
            $width=35*$details->len;
            $captcha->build($width,50);
            $session->set($key, $keystr);
            $obj=new stdClass();
            $obj->key=$key;
            //$obj->keystr=$keystr;
            $obj->img=$captcha->inline();
            return $obj;
        }else if($type=='gv2'){
            $html = '<div class="text-center"><div class="g-recaptcha recaptcha" id="'.$key.'" data-theme="light" data-sitekey="'.$details->site.'" style="display: inline-block;"></div>';
            $html .= '<input id="txt_captch_error_'.$key.'" type="text" style="display:none;" data-parsley-errors-container="#captch_error_'.$key.'" data-parsley-required="true" value="">';
            $html .= '<span id="captch_error_'.$key.'"></span></div>';
            return $html;
        }
    }
}
if(!function_exists('get_auth_qr')){
    function get_auth_qr($type='g'){
        if($type=='g'){
            require_once(APPPATH . "Libraries/GoogleAuthenticator.php");
            $authenticator = new GoogleAuthenticator();
            $secret = $authenticator->generateSecret();
            $image = $authenticator->getUrl(app_setting('app_title'), user_setting('username'), $secret);
            
            $obj=new stdClass();
            $obj->secret=$secret;
            $obj->image=$image;
            return $obj;
        }
    }
}
if(!function_exists('verify_auth_qr')){
    function verify_auth_qr($type='g',$secret='',$totp=''){
        if($type=='g'){
            require_once(APPPATH . "Libraries/GoogleAuthenticator.php");
            $authenticator = new GoogleAuthenticator();
        }
        return $authenticator->checkCode($secret, $totp);
    }
}
if(!function_exists('encode_json')){
    function encode_json($array=array()) {
        header('Content-type: application/json');
        return json_encode($array);
    }
}
if(!function_exists('decode_json')){
    function decode_json($array=array()) {
        return json_decode($array);
    }
}
if(!function_exists("attachment_btn")){
    function attachment_btn($file){
        if(!empty($file)){
            $path = WRITEPATH.'files\\'.$file->path;
            $pathinfo = pathinfo($path);

            $icon = file_type_icon($file->type);
            $url = $file->path;

            $data = array('file'=>$pathinfo['filename'], 'ext'=>$pathinfo['extension'], 'name'=>$file->name);

            $url = admin_site_url('dl').'?data='.encode_string(json_encode($data));
            
            return "<a class='btn ripple btn-outline-primary' href='".  $url."'>".$icon." ".$file->name." </a> &nbsp;";
        }
    }
}
if(!function_exists("file_type_icon")){
    function file_type_icon($type){
        if(@preg_match('/image/i', $type)){
            $icon  = "<i class='fa fa-file-image-o'></i>";
        }
        else if(@preg_match('/sheet/i', $type)){
            $icon = "<i class='fa fa-file-excel-o'></i>";
        }
        else if(@preg_match('/pdf/i', $type)){
            $icon =  "<i class='fa fa-file-pdf-o'></i>";
        }
        else if(@preg_match('/word/i', $type)){
            $icon = "<i class='fa fa-file-word-o'></i>";
        }
         else if(@preg_match('/text/i', $type)){
            $icon =  "<i class='fa fa-file-text-o'></i>";
        }
        else{
            $icon =  "<i class='fa fa-file-o'></i>";
        }
    return $icon;    
    }
}
if(!function_exists("get_file_size")){
    function get_file_size($path){
        $file = new \CodeIgniter\Files\File($path);
        $size = $file->getSize();

        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
if(!function_exists("get_file_download_url")){
    function get_file_download_url($file){
        $url = '';
        if(!empty($file)){
            $path = WRITEPATH.$file->path;
            $pathinfo = pathinfo($path);
            $icon = file_type_icon($file->type);
            $url = $file->path;
            $data = array('file'=>$pathinfo['filename'], 'ext'=>$pathinfo['extension'], 'name'=>$file->name);
            return admin_site_url('dl').'?data='.encode_string(json_encode($data));
        }
        return $url;
    }
}