<?php
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1; 
include $this->admin_tpl('header', 'admin');
?>
<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">抽奖活动--<?php if ($formid) echo $r['title']; else echo L('public')?> 中奖名单</h2>
</div>
<div class="pad-lr-10">
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr>
					<th width='100' align="center">姓名</th>
					<th width='100' align="center">电话</th>
					<th width="400" align="center">奖项</th>
					<th width="100" align="center">中奖时间</th>
				</tr>
			</thead>
			<tbody class="td-line">
				<?php
        if(is_array($data)){
          foreach($data as $form){
        ?>
				<tr>
          <td><?php echo $form['name']?></td>
          <td><?php echo $form['phone']?></td>
          <td><?php echo $form['title']?> <?php echo $form['prize']?></td>
          <td><?php echo $form['create_time']?></td>
				</tr>
				<?php 
         }
          }
        ?>
			</tbody>
		</table>
	</div>
	<div id="pages"><?php echo $this->db->pages;?></div>
</div>