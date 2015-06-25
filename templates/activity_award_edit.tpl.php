<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
   <form method="post" action="?m=activity&c=activity_award&a=edit&formid=<?php echo $_GET['formid']?>" name="myform" id="myform">
    <table class="table_form" width="100%" cellspacing="0">
      <tr>
        <th width="150"><strong>奖项名称：</strong></th>
        <td><input name="info[name]" id="name" class="input-text" type="text" size="30" value="<?php echo new_html_special_chars($data['name'])?>" /></td>
      </tr>
      <tr>
        <th width="150"><strong>奖品名称：</strong></th>
        <td><input name="info[prize]" id="prize" class="input-text" type="text" size="30" value="<?php echo new_html_special_chars($data['prize'])?>" /></td>
      </tr>
      <tr>
        <th width="150"><strong>奖品总数量：</strong></th>
        <td><input name="info[total]" id="total" class="input-text" type="text" size="10" value="<?php echo new_html_special_chars($data['total'])?>" /></td>
      </tr>
      <tr>
        <th width="150"><strong>奖品剩余数量：</strong></th>
        <td><input name="info[surplus]" id="surplus" class="input-text" type="text" size="10" value="<?php echo new_html_special_chars($data['surplus'])?>" /></td>
      </tr>
      <tr>
        <th width="150"><strong>中奖几率：</strong></th>
        <td><input name="info[chance]" id="chance" class="input-text" type="text" size="10" value="<?php echo new_html_special_chars($data['chance'])?>" />%</td>
      </tr>
    </table>
    <input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class="dialog">&nbsp;<input type="reset" class="dialog" value=" <?php echo L('clear')?> ">
  </form>
</div>


