<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class activity_award extends admin {
  private $db, $award_db, $user_db;
	public function __construct() {
		parent::__construct();
		$this->db = pc_base::load_model('activity_award_model');
	}
  
  //奖项列表
	public function init() {
    $formid = intval($_GET['formid']);
    $r['title'] = $_GET['title'];
    $page = max(intval($_GET['page']), 1);
		$data = $this->db->listinfo(array('activity_id'=>$formid), '`award_id` DESC', $page);
    $big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=activity&c=activity&a=add\', title:\''.L('activity_add').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('activity_add'));
		include $this->admin_tpl('activity_award');
	}
  
  /**
	 * 添加奖项
	 */
  public function add() {
    if (isset($_POST['dosubmit'])) {
      $_POST['info']['activity_id'] = intval($_GET['formid']);
      $_POST['info']['surplus'] = $_POST['info']['total'];
      $award_db = pc_base::load_model('activity_award_model');
      $award_db->insert($_POST['info'], true);
      showmessage(L('add_success'), '', '', 'addAward');
    } else {
      $siteid = $this->get_siteid();
			$template_list = template_list($siteid, 0);
			$site = pc_base::load_app_class('sites','admin');
			$info = $site->get_by_id($siteid);
			foreach ($template_list as $k=>$v) {
				$template_list[$v['dirname']] = $v['name'] ? $v['name'] : $v['dirname'];
				unset($template_list[$k]);
			}
			$formid = intval($_GET['formid']);
			pc_base::load_sys_class('form', '', false);
			$show_header = $show_validator = $show_scroll = 1;
      include $this->admin_tpl('activity_award_add');
    }
  }
  
  /**
	 * 编辑奖项
	 */
  public function edit() {
    if (!isset($_GET['formid']) || empty($_GET['formid'])) {
			showmessage(L('illegal_operation'), HTTP_REFERER);
		}
		$formid = intval($_GET['formid']);
    if (isset($_POST['dosubmit'])) {
      $this->db->update($_POST['info'], array('award_id'=>$formid));
      showmessage(L('update_success'), '?m=activity&c=activity_award&a=init&formid='.$formid, '', 'edit');
    } else {
      $siteid = $this->get_siteid();
			$template_list = template_list($siteid, 0);
			$site = pc_base::load_app_class('sites','admin');
			$info = $site->get_by_id($siteid);
			foreach ($template_list as $k=>$v) {
				$template_list[$v['dirname']] = $v['name'] ? $v['name'] : $v['dirname'];
				unset($template_list[$k]);
			}
			$data = $this->db->get_one(array('award_id'=>$formid));
			$data['setting'] = string2array($data['setting']);
			pc_base::load_sys_class('form', '', false);
			$show_header = $show_validator = $show_scroll = 1;
			include $this->admin_tpl('activity_award_edit');
    }
  }
  
  /**
	 * 删除表单向导
	 */
  public function delete() {
    $siteid = $this->get_siteid();
    if (isset($_GET['formid']) && !empty($_GET['formid'])) {
      $formid = intval($_GET['formid']);
      $this->db->delete(array('award_id'=>$formid));
      showmessage(L('operation_success'), HTTP_REFERER);
    } elseif (isset($_POST['formid']) && !empty($_POST['formid'])) {
      if (is_array($_POST['formid'])) {
				foreach ($_POST['formid'] as $fid) {
					$this->db->delete(array('award_id'=>$fid));
				}
			}
			showmessage(L('operation_success'), HTTP_REFERER);
    } else {
			showmessage(L('illegal_operation'), HTTP_REFERER);
		}
  }
  
}
?>