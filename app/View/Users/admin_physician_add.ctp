<?php //echo $this->Html->script('admin/admin_templating_content.js')?>
<?php echo $this->element('admin_page_formater');?>
<div class="users form">
	
	<fieldset>
		<!-- <legend><?php echo __('Admin Add Users'); ?></legend> -->
		<?php echo $this->Form->create('User');?>
			<h1>Add New User</h1>
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
					<tr>
						<td style="vertical-align: top;">
							<b>Internal Id (WebLIS):</b>
						</td>
						<td>
							<?php echo $this->Form->input('Physician.internal_id',array('label' => false,'div' => false,'type' => 'text'));?>
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
		<li><?php echo $this->Html->link(__('List Tags'), array('action' => 'resultviewer'));?></li>
	</ul>
</div>

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
