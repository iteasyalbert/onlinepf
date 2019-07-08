<?php echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>
<?php foreach ($users as $value){?>

<div class="users form">
	<fieldset>
		<legend><?php echo __('Admin Edit Users'); ?></legend>
		<?php echo $this->Form->create('User',array('class' => 'test-frm','enctype' => 'multipart/form-data'));?>
			<h1>Update User</h1>
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
					<tr>
						<td style="vertical-align: top;">
							<b>Role:</b>
						</td>
						<td>
							<?php echo $this->Form->input('User.role',array('options'=>array('0'=>'Super Administrator', '1'=>'Administrator'),'label' => false,'div' => false,'type' => 'select'));?>
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

		<li><?php echo $this->Html->link(__('Delete'), array('superadmin'=>true,'controller'=>'users','action' => 'deleteadmin', $value['User']['id']), null, __('Are you sure you want to delete # %s?', $value['User']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('action' => 'administrator','superadmin'=>true));?></li>
	</ul>
</div>
<?php }?>


<style>
#top-menu table a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
	color: #fff;display: block;position: relative;width:50%;height:20px;margin:0 0 5px 0;line-height:31px;padding:3px 0 0 10px;text-decoration: none;
	font: 14px Verdana, Arial, Helvetica, sans-serif;
}

#view table#common-tbl tr td a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
	color: #fff;display: block;position: relative;width:50%;height:20px;margin:0 0 5px 0;line-height:31px;padding:3px 0 0 10px;text-decoration: none;
	font: 14px Verdana, Arial, Helvetica, sans-serif;
}
table#single-td-tbl tr td{
	background: white;
    border: 0px solid;
    padding: 0px;
}
table#single-td-tbl tr td input[type=password]{
    width: 270px !important;
	border: 1px solid #CCC;
    padding: 4px;
    border-radius: 5px;
    color: #333;
}
div#view{
	padding-left: 15px;
	padding-right: 15px;
}

.content {
    width: 98% !important;
    margin-right: 20px;
    float: left;
	margin-left:10px;
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
