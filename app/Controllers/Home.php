<?php
namespace App\Controllers;
use App\Controllers\App_Controller;
class Home extends App_Controller {
    private $module_name = 'customer';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = app_setting('app_title');
    }
    public function index() {
        $page_data = array();
        $page_data['page_name'] = 'home';
        $page_data['slider'] = $this->Crud_model->get_data(TBL_SLIDER,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['course'] = $this->Crud_model->get_data(TBL_COURSE,array('is_active'=>'1'),array(),array('order'=>'asc'),6);
        $page_data['announcements'] = $this->Crud_model->get_data(TBL_ANNOUNCEMENTS,array('is_active'=>'1'),array(),array('date'=>'desc'));
        $page_data['gallery'] = $this->Crud_model->get_data(TBL_GALLERY,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['faculty'] = $this->Crud_model->get_data(TBL_FACULTY,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['testimonial'] = $this->Crud_model->get_data(TBL_TESTIMONIAL,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['home_blog'] = $this->Crud_model->get_data(TBL_BLOG,array('is_active'=>'1'),array(),array('order'=>'asc'),3); 
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }

    public function about_us() {
        $page_data = array();
        $page_data['page_name'] = 'about_us';
        $page_data['page_title'] = 'About Us';
        $page_data['course'] = $this->Crud_model->get_data(TBL_COURSE,array('is_active'=>'1'),array(),array('order'=>'asc')); 
        $page_data['faculty'] = $this->Crud_model->get_data(TBL_FACULTY,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['testimonial'] = $this->Crud_model->get_data(TBL_TESTIMONIAL,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
    public function directors_desk() {
        $page_data = array();
        $page_data['page_name'] = 'directors_desk';
        $page_data['page_title'] = 'Directors Desk ';
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
    public function process() {
        $page_data = array();
        $page_data['page_name'] = 'process';
        $page_data['page_title'] = 'Our Process ';
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
    public function contact_us() {
        $page_data = array();
        $page_data['page_name'] = 'contact_us';
        $page_data['page_title'] = 'Contact Us';
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }

    public function enquiry_form() {
        $page_data = array();
        $page_data['page_name'] = 'enquiry_form';
        $page_data['page_title'] = 'Enquiry Form';
        $page_data['is_inquiry'] = true;
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
    public function courses($slug='') {
        $page_data = array();
        if($slug != '') {
            $course = $this->Crud_model->get_data_row(TBL_COURSE, array('slug'=>$slug,'is_active' => '1'));
            $page_data['page_name'] = 'courses_details';
            $page_data['page_title'] = $course->name;
            $page_data['course'] = $course; 
        }else {
            $page_data['page_name'] = 'courses';
            $page_data['page_title'] = 'courses';
            $page_data['course'] = $this->Crud_model->get_data(TBL_COURSE,array('is_active'=>'1'),array(),array('order'=>'asc')); 
            $page_data['faculty'] = $this->Crud_model->get_data(TBL_FACULTY,array('is_active'=>'1'),array(),array('order'=>'asc'));
        }
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }

    public function blog($slug='') {
        $page_data = array();
        if($slug != '') {
            $blog_details = $this->Crud_model->get_data_row(TBL_BLOG, array('slug'=>$slug,'is_active' => '1'));
            $page_data['page_name'] = 'blog_details';
            $page_data['page_title'] = $blog_details->name;
            $page_data['blog_details'] = $blog_details; 
        }else {
            $page_data['page_name'] = 'blog';
            $page_data['page_title'] = 'blog';
            $page_data['blogs'] = $this->Crud_model->get_data(TBL_BLOG,array('is_active'=>'1'),array(),array('order'=>'asc')); 
        }
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }

    public function faculty() {
        $page_data = array();
        $page_data['page_name'] = 'faculty';
        $page_data['page_title'] = 'Faculty';
        $page_data['faculty'] = $this->Crud_model->get_data(TBL_FACULTY,array('is_active'=>'1'),array(),array('order'=>'asc'));
        $page_data['blog'] = $this->Crud_model->get_data(TBL_BLOG,array('is_active'=>'1'),array(),array('order'=>'asc'),3);
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }

    public function gallery($slug='') {
        $page_data = array();
        if($slug != '') {
            $gallery_details = $this->Crud_model->get_data_row(TBL_GALLERY, array('slug'=>$slug,'is_active' => '1'));
            $page_data['page_name'] = 'gallery_details';
            $page_data['page_title'] = $gallery_details->name;
            $page_data['gallery_details'] = $gallery_details; 
        }else {
            $page_data['page_name'] = 'gallery';
            $page_data['page_title'] = 'gallery';
            $page_data['gallery'] = $this->Crud_model->get_data(TBL_GALLERY, array('is_active' => '1'), array(), array('order' => 'asc'));
        }
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
    public function page($slug='') {
        $pwh = array();
        $pwh['id!='] = app_setting('terms_and_conditions_page');
        $pwh[' id!='] = app_setting('return_refund_and_cancellation_policy_page');
        $pwh['  id!='] = app_setting('privacy_policy_page');
        $pwh['   id!='] = app_setting('disclaimer_page');
        $pwh['is_active'] = '1';
        $page_data = array();
        if($slug!=''){
            $pwh['slug'] = $slug;
            $page = $this->Crud_model->get_data_row(TBL_PAGES, $pwh);
            if(!empty($page)){
                $page_data['page_title'] = $page->name;
                $page_data['page_name'] = 'page_details';
                $page_data['page'] = $page;
                $page_data['slug'] = 'page/'.$page->slug;
                $page_data['single_page'] = true;
            }else{ app_redirect('/',false,true);exit; }
        }else{
            $page = $this->Crud_model->get_data(TBL_PAGES, $pwh, array(), array('created_on'=>'desc'));
            if(!empty($page)){
                $page_data['page_title'] = 'page';
                $page_data['page_name'] = 'page';
                $page_data['page'] = $page;
            }else{ app_redirect('/',false,true);exit; }
        }
        $page_data['Crud_model'] = $this->Crud_model;
        return home_view('index',$page_data);
    }
    public function terms_and_conditions($slug=''){
        $page = $this->Crud_model->get_data_row(TBL_PAGES,array('id'=>app_setting('terms_and_conditions_page'),'is_active'=>'1'));
        if(!empty($page)){
            $page_data = array();
            $page_data['page_title'] = translate('terms_&_conditions');
            $page_data['page_name'] = 'legal_page';
            $page_data['page'] = $page;
            $page_data['single_page'] = true;
            $page_data['slug'] = 'terms-and-conditions';
            $page_data['Crud_model'] = $this->Crud_model;
            return home_view('index',$page_data);
        }else{ app_redirect('/',false,true);exit; }
    }
    public function return_refund_and_cancellation_policy($slug=''){
        $page = $this->Crud_model->get_data_row(TBL_PAGES,array('id'=>app_setting('return_refund_and_cancellation_policy_page'),'is_active'=>'1'));
        if(!empty($page)){
            $page_data = array();
            $page_data['page_title'] = translate('return,_refund_and_cancellation_policy');
            $page_data['page_name'] = 'legal_page';
            $page_data['page'] = $page;
            $page_data['single_page'] = true;
            $page_data['slug'] = 'return-refund-and-cancellation-policy';
            $page_data['Crud_model'] = $this->Crud_model;
            return home_view('index',$page_data);
        }else{ app_redirect('/',false,true);exit; }
    }
    public function privacy_policy($slug=''){
        $page = $this->Crud_model->get_data_row(TBL_PAGES,array('id'=>app_setting('privacy_policy_page'),'is_active'=>'1'));
        if(!empty($page)){
            $page_data = array();
            $page_data['page_title'] = translate('privacy_policy');
            $page_data['page_name'] = 'legal_page';
            $page_data['page'] = $page;
            $page_data['single_page'] = true;
            $page_data['slug'] = 'privacy-policy';
            $page_data['Crud_model'] = $this->Crud_model;
            return home_view('index',$page_data);
        }else{ app_redirect('/',false,true);exit; }
    }
    public function disclaimer($slug=''){
        $page = $this->Crud_model->get_data_row(TBL_PAGES,array('id'=>app_setting('disclaimer_page'),'is_active'=>'1'));
        if(!empty($page)){
            $page_data = array();
            $page_data['page_title'] = translate('disclaimer');
            $page_data['page_name'] = 'legal_page';
            $page_data['page'] = $page;
            $page_data['slug'] = 'disclaimer';
            $page_data['single_page'] = true;
            $page_data['Crud_model'] = $this->Crud_model;
            return home_view('index',$page_data);
        }else{ app_redirect('/',false,true);exit; }
    }
    
     public function dl() {
        $token = $this->request->getGet('file');
        $token = json_decode(decode_string($token));
        $path = $token->path.'.'.$token->extension;
        
        $auth_key = $token->token;
        if($path!='.' && $auth_key==session('web_auth_key')){
            $filepath = WRITEPATH.'uploads/files/'.$path;
            if(file_exists($filepath)) {
                return $this->response->download($filepath, null)->setFileName($token->name);die();
            }
        }
        app_redirect(home_site_url(),true);
	}


    
}