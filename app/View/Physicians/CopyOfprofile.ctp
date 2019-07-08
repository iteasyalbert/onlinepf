<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=PH"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->Html->script('gmapplot.js');?>
<?php 
	echo $this->element('graph_scripts');
?>
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
					<?php echo $this->Form->input('myresultonline_id',array('label'=>false,'type'=>'text','div'=>false,'value'=>'myResultOnlineID','class'=>'labeled','title'=>'myResultOnlineID'));?>
					<?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false,'value'=>'Lastname','class'=>'labeled','title'=>'Lastname'));?>
					<?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false,'value'=>'Firstname','class'=>'labeled','title'=>'Firstname'));?>
					<?php echo $this->Form->input('Field.laboratory',array('label'=>false,'div'=>false,'type'=>'hidden'));?>
					<?php echo $this->Form->submit('Search Patient',array('div'=>false,'class'=>'search-patient-btn'));?>
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
	                				<?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printHistoryPdf','style'=>'margin-left:77.5%;'));?>
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
						                <?php echo $this->Form->submit('Print',array('div'=>false, 'class'=>'printHistory','style'=>'margin-left:87%;', 'name="Print"'));?>
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
						                			<tr  id="<?php echo $selected ;?>" style="cursor:pointer;" class="testOrderDetailClass" onclick="showTestOrderDetail('<?php echo $visit['TestOrder']['id'];?>','visits-view')">
						                				<td><?php echo date('F d,Y H:i:s',strtotime($visit['TestOrder']['posted_datetime']));?></td>
						                				<td><?php echo $laboratories[$visit['LaboratoryPatientOrder']['laboratory_id']];?></td>
						                				<td>
						                					
						                					<?php
					///	                						debug($visit); 
																if(is_null($firstTestOrder))
																	$firstTestOrder =  $visit['TestOrder']['id'];
						                							$selected = '';
						                						if(isset($testOrderPackages[$visit['TestOrder']['id']])){
						                							echo implode(', ',$testOrderPackages[$visit['TestOrder']['id']]);	
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
				                <?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdf','style'=>'margin-left:77.5%;'));?>
				                <?php echo $this->Form->end();?>
			            </div><!--/visits-->
			            
			            <div id="physician-history" class="tabdiv">
			                <div id="history-div">
			                	<h4>Select TestGroup</h4>
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
					                <h2>GRAPH</h2>
					                <div id="legend" class="test-history_legend">
						            
						            </div>
					                <br/><br/>
					                <div id="test-history_historyGraph" style="height:300px;border:1px solid #BFB092;">
					                	
					                </div>
					                
					                <?php echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'testHistory')));?>
					                <?php //secho $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;', 'name'=>'Save'));?>
					                <?php echo $this->Form->submit('Print',array('div'=>false, 'class'=>'printHistory','style'=>'margin-left:87%;', 'name="Print"'));?>
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
								<table id="common-tbl">
									<thead>
										<tr>
											<th>Clinic</th><th>Schedule</th><th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($branches)):?>
										
											<?php foreach($branches as $branch):?>
												<tr onclick="showClinic(<?php echo $branch['CompanyBranch']['id'];?>)">
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
														<a onclick="confirm('You are about to remove this clinic, continue?');">Remove</a>
													</td>
													
												</tr>
											<?php endforeach;?>
										<?php endif;?>
									</tbody>
								</table>
								<?php echo $this->Form->create('Clinic',array('class' => 'clinic-frm'));?>
								<div class="dim-box" >
									
									<table class="detail-tbl" id="double-td-tbl" style="display:none;">
										<tbody >
											<tr>
												<td colspan="3" ><?php echo $this->Form->radio('type',array(1=>'Hospital/Laboratory',2=>'Own Clinic'),array('label'=>false,'div'=>false,'legend'=>false,'before'=>'','after'=>'','between'=>'','separator'=>''));?></td>
											</tr>
										</tbody>
									</table>
									<hr style="background-color: #BFB092;margin:5px 0px;"/>
									<h3>Clinic Details</h3>
									
									
									<div style="display:inline-block;" align="center">
										<table class="detail-tbl" id="single-td-tbl-half" style="margin:0px;">
											<tbody>
												<tr>
													<td><label>Name:</label></td><td><?php echo $this->Form->input('name',array('label'=>false, 'type'=>'text','div'=>false));?></td>
												</tr>
												<tr>
													<td><label>Website:</label></td><td><?php echo $this->Form->input('website',array('label'=>false, 'type'=>'text','div'=>false));?></td>
												</tr>
											</tbody>
										</table>
										<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;margin:2px;">
										</div>
									</div>
									<table class="detail-tbl" id="single-td-tbl-half" style="display: inline-block;vertical-align: top;width:52%;">
										<tbody>
											<tr>
												<td><label>Branch Name:</label></td><td><?php echo $this->Form->input('branch',array('label'=>false, 'type'=>'select','div'=>false,'options' => array()));?></td>
											</tr>
											<tr>
												<td><label>Class:</label></td><td><?php echo $this->Form->input('class',array('label'=>false, 'type'=>'text','div'=>false));?></td>
											</tr>
											<tr>
												<td><label>Mission:</label></td><td><?php echo $this->Form->input('mission',array('label'=>false, 'type'=>'textarea','div'=>false,'style' => 'width:210px;height:40px;resize:none;padding:2px;','rows' => '3'));?></td>
											</tr>
											<tr>
												<td><label>Vision:</label></td><td><?php echo $this->Form->input('vision',array('label'=>false, 'type'=>'textarea','div'=>false,'style' => 'width:210px;height:40px;resize:none;padding:2px;','rows' => '3'));?></td>
											</tr>
										</tbody>
									</table>
									
									<hr style="background-color: #BFB092;margin:5px 0px;"/>
									<div id="google-map" style="border:1px solid #BFB092; width:280px;height:220px;float:right;margin:20px 10px 0 0;">
										<?php echo 'Google Map';?>
									</div>
									<table class="detail-tbl" id="single-td-tbl-half">
									
										<tr>
											<td><h3>Address</h3></td><td></td>
										</tr>
										<tr>
											<td><label>Province</label></td><td><?php echo $this->Form->input('province_state_id',array('label'=>false, 'type'=>'select','div'=>false,'options' => $provinces,'class' => 'address_select','title' => 'address_select_1','empty'=>true));?></td>
										</tr>
										<tr>
											<td><label>Town/City</label></td><td><?php echo $this->Form->input('town_city_id',array('label'=>false,'div'=>false,'type'=>'select','class' => 'address_select','title' => 'address_select_2','empty'=>true));?></td>
										</tr>
										<tr>
											<td><label>Barangay:</label></td><td><?php echo $this->Form->input('village_id',array('label'=>false,'div'=>false,'type'=>'select','class' => 'address_select','title' => 'address_select_3','empty'=>true));?></td>
										</tr>
										<tr>
											<td><label>Street:</label></td><td><?php echo $this->Form->input('street_number',array('label'=>false,'div'=>false));?></td>
										</tr>
										<tr>
											<td><label>Building:</label></td><td><?php echo $this->Form->input('building_apartment',array('label'=>false,'div'=>false));?></td>
										</tr>
										<tr>
											<td><label>Floor:</label></td><td><?php echo $this->Form->input('floor',array('label'=>false,'div'=>false));?></td>
										</tr>
										<tr>
											<td><label>Unit:</label></td><td><?php echo $this->Form->input('unit',array('label'=>false,'div'=>false));?></td>
										</tr>
									</table>
								</div>
								<table class="detail-tbl" id="double-td-tbl">
									<tr>
										<td><h3>Clinic Hours:</h3></td><td></td>
									</tr>
									<tr>
										<td><label>Monday:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
										<td><label>Friday:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Tuesday:</label></td><td><?php echo $this->Form->input('date_issue',array('label'=>false,'div'=>false));?></td>
										<td><label>Saturday:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Wednesday:</label></td><td><?php echo $this->Form->input('specialty',array('label'=>false,'div'=>false));?></td>
										<td><label>Sunday:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Thursday:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><h3>Contacts:</h3></td><td></td>
									</tr>
									<tr>
										<td><label>Telephone No.:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
										<td><label>Fax No.:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Mobile No.:</label></td><td><?php echo $this->Form->input('date_issue',array('label'=>false,'div'=>false));?></td>
										<td><label>Clinic Email Address:</label></td><td><?php echo $this->Form->input('prc_no',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
									<td><?php echo $this->Form->submit('EDIT CLINIC',array('div'=>false,'style'=>''));?></td>
									<td><?php echo $this->Form->submit('ADD CLINIC',array('div'=>false));?></td>
									</tr>
								</table>
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
<?php echo $this->element('sidebar');?>
<script>
	var insuranceProductProviders = <?php echo $this->Js->object($insuranceProviderProducts);?>;

	var historyHandler = function(event){
		jQuery('#'+event.data.divid+' input[type=radio]:first').click();
		jQuery(this).unbind('click',historyHandler);
	};
	
	jQuery(document).ready(function(){

		jQuery('#google-map').gmapplot();
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
		jQuery('#printHistoryPdf').click(function(){
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

			var formData = new FormData(jQuery('.patient_form')[0]);
			 
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			} else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("POST", "<?php echo $this->Html->url(array('controller'=>'Patients','action'=>'updateProfile'));?>", true);

			xmlhttp.setRequestHeader("X_REQUESTED_WITH", "XMLHttpRequest");
				
			xmlhttp.onreadystatechange = function(){ 

				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                	xmlDoc=xmlhttp.responseXML;
                    result = parseInt(xmlDoc.getElementsByTagName("result")[0].childNodes[0].nodeValue);
					if(result){
						alert('Your profile was successfully updated');
					}else{
						alert('An error ocurred while saving your profile, please try again.');
					}
                } else if(xmlhttp.readyState == 4)
                 	alert("Error: returned status code " + xmlhttp.status + " " + xmlhttp.statusText); 
            };
			xmlhttp.send(formData);
			event.preventDefault();
		});

		$uploadImageButton = jQuery(".browse_image").clone();
		$uploadImageButton.change(updateImagePreview);
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
							tr += '<tr onclick="showPatientProfile('+y['Person']['id']+')"><td>'+y['Person']['lastname']+', '+y['Person']['firstname']+' '+y['Person']['middlename']+'</td><td>'+data.Patient[x]['PatientBatchOrder']['confirmed_date']+'</td><td>'+y['Laboratory']['name']+'</td></tr>';
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
								laboratoryRows[x] += '<tr><td></td><td>'+data.TestGroup[z['PatientBatchOrderPackage']['test_group_id']]+'</td><td>'+z[0]['testgroup_count']+'</td>';  
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
							trs += '<tr><td>'+y['Person']['lastname']+', '+y['Person']['firstname']+' '+y['Person']['middlename']+'</td><td>'+data.Laboratory[y['LaboratoryPatientOrder']['laboratory_id']]+'</td><td>'+y['PatientBatchOrder']['confirmed_date']+'</td><td>'+data.TestGroup[y['PatientBatchOrderPackage']['test_group_id']]+'</td></tr>';
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
	updateImagePreview = function(event){
		uploadType = 2;
		files = event.target.files;
		for (var i = 0, f; f = files[i]; i++) {
	      if (!f.type.match('image.*')) {
	        continue;
	      }
	      var reader = new FileReader();
	      reader.onload = (function(theFile) {
	        return function(e) {
	        	datauri = e.target.result;
	        	jQuery('#idpic').attr('src',datauri);
	        };
	      })(f);
	      reader.readAsDataURL(f);
		}
	};

	function removeClinic(branchId){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'removeClinic'));?>',
			data:{'CompanyBranch':{'id':branchId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){
				if(data){
					alert('Removing clinic was successful.');
					jQuery('.clinic-list-tbl #'+branchId).remove();
				}else{
					alert('Removing clinic failed.');
				}
			}
		});
		
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

						trs += '<tr style="cursor:pointer;" class="testOrderDetailClass" onclick="showTestOrderDetail('+y['TestOrder']['id']+',\'patient-visit-view\')">';
						trs += '<td>';
						if(data['laboratories'][y['LaboratoryPatientOrder']['laboratory_id']] != undefined)
							trs += data['laboratories'][y['LaboratoryPatientOrder']['laboratory_id']];
						trs += '</td>';
						trs += '<td>'+y['TestOrder']['posted_datetime']+'</td>';

						trs += '<td>';
						if(data['testOrderPackages'][y['TestOrder']['id']] != undefined)
							testgroups = [];
							jQuery.each(data['testOrderPackages'][y['TestOrder']['id']],function(w,z){
								testgroups.push(z);
								});
							trs += testgroups.join(', ');
						trs += '</td>';

						trs += '</tr>';
						
					});
					jQuery('.patient-visits tbody').append(trs);
					showTestOrderDetail(data['testOrders'][0]['TestOrder']['id'],'patient-visit-view');
						
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
	</style>