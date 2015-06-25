<?php
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1; 
include $this->admin_tpl('header', 'admin');
?>
<div class="subnav">
  <div class="content-menu ib-a blue line-x">
  <?php if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';?>
  <?php echo admin::submenu($_GET['menuid'],$big_menu); ?>
  </div>
</div>
<div class="pad-lr-10">
  <form name="myform" action="?m=activity&c=activity&a=listorder" method="post">
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('formid[]');"></th>
            <th width='150' align="center">活动名称</th>
            <th align="center">活动说明</th>
            <th width="150" align="center">活动开始时间</th>
            <th width="150" align="center">活动结束时间</th>
            <th width="250" align="center">管理操作</th>
          </tr>
        </thead>
      <tbody>
        <?php
        if(is_array($data)){
          foreach($data as $form){
        ?>
        <tr>
          <td align="center"><input type="checkbox" name="formid[]" value="<?php echo $form['activity_id']?>"></td>
          <td><?php echo $form['title']?> [<a href="<?php echo APP_PATH?>index.php?m=activity&c=index&a=show&formid=<?php echo $form['activity_id']?>" target="_blank">访问前台</a>] <?php if ($form['items']) {?>(<?php echo $form['items']?>)<?php }?></td>
          <td align="center"><?php echo $form['description']?></td>
          <td align="center"><?php echo date('Y-m-d',strtotime($form['start_time'])) ?></td>
          <td align="center"><?php echo date('Y-m-d',strtotime($form['end_time'])) ?></td>
          <td align="center"><a href="?m=activity&c=activity_info&a=init&formid=<?php echo $form['activity_id']?>&title=<?php echo $form['title']?>">中奖名单</a> |  <a href="javascript:addAward('<?php echo $form['activity_id']?>', '<?php echo $form['title']?>');void(0);">添加奖项</a> |  <a href="?m=activity&c=activity_award&a=init&formid=<?php echo $form['activity_id']?>&title=<?php echo $form['title']?>">管理奖项</a> | <a href="javascript:edit('<?php echo $form['activity_id']?>', '<?php echo $form['title']?>');void(0);"><?php echo L('modify')?></a> | <a href="?m=activity&c=activity&a=delete&formid=<?php echo $form['activity_id']?>" onClick="return confirm('<?php echo L('confirm', array('message' => addslashes(new_html_special_chars($form['title']))))?>')">删除</a></td>
        </tr>
        <?php 
         }
          }
        ?>
      </tbody>
    </table>
    <div class="btn"><label for="check_box"><?php echo L('selected_all')?>/<?php echo L('cancel')?></label><input name="submit" type="submit" class="button" value="删除选中" onClick="document.myform.action='?m=activity&c=activity&a=delete';return confirm('您确定要删除吗？')">&nbsp;&nbsp;</div>  </div>
    <div id="pages"><?php echo $this->db->pages;?></div>
  </form>
</div>
<script type="text/javascript">
  function addAward(id, title) {
    window.top.art.dialog({id:'addAward'}).close();
    window.top.art.dialog({title:'添加奖项--'+title, id:'addAward', iframe:'?m=activity&c=activity&a=addAward&formid='+id ,width:'550px',height:'250px'}, function(){var d = window.top.art.dialog({id:'addAward'}).data.iframe;
    var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'addAward'}).close()});
  }
  
  function edit(id, title) {
    window.top.art.dialog({id:'edit'}).close();
    window.top.art.dialog({title:'编辑抽奖活动--'+title, id:'edit', iframe:'?m=activity&c=activity&a=edit&formid='+id ,width:'700px',height:'500px'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
    var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
  }
</script>
</body>
</html>