<?php
defined('IN_PHPCMS') or exit('No permission resources.');
define('CACHE_MODEL_PATH',PHPCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
session_start();

class index {
	private $db, $m_db;
	function __construct() {
		$this->db = pc_base::load_model('activity_model');
		$this->m_db = pc_base::load_model('activity_award_model');
		$this->u_db = pc_base::load_model('activity_user_model');
		$this->siteid = intval($_GET[siteid]) ? intval($_GET[siteid]) : get_siteid();
	}
  
  /**
	 * 抽奖活动首页
	 */
	public function index() {
		include template('activity', 'index');
	}
  
  /**
	 * 抽奖活动展示
	 */
  public function show() {
    if (!isset($_GET['formid']) || empty($_GET['formid'])) {
			$_GET['action'] ? exit : showmessage(L('form_no_exist'));
		}
    $formid = intval($_GET['formid']);
    $r = $this->db->get_one(array('activity_id'=>$formid), '*');
    if (!$r) {
			$_GET['action'] ? exit : showmessage('此抽奖活动不存在或者已被删除！', HTTP_REFERER);
		}
    $template = $r[show_template];
    $forminfos_data = $this->m_db->listinfo(array('activity_id'=>$formid), '`activity_id` DESC');
    include template('activity', $template, $default_style);
  }
	
	/**
	 * 中奖信息录入
	 */
	public function add() {
		$_POST['info']['award_id'] = $_POST['info']['award_id'];
		$_POST['info']['create_time'] = $_POST['info']['create_time'];
		$s = sha1($_POST['info']['create_time'].$_POST['info']['award_id'].'yangfan');
		if($_SESSION["hash"] == $s) {
			$data = $this->m_db->get_one(array('award_id'=>$_POST['info']['award_id']));
			$this->u_db->insert($_POST['info'], true);
			$arr = array('surplus' => $data['surplus'] - 1);
			$this->m_db->update($arr, array('award_id'=>$_POST['info']['award_id']));
      showmessage('中奖信息已录入', HTTP_REFERER);
		} else {
			showmessage(L('illegal_operation'), HTTP_REFERER);
		}
	}
  
  /**
	 * 抽奖代码
	 */
  public function data() {
    if (!isset($_GET['formid']) || empty($_GET['formid'])) {
			showmessage(L('illegal_operation'), HTTP_REFERER);
		}
    $formid = intval($_GET['formid']);
    $prize_arr = array();
    $forminfos_data = $this->m_db->listinfo(sprintf('activity_id=%d and surplus>0', $formid), '`activity_id` DESC');
    for ($i=0; $i<count($forminfos_data); $i++) {
      $prize_arr[$i] = array('id'=>$i + 1,'award_id'=>$forminfos_data[$i][award_id],'name'=>$forminfos_data[$i][name],'prize'=>$forminfos_data[$i][prize],'v'=>$forminfos_data[$i][chance],'total'=>$forminfos_data[$i][total]);
    }
    foreach ($prize_arr as $key => $val) { 
      $arr[$val['id']] = $val['v']; 
    }
    $rid = $this->getRand($arr); //根据概率获取奖项id
    $res = $prize_arr[$rid-1]; //中奖项
		$now = date('y-m-d h:i:s');
		$_SESSION["times"] = $now;
    $_SESSION["hash"] = sha1($now.$res['award_id'].'yangfan');
		$result['award_id'] = $res[award_id];
    $result['name'] = $res[name];
    $result['prize'] = $res['prize'];
    $result['times'] = $_SESSION['times'];
    echo json_encode($result);
  }
  
  private function getRand($proArr) {
    $result = '';
    //概率数组的总概率精度
    $proSum = array_sum($proArr);
    //概率数组循环
    foreach ($proArr as $key => $proCur) {
      $randNum = mt_rand(1, $proSum);
      if ($randNum <= $proCur) {
        $result = $key;
        break;
      } else {
        $proSum -= $proCur;
      }
    }
    unset ($proArr);
    return $result;
  }
  
}