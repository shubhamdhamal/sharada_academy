<?php
namespace App\Controllers\Admin;
class User extends App_Controller {
    private $module_name = 'user';
    private $table = TBL_ADMIN;
    private $module_title;
    function __construct() {
        parent::__construct();
        $this->module_title = translate('user');
    }
    public function index() {
        valid_session($this->module_name,'list');
        $page_js = array(
            "plugins/datatable/datatables.min.js",
            "plugins/datatable/dataTables.responsive.min.js",
            "plugins/datatable/responsive.bootstrap5.min.js",
            "plugins/intl-tel-input/js/intlTelInput.min.js"
        );
        $page_css = array(
            "plugins/intl-tel-input/css/intlTelInput.min.css"
        );
        $page_data = array();
        $page_data['module_name'] = $this->module_name;
        $page_data['page_name'] = 'list';
        $page_data['page_title'] = 'user';
        $page_data['page_js'] = $page_js;
        $page_data['page_css'] = $page_css;
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
                $this->module_title = translate('user');

                $columns = $this->request->getPost('columns');

                $data = array();
                $where = array();
                $like = array();
                $order = array();
                $limit = $this->request->getPost('length');
                $start = $this->request->getPost('start');

                $search = $this->request->getPost('search');
                if(isset($search['value']) && $search['value']!=''){
                    $like = array($search['value'],'name,username,email_id,mobile_no');
                }

                $order_array= $this->request->getPost('order');
                if(isset($order_array[0]['column']) && $order_array[0]['column']!=0){
                    $col_id = $order_array[0]['column'];
                    $order = array($columns[$col_id]['data'] => $order_array[0]['dir']);
                }
                $where['role_id>'] = '2';
                $totalData = $this->Crud_model->get_data_count($this->table,$where);
                $totalFiltered = $this->Crud_model->get_data_count($this->table,$where);
                $datalist = $this->Crud_model->get_data($this->table,$where,$like,$order,$limit,$start);
                if ( isset($datalist) && ! empty($datalist)) {
                    foreach ($datalist as $list) {
                        $password = '';
                        $authentication = '';
                        $edit = '';
                        if(valid_session($this->module_name,'edit',false)){
                            $edit = '<a href="'.admin_site_url("user/page/add-edit/".encode_string($list->id)).'" class="btn ripple btn-primary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('edit').'"> <i class="fa fa-edit"></i> </a>';
                        }
                        if(valid_session($this->module_name,'password',false)){
                            $password = '<a href="'.admin_site_url("user/page/update-password/".encode_string($list->id)).'" class="btn ripple btn-danger btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('update_password').'"> <i class="fa fa-key"></i> </a>';
                        }
                        if(valid_session($this->module_name,'2fa',false) && $list->authentication_status=='1'){
                            $authentication = '<a href="'.admin_site_url("user/page/update-2fa/".encode_string($list->id)).'" class="btn ripple btn-info btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('update_2FA').'"> <i class="fa fa-lock"></i> </a>';
                        }
                        $details = '<a href="'.admin_site_url("user/page/details/".encode_string($list->id)).'" class="btn ripple btn-secondary btn-sm mt-1 mb-1 text-sm text-white popup-page" data-placement="top" data-toggle="tooltip" title="'.translate('details').'"> <i class="fa fa-eye"></i> </a>';
                        if($list->id!=1){
                            $status = $list->is_active=='1' ? '<span class="badge bg-success cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('user/crud').'">'.translate('active').'</span>' : '<span class="badge bg-danger cursor-pointer change-status" data-action="change_status" data-id="'.encode_string($list->id).'" data-url="'.admin_site_url('user/crud').'">'.translate('inactive').'</span>';
                        }else{
                            $status = '<span class="badge bg-success">'.translate('active').'</span>';
                        }

                        $image = uploads_url('profile/'.$list->profile_image,uploads_url('profile/default.png'));

                        $nestedData = array();
                        $nestedData['id']           = $list->id;
                        $nestedData['image']        = '<a data-fancybox="image" data-src="'.$image.'" data-caption="'.$list->name.'"><img alt="'.$list->name.'" class="radius cursor-pointer image-delay" src="'.uploads_url('loader.gif').'" data-src="'.$image.'" style="width:48px;height:48px;"></a>';
                        $nestedData['name']         = $list->name;
                        $nestedData['email_id']     = $list->email_id;
                        $nestedData['mobile_no']    = '+'.$list->country_code.'-'.$list->mobile_no;
                        $nestedData['role']         = get_column_value(TBL_ROLE,array('id'=>$list->role_id),'name');;
                        $nestedData['created_on']   = utc_to_local_datetime($list->created_on);
                        $nestedData['status']       = $status;
                        $nestedData['actions']      = '<div class="btn-group" role="group"">'.$edit.$password.$authentication.$details.'</div>';
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
            }else if($action=='new_user'){
                if(!valid_session($this->module_name,'add',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('user');
                
                $validation = array();
                $validation['username'] = ['label' => translate('username'), 'rules' => 'required'];
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required|is_unique['.$this->table.'.name]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['email_id'] = ['label' => translate('email_id'), 'rules' => 'required|is_unique['.$this->table.'.email_id]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['mobile_no'] = ['label' => translate('mobile_no'), 'rules' => 'required|is_unique['.$this->table.'.mobile_no]','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['role_id'] = ['label' => translate('role'), 'rules' => 'required'];
                $validation['country_code'] = ['label' => translate('country_code'), 'rules' => 'required'];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $uis = array('username','name','country_code','email_id','role_id','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['mobile_no'] = str_replace(" ", "", $this->request->getPost('mobile_no'));
                $up_data['created_by'] = json_encode($updated);
                $up_data['created_on'] = date(DB_DATETIME_FORMAT);
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->insert_data($this->table,$up_data);
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$ins_id));
                    add_app_log($this->table,'6',$ins_id,$new_data);
                    if(isset( $_FILES['user_profile'])){
                        $profile_image = $up_data['username'].".png";
                        if(move_upload_file_if_ok('user_profile',FCPATH."writable/uploads/profile/".$profile_image)){
                            $this->Crud_model->update_data($this->table,array('profile_image'=>$profile_image),array('id'=>$ins_id));
                        }
                    }
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('details_updated_successfully');
                }else{
                    $json['message'] = translate('something_went_wrong');
                }
            }else if($action=='update_user'){
                if(!valid_session($this->module_name,'edit',false)){
                    echo encode_json($json);exit;
                }
                $this->module_title = translate('user');
                $id = $this->request->getPost('id');
                $id = decode_string($id);

                $validation = array();
                $validation['username'] = ['label' => translate('username'), 'rules' => 'required|is_unique['.$this->table.'.username,id,'.$id.']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['name'] = ['label' => translate('name'), 'rules' => 'required'];
                $validation['email_id'] = ['label' => translate('email_id'), 'rules' => 'required|is_unique['.$this->table.'.email_id,id,'.$id.']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['mobile_no'] = ['label' => translate('mobile_no'), 'rules' => 'required|is_unique['.$this->table.'.mobile_no,id,'.$id.']','errors' => [
                'is_unique' => '{field} '.translate('is_already_exist')]];
                $validation['role_id'] = ['label' => translate('role'), 'rules' => 'required'];
                $validation['is_active'] = ['label' => translate('status'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['country_code'] = ['label' => translate('country_code'), 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $this->Crud_model->start_trans();
                $old_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                $uis = array('username','name','country_code','email_id','role_id','is_active');
                $up_data = array();
                foreach ($uis as $key) {
                    $up_data[$key] = $this->request->getPost($key);
                }
                $up_data['mobile_no'] = str_replace(" ", "", $this->request->getPost('mobile_no'));
                $up_data['updated_by'] = json_encode($updated);
                $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                $ins_id = $this->Crud_model->update_data($this->table,$up_data,array('id'=>$id));
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    if(isset( $_FILES['user_profile'])){
                        $profile_image = $up_data['username'].".png";
                        if(move_upload_file_if_ok('user_profile',FCPATH."writable/uploads/profile/".$profile_image)){
                            $ins_id = $this->Crud_model->update_data($this->table,array('profile_image'=>$profile_image),array('id'=>$id));
                        }
                    }

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
                $user = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                if(!empty($user)){
                    $up_data = array();
                    $up_data['is_active'] = '1';
                    if($user->is_active=='1'){
                        $up_data['is_active'] = '0';
                    }
                    $up_data['updated_by'] = json_encode($updated);
                    $up_data['updated_on'] = date(DB_DATETIME_FORMAT);
                    $this->Crud_model->update_data($this->table,$up_data,array('id'=>$id));
                }
                $this->Crud_model->end_trans();
                if($this->Crud_model->status_trans()){
                    $new_data = $this->Crud_model->get_data_row($this->table,array('id'=>$id));
                    add_app_log($this->table,'7',$id,$new_data,$user);
                    
                    $json['status'] = true;
                    $json['type'] = 'success';
                    $json['message'] = translate('status_update_successfully');
                }else{
                    $json['message'] = translate('unable_to_update_status');
                }
            }else if($action=='update_user_password'){
                $this->module_title = translate('user');
                
                $validation = array();
                $validation['new_password'] = ['label' => translate('new_password'), 'rules' => 'required'];
                $validation['confirm_password'] = ['label' => translate('confirm_password'), 'rules' => 'trim|required|matches[new_password]'];
                $validation['admin_password'] = ['label' => translate('admin_password'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $id = $this->request->getPost('id');
                $id = decode_string($id);
                $err = '';
                $password = $this->request->getPost('new_password');
                $admin_password = $this->request->getPost('admin_password');
                $user = $this->Crud_model->get_data_row(TBL_ADMIN,array('id'=>$id));
                if($user->password==sha1($password)){
                    $err = translate('password_is_already_exist_in_our_history');
                }
                $admin = $this->Crud_model->get_data_row(TBL_ADMIN,array('id'=>user_setting('admin_id')));
                if($admin->password!=sha1($admin_password)){
                    $err = translate('invalid_admin_password_try_again');
                }
                if($err!=''){
                    $json['message'] = $err;
                }else{
                    $this->Crud_model->start_trans();
                    $up_data = array();
                    $up_data['password_token'] = '';
                    $up_data['password'] = sha1($password);
                    $update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>$id));
                    $this->Crud_model->end_trans();
                    if($this->Crud_model->status_trans()){
                        $json['status'] = true;
                        $json['type'] = 'success';
                        $json['message'] = translate('user_password_updated_successfully');
                    }else{
                        $json['message'] = translate('something_went_wrong');
                    }
                }
            }else if($action=='reset_user_2fa'){
                $this->module_title = translate('user');
                $validation = array();
                $validation['admin_password'] = ['label' => translate('admin_password'), 'rules' => 'required'];
                $validation['action'] = ['label' => $this->module_title, 'rules' => 'required'];
                $validation['id'] = ['label' => $this->module_title, 'rules' => 'required'];
                $this->validate_submitted_data($this->module_title, $validation);
                $admin_password = $this->request->getPost('admin_password');
                $id = $this->request->getPost('id');
                $id = decode_string($id);
                $err = '';
                $admin = $this->Crud_model->get_data_row(TBL_ADMIN,array('id'=>user_setting('admin_id')));
                if($admin->password!=sha1($admin_password)){
                    $err = translate('invalid_admin_password_try_again');
                }
                if($err!=''){
                    $json['message'] = $err;
                }else{
                    $this->Crud_model->start_trans();
                    $up_data = array();
                    $up_data['authentication_status'] = '0';
                    $up_data['authentication_type'] = 'd';
                    $up_data['authentication_details'] = '';
                    $update = $this->Crud_model->update_data(TBL_ADMIN,$up_data,array('id'=>$id));
                    $this->Crud_model->end_trans();
                    if($this->Crud_model->status_trans()){
                        $json['status'] = true;
                        $json['type'] = 'success';
                        $json['message'] = translate('user_2FA_updated_successfully');
                    }else{
                        $json['message'] = translate('something_went_wrong');
                    }
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
                $page_data['page_title'] = $id!='' ? translate('update_user') : translate('new_user');
                $page_data['page_action'] = $id!='' ? 'update_user' : 'new_user';
                $page_data['id'] = $id;
                $page_data['role_list'] = $this->Crud_model->get_role_data(array('is_active' => '1'));
                echo admin_view($this->module_name.'/popup-add-edit',$page_data);
            }else if($slug=='details'){
                $page_data = array();
                $page_data['page_title'] = translate('user_details');
                $page_data['id'] = $id;
                $page_data['role_id'] = get_column_value($this->table,array('id'=>$id),'role_id');
                echo admin_view($this->module_name.'/popup-details',$page_data);
            }else if($slug=='update-password'){
                $page_data = array();
                $page_data['page_title'] = translate('user_details');
                $page_data['id'] = $id;
                $page_data['page_action'] = 'update_user_password';
                echo admin_view($this->module_name.'/popup-update-password',$page_data);
            }else if($slug=='update-2fa'){
                $page_data = array();
                $page_data['page_title'] = translate('user_details');
                $page_data['id'] = $id;
                $page_data['page_action'] = 'reset_user_2fa';
                echo admin_view($this->module_name.'/popup-update-2fa',$page_data);
            }
        }
    }
}
/* End of file User.php */
/* Location: ./app/controllers/User.php */