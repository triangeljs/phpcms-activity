<?php
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1; 
include $this->admin_tpl('header', 'admin');
?>
<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">抽奖活动--<?php if ($formid) echo $r['title']; else echo L('public')?> 管理奖项</h2>
  <div class="content-menu ib-a blue line-x"><a class="add fb" href="javascript:addAward('<?php echo $formid?>');void(0);"><em>添加奖项</em></a></div>
</div>
<div class="pad-lr-10">
  <form name="myform" action="?m=activity&c=activity_award&a=listorder" method="post">
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('formid[]');"></th>
            <th width='200' align="center">奖项名称</th>
            <th width='200' align="center">奖品名称</th>
            <th width="100" align="center">奖品总数量</th>
            <th width="100" align="center">奖品剩余数量</th>
            <th width="100" align="center">中奖几率</th>
            <th align="center">管理操作</th>
          </tr>
        </thead>
      <tbody class="td-line">
        <?php
        if(is_array($data)){
          foreach($data as $form){
        ?>
        <tr>
          <td align="center"><input type="checkbox" name="formid[]" value="<?php echo $form['award_id']?>"></td>
          <td><?php echo $form['name']?></td>
          <td><?php echo $form['prize']?></td>
          <td align="center"><?php echo $form['total']?></td>
          <td align="center"><?php echo $form['surplus']?></td>
          <td align="center"><?php echo $form['chance']?></td>
          <td align="center"><a href="javascript:edit('<?php echo $form['award_id']?>', '<?php echo $form['name']?>');void(0);"><?php echo L('modify')?></a> | <a href="?m=activity&c=activity_award&a=delete&formid=<?php echo $form['award_id']?>" onClick="return confirm('<?php echo L('confirm', array('message' => addslashes(new_html_special_chars($form['name']))))?>')">删除</a></td>
        </tr>
        <?php 
         }
          }
        ?>
      </tbody>
    </table>
    <div class="btn"><label for="check_box"><?php echo L('selected_all')?>/<?php echo L('cancel')?></label><input name="submit" type="submit" class="button" value="删除选中" onClick="document.myform.action='?m=activity&c=activity_award&a=delete';return confirm('您确定要删除吗？')">&nbsp;&nbsp;</div>  </div>
    <div id="pages"><?php echo $this->db->pages;?></div>
  </form>
</div>
<script type="text/javascript">
  function addAward(id) {
    window.top.art.dialog({id:'addAward'}).close();
    window.top.art.dialog({title:'添加奖项', id:'addAward', iframe:'?m=activity&c=activity_award&a=add&formid='+id ,width:'550px',height:'250px'}, function(){var d = window.top.art.dialog({id:'addAward'}).data.iframe;
    var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'addAward'}).close()});
  }
  
  function edit(id, title) {
    window.top.art.dialog({id:'edit'}).close();
    window.top.art.dialog({title:'编辑奖项--'+title, id:'edit', iframe:'?m=activity&c=activity_award&a=edit&formid='+id ,width:'550px',height:'250px'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
    var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
  }
</script>
</body>
</html>