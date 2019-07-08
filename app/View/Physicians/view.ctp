<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=PH"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->Html->script('gmapplot');?>
<div class="content content-full-width">
	<div class="post-8 page type-page status-publish hentry" id="post-8">
		<?php //debug($person);?>
		<h1><?php echo $person['Person']['lastname'].', '.$person['Person']['firstname'];?></h1>
		<div class="column one-third  " id="ayurveda" style="border:solid 1px #634e37">
		<img alt="" width="300" src="<?php echo (!empty($person['Image']['image']))?"/media/profiles/".$person['Image']['image']:'/img/male.jpg';?>" title="popular-procedure-ayurveda-main" class="alignnone size-full wp-image-666">
			<div class="box-content-with-design ">
				<?php if(isset($personMajors[$person['Person']['id']])):?>
				<h3 style="margin-bottom: 0;">Specialty</h3>
					<ul style="list-style: none">
						<?php foreach($personMajors[$person['Person']['id']] as $major):?>
							<li>
								<?php echo $major;?>
							</li>
						<?php endforeach;?>
					</ul>
				<?php endif;?>
				<hr style="margin-bottom:5px;" />
				<?php if(isset($physicianProfile['PhysicianProfile']['key_competencies'])):?>
					<h3 style="margin-bottom: 0;">Key Competence and Skills</h3>
					<br />
					<?php echo $physicianProfile['PhysicianProfile']['key_competencies'];?>
				<?php endif;?>
				<hr style="margin-bottom:5px;" />
				<?php if(isset($physicianProfile['PhysicianProfile']['key_competencies'])):?>
					<h3 style="margin-bottom: 0;">Personal Experience</h3>
					<br />
					<?php echo $physicianProfile['PhysicianProfile']['practice_profile'];?>
				<?php endif;?>
			</div>
		</div>
		<div class="column" style="width:60%;">
			<h4 class="title"><span>Hospital / clinic</span></h4>
			<table>
				<thead>
					<tr>
						<th style="width:22%;">
							Name
						</th>
						<th style="width:22%;">
							Address
						</th>
						<th style="width:22%;">
							Contact Information
						</th>
						<th style="width:22%;">
							Schedule
						</th>
					</tr>
				</thead>
				<tbody>
			<?php
				$clinics = array();
				if(isset($companyMembers[$physician['Physician']['users_id']])):
					foreach($companyMembers[$physician['Physician']['users_id']] as $membership):
						$clinic = array();
			?>
						
				
					<tr>
						<td>
							<?php echo $membership['CompanyBranch']['name'];?>
						</td>
						<td>
							<?php
								if(isset($companyAddresses[$membership['CompanyBranch']['id']]) && isset($addresses[$companyAddresses[$membership['CompanyBranch']['id']]['CompanyBranchAddress']['address_id']])){
									$address = $addresses[$companyAddresses[$membership['CompanyBranch']['id']]['CompanyBranchAddress']['address_id']];
									$address['Address'] = array_filter($address['Address'],'strlen');
									
									$clinic = array(
								 		'lat' =>$address['Address']['latitude'],
										'lng' => $address['Address']['longtitude'],
										'title' => $membership['CompanyBranch']['name'],
										'color'=>'red'
									);
									
									unset($address['Address']['id']);
									unset($address['Address']['latitude']);
									unset($address['Address']['longtitude']);
									
									$compAddress = implode(', ',$address['Address']).','.(isset($address['VillageCode']['name'])?$address['VillageCode']['name'].',':'').(isset($address['TownCityCode']['name'])?$address['TownCityCode']['name'].',':'').(isset($address['ProvincesStatesCode']['name'])?$address['ProvincesStatesCode']['name'].',':'');
									echo $compAddress;
									
									$clinic['content'] = '<b>'.$membership['CompanyBranch']['name'].'</b><br />'.$compAddress."<br />";
								}
							?>
						</td>
						<td>
							<ul>
								<?php if(isset($companyContacts[$membership['CompanyBranch']['id']])):?>
									<?php
										$contactArrs = array();
										$key = -1;
									?>
									<?php foreach($companyContacts[$membership['CompanyBranch']['id']] as $contact):?>
										<?php $contactArrs[] = ((++$key != 0)?((($key % 4) == 0) ? "<br />" : "" ):"").substr($contactTypes[$contacts[$contact]['type']],0,($contacts[$contact]['type'] == 4)?5:3).": ".$contacts[$contact]['contact'];?>
										<li><?php echo substr($contactTypes[$contacts[$contact]['type']],0,3);?>: <?php echo $contacts[$contact]['contact'];?></li>
									<?php endforeach;?>
									<?php
										if(!empty($clinic))
											$clinic['content'] .= "<span>".implode(", ",$contactArrs)."</span>";
									?>
								<?php endif;?>
							</ul>
						</td>
						<td>
							<ul>
							<?php if(isset($companyMemberDuties[$membership['CompanyBranchMember']['id']])):?>
								<?php foreach($companyMemberDuties[$membership['CompanyBranchMember']['id']] as $duty):?>
									<li><?php echo substr($days[$duty['CompanyBranchMemberDuty']['day']],0,3)." ".date('H:i',strtotime($duty['CompanyBranchMemberDuty']['start_time']))."-".date('H:i',strtotime($duty['CompanyBranchMemberDuty']['end_time']));?></li>
								<?php endforeach;?>
							<?php endif;?>
							</ul>
						</td>
					</tr>
				</tbody>
			<?php
						$clinic['content'] .= "<br /><span class='sub-title'>".$this->Html->link('View Details','/laboratory/'.$membership['CompanyBranch']['id'].'/'.Inflector::slug($membership['CompanyBranch']['name']),array('target' =>'_blank','style' => 'font-size:10px;'))."</span>";
						array_push($clinics,$clinic);
					endforeach;
				endif;
			?>
			</table>
			<?php if(isset($personInsurances) && !empty($personInsurances)):?>
				<h4 class="title"><span>HMO</span></h4>
				<ul>
					<?php foreach($personInsurances as $hmo):?>
						<li><?php echo $hmo['InsuranceProviderProduct']['name'];?></li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
			
			<?php if(isset($personAffiliations) && !empty($personAffiliations)):?>
				<h4 class="title"><span>Affiliations / Organizations / Associations</span></h4>
				<ul>
					<?php foreach($personAffiliations as $aff):?>
						<li><?php echo $aff['OrganizationsAffiliation']['name'];?></li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
			<div id="mymap" style="width:100%;height:300px;border:solid 1px #000;">
			</div>
		</div>
		<?php //echo $this->element('sidebar');?>
		<div class="hr "></div>
	</div>
 </div>
 <script>
	jQuery(document).ready(function(){
		jQuery('h4.title').css({'margin':'10px 0 15px 0'});
		<?php if(isset($clinics)):?>
			jQuery('#mymap').gmapplot({
				selectable_location:false,
				resizable:true,
				list_location:true,
				list_location_title:"Clinics",
				mapOptions:{
					mapTypeId: google.maps.MapTypeId.ROADMAP,
				    mapTypeControl: true,
				    mapTypeControlOptions: {
				        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				        position: google.maps.ControlPosition.TOP_CENTER
				    },
				    panControl: true,
				    zoomControl: true,
				    zoomControlOptions: {
				        style: google.maps.ZoomControlStyle.LARGE,
				        position: google.maps.ControlPosition.LEFT_CENTER
				    },
				    streetViewControl: false
				}
			});
		 	jQuery('#mymap').gmapplot('plot',<?php echo $this->Js->object($clinics);?>);
		<?php endif;?>
	});
 </script>