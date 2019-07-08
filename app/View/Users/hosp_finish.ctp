<?php echo $this->Html->script('jquery-ui-personalized-1.5.2.packed.js');?>
<?php echo $this->Html->script('sprinkle.js');?>
<div class="content">

		<div id="tabvanilla" class="widget-result">
            <ul class="tabnav">
<!--                <li><a href="#report">MY REPORT</a></li>-->
                <li><a href="#profile">MY PROFILE</a></li>
            </ul>
<!--             <div id="report" class="tabdiv">-->
<!--				<div >-->
<!--					<h2>REPORTS</h2>-->
<!--						-->
<!--				</div>-->
<!--            </div>/report-->
            <div id="profile" class="tabdiv">
					<h2>PROFILE</h2>
					<div id="main-tab" class="widget-result">
						<ul class="tabnav">
			                <li><a href="#lab">LABORATORY</a></li>
			                <li><a href="#test">TEST</a></li>
			                <li><a href="#branch">BRANCHES</a></li>
			                <li><a href="#physician">PHYSICIAN</a></li>
			                <li><a href="#hmo">HMO</a></li>
			                <li><a href="#accreditation">ACCREDITATION</a></li>
			                <li><a href="#advertisement">ADVERTISEMENT</a></li>
		                  	<li><a href="#membership">MEMBERSHIP</a></li>
			            </ul>
						
						<div id="lab" class="tabdiv">
							<div id="lab-div">
									<?php $data = array('Sample 1','Sample 2','Sample 3');?>
									<?php $legend = array('legend'=>false);?>
								<br/>
								<h3>DETAILS</h3>
								<div class="lab-profile">
									<table class="detail-tbl" id="lab-profile-table" style="margin-bottom:0px;">
										<tr>
											<td><label>Laboratory Name: </labe/></td><td><?php echo $this->Form->input('laboratory_name',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:350px;'));?></td>
										</tr>
									</table>
									
									<table id="double-td-tbl" style="margin:0px;">
										<tr>
											<td><label>Administrator Lastname: </labe/></td><td><?php echo $this->Form->input('admin_last_name',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:150px;'));?></td>
											<td><label>Firstname: </labe/></td><td><?php echo $this->Form->input('admin_first_name',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:150px;'));?></td>
										</tr>
										<tr>
											<td><label>Website: </labe/></td><td><?php echo $this->Form->input('website',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:150px;'));?></td>
											<td><label>Classification: </labe/></td><td><?php echo $this->Form->input('classification',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:150px;'));?></td>
										</tr>
										
									</table>
									<div id="lab-profile-table" style="margin-bottom:0px;float:left;width:35%;">
											<label style="float:left;display: inline-block;vertical-align: top;margin-top: 25%;">Logo:</label><div style="width:150px;height:150px;border:1px solid #BFB092;float:left;"></div>
									</div>
									<div style="float:left;width:65%;">
											<label style="display: inline-block;vertical-align: top;margin-top: 6%;">Vision: &nbsp;</label/><?php echo $this->Form->textarea('vision',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:300px;height:40px;'));?><br/>
											<label style="display: inline-block;vertical-align: top;margin-top: 6%;">Mission: </label/><?php echo $this->Form->textarea('mission',array('label'=>false, 'type'=>'text','div'=>false,'style'=>'width:300px;height:40px;'));?>
									</div>
									
								</div>
								<div id="google-map" style="border:1px solid #BFB092; width:300px;height:320px;float:right;margin:20px 20px 0 0;">
									<?php echo 'Google Map';?>
								</div>
								<table class="detail-tbl" id="single-td-tbl-half">
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
									<td><?php echo $this->Form->submit('EDIT PROFILE',array('div'=>false,'style'=>''));?></td>
									</tr>
				            		<?php echo $this->Form->end();?>
								</table>
							</div>
						</div>
						<div id="test" class="tabdiv">
							<div id="test-div">
								<table id="common-tbl">
									<thead>
										<th>Test Set</th><th>Test Items</th><th>Price</th><th>Action</th>
									</thead>
									<tbody>
										<tr><td>CBC</td><td>Test1,Test2</td><td>Php750</td><td>Delete</td></tr>
										<tr><td>Chemistry</td><td>Test1,Test2</td><td>Php450</td><td>Delete</td></tr>
									</tbody>
								</table>
								<h3>DETAILS</h3>
								<?php $data = array('Sample 1','Sample 2','Sample 3');?>
								<?php $legend = array('legend'=>false);?>
								<table class="detail-tbl" id="single-td-tbl">
									<tr>
										<td><label>HMO:</label></td><td><?php echo $this->Form->input('hmo_detail',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Accreditation No.:</label></td><td><?php echo $this->Form->input('accreditation_nos',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Date of Joining:</label></td><td><?php echo $this->Form->input('entry_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Date of Renewal:</label></td><td><?php echo $this->Form->input('renewal_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Date of Expiration:</label></td><td><?php echo $this->Form->input('expiratio_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
									<td><?php echo $this->Form->submit('SAVE TEST',array('div'=>false,'style'=>''));?></td>
									<td><?php echo $this->Form->submit('ADD TEST',array('div'=>false));?></td>
									<?php echo $this->Form->end();?>
									</tr>
								</table>
								
							</div>
						</div>
						<div id="physician" class="tabdiv">
							<div id="physician-div">
								<table id="common-tbl">
									<thead>
										<th>Physician</th><th>Specialty</th><th>Clinic</th><th>Retainer</th><th>Action</th>
									</thead>
									<tbody>
										<tr><td>Edwin M. Dimailig</td><td>Neurology</td><td>St. Luke's Medical Center</td><td>5%</td><td>Edit Delete</td></tr>
										<tr><td>Ronan Colobong</td><td>Pediatrician</td><td>St. Luke's Medical Center</td><td>5%</td><td>Edit Delete</td></tr>
									</tbody>
								</table>
								<h3>DETAILS</h3>
								<?php $data = array('Sample 1','Sample 2','Sample 3');?>
								<?php $legend = array('legend'=>false);?>
								<table class="detail-tbl" id="single-td-tbl">
									<tr>
										<td><label>Physician:</label></td><td><?php echo $this->Form->input('hmo_detail',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Specialty:</label></td><td><?php echo $this->Form->input('accreditation_nos',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Email Address:</label></td><td><?php echo $this->Form->input('entry_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Hospital/CLinic:</label></td><td><?php echo $this->Form->input('renewal_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td rowspan="2"><label>Retainer:</label></td><td><?php echo $this->Form->radio('amount1',$legend,array('label'=>false,'div'=>false));?><?php echo '<label>Fixed Amount:</labe/>'.$this->Form->input('amountvalue1',array('label'=>false,'div'=>false,'style'=>'width:179px'));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->radio('amount2',$legend,array('label'=>false,'div'=>false));?><?php echo '<label>Percentage:</labe/>&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Form->input('amountvalue2',array('label'=>false,'div'=>false,'style'=>'width:179px'));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('SAVE PHYSICIAN',array('div'=>false,'style'=>''));?></td>
										<td><?php echo $this->Form->submit('ADD PHYSICIAN',array('div'=>false));?></td>
									<?php echo $this->Form->end();?>
									</tr>
								</table>
								
							</div>
						</div>
						<div id="accreditation" class="tabdiv">
							<div id="accreditation-div">
								<table id="common-tbl">
									<thead>
										<th>Accreditation</th><th>Accreditation No.</th><th>Date of Joining</th><th>Date of Expiration</th><th>Action</th>
									</thead>
									<tbody>
										<tr><td>Edwin M. Dimailig</td><td>Neurology</td><td>St. Luke's Medical Center</td><td>5%</td><td>Edit Delete</td></tr>
										<tr><td>Ronan Colobong</td><td>Pediatrician</td><td>St. Luke's Medical Center</td><td>5%</td><td>Edit Delete</td></tr>
									</tbody>
								</table>
								<h3>DETAILS</h3>
								<?php $data = array('Sample 1','Sample 2','Sample 3');?>
								<?php $legend = array('legend'=>false);?>
								<table class="detail-tbl" id="single-td-tbl">
									<tr>
										<td><label>Accreditation:</label></td><td><?php echo $this->Form->input('hmo_detail',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Accreditation No.:</label></td><td><?php echo $this->Form->input('accreditation_nos',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Date of Joining:</label></td><td><?php echo $this->Form->input('entry_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Date of Renewal:</label></td><td><?php echo $this->Form->input('renewal_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><label>Date of Expiration:</label></td><td><?php echo $this->Form->input('renewal_date',array('label'=>false,'div'=>false));?></td>
									</tr>
									<tr>
										<td><?php echo $this->Form->submit('SAVE ACCREDITATION',array('div'=>false,'style'=>''));?></td>
										<td><?php echo $this->Form->submit('ADD ACCREDITATION',array('div'=>false));?></td>
									<?php echo $this->Form->end();?>
									</tr>
								</table>
								
							</div>
						</div>
						<div id="membership" class="tabdiv">
							<div id="membership-div">
								<label>Membership Date: </label><?php echo $this->Form->input('membership_date',array('label'=>false,'div'=>false,'class'=>'single-input'));?><br/>
								<b>Accounting:</b><br/>
								<table id="common-tbl">
									<thead>
										<th>Bill No.</th><th>Details</th><th>Amount</th><th>Due Date</th><th>Status</th>
									</thead>
									<tbody>
										<tr><td>0002332</td><td>October Test Transaction</td><td>P10.00</td><td>15 Nov 2012</td><td>Paid</td></tr>
										<tr><td>03020302</td><td>Nov Advertisement</td><td>P20.00</td><td>20 Dec 2012</td><td>Paid</td></tr>
									</tbody>
								</table>
								<h3>DETAILS</h3>
								<?php $data = array('Sample 1','Sample 2','Sample 3');?>
								<?php $legend = array('legend'=>false);?>
								<div style="width:95%;margin-left:20px;">
									<label>Bill No: </label><?php echo $this->Form->input('membership_date',array('label'=>false,'div'=>false,'class'=>'single-input'));?><br/>
									<b>Details:</b><br/>
									<table id="common-tbl">
										<thead>
											<th>Items</th><th>Quantity</th><th>Price</th><th>Amaount</th>
										</thead>
										<tbody>
											<tr><td>October Test Transaction</td><td>1,000</td><td>P10.00</td><td>P10,000</td>
											<tr><td>November Test Transaction</td><td>2,000</td><td>P20.00</td><td>P20,000</td>
										</tbody>
									</table>
									<label>Due Date: </label><?php echo $this->Form->input('due_date',array('label'=>false,'div'=>false,'class'=>'single-input'));?><br/>
									<label>Status: </label><?php echo $this->Form->select('status',$data,$legend,array('label'=>false,'div'=>false,'class'=>'single-select'));?><br/>
									<?php echo $this->Form->submit('SAVE ACCOUNTING',array('div'=>false,'style'=>''));?>
									<?php echo $this->Form->end();?>
								</div>
								
							</div>
						</div>
					</div>
            </div><!--/profile-->

        </div><!--/widget-->
 </div>       

<?php echo $this->element('sidebar');?>
<script>
	jQuery(document).ready(function(){
		jQuery('.current-crumb').append(' MEMBER ACCOUNT');
		jQuery('.single-input').css({'width':'200px','padding':'5px','height':'15px','margin':'1px'});
		jQuery('select').css({'width':'211px','padding':'5px','margin':'1px'});
	});
</script>
