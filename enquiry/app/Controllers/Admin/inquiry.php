<?php
namespace App\Controllers\Admin;
class Inquiry extends App_Controller {
    private $module_name = 'inquiry';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('inquiry');
    }
    public function index() {
        $page = $this->request->getGet('page');
        if ($page == 'contact') {
            valid_session($this->module_name, 'contact');
        }
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        if ($page == 'contact') {
            $page_data['page_name'] = 'contact';
            $page_data['page_title'] = 'contact';
        }
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
            if($action=='contact'){
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
                    $like = array($search['value'],'name,phone_no,course,message');
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

                    $details = '<a href="'.admin_site_url("inquiry/page/contact/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                   
                  
                    $nestedData = array();
                    $nestedData['id']           = $list->id;
                    $nestedData['name']         = $list->name;
                 
                    $nestedData['phone_no']     = $list->phone;
                    $nestedData['course']      = get_column_value(TBL_COURSE,array('id'=>$list->course),'name');
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
            }
        }
        echo encode_json($json);exit;
    }
    function page($slug='',$id=''){
        if ($this->request->isAJAX()) {
            $id = decode_string($id);
            if($slug=='contact'){
                $page_data = array();
                $page_data['page_title'] = translate('contact_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-contact',$page_data);
            }
        }
    }
}
/* End of file inquiry.php */
/* Location: ./app/controllers/Enquire.php */