<div id="top-menu" style="height:35px;padding-left:15px;">
	<table id="common-tbl2" style="width: 40%;" >
	<?php echo $this->Form->create('Patient',array('/admin/patients/audit_trail'))?>
		<tr>
			<td>
				<b>Filter</b>
			</td>
			<td>
				<?php //echo $this->Form->input('patient_id',array($mrnsetting,'placeholder'=>'Patient Id','value'=>$patient_id,'label' => false, 'div' => false, 'type' => 'text', 'class' => 'patient_id'));?>
			</td>
			<td>
				<?php echo $this->Form->input('start_date',array($datesetting,'placeholder'=>'Start Date','value'=>$startdate,'label' => false, 'div' => false, 'type' => 'text', 'class' => 'datepicker'));?>
			</td>
			<td>
				<?php echo $this->Form->input('end_date',array($datesetting,'placeholder'=>'End Date','value'=>$enddate,'label' => false, 'div' => false, 'type' => 'text', 'class' => 'datepicker'));?>
			</td>
			<td>
				<?php //echo $this->Form->input('specimen_id',array($specimensetting,'placeholder'=>'Specimen Id','value'=>$specimenid,'label' => false, 'div' => false, 'type' => 'text', 'class' => 'specimen_id'));?>
			</td>
			<td>
				<?php echo $this->Form->end('Submit');?>
			</td>
		</tr>
	</table>
		
</div>
<style>
#top-menu table a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
	color: #fff;display: block;position: relative;width:100px;height:20px;margin:0 0 5px 0;line-height:31px;padding:3px 0 0 10px;text-decoration: none;
	font: 14px Verdana, Arial, Helvetica, sans-serif;
}
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