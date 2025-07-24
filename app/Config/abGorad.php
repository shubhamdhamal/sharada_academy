<?php
/* Don't change or add any new config in this file */
namespace Config;
use CodeIgniter\Config\BaseConfig;
class abGorad extends BaseConfig {
    public $app_login_user_array = array();
    public $app_login_client_array = array();
    public $app_settings_array = array(
        "app_code" => "sharda",
        "app_version" => "1.0.2",
        "app_updates_path" => './writable/updates/',
    );
    public $app_csrf_exclude_uris = array(
        "autoscript/cron"
    );
    public function __construct() {
        $this->app_csrf_exclude_uris = app_hooks()->apply_filters('app_filter_app_csrf_exclude_uris', $this->app_csrf_exclude_uris);
    }
}
