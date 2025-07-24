<?php
namespace App\Controllers\Admin;
class Documents extends App_Controller {
    private $module_name = 'documents';
    private $table = TBL_DOCUMENTS;
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('documents');
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
        $page_data['page_title'] = 'documents';
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }
    public function order() {
        valid_session($this->module_name,'edit');
        $page_js = array(
            "plugins/darggable/jquery-ui-darggable.min.js"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'order';
        $page_data['page_title'] = 'order';
        $page_data['page_action'] = 'order';
        $page_data['page_js'] = $page_js;
        $page_data['documents'] = $this->Crud_model->get_data($this->table, array('is_active'=>'1'), array(), array('order'=>'asc'));
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
                $this->module_title = translate('documents');

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
                }else{
                    $order = array('order' => 'asc');
                }
                
                $totalData = $this->Crud_model->get_data_count($this->table,$where);
                $totalFiltered = $this->Crud_model->get_data_count($this->table,$where);
                $datalist = $this->Crud_model->get_data($this->table,$where,$like,$order,$limit,$start);

                if ( isset($datalist) && ! empty($datalist)) {
                    foreach ($datalist as $list) {
                        $edit = '<a href="'.admin_site_url("documents/page/add-edit/".encode_string($list->id)).'" class="btn ripple btn-primary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-edit"></i> </a>';
                        $details = '<a href="'.admin_site_url("documents/page/details/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                        $status = $list->is_active=='1' ? '<span class="badge bg-success cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('documents/crud').'">'.translate('active').'</span>' : '<span class="badge bg-danger cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('documents/crud').'">'.translate('inactive').'</span>';

                        switch ($list->type) {
                            case '1':
                                $doc_type = 'Library';
                              break;
                            case '2':
                                $doc_type = 'Gym';
                              break;
                            case '3':
                                $doc_type = 'Arts';
                              break;
                              case '4':
                                $doc_type = 'Commerce';
                              break;
                              case '5':
                                $doc_type = 'Science';
                              break;

                            default:
                              $doc_type = 'unknow';
                          }

                        $nestedData = array();
                        $nestedData['id']           = $list->id;
                        $nestedData['name']         = $list->name;
                        $nestedData['url']          = $list->url;
                        $nestedData['type']         = $doc_type;
                        $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                        $nestedData['status']       = $status;
                        $nestedData['actions']      = '<div class="btn-group" documents="group"">'.$edit.$details.'</div>';
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
            }else if($action=='new_documents'){
                if(!valid_session($this->module_name,'add',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('documents');
                $validation = array();
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
                $validation['url'] = ['label' => translate('file'), 'rules' => 'required'];
                $validation['type'] = ['label' => translate('type'), 'rules' => 'required'];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();

                $uis = array('name','url','type','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['slug'] = get_unique_slug($this->table,$up_data['name']);
                $up_data['created_by'] = json_encode($updated);
                $up_data['created_on'] = date(DB_DATETIME_FORMAT);
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->insert_data($this->table,$up_data);
                $this->Crud_model->end_trans();

                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$ins_id));
                    add_app_log($this->table,'6',$ins_id,$new_data);

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('something_went_wrong');
                }
            }else if($action=='update_documents'){
                if(!valid_session($this->module_name,'edit',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('documents');
                $id = $this->request->getPost('id');
                $id = decode_string($id);
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
                $validation['url'] = ['label' => translate('file'), 'rules' => 'required'];
                $validation['type'] = ['label' => translate('type'), 'rules' => 'required'];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);      
                $old_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                $this->Crud_model->start_trans();

                $uis = array('name','url','type','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['slug'] = get_unique_slug($this->table,$up_data['name'],$id);
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->update_data($this->table,$up_data,array('id'=>$id));
                $this->Crud_model->end_trans();

                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                    add_app_log($this->table,'7',$id,$new_data,$old_data);

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
                $documents = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                if(!empty($documents)){
                    $up_data = array();
                    $up_data['is_active'] = '1';
                    if($documents->is_active=='1'){
                        $up_data['is_active'] = '0';
                    }
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT); 
                    $this->Crud_model->update_data($this->table,$up_data,array('id'=>$id));   
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                    add_app_log($this->table,'7',$id,$new_data,$documents);
                    
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('status_update_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_status');
                }
            }else if($action=='order'){
                if(!valid_session($this->module_name,'edit',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('slider');
                $ins_id = false;
                $validation = array();
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $order = $this->request->getPost('order');
                if(isset($order) && !empty($order)){ $o=0;
                    foreach($order as $id){ $o++;
                        $ins_id = $this->Crud_model->update_data($this->table,array('order'=>$o),array('id'=>decode_string($id)));
                    }
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('order_updated_successfully');
                    $json['url'] = admin_site_url('documents');
                }else{
                    $json['message'] = translate('something_went_wrong');
                }
            }
        }
        echo encode_json($json);exit;
    }
    function page($slug='',$id=''){
        $id = decode_string($id);
        if ($this->request->isAJAX()) {
            if($slug=='add-edit'){
                $page_data = array();
                $page_data['page_title'] = $id!='' ? translate('update_documents') : translate('new_documents');
                $page_data['page_action'] = $id!='' ? 'update_documents' : 'new_documents';
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-add-edit',$page_data);
            }else if($slug=='details'){
                $page_data = array();
                $page_data['page_title'] = translate('documents_details');
                $page_data['id'] = $id;
                echo admin_view($this->module_name.'/popup-details',$page_data);
            }
        }
    }
}
/* End of file documents.php */
/* Location: ./app/controllers/documents.php */