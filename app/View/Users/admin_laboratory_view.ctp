<?php echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>
<?php foreach ($users as $value){?>

<div class="users form">
	<fieldset>
		<legend><?php echo __('Admin View Users'); ?></legend>
		<?php echo $this->Form->create('User',array('class' => 'test-frm','enctype' => 'multipart/form-data'));?>

			<table id="single-td-tbl" >
				<tbody>
					<tr>
						<td><b>Myresultonline ID:</b></td>
						<?php echo $this->Form->input('User.id',array('label' => false,'div' => false,'type' => 'hidden', 'value'=>$value['User']['id'],'readonly'=>'readonly'));?>
						<td><?php echo $this->Form->input('User.username',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['User']['username'],'readonly'=>'readonly'));?></td>
					</tr>
					<tr>
						<td><b>First Name:</b></td>
						<td><?php echo $this->Form->input('Person.firstname',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['firstname'],'readonly'=>'readonly'));?></td>
					</tr>
					<tr>
						<td><b>Middle Name:</b></td>
						<td><?php echo $this->Form->input('Person.middlename',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['middlename'],'readonly'=>'readonly'));?></td>
					</tr>
					<tr>
						<td><b>Last Name:</b></td>
						<td><?php echo $this->Form->input('Person.lastname',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['lastname'],'readonly'=>'readonly'));?></td>
					</tr>
					<tr>
						<td><b>Action:</b></td>
						<td>
							<?php echo $this->Form->radio('status',array('1'=>'Activate','6'=>'Deactivate'),array('legend'=>false, 'value'=>$value['User']['status']))?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php echo $this->Form->submit('Submit',array('class="lab-trans-btn button small brown"'));?>
			<?php echo $this->Form->end();?>
		<br/><br/><br/><br/>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List'), array('action' => 'laboratory'));?></li>
	</ul>
</div>
<?php }?>