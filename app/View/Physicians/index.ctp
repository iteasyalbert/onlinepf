<script>
	var uploadType = 0;
	var $uploadImageButton;
</script>
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
					<?php echo $this->Form->input('result_online_id',array('label'=>false,'type'=>'text','div'=>false,'value'=>'myResultOnlineID','class'=>'labeled','title'=>'myResultOnlineID'));?>
					<?php echo $this->Form->input('last_name',array('label'=>false,'div'=>false,'value'=>'Lastname','class'=>'labeled','title'=>'Lastname'));?>
					<?php //echo $this->Form->input('first_name',array('label'=>false,'div'=>false,'value'=>'Firstname','class'=>'labeled','title'=>'Firstname'));?>
					<?php echo $this->Form->submit('Search Patient',array('div'=>false,'class'=>'search-patient-btn'));?>
					<?php echo $this->Form->end();?>
					<br/>
                	<table id="common-tbl" class="patient_search">
                		<thead>
                			<th>Name</th><th>Date</th><th>Laboratory</th><th>Test</th>
                		</thead>
                		<tbody>
                		</tbody>
                	</table>
                	
                	<div id="photo" style="border:1px solid #BFB092; width:140px;height:140px;float:right;margin:10px 20px 0 0;">
						<?php echo $this->Html->image('male.jpg',array('style'=>'width:140px;height:140px;'));?>
					</div>
               		 
                	<div id="patient-profile-div">
	                	<table id="single-td-tbl">
	                	<?php echo $this->Form->create('Patient');?>
	                	<tr><td><h2>PROFILE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2></td><td></td></tr>
						<tr><td><label>ID:</label></td><td><?php echo $this->Form->input('id',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
						<tr><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?></td></tr>
						<tr><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Address:</label></td><td><?php echo $this->Form->input('address',array('label'=>false,'div'=>false));?></td></tr>
						<?php echo $this->Form->end(array('type'=>'hidden'));?>
						</table>
					
						<h2>TEST RESULTS</h2>
						<div id="main-tab" class="widget-result">
							<ul class="tabnav">
				                <li><a href="#visits">VISITS</a></li>
				                <li><a href="#history">HISTORY</a></li>
				            </ul>
		                	 <div id="visits" class="tabdiv">
		                	 	<table id="common-tbl">
			                		<thead>
			                			<th>Name</th><th>Date</th><th>Laboratory</th><th>Test</th>
			                		</thead>
			                		<tbody>
			                		</tbody>
			                	</table>
			                	<div style="height:300px;border:1px solid #BFB092;">
                		
                				</div>
                				<?php echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php echo $this->Form->submit('Print',array('div'=>false));?>
            				     <?php echo $this->Form->end();?>
		                	 </div>
		                	 <div id="history" class="tabdiv">
		                	 	<h2>HISTORY</h2>
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
				            	<?php if(isset($testOrders) && !empty($testOrders)):?>
					                <table id="common-tbl">
					                	<thead>
					                		<tr>
						                		<th>Date</th><th>Laboratory</th><th>Test</th>
					                		</tr>
					                	</thead>
					                	<tbody>
					                		<?php
					                		$firstTestOrder = null;
					                		
						                		foreach($testOrders as $visit):?>
						                			<tr style="cursor:pointer;" onclick="showTestOrderDetail('<?php echo $visit['LaboratoryTestOrder']['id'];?>')">
						                				<td><?php echo date('F d,Y H:i:s',strtotime($visit['LaboratoryTestOrder']['posted_datetime']));?></td>
						                				<td><?php echo $laboratories[$visit['LaboratoryPatientOrder']['laboratory_id']];?></td>
						                				<td>
						                					
						                					<?php
					///	                						debug($visit);
																if(is_null($firstTestOrder))
																	$firstTestOrder =  $visit['LaboratoryTestOrder']['id'];
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
				                <?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdf','style'=>'margin-left:77.5%;'));?>
				                <?php echo $this->Form->end();?>
			            </div><!--/visits-->
			            
			            <div id="physician-history" class="tabdiv">
			                <div id="history-div">
			                	<h2>TEST HISTORY</h2>
			                	<?php if(!empty($testGroups)):?>
				                	<?php $group = $testGroups;?>
				                	<?php echo $this->Form->radio('group_name', $testGroups, array('legend'=>false,'onclick' => 'showTestHistory(this);'));?>
				                	<div id="test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
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
								<?php echo $this->Form->create(null,array());?>
								<?php $lab = array('All','Lakambini','EAMC','UDL');?>
								<?php $test = array('All','CBC','PT/PTT','Chemistry');?>
								<?php $legend = array('legend'=>false);?>
								<table id="double-td-tbl">
									<tr>
										<td><span>Start Date: </span><?php echo $this->Form->input('start_date',array('label'=>false,'div'=>false));?></td>
										<td><span>End Date: </span><?php echo $this->Form->input('end_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><span>Laboratory: </span><?php echo $this->Form->select('laboratory',$lab,$legend,array('label'=>false,'div'=>false));?></td>
										<td><span>Test:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->select('test',$test,$legend,array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('Generate');?></td><td></td>
									</tr>
								</table>
								<table id="common-tbl">
									<thead>
										<th>No. of Prescription</th><th>10</th>
									</thead>
									<tbody>
										<tr><td>Laboratory 1</td><td>10</td></tr>
										<tr><td>Test 1</td><td>10</td></tr>
									</tbody>
								</table>
								<?php //echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php //echo $this->Form->submit('Print',array('div'=>false));?>
            				     <?php //echo $this->Form->end();?>
								
							</div>
							<div id="patient-lists" class="tabdiv">
								<h3>PATIENT'S LIST</h3>
								<?php echo $this->Form->create(null,array());?>
								<?php $prov = array('All','Nueva Ecija','Isabela','Metro Manila');?>
								<?php $city = array('All','Quezon City','San Jose','Makati');?>
								<?php $brgy = array('All','Bahayan','Manggahan','Pinyahan');?>
								<?php $legend = array('legend'=>false);?>
								<table id="double-td-tbl">
									<tr>
										<td><span>Start Date: </span><?php echo $this->Form->input('start_date',array('label'=>false,'div'=>false));?></td>
										<td><span>End Date: &nbsp;&nbsp;</span><?php echo $this->Form->input('end_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><span>Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('gender',array('label'=>false,'div'=>false));?></td>
										<td><span>Age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->input('barangay',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><span>Province: &nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->select('province',$prov,$legend,array('label'=>false,'div'=>false));?></td>
										<td><span>Town/City: </span><?php echo $this->Form->select('city',$city,$legend,array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><span>Barangay:&nbsp;&nbsp;&nbsp;</span><?php echo $this->Form->select('barangay',$brgy,$legend,array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('Generate');?></td><td></td>
									</tr>
								</table>
								<table id="common-tbl">
									<thead>
										<th>Name</th><th>Date of Register0</th><th>Province</th><th>Town/City</th><th>Gender</th><th>Birthday</th><th>Age</th>
									</thead>
									<tbody>
										<tr><td>Aljohn Tolin</td><td>10 Jan 2012</td><td>Nueva Ecija</td><td>Pinagbugto</td><td>Male</td><td>Birthday</td><td>54</td></tr>
										<tr><td>Christian Santos</td><td>10 Jan 2012</td><td>Nueva Ecija</td><td>Pinagbugto</td><td>Male</td><td>Birthday</td><td>54</td></tr>
									</tbody>
								</table>
								<?php //echo $this->Form->submit('Export',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php //echo $this->Form->submit('Print',array('div'=>false));?>
            				     <?php //echo $this->Form->end();?>
							</div>
							<div id="prescriptions" class="tabdiv">
							<h3>PRESCRIPTION'S LIST</h3>
								<table id="double-td-tbl">
									<tr>
										<td><span>Start Date: </span><?php echo $this->Form->input('start_date',array('label'=>false,'div'=>false));?></td>
										<td><span>End Date: </span><?php echo $this->Form->input('end_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('Generate');?></td><td></td>
									</tr>
								</table>
								<table id="common-tbl">
									<thead>
										<th>Name</th><th>Date of Register0</th><th>Province</th><th>Town/City</th><th>Gender</th><th>Birthday</th><th>Age</th>
									</thead>
									<tbody>
										<tr><td>Aljohn Tolin</td><td>10 Jan 2012</td><td>Nueva Ecija</td><td>Pinagbugto</td><td>Male</td><td>Birthday</td><td>54</td></tr>
										<tr><td>Christian Santos</td><td>10 Jan 2012</td><td>Nueva Ecija</td><td>Pinagbugto</td><td>Male</td><td>Birthday</td><td>54</td></tr>
									</tbody>
								</table>
								<?php echo $this->Form->submit('Export',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;'));?>
            				    <?php echo $this->Form->submit('Print',array('div'=>false));?>
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
								<tr><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
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
										<th>Clinic</th><th>Schedule</th><th>Action</th>
									</thead>
									<tbody>
										<tr><td>East Avenue Medical Center</td><td>MWFS 2PM-5PM</td><td>Delete</td></tr>
										<tr><td>Philippine</td><td>TTH 10AM-12N</td><td>Delete</td></tr>
									</tbody>
								</table>
								<h3>DETAILS</h3>
								<?php $data = array('Sample 1','Sample 2','Sample 3');?>
								<?php $legend = array('legend'=>false);?>
								<div id="google-map" style="border:1px solid #BFB092; width:280px;height:285px;float:right;margin:20px 10px 0 0;">
									<?php echo 'Google Map';?>
								</div>
								<table class="detail-tbl" id="single-td-tbl-half">
									<tr>
										<td><label>Hospital/Clinic:</label></td><td><?php echo $this->Form->input('hospital',array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><h3>Address</h3></td><td></td>
									</tr>
									<tr>
										<td><label>Province</label></td><td><?php echo $this->Form->select('province',$data,$legend,array('label'=>false, 'type'=>'text','div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Town/City</label></td><td><?php echo $this->Form->select('city',$data,$legend,array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Barangay:</label></td><td><?php echo $this->Form->select('brgy',$data,$legend,array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>No./Street:</label></td><td><?php echo $this->Form->input('street',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Zip Code:</label></td><td><?php echo $this->Form->select('zip_code',$data,$legend,array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Building:</label></td><td><?php echo $this->Form->input('building',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Room No.:</label></td><td><?php echo $this->Form->input('room_no',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Department:</label></td><td><?php echo $this->Form->input('department',array('label'=>false,'div'=>false));?></td>
									</tr>
								</table>
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
													
													<td class= "hmo_insurance_provider"><?php echo $this->Form->input('InsuranceProviderProduct.id',array('type'=> 'hidden','value' =>$hmo['InsuranceProvider']['id']));echo '<p>'.$hmo['InsuranceProvider']['name'].'</p>';?></td>
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
								<table id="common-tbl">
									<thead>
										<th>HMO</th><th>Accreditation No.</th><th>Date of Joining</th><th>Date of Expiration</th><th>Action</th>
									</thead>
									<tbody>
										<tr><td>Philhealth</td><td>122234-343</td><td>01 Jan 2012</td><td>01 Jan 2012</td><td>Delete</td></tr>
										<tr><td>MaxiCare</td><td>23434-34434</td><td>01 Jan 2012</td><td>01 Jan 2012</td><td>Delete</td></tr>
									</tbody>
								</table>
								<table id="single-td-tbl">
									<tr><td><h3>DETAILS</h3></td><td></td></tr>
									<tr><td><label>Organization:</label></td><td><?php echo $this->Form->input('organization',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
									<tr><td><label>Date of Membership:</label></td><td><?php echo $this->Form->input('membership_date',array('label'=>false,'div'=>false));?></td></tr>
									<tr><td><?php echo $this->Form->submit('SAVE ORGANIZATION');?></td><td><?php echo $this->Form->submit('ADD ORGANIZATION');?></td></tr>
				            	</table>
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

	var historyHandler = function(){
		jQuery('#history-div input[type=radio]:first').click();
		jQuery(this).unbind('click',historyHandler);
	};
	
	jQuery(document).ready(function(){

		jQuery('.patient_search').hide();
		
		jQuery('#open-photo').click(function(){
			jQuery(".browse_image").click();
		});
		
		jQuery('.current-crumb').append(' MEMBER ACCOUNT');

		jQuery('#take-photo').click(function(){8
			jQuery( "#webcam-dialog" ).dialog('open');
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
						if(id.length){
							input = [];
							jQuery('.HMO_fields input[type=text],select').each(function(x,y){
								input[x] = (this.nodeName.toLowerCase() == 'input')?jQuery(this).val():jQuery(this).find('option:selected').text();
							});
							jQuery('#hmo_'+id).find('p').each(function(x,y){
								jQuery(this).html(input[x]);
							});
						}else{
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
							jQuery('.hmo_list').append(tr);
						}
					}else{
						alert('Saving insurance fail, please try again stupid!');
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
			showTestOrderDetail('<?php echo $firstTestOrder;?>');
			showTestOrderId('<?php echo $firstTestOrder;?>');
		<?php endif;?>
		jQuery('a[href=#physician-history]').bind('click',historyHandler);

		jQuery('.search-patient-btn').click(function(){
			alert(jQuery('.search-patient-frm').serialize());
			return false;
		});
		
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
			if(inputClass=='hmo_insurance_provider')
				jQuery(this).triggerHandler('change');
			
		});
		jQuery('.hmo_id').val(jQuery(button).parent().parent().attr('id').replace('hmo_',''));
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

	function showTestOrderDetail(testOrderId){
		jQuery('#printPdf').attr('value', '/Patients/print_pdf/'+testOrderId+'.pdf');
		jQuery('#printPdf').attr('onclick', "showTestOrderId('"+testOrderId+"')");
		jQuery('#print').attr('href', '/Patients/print_pdf/'+testOrderId+'.pdf');
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'testOrderDetail'));?>',
			data:{'LaboratoryTestOrderId':testOrderId},
			type: 'POST',
			dataType : 'html',
			success:function(data){
				jQuery('#visits-view').html(data);
			}
		});
	}
	function showTestOrderId(testOrderId){
		testGroupIds = {};
		jQuery('.print_selections').empty();
		jQuery('.test_group_detail').each(function(){
			$tgtr = jQuery(this).find('.test_group');
			groupid = $tgtr.attr('id');
			grpi = jQuery(this).find('.test_group_index');
			groupindex = grpi.attr('id');
			groupname = $tgtr.html();
			jQuery('.print_selections').append(
				'<div class="testGroup">'
					+'<div class="input checkbox">'
						+'<input type="hidden" value="0" id="TestResult'+groupindex+'LaboratoryTestGroupPrint_" name="data[TestResult]['+groupindex+'][TestGroup][print]">'
						+'<input type="checkbox" id="TestResult'+groupindex+'LaboratoryTestGroupPrint" value="1" name="data[TestResult]['+groupindex+'][TestGroup][print]" style="margin-top: 10px;">'
						+'<input type="hidden" value="'+groupid+'" name="data[TestResult]['+groupindex+'][id]">'
							+'<label for="TestResult'+groupindex+'LaboratoryTestGroupPrint" style="font-weight: bold;">'+groupname+'</label>'
					+'</div>'
				+'</div>'
			);
			jQuery(this).find('tbody tr').each(function(){
				testid = jQuery(this).attr('id');
				testname = jQuery(this).find('.name').html();
				testindex = jQuery(this).find('.name').attr('id');
				jQuery('.print_selections').append(
					'<div class="input checkbox">'
						+'<input type="hidden" value="0" id="TestResult'+groupid+'LaboratoryTestOrderDetail'+testindex+'LaboratoryTestCodePrint_" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][TestCode][print]">'
						+'<input type="checkbox" id="TestResult'+groupid+'LaboratoryTestOrderDetail'+testindex+'LaboratoryTestCodePrint" value="1" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][TestCode][print]" style="margin-left: 10px;">'
						+'<input type="hidden" value="'+testid+'" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][id]">'
						+'<label for="TestResult'+groupid+'LaboratoryTestOrderDetail'+testindex+'LaboratoryTestCodePrint">'+testname+'</label>'
					+'</div>'
				);
				jQuery('.testgroup-dialog input').attr('checked','checked');
			});
		});
	}
	function showTestHistory(testGroupRadio){
		testGroupId = jQuery(testGroupRadio).val();
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'testHistory'));?>',
			data:{'LaboratoryTestGroupId':testGroupId},
			type: 'POST',
			dataType : 'html',
			asynch:false,
			success:function(data){
				jQuery('#test-history').html(data);
			}
		});
	}
</script>
 