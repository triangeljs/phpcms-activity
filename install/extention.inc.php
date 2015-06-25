<?php
defined('IN_PHPCMS')or exit('ACCess Denied');
defined('INSTALL')or exit('ACCess Denied');

$parentid = $menu_db->insert(array('name'=>'activity', 'parentid'=>29, 'm'=>'activity', 'c'=>'activity', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);

$menu_db->insert(array('name'=>'activity_add', 'parentid'=>$parentid, 'm'=>'activity', 'c'=>'activity', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'activity_edit', 'parentid'=>$parentid, 'm'=>'activity', 'c'=>'activity', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'form_info_list', 'parentid'=>$parentid, 'm'=>'activity', 'c'=>'activity_info', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'activity_delete', 'parentid'=>$parentid, 'm'=>'activity', 'c'=>'activity', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$menu_db->insert(array('name'=>'activity_award_add', 'parentid'=>$parentid, 'm'=>'activity', 'c'=>'activity', 'a'=>'addAward', 'data'=>'', 'listorder'=>0, 'display'=>'0'));

$language = array('activity'=>'抽奖活动', 'activity_add'=>'添加抽奖活动', 'activity_edit'=>'修改抽奖活动', 'activity_info_list'=>'信息列表', 'activity_delete'=>'删除抽奖活动', 'activity_award_add'=>'添加奖项');
?>