
	   <?php //echo $this->Html->script('src/jquery-1.8.2.min.js');?>
	   <?php //echo $this->Html->script('src/jquery.mockjax.js');?>
	   <?php //echo $this->Html->script('src/jquery.autocomplete.js');?>
	   <?php //echo $this->Html->script('src/demo.js');?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&region=PH"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php echo $this->Html->script('gmapplot.js');?>
<style>
div#profile-div select {
	padding: 5px;
	width: 212px;
	margin: 1px;
	}

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
	<div id="profile" class="tabdiv" style="margin-bottom: 10px;">
	
		<div style="float:right;width: 330px;">
					<div id="photo" class="company-logo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 90px 30px 0;">
					<?php //echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
					<?php echo $this->Html->image('../img/male.jpg',array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
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
				<div id="photo" class="branch-logo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:0px 90px 30px 0;">
					<?php //echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
					<?php echo $this->Html->image('../img/male.jpg',array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
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
			<div id="my_map" style="border:1px solid #BFB092; width:300px;height:300px;float:right;margin:0 20px 0 0;"></div>
		</div>
		
		<br/>
		<div id="profile-div">
			<table id="profile-table">
				<tr><td><h2>Company</h2></td><td></td></tr>
				<tr><td><label>Type:</label></td><td><?php echo $this->Form->radio('Company.comopt',array('1'=>'New','2'=>'Existing'),array('value'=>(isset($this->data['Company']['comopt']))?$this->data['Company']['comopt']:1,'legend'=>false,'class'=>'comopt'));?></td></tr>
				<tr><td><label>Company Name:</label></td><td>
				<?php echo $this->Form->hidden('Company.id',array('label'=>false,'div'=>false,'class'=>'comid'));?>
				<?php echo $this->Form->hidden('CompanyBranchInfo.id',array('label'=>false,'div'=>false));?>
				<?php echo $this->Form->hidden('CompanyBranchMember.id',array('label'=>false,'div'=>false));?>
				<?php echo $this->Form->hidden('Laboratory.id',array('label'=>false,'div'=>false));?>			
				<?php echo $this->Form->input('Company.name',array('label'=>false,'div'=>false));?>
				<div id="selction-ajax"></div></td></tr>
				<tr><td><label>Website:</label></td><td><?php echo $this->Form->input('Company.website',array('label'=>false,'div'=>false));?></td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td><h2>PROFILE</h2></td><td></td></tr>
				<?php echo $this->Form->hidden('CompanyBranch.id',array('label'=>false, 'type'=>'text','div'=>false));?>
				<?php echo $this->Form->input('CompanyBranchInfo.logo',array('type' => 'hidden','label'=>false,'div'=>false));?>
				<tr><td><label>Laboratory Name:</label></td><td><?php echo $this->Form->input('CompanyBranch.branch',array('label'=>false,'div'=>false));?></td></tr>
				<tr><td><label>Website:</label></td><td><?php echo $this->Form->input('CompanyBranchInfo.website',array('label'=>false,'div'=>false,'maxlength'=>false));?></td></tr>
				<?php $class = array('1'=>'Hospital','2'=>'Laboratory','3'=>'Clinic');?>
				<tr><td><label>Classification:</label></td><td><?php echo $this->Form->select('Laboratory.class',$class,array('label'=>false,'legend'=>false))?></td></tr>
				<tr><td><h2>Address Details</h2></td><td></td></tr>
				<?php //echo $this->Form->input('.Address.id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
					<?php //echo $this->Form->input('Address.person_address_id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
				</td></tr>
				<tr><td><label>Province:</label></td><td><?php echo $this->Form->input('Address.province_state_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $provinces,'class' => 'address_select','title' => 'address_select_1','value'=>(isset($this->data['Address'][$branch_id]['ProvincesStatesCode']['id']))?$this->data['Address'][$branch_id]['ProvincesStatesCode']['id']:'','class' => 'address_select address_field','title' => 'address_select_1'));?></td></tr>
				<tr><td><label>Town/City:</label></td><td><?php echo $this->Form->input('Address.town_city_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $townCities,'class' => 'address_select','title' => 'address_select_2','value'=>(isset($this->data['Address'][$branch_id]['TownCityCode']['id']))?$this->data['Address'][$branch_id]['TownCityCode']['id']:'','class' => 'address_select address_field','title' => 'address_select_2'));?></td></tr>
				<tr><td><label>Barangay:</label></td><td><?php echo $this->Form->input('Address.village_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $villages,'class' => 'address_select','title' => 'address_select_3','value'=>(isset($this->data['Address'][$branch_id]['VillageCode']['id']))?$this->data['Address'][$branch_id]['VillageCode']['id']:'','class' => 'address_select address_field','title' => 'address_select_3'));?></td></tr>
				<tr><td><label>Street:</label></td><td><?php echo $this->Form->input('Address.street_number',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['street_number']))?$this->data['Address'][$branch_id]['Address']['street_number']:'','class' => 'address_field'));?></td></tr>
				<tr><td><label>Building:</label></td><td><?php echo $this->Form->input('Address.building_apartment',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['building_apartment']))?$this->data['Address'][$branch_id]['Address']['building_apartment']:''));?></td></tr>
				<tr><td><label>Unit:</label></td><td><?php echo $this->Form->input('Address.unit',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['unit']))?$this->data['Address'][$branch_id]['Address']['unit']:''));?></td></tr>
				<tr><td><label>Floor:</label></td><td><?php echo $this->Form->input('Address.floor',array('label'=>false,'div'=>false,'type' => 'text','value'=>(isset($this->data['Address'][$branch_id]['Address']['floor']))?$this->data['Address'][$branch_id]['Address']['floor']:''));?></td></tr>
			</table>
			<table id="double-td-tbl" class="contact_info_tbl" style="width:35%;clear:none;">
				<tr><td colspan="3" ><h2>Contact Details</h2></td></tr>
				<tr><td><b>Contact</b></td><td><b>Detail</b></td><td><b>Action</b></td></tr>
					<tbody>
					 <?php 
					 	if(isset($this->data['Contacts'])):?>
					 		<?php $contactDetail = $this->data['Contacts'];?>
							<?php $ctr=0;foreach($contactDetail as $contactInfo):?>
								<tr><td><label><?php echo $this->Form->input('ContactInformation.'.$ctr.'.id',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['ContactInformation']['id'],'class'=>'unique_id'));echo $this->Form->input('ContactInformation.'.$ctr.'.type',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['ContactInformation']['type'],'class'=>'unique_type'));echo $contactInfo['ContactInformation']['typename'].":";?></label></td><td><?php echo $this->Form->input('ContactInformation.'.$ctr++.'.contact',array('type'=>'text','div' => false,'label'=>false,'style'=>'width:140px','value'=>$contactInfo['ContactInformation']['contact']));?></td><td><a style="cursor:pointer;" onclick="removeContact(this);">&nbsp;&nbsp;X</a></td></tr>
							<?php endforeach;?>
						<?php endif;?>
						<tr><td><?php echo $this->Form->input('Contact.type',array('type'=>'select','options'=>$contactTypes,'label'=>false,'div'=>false));?></td><td><?php echo $this->Form->input('Contact.contact',array('type' => 'text','label'=>false,'div'=>false,'style'=>'width:140px'))?></td><td><a onclick="addContact(this);" >&nbsp;Add</a></td></tr>
					
					</tbody>
			</table> 
		</div>
		
		
	</div>
		<h4 class="title"><span>Terms and Conditions</span></h4>
		<p>Use of this website is guided with the following terms and conditions:</p>
		<div style="margin-bottom: 30px;">
			<?php echo $this->Form->input('agree',array('label'=>false,'type'=>'checkbox', 'style'=>'float: left; margin: 5px 10px 0 0;'));?>
			<p style="float: left; text-align: center;">This certifies that I've read and accept the terms and conditions of this website. </p>
		</div>
		<h4 class="title"><span>Disclaimer</span></h4>
		<div style="margin-bottom: 20px;">
			<p style="text-align: center;">Author of this website. </p>
		</div>
		<?php echo $this->Form->submit('Submit',array('class'=>'form_save',"onclick"=>"return false;"));?>
		<?php echo $this->Form->end();?>
</div>
         <?php echo $this->element('sidebar');?>
<script>
 var laboratory = {};
// var $j = jQuery.noConflict();
//		alert(jQuery('.comopt').val());
	jQuery('input#CompanyComopt2.comopt').change(function(){
		jQuery('#CompanyName').addClass('autocomplete');
		if(jQuery('#CompanyName').val() == 'Enter your company'){
			
		}else{
			jQuery('#CompanyName').val('Enter your company');
		}
		jQuery('.autocomplete').autocomplete({
		    source: '/laboratories/getCompanies',
		    minLength:2,
		    select: function (event,ui) {
				jQuery('.comid').val(ui.item.id);
		    }
		});
	});
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
		}else{
			//do nothing
		}
	});
	
 jQuery(document).ready(function(){
	 jQuery('form').attr('autocomplete','off');
	jQuery('.current-crumb').text(' SIGN UP');
	jQuery('div.submit input.form_save').click(function(){
		if(jQuery('#UserAgree').is(':checked')){
			
		}else{alert('Please read and accept the terms and conditions of the website. Thank you!');}
	});
	jQuery('#UserAgree').change(function(){
		if(jQuery(this).is(':checked')){
			jQuery('.form_save').removeAttr('onclick');
		}else{
			jQuery('.form_save').attr('onclick','return false;');
		}
	});
	
	jQuery('#my_map').gmapplot({
		selectable_location:true,
		resizable:true,
		latInputAttr:{name:"data[Company][CompanyBranch][CompanyBranchAddress][Address][latitude]"},
		lngInputAttr:{name:"data[Company][CompanyBranch][CompanyBranchAddress][Address][longitude]"}
	});
	jQuery('#my_map').gmapplot('locate',locateAddress());
	jQuery('.address_field').change(function(){
		jQuery('#my_map').gmapplot('locate',locateAddress());
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
 });
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
	function addContact(a){
		contact = jQuery('#ContactContact').val();
		if(contact.length){
			type = jQuery('#ContactType').val();
			typename = jQuery('#ContactType').find('option:selected').text();
			tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:140px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;" onclick="removeContact(this);">&nbsp;&nbsp;X</a></td></tr>';
			jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
			reindexorder('.contact_info_tbl tbody tr');	
			jQuery('#ContactContact').val('');
		}else{
			alert('Please type your contact detail.');
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

 </script>