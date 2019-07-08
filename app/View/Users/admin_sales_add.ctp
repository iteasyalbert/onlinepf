<?php echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>
<div class="users form">
	
	<fieldset>
		<legend><?php echo __('Admin Add Users'); ?></legend>
		<?php echo $this->Form->create('User',array('controller'=>'User', 'action'=>'sales_add', 'admin'=>true));?>

			<table id="single-td-tbl">
				<tbody>
					<tr>
						<td style="vertical-align: top;">
							<b>Username / Email Add:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.username',array('label' => false,'div' => false,'type' => 'text'));?>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">
							<b>Password:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.password',array('label' => false,'div' => false,'type' => 'password', 'style'=>'height: 15px; margin: 1px; padding: 5px; width: 300px;'));?>
						</td>
					</tr>

					<tr>
						<td style="vertical-align: top;">
							<b>Confirm Password:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.confirm_password',array('label' => false,'div' => false,'type' => 'password', 'style'=>'height: 15px; margin: 1px; padding: 5px; width: 300px;'));?>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">
							<b>First Name:</b>
						</td>
						<td>
							<?php echo $this->Form->input('Person.firstname',array('label' => false,'div' => false,'type' => 'text'));?>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">
							<b>Middle Name:</b>
						</td>
						<td>
							<?php echo $this->Form->input('Person.middlename',array('label' => false,'div' => false,'type' => 'text'));?>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">
							<b>Last Name:</b>
						</td>
						<td>
							<?php echo $this->Form->input('Person.lastname',array('label' => false,'div' => false,'type' => 'text'));?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php echo $this->Form->submit('Submit',array('class="lab-trans-btn button small green"'));?>
			<?php echo $this->Form->end();?>
<!--		<a id="save-all-btn" style="color:#fff;float:none;clear:both;margin-bottom:20px; cursor: pointer;" class="lab-trans-btn button small green">Submit</a><br />-->
		<br/><br/><br/><br/>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Tag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('action' => 'sales'));?></li>
	</ul>
</div>
