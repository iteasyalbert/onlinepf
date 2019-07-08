
 <div class="col-md-12"> 
<?php //echo $this->element('admin_submenu');?>
<?php echo $this->element('admin_search_inputs');?>	
	
</div>	
<div class="col-md-12">
	<a href="/admin/users/administrator_add/" class="btn btn-primary">Add Administrator</a>
</div>
 <div class="table-responsive col-md-12"> 
	<h2><?php echo __('Administrators');?></h2>
	<table class="table table-hover">
		<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('username');?></th>
				<!--<th><?php echo $this->Paginator->sort('firstname');?></th>
				<th><?php echo $this->Paginator->sort('lastname');?></th>-->
				<th><?php echo $this->Paginator->sort('entry_datetime');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		foreach ($userAdmin as $admin): ?>
		<tr>
			<td><?php echo h($admin['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($admin['User']['username']); ?>&nbsp;</td>
			<!--<td><?php echo $admin['Person']['firstname'];?></td>
			<td><?php echo h($admin['Person']['lastname']); ?>&nbsp;</td>-->
			<td><?php echo h($admin['User']['entry_datetime']); ?>&nbsp;</td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('action' => 'view', $admin['Post']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'administrator_edit','admin'=>true, $admin['User']['id']),array('class'=>'btn btn-success')); ?>
				<?php //echo $this->Html->link(__('Reset'), array('action' => 'resetpassword','admin'=>true, $admin['User']['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('admin'=>true,'action' => 'delete', $admin['User']['id']),array('class'=>'btn btn-success'), __('Are you sure you want to delete password # %s?', $admin['User']['id'])); ?>
				<?php //echo $this->Html->link(__('Delete'), array('admin'=>true,'action' => 'delete', $admin['User']['id']), null, __('Are you sure you want to delete # %s?', $admin['User']['id'])); ?>
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

