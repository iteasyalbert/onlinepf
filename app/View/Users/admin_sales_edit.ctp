<?php echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>
<?php foreach ($users as $value){?>
<div class="users form">
	<fieldset>
		<legend><?php echo __('Admin Edit Users'); ?></legend>
				<?php echo $this->Form->create('User',array('controller'=>'User', 'action'=>'sales_edit', 'admin'=>true));?>

			<table id="single-td-tbl" >
				<tbody>
					<tr>
						<td>
							<b>Username / Email Add:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.username',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['User']['username']));?>
							<?php echo $this->Form->hidden('Person.id',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['id']));?>
							<?php echo $this->Form->hidden('User.id',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['User']['id']));?>
							<?php echo $this->Form->hidden('User.role',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['User']['role']));?>
						</td>
					</tr>
					<tr>
						<td>
							<b>Old Password:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.password',array('readonly'=>'readonly','label' => false,'div' => false,'type' => 'password', 'value'=>$value['User']['password'], 'style'=>'height: 15px; margin: 1px; padding: 5px; width: 300px;'));?>
						</td>
					</tr>
					<tr>
						<td>
							<b>New Password:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.new_password',array('label' => false,'div' => false,'type' => 'password', 'style'=>'height: 15px; margin: 1px; padding: 5px; width: 300px;'));?>
						</td>
					</tr>

					<tr>
						<td>
							<b>Confirm Password:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.confirm_password',array('label' => false,'div' => false,'type' => 'password', 'style'=>'height: 15px; margin: 1px; padding: 5px; width: 300px;'));?>
						</td>
					</tr>
					<tr>
						<td>
							<b>First Name:</b>
						</td>
						<td>
							<?php echo $this->Form->input('Person.firstname',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['firstname']));?>
						</td>
					</tr>
					<tr>
						<td>
							<b>Middle Name:</b>
						</td>
						<td>
							<?php echo $this->Form->input('Person.middlename',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['middlename']));?>
						</td>
					</tr>
					<tr>
						<td>
							<b>Last Name:</b>
						</td>
						<td>
							<?php echo $this->Form->input('Person.lastname',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['lastname']));?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php echo $this->Form->submit('Submit',array('class="lab-trans-btn button small green"'));?>
			<?php echo $this->Form->end();?>
		<br/><br/><br/><br/>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $value['User']['id']), null, __('Are you sure you want to delete # %s?', $value['User']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('action' => 'sales'));?></li>
	</ul>
</div>
<?php }?>