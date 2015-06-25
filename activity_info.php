<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class activity_info extends admin {
  private $db, $m_db;
	public function __construct() {
		parent::__construct();
		$this->db = pc_base::load_model('activity_user_model');
		$this->m_db = pc_base::load_model('activity_award_model');
	}
	
	//中奖信息列表
	public function init() {
    $formid = intval($_GET['formid']);
		$r['title'] = $_GET['title'];
		$page = max(intval($_GET['page']), 1);
		$data = $this->db->listinfo(array('activity_id'=>$formid), '`user_id` DESC', $page);
		$award_data = $this->m_db->listinfo(array('activity_id'=>$formid), '`award_id` DESC');
		for($x=0;$x<count($data);$x++) {
			$s = $this->getData($award_data,$data[$x][award_id]);
			$data[$x][title] = $s['name'];
			$data[$x][prize] = $s['prize'];
		}
		include $this->admin_tpl('activity_user');
	}
	
	private function getData($proArr,$id) {
		foreach ($proArr as $k=>$v) {
			if($v[award_id] == $id) {
				return $v;
				break;
			}
		}
	}
}