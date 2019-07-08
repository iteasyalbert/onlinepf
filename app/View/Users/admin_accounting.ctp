<?php echo $this->Html->script('admin/admin_templating_index.js')?>
<?php echo $this->element('admin_page_formater');?>
<div class="users index">
	<h2><?php echo __('Services');?></h2>
	<table cellpadding="0" cellspacing="0">
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
			<?php echo $this->Html->link(__('Edit'), array('action' => 'accounting_edit', $admin['User']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $admin['User']['id']), null, __('Are you sure you want to delete # %s?', $admin['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Tag'), array('action' => 'accounting_add')); ?></li>
	</ul>
</div>
