
<?php echo $this->Html->script('jquery-ui-personalized-1.6rc6.js',false);?>
<?php echo $this->Html->script('jquery-ui-personalized-1.6rc62.js',true);?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=PH"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->Html->script('gmapplot.js');?>
<style>
div#profile-div select {
	padding: 5px;
	width: 93%;
	margin: 1px;
	}
p{line-height: 20px !important}
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; }
.autocomplete-suggestion { padding: 5px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: red; }
/*
input { font-size: 28px; padding: 10px; border: 1px solid #CCC; display: block; margin: 20px 0; }
*/

</style>
<script>
	var uploadType = 0;
	var $uploadImageButton;
</script>
<div class="content">
<?php echo $this->Form->create(null,array('enctype' => 'multipart/form-data','class'=>'lab_signup_form'));?>
	<img src="/img/wizard_laboratory_profile.png" style="margin-bottom: 20px;width:100%;">
	<p>
		Thank your very much for confirming your email address.
	</p>
	<br/>
	<p>
		We are requesting that you complete your corporate profile by filling-up the following information below. These information will help MRO in providing your corporate quality services.
	</p>
	<br/>
	<div id="main-tab" class="widget-result" style="float:left;">
		<ul class="tabnav">

        </ul>
		<div id="profile" class="tabdiv" style="margin-bottom: 10px;float:left;">
		
			
			<div id="profile-div">
				<div style="width:100%;">
					<table id="profile-table" class="profile-table-class" style="float:left;width:auto">
						<tr><td><h2>Company</h2></td><td></td></tr>
						<!-- <tr><td><label>Type:</label></td><td><?php echo $this->Form->radio('Company.comopt',array('1'=>'New','2'=>'Existing'),array('value'=>(isset($this->data['Company']['comopt']))?$this->data['Company']['comopt']:1,'legend'=>false,'class'=>'comopt'));?></td></tr> -->
						<tr class="company_name"><td><label>Company Name:</label></td><td class="companyinput">
						<?php echo $this->Form->hidden('Company.id',array('label'=>false,'div'=>false,'class'=>'comid'));?>
						<?php echo $this->Form->hidden('CompanyBranchInfo.id',array('label'=>false,'div'=>false));?>
						<?php echo $this->Form->hidden('CompanyBranchMember.id',array('label'=>false,'div'=>false));?>
						<?php echo $this->Form->hidden('CorporateAccount.id',array('label'=>false,'div'=>false));?>
						<?php echo $this->Form->input('Company.name',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i>
						<?php echo $this->Form->hidden('Company.logo',array('label'=>false,'div'=>false,'class'=>'comlogo'));?>
						
						<div id="selction-ajax"></div></td></tr>
						<tr class="company_website"><td><label>Website:</label></td><td><?php echo $this->Form->input('Company.website',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
						<tr><td colspan="3">&nbsp;</td></tr>
						<tr><td colspan="3">&nbsp;</td></tr>
						<tr><td colspan="3">&nbsp;</td></tr>
						<tr><td><h2>CORPORATE</h2></td><td></td></tr>
						<?php echo $this->Form->hidden('CompanyBranch.id',array('label'=>false, 'type'=>'text','div'=>false));?>
						<?php echo $this->Form->input('CompanyBranchInfo.logo',array('type' => 'hidden','label'=>false,'div'=>false));?>
						<tr id="prerequisite" class="lab_name"><td><label>Corporate&nbsp;Name:</label></td><td><?php echo $this->Form->input('CompanyBranch.name',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite" class="lab_website"><td><label>Website:</label></td><td><?php echo $this->Form->input('CompanyBranchInfo.website',array('label'=>false,'div'=>false,'maxlength'=>false));?><i><span class="span-req" >*</span></i></td></tr>
						<?php $class = array('1'=>'Hospital','2'=>'Laboratory','3'=>'Clinic');?>
						<!-- <tr class="classification"><td><label>Classification:</label></td><td><?php echo $this->Form->select('CorporateAccount.class',$class,array('label'=>false,'legend'=>false,'value'=>$classCorporate,'readonly'=>'readonly'))?><i><span class="span-req" >*</span></i></td></tr> -->
						<tr><td><h2>Address&nbsp;Details</h2></td><td></td></tr>
						<?php //echo $this->Form->input('.Address.id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
							<?php //echo $this->Form->input('Address.person_address_id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
						</td></tr>
						<tr id="prerequisite2" class="province"><td><label>Province:</label></td><td><?php echo $this->Form->input('Address.province_state_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $provinces,'class' => 'address_select','title' => 'address_select_1','value'=>(isset($this->data['Address'][$branch_id]['ProvincesStatesCode']['id']))?$this->data['Address'][$branch_id]['ProvincesStatesCode']['id']:'','class' => 'address_select address_field','title' => 'address_select_1'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite2" class="town"><td><label>Town/City:</label></td><td><?php echo $this->Form->input('Address.town_city_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $townCities,'class' => 'address_select','title' => 'address_select_2','value'=>(isset($this->data['Address'][$branch_id]['TownCityCode']['id']))?$this->data['Address'][$branch_id]['TownCityCode']['id']:'','class' => 'address_select address_field','title' => 'address_select_2'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite2" class="brgy"><td><label>Barangay:</label></td><td><?php echo $this->Form->input('Address.village_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $villages,'class' => 'address_select','title' => 'address_select_3','value'=>(isset($this->data['Address'][$branch_id]['VillageCode']['id']))?$this->data['Address'][$branch_id]['VillageCode']['id']:'','class' => 'address_select address_field','title' => 'address_select_3'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite2" class="street"><td><label>Street:</label></td><td><?php echo $this->Form->input('Address.street_number',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['street_number']))?$this->data['Address'][$branch_id]['Address']['street_number']:'','class' => 'address_field','placeholder'=>'This is required if no lot and block'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite2" class="lot"><td><label>Lot:</label></td><td><?php echo $this->Form->input('Address.lot',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['lot']))?$this->data['Address'][$branch_id]['Address']['lot']:'','placeholder'=>'This is required if no street','class' => 'address_field',));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite2" class="block"><td><label>Block:</label></td><td><?php echo $this->Form->input('Address.block',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['block']))?$this->data['Address'][$branch_id]['Address']['block']:'','placeholder'=>'This is required if no street','class' => 'address_field',));?><i><span class="span-req" >*</span></i></td></tr>
						<tr id="prerequisite2" ><td><label>Building:</label></td><td><?php echo $this->Form->input('Address.building_apartment',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['building_apartment']))?$this->data['Address'][$branch_id]['Address']['building_apartment']:'','class' => 'address_field',));?></td></tr>
						<tr id="prerequisite2" ><td><label>Unit:</label></td><td><?php echo $this->Form->input('Address.unit',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['unit']))?$this->data['Address'][$branch_id]['Address']['unit']:''));?></td></tr>
						<tr id="prerequisite2" ><td><label>Floor:</label></td><td><?php echo $this->Form->input('Address.floor',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['floor']))?$this->data['Address'][$branch_id]['Address']['floor']:''));?></td></tr>
					</table>
<!--				</div>-->
<!--				<div style="width:90%;">-->

					<div class="map-side" style="float:right;width: 45%">
							<div id="photo" class="company-logo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 80px 30px 0;">
								<?php //echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
								<?php echo $this->Html->image('../img/poster-one-half-profile.jpg',array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
								<?php //$contactDetail = $this->data['Contact'];?>
								<style type="text/css">
									.myfileupload-buttonbar{
										text-align: center;
									}
							        .myfileupload-buttonbar input
							        {
							            position: absolute;
							            top: 0;
							            right: 0;
							            margin: 0;
							            border: solid transparent;
							            border-width: 0 0 100px 200px;
							            opacity: 0.0;
							            filter: alpha(opacity=0);
							            -o-transform: translate(250px, -50px) scale(1);
							            -moz-transform: translate(-300px, 0) scale(4);
							            direction: ltr;
							            cursor: pointer;
										display:none;
							            
							        }
							        .myui-button
							        {
							            position: relative;
							            cursor: pointer;
							            text-align: center;
							            overflow: visible;
							            overflow: hidden;
							            font-size:inherit;
							        	text-decoration:none;
							        }
							        .myui-button:hover{
							        	text-decoration:underline;
							        }
							    </style>
								<div class="myfileupload-buttonbar ">
						            <label class="myui-button">
						                <span >Choose File</span>
										<?php echo $this->Form->input('Company.upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image1'));?>
									</label>
								</div>
							</div>
							<div id="photo" class="branch-logo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:0px 80px 30px 0;">
								<?php //echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
								<?php echo $this->Html->image('../img/poster-one-half-profile.jpg',array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
								<style type="text/css">
									.myfileupload-buttonbar{
										text-align: center;
									}
							        .myfileupload-buttonbar input
							        {
							            position: absolute;
							            top: 0;
							            right: 0;
							            margin: 0;
							            border: solid transparent;
							            border-width: 0 0 100px 200px;
							            opacity: 0.0;
							            filter: alpha(opacity=0);
							            -o-transform: translate(250px, -50px) scale(1);
							            -moz-transform: translate(-300px, 0) scale(4);
							            direction: ltr;
							            cursor: pointer;
										display:none;
							            
							        }
							        .myui-button
							        {
							            position: relative;
							            cursor: pointer;
							            text-align: center;
							            overflow: visible;
							            overflow: hidden;
							            font-size:inherit;
							        	text-decoration:none;
							        }
							        .myui-button:hover{
							        	text-decoration:underline;
							        }
							    </style>
								<div class="myfileupload-buttonbar ">
						            <label class="myui-button">
						                <span >Choose File</span>
										<?php echo $this->Form->input('CompanyBranchInfo.upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image2'));?>
									</label>
								</div>
							</div>
							
						</center>
						<div id="my_map" style="border:1px solid #BFB092; width:100%;height:280px;float:right;"></div>
					</div>
					
					<table id="double-td-tbl" class="contact_info_tbl" style="width:auto;float:left;">
						<tr><td colspan="3" ><h2>Contact Details</h2></td></tr>
						<tr><td><b>Contact</b></td><td><b>Detail</b></td><td><b>Action</b></td></tr>
							<tbody>
							 <?php
							 	if(isset($this->data['Contacts'])):?>
							 		<?php $contactDetail = $this->data['Contacts'];?>
									<?php $ctr=0;foreach($contactDetail as $contactInfo):?>
										<tr><td><label><?php echo $this->Form->input('ContactInformation.'.$ctr.'.id',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['ContactInformation']['id'],'class'=>'unique_id'));echo $this->Form->input('ContactInformation.'.$ctr.'.type',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['ContactInformation']['type'],'class'=>'unique_type'));echo $contactInfo['ContactInformation']['typename'].":";?></label></td><td><?php echo $this->Form->input('ContactInformation.'.$ctr++.'.contact',array('type'=>'text','div' => false,'label'=>false,'style'=>'width:140px','value'=>$contactInfo['ContactInformation']['contact']));?></td><td><a style="cursor:pointer;" onclick="removeContact(this);">&nbsp;&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>
									<?php endforeach;?>
								<?php endif;?>
								<tr class="contact"><td><?php echo $this->Form->input('Contact.type',array('type'=>'select','options'=>$contactTypes,'label'=>false,'div'=>false,'class'=>'ContactType'));?></td><td><?php echo $this->Form->input('Contact.contact',array('type' => 'text','label'=>false,'div'=>false,'style'=>'width:140px','class'=>'ContactContact'))?></td><td><a style="text-decoration:none;" onclick="addContact(this);" ><i><span class="span-req" >*</span></i><img src="/img/add.png" style="height: 18px; width: 18px;cursor: pointer;"/></a></td></tr>
							
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
		<h4 class="title" style="margin-bottom:10px"><span>Terms and Conditions</span></h4>
		<p style="float:left;">Use of this website is guided with the following terms and conditions:<br/>
				<a onclick="window.open('/Membership/view/terms_and_conditions')" style="cursor:pointer;">Terms and Conditions</a>
			</p>
		<div style="margin-bottom: 30px;">
			
			<p style=" text-align: center;float:left;">
			<?php echo '<label for="PersonAgree"><strong>Accept</strong></label>'.$this->Form->input('agree',array('div'=>false,'label'=>false,'type'=>'checkbox', 'style'=>'float: left; margin: 5px 0px 0 0;'));?>
			This certifies that I've read and accept the terms and conditions of this website. </p><div style="width:200px;float:left;"></div>
		</div>
<!--		<h4 class="title"><span>Disclaimer</span></h4>-->
<!--		<div style="margin-bottom: 20px;">-->
<!--			<p style="text-align: center;">Author of this website. </p>-->
<!--		</div>-->
	<br/>
			<?php echo $this->Form->submit('Submit',array('class'=>'form_save','style'=>'float:left;',"onclick"=>"return false;"));?>
			<?php echo $this->Form->end();?>

</div>

         <?php echo $this->element('sidebar');?>
<script>
 var laboratory = {};

// 	jQuery('input#CompanyComopt2.comopt').change(function(){
// 		jQuery('#CompanyName').addClass('autocomplete');
// 		if(jQuery('#CompanyName').val() == 'Enter your company'){
			
// 		}else{
// 			jQuery('#CompanyName').val('Enter your company');
// 		}
// 		jQuery('.autocomplete').autocomplete({
// 		    source: '/laboratories/getCompanies',
// 		    minLength:2,
// 		    delay:0,
// 		    select: function (event,ui) {
// 				jQuery('.comid').val(ui.item.id);
// 				showCompanyDetails(ui.item.id);//get and show company detail
				
// 		    }
// 		});
// 	});
 	jQuery('input#CompanyName').change(function(){
	 	 	if(jQuery('#CompanyName').val() == ''){
				jQuery('#CompanyName').addClass('autocomplete');
				if(jQuery('#CompanyName').val() == 'Enter your company'){
					
				}else{
					jQuery('#CompanyName').val('Enter your company');
				}
				jQuery('.autocomplete').autocomplete({
				    source: '/laboratories/getCompanies',
				    minLength:2,
				    delay:0,
				    select: function (event,ui) {
						jQuery('.comid').val(ui.item.id);
						showCompanyDetails(ui.item.id);//get and show company detail
						
				    }
				});
	 	 	}else{
	 	 		jQuery('#CompanyName').addClass('autocomplete');
				if(jQuery('#CompanyName').val() == 'Enter your company'){
					
				}else{
// 					jQuery('#CompanyName').val('Enter your company');
				}
				jQuery('.autocomplete').autocomplete({
				    source: '/laboratories/getCompanies',
				    minLength:2,
				    delay:0,
				    select: function (event,ui) {
						jQuery('.comid').val(ui.item.id);
						showCompanyDetails(ui.item.id);//get and show company detail
						
				    }
				});
	 	 	}
		});
	jQuery('tr#prerequisite input,tr#prerequisite select,tr#prerequisite textarea').attr('disabled','disabled');
	jQuery('tr#prerequisite2 input,tr#prerequisite2 select,tr#prerequisite2 textarea').attr('disabled','disabled');
	jQuery('table.contact_info_tbl input,table.contact_info_tbl select').attr('disabled','disabled');		
	jQuery('#CompanyName').click(function(){
		if(jQuery('#CompanyName').val() == 'Enter your company'){
			jQuery('#CompanyName').val('');
		}else{
			//do nothing
		}

	});
	jQuery('input#CompanyComopt1.comopt').change(function(){
//		jQuery('#CompanyName').removeClass('autocomplete-ajax');
		jQuery('#CompanyName').removeAttr('class');
		jQuery('input.comid').removeAttr('value');
		if(jQuery('#CompanyName').val() == 'Enter your company'){
			jQuery('#CompanyName').val('');
			jQuery('tr.company_name td:eq(1) i span.span-req').text('*;').css('color','red');
			jQuery('tr.company_website td:eq(1) i span.span-req').text('*').css('color','red');
		}else{
			//do nothing
			jQuery('tr.company_name td:eq(1) i span.span-req').text('*').css('color','red');
			jQuery('tr.company_website td:eq(1) i span.span-req').text('*').css('color','red');
		}
		jQuery('#CompanyName').val('').removeAttr('readonly','readonly');
		jQuery('#CompanyWebsite').val('').removeAttr('readonly','readonly');
		jQuery('div#photo.company-logo img#idpic').attr('src',"/img/poster-one-half-profile.jpg");
		jQuery('.company-logo .myui-button').show();
	});
	
 jQuery(document).ready(function(){

	 jQuery(window).resize(function() {
//		 jQuery('.map-side').css('width','100%');
	});
	 
	 jQuery('table.profile-table-class input[type="text"]').css('width','190px');
     jQuery('table.profile-table-class tr td select').css('width','203px');
	 jQuery('form').attr('autocomplete','off');
	jQuery('.current-crumb').text(' SIGN UP');
	jQuery('div.submit input.form_save,ContactInformation0Contact').live('click',function(){
		var checkForm = validationForm('Address','Company','CompanyBranch');
		if(checkForm){
			if(jQuery('#UserAgree').is(':checked')){
				jQuery('.form_save').removeAttr('onclick');
			}else{flashErrorMessage('Please read and accept the terms and conditions of the website. Thank you!');}
		}else{flashErrorMessage('Some fields are required.');}
	});
	jQuery('#UserAgree').change(function(){
		var checkForm = validationForm('Address','Company','CompanyBranch');
		if(checkForm){
			if(jQuery(this).is(':checked')){
				jQuery('.form_save').removeAttr('onclick');
			}else{
				jQuery('.form_save').attr('onclick','return false;');
			}
		}
		else{flashErrorMessage('Some fields are required.');}
	});
	
	jQuery('#my_map').gmapplot({
		selectable_location:true,
		resizable:true,
		latInputAttr:{name:"data[Address][latitude]"},
		lngInputAttr:{name:"data[Address][longtitude]"}
	});
	
	jQuery('#my_map').gmapplot('locate',locateAddress());
	jQuery('.address_field').change(function(){
		jQuery('#my_map').gmapplot('locate',locateAddress());
//		alert(locateAddress());
	});
	jQuery('#my_map').css({'position':'relative','top':'0','left':'0'});
	
	jQuery(".browse_image1").click(function(){
		jQuery(".company-logo img#idpic").addClass('activeimg');
		jQuery(".branch-logo img#idpic").removeClass('activeimg');
	});
	jQuery(".browse_image2").click(function(){
		jQuery(".company-logo img#idpic").removeClass('activeimg');
		jQuery(".branch-logo img#idpic").addClass('activeimg');
	});
	$uploadImageButton = jQuery(".browse_image1").clone();
	$uploadImageButton = jQuery(".browse_image2").clone();
	$uploadImageButton.change(updateImagePreview);
	
	jQuery(".browse_image1").change(updateImagePreview);
	jQuery(".browse_image2").change(updateImagePreview);
	checkInput();
	jQuery('#ContactContact').live('focusout',function(){
		var inputVal = jQuery(this).val();
		if(inputVal != ""){
			addContact();
		}
	});
	jQuery('span#removeCompany').live('click',function(){
		jQuery('tr.company_name td.companyinput input').removeAttr('value').removeAttr('readonly');
		jQuery('tr.company_website td input').removeAttr('value').removeAttr('readonly');
		jQuery(this).remove();
		jQuery('tr#prerequisite input,tr#prerequisite select,tr#prerequisite textarea').attr('disabled','disabled');
		jQuery('div#photo.company-logo img#idpic').attr('src',"/img/../img/poster-one-half-profile.jpg");
		
		jQuery('input#CompanyBranchName').removeAttr('value');
		jQuery('input#CompanyBranchInfoWebsite').removeAttr('value');
		
		jQuery('tr#prerequisite2 input,tr#prerequisite2 select,tr#prerequisite2 textarea').attr('disabled','disabled');
		jQuery('table.contact_info_tbl input,table.contact_info_tbl select').attr('disabled','disabled');
		
	});

	jQuery('input#CompanyName').change(function(){
		if(jQuery(this).val() != '' || jQuery(this).val() != null || jQuery(this).val() != undefined){
			jQuery('input#CompanyBranchName').attr('value',jQuery(this).val());
			jQuery('tr#prerequisite input,tr#prerequisite select,tr#prerequisite textarea').removeAttr('disabled');
			jQuery('tr#prerequisite2 input,tr#prerequisite2 select,tr#prerequisite2 textarea').removeAttr('disabled');
			jQuery('table.contact_info_tbl input,table.contact_info_tbl select').removeAttr('disabled');
			jQuery('input#CompanyBranchName').trigger('change');
		}	
	});
	jQuery('input#CompanyWebsite').change(function(){
		if(jQuery(this).val() != '' || jQuery(this).val() != null || jQuery(this).val() != undefined){
			jQuery('input#CompanyBranchInfoWebsite').attr('value',jQuery(this).val());
			jQuery('input#CompanyBranchInfoWebsite').trigger('change');
		}	
	});
 });
 var person = {};
 var indexIdcon = 1;
 var contact_delid = 0;
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
	        	jQuery('img#idpic.activeimg').attr('src',datauri);
	        };
	      })(f);
	      reader.readAsDataURL(f);
		}
	};
//	function addContact(a){
//		contact = jQuery('#ContactContact').val();
//		if(contact.length){
//			type = jQuery('#ContactType').val();
//			typename = jQuery('#ContactType').find('option:selected').text();
//			tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:140px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;text-decoration:none;" onclick="removeContact(this);">&nbsp;&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>';
//			jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
//			reindexorder('.contact_info_tbl tbody tr');
//			jQuery('#ContactContact').val('');
//		}else{
//			flashErrorMessage('Please type your contact detail.');
//		}
//	}
	function addContact(a){
		contact = jQuery('.ContactContact').val();
		if(contact.length){

			type = jQuery('.ContactType').val();
            valid = isValidContactDetail(contact,type);
            if(valid){
				typename = jQuery('.ContactType').find('option:selected').text();
				tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:140px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;text-decoration: none;" onclick="removeContact(this);">&nbsp;&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>';
				jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
				reindexorder('.contact_info_tbl tbody tr');
				jQuery('.ContactContact').val('');
				 jQuery('.error_message').css('display','none');
            }else{
            	flashErrorMessage('Invalid contact. Please check your contact detail first.');
            }
		}else{
			flashErrorMessage("Please type your contact detail.");
		}
	}
	function removeContact(a){
		rowcon = jQuery(a).parent().parent().html();
		contact_delid = jQuery(rowcon).find('input.unique_id').val();
		statusinput = '<input type="hidden" name="data[ContactInformationDelete]['+indexIdcon+'][id]" id="ContactInformationDelete0" value="'+contact_delid+'">';
		jQuery(statusinput).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
		indexIdcon += 1;
		jQuery(a).parent().parent().remove();
		reindexorder('.contact_info_tbl tbody tr');
	}
	function showCompany(companyId){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'getCompany'));?>',
			data:{'Company':{'id':companyId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){

				if(data){
					logo = '/img/../media/profiles/default.jpeg';

					if(data.Company.logo != undefined && data.Company.logo.length)
						logo = '/img/../media/profiles/'+data.Company.logo;

					jQuery('#cliniclogo').attr('src',logo);

					jQuery.each(data.Company,function(x,y){
						id = 'Company'+camelize(x);
						jQuery('#'+id).val(y);
					});

					//company-branch-slc
					
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
	function showCompanyDetails(companyId){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'laboratories','action'=>'getCompanyDetails'));?>',
			data:{'Company':{'id':companyId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){
				if(data){
					jQuery('#CompanyName').val(data.Company.name).attr('readonly','readonly');
					jQuery('#CompanyWebsite').val(data.Company.website).attr('readonly','readonly');
					jQuery('#CompanyLogo').val(data.Company.logo).attr('readonly','readonly');
					jQuery("<span id='removeCompany' style='border: 2px solid #bbaf9b;'>&nbsp;<a style='text-decoration:none;' title='Clear'><b>X</b></a>&nbsp;</span>").insertBefore('tr.company_name td.companyinput div#selction-ajax');
					
					jQuery('div#photo.company-logo img#idpic').attr('src',"/media/logos/"+data.Company.logo);
					jQuery('.company-logo .myui-button').hide();
					
					jQuery('tr.company_name td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');
					jQuery('tr.company_website td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');

					jQuery('input#CompanyBranchName').attr('value',jQuery('input#CompanyName').val());
					jQuery('input#CompanyBranchInfoWebsite').attr('value',jQuery('input#CompanyWebsite').val());
					
					jQuery('tr#prerequisite input,tr#prerequisite select,tr#prerequisite textarea').removeAttr('disabled');
					jQuery('tr#prerequisite2 input,tr#prerequisite2 select,tr#prerequisite2 textarea').removeAttr('disabled');
					jQuery('table.contact_info_tbl input,table.contact_info_tbl select').removeAttr('disabled');
// 					jQuery('tr#prerequisite2 input,tr#prerequisite2 select,tr#prerequisite2 textarea').attr('disabled');
// 					jQuery('table.contact_info_tbl input,table.contact_info_tbl select').attr('disabled');	
								
				}
				
			}
		});
	}
	
	function validationForm(address,company,branch){
		var result = true;
			if(address == "Address"){
				provinceInput = jQuery("#"+address+"ProvinceStateId").val();
				TownCityInput = jQuery("#"+address+"TownCityId").val();
				VillageInput = jQuery("#"+address+"VillageId").val();
				StreetNumber = jQuery("#"+address+"StreetNumber").val();
				Lot = jQuery("#"+address+"Lot").val();
				Block = jQuery("#"+address+"Block").val();
				if(provinceInput == 0 || TownCityInput == 0 || VillageInput == 0){
					result = false;
				}else{
					if(StreetNumber == '' || StreetNumber == 'This is required if no lot and block'){if(Lot != '' && Block != '' && Lot != 'This is required if no street' && Block != 'This is required if no street'){result = true;}else{result = false;}}
				}
			}
			if(company == "Company"){
				NameInput = jQuery("#"+company+"Name").val();
				WebsiteInput = jQuery("#"+company+"Website").val();
				if(NameInput == "" || WebsiteInput == ""){result = false;}
			}
			if(branch == "CompanyBranch"){
				NameInput = jQuery("#"+branch+"Name").val();
				WebsiteInput = jQuery("#"+branch+"InfoWebsite").val();
				LabClassInput = jQuery("#LaboratoryClass").val();
				ContactInput = jQuery('#ContactInformation0Contact').val();
				if(NameInput == "" || WebsiteInput == "" || LabClassInput == 0 || ContactInput == undefined){result = false;}
			}
		return result;
	}
	function checkInput(){
		var inputUserVal = '';
		var inputPassVal = '';
		var result = "";
		jQuery('#CompanyName').live('focusout',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.company_name td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.company_name td:eq(1) i span.span-req').text() == "*"){jQuery('tr.company_name td:eq(1) i span.span-req').append('');}}else{jQuery('tr.company_name td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#CompanyWebsite').live('focusout',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.company_website td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.company_website td:eq(1) i span.span-req').text() == "*"){jQuery('tr.company_website td:eq(1) i span.span-req').append('');}}else{jQuery('tr.company_website td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#CompanyBranchName').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.lab_name td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.lab_name td:eq(1) i span.span-req').text() == "*"){jQuery('tr.lab_name td:eq(1) i span.span-req').append('');}}else{jQuery('tr.lab_name td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#CompanyBranchInfoWebsite').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.lab_website td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.lab_website td:eq(1) i span.span-req').text() == "*"){jQuery('tr.lab_website td:eq(1) i span.span-req').append('');}}else{jQuery('tr.lab_website td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		var inputVal = jQuery('#LaboratoryClass').val();if(inputVal == ''){jQuery('tr.classification td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.classification td:eq(1) i span.span-req').text() == "*"){jQuery('tr.classification td:eq(1) i span.span-req').append('');}}else{jQuery('tr.classification td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		jQuery('#LaboratoryClass').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.classification td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.classification td:eq(1) i span.span-req').text() == "*"){jQuery('tr.classification td:eq(1) i span.span-req').append('');}}else{jQuery('tr.classification td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		
		jQuery('#LaboratoryClass').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.classification td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.classification td:eq(1) i span.span-req').text() == "*"){jQuery('tr.classification td:eq(1) i span.span-req').append('');}}else{jQuery('tr.classification td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

		jQuery('#AddressProvinceStateId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.province td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.province td:eq(1) i span.span-req').text() == "*"){jQuery('tr.province td:eq(1) i span.span-req').append('');}}else{jQuery('tr.province td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#AddressTownCityId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.town td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.town td:eq(1) i span.span-req').text() == "*"){jQuery('tr.town td:eq(1) i span.span-req').append('');}}else{jQuery('tr.town td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#AddressVillageId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.brgy td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.brgy td:eq(1) i span.span-req').text() == "*"){jQuery('tr.brgy td:eq(1) i span.span-req').append('');}}else{jQuery('tr.brgy td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#AddressStreetNumber').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.street td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.street td:eq(1) i span.span-req').text() == "*"){jQuery('tr.street td:eq(1) i span.span-req').append('');}}else{jQuery('tr.street td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

		jQuery('#AddressLot').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.lot td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.lot td:eq(1) i span.span-req').text() == "*"){jQuery('tr.lot td:eq(1) i span.span-req').append('');}}else{jQuery('tr.lot td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#AddressBlock').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.block td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.block td:eq(1) i span.span-req').text() == "*"){jQuery('tr.block td:eq(1) i span.span-req').append('');}}else{jQuery('tr.block td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

		jQuery('#ContactContact').live('change',function(){
			var inputVal = jQuery(this).val();
			if(inputVal == ''){
				jQuery('tr.contact td:eq(2) a i span.span-req').html('*').css('color','red');
				if(jQuery('tr.contact td:eq(2) a i span.span-req').text() == "*"){
					jQuery('tr.contact td:eq(2) a i span.span-req').append('');
					}
			}else{
				type = jQuery('#ContactType').val();
				valid = isValidContactDetail(inputVal,type);
				if(valid){
					jQuery('tr.contact td:eq(2) a i span.span-req').html('&#10003;').css('color','#687719');
				}
			}
		});
		

	}

	function strLength(pass){
	  var len = pass.length;
	  return len;
	}
 </script>