<?php
namespace App\Controllers\Admin;
class Languages extends App_Controller {
    private $module_name = 'languages';
    private $table = TBL_LANGUAGE;
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('languages');
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
        $page_data['page_title'] = 'languages';
        $page_data['page_js'] = $page_js;
        return admin_view('index',$page_data);
    }
    public function translate($slug='') {
        if (app_setting('app_translator', 'd') == 'g') {
            app_redirect('languages');exit;
        }
        valid_session($this->module_name,'translate');
        $languages = $this->Crud_model->get_data_row($this->table,array('slug'=>$slug));
        if(!empty($languages)){
            $page_js = array(
                "plugins/datatable/datatables.min.js",
                "plugins/datatable/dataTables.responsive.min.js",
                "plugins/datatable/responsive.bootstrap5.min.js"
            );
            $page_data = array();
            $page_data['module_name'] = $this->module_name;
            $page_data['page_name'] = 'translate_list';
            $page_data['page_title'] = 'translation ('.$languages->name.')';
            $page_data['languages'] = $languages;
            $page_data['page_js'] = $page_js;
            return admin_view('index',$page_data);
        }else{app_redirect('languages');}
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
                $this->module_title = translate('languages');

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
                $totalData = $this->Crud_model->get_data_count($this->table);
                $totalFiltered = $this->Crud_model->get_data_count($this->table,$where);
                $datalist = $this->Crud_model->get_data($this->table,$where,$like,$order,$limit,$start);
                if ( isset($datalist) && ! empty($datalist)) {
                    foreach ($datalist as $list) {
                        $edit = '';
                        $delete  = '';
                        $translate = '';
                        if($list->id!=1){
                            $edit = '<a href="'.admin_site_url("languages/page/add-edit/".encode_string($list->id)).'" class="btn ripple btn-primary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-edit"></i> </a>';
                            $delete  = '<a href="javascript:void(0);" class="btn ripple btn-danger btn-sm mt-1 mb-1 text-sm text-white btn-danger change-status" data-toggle="tooltip" data-placement="top" title="'.translate('delete').'" data-action="delete" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('languages/crud').'"><i class="fa fa-trash"></i></a>';
                        }
                        if (app_setting('app_translator', 'd')=='d' && $list->id!=1) {
                            
                        }

                        if($list->id!=1){
                            if (app_setting('app_translator', 'd')=='d' && $list->id!=1) {
                                $translate = '<a href="' . admin_site_url('languages/translate/' . $list->slug) . '" class="btn ripple btn-info btn-sm mt-1 mb-1 text-sm text-white btn-info" data-toggle="tooltip" data-placement="top" title="' . translate('translate') . '"> <i class="fa fa-language"></i></a>';
                            }
                        }else{
                            $translate = '<a href="' . admin_site_url('languages/translate/' . $list->slug) . '" class="btn ripple btn-info btn-sm mt-1 mb-1 text-sm text-white btn-info" data-toggle="tooltip" data-placement="top" title="' . translate('translate') . '"> <i class="fa fa-language"></i></a>';
                        }
                        
                        $details = '<a href="'.admin_site_url("languages/page/details/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                        if($list->id!=1){
                            $status = $list->is_active=='1' ? '<span class="badge bg-success cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('languages/crud').'">'.translate('active').'</span>' : '<span class="badge bg-danger cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('languages/crud').'">'.translate('inactive').'</span>';
                        }else{
                            $status = '<span class="badge bg-success">'.translate('active').'</span>';
                        }

                        $image = uploads_url($list->flag,uploads_url('default.png'));

                        $nestedData = array();
                        $nestedData['id']           = $list->id;
                        $nestedData['image']        = '<a data-fancybox="image" data-src="'.$image.'" data-caption="'.$list->name.'"><img alt="'.$list->name.'" class="radius cursor-pointer image-delay" src="'.uploads_url('loader.gif').'" data-src="'.$image.'" style="width:48px;height:48px;"></a>';
                        $nestedData['slug']         = $list->slug;
                        $nestedData['name']         = $list->name;
                        $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                        $nestedData['status']       = $status;
                        $nestedData['actions']      = '<div class="btn-group" role="group"">'.$edit.$translate.$delete.$details.'</div>';
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
            }else if($action=='translate_list'){
                if(!valid_session($this->module_name,'translate',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('languages_translate');

                $columns = $this->request->getPost('columns');
                $column = $this->request->getPost('slug');

                $data = array();
                $where = array();
                $like = array();
                $order = array();
                $limit = $this->request->getPost('length');
                $start = $this->request->getPost('start');

                $search = $this->request->getPost('search');
                if(isset($search['value']) && $search['value']!=''){
                    $like = array($search['value'],'word');
                }

                $order_array= $this->request->getPost('order');
                if(isset($order_array[0]['column']) && $order_array[0]['column']!=0){
                    $col_id = $order_array[0]['column'];
                    $order = array($columns[$col_id]['data'] => $order_array[0]['dir']);
                }

                $totalData = $this->Crud_model->get_data_count(TBL_LANGUAGE_TRANSLATION);
                $totalFiltered = $this->Crud_model->get_data_count(TBL_LANGUAGE_TRANSLATION,$where);
                $datalist = $this->Crud_model->get_data(TBL_LANGUAGE_TRANSLATION,$where,$like,$order,$limit,$start);
                if ( isset($datalist) && ! empty($datalist)) {
                    foreach ($datalist as $list) {
                        $loader = "<span aria-hidden='true' class='spinner-border spinner-border-sm'></span> ".translate("please_wait...");

                        $translation = form_open(admin_site_url('languages/crud'), array('method'=>'post','data-block_form'=>'true'), array('action'=>'update_translation','id'=>encode_string($list->id),'column'=>$column)).'<form method="post" action="'.admin_site_url("languages/crud").'">
                            <div class="input-group">
                                <input class="form-control translate-ann" placeholder="" name="translation" value="'.$list->$column.'" type="text">
                                <span class="input-group-btn">
                                    <button class="btn ripple btn-primary btn-submit" type="submit" data-loading-text="'.$loader.'">
                                        <i class="fa fa-save"></i> <span class="input-group-btn">'.translate("save").'</span>
                                    </button>
                                </span>
                            </div>'.form_close();

                        $nestedData = array();
                        $nestedData['id']           = $list->id;
                        $nestedData['word']         = '<span class="translate-abv">'.ucwords(str_replace("_", " ", $list->word)).'</span>';
                        $nestedData['translation']  = $translation;
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
            }else if($action=='new_languages'){
                if(!valid_session($this->module_name,'add',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('languages');
                $this->Crud_model->start_trans();
                $validation = array();
                $validation['name'] = ['label' => translate('role'), 'rules' => 'required'];
                $validation['slug'] = ['label' => translate('slug'), 'rules' => 'required|is_unique['.$this->table.'.slug]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);

                $uis = array('name','slug','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['created_by'] = json_encode($updated);
                $up_data['created_on'] = date(DB_DATETIME_FORMAT);
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->insert_data($this->table,$up_data);
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$ins_id));
                    add_app_log($this->table,'6',$ins_id,$new_data);

                    $fields = array(
                        $up_data['slug'] => array('type' => 'LONGTEXT','collation' => 'utf8_general_ci','null' => TRUE,'default' => NULL)
                    );
                    $forge = \Config\Database::forge();
                    $forge->addColumn(TBL_LANGUAGE_TRANSLATION, $fields);

                    if(isset( $_FILES['flag'])){
                        $flag = $up_data['slug'].".png";
                        if(move_upload_file_if_ok('flag',FCPATH."writable/uploads/flag/".$flag)){
                            $ins_id = $this->Crud_model->update_data($this->table,array('flag'=>$flag),array('id'=>$ins_id));
                        }
                    }

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('something_went_wrong');
                }
            }else if($action=='update_languages'){
                if(!valid_session($this->module_name,'edit',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('languages');
                $id = $this->request->getPost('id');
                $id = decode_string($id);

                $old_column_name = get_column_value($this->table,array('id'=>$id),'slug');
                
                $validation = array();
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
                $validation['slug'] = ['label' => translate('slug'), 'rules' => 'required|is_unique['.$this->table.'.slug,id,'.$id.']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $old_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                $uis = array('name','slug','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->update_data($this->table,$up_data,array('id'=>$id));
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    if(isset( $_FILES['flag'])){
                        $flag = $up_data['slug'].".png";
                        if(move_upload_file_if_ok('flag',FCPATH."writable/uploads/flag/".$flag)){
                            $ins_id = $this->Crud_model->update_data($this->table,array('flag'=>$flag),array('id'=>$id));
                        }
                    }
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                    add_app_log($this->table,'7',$id,$new_data,$old_data);

                    $fields = array(
                        $old_column_name => array('name' => $up_data['slug'],'type' => 'LONGTEXT','collation' => 'utf8_general_ci','null' => TRUE,'default' => NULL)
                    );
                    $forge = \Config\Database::forge();
                    $forge->modifyColumn(TBL_LANGUAGE_TRANSLATION, $fields);

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
                $languages = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                if(!empty($languages)){
                    $up_data = array();
                    $up_data['is_active'] = '1';
                    if($languages->is_active=='1'){
                        $up_data['is_active'] = '0';
                    }
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $this->Crud_model->update_data($this->table,$up_data,array('id'=>$id));
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                    add_app_log($this->table,'7',$id,$new_data,$languages);

                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('status_update_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_status');
                }
            }else if($action=='delete'){
                if(!valid_session($this->module_name,'delete',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('languages');
                $id = $this->request->getPost('id');
                $id = decode_string($id);
                $this->Crud_model->start_trans();
                $languages = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                if(!empty($languages)){
                    $this->Crud_model->delete_data($this->table,array('id'=>$languages->id));
                    $forge = \Config\Database::forge();
                    $forge->dropColumn(TBL_LANGUAGE_TRANSLATION, $languages->slug);
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('languages_deleted_successfully');
                }else{
                    $json['message'] = translate('unable_to_delete_languages');
                }
            }else if($action=='update_translation'){
                $this->module_title = translate('translation');
                if(!valid_session($this->module_name,'update_translation',false)){
                    echo encode_json($json);exit;
                }
                $this->Crud_model->start_trans();
                $id = $this->request->getPost('id');
                $id = decode_string($id);
                $column = $this->request->getPost('column');
                if($id!='' && $column!=''){
                    $up_data = array();
                    $up_data[$column] = $this->request->getPost('translation');
                    $ins_id = $this->Crud_model->update_data(TBL_LANGUAGE_TRANSLATION,$up_data,array('id'=>$id));
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['title'] = $this->module_title;
                    $json['message'] = translate('translation_updated_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_translation');
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
                $page_data['page_title'] = $id!='' ? translate('update_languages') : translate('new_languages');
                $page_data['page_action'] = $id!='' ? 'update_languages' : 'new_languages';
                $page_data['id'] = $id;
                $page_data['role_list'] = $this->Crud_model->get_role_data(array('is_active' => '1'));
                echo admin_view($this->module_name.'/popup-add-edit',$page_data);
            }else if($slug=='details'){
                $page_data = array();
                $page_data['page_title'] = translate('languages_details');
                $page_data['id'] = $id;
                $page_data['role_id'] = get_column_value($this->table,array('id'=>$id),'role_id');
                echo admin_view($this->module_name.'/popup-details',$page_data);
            }
        }
    }
}
/* End of file Languages.php */
/* Location: ./app/controllers/Languages.php */