<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=PH"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->Html->script('gmapplot.js');?>
<?php echo $this->element('graph_scripts');?>
<script>
	var uploadType = 0;
	var $uploadImageButton;
	var graphs = {};
</script>
<style type="text/css">
    #ui-datepicker-div
    {
        z-index: 9999999;
    }
</style>
<link rel="stylesheet" type="text/css" href="/css/general.css">
<div class="content">

		<div id="main-tab" class="widget-result">
		
            <ul class="tabnav">
                <li><a href="#patient">MY PATIENT</a></li>
                <li><a href="#result">MY RESULT</a></li>
                <li><a href="#report">MY REPORT</a></li>
                <li><a href="#profile">MY PROFILE</a></li>
            </ul>
            <div id="patient" class="tabdiv">
				<div id="patient-div">
					<h2 style="margin-bottom:0px;">PATIENT'S RESULTS</h2>
					<?php echo $this->Form->create('Patient',array('class'=>'search-patient-frm'));?>
					<?php echo $this->Form->input('myresultonline_id',array('label'=>false,'type'=>'text','div'=>false,'value'=>'myResultOnlineID','class'=>'labeled','title'=>'myResultOnlineID', 'style'=>'height: 24px;'));?>
					<?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false,'value'=>'Lastname','class'=>'labeled','title'=>'Lastname', 'style'=>'height: 24px;'));?>
					<?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false,'value'=>'Firstname','class'=>'labeled','title'=>'Firstname', 'style'=>'height: 24px;'));?>
					<?php echo $this->Form->input('Field.laboratory',array('label'=>false,'div'=>false,'type'=>'hidden'));?>
					<?php echo $this->Form->submit('Search Patient',array('div'=>false,'class'=>'search-patient-btn', 'style'=>'vertical-align: middle; margin: 0 0 5px;'));?>
					<?php echo $this->Form->end();?>
					<br/>
                	<table id="common-tbl" class="patient_search">
                		<thead>
                			<th>Name</th><th>Date</th><th>Laboratory</th>
                		</thead>
                		<tbody>
                		</tbody>
                	</table>
                	
                	<div id="photo" style="border:1px solid #BFB092; width:140px;height:140px;float:right;margin:10px 20px 0 0;">
						<?php echo $this->Html->image('male.jpg',array('style'=>'width:140px;height:140px;','id' =>'patient-idpic'));?>
					</div>
               		 
                	<div id="patient-profile-div">
	                	<table id="single-td-tbl">
	                	<?php echo $this->Form->create('Profile');?>
	                	<tr><td><h2>PROFILE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2></td><td></td></tr>
						<tr><td><label>ID:</label></td><td><?php echo $this->Form->input('id',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
						<tr><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?></td></tr>
						<tr><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Address:</label></td><td><?php echo $this->Form->input('complete_address',array('label'=>false,'div'=>false));?></td></tr>
						<?php echo $this->Form->end(array('type'=>'hidden'));?>
						</table>
						<div class="patient_test_results" style="display:none">
							<h2>TEST RESULTS</h2>
							<div id="main-tab" class="widget-result">
								<ul class="tabnav">
					                <li><a href="#patient-visits">VISITS</a></li>
					                <li><a href="#patient-history">HISTORY</a></li>
					            </ul>
			                	 <div id="patient-visits" class="tabdiv">
			                	 	<h4>Select Visit</h4>
			                	 	<table class="patient-visits visits_tbl" id="common-tbl">
				                		<thead>
					                		<tr>
					                			<th>Laboratory</th><th>Date</th><th>Test</th>
					                		</tr>
				                		</thead>
				                		<tbody>
				                		</tbody>
				                	</table>
				                	<div id="patient-visit-view" style="height:300px;border:1px solid #BFB092;">
	                		
	                				</div>
	                				<?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdf','style'=>'margin-left:77.5%;'));?>
	            				     <?php echo $this->Form->end();?>
			                	 </div>
			                	 
			                	 <div id="patient-history" class="tabdiv">
			                	 	<h4>Select Test Group</h4>
			                	 	<div class="test-groups">
											                	
									</div>
			                	 	<div id="patient-test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
			                			<h2 class="test-name">TEST RESULT</h2>
										<div id="history-list" style="overflow-y:auto;">
						                	<table id="common-tbl">
						                		<thead>
						                			<tr>
						                				<th>Laboratoty</th>
						                				<th>Date</th>
						                				<th></th>
						                			</tr>
						                		</thead>
						                		<tbody>
						                		</tbody>
						                	</table>
						               	</div>
						                <h2>GRAPH</h2>
						                <div id="legend" class="patient-test-history_legend">
							            
							            </div>
						                <br/><br/>
						                <div id="patient-test-history_historyGraph" style="height:300px;border:1px solid #BFB092;">
						                	
						                </div>
						                <?php echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'testHistory')));?>
						                <?php //secho $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;', 'name'=>'Save'));?>
						                <?php echo $this->Form->submit('Print',array('div'=>false, 'id'=>'printHistory','style'=>'margin-left:87%;', 'name="Print"'));?>
						                <?php echo $this->Form->end();?>
			                		</div>
			                	 </div>
		                	 </div>
	                	 </div>
                	</div>
				</div>
				
            </div><!--/patient-->
            
            <div id="result" class="tabdiv">
                <div>
                	<h2>RESULT</h2>
                	<div id="main-tab" class="widget-result">
			            <ul class="tabnav">
			                <li><a href="#physician-visits">VISITS</a></li>
			                <li><a href="#physician-history">HISTORY</a></li>
			            </ul>
			
			            <div id="physician-visits" class="tabdiv">
			            	<div id="visits-list" style="overflow-y:auto;">
				            	<h4>Select Visit</h4>
				            	<?php if(isset($testOrders) && !empty($testOrders)):?>
					                <table id="common-tbl" class="visits_tbl">
					                	<thead>
					                		<tr>
						                		<th>Date</th><th>Laboratory</th><th>Test</th>
					                		</tr>
					                	</thead>
					                	<tbody>
					                		<?php
					                		$firstTestOrder = null;
					                			$selected = 'selected';
						                		foreach($testOrders as $visit):?>
						                			<tr  id="<?php echo $selected ;?>" style="cursor:pointer;" class="testOrderDetailClass" onclick="showTestOrderDetail('<?php echo $visit['LaboratoryTestOrder']['id'];?>','visits-view')">
						                				<td><?php echo date('F d,Y H:i:s',strtotime($visit['LaboratoryTestOrder']['posted_datetime']));?></td>
						                				<td><?php echo $laboratories[$visit['LaboratoryPatientOrder']['laboratory_id']];?></td>
						                				<td>
						                					
						                					<?php
					///	                						debug($visit);
																if(is_null($firstTestOrder))
																	$firstTestOrder =  $visit['LaboratoryTestOrder']['id'];
						                							$selected = '';
						                						if(isset($testOrderPackages[$visit['LaboratoryTestOrder']['id']])){
						                							echo implode(', ',$testOrderPackages[$visit['LaboratoryTestOrder']['id']]);
						                						}
						                					?>
						                				
						                				</td>
						                			</tr>
						                		<?php endforeach;
					                		?>
					                	</tbody>
					                </table>
					               	<?php
						               	else:
						                	echo "You have no recorded visits.";
						                endif;
					               	?>
				                </div>
				                <div id="visits-view" style="height:auto;border:1px solid #BFB092;padding:5px;">
				                
				                </div>
				                <?php echo $this->element('pop_up_print_testgroup');?>
				                <?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdfResult','style'=>'margin-left:77.5%;'));?>
				                <?php echo $this->Form->end();?>
			            </div><!--/visits-->
			            
			            <div id="physician-history" class="tabdiv">
			                <div id="history-div">
			                	<h4>Select Test Group</h4>
			                	<?php if(!empty($testGroups)):?>
				                	<?php $group = $testGroups;?>
				                	<?php echo $this->Form->radio('group_name', $testGroups, array('legend'=>false,'label'=>false,'onclick' => 'showTestHistory(this,"test-history");'));?>
				                	<div id="test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
			                		
			                		<h2 class="test-name">TEST RESULT</h2>
									<div id="history-list" style="overflow-y:auto;">
					                	<table id="common-tbl">
					                		<thead>
					                			<tr>
					                				<th>Laboratoty</th>
					                				<th>Date</th>
					                				<th></th>
					                			</tr>
					                		</thead>
					                		<tbody>
					                		</tbody>
					                	</table>
					               	</div>
					               	<div id="printArea">
						                <h2>GRAPH</h2>
						                <div id="legend" class="test-history_legend">
							            
							            </div>
						                <br/><br/>
						                <div id="test-history_historyGraph" style="height:300px;border:1px solid #BFB092;">
						                	
						                </div>
					                </div>
					                <?php echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'testHistory')));?>
					                <?php //secho $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;', 'name'=>'Save'));?>
					                <?php echo $this->Form->submit('Print',array('div'=>false, 'id'=>'printTestHistory','style'=>'margin-left:87%;', 'name'=>'action', 'onclick'=>'return false;'));?>
					                <?php echo $this->Form->end();?>
			                		
			                		</div>
				                <?php else:?>
				            		You currently have no recorded test.
				            	<?php endif;?>
			                </div>
			            </div><!--/history-->
			
			        </div><!--/widget-->
                </div>
            </div><!--/result-->
             <div id="report" class="tabdiv">
				<div >
					<h2>REPORTS</h2>
						<div id="main-tab" class="widget-result">
							<ul class="tabnav">
				                <li><a href="#stats">Statistics</a></li>
				                <li><a href="#patient-lists">Patient's List</a></li>
				                <li><a href="#prescriptions">Prescription List</a></li>
				            </ul>
							<div id="stats" class="tabdiv">
								<h3>STATISTICS</h3>
								<?php echo $this->Form->create('Statistic',array('class'=>'patient-stat-frm'));?>
								<table id="double-td-tbl">
									<tr>
										<td><span>Start Date: </span><?php echo $this->Form->input('start_date',array('label'=>false,'div'=>false,'class'=>'datepicker'));?></td>
										<td><span>End Date: </span><?php echo $this->Form->input('end_date',array('label'=>false,'div'=>false,'class'=>'datepicker'));?></td>
									</tr>
									<tr>
										<td><span>Laboratory: </span><?php echo $this->Form->input('laboratory_id',array('label'=>false,'div'=>false,'options' => $laboratories,'empty' => true));?></td>
										<td><span>Test:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('test_group_id',array('label'=>false,'div'=>false,'options' => $testgroups,'empty' => true));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('Generate',array('class'=>'patient-stat-btn'));?></td><td></td>
									</tr>
								</table>
								<table id="common-tbl" class="patient-stat-tbl">
									<thead>
										<th>Laboratory Name</th><th>Test</th><th>No. of Prescription</th>
									</thead>
									<tbody>
									</tbody>
								</table>
								<?php //echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php //echo $this->Form->submit('Print',array('div'=>false));?>
            				     <?php echo $this->Form->end();?>
								
							</div>
							<div id="patient-lists" class="tabdiv">
								<h3>PATIENT'S LIST</h3>
								<?php echo $this->Form->create('Patient',array('class'=>'patient-list-filter'));?>
								
								<table id="double-td-tbl">
									<tr>
										<td><span>Start Date: </span><?php echo $this->Form->input('start_date',array('label'=>false,'div'=>false,'class' => 'datepicker'));?></td>
										<td><span>End Date: &nbsp;&nbsp;</span><?php echo $this->Form->input('end_date',array('label'=>false,'div'=>false,'class' => 'datepicker'));?></td>
									</tr>
									<tr>
										<td><span>Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('sex',array('label'=>false,'div'=>false,'type' => 'select','options'=> array('M' => 'Male','F' => 'Female'),'empty'=>true));?></td>
										<td><span>Age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('age',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><span>Province: &nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('province_state_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $provinces,'class' => 'address_select','title' => 'address_select_1','empty'=>true));?></td>
										<td><span>Town/City: </span><?php echo $this->Form->input('town_city_id',array('label'=>false,'div'=>false,'type' => 'select','class' => 'address_select','title' => 'address_select_2','empty'=>true));?></td>
									</tr>
									<tr>
										<td><span>Barangay:&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('Field.address',array('label'=>false,'div'=>false,'type'=>'hidden'));?><?php echo $this->Form->input('village_id',array('label'=>false,'div'=>false,'type' => 'select','class' => 'address_select','title' => 'address_select_3','empty'=>true));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('Generate',array('class'=>'patient-list-filter-btn'));?></td><td></td>
									</tr>
								</table>
								<?php echo $this->Form->end();?>
								<table id="common-tbl" class="patient-list-tbl">
									<thead>
										<th>Name</th><th>Date of Register</th><th>Province</th><th>Town/City</th><th>Gender</th><th>Birthday</th><th>Age</th>
									</thead>
									<tbody>
									</tbody>
								</table>
								<?php //echo $this->Form->submit('Export',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php //echo $this->Form->submit('Print',array('div'=>false));?>
            				     
							</div>
							<div id="prescriptions" class="tabdiv">
							<h3>PRESCRIPTION'S LIST</h3>
								<?php echo $this->Form->create('Prescription',array('class'=>'patient-pres-filter'));?>
								<table id="double-td-tbl">
									<tr>
										<td><span>Start Date: </span><?php echo $this->Form->input('start_date',array('label'=>false,'div'=>false));?></td>
										<td><span>End Date: </span><?php echo $this->Form->input('end_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('Generate',array('class'=>'patient-pres-filter-btn'));?></td><td></td>
									</tr>
								</table>
								<table id="common-tbl" class="patient-pres-tbl">
									<thead>
										<th>Name</th><th>Laboratory</th><th>Date</th><th>Test</th>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<?php //echo $this->Form->submit('Export',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php //echo $this->Form->submit('Print',array('div'=>false));?>
            				     <?php echo $this->Form->end();?>
							</div>
						</div>
				</div>
            </div><!--/report-->
            <div id="profile" class="tabdiv">
					<h2>PROFILE</h2>
					<div id="main-tab" class="widget-result">
						<ul class="tabnav">
			                <li><a href="#personal">PERSONAL</a></li>
			                <li><a href="#profession">PROFESSION</a></li>
			                <li><a href="#clinic">CLINIC</a></li>
			                <li><a href="#hmo">HMO</a></li>
			                <li><a href="#organization">ORGANIZATION</a></li>
			                <li><a href="#membership">MEMBERSHIP</a></li>
			            </ul>
						<div id="personal" class="tabdiv">
							<?php echo $this->Form->create('Person',array('class'=>'patient_form','enctype' => 'multipart/form-data'));?>
							<?php echo $this->Form->input('id',array('label'=>false,'div'=>false,'type' =>'hidden'));?>
							<?php echo $this->Form->input('image',array('type' => 'hidden','label'=>false,'div'=>false));?>
							<?php echo $this->Form->input('new_image',array('type' => 'hidden','label'=>false,'div'=>false,'class' =>'webcam-input'));?>
						
							<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 20px 0 0;">
								<?php echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
								<p class="actions" align="center" style="width:100%;min-width:100%;">
									<a href="#" id="take-photo" > Take a Photo</a>
									<script>
										var filelocation = "../../../js/jscam.swf";
									</script>
									<?php echo $this->element('webcamui');?>
								</p>
								<p class="actions" align="center" style="width:100%;min-width:100%;">
									<a href="#" id="open-photo" > Open image</a>
								</p>
								<?php echo $this->Form->input('upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image','style' => 'display:none;'));?>
								<!-- <div class="myfileupload-buttonbar ">
						            <label class="myui-button">
						                <span >Choose File</span>
										<?php //echo $this->Form->input('upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image'));?>
									</label>
								</div>
								-->
							</div>
							<div id="personal-div">
								<table id="single-td-tbl">
								<tr><td><label>ID:</label></td><td><?php echo $this->Form->input('myresultonline_id',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
								<tr><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?></td></tr>
								<tr><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false,'type' => 'text','class' => 'datepicker'));?></td></tr>
								<tr><td><?php echo $this->Form->submit('Save',array('div'=>false,'style'=>'','class' => 'save_profile'));?>
								</td><td></td></tr>
			            		</table>
							</div>
							<?php echo $this->Form->end();?>
						</div>
						<div id="profession" class="tabdiv">
							<div id="profession-div">
								<table id="single-td-tbl">
								<tr><td><label>PRC No.:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
								<tr><td><label>Date of Issue:</label></td><td><?php echo $this->Form->input('date_issue',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>Specialty:</label></td><td><?php echo $this->Form->input('specialty',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>Subspecialty:</label></td><td><?php echo $this->Form->input('sub_specialty',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>Key Competencies & Skill:</label></td><td><?php echo $this->Form->textarea('key',array('label'=>false,'div'=>false));?></td></tr>
								<tr><td><label>About my Practice:</label></td><td><?php echo $this->Form->textarea('practice',array('label'=>false,'div'=>false));?></td></tr>
			
								<tr><td><?php echo $this->Form->submit('EDIT PROFILE');?></td><td></td></tr>
			            		</table>
							</div>
						</div>
						<div id=clinic class="tabdiv">
							<div id="clinic-div">
								<table id="common-tbl" class="clinic-list-tbl">
									<thead>
										<tr>
											<th>Clinic</th><th>Schedule</th><th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($branches) && !empty($branches)):?>
										
											<?php foreach($branches as $branch):?>
												<tr onclick="showClinic(<?php echo $branch['CompanyBranch']['id'];?>,<?php echo $branch['Laboratory']['type'];?>)" id="<?php echo $branch['CompanyBranch']['id'];?>">
													<td><?php echo $branch['CompanyBranch']['branch'];?></td>
													<td>
														<?php
															if(isset($memberDuties[$branch['CompanyBranchMember']['id']])):
																$duties = array();
																foreach($memberDuties[$branch['CompanyBranchMember']['id']] as $duty):
																	$duties[] = substr($days[$duty['day']],0,3).' '.date ('H:i',strtotime($duty['start_time'])).'-'.date ('H:i',strtotime($duty['end_time']));
																endforeach;
																echo implode(', ',$duties);
															endif;
														?>
													</td>
													<td>
														<a onclick="removeClinic(<?php echo $branch['CompanyBranch']['id'];?>,<?php echo $branch['Laboratory']['type'];?>);">Remove</a>
													</td>
												</tr>
											<?php endforeach;?>
										<?php else:?>
											<tr class="empty-tr">
												<td colspan="3">
													No clinic Found.
												</td>
											</tr>
										<?php endif;?>
									</tbody>
								</table>
								
								<?php echo $this->Form->create('CompanyBranch',array('class' => 'clinic-frm','enctype' => 'multipart/form-data'));?>
								<div class="dim-box" >
									
									<table class="detail-tbl clinic-type-select" id="double-td-tbl" style="display:none;">
										<tbody >
											<tr>
												<td colspan="3" ><?php echo $this->Form->radio('type',array(1=>'Hospital/Laboratory',2=>'Own Clinic'),array('label'=>false,'div'=>false,'legend'=>false,'class' => 'clinic-type-radio','default' => 1));?></td>
											</tr>
										</tbody>
									</table>
									<hr style="background-color: #BFB092;margin:5px 0px;"/>
									<h3>Clinic Details</h3>
									
									<?php echo $this->Form->input('Company.update',array('label'=>false, 'type'=>'hidden','div'=>false,'value' => 0));?>
									<?php echo $this->Form->input('Company.logo',array('label'=>false, 'type'=>'hidden','div'=>false));?>
									<?php //echo $this->Form->input('Company.upload', array('type' => 'file','div' => false,'label' => false,'class' => 'clinic-logo-fld', 'style' => 'display:none;'));?>
									
									<?php echo $this->Form->input('Company.upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_logo','style' => 'display:none;'));?>
				
									<div style="display:inline-block; width: 46%;">
										<table class="detail-tbl" id="single-td-tbl-half" style="margin:0px;">
											<tbody>
												<tr>
													<td><label>Name:</label></td>
													<td>
														<?php echo $this->Form->input('Company.id',array('label'=>false, 'type'=>'hidden','div'=>false));?>
														<?php echo $this->Form->input('Company.name',array('label'=>false,'class' => 'autocomplete', 'type'=>'text','div'=>false));?>
													</td>
												</tr>
												<tr>
													<td><label>Website:</label></td><td><?php echo $this->Form->input('Company.website',array('label'=>false, 'type'=>'text','div'=>false));?></td>
												</tr>
											</tbody>
										</table>
										<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;    margin: 2px 2px 2px 61px;;">
											<img src="/img/../media/profiles/default.jpeg" id="cliniclogo" style="width:150px;height:150px;" alt="">
											<a onclick="jQuery('.browse_logo').click();//clinic-logo-fld').click();" >Change Logo</a>
										</div>
									</div>
									
									
									<table class="detail-tbl" id="single-td-tbl-half" style="display: inline-block;vertical-align: top;width:52%;">
										<tbody>
											<tr>
												<td><label>Branch Name:</label></td>
												<td><?php
													echo $this->Form->input('branch',array('label'=>false, 'type'=>'text','div'=>false));
													echo $this->Form->input('id',array('label'=>false, 'type'=>'select','div'=>false,'options' => array(),'style' => 'display:none;','class' => 'company-branch-slc'));
													?>
												</td>
											</tr>
											<tr>
												<td><label>Class:</label></td><td><?php echo $this->Form->input('Laboratory.id',array('label'=>false, 'type'=>'hidden','div'=>false));?><?php echo $this->Form->input('Laboratory.type',array('label'=>false, 'type'=>'hidden','div'=>false));?><?php echo $this->Form->input('Laboratory.class',array('label'=>false, 'type'=>'select','options' => $classifications,'div'=>false));?></td>
											</tr>
											<tr>
												<td><label>Mission:</label></td><td><?php echo $this->Form->input('CompanyBranchInfo.id',array('label'=>false, 'type'=>'hidden','div'=>false));?><?php echo $this->Form->input('CompanyBranchInfo.mission',array('label'=>false, 'type'=>'textarea','div'=>false,'style' => 'width:210px;height:40px;resize:none;padding:2px;','rows' => '3'));?></td>
											</tr>
											<tr>
												<td><label>Vision:</label></td><td><?php echo $this->Form->input('CompanyBranchInfo.vision',array('label'=>false, 'type'=>'textarea','div'=>false,'style' => 'width:210px;height:40px;resize:none;padding:2px;','rows' => '3'));?></td>
											</tr>
										</tbody>
									</table>
									
									<hr style="background-color: #BFB092;margin:5px 0px;"/>
									<table class="detail-tbl" id="single-td-tbl-half">
									
										<tr>
											<td><h3>Address</h3></td><td></td>
										</tr>
										<tr>
											<td><label>Province</label></td><td><?php echo $this->Form->input('Address.id',array('label'=>false,'div'=>false,'type' => 'hidden'));?><?php echo $this->Form->input('Address.province_state_id',array('label'=>false, 'type'=>'select','div'=>false,'options' => $provinces,'class' => 'address_select address_field','title' => 'address_select_1','empty'=>true));?></td>
										</tr>
										<tr>
											<td><label>Town/City</label></td><td><?php echo $this->Form->input('Address.town_city_id',array('label'=>false,'div'=>false,'type'=>'select','class' => 'address_select address_field','title' => 'address_select_2','empty'=>true));?></td>
										</tr>
										<tr>
											<td><label>Barangay:</label></td><td><?php echo $this->Form->input('Address.village_id',array('label'=>false,'div'=>false,'type'=>'select','class' => 'address_select address_field','title' => 'address_select_3','empty'=>true));?></td>
										</tr>
										<tr>
											<td><label>Street:</label></td><td><?php echo $this->Form->input('Address.street_number',array('label'=>false,'div'=>false,'class' => 'address_field'));?></td>
										</tr>
										<tr>
											<td><label>Building:</label></td><td><?php echo $this->Form->input('Address.building_apartment',array('label'=>false,'div'=>false));?></td>
										</tr>
										<tr>
											<td><label>Floor:</label></td><td><?php echo $this->Form->input('Address.floor',array('label'=>false,'div'=>false));?></td>
										</tr>
										<tr>
											<td><label>Unit:</label></td><td><?php echo $this->Form->input('Address.unit',array('label'=>false,'div'=>false));?></td>
										</tr>
									</table>
									<div id="google-map" style="border:2px solid #3F3B31; width:280px;height:220px;margin:20px 10px 0 0;">
										<?php echo 'Google Map';?>
									</div>
									
								</div>
								<br />
								
								<?php echo $this->Form->input('CompanyBranchMember.id',array('type' => 'hidden','label' => false,'div'=>false))?>
								<table class="clinic-duty-hours detail-tbl single-td-tbl-half cms-tbl" id="single-td-tbl-half" >
									<thead>
										<tr>
											<td><h3>Clinic Hours:</h3></td><td></td>
										</tr>
										<tr><td><b>Days</b></td><td><b>Start Time</b></td><td><b>End Time</b></td><td><b>Action</b></td></tr>
									</thead>
									<tbody>
									<tr >
										<td>
											<?php echo $this->Form->input('CompanyBranchMemberDuty.0.id',array('type' => 'hidden','class' => 'cbmd_id','label' => false,'div'=>false))?>
											<?php echo $this->Form->input('CompanyBranchMemberDuty.0.status',array('type' => 'hidden','value' => 0,'class' => 'cbmd_status','label' => false,'div'=>false))?>
											<?php echo $this->Form->input('CompanyBranchMemberDuty.0.day',array('type' => 'select','options'=>$days,'class' => 'cbmd_day','label' => false,'div'=>false))?>
										</td>
										<td>
											<?php echo $this->Form->input('CompanyBranchMemberDuty.0.start_time',array('type' => 'text','class' => 'cbmd_start','label' => false,'div'=>false))?>
										</td>
										<td>
											<?php echo $this->Form->input('CompanyBranchMemberDuty.0.end_time',array('type' => 'text','class' => 'cbmd_end','label' => false,'div'=>false))?>
										</td>
										<td><a onclick="addClinicHour(this);">add</a></td>
									</tr>
									</tbody>
								</table>
								
								<a style="color:#fff;float:none;clear:both;margin-bottom:20px;" class="save_clinic button small green" onclick = "saveClinic();">Save</a>
								<a style="color:#fff;float:none;clear:both;margin-bottom:20px;" class="add_clinic button small green" onclick ="setClinicType(1);" >New Clinic</a>
								<br />
								<br />
								<?php echo $this->Form->end();?>
							</div>
						</div>
						<div id="hmo" class="tabdiv">
							<div id="hmo-div">
								<table id="common-tbl" class="hmo_list">
									<thead>
										<tr>
											<th>Insurance Provider</th><th>Insurance Product</th><th>Accreditation No.</th><th>Date of Joining</th><th>Date of Expiration</th><th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($this->data['Person']['HMO'])):?>
											<?php foreach($this->data['Person']['HMO'] as $hmo):?>
												<tr id="hmo_<?php echo $hmo['PersonInsurance']['id'];?>">
													
													<td class= "hmo_insurance_provider"><?php echo $this->Form->input('InsuranceProviderProduct.id',array('type'=> 'hidden','value' =>$hmo['InsuranceProvider']['id']));echo '<p>'.$hmo['CompanyBranch']['branch'].'</p>';?></td>
													<td class= "hmo_insurance_provider_product" ><?php echo $this->Form->input('InsuranceProvider.id',array('type'=> 'hidden','value' =>$hmo['InsuranceProviderProduct']['id']));echo '<p>'.$hmo['InsuranceProviderProduct']['name'].'</p>';?></td>
													<td class= "hmo_accreditation"><?php echo '<p>'.$hmo['PersonInsurance']['accreditation'].'</p>';?></td>
													<td class= "hmo_effectivity_date"><?php echo '<p>'.$hmo['PersonInsurance']['effectivity_date'].'</p>';?></td>
													<td class= "hmo_expiration_date"><?php echo '<p>'.$hmo['PersonInsurance']['expiration_date'].'</p>';?></td>
													<td>
														<a href="#" onclick="setHMO(this);" >Edit</a>
														<a href="#" onclick="deleteHMO(<?php echo $hmo['PersonInsurance']['id'];?>);">Delete</a>
													</td>
												</tr>
											<?php endforeach;?>
										<?php endif;?>
									</tbody>
								</table>
								<h3>DETAILS</h3>
								<?php echo $this->Form->create('PersonInsurance',array('class'=>'hmo_form'));?>
								<?php $legend = array('legend'=>false);?>
								<table id="single-td-tbl" class = "HMO_fields" >
									<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','div'=>false,'class'=>'hmo_id'));?>
									<tr>
										<td><label>Provider:</label></td><td><?php echo $this->Form->input('insurance_provider',array('label'=>false,'empty' => true, 'type'=>'select','div'=>false,'title'=>'hmo_insurance_provider','options' => $insuranceProviders));?></td>
									</tr>
									<tr>
										<td><label>Product:</label></td><td><?php echo $this->Form->input('insurance_provider_product_id',array('label'=>false,'empty' => true, 'type'=>'select','options'=>current($insuranceProviderProducts),'div'=>false,'title'=>'hmo_insurance_provider_product'));?></td>
									</tr>
									<tr>
										<td><label>Accreditation No.:</label></td><td><?php echo $this->Form->input('accreditation',array('label'=>false, 'type'=>'text','div'=>false,'title'=>'hmo_accreditation'));?></td>
									</tr>
									<tr>
										<td><label>Date of Joining:</label></td><td><?php echo $this->Form->input('effectivity_date',array('label'=>false,'div'=>false,'title'=>'hmo_effectivity_date','type' => 'text','class'=>'datepicker'));?></td>
									</tr>
									<tr>
										<td><label>Date of Expiration:</label></td><td><?php echo $this->Form->input('expiration_date',array('label'=>false,'div'=>false,'title'=>'hmo_expiration_date','type' => 'text','class'=>'datepicker'));?></td>
									</tr>
									<tr>
									<?php echo $this->Form->end();?>
									<td><?php echo $this->Form->submit('Save',array('div'=>false,'style'=>'','class' => 'save_hmo'));?></td>
									</tr>
								</table>
								<?php echo $this->Form->end()?>
							</div>
						</div>
						<div id="organization" class="tabdiv">
							<div id="organization-div">
								<table id="common-tbl" class="org_aff_list">
									<thead>
										<tr>
											<th>Organization</th><th>Member Since</th><th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($this->data['Person']['Organizations'])):?>
											<?php foreach($this->data['Person']['Organizations']as $orgAff):?>
												<?php //unset($organizations[$orgAff['OrganizationsAffiliation']['id']]);?>
												<tr id="org_aff_<?php echo $orgAff['OrganizationsAffiliation']['id'];?>">
													<td class ="org_aff_oa_id"><?php echo $this->Form->input('OrgAff.organization_id',array('type'=> 'hidden','value' =>$orgAff['OrganizationsAffiliation']['id']));echo '<p>'.$orgAff['OrganizationsAffiliation']['name'].'</p>';?></td>
													<td class ="org_aff_date"><?php echo '<p>'.$orgAff['PersonOrganizationsAffiliation']['date_member'].'</p>';?></td>
													<td>
														<a onclick="setOrgAff(this);" >Edit</a>
														<a onclick="removeOrgAff(this);" >Delete</a>
													</td>
												</tr>
											<?php endforeach;?>
										<?php endif;?>
									</tbody>
								</table>
								<?php echo $this->Form->create('PersonOrganizationsAffiliation',array('class' => 'org_aff_form'));?>
									<table id="single-td-tbl" class="org_aff_fields">
										<tr><td><h3>DETAILS</h3></td><td><?php echo $this->Form->input('id',array('label'=>false,'div'=>false,'class' => 'org_aff_id','title' => 'org_aff_id'));?></td></tr>
										<tr><td><label>Organization:</label></td><td><?php echo $this->Form->input('organization_id',array('label'=>false, 'type'=>'select','div'=>false,'options' => $organizations,'empty' => true,'title'=>"org_aff_oa_id"));?></td></tr>
										<tr><td><label>Membership:</label></td><td><?php echo $this->Form->input('date_member',array('label'=>false,'div'=>false,'class' => 'datepicker','title'=>"org_aff_date",'type'=>'text'));?></td></tr>
										<tr><td><?php echo $this->Form->submit('SAVE',array( 'class' => 'save_org_aff' ));?></td></tr>
					            	</table>
								<?php echo $this->Form->end();?>
							</div>
						</div>
						<div id="membership" class="tabdiv">
							<br/>
							<div id="membership-div">
								<table id="single-td-tbl">
									<tr><td><h3>MEMBERSHIP</h3></td><td></td></tr>
									<tr><td><label>Date of Joining:</label></td><td><?php echo $this->Form->input('Physician.entry_datetime',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
									<tr><td><label>Referred By:</label></td><td><?php echo $this->Form->input('refer',array('label'=>false,'div'=>false));?></td></tr>
									
									<tr><td><h3>SUBSCRIPTION</h3></td><td></td></tr>
									<tr><td><label>Organization's Events Notification</label></td><td><?php echo $this->Form->checkbox('notify',array('label'=>false,'div'=>false));?></td></tr>
				
									<tr><td><?php echo $this->Form->submit('EDIT MEMBERSHIP');?></td><td></td></tr>
				            		<?php echo $this->Form->end();?>
								</table>
							</div>
						</div>
					
				</div>
            </div><!--/profile-->

        </div><!--/widget-->
 </div>
 <table class="templates" style="display:none;">
	<tbody>
		<tr class="clinic-duty-template">
			<td>
				<?php echo $this->Form->input('CompanyBranchMemberDuty.0.id',array('type' => 'hidden','class' => 'cbmd_id','label' => false,'div'=>false))?>
				<?php echo $this->Form->input('CompanyBranchMemberDuty.0.status',array('type' => 'hidden','value' => 1,'class' => 'cbmd_status','label' => false,'div'=>false))?>
				<?php echo $this->Form->input('CompanyBranchMemberDuty.0.day',array('type' => 'select','options'=>$days,'class' => 'cbmd_day','label' => false,'div'=>false))?>
			</td>
			<td>
				<?php echo $this->Form->input('CompanyBranchMemberDuty.0.start_time',array('type' => 'text','class' => 'cbmd_start','label' => false,'div'=>false))?>
			</td>
			<td>
				<?php echo $this->Form->input('CompanyBranchMemberDuty.0.end_time',array('type' => 'text','class' => 'cbmd_end','label' => false,'div'=>false))?>
			</td>
			<td><a onclick="removeClinicHour(this);">X</a></td>
		</tr>
	</tbody>
</table>
<?php echo $this->element('sidebar');?>
<script>
	var insuranceProductProviders = <?php echo $this->Js->object($insuranceProviderProducts);?>;
	var autoComp;
	var provinces = <?php echo $this->Js->object($provinces);?>;
	var historyHandler = function(event){
		jQuery('#'+event.data.divid+' input[type=radio]:first').click();
		jQuery(this).unbind('click',historyHandler);
	};
	$("canvas").drawArc({
		  fillStyle: "green",
		  x: 100, y: 100,
		  radius: 50
		});
	var initGraphHandler = function(event){
		jQuery('#google-map').gmapplot({selectable_location:true,resizable:true,latInputAttr:{name:"data[Address][latitude]"},lngInputAttr:{name:"data[Address][longtitude]"}});
		jQuery('#google-map').gmapplot('hide_selectable_location');
		pos = jQuery('#google-map').prev().offset();
		jQuery('#google-map').css({
    		
    		top: pos.top ,
    		left: pos.left + jQuery('#google-map').prev().width() + 30,
    		position: 'absolute'
    		
    	});
		setClinicType(4);
		jQuery(this).unbind('click',initGraphHandler);
	};
	var locateGraphHandler = function(){
		jQuery('#google-map').gmapplot('locate',locateAddress());
		
	};
	var branches;
	var ctype;
	
	jQuery(document).ready(function(){
		jQuery('#printTestHistory').click(function(){
			jQuery('#printArea').printArea({mode:'popup'});
		});
		jQuery('.address_field').change();
		
		jQuery('.patient_search').hide();
		
		jQuery('#open-photo').click(function(){
			jQuery(".browse_image").click();
		});
		
		jQuery('.current-crumb').append(' MEMBER ACCOUNT');

		jQuery('#take-photo').click(function(){
			jQuery( "#webcam-dialog" ).dialog('open');
		});

		jQuery('#printPdf').click(function(){
			$('.testgroup-dialog').dialog('open');
			var print = jQuery('#printPdf').val();
			//window.open(print);
			});
		jQuery('#printPdfResult').click(function(){
			$('.testgroup-dialog').dialog('open');
			var print = jQuery('#printPdf').val();
			//window.open(print);
			});
		
		jQuery('.testgroup-dialog').dialog({
			title:'Select test to print',
			autoOpen:false,
			modal:true,
			resizable:false,
			width:300,
			height:430,
			buttons:{
				Save: function(){
					jQuery('#stream').val(0);
					jQuery('#print_filter').submit();
					jQuery(this).dialog('close');
				},
				Print: function(){
					jQuery('#stream').val(1);
					jQuery('#print_filter').submit();
					jQuery(this).dialog('close');
				},
				Close:function(){
					jQuery(".testgroup-dialog").dialog('close');
				}
			}
		});

		jQuery('#selected').css({'background':'url(../../img/btn-bg.jpg) repeat'});
		divId = jQuery('.ui-tabs-selected > a').attr('href');
		jQuery('.visits_tbl tr').live('click', function(){
			if(jQuery('#selected').size() == 0 )
			{
				jQuery(this).attr('id','selected');
			}
			else
			{
				jQuery('.visits_tbl tr').removeAttr('id');
				jQuery(this).attr('id','selected');
				}
			});
		jQuery('.testGroup input').live('click',function(){
			if(jQuery(this).is(':checked'))
				jQuery(this).parents('.testGroup').next('.testCode').find('*:input').attr('checked','checked');
			else
				jQuery(this).parents('.testGroup').next('.testCode').find('*:input').removeAttr('checked');

		});
		jQuery('.testgroup-dialog input').attr('checked','checked');
		jQuery('.testGroup input').live('click',function(){
			if(jQuery('input[type!=hidden]:checked', '.testGroup').length == 0 || jQuery('input[type!=hidden]', '.testGroup').length != jQuery('input[type!=hidden]:checked', '.testGroup').length)
				jQuery('#print_all').removeAttr('checked');

		});

		jQuery('.testCode input').live('click',function(){
			jQuery(this).parents('.testCode').prev('.testGroup').find('input').attr('checked', 'checked');

			if(jQuery(this).parents('.testCode').find('input[type != hidden]:checked').length == 0)
				jQuery(this).parents('.testCode').prev('.testGroup').find('input').removeAttr('checked');
		});

		jQuery('#print_all').live('click',function(){
			if(jQuery(this).is(':checked'))
				jQuery('*:input','.testGroup, .testCode').attr('checked', 'checked');
			else
				jQuery('*:input','.testGroup, .testCode').removeAttr('checked');
		});
		
//		jQuery('div#personal-div table tr').css('vertical-align','middle');
//		jQuery('#visits,#history').find('.submit:first').css({'float':'left','margin-right':'15px'});
//		jQuery('div#profile-div table input[type="text"]').css({'width':'300px','height':'20px','padding':'5px'});
//		jQuery('div#profile-div table tr td,div#patient-profile-div table#profile-table tr td').css({'background':'white','padding':'0px'});
//		jQuery('div#profile-div table').css({'width':'50%','clear':'none'});
//		jQuery('div#patient-profile-div table#profile-table').css({'width':'50%','clear':'none'});
		
		jQuery('.save_profile').click(function(){
			if(uploadType == 1){
				jQuery(".browse_image").replaceWith($uploadImageButton);
			}else if(uploadType == 2){
				jQuery('.webcam-input').val('');
			}
			xmlForm(
				'.patient_form',
				"<?php echo $this->Html->url(array('controller'=>'Patients','action'=>'updateProfile'));?>",
				function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						parser = new DOMParser();
						xmlDoc = parser.parseFromString(xmlhttp.responseText, "application/xml");
	                    result = parseInt(xmlDoc.getElementsByTagName("result")[0].childNodes[0].nodeValue);
						if(result){
							alert('Your profile was successfully updated');
						}else{
							alert('An error ocurred while saving your profile, please try again.');
						}
	                } else if(xmlhttp.readyState == 4)
	                 	alert("Error: returned status code " + xmlhttp.status + " " + xmlhttp.statusText);
	            }
		    );
//			var formData = new FormData(jQuery('.patient_form')[0]);
//
//			if (window.XMLHttpRequest){
//				xmlhttp=new XMLHttpRequest();
//			} else {
//				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//			}
//
//			xmlhttp.open("POST", "<?php //echo $this->Html->url(array('controller'=>'Patients','action'=>'updateProfile'));?>", true);
//
//			xmlhttp.setRequestHeader("X_REQUESTED_WITH", "XMLHttpRequest");
//
//			xmlhttp.onreadystatechange = function(){
//
//				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
//                	xmlDoc=xmlhttp.responseXML;
//                    result = parseInt(xmlDoc.getElementsByTagName("result")[0].childNodes[0].nodeValue);
//					if(result){
//						alert('Your profile was successfully updated');
//					}else{
//						alert('An error ocurred while saving your profile, please try again.');
//					}
//                } else if(xmlhttp.readyState == 4)
//                 	alert("Error: returned status code " + xmlhttp.status + " " + xmlhttp.statusText);
//            };
//			xmlhttp.send(formData);
			event.preventDefault();
		});

		$uploadImageButton = jQuery(".browse_image").clone();
//		$uploadImageButton.change(updateImagePreview);
//		jQuery(".browse_image").change(updateImagePreview);

		$uploadImageButton.bind("change",{selectors:["'#dt-login-form #side_id_pic'","idpic"]},updateImagePreview);
		jQuery(".browse_image").change(updateImagePreview);

		jQuery('.save_hmo').click(function(){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Insurances','action'=>'addPersonInsurance'));?>',
				data:jQuery('.hmo_form').serialize(),
				type: 'POST',
				dataType : 'json',
				success:function(data){
					if(data){
						alert('Saving insurance details was successful.');

						id = jQuery('.hmo_id').val();
						tr = '<tr id="hmo_'+data+'">';

						jQuery('.HMO_fields').find('input[type=text],select').each(function(){
							tr += '<td class="'+jQuery(this).attr('title')+'">';
							if(this.nodeName.toLowerCase() == 'input'){
								tr += '<p>'+jQuery(this).val()+'<p>';
							}else{
								tr += '<input type="hidden" name="data[InsuranceProviderProduct][id]" value="'+jQuery(this).val()+'" id="InsuranceProviderProductId">';
								tr += '<p>'+jQuery(this).find('option:selected').text()+'<p>';
							}
							tr += '</td>';
						});
						tr += '<td><a href="#" onclick="setHMO(this);" >Edit</a><a href="#" onclick="deleteHMO('+data+');">Delete</a></td>';
						tr += '</tr>';
						
						if(jQuery('#hmo_'+id).length){
							jQuery('#hmo_'+id).replaceWith(tr);
						}else{
							jQuery('.hmo_list tbody').append(tr);
						}
					}else{
						alert('Saving insurance fail, please try again.');
					}
				}
			});
			event.preventDefault();
		});

		jQuery('.save_org_aff').click(function(){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'OrganizationsAffiliations','action'=>'addPersonOrganizationAffiliation'));?>',
				data:jQuery('.org_aff_form').serialize(),
				type: 'POST',
				dataType : 'json',
				success:function(data){
					if(data){
						alert('Saving insurance details was successful.');
						
						id = jQuery('.org_aff_id').val();
						tr = '<tr id="org_aff_'+data+'">';

						jQuery('.org_aff_fields').find('input[type=text],select').each(function(){
							tr += '<td class="'+jQuery(this).attr('title')+'">';
							if(this.nodeName.toLowerCase() == 'input'){
								tr += '<p>'+jQuery(this).val()+'<p>';
							}else{
								tr += '<input type="hidden" value="'+jQuery(this).val()+'" >';
								tr += '<p>'+jQuery(this).find('option:selected').text()+'<p>';
							}
							tr += '</td>';
						});
						tr += '<td><a href="#" onclick="setOrgAff(this);" >Edit</a><a href="#" onclick="deleteOrgApp('+data+');">Delete</a></td>';
						tr += '</tr>';
						
						if(jQuery('#org_aff_'+id).length){
							jQuery('#org_aff_'+id).replaceWith(tr);
						}else{
							jQuery('.org_aff_list tbody').append(tr);
						}
					}else{
						alert('Saving insurance fail, please try again');
					}
				}
			});
			event.preventDefault();
		});
		
		jQuery('select[title=hmo_insurance_provider]').change(function(){
			insId = jQuery(this).val();
			if(insuranceProductProviders[insId] != undefined){

				jQuery('select[title=hmo_insurance_provider_product]').empty();
				options = '<option value=""></option>';
				jQuery.each(insuranceProductProviders[insId],function(x,y){
					options += '<option value="'+x+'">'+y+'</option>';
				});
				jQuery('select[title=hmo_insurance_provider_product]').append(options);
				
			}

		});

		<?php if(isset($firstTestOrder)):?>
			showTestOrderDetail('<?php echo $firstTestOrder;?>','visits-view');
			showTestOrderId('<?php echo $firstTestOrder;?>');
		<?php endif;?>
		jQuery('a[href=#physician-history]').click({divid:'history-div'},historyHandler);
		jQuery('a[href=#patient-history]').click({divid:'patient-history'},historyHandler);
		jQuery('a[href=#clinic]').click({divid:'patient-history'},initGraphHandler);

		jQuery('.search-patient-btn').click(function(){
			clearLabel();
			serializedFormData = jQuery('.search-patient-frm').serialize();
			setLabel();
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Patients','action'=>'getPhysicianPatients'));?>',
				data:serializedFormData,
				type: 'POST',
				dataType : 'json',
				success:function(data){
					jQuery('.patient_search').show();
					jQuery('.patient_search tbody').empty();
					len = data.Patient.length;
					if(len){
						tr = '';
						jQuery.each(data.Patient,function(x,y){
							tr += '<tr onclick="showPatientProfile('+y['Person']['id']+')" style="cursor: pointer;"><td>'+y['Person']['lastname']+', '+y['Person']['firstname']+' '+y['Person']['middlename']+'</td><td>'+data.Patient[x]['LaboratoryPatientBatchOrder']['confirmed_date']+'</td><td>'+y['Laboratory']['name']+'</td></tr>';
						});
						
						jQuery('.patient_search tbody').append(tr);

						showPatientProfile(data.Patient[0]['Person']['id']);
						
					}else{
						jQuery('.patient_search tbody').append('<tr><td colspan="3">No Patient Found.</td></tr>');
					}
				}
			});
			return false;
		});

		jQuery('.patient-list-filter-btn').click(function(){
			serializedFormData = jQuery('.patient-list-filter').serialize();
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Patients','action'=>'getPhysicianPatients'));?>',
				data:serializedFormData,
				type: 'POST',
				dataType : 'json',
				success:function(data){
					jQuery('.patient-list-tbl tbody').empty();
					len = data.Patient.length;
					if(len){
						tr = '';
						jQuery.each(data.Patient,function(x,y){
							tr = '<tr><td>'+y['Person']['lastname']+', '+y['Person']['firstname']+' '+y['Person']['middlename']+'</td><td>'+data.Patient[x]['Patient']['registered_date']+'</td><td>'+data.Address.Province[y['Address']['province_state_id']]+'</td><td>'+data.Address.TownCity[y['Address']['town_city_id']]+'</td><td>'+data.Patient[x]['Person']['sex']+'</td><td>'+data.Patient[x]['Person']['birthdate']+'</td><td>'+data.Patient[x]['Person']['age']+'</td></tr>';
						});
						jQuery('.patient-list-tbl tbody').append(tr);

					}else{
						jQuery('.patient-list-tbl tbody').append('<tr><td colspan="7">No Patient Found.</td></tr>');
					}
				}
			});
			return false;
		});
		

		jQuery('.patient-stat-btn').click(function(){
			serializedFormData = jQuery('.patient-stat-frm').serialize();
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Physicians','action'=>'getStatistics'));?>',
				data:serializedFormData,
				type: 'POST',
				dataType : 'json',
				success:function(data){
					jQuery('.patient-stat-tbl tbody').empty();
					if(data){
						laboratoryCounts = [];
						laboratoryRows = [];
						jQuery.each(data.Stat,function(x,y){
							laboratoryCounts[x] = 0;
							laboratoryRows[x] = '';
							jQuery.each(y,function(w,z){
								laboratoryCounts[x] += parseInt(z[0]['testgroup_count']);
								laboratoryRows[x] += '<tr><td></td><td>'+data.TestGroup[z['LaboratoryPatientBatchOrderPackage']['test_group_id']]+'</td><td>'+z[0]['testgroup_count']+'</td>';
							});
						});
						trs = '';
						jQuery.each(data.Stat,function(x,y){
							trs += '<tr><td>'+data.Laboratory[x]+'</td><td></td><td>'+laboratoryCounts[x]+'</td></tr>';
							trs += laboratoryRows[x];
						});

						jQuery('.patient-stat-tbl tbody').append(trs);
							
					}else{
						jQuery('.patient-stat-tbl tbody').append('<tr><td colspan="7">No Patient Found.</td></tr>');
					}
				}
			});
			return false;
		});

		jQuery('.patient-pres-filter-btn').click(function(){
			serializedFormData = jQuery('.patient-pres-filter').serialize();
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Physicians','action'=>'getPrescriptions'));?>',
				data:serializedFormData,
				type: 'POST',
				dataType : 'json',
				success:function(data){
					jQuery('.patient-pres-tbl tbody').empty();
					if(data){
						trs = '';
						
						jQuery.each(data.Prescription,function(x,y){
							trs += '<tr><td>'+y['Person']['lastname']+', '+y['Person']['firstname']+' '+y['Person']['middlename']+'</td><td>'+data.Laboratory[y['LaboratoryPatientOrder']['laboratory_id']]+'</td><td>'+y['LaboratoryPatientBatchOrder']['confirmed_date']+'</td><td>'+data.TestGroup[y['LaboratoryPatientBatchOrderPackage']['test_group_id']]+'</td></tr>';
						});

						jQuery('.patient-pres-tbl tbody').append(trs);
							
					}else{
						jQuery('.patient-stat-tbl tbody').append('<tr><td colspan="7">No Patient Found.</td></tr>');
					}
				}
			});
			return false;
		});
		
		jQuery('select[title=address_select_1]').change();
		jQuery('.patient-list-filter-btn').click();
		jQuery('.patient-stat-btn').click();
		jQuery('.patient-pres-filter-btn').click();

		jQuery('.clinic-type-radio').change(function(){
			type = jQuery(this).val();
			if(type != ctype)
				setClinicType(type);
		});
		jQuery('.autocomplete').autocomplete({
		    source: '/laboratories/getCompanies',
		    minLength:2,
		    select: function (event,ui) {
				showCompany(ui.item.id);
		    }
		});

		jQuery('.company-branch-slc').change(function(){
			branchId = jQuery(this).val();
			branches.CompanyBranches[branchId];

			jQuery.each(branches.CompanyBranches[branchId],function(x,y){
				jQuery.each(y,function(w,z){
					id = x+camelize(w);
					jQuery('#'+id).val(z);
				});
			});

//			memberId = branches.CompanyBranchMembers[branchId];

			jQuery('.clinic-duty-hours tbody tr').not(':last').remove();
			
//			jQuery.each(branches.CompanyBranchMemberDuties[memberId],function(x,y){
//				y = y.CompanyBranchMemberDuty;
//				clonetr = jQuery('.clinic-duty-template').clone();
//				jQuery(clonetr).removeClass('clinic-duty-template');
//				jQuery(clonetr).find('.cbmd_id').val(y.id);
//				jQuery(clonetr).find('.cbmd_day').val(y.day);
//				jQuery(clonetr).find('.cbmd_start').val(y.start_time);
//				jQuery(clonetr).find('.cbmd_end').val(y.end_time);
//				jQuery(clonetr).insertBefore('.clinic-duty-hours tbody tr:last');
//
//			});

			jQuery('#AddressProvinceStateId').empty().append('<option value="'+branches.Addresses[branches.CompanyBranchAddresses[branchId]].ProvincesStatesCode.id+'" >'+branches.Addresses[branches.CompanyBranchAddresses[branchId]].ProvincesStatesCode.name+'</option>');
			jQuery('#AddressTownCityId').empty().append('<option value="'+branches.Addresses[branches.CompanyBranchAddresses[branchId]].TownCityCode.id+'" >'+branches.Addresses[branches.CompanyBranchAddresses[branchId]].TownCityCode.name+'</option>');
			jQuery('#AddressVillageId').empty().append('<option value="'+branches.Addresses[branches.CompanyBranchAddresses[branchId]].VillageCode.id+'" >'+branches.Addresses[branches.CompanyBranchAddresses[branchId]].VillageCode.name+'</option>');
			jQuery.each(branches.Addresses[branches.CompanyBranchAddresses[branchId]].Address,function(x,y){
				id = 'Address'+camelize(x);
				jQuery('#'+id).val(y);
			});

			clinic = [
						{
							"lat":branches.Addresses[branches.CompanyBranchAddresses[branchId]].Address.latitude,
							"lng":branches.Addresses[branches.CompanyBranchAddresses[branchId]].Address.longtitude,
							"title":branches.CompanyBranches[branchId].branch,
							"content":branches.CompanyBranches[branchId].branch,
							"draggable":false
						}
					];
			
			jQuery('#google-map').gmapplot('plot',clinic);
		});

		jQuery('.browse_logo').bind('change',{selectors:["#cliniclogo"]},updateImagePreview);
		
	});
	
	function deleteHMO(personInsId){
		if(confirm("Are you sure you want to remove this insurance?")){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Insurances','action'=>'deletePersonInsurance'));?>',
				data:{'PersonInsurance':{'id':personInsId}},
				type: 'POST',
				dataType : 'json',
				success:function(data){
					if(data){
						alert('Deletion of insurance was successful.');
						jQuery('#hmo_'+personInsId).remove();
						
					}else{
						alert('Deletion of insurance fail, please try again stupid!');
					}
				}
			});
		}
	}
	function setHMO(button){
		jQuery(button).parent().parent().find('td').each(function(){
			inputClass =  jQuery(this).attr('class');
			inputValue = (jQuery(this).find('input').length)?jQuery(this).find('input').val():jQuery(this).find('p').html();
			jQuery('input[title='+inputClass+'],select[title='+inputClass+']').val(inputValue);
			if(inputClass=='hmo_insurance_provider'){
				element = document.getElementById('PersonInsuranceInsuranceProvider');
				if ("fireEvent" in element)
				    element.fireEvent("onchange");
				else
				{
				    var evt = document.createEvent("HTMLEvents");
				    evt.initEvent("change", false, true);
				    element.dispatchEvent(evt);
				}
				
			}
		});
		jQuery('.hmo_id').val(jQuery(button).parent().parent().attr('id').replace('hmo_',''));
	}
	function setOrgAff(button){
		jQuery(button).parent().parent().find('td').each(function(){
			inputClass =  jQuery(this).attr('class');
			inputValue = (jQuery(this).find('input').length)?jQuery(this).find('input').val():jQuery(this).find('p').html();
			jQuery('input[title='+inputClass+'],select[title='+inputClass+']').val(inputValue);
		});
		jQuery('.org_aff_id').val(jQuery(button).parent().parent().attr('id').replace('org_aff_',''));
	}
	
	function showClinic(branchId,type){
		if(type == 3){
			setClinicType(2);
			jQuery('.dim-box #CompanyUpdate').val(1);
		} else {
			setClinicType(3);
			jQuery('.dim-box #CompanyUpdate').val(0);
		}
		
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'getLab'));?>',
			data:{'CompanyBranch':{'id':branchId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){
				
				jQuery.each(data.AddressCode,function(x,y){
					jQuery('#Address'+x+'Id').empty();
					jQuery.each(y,function(w,z){
						jQuery('#Address'+x+'Id').append('<option value="'+w+'" selected >'+z+'</option>');
					});
				});

				
				
				jQuery('.clinic-duty-hours tbody tr').not(':last').remove();

				jQuery('.dim-box #CompanyBranchId').empty();
				jQuery('.dim-box #CompanyBranchId').append('<option value="'+data.CompanyBranch.id+'">'+data.CompanyBranch.branch+'</option>');
				
				if(data.CompanyBranchMemberDuty != undefined && data.CompanyBranchMemberDuty.length)
					jQuery.each(data.CompanyBranchMemberDuty,function(x,y){
						clonetr = jQuery('.clinic-duty-template').clone();
						jQuery(clonetr).removeClass('clinic-duty-template');
						jQuery(clonetr).find('.cbmd_id').val(y.id);
						jQuery(clonetr).find('.cbmd_day').val(y.day);
						jQuery(clonetr).find('.cbmd_start').val(y.start_time);
						jQuery(clonetr).find('.cbmd_end').val(y.end_time);
						jQuery(clonetr).insertBefore('.clinic-duty-hours tbody tr:last');
						
					});
				reindexorder('.clinic-duty-hours tbody tr');
				
				delete data.AddressCode;
				delete data.CompanyBranchMemberDuty;

				logo = '';
				if(data.Company.logo != undefined && data.Company.logo.length)
					logo = '/img/../media/profiles/'+data.Company.logo;
				else if(data.CompanyBranchInfo.logo != undefined && data.CompanyBranchInfo.logo.length)
					logo = '/img/../media/profiles/'+data.CompanyBranchInfo.logo;

				if(logo.length)
					jQuery('#cliniclogo').attr('src',logo);
				
				jQuery.each(data,function(x,y){
					jQuery.each(y,function(w,z){
						id = x+camelize(w);
						jQuery('#'+id).val(z);
					});
				});
				if(data.Address != undefined && Object.keys(data.Address).length){
					clinic = [{"lat":data.Address.latitude,"lng":data.Address.longtitude,"title":data.Company.name,"content":data.Company.name,"draggable":false}];
					jQuery('#google-map').gmapplot('plot',clinic);
				}
			}
		});
	}
	function removeClinicHour(anc,type){
		$tr = jQuery(anc).parents('tr');
		if(type != undefined && type){
			$tr.remove();
		} else {
			$tr.find('.cbmd_status').val(2);
			$tr.hide();
		}
		reindexorder('.clinic-duty-hours tbody tr');
	}
	function addClinicHour(anc){
		$tr = jQuery(anc).parents('tr');
		$clonetr = $tr.clone();

		$clonetr.find('td:last').html('<a onclick="removeClinicHour(this,true);" >X</a>');
		//fix select
		$clonetr.find('.cbmd_status').val(1);
		$tr.find("select").each(function(i){
			$clonetr.find("select").eq(i).val(jQuery(this).val());
		});
		
		jQuery($clonetr).insertBefore('.clinic-duty-hours tbody tr:last');
		$tr.find('input,select,textarea').val('');
		reindexorder('.clinic-duty-hours tbody tr');
		
	}
	
	function saveClinic(){
//		jQuery('.clinic-duty-hours tr:last').find('input , select, textarea').attr("disabled",true);
		xmlForm(
			'.clinic-frm',
			'<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'updateClinic'));?>',
			function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					parser = new DOMParser();
					xmlDoc = parser.parseFromString(xmlhttp.responseText, "application/xml");
                	result = 0;
                	if(xmlDoc.getElementsByTagName("result")[0].hasChildNodes)
	                    result = parseInt(xmlDoc.getElementsByTagName("result")[0].firstChild.nodeValue);
					if(result){
						alert('Your profile was successfully updated');
						companyBranch = xmlDoc.getElementsByTagName("CompanyBranch")[0];
						branchId = null;
						if(companyBranch.hasChildNodes)
		                    if(companyBranch.getElementsByTagName("id")[0].hasChildNodes)
			                    branchId = companyBranch.getElementsByTagName("id")[0].firstChild.nodeValue;

						laboratory = xmlDoc.getElementsByTagName("Laboratory")[0];

						type = 1;
						if(laboratory != undefined && laboratory.hasChildNodes)
		                	if(laboratory.getElementsByTagName("type")[0].hasChildNodes)
			            		type = laboratory.getElementsByTagName("type")[0].firstChild.nodeValue;
						
						if(jQuery('.clinic-list-tbl .empty-tr').length)
						jQuery('.clinic-list-tbl .empty-tr').remove();
					
						tr = '<tr id="'+branchId+'" onclick="showClinic('+branchId+','+type+');">';
						tr += '<td>'+((jQuery('.dim-box #CompanyBranchBranch').val().length)?jQuery('.dim-box #CompanyBranchBranch').val():jQuery('.dim-box #CompanyBranchId option:selected').text())+'</td>';
				
						td = [];
						jQuery('.clinic-duty-hours tbody tr').not(':last').each(function(x,y){
							td[x] = jQuery(y).find('.cbmd_day option:selected').text().substring(0,3);
							td[x] += ' '+jQuery(y).find('.cbmd_start').val().substring(0,5);
							td[x] += '-'+jQuery(y).find('.cbmd_end').val().substring(0,5);
						});
						tr += '<td>' + td.join(', ') + '</td>';
						tr += '<td><a onclick="removeClinic('+branchId+','+type+');" >Remove</a></td>';
						tr += '</tr>';
							
						if(jQuery('.clinic-list-tbl tr#'+branchId).length)
							jQuery('.clinic-list-tbl tr#'+branchId).replaceWith(tr);
						else
							jQuery('.clinic-list-tbl tbody').append(tr);

						setClinicType(4);
//						code to update clinic form after save, not used the form was cleared instead using setClinicType(4);
//						jQuery('.clinic-duty-hours tbody tr').not(':last').remove();
//						companyBranchMemberDuties = xmlDoc.getElementsByTagName("CompanyBranchMemberDuty");
//						for(i = 0;i < companyBranchMemberDuties.length;i++ ){
//							clonetr = jQuery('.clinic-duty-template').clone();
//							jQuery(clonetr).removeClass('clinic-duty-template');
//							jQuery(clonetr).find('.cbmd_id').val(companyBranchMemberDuties[i].getElementsByTagName("id")[0].firstChild.nodeValue);
//							jQuery(clonetr).find('.cbmd_day').val(companyBranchMemberDuties[i].getElementsByTagName("day")[0].firstChild.nodeValue);
//							jQuery(clonetr).find('.cbmd_start').val(companyBranchMemberDuties[i].getElementsByTagName("start_time")[0].firstChild.nodeValue);
//							jQuery(clonetr).find('.cbmd_end').val(companyBranchMemberDuties[i].getElementsByTagName("end_time")[0].firstChild.nodeValue);
//							jQuery(clonetr).insertBefore('.clinic-duty-hours tbody tr:last');
//							companyBranchMemberDuties[i].parentNode.removeChild(companyBranchMemberDuties[i]);
//						}
//						reindexorder('.clinic-duty-hours tbody tr');
//
//						dataNodes = xmlDoc.getElementsByTagName("data")[0].childNodes;
//
//						for(i = 0; i < dataNodes.length; i++){
//							if(dataNodes[i].nodeType == 1){
//								datumNodes = dataNodes[i].childNodes;
//								for(j = 0; j < datumNodes.length; j++){
//									if(datumNodes[j].nodeType == 1 && datumNodes[j].firstChild != null){
//										id = '#'+camelize(dataNodes[i].nodeName) + camelize(datumNodes[j].nodeName);
//										if(jQuery(id).length && jQuery(id).attr('type') != 'file')
//											jQuery(id).val(datumNodes[j].firstChild.nodeValue);
//									}
//								}
//							}
//						}
					}else{
						alert('An error ocurred while saving your profile, please try again.');
					}
                } else if(xmlhttp.readyState == 4)
                 	alert("Error: returned status code " + xmlhttp.status + " " + xmlhttp.statusText);

//				jQuery('.clinic-duty-hours tr:last').find('input , select, textarea').removeAttr("disabled");
			}
		);
	}
	function setClinicType(type){

		jQuery('.clinic-frm').get(0).reset();
		jQuery('.clinic-frm').find('input, textarea').not('.clinic-type-radio').val('');
//		jQuery('.clinic-frm').find('select').empty();
		
		jQuery('.dim-box #google-map').gmapplot('clear_locations');
		jQuery('.clinic-duty-hours tbody tr').not(':last').remove();
		ctype = type;
		
		if(type == 2){

			jQuery('.clinic-type-radio').filter('[value=2]').attr('checked', true);

			jQuery('.dim-box input, .dim-box select, .dim-box textarea').removeAttr('disabled');
			jQuery('.dim-box #CompanyName,.dim-box .clinic-type-radio,.dim-box #CompanyBranchId').removeAttr('disabled');
			
			jQuery('.dim-box .clinic-type-select').show();
			jQuery('.dim-box .clinic-type-radio').removeAttr("disabled");
			jQuery('.dim-box #cliniclogo').attr('src','/img/../media/profiles/default.jpeg');

			jQuery('.dim-box #CompanyBranchBranch').show();
			jQuery('.dim-box #CompanyBranchId').hide();
			
			jQuery('.autocomplete').autocomplete('disable');
			jQuery('.dim-box #google-map').gmapplot('show_selectable_location');
			jQuery('.address_field').change(locateGraphHandler);
			
			fillSelect('.dim-box select[title=address_select_1]',provinces);
			
		} else {

			jQuery('.dim-box #cliniclogo').attr('src','/img/../media/profiles/default.jpeg');
			jQuery('.dim-box #google-map').gmapplot('hide_selectable_location');
			jQuery('.dim-box .address_field').unbind('change', locateGraphHandler);

			jQuery('.dim-box input,.dim-box select,.dim-box textarea').attr('disabled',true);
			
			if(type == 1){

				jQuery('.clinic-type-radio').filter('[value = 1]').attr('checked', true);
				
				jQuery('.dim-box #CompanyBranchBranch').hide();
				jQuery('.dim-box #CompanyBranchId').show();

				jQuery('.dim-box #CompanyName, .dim-box #CompanyBranchId').removeAttr("disabled");
				
				jQuery('.autocomplete').autocomplete('enable');

				jQuery('.clinic-type-select').show();
				jQuery('.clinic-type-radio').removeAttr("disabled");
				
			} else {

				jQuery('.dim-box #CompanyBranchBranch').show();
				jQuery('.dim-box #CompanyBranchId').hide();
				jQuery('.dim-box #CompanyBranchId').removeAttr("disabled");

				jQuery('.clinic-type-select').hide();
				jQuery('.clinic-type-radio').attr('disabled',true);

			}
		}
	}
	function removeClinic(branchId,type){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'removeClinic'));?>',
			data:{'CompanyBranch':{'id':branchId},'Laboratory':{'type':type}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){
				if(data){
					alert('Removing clinic was successful.');
					jQuery('.clinic-list-tbl #'+branchId).remove();
					setClinicType(4);
				}else{
					alert('Removing clinic failed.');
				}
			}
		});
		setClinicType(4);
		return false;
	}
	function showPatientProfile(personId){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'profile'));?>',
			data:{'Person':{'id':personId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){
				if(data['person'] != undefined){
					jQuery('.patient_test_results').show();
					jQuery.each(data['person'],function(x,y){
						id = 'Profile'+ camelize(x);
						if(x == 'image'){
							jQuery('#patient-idpic').attr('src','/img/../media/profiles/'+y);
						}else if(x == 'CompleteAddress'){
							address = [];
							jQuery.each(y,function(w,z){
								if(w == 'Address'){
								//	address.concat(z);
								}else{
									address.push(z.name);
								}
							});
							jQuery('#'+id).val(address.join(', '));
						}else if(jQuery('#'+id+'_').length){
							jQuery('#'+id+y).attr('checked','checked');
						}else{
							jQuery('#'+id).val(y);
						}
					});
				}
				if( data['testOrders'] != undefined ){
					jQuery('.patient-visits tbody').empty();
					trs = '';
					jQuery.each(data['testOrders'],function(x,y){

						trs += '<tr style="cursor:pointer;" class="testOrderDetailClass" onclick="showTestOrderDetail('+y['LaboratoryTestOrder']['id']+',\'patient-visit-view\')">';
						trs += '<td>';
						if(data['laboratories'][y['LaboratoryPatientOrder']['laboratory_id']] != undefined)
							trs += data['laboratories'][y['LaboratoryPatientOrder']['laboratory_id']];
						trs += '</td>';
						trs += '<td>'+y['LaboratoryTestOrder']['posted_datetime']+'</td>';

						trs += '<td>';
						if(data['testOrderPackages'][y['LaboratoryTestOrder']['id']] != undefined)
							testgroups = [];
							jQuery.each(data['testOrderPackages'][y['LaboratoryTestOrder']['id']],function(w,z){
								testgroups.push(z);
								});
							trs += testgroups.join(', ');
						trs += '</td>';

						trs += '</tr>';
						
					});
					jQuery('.patient-visits tbody').append(trs);
					showTestOrderDetail(data['testOrders'][0]['LaboratoryTestOrder']['id'],'patient-visit-view');
						
				}

				if(data['testGroups'] != undefined){
					jQuery('#patient-history .test-groups').empty();

					tags = '';
					jQuery.each(data['testGroups'],function(x,y){
						tags += '<input type="radio" name="data[patient_group_name]" id="GroupName'+x+'" onclick="showTestHistory(this,\'patient-test-history\');" value="'+x+'" title="'+data['person']['id']+'">'
						tags += '<label for="GroupName1">'+y+'</label>';
					});
					
					jQuery('#patient-history .test-groups').append(tags);


				}
			}
		});
	}
	
	function showCompany(companyId, type){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'getCompany'));?>',
			data:{'Company':{'id':companyId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){

				if(data){
					
					if(data.Company.logo != undefined && data.Company.logo.length)
						jQuery('#cliniclogo').attr('src','/img/../media/profiles/'+data.Company.logo);

					jQuery.each(data.Company,function(x,y){
						id = 'Company'+camelize(x);
						jQuery('#'+id).val(y);
					});

					jQuery('.company-branch-slc').empty();
					options = '';
					jQuery.each(data.CompanyBranches,function(x,y){

						options += '<option value="'+y.CompanyBranch.id+'">'+y.CompanyBranch.branch+'</option>';

					});
					
					jQuery('.company-branch-slc').append(options);
					
					delete data.Company;
					branches = data;

					jQuery('.company-branch-slc').triggerHandler('change');
						
				}
				
			}
		});
	}
</script>
 	<style>
	.ui-dialog .ui-dialog-titlebar {
	    background:#ccc;
	}
	.visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr:hover td {
	   background: #687719;
	   color: #fffae4;
	}
	#selected td{
	   background: #687719;
	   color: #fffae4;
	}
	#common-tbl th{
	   background: url(../../img/btn-bg.jpg) repeat;
	   color: #fffae4;
	}
	input[type="text"], textarea, select {
    border-color: #7B7B7B #CBCCCE #CBCCCE #7B7B7B;
    border-radius: 2px 2px 2px 2px;
	}
	td label{
		font-size: 11px;
		font-weight: bold;
	}
	</style>