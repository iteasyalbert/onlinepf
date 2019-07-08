<div style="width: auto;">
	<div>
	<?php //echo $this->element('admin_submenu');?>
	<?php echo $this->element('superadmin_filter_inputs');?>	
		
	</div>
	<div id="view" style="overflow-x: auto; ">
		<h1>Audit Logs</h1>
	</div>
	<div id="view" style="overflow-x: auto; ">
			<table id="common-tbl" class="visits_tbl" style="width:1200px;">
				<thead>
					<th><?php echo $this->Paginator->sort('datetime', 'Date/Time'); ?></th>
					<th><?php echo $this->Paginator->sort('remarks', 'Username'); ?></th>
					<th><?php echo $this->Paginator->sort('Person.lastname', 'Patient'); ?></th>
					<th><?php echo $this->Paginator->sort('action', 'Action'); ?></th>
					<th><?php echo $this->Paginator->sort('remarks', 'Tests'); ?></th>
					<th><?php echo $this->Paginator->sort('remarks', 'Episode Number'); ?></th>
					<th><?php echo $this->Paginator->sort('ip_address', 'IP Address'); ?></th>
					<th><?php echo $this->Paginator->sort('device', 'Device'); ?></th>
					<th><?php echo $this->Paginator->sort('browser', 'Browser'); ?></th>
					
				</thead>
				<tbody>
				<?php foreach ($auditlogs as $auditlog):?>
					<?php 
						$action=array(
								'user.login'=>'login',
								'patient.change_password'=>'change_password',
								'patient.view_order'=>'view_results',
								'user.logout'=>'logout',
								'physician.view_patient_order'=>'view_patient_results',
								'physician.load_patient'=>'load_patient',
						);
						$tests="";
						$username="";
						$specimen_id="";
						$patient_mrn="";
						$person = (isset($auditlog['Person']['lastname']))?$auditlog['Person']['lastname'].','.$auditlog['Person']['firstname'].' '.$auditlog['Person']['middlename']:"";
						$isdoctor=false;
						$doctor="";
						if(!empty($auditlog['AuditLog']['remarks'])){
							foreach (json_decode($auditlog['AuditLog']['remarks']) as $key=>$remark){
								if($key=='episode_number'){
									//echo $key.":";
									if(is_array($remark)){
										foreach ($remark as $data){
											$specimen_id.=trim(preg_replace('/\s+/', '', $data))."<br/>";
										}
									}else{
										$specimen_id=trim(preg_replace('/\s+/', '', $remark))."<br/>";
									}
								}elseif($key=='patient_mrn'){
									//echo $key.":";
									if(is_array($remark)){
										foreach ($remark as $data){
											$patient_mrn.=trim(preg_replace('/\s+/', '', $data))."<br/>";
										}
									}else{
										$patient_mrn=trim(preg_replace('/\s+/', '', str_replace("-", "", $remark)))."<br/>";
									}
								}elseif($key=='tests'){
									$tests=trim(preg_replace('/\s+/', '', str_replace(",", "<br/>", $remark)))."<br/>";
								}elseif($key=='username'  && !$isdoctor){
									$username=trim(preg_replace('/\s+/', '', str_replace("-", "", $remark)))."<br/>";
								}elseif($key=='doctor_id'){
									$isdoctor=true;
								}elseif($key=='username' && $isdoctor){
									$doctor=trim(preg_replace('/\s+/', '', str_replace("-", "", $remark)))."<br/>";
								}else{
									//trim(preg_replace('/\s+/', '', $remark))."<br/>";
								}			
							}
						}?>
					<tr>
						<td><?php echo $auditlog['AuditLog']['datetime'];?></td>
						<td><?php echo !empty($username)?$username:$patient_mrn;?></td>
						<td><?php echo $person;?></td>
						<td><?php echo $action[$auditlog['AuditLog']['action']];?></td>
						<td><?php echo $tests;?></td>
						<td><?php echo $specimen_id;?></td>
						<td><?php echo $auditlog['AuditLog']['ip_address'];?></td>
						<td><?php echo $auditlog['AuditLog']['device'].'('.$auditlog['AuditLog']['device_os'].')';?></td>
						<td><?php echo $auditlog['AuditLog']['browser'];?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
	</div>
	
	<div id="paginatordiv" style="text-align: center;">
			<?php 
				
				// Shows the next and previous links
				echo $this->Paginator->prev(
				  '<< Previous'
// 				  null,
// 				  null,
// 				  array('class' => 'disabled')
				);
				echo '&nbsp;';
				// Shows the page numbers
				echo $this->Paginator->numbers();
				echo '&nbsp;';
				echo $this->Paginator->next(
				  'Next >>'
// 				  null,
// 				  null,
// 				  array('class' => 'disabled')
				);
				echo '<br>';
				// prints X of Y, where X is current page and Y is number of pages
				echo $this->Paginator->counter(array(
				    'format' => 'Page {:page} of {:pages}, showing {:current} records out of
				             {:count} total, starting on record {:start}, ending on {:end}'
				));		
			?>
		</div>
	
</div>
<style>
table#common-tbl td a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
color: #fff;display: block;position: relative;width:50px;height:17px;margin:0 0 0px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
font: bold 14px 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
div#view table.visits_tbl td{
	width: 0px;
    height: 100%;
    text-align: justify;
    padding: 3px 5px;
}
</style>