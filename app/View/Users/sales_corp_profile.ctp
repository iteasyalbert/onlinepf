
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=PH"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->Html->script('gmapplot');?>

<style>
	table > tbody >tr > td:first{
		width:200px;
	}
</style>
<div class="content">
	<div id="main-tab" class="widget-result">
			<ul class="tabnav">
				<li><a style="background: none;" href="#profile">Pending Corporate Accounts</a></li>
            </ul>
		<div id="profile" class="tabdiv" style="margin-bottom: 10px;">
				<div style="float:right;width: 45%;">
					<div id="photo" class="company-logo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 90px 30px 0;">
					<?php //echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
					<?php echo $this->Html->image('../media/logos/'.$branchInfo['CompanyBranchInfo']['logo'],array('id' =>'idpic','style'=>'width:150px;height:150px;margin-right:10px;'));?>
					<?php //$contactDetail = $this->data['Contact'];?>
				</div>
				
				<div id="mymap" style="width:320px;height:300px;border:solid 1px #000;float:right;margin-right:10px;"></div>
	<!--			<div id="my_map" style="border:1px solid #BFB092; width:300px;height:230px;margin-top:20px;float:right;"></div>-->
				
			</div>
			<br/>
			<?php $labClass = array(1 => 'Corporate',2 => 'Secondary',3 => 'Tertiary');?>
			<?php $labType = array(1 => 'Laboratory/Clinic',2 => 'Hospital');?>
			<div style="width:48%;">
				<table id="double-td-tbl">
					<tbody>
					<tr><td><h2>PROFILE</h2></td><td></td></tr>
						<tr><td><label>Company Name:</label></td><td>
							<?php echo $branch['Company']['name'];?>
						</td></tr>
						<tr><td><label>Website:</label></td><td>
							<?php echo $branch['Company']['website'];?>
						</td></tr>
	
						<tr><td><label>Laboratory&nbsp;Name:</label></td><td>
							<?php echo $branch['CompanyBranch']['name'];?>
						</td></tr>
						<tr><td><label>Classification:</label></td><td>
							<?php echo (!empty($corporate['CorporateAccount']['class']))?$labClass[$corporate['CorporateAccount']['class']]:"";?>
						</td></tr>
						<tr><td><label>Type:</label></td><td>
							<?php echo (!empty($corporate['CorporateAccount']['type']))?$labType[$corporate['CorporateAccount']['type']]:"";?>
						</td></tr>
					</tbody>
				</table>
				<table id="double-td-tbl">
					<tbody>
					<tr><td><h2>Address&nbsp;Details</h2></td></tr>
					<?php //echo $this->Form->input('.Address.id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
						<?php //echo $this->Form->input('Address.person_address_id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
					</td></tr>
					<tr><td><label>Province:</label></td><td>
						<?php echo $address['ProvincesStatesCode']['name'];?>
					</td></tr>
					<tr><td><label>Town/City:</label></td><td>
						<?php echo $address['TownCityCode']['name'];?>
						</td></tr>
					<tr><td><label>Barangay:</label></td><td>
						<?php echo $address['VillageCode']['name'];?>
						</td></tr>
					<tr><td><label>Street:</label></td><td>
						<?php echo $address['Address']['street_number'];?>
						</td></tr>
					<tr><td><label>Building:</label></td><td>
						<?php echo $address['Address']['building_apartment'];?>
						</td></tr>
					<tr><td><label>Unit:</label></td><td>
						<?php echo $address['Address']['unit'];?>
						</td></tr>
					<tr><td><label>Floor:</label></td><td>
						<?php echo $address['Address']['floor'];?>
					</td></tr>
				</table>
				
				<table id="double-td-tbl">
					<thead>
						<tr><td colspan="3" ><h2>Contact Details</h2></td></tr>
					</thead>
					<tbody>
						
						<?php foreach($contactInformations as $contact):?>
							<tr>
								<td><?php echo $contactTypes[$contact['ContactInformation']['type']];?></td>
								<td><?php echo $contact['ContactInformation']['contact'];?></td>
							</tr>
						<?php endforeach;?>
					
					</tbody>
				</table>
				<table id="double-td-tbl">
					<tr>
						<td><?php echo $this->Form->postLink(__('Activate'), array('controller' => 'users','action' => 'lab_activate', 'sales' => true, $branch['CompanyBranch']['user_id']), array('class'=>'save_ads button small green','style'=>'color:white;'), __('Are you sure you want to activate this account?', $branch['CompanyBranch']['user_id'])); ?></td>
					</tr>
				</table>
			</div>
			
			<?php
			$detailsAdd = $address['ProvincesStatesCode']['name'].', '.$address['TownCityCode']['name'].', '.$address['VillageCode']['name'].', '.$address['Address']['street_number'].', '.$address['Address']['building_apartment'];
		 	$clinics = array(
			 	array(
			 		'lat' =>$address['Address']['latitude'],
					'lng' => $address['Address']['longtitude'],
					'title' => $branch['CompanyBranch']['name'],
					'content' => '<b>'.$branch['CompanyBranch']['name'].'</b><br />'.$detailsAdd,
					'color'=>'red'
				)
			);
		 ?>
			
		</div>
		 
	</div>
</div>
<script>
var clinics = <?php echo $this->Js->object($clinics);?>;
jQuery(document).ready(function(){

	jQuery('table td').css('padding','5px');
	jQuery('table').css('clear','none');
	
 	jQuery('h4.title').css({'margin':'10px 0 15px 0'});
	jQuery('h4.top').css({'margin':'0px 0 15px 0'});
 	jQuery('#mymap').gmapplot({selectable_location:false,resizable:true});
 	jQuery('#mymap').gmapplot('plot',clinics);
});
</script>
