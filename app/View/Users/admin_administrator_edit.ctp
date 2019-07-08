<?php //echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>
<?php foreach ($users as $value){?>


<div class="container">
		<?php echo $this->Form->create('User',array('class' => 'test-frm','enctype' => 'multipart/form-data'));?>
			<h1>Update User</h1>
			<div class="form-group">
				<label for="username">Username:</label>
				<?php echo $this->Form->input('User.username',array('label' => false,'id'=>'username','class'=>"form-control",'div' => false,'type' => 'text', 'value'=>$value['User']['username']));?>
				<?php echo $this->Form->hidden('Person.id',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['id']));?>
				<?php echo $this->Form->hidden('User.id',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['User']['id']));?>
				<?php echo $this->Form->hidden('User.role',array('label' => false,'div' => false,'type' => 'text', 'value'=>$value['User']['role']));?>
			</div>
			<div class="form-group">
				<label for="OldPW">Old Password:</label>
				<?php echo $this->Form->input('User.password',array('id'=>'OldPW','class'=>"form-control",'readonly'=>'readonly','label' => false,'div' => false,'type' => 'password', 'value'=>$value['User']['password']));?>
			</div>
			<div class="form-group">
				<label for="NewPW">New Password:</label>
				<?php echo $this->Form->input('User.new_password',array('id'=>'NewPW','class'=>"form-control",'required'=>'required','label' => false,'div' => false,'type' => 'password'));?>
			</div>
			<div class="form-group">
				<label for="ConfirmPW">Confirm Password:</label>
				<?php echo $this->Form->input('User.confirm_password',array('id'=>'ConfirmPW','class'=>"form-control",'required'=>'required','label' => false,'div' => false,'type' => 'password' ));?>
			</div>
		<!--	<div class="form-group">
				<label for="First Name">First Name:</label>
				<?php echo $this->Form->input('Person.firstname',array('id'=>'First Name','class'=>"form-control",'label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['firstname']));?>
			</div>
			<div class="form-group">
				<label for="Middle Name">Middle Name:</label>
				<?php echo $this->Form->input('Person.middlename',array('id'=>'Middle Name','class'=>"form-control",'label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['middlename']));?>
			</div>
			<div class="form-group">
				<label for="Last Name">Last Name:</label>
				<?php echo $this->Form->input('Person.lastname',array('id'=>'Last Name','class'=>"form-control",'label' => false,'div' => false,'type' => 'text', 'value'=>$value['Person']['lastname']));?>
			</div>-->
					<!-- <tr>
						<td style="vertical-align: top;">
							<b>Enabled:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.enabled',array('label' => false,'div' => false,'type' => 'checkbox'));?>
						</td>
					</tr> -->
			<?php echo $this->Form->submit('Submit',array('class="btn btn-default"'));?>
			<?php echo $this->Form->end();?>
</div>
<?php }?>

