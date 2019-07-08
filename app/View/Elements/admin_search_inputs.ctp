<div id="top-menu" style="height:35px;padding-left:15px;float:right;">
	<table id="common-tbl2" style="width: 40%; " >
	<?php echo $this->Form->create('Patient',array('/admin/patients/search'))?>
		<tr>
			<td>
				<b>Search</b>
			</td>
			<td>
				<?php echo $this->Form->input('name',array('placeholder'=>'Search Name','value'=>"",'label' => false, 'div' => false, 'type' => 'text', 'class' => 'patient_id'));?>
			</td>
			<td>
				<?php echo $this->Form->input('username',array('placeholder'=>'PatientId or Username','value'=>"",'label' => false, 'div' => false, 'type' => 'text', 'class' => 'patient_id'));?>
			</td>
			<td>
				<?php echo $this->Form->end('Submit');?>
			</td>
		</tr>
	</table>
		
</div>
<style>
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
#top-menu table b{
	font: bold 13px Verdana, Arial, Helvetica, sans-serif !important;
}
div#paginatordiv{
	margin-top:10px;
	font: bold 11px Verdana, Arial, Helvetica, sans-serif !important;
}
</style>
<script>
	jQuery(document).ready(function(){
		count = jQuery('ul.menu > li').length;
		//jQuery('div#top-menu table tr').find('input:disabled').hide();
		//jQuery('ul.menu li').css('width',(100 / count) +"%");
	});
</script>