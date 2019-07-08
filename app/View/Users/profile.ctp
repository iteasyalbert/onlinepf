<style>
	p{line-height: 20px !important}
</style>
<script>
	var uploadType = 0;
	var $uploadImageButton;
</script>
<?php $address = (isset($this->data['Address']))?$this->data['Address']:array();?>
<?php $contacts = (isset($this->data['Person']['Contacts']))?$this->data['Person']['Contacts']:array();?>
<?php //echo $this->Html->script('jquery-ui-1.8.20.custom.min2.js');?>
<div class="content">
<?php echo $this->Form->create('Person',array('class'=>'patient_form','enctype' => 'multipart/form-data'));?>
	<img id="wizard" src="/img/wizard_profile.png" style="margin-bottom: 20px;width:100%;">
	<p>Thank your very much for confirming your email address.</p><br/>
	<p>We are requesting that you complete your profile by filling-up the following information below. These information will help MRO in providing you quality services.</p>
	<br/>
<!--	<h4 class="title"><span>PROFILE</span></h4>-->

<div id="main-tab" class="widget-result" style="float:left;">
			<ul class="tabnav">

            </ul>
	 <div id="profile" class="tabdiv" style="float:left;">
	 		
	           
		<div id="profile-div">
			 <div style="width:auto;float:left;">
	             <table id="profile-table" class="profile-table-class" style="width:auto;">
					<tr><td><h2>PROFILE</h2></td><td></td></tr>
					<?php echo $this->Form->hidden('id',/*$title,*/array('label'=>false, 'type'=>'text','div'=>false));?>
					<?php echo $this->Form->input('image',array('type' => 'hidden','label'=>false,'div'=>false));?>
					<?php echo $this->Form->input('new_image',array('type' => 'hidden','label'=>false,'div'=>false,'class' =>'webcam-input'));?>
					<tr class="id"><td><label>ID/Username:</label></td><td><?php echo $this->Form->input('myresultonline_id',array('label'=>false, 'type'=>'text','div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="title"><td><label>Title:</label></td><td><?php echo $this->Form->select('title_id',$title,array('label'=>false,'div'=>false,'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="last"><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="first"><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="middle"><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="gender"><td><label>Gender:</label></td><td style="padding: 5px 5px;"><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="marital"><td><label>Marital Status:</label></td><td><?php echo $this->Form->select('marital_status',array('S'=>'Single','M'=>'Married','W'=>'Widowed'),array('label'=>false,'div'=>false,'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
					<tr class="birth"><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false,'class'=>'datepicker','readonly'=>'readonly','type'=>'text'));?><i><span class="span-req" >*</span></i></td></tr>
					
				</table>
			
				
<!--			</div>-->
<!--			<div style="width:100%;float:left;">-->
				<div style="width:auto;">
	                <table class="profile-table-class" style="width:100%" >
						<tr><td><h2>ADDRESS:</h2></td><td>
							<?php //echo $this->Form->input('.Address.id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
							<?php //echo $this->Form->input('Address.person_address_id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
						</td></tr>
						<tr class="province"><td style="width: 100px;"><label>Province:</label>
							</td><td><?php echo $this->Form->input('Address.province_state_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $provinces,'class' => 'address_select','title' => 'address_select_1'));?><i><span class="span-req" >*</span></i></td>
						</tr>
						<tr class="town"><td><label>Town/City:</label></td><td><?php echo $this->Form->input('Address.town_city_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $townCities,'class' => 'address_select','title' => 'address_select_2'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr class="brgy"><td><label>Barangay:</label></td><td><?php echo $this->Form->input('Address.village_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $villages,'class' => 'address_select','title' => 'address_select_3'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr class="street"><td><label>Street:</label></td><td><?php echo $this->Form->input('Address.street_number',array('label'=>false,'div'=>false,'type' => 'text','placeholder'=>'This is required if no lot and block'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr class="lot"><td><label>Lot:</label></td><td><?php echo $this->Form->input('Address.lot',array('label'=>false,'div'=>false,'type' => 'text','placeholder'=>'This is required if no street'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr class="block"><td><label>Block:</label></td><td><?php echo $this->Form->input('Address.block',array('label'=>false,'div'=>false,'type' => 'text','placeholder'=>'This is required if no street'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr><td><label>Unit:</label></td><td><?php echo $this->Form->input('Address.unit',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
						<tr><td><label>Floor:</label></td><td><?php echo $this->Form->input('Address.floor',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
						
	
					</table>
				</div>
	
			</div>
			 <div style="width:350px;float:left;">
				<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:45px 105px 130px 0;">
					<?php //echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
					<?php echo $this->Html->image('../img/poster-one-half-profile.jpg',array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
					<p class="actions" align="center" style="width:100%;min-width:100%;">
						<a id="take-photo" style="cursor:pointer;" > Take a Photo</a>
						<script>
							var filelocation = "../../../js/jscam.swf";
						</script>
						<?php echo $this->element('webcamui');?>
					</p>
					
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
							<?php echo $this->Form->input('upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image'));?>
						</label>
					</div>
				</div>
				<div style="float: right;">
					 <table id="profile-table" class="contact_info_tbl" >
						<tr><td colspan="3" ><h2>CONTACT DETAILS</h2></td></tr>
							<tbody>
							<?php if(isset($this->data['Person']['Contacts'])):?>
								<?php $ctr=0;foreach($this->data['Person']['Contacts'] as $contactInfo):?>
									<tr><td><label><?php echo $this->Form->input('ContactInformation.'.$ctr.'.id',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['id'],'class'=>'unique_id'));echo $this->Form->input('ContactInformation.'.$ctr.'.type',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['type'],'class'=>'unique_day'));echo $contactInfo['typename'];?></label></td><td><?php echo $this->Form->input('ContactInformation.'.$ctr++.'.contact',array('type'=>'text','div' => false,'label'=>false,'style'=>'width:135px','value'=>$contactInfo['contact']));?></td><td><a style="cursor:pointer;" onclick="removeContact(this);">&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>
								<?php endforeach;?>
							<?php endif;?>
							<tr class="contact"><td><?php echo $this->Form->input('Contact.type',array('type'=>'select','options'=>$contactTypes,'label'=>false,'div'=>false));?></td><td><?php echo $this->Form->input('Contact.contact',array('type' => 'text','label'=>false,'div'=>false,'style'=>'width:135px'))?></td><td><a style="text-decoration:none;" onclick="addContact(this);" ><i><span class="span-req" >*</span></i><img src="/img/add.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>
						</tbody>
					</table>
				</div>
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
 var person = {};
 var indexIdcon = 1;
 var contact_delid = 0;
 var address = <?php echo $this->Js->object($address);?>;
 var contact = <?php echo $this->Js->object($contacts);?>;
// function setFieldRequired(id,x,value){
////	alert(id+' and '+value);
//	if(x=='street_number' && value == null){
//		jQuery('#'+id).val('This is required if no lot and block').addClass('notify');
//	}else if(x=='lot' && value == null){
//		jQuery('#'+id).val('This is required if no street').addClass('notify');
//	}else if(x=='block' && value == null){
//		jQuery('#'+id).val('This is required if no street').addClass('notify');
//	}
// }
 jQuery(document).ready(function(){
	
	jQuery.each(address,function(x,y){
		id = 'Address'+ camelize(x);
			if(x == 'village_id'){
				var inputVal = y;if(inputVal == null){jQuery('tr.province td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.province td:eq(1) i span.span-req').text() == "*"){jQuery('tr.province td:eq(1) i span.span-req').append('');}}else{jQuery('tr.province td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}
			if(x == 'province_state_id'){
				var inputVal = y;if(inputVal == null){jQuery('tr.town td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.town td:eq(1) i span.span-req').text() == "*"){jQuery('tr.town td:eq(1) i span.span-req').append('');}}else{jQuery('tr.town td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}
			if(x == 'town_city_id'){
				var inputVal = y;if(inputVal == null){jQuery('tr.brgy td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.brgy td:eq(1) i span.span-req').text() == "*"){jQuery('tr.brgy td:eq(1) i span.span-req').append('');}}else{jQuery('tr.brgy td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}
			
			if(x == 'street_number'){
				var inputVal = y;if(inputVal == ""){jQuery('tr.street td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.street td:eq(1) i span.span-req').text() == "*"){jQuery('tr.street td:eq(1) i span.span-req').append('');}}else{jQuery('tr.street td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
//				setFieldRequired(id,x,inputVal);
			}
			if(x == 'lot'){
				var inputVal = y;if(inputVal == ""){jQuery('tr.lot td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.lot td:eq(1) i span.span-req').text() == "*"){jQuery('tr.lot td:eq(1) i span.span-req').append('');}}else{jQuery('tr.lot td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
//				setFieldRequired(id,x,inputVal);
			}
			if(x == 'block'){
				var inputVal = y;if(inputVal == ""){jQuery('tr.block td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.block td:eq(1) i span.span-req').text() == "*"){jQuery('tr.block td:eq(1) i span.span-req').append('');}}else{jQuery('tr.block td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
//				setFieldRequired(id,x,inputVal);
			}
	});
	jQuery.each(contact,function(){
		jQuery('tr.contact td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');

	});
		
	 jQuery('table.profile-table-class input[type="text"]').css('width','190px');
     jQuery('table.profile-table-class tr td select').css('width','203px');

	jQuery('#take-photo').click(function(){
		jQuery( "#webcam-dialog" ).dialog('open');
	});
	jQuery('a.ui-dialog-titlebar-close ui-corner-all').click(function(){
		jQuery( "#webcam-dialog" ).dialog('close');
	});
	jQuery('.current-crumb').text(' SIGN UP');
	
//	jQuery('div.submit input.form_save').click(function(){
//		if(jQuery('#PersonAgree').is(':checked')){
//
//		}else{flashErrorMessage('Please read and accept the terms and conditions of the website. Thank you!');}
//	});
	jQuery('div.submit input.form_save,ContactInformation0Contact').live('click',function(){
		var checkForm = validationForm('Address','Person');
		if(checkForm){
			if(jQuery('#PersonAgree').is(':checked')){
				jQuery('.form_save').removeAttr('onclick');
			}else{flashErrorMessage('Please read and accept the terms and conditions of the website. Thank you!');}
		}else{flashErrorMessage('Some fields are required.');}
	});
	
	jQuery('#PersonAgree').change(function(){
		var checkForm = validationForm('Address','Person');
		if(checkForm){
			if(jQuery(this).is(':checked')){
				jQuery('.form_save').removeAttr('onclick');
			}else{
				jQuery('.form_save').attr('onclick','return false;');
			}
		}else{flashErrorMessage('Some fields are required.');}
	});
	
	<?php if(isset($person)):?>
	person = <?php echo $this->Js->object($person);?>;
	jQuery.each(person['Person'],function(x,y){
		id = 'Person'+ camelize(x);
//		alert(x+"="+y);
		if(x == 'sex'){
			jQuery('#'+id+y).attr('checked','checked');
			if(jQuery('#PersonSexM').is(":checked")){
				if(jQuery('#PersonSexM').is(":checked")){jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}
			}else if(jQuery('#PersonSexF').is(":checked")){
				if(jQuery('#PersonSexF').is(":checked")){jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}
			}
		}else if(x == 'birthdate'){
			var inputVal = y;if(inputVal == null){jQuery('tr.birth td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.birth td:eq(1) i span.span-req').text() == "*"){jQuery('tr.birth td:eq(1) i span.span-req').append('');}}else{jQuery('tr.birth td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}else if(x == 'lastname'){
			var inputVal = y;if(inputVal == null){jQuery('tr.last td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.last td:eq(1) i span.span-req').text() == "*"){jQuery('tr.last td:eq(1) i span.span-req').append('');}}else{jQuery('tr.last td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}else if(x == 'firstname'){
			var inputVal = y;if(inputVal == null){jQuery('tr.first td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.first td:eq(1) i span.span-req').text() == "*"){jQuery('tr.first td:eq(1) i span.span-req').append('');}}else{jQuery('tr.first td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}else if(x == 'middlename'){
			var inputVal = y;if(inputVal == null){jQuery('tr.middle td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.middle td:eq(1) i span.span-req').text() == "*"){jQuery('tr.middle td:eq(1) i span.span-req').append('');}}else{jQuery('tr.middle td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}else if(x == 'title_id'){
			var inputVal = y;if(inputVal == null){jQuery('tr.title td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.title td:eq(1) i span.span-req').text() == "*"){jQuery('tr.title td:eq(1) i span.span-req').append('');}}else{jQuery('tr.title td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}else if(x == 'myresultonline_id'){
			var inputVal = y; if(inputVal == null){jQuery('tr.id td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.id td:eq(1) i span.span-req').text() == "*"){jQuery('tr.id td:eq(1) i span.span-req').append('');}}else{jQuery('tr.id td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}else if(x == 'marital_status'){
			var inputVal = y;if(inputVal == null){jQuery('tr.marital td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.marital td:eq(1) i span.span-req').text() == "*"){jQuery('tr.marital td:eq(1) i span.span-req').append('');}}else{jQuery('tr.marital td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
		}
		

		
		if(x == 'image'){
			if(y != null ){
				jQuery('#idpic').attr('src','/media/profiles/'+y);
			}
		}
		jQuery('#'+id).val(y);
	});
<?php endif;?>
$uploadImageButton = jQuery(".browse_image").clone();
$uploadImageButton.change(updateImagePreview);
jQuery(".browse_image").change(updateImagePreview);

checkInput();
jQuery('#ContactContact').live('focusout',function(){
	var inputVal = jQuery(this).val();
	if(inputVal != ""){
		addContact();
	}
});

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
	        	jQuery('#idpic').attr('src',datauri);
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
//			tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:135px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;text-decoration:none;" onclick="removeContact(this);">&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>';
//			jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
//			reindexorder('.contact_info_tbl tbody tr');
//			jQuery('#ContactContact').val('');
//		}else{
//			flashErrorMessage('Please type your contact detail.');
//		}
//	}
	

            
    function addContact(a){
        contact = jQuery('#ContactContact').val();

        if(contact.length){
            type = jQuery('#ContactType').val();
            valid = isValidContactDetail(contact,type);
            if(valid){
            typename = jQuery('#ContactType').find('option:selected').text();
            tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:135px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;text-decoration:none;" onclick="removeContact(this);">&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>';
            jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
            reindexorder('.contact_info_tbl tbody tr');
            jQuery('#ContactContact').val('');
            jQuery('.error_message').css('display','none');
       	 	}else{
            	flashErrorMessage('Invalid contact. Please check your contact detail first.');
        	}

        }else{
            flashErrorMessage('Please type your contact detail.');
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
//	function removeContact(a){
//		rowcon = jQuery(a).parent().parent().html();
//		contact_delid = jQuery(rowcon).find('input.unique_id').val();
//		statusinput = '<input type="hidden" name="data[ContactInformationDelete]['+indexIdcon+'][id]" id="ContactInformationDelete0" value="'+contact_delid+'">';
//		jQuery(statusinput).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
//		indexIdcon += 1;
//		jQuery(a).parent().parent().remove();
//		reindexorder('.contact_info_tbl tbody tr');
//	}
	function validationForm(address,person){
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
			if(person == "Person"){
				PersonMROIdInput = jQuery("#"+person+"MyresultonlineId").val();
				PersonTitleInput = jQuery("#"+person+"TitleId").val();
				PersonLastnameInput = jQuery("#"+person+"Lastname").val();
				PersonFirstnameInput = jQuery("#"+person+"Firstname").val();
				PersonMiddlenameInput = jQuery("#"+person+"Middlename").val();

				PersonMaritalInput = jQuery("#"+person+"MaritalStatus").val();
				PersonBirthdateInput = jQuery("#"+person+"Birthdate").val();
				
				ContactInput = jQuery('#ContactInformation0Contact').val();
				if(PersonMROIdInput == "" || PersonTitleInput == "" || PersonLastnameInput == "" || PersonFirstnameInput == "" || PersonMiddlenameInput == "" || PersonMaritalInput == "" || PersonBirthdateInput == "" || ContactInput == undefined){result = false;}
				if(jQuery('#PersonSexM').is(':checked')){
				}else if(jQuery('#PersonSexF').is(':checked')){
				}else{result = false;}
			}
		return result;
	}
	function checkInput(){
		var inputUserVal = '';
		var inputPassVal = '';
		var result = "";
		jQuery('#PersonLastname').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.last td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.last td:eq(1) i span.span-req').text() == "*"){jQuery('tr.last td:eq(1) i span.span-req').append('');}}else{jQuery('tr.last td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonFirstname').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.first td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.first td:eq(1) i span.span-req').text() == "*"){jQuery('tr.first td:eq(1) i span.span-req').append('');}}else{jQuery('tr.first td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonMiddlename').live('focusout',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.middle td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.middle td:eq(1) i span.span-req').text() == "*"){jQuery('tr.middle td:eq(1) i span.span-req').append('');}}else{jQuery('tr.middle td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonTitleId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.title td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.title td:eq(1) i span.span-req').text() == "*"){jQuery('tr.title td:eq(1) i span.span-req').append('');}}else{jQuery('tr.title td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonMyresultonlineId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.id td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.id td:eq(1) i span.span-req').text() == "*"){jQuery('tr.id td:eq(1) i span.span-req').append('');}}else{jQuery('tr.id td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonMaritalStatus').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.marital td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.marital td:eq(1) i span.span-req').text() == "*"){jQuery('tr.marital td:eq(1) i span.span-req').append('');}}else{jQuery('tr.marital td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonBirthdate').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.birth td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.birth td:eq(1) i span.span-req').text() == "*"){jQuery('tr.birth td:eq(1) i span.span-req').append('');}}else{jQuery('tr.birth td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonSexM').live('click',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}else{jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
		jQuery('#PersonSexF').live('click',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}else{jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

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
 <style>
    .ui-dialog .ui-dialog-titlebar {
        background:#ccc;
    }
    .visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr:hover td {
        background:#687719;
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
    input[type="text"], textarea,select{
        border-color:#7B7B7B #CBCCCE #CBCCCE #7B7B7B;
        border-radius: 2px;
    }
    select{
        width: 214px;
    }

	
</style>
