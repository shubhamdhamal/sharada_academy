<?php
namespace App\Controllers\Api;
use App\Controllers\App_Controller;
class Web extends App_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $json['status'] = true;
        $json['type'] = 'danger';
        $json['title'] = translate('API');
        $json['message'] = translate('API_working_successfully.');
        $action = $this->request->getPost('action');
        if($action=='generate_captcha'){
            $json['status'] = true;
            $json['message'] = translate('captcha_generate_successfully');
            $json['details'] = get_captcha('default',$this->request->getPost('type'))->img;
        }else if($action=='inquiry'){
            $validation = array();
            $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
            $validation['phone'] = ['label' => translate('phone'), 'rules' => 'required'];
            $validation['course'] =['label' =>translate('course'),'rules' =>'required'];
            $validation['message'] = ['label' => translate('message'), 'rules' => 'required'];
            $validation['action'] = ['label' => translate('submit'), 'rules' => 'required'];
            if(app_setting('captcha_status','off')!='off'){
                $captcha_type = app_setting('captcha_status','default');
                if($captcha_type=='default'){
                    $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[inquiry_captcha]'];
                }else{
                    $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                }
            }
            $this->validate_submitted_data(translate('inquiry'), $validation);
            $up_data = array();
            $up_data['name'] = $this->request->getPost('name');
            $up_data['phone'] = $this->request->getPost('phone');
            $up_data['course'] = $this->request->getPost('course');
            $up_data['message'] = $this->request->getPost('message');
            $up_data['created_on'] = date(DB_DATETIME_FORMAT);
            $ins_id = $this->Crud_model->insert_data(TBL_INQUIRY,$up_data);
            $this->Crud_model->end_trans();
            $json['is_inquiry'] = true;
            if ($this->Crud_model->status_trans()){
                $json['status'] = true;
                $json['inquiry'] = true;
                $json['message'] = '<p class="text-center text-wrap text-white" style="font-size:20px;">' . translate('thank_you!.').'</p>

                <p class="text-center text-wrap text-white" style="font-size:20px;">' . translate('we_will_contact_you_soon_.')
                
                .'</p>';
            }else{
                $json['message'] = translate('oops!_something_went_wrong_and_we_could_not_send_your_message.');
            }
            
        }else if($action=='contact'){
            $validation = array();
            $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
            $validation['email'] = ['label' => translate('email'), 'rules' => 'required'];
            $validation['phone'] = ['label' => translate('phone'), 'rules' => 'required'];
            $validation['subject'] =['label' =>translate('subject'),'rules' =>'required'];
            $validation['message'] = ['label' => translate('message'), 'rules' => 'required'];
            $validation['action'] = ['label' => translate('submit'), 'rules' => 'required'];
            if(app_setting('captcha_status','off')!='off'){
                $captcha_type = app_setting('captcha_status','default');
                if($captcha_type=='default'){
                    $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[contact_captcha]'];
                }else{
                    $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                }
            }
            $this->validate_submitted_data(translate('contact'), $validation);
            $up_data = array();
            $up_data['name'] = $this->request->getPost('name');
            $up_data['email'] = $this->request->getPost('email');
            $up_data['phone'] = $this->request->getPost('phone');
            $up_data['subject'] = $this->request->getPost('subject');
            $up_data['message'] = $this->request->getPost('message');
            $up_data['created_on'] = date(DB_DATETIME_FORMAT);
            $ins_id = $this->Crud_model->insert_data(TBL_CONTACT,$up_data);
            $this->Crud_model->end_trans();
            $json['is_contact'] = true;
            if ($this->Crud_model->status_trans()){
                $json['status'] = true;
                $json['contact'] = true;
                $json['message'] = '<p class="text-center text-wrap" style="font-size:20px;margin-top:35%  ">' . translate('thank_you!.').'</p>
                                    <p class="text-center text-wrap" style="font-size:20px;">' . translate('we_will_contact_you_soon_.').'</p>';
            }else{
                $json['message'] = translate('oops!_something_went_wrong_and_we_could_not_send_your_message.');
            }
            
        }else if($action=='couser_enquiry'){
            $validation = array();
            $validation['name'] = ['label' => translate('student_name'), 'rules' => 'required'];
            $validation['email_id'] = ['label' => translate('email'), 'rules' => 'required'];
            $validation['student_mobile_no'] = ['label' => translate('student_mobile_no'), 'rules' => 'required'];
            $validation['parent_mobile_no'] = ['label' => translate('parent_mobile_no'), 'rules' => 'required'];
            $validation['crash_course'] =['label' =>translate('willing_to_take_admission_for_crash_course'),'rules' =>'required'];
            $validation['group'] =['label' =>translate('group_subjects'),'rules' =>'required'];
            $validation['address'] = ['label' => translate('address'), 'rules' => 'required'];
            $validation['action'] = ['label' => translate('submit'), 'rules' => 'required'];
            if(app_setting('captcha_status','off')!='off'){
                $captcha_type = app_setting('captcha_status','default');
                if($captcha_type=='default'){
                    $validation['captcha_token'] = ['label' => translate('captcha'), 'rules' => 'required|captchaValidation[course_captcha]'];
                }else{
                    $validation['g-recaptcha-response'] = ['label' => translate('captcha'), 'rules' => 'required|recaptchaValidation[g-recaptcha-response]'];
                }
            }
            $this->validate_submitted_data(translate('course_enquiry'), $validation);
            $up_data = array();
            $up_data['name'] = $this->request->getPost('name');
            $up_data['email_id'] = $this->request->getPost('email_id');
            $up_data['student_mobile_no'] = $this->request->getPost('student_mobile_no');
            $up_data['parent_mobile_no'] = $this->request->getPost('parent_mobile_no');
            $up_data['crash_course'] = $this->request->getPost('crash_course');
            $up_data['group'] = $this->request->getPost('group');
            $up_data['address'] = $this->request->getPost('address');
            $up_data['created_on'] = date(DB_DATETIME_FORMAT);
            $this->Crud_model->insert_data(TBL_COURSE_ENQUIRY,$up_data);
            $this->Crud_model->end_trans();
            $json['is_course_enquiry'] = true;
            if ($this->Crud_model->status_trans()){
                $json['status'] = true;
                $json['contact'] = true;
                $json['message'] = '<p class="text-center text-wrap text-white" style="font-size:20px;margin:5%  ">' . translate('thank_you!').'</p>
                                    <p class="text-center text-wrap text-white" style="font-size:20px;">' . translate('we_will_contact_you_soon_.').'</p>
                                    <img class="img" src="'.home_assets_url('images/thank-you.png').'" alt="thank-you">';
            }else{
                $json['message'] = translate('oops!_something_went_wrong_and_we_could_not_send_your_message.');
            }
            
        }
        else{
            $json['status'] = false;
            $json['message'] = translate('something_went_wrong._please_try_again.');
        }
        echo encode_json($json);exit;
    }
}