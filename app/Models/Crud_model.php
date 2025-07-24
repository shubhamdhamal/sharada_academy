<?php
namespace App\Models;
use CodeIgniter\Model;
class Crud_model extends Model {
    protected $db;
    function __construct() {
        $this->db = db_connect('default');
        $this->db->query("SET sql_mode = ''");
    }
    function get_tbl_details($table,$details=''){
        $builder = $this->db->table('information_schema.tables');

        $builder->select('*');
        $builder->where('table_name',$table);
        $builder->where('table_schema = DATABASE()');
        $query = $builder->get();
        if($query->getRow()){ 
            if($details!='' && isset($query->getRow()->$details)){
                return $query->getRow()->$details;
            } else{
                return $query->getRow();
            }
        }
        return false;
    }
    public function get_column_value($table,$where,$column,$default='') {
        $builder = $this->db->table($table);
        $builder->select('*');
        if(!empty($where)){
            $builder->where($where);
        }
        $query = $builder->get();
        if ($query->getRow()) {
            return isset($query->getRow()->$column) ? $query->getRow()->$column : $default;
        }
        return $default;
    }
    function get_data_row($table,$where = array(),$order = array()) {
        $builder = $this->db->table($table);
        $builder->select('*');
        if(!empty($where)){
            $builder->where($where);
        }
        if(!empty($order)){
            $key = key($order);
            $builder->orderBy($key,$order[$key]);
        }
        $query = $builder->get();
        if ($query->getRow()) {
            return $query->getRow();
        }
        return false;
    }
    function update_data($table,$data,$where = array()) {
        $builder = $this->db->table($table);
        $builder->set($data);
        if(!empty($where)){
            $builder->where($where);
        }
        if ($builder->update()) {
            return true;
        }
        return false;
    }
    function insert_data($table,$data) {
        $builder = $this->db->table($table);
        if ($builder->insert($data)) {
            return $this->db->insertID();
        }
        return false;
    }
    function get_data($table,$where = array(),$like = array(),$order = array(),$limit=0,$start=0) {
        $builder = $this->db->table($table);
        $builder->select('*');
        if(!empty($where)){
            $builder->where($where);
        }
        if(!empty($like)){
            $search = $like[0];
            $data = explode(',', $like[1]);
            if(!empty($data)){
                $wh_lst = array();
                foreach ($data as $dkey => $dvalue) {
                    $wh_lst[] = $dvalue." LIKE '%".$search."%'";
                }
                $builder->where("(".implode(' OR ',$wh_lst).")");
            }
        }
        if($limit!=0){
            if($start!=''){
                $builder->limit($limit, $start);
            }
            else{
                $builder->limit($limit);
            }
        }
        if(!empty($order)){
            $key = key($order);
            $builder->orderBy($key,$order[$key]);
        }
        $query = $builder->get();
        if ($query->getResult()) {
            return $query->getResult();
        }
        return false;
    }
    function get_data_count($table,$where = array()) {
        $builder = $this->db->table($table);
        $builder->select('*');
        if(!empty($where)){
            $builder->where($where);
        }
        $query = $builder->get();
        if ($query->getResult()) {
            return count($query->getResult());
        }
        return 0;
    }
    function get_data_sum($table,$column,$where = array()) {
        $builder = $this->db->table($table);
        $builder->selectAvg($column);
        if(!empty($where)){
            $builder->where($where);
        }
        $query = $builder->get();
        if ($query->getRow()) {
            return isset($query->getRow()->$column) ? $query->getRow()->$column : 0;
        }
        return 0;
    }
    function get_data_avg($table,$column,$where = array()) {
        $builder = $this->db->table($table);
        $builder->selectAvg($column);
        if(!empty($where)){
            $builder->where($where);
        }
        $query = $builder->get();
        if ($query->getRow()) {
            return isset($query->getRow()->$column) ? $query->getRow()->$column : 0;
        }
        return 0;
    }
    public function get_role_data($where = array()) {
        $builder = $this->db->table(TBL_ROLE);

        $builder->select('*');
        if(user_setting('role_id')!=1){
            $builder->where('id>'.user_setting('role_id'));
        }
        if(!empty($where)){
            $builder->where($where);
        }
        $query = $builder->get();
        if ($query->getResult()) {
            return $query->getResult();
        }
        return false;
    }
    
    function delete_data($table,$where = array()) {
        $builder = $this->db->table($table);
        if(!empty($where)){
            $builder->where($where);
        }
        if ($builder->delete()) {
            return true;
        }
        return false;
    }
    function get_chield_category_data($category_id = array(),$order = array(),$limit=0,$start=0) {
        $builder = $this->db->table(TBL_CATEGORY);
        $builder->select('*');
        $builder->where('parent_id',$category_id);
        $builder->orWhere('path LIKE "'.$category_id.'-%"');

        if($limit!=0){
            if($start!=''){
                $builder->limit($limit, $start);
            }
            else{
                $builder->limit($limit);
            }
        }
        if(!empty($order)){
            $key = key($order);
            $builder->orderBy($key,$order[$key]);
        }
        $query = $builder->get();
        if ($query->getResult()) {
            return $query->getResult();
        }
        return false;
    }
    function start_trans() {
        $this->db->transStart();
    }
    function end_trans() {
        $this->db->transComplete();
    }
    function status_trans() {
        return $this->db->transStatus();
    }
    function last_query() {
        return $this->db->getLastQuery();
    }
}
