<?php //echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>



<div class="container">
		<?php echo $this->Form->create('User',array('class' => 'test-frm','enctype' => 'multipart/form-data'));?>
			<h1>Add Administrator</h1>
			<div class="form-group">
				<label for="username">Username:</label>
				<?php echo $this->Form->input('User.username',array('label' => false,'id'=>'username','class'=>"form-control",'div' => false,'type' => 'text'));?>
			</div>
			<div class="form-group">
				<label for="Password">Password:</label>
				<?php echo $this->Form->input('User.password',array('id'=>'Password','class'=>"form-control",'required'=>'required','label' => false,'div' => false,'type' => 'password'));?>
			</div>
			<div class="form-group">
				<label for="ConfirmPW">Confirm Password:</label>
				<?php echo $this->Form->input('User.confirm_password',array('id'=>'ConfirmPW','class'=>"form-control",'required'=>'required','label' => false,'div' => false,'type' => 'password' ));?>
			</div>
			<!--<div class="form-group">
				<label for="First Name">First Name:</label>
				<?php echo $this->Form->input('Person.firstname',array('id'=>'First Name','required'=>'required','class'=>"form-control",'label' => false,'div' => false,'type' => 'text'));?>
			</div>
			<div class="form-group">
				<label for="Middle Name">Middle Name:</label>
				<?php echo $this->Form->input('Person.middlename',array('id'=>'Middle Name','class'=>"form-control",'label' => false,'div' => false,'type' => 'text'));?>
			</div>
			<div class="form-group">
				<label for="Last Name">Last Name:</label>
				<?php echo $this->Form->input('Person.lastname',array('id'=>'Last Name','required'=>'required','class'=>"form-control",'label' => false,'div' => false,'type' => 'text'));?>
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

