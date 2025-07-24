<?php
namespace App\Controllers\Admin;
class User_inquiry extends App_Controller {
    private $module_name = 'user_inquiry';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('user_inquiry');
    }
    public function inquiry() {
    
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'inquiry_list';
        $page_data['page_title'] = 'inquiry';
        
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }
    public function course_enquiry() {
    
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'course_enquiry_list';
        $page_data['page_title'] = 'course enquiry';
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }

    public function exam_registration() {
    
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'exam_register_list';
        $page_data['page_title'] = 'exam register';
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }
    public function contact_us() {
    
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'contact_list';
        $page_data['page_title'] = 'contact';
        
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }
    public function crud()
    {
        $json['status'] = false;
        $json['type'] = 'error';
        $json['title'] = $this->module_title;
        $json['message'] = translate('invalid_request');
        if ($this->request->isAJAX())
         {
            $updated = array();
            $updated['type'] = 'admin';
            $updated['id'] = user_setting('admin_id');

            $action = $this->request->getPost('action');
            if($action=='inquiry_list'){
                $this->module_title = translate('inquiry');
                $columns = $this->request->getPost('columns');
                $data = array();
                $where = array();
                $like = array();
                $order = array();
                $limit = $this->request->getPost('length');
                $start = $this->request->getPost('start');

                $search = $this->request->getPost('search');
                if(isset($search['value']) && $search['value']!=''){
                    $like = array($search['value'],'name,phone_no');
                }
                $order_array= $this->request->getPost('order');
                if(isset($order_array[0]['column']) && $order_array[0]['column']!=0){
                    $col_id = $order_array[0]['column'];
                    $order = array($columns[$col_id]['data'] => $order_array[0]['dir']);
                }
                $totalData = $this->Crud_model->get_data_count(TBL_INQUIRY);
                $totalFiltered = $this->Crud_model->get_data_count(TBL_INQUIRY,$where);
                $datalist = $this->Crud_model->get_data(TBL_INQUIRY,$where,$like,$order,$limit,$start);
              
                if(isset($datalist) && ! empty($datalist)){ foreach ($datalist as $list) {
                    $details = '<a href="'.admin_site_url("user-inquiry/page/inquiry/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                   
                    $nestedData = array();
                    $nestedData['id']           = $list->id;
                    $nestedData['name']         = $list->name;
                    $nestedData['phone_no']     = $list->phone;
                    $nestedData['course']       = get_column_value(TBL_COURSE,array('id'=>$list->course),'name');
                    $nestedData['message']      = $list->message;
                    $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                    $nestedData['actions']      = '<div class="btn-group" role="group"">'.$details.'</div>';
                    $data[]                     = $nestedData;
                } }
                $json_data = [
                    "draw"            => intval($this->request->getPost('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data,
                ];
                echo encode_json($json_data);exit();
            }else if($action=='contact_list'){
                
                $this->module_title = translate('contact');
                $columns = $this->request->getPost('columns');
                $data = array();
                $where = array();
                $like = array();
                $order = array();
                $limit = $this->request->getPost('length');
                $start = $this->request->getPost('start');

                $search = $this->request->getPost('search');
                if(isset($search['value']) && $search['value']!=''){
                    $like = array($search['value'],'name');
                }
                $order_array= $this->request->getPost('order');
                if(isset($order_array[0]['column']) && $order_array[0]['column']!=0){
                    $col_id = $order_array[0]['column'];
                    $order = array($columns[$col_id]['data'] => $order_array[0]['dir']);
                }
                $totalData = $this->Crud_model->get_data_count(TBL_CONTACT);
                $totalFiltered = $this->Crud_model->get_data_count(TBL_CONTACT,$where);
                $datalist = $this->Crud_model->get_data(TBL_CONTACT,$where,$like,$order,$limit,$start);
                if(isset($datalist) && ! empty($datalist)){ foreach ($datalist as $list) {
                    $details = '<a href="'.admin_site_url("user-inquiry/page/contact/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                    
                    $nestedData = array();
                    $nestedData['id']           = $list->id;
                    $nestedData['name']         = $list->name;
                    $nestedData['email']         = $list->email;
                    $nestedData['subject']         = $list->subject;
                    $nestedData['phone_no']     = $list->phone;
                    $nestedData['message']     = $list->message;
                    $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                    $nestedData['actions']      = '<div class="btn-group" role="group"">'.$details.'</div>';
                    $data[]                     = $nestedData;
                } }
                $json_data = [
                    "draw"            => intval($this->request->getPost('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data,
                ];
                echo encode_json($json_data);exit();

            }else if($action=='course_enquiry_list'){
                $this->module_title = translate('course_enquiry');
                $columns = $this->request->getPost('columns');
                $data = array();
                $where = array();
                $like = array();
                $order = array();
                $limit = $this->request->getPost('length');
                $start = $this->request->getPost('start');

                $search = $this->request->getPost('search');
                if(isset($search['value']) && $search['value']!=''){
                    $like = array($search['value'],'name');
                }
                $order_array= $this->request->getPost('order');
                if(isset($order_array[0]['column']) && $order_array[0]['column']!=0){
                    $col_id = $order_array[0]['column'];
                    $order = array($columns[$col_id]['data'] => $order_array[0]['dir']);
                }
                $totalData = $this->Crud_model->get_data_count(TBL_COURSE_ENQUIRY);
                $totalFiltered = $this->Crud_model->get_data_count(TBL_COURSE_ENQUIRY,$where);
                $datalist = $this->Crud_model->get_data(TBL_COURSE_ENQUIRY,$where,$like,$order,$limit,$start);
              
                if(isset($datalist) && ! empty($datalist)){ foreach ($datalist as $list) {
                    $details = '<a href="'.admin_site_url("user-inquiry/page/course_enquiry/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                    switch($list->crash_course) {
                        case 0:
                          $course = 'MHT-CET';
                          break;
                        case 1:
                            $course = 'NEET';
                          break;
                        case 2:
                            $course = 'Both';
                            break;
                        default:
                            $course = 'Unknow';
                      }
                    $nestedData = array();
                    $nestedData['id']           = $list->id;
                    $nestedData['name']         = $list->name;
                    $nestedData['phone_no']     = $list->student_mobile_no;
                    $nestedData['crash_course'] = $course;
                    $nestedData['address']      = $list->address;
                    $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                    $nestedData['actions']      = '<div class="btn-group" role="group"">'.$details.'</div>';
                    $data[]                     = $nestedData;
                } }
                $json_data = [
                    "draw"            => intval($this->request->getPost('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data,
                ];
                echo encode_json($json_data);exit();
            }else if($action=='exam_register_list'){
                $this->module_title = translate('exam_registration');
                $columns = $this->request->getPost('columns');
                $data = array();
                $where = array();
                $like = array();
                $order = array();
                $limit = $this->request->getPost('length');
                $start = $this->request->getPost('start');

                $search = $this->request->getPost('search');
                if(isset($search['value']) && $search['value']!=''){
                    $like = array($search['value'],'name');
                }
                $order_array= $this->request->getPost('order');
                if(isset($order_array[0]['column']) && $order_array[0]['column']!=0){
                    $col_id = $order_array[0]['column'];
                    $order = array($columns[$col_id]['data'] => $order_array[0]['dir']);
                }
                $totalData = $this->Crud_model->get_data_count(TBL_EXAM_REGISTRATION);
                $totalFiltered = $this->Crud_model->get_data_count(TBL_EXAM_REGISTRATION,$where);
                $datalist = $this->Crud_model->get_data(TBL_EXAM_REGISTRATION,$where,$like,$order,$limit,$start);
              
                if(isset($datalist) && ! empty($datalist)){ foreach ($datalist as $list) {
                    $details = '<a href="'.admin_site_url("user-inquiry/page/exam_registered/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                    switch($list->crash_course) {
                        case 0:
                          $course = 'MHT-CET';
                          break;
                        case 1:
                            $course = 'NEET';
                          break;
                        case 2:
                            $course = 'JEE';
                            break;
                        default:
                            $course = 'Unknown';
                      }
                    $nestedData = array();
                    $nestedData['id']           = $list->id;
                    $nestedData['name']         = $list->name;
                    $nestedData['phone_no']     = $list->student_mobile_no;
                    $nestedData['crash_course'] = $course;
                    $nestedData['address']      = $list->address;
                    $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                    $nestedData['actions']      = '<div class="btn-group" role="group"">'.$details.'</div>';
                    $data[]                     = $nestedData;
                } }
                $json_data = [
                    "draw"            => intval($this->request->getPost('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data,
                ];
                echo encode_json($json_data);exit();
            }
        }
        echo encode_json($json);exit;
    }
    function page($slug='',$id=''){
        if ($this->request->isAJAX()) {
            $id = decode_string($id);
            if($slug=='inquiry'){
                $page_data = array();
                $page_data['page_title'] = translate('inquiry_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-inquiry',$page_data);
            }
            else if($slug=='contact'){
                $page_data = array();
                $page_data['page_title'] = translate('contact_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-contact',$page_data);
            }else if($slug=='course_enquiry'){
                $page_data = array();
                $page_data['page_title'] = translate('course_enquiry_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-course_enquiry',$page_data);
            }else if($slug=='exam_registered'){
                $page_data = array();
                $page_data['page_title'] = translate('exam_registered_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-exam_registered',$page_data);
            }
        }
    }



   
}
/* End of file inquiry.php */
/* Location: ./app/controllers/Enquire.php */