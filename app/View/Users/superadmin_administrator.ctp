<?php //echo $this->Html->script('admin/admin_templating_index.js')?>
<?php //echo $this->element('admin_page_formater');?>
<div>
<div id="top-menu" style="height:35px;padding-left:15px;">
	<table id="common-tbl2" style="width: 40%;" >
		<tr>
			<th cospan="3">
				<a href="/superadmin/users/administrator_add/">Add Administrator</a>
			</th>
		</tr>
	</table>
		
</div>	
	<div id="view">
		<h2><?php echo __('Administrators');?></h2>
		<table id="common-tbl" class="visits_tbl" cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('username');?></th>
				<th><?php echo $this->Paginator->sort('firstname');?></th>
				<th><?php echo $this->Paginator->sort('lastname');?></th>
				<th><?php echo $this->Paginator->sort('entry_datetime');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		foreach ($userAdmin as $admin): ?>
		<tr>
			<td><?php echo h($admin['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($admin['User']['username']); ?>&nbsp;</td>
			<td><?php echo $admin['Person']['firstname'];?></td>
			<td><?php echo h($admin['Person']['lastname']); ?>&nbsp;</td>
			<td><?php echo h($admin['Person']['entry_datetime']); ?>&nbsp;</td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('action' => 'view', $admin['Post']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'administrator_edit','superadmin'=>true, $admin['User']['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('superadmin'=>true,'action' => 'deleteadmin', $admin['User']['id']), null, __('Are you sure you want to delete # %s?', $admin['User']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<div id="paginatordiv" style="text-align: center;">
			<?php 
				
				// Shows the next and previous links
				echo $this->Paginator->prev(
				  '<< Previous'
// 				  null,
// 				  null,
// 				  array('class' => 'disabled')
				);
				echo '&nbsp;';
				// Shows the page numbers
				echo $this->Paginator->numbers();
				echo '&nbsp;';
				echo $this->Paginator->next(
				  'Next >>'
// 				  null,
// 				  null,
// 				  array('class' => 'disabled')
				);
				echo '<br>';
				// prints X of Y, where X is current page and Y is number of pages
				echo $this->Paginator->counter(array(
				    'format' => 'Page {:page} of {:pages}, showing {:current} records out of
				             {:count} total, starting on record {:start}, ending on {:end}'
				));		
			?>
		</div>
 </div>
</div>

<style>
#top-menu table a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
	color: #fff;display: block;position: relative;width:50%;height:20px;margin:0 0 5px 0;line-height:31px;padding:3px 0 0 10px;text-decoration: none;
	font: 14px Verdana, Arial, Helvetica, sans-serif;
}

#view table#common-tbl tr td a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
	color: #fff;display: block;position: relative;width:35%;height:20px;margin:0 5px 5px 0;line-height:31px;padding:3px 0 0 10px;text-decoration: none;
	font: 14px Verdana, Arial, Helvetica, sans-serif;
	float:left;
}
div#view{
	padding-left: 15px;
	padding-right: 15px;
}
div#view h1{
	font: bold 14px Verdana, Arial, Helvetica, sans-serif !important;
}
table.visits_tbl td{
	font: 11px Verdana, Arial, Helvetica, sans-serif !important;
}
table.visits_tbl th{
	font: bold 11px Verdana, Arial, Helvetica, sans-serif !important;
}
div#paginatordiv{
	margin-top:10px;
	font: bold 11px Verdana, Arial, Helvetica, sans-serif !important;
}
</style>
<script>
	jQuery(document).ready(function(){
		count = jQuery('ul.menu > li').length;
		//jQuery('ul.menu li').css('width',(100 / count) +"%");
	});
</script>
