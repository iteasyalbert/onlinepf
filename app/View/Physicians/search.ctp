<style>
	.menu-details h1, .menu-details h2,.menu-details h3,.menu-details h4,.menu-details h5,.menu-details h6 {
		color:#4e4635 !important;
	}
</style>

<div class="content menu-items-list content-full-width">
	<?php $this->Html->script('http://maps.google.com/maps/api/js?sensor=true',  false); ?>
	<?php echo $this->element('sidebar');?>
	<div class="column three-fourth">
		<h1>List of Doctors</h1>
		<?php
			$defHmo = '';
			$defTown = '';
			$defVill = '';
			$defProv = '';
			if(!empty($defaultProvince) || !empty($defaultTown) || !empty($defaultVillage) || !empty($defaultHmo)){
				$defProv = $defaultProvince;
				$defTown = $defaultTown;
				$defVill = $defaultVillage;
				$defHmo = $defaultHmo;
			}
		
		?>
		<?php echo $this->Form->create(NULL,array('url'=>array('controller'=>'Physicians','action'=>'search'),'class' => 'physician-fltr'));?>
		<h2 style="width: 50px;">Filter</h2>
		<table style="float:right;">
			<tr>
				<td>Province</td>
				<td><?php echo $this->Form->input('Address.province_state_id',array('type'=>'select','title'=>'address_select_1','options'=>$provinces,'empty'=>'','label'=>false,'style'=>'width:150px;','class' => 'address_select','default'=>$defProv));?></td>
				<td>Town/City</td>
				<td><?php echo $this->Form->input('Address.town_city_id',array('type'=>'select','title'=>'address_select_2','options'=>$townCities,'empty'=>'','label'=>false,'style'=>'width:150px;','class'=>'address_select','default'=>$defTown));?></td>
				<td>Barangay</td>
				<td><?php echo $this->Form->input('Address.village_id',array('type'=>'select','title'=>'address_select_3','options'=>$villages,'empty'=>'','label'=>false,'style'=>'width:150px;','class'=>'address_select','default'=>$defVill));?></td>
			</tr>
			<tr style="height:50px;">
				<td>HMO</td>
				<td><?php echo $this->Form->input('InsuranceProviderProduct.id',array('type'=>'select','id'=>'hmo','options'=>$insuranceProducts,'empty'=>'','label'=>false,'style'=>'width:150px;','default'=>$defHmo));?></td>
				<td>Specialty</td>
				<td><?php echo $this->Form->input('PersonEducationalBackground.education_major_id',array('type'=>'select','id'=>'specialty','options'=>$specialties,'empty'=>'','label'=>false,'style'=>'width:150px;'));?>
					<?php echo $this->Form->input('User.role',array('type'=>'hidden','id'=>'role','value'=>'6','label'=>false,'style'=>'width:150px;'));?>
				</td>
				<td>Hospital/Clinic</td>
				<td>
					<?php echo $this->Form->input('CompanyBranch.id',array('type'=>'select','id'=>'laboratory','options'=>$laboratories,'empty'=>'','label'=>false,'style'=>'width:150px;'));?>
				</td>
			</tr>
			<tr>
				<td colspan="5" style="margin-top:10px;" valign="bottom"><h2 class="menu-title" style="margin-bottom: 3px; font-size: 18px; color: green; margin-top:10px;"><span><?php echo count($personIdentities).' Physician'.((count($personIdentities) > 1)?"s":"");?> Filtered.</span></h2></td>
				<td style="margin-top:10px;"><?php echo $this->Form->submit('               Submit               ',array('style'=>'padding: 1px 5px; font-size: 15px; margin:0px 35px 0 0; float:left;'));?></td>
			</tr>
		</table>
		<?php
		
		echo $this->Form->end();
			
			$letter='';
			$newletter='';
			$divnum=1;
			?><div class="menu-list" style="margin: 0px;"><?php
			foreach($personIdentities as $displayKey=>$displayValue):
				$letter = $displayValue['Person']['lastname'][0];
				$lower = strtolower($letter);
				$upper = strtoupper($letter);
				if($newletter<>$lower && $newletter<>$upper){
					?><div id="<?php echo $letter;?>" class="menu-list" style="margin: 30px 0px 0px 0px;"><h2><?php echo $upper;?></h2></div>
					
					<div class="column one-half">
						<div class="menu-image">
							<span class="border " style="width: 100px;">
							<a href="<?php echo '/doctor/'.$displayValue['Person']['id'].'/'.Inflector::slug($displayValue['Person']['lastname']);?>">
								<img src="<?php echo (!empty($displayValue['Image']['image']))?"/media/profiles/".$displayValue['Image']['image']:'/img/male.jpg';?>" alt="<?php echo $displayValue['Person']['lastname'].', '.$displayValue['Person']['firstname'];?>" style="height: 100px; width: 100px;">
							</a>
							</span>
						</div>
						<div class="menu-details"  style=" margin: 0 0 0 0px; width: 60%;">
							<table style="font-size: 11px; margin:0px;">
								<tr>
									<td colspan="2" style="border-bottom:solid 1px #999;">
										<h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px;"><span><?php echo $this->Html->link($displayValue['Person']['lastname'].', '.$displayValue['Person']['firstname'],'/doctor/'.$displayValue['Person']['id'].'/'.Inflector::slug($displayValue['Person']['lastname']));?></span></h2>
									</td>
								</tr>
								<?php
									if(isset($personMajors[$displayValue['Person']['id']])):
								?>
									<tr>
										<td colspan="2" style="padding:5px;">
											<p style="margin:3px;line-height:18pt">
												<h5 style="margin:0px"><b>Specialties:</b></h5>
												<ul style="margin:0px;padding:0px;">
													<?php
															foreach($personMajors[$displayValue['Person']['id']] as $major):?>
															<li style="padding:0px;"><?php echo $major;?></li>
													<?php
															endforeach;
													?>
												</ul>
											</p>
										</td>
									</tr>
								<?php endif;?>
								<?php if(isset($companyMembers[$displayValue['Physician']['users_id']])):
									foreach($companyMembers[$displayValue['Physician']['users_id']] as $membership):
								?>
									<tr>
										<td colspan="2" style="padding:5px;">
											<hr style="margin:0px;" />
											<p style="margin:3px;line-height:18pt"><h5 style="margin-bottom:3px"><b><?php echo $membership['CompanyBranch']['name'];?></b></h5>
												<?php
													if(isset($companyAddresses[$membership['CompanyBranch']['id']]) && isset($addresses[$companyAddresses[$membership['CompanyBranch']['id']]['CompanyBranchAddress']['address_id']])){
														$address = $addresses[$companyAddresses[$membership['CompanyBranch']['id']]['CompanyBranchAddress']['address_id']];
														$address['Address'] = array_filter($address['Address'],'strlen');
														echo '<b>Address:</b><br>'/*.implode(', ',$address['Address']).','*/.(isset($address['VillageCode']['name'])?$address['VillageCode']['name'].',':'').(isset($address['TownCityCode']['name'])?$address['TownCityCode']['name'].',':'').(isset($address['ProvincesStatesCode']['name'])?$address['ProvincesStatesCode']['name'].',':'').'<br />';
													}
												?>
												<b>Schedules:</b><br>
												<?php
													if(isset($companyMemberDuties[$membership['CompanyBranchMember']['id']])){
														$scheds = array();
														foreach($companyMemberDuties[$membership['CompanyBranchMember']['id']] as $duty){
															$scheds[] = $days[$duty['CompanyBranchMemberDuty']['day']]." ".date('H:i',strtotime($duty['CompanyBranchMemberDuty']["start_time"]))."-".date('H:i',strtotime($duty['CompanyBranchMemberDuty']["end_time"]));
														}
														echo implode(', ',$scheds);
													}
												?>
											</p>
										</td>
									</tr>
								<?php
									endforeach;
								endif;?>
							</table>
						</div>
						
						<div class="hr "></div>
						
						<?php $divnum=1;?>
						
					</div>
					<?php
					$newletter=$letter;
				}
				else{
					if($divnum==1){
						?><div class="column one-half last"><?php
						$divnum=2;
					}
					else{
						?><div class="column one-half"><?php
						$divnum=1;
					}
					?>
						<div class="menu-image">
							<span class="border " style="width: 100px;">
<!--								<img src="<?php echo (!empty($displayValue['Person']['image']))?"/media/profiles/".$displayValue['Person']['image']:'/img/male.jpg';?>" alt="<?php echo $displayValue['Person']['lastname'].', '.$displayValue['Person']['firstname'];?>" style="height: 100px; width: 100px;">-->
							<a href="<?php echo '/doctor/'.$displayValue['Person']['id'].'/'.Inflector::slug($displayValue['Person']['lastname']);?>">
							<img src="<?php echo (!empty($displayValue['Image']['image']))?"/media/profiles/".$displayValue['Image']['image']:'/img/male.jpg';?>" alt="<?php echo $displayValue['Person']['lastname'].', '.$displayValue['Person']['firstname'];?>" style="height: 100px; width: 100px;">
							</a>
							</span>
						</div>
						<div class="menu-details" style=" margin: 0 0 0 0px; width: 60%;">
							<table style="font-size: 11px; margin:0px;">
								<tr>
									<td colspan="2" style="border-bottom:solid 1px #999;">
										<h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px;"><span><?php echo $this->Html->link($displayValue['Person']['lastname'].', '.$displayValue['Person']['firstname'],'/doctor/'.$displayValue['Person']['id'].'/'.Inflector::slug($displayValue['Person']['lastname']));?></span></h2>
									</td>
								</tr>
								<?php
									if(isset($personMajors[$displayValue['Person']['id']])):
								?>
									<tr>
										<td colspan="2" style="padding:5px;">
											<p style="margin:3px;line-height:18pt">
												<h5 style="margin:0px"><b>Specialties:</b></h5>
												<ul style="margin:0px;padding:0px;">
													<?php
															foreach($personMajors[$displayValue['Person']['id']] as $major):?>
															<li style="padding:0px;"><?php echo $major;?></li>
													<?php
															endforeach;
													?>
												</ul>
											</p>
										</td>
									</tr>
								<?php endif;?>
								<?php if(isset($companyMembers[$displayValue['Physician']['users_id']])):
									foreach($companyMembers[$displayValue['Physician']['users_id']] as $membership):
								?>
									<tr>
										<td colspan="2" style="padding:5px;">
											<p style="margin:3px;line-height:18pt"><h5 style="margin-bottom:3px"><b><?php echo $membership['CompanyBranch']['name'];?></b></h5>
												<?php if(isset($companyAddresses[$membership['CompanyBranch']['id']]) && isset($addresses[$companyAddresses[$membership['CompanyBranch']['id']]['CompanyBranchAddress']['address_id']])){
													$address = $addresses[$companyAddresses[$membership['CompanyBranch']['id']]['CompanyBranchAddress']['address_id']];
													$address['Address'] = array_filter($address['Address'],'strlen');
													echo '<b>Address:</b><br>'/*.implode(', ',$address['Address']).','*/.(isset($address['VillageCode']['name'])?$address['VillageCode']['name'].',':'').(isset($address['TownCityCode']['name'])?$address['TownCityCode']['name'].',':'').(isset($address['ProvincesStatesCode']['name'])?$address['ProvincesStatesCode']['name'].',':'').'<br />';
												}
												?>
												<b>Schedules:</b><br>
												<?php
													if(isset($companyMemberDuties[$membership['CompanyBranchMember']['id']])){
														$scheds = array();
														foreach($companyMemberDuties[$membership['CompanyBranchMember']['id']] as $duty){
															$scheds[] = $days[$duty['CompanyBranchMemberDuty']['day']]." ".date('H:i',strtotime($duty['CompanyBranchMemberDuty']["start_time"]))."-".date('H:i',strtotime($duty['CompanyBranchMemberDuty']["end_time"]));
														}
														echo implode(', ',$scheds);
													}
												?>
											</p>
										</td>
									</tr>
								<?php
									endforeach;
								endif;?>
							</table>
						</div>
					<div class="hr "></div>
					</div>
		
					<?php
					$newletter=$letter;
				}
			endforeach;
		
			if(!empty($count) && $count > 20){
			?>
			<div class="pagination" style="color:green;">

				<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>

				| 	<?php echo $this->Paginator->numbers();?> |
				<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>

			</div>
			<?php
			}
			?>
		</div>
		                                    
</div>
</div>
<script>
jQuery(document).ready(function(){
	$("tr:even").removeClass("even");
	$("tr:odd").removeClass("odd");
	jQuery('td').css({'padding':'0','background':'none'});
	jQuery('tr').css({'vertical-align':'middle'});
	jQuery('.hr').css('margin','10px 0');

	

/*
	if($('ul.j-load-all').length){
		var container = $('ul.j-load-all'),
			m_li = container.find("li"),
			m_item = m_li.find("a");
			container.find("a:first").addClass('active');
			m_item.click(function(){
				m_li.find('.active').removeClass('active');
				$(this).addClass("active");
			});
	}
	if($('ul.j-default a.active').length == 0){
		$('ul.j-default a:first').addClass('active');
	}

	jQuery(".menu-sidebar").localScroll({filter:'.smoothScroll'});
	jQuery('.menu-sidebar').stickyfloat({ duration: 400 });
*/
});
</script>