<?php
namespace App\Controllers\Admin;
class Role extends App_Controller {
    private $module_name = 'role';
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('role');
    }
    public function index() {
        valid_session($this->module_name,'list');
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'list';
        $page_data['page_title'] = 'role';
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
            if($action=='list'){
                if(!valid_session($this->module_name,'list',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('role');

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
                
                $totalData = $this->Crud_model->get_data_count(TBL_ROLE);
                $totalFiltered = $this->Crud_model->get_data_count(TBL_ROLE,$where);
                $datalist = $this->Crud_model->get_data(TBL_ROLE,$where,$like,$order,$limit,$start);

                if ( isset($datalist) && ! empty($datalist)) {
                    foreach ($datalist as $list) {
                        $edit = '<a href="'.admin_site_url("role/page/add-edit/".encode_string($list->id)).'" class="btn ripple btn-primary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-edit"></i> </a>';
                        $details = '<a href="'.admin_site_url("role/page/details/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                        if($list->id!=1){
                            $status = $list->is_active=='1' ? '<span class="badge bg-success cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('role/crud').'">'.translate('active').'</span>' : '<span class="badge bg-danger cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('role/crud').'">'.translate('inactive').'</span>';
                        }else{
                            $status = '<span class="badge bg-success">'.translate('active').'</span>';
                        }
                        
                        $nestedData = array();
                        $nestedData['id']           = $list->id;
                        $nestedData['name']         = $list->name;
                        $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                        $nestedData['status']       = $status;
                        $nestedData['actions']      = '<div class="btn-group" role="group"">'.$edit.$details.'</div>';
                        $data[]                     = $nestedData;
                    }
                }
                $json_data = [
                    "draw"            => intval($this->request->getPost('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data,
                ];
                echo encode_json($json_data);exit();
            }else if($action=='new_role'){
                if(!valid_session($this->module_name,'add',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('role');
                
                $validation = array();
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required|is_unique['.TBL_ROLE.'.name]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['permissions'] = ['label' => translate('permissions'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $uis = array('name','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['permissions'] = json_encode($this->request->getPost('permissions'));
                $up_data['created_by'] = json_encode($updated);
                $up_data['created_on'] = date(DB_DATETIME_FORMAT);
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->insert_data(TBL_ROLE,$up_data);
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row(TBL_ROLE,array('id'=>$ins_id));
                    add_app_log(TBL_ROLE,'6',$ins_id,$new_data);

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('something_went_wrong');
                }
            }else if($action=='update_role'){
                if(!valid_session($this->module_name,'edit',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('role');
                $id = $this->request->getPost('id');
                $id = decode_string($id);

                $validation['name'] = ['label' => translate('name'), 'rules' => 'required|is_unique['.TBL_ROLE.'.name,id,'.$id.']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['permissions'] = ['label' => translate('permissions'), 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];

                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $old_data = $this->Crud_model->get_data_row(TBL_ROLE,array('id'=>$id));
                $uis = array('name','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['permissions'] = json_encode($this->request->getPost('permissions'));
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->update_data(TBL_ROLE,$up_data,array('id'=>$id));
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row(TBL_ROLE,array('id'=>$id));
                    add_app_log(TBL_ROLE,'7',$id,$new_data,$old_data);

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('something_went_wrong');
                }
            }else if($action=='change_status'){
                if(!valid_session($this->module_name,'edit',false)){
                    echo encode_json($json);exit;
                }
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $id = $this->request->getPost('id');
                $id = decode_string($id);
                $role = $this->Crud_model->get_data_row(TBL_ROLE,array('id'=>$id));
                if(!empty($role)){
                    $up_data = array();
                    $up_data['is_active'] = '1';
                    if($role->is_active=='1'){
                        $up_data['is_active'] = '0';
                    }
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $this->Crud_model->update_data(TBL_ROLE,$up_data,array('id'=>$id));
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row(TBL_ROLE,array('id'=>$id));
                    add_app_log(TBL_ROLE,'7',$id,$new_data,$role);
                    
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('status_update_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_status');
                }
            }
        }
        echo encode_json($json);exit;
    }
    function page($slug='',$id=''){
        if ($this->request->isAJAX()) {
            $id = decode_string($id);
            if($slug=='add-edit'){
                $page_data = array();
                $page_data['page_title'] = $id!='' ? translate('update_role') : translate('new_role');
                $page_data['page_action'] = $id!='' ? 'update_role' : 'new_role';
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-add-edit',$page_data);
            }else if($slug=='details'){
                $page_data = array();
                $page_data['page_title'] = translate('role_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-details',$page_data);
            }
        }
    }
}
/* End of file Role.php */
/* Location: ./app/controllers/Role.php */