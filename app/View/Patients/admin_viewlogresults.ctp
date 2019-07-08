<div>
	<div>
	<?php echo $this->element('admin_submenu');?>
	<?php echo $this->element('admin_filter_inputs');?>	
		
	</div>
	<div id="view">
		<h1>View Results</h1>
		<table id="common-tbl" class="visits_tbl" >
			<thead>
				<th style="width:15%;"><?php echo $this->Paginator->sort('datetime', 'Date and Time'); ?></th>
				<!-- <th style="width:15%;"><?php echo $this->Paginator->sort('module', 'Module'); ?></th>
				<th style="width:20%;"><?php echo $this->Paginator->sort('url', 'Action Url'); ?></th> -->
				<th style="width:17%;"><?php echo $this->Paginator->sort('remarks', 'Episode Number'); ?></th>
				<th style="width:39%;"><?php echo $this->Paginator->sort('remarks', 'Tests'); ?></th>
				<th style="width:10%;"><?php echo $this->Paginator->sort('device', 'Device'); ?></th>
				<th style="width:12%;"><?php echo $this->Paginator->sort('browser', 'Browser'); ?></th>
				
			</thead>
			<tbody>
			<?php foreach ($auditlogsresults as $auditlog):?>
				<tr>
					<td><?php echo $auditlog['AuditLog']['datetime'];?></td>
					<!-- <td><?php echo $auditlog['AuditLog']['module'];?></td>
					<td><?php echo $auditlog['AuditLog']['url'];?></td> -->
					<td>
					<?php 
					$tests="";
					foreach (json_decode($auditlog['AuditLog']['remarks']) as $key=>$remark){
						if($key=='specimen_id'){
							//echo $key.":";
							if(is_array($remark)){
								foreach ($remark as $data){
									echo trim(preg_replace('/\s+/', '', $data))."<br/>";
								}
							}else{
								echo trim(preg_replace('/\s+/', '', $remark))."<br/>";
							}
						}elseif($key='tests'){
							$tests=trim(preg_replace('/\s+/', '', $remark))."<br/>";
						}else{
							echo trim(preg_replace('/\s+/', '', $remark))."<br/>";
						}			
					}?>
					
					</td>
					<td><?php echo $tests;?></td>
					<td><?php echo $auditlog['AuditLog']['device'].'('.$auditlog['AuditLog']['device_os'].')';?></td>
					<td><?php echo $auditlog['AuditLog']['browser'];?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
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
	
</div>
<style>
table#common-tbl td a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
color: #fff;display: block;position: relative;width:50px;height:17px;margin:0 0 0px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
font: bold 14px 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
</style>