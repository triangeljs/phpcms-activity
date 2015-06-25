<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
<form method="post" action="?m=activity&c=activity&a=edit&formid=<?php echo $_GET['formid']?>" name="myform" id="myform">
<table class="table_form" width="100%" cellspacing="0">
	<tr>
		<th width="150"><strong>活动名称：</strong></th>
		<td><input name="info[title]" id="title" class="input-text" type="text" size="30" value="<?php echo new_html_special_chars($data['title'])?>"></td>
	</tr>
	<tr>
		<th width="150"><strong>活动说明：</strong></th>
		<td><textarea name="info[description]" id="description" rows="6" cols="50"><?php echo new_html_special_chars($data['description'])?></textarea></td>
	</tr>
	<tr>
		<th width="150"><strong>开始时间：</strong></th>
		<td><?php echo form::date('setting[starttime]',date('Y-m-d',strtotime($data['start_time'])))?></td>
	</tr>
	<tr>
		<th width="150"><strong>结束时间：</strong></th>
		<td><?php echo form::date('setting[endtime]',date('Y-m-d',strtotime($data['end_time'])))?></td>
	</tr>
	<tr>
	  <th width="150"><strong>可选风格：</strong></th>
	  <td><?php echo form::select($template_list, $data['default_style'], 'name="info[default_style]" id="style" onchange="load_file_list(this.value)"', L('please_select'))?></td>
	</tr>
	<tr>
	  <th width="150"><strong>模板选择：</strong></th>
	  <td id="show_template"><script type="text/javascript">$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style=<?php echo $data['default_style']?>&id=<?php echo $data['show_template']?>&module=formguide&templates=show&name=info&pc_hash='+pc_hash, function(data){$('#show_template').html(data.show_template);});</script></td>
	</tr>
</table>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class="dialog">&nbsp;<input type="reset" class="dialog" value=" <?php echo L('clear')?> ">
</form>
</div>
<script type="text/javascript">
  function load_file_list(id) {
	if (id=='') return false;
	$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style='+id+'&module=activity&templates=show|show_js&name=info&pc_hash='+pc_hash, function(data){$('#show_template').html(data.show_template);});
}
  $(function(){
    $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'220',height:'70'}, function(){this.close();$(obj).focus();})}});
    $('#title').formValidator({onshow:"请输入活动名称！",oncorrect:"输入正确"}).inputValidator({min:1,onerror:"活动名称不能为空!"});
  });
</script>
</body>
</html>