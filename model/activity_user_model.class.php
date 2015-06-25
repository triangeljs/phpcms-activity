<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class activity_user_model extends model {
  public $table_name = '';
  public function __construct() {
    $this->db_config = pc_base::load_config('database');
    $this->db_setting = 'default';
    $this->table_name = 'activity_user';//这个就是表名称,不用加表前缀
    parent::__construct();
    $this->charset = $this->db_config[$this->db_setting]['charset'];
  }
}
?>
