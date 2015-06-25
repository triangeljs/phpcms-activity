<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
   <form method="post" action="?m=activity&c=activity&a=addAward&formid=<?php echo $_GET['formid']?>" name="myform" id="myform">
    <table class="table_form" width="100%" cellspacing="0">
      <tr>
        <th width="150"><strong>奖项名称：</strong></th>
        <td><input name="info[name]" id="name" class="input-text" type="text" size="30" /></td>
      </tr>
      <tr>
        <th width="150"><strong>奖品名称：</strong></th>
        <td><input name="info[prize]" id="prize" class="input-text" type="text" size="30" /></td>
      </tr>
      <tr>
        <th width="150"><strong>奖品总数量：</strong></th>
        <td><input name="info[total]" id="total" class="input-text" type="text" size="10" /></td>
      </tr>
      <tr>
        <th width="150"><strong>中奖几率：</strong></th>
        <td><input name="info[chance]" id="chance" class="input-text" type="text" size="10" />%</td>
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
  });
</script>
</body>
</html>