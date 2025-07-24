<?php

namespace App\Models;

class Settings_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = TBL_SETTINGS;
        parent::__construct($this->table);
    }

    function get_setting($key) {
        $result = $this->db_builder->getWhere(array('key' => $key), 1);
        if (count($result->getResult()) == 1) {
            return $result->getRow()->value;
        }
    }

    function save_setting($key, $value) {
        $fields = array(
            'key' => $key,
            'value' => $value
        );

        $exists = $this->get_setting($key);
        if ($exists === NULL) {
            return $this->db_builder->insert($fields);
        } else {
            $this->db_builder->where('key', $key);
            $this->db_builder->update($fields);
        }
    }
    
    //find all app settings and login user's setting
    //user's settings are saved like this: user_[userId]_settings_name;
    function get_all_required_settings() {
        $settings_table = $this->db->prefixTable(TBL_SETTINGS);
        $sql = "SELECT $settings_table.key,  $settings_table.value
        FROM $settings_table";
        return $this->db->query($sql);
    }

}
