<style>
	p{line-height: 20px !important}
</style>
<script>
	var uploadType = 0;
	var $uploadImageButton;
</script>
<div class="content">
	<img id="wizard" src="/img/wizard_profile.png" style="margin-bottom: 20px;width:100%;">
	<p>Thank your very much for confirming your email address.</p><br/>
	<p>We are requesting that you complete your profile by filling-up the following information below. These information will help MRO in providing you quality services.</p>
	<br/>
<div id="main-tab" class="widget-result">
		<ul class="tabnav">

        </ul>
	<div id="profile" class="tabdiv" style="margin-bottom: 10px;">
            <?php echo $this->Form->create('Person',array('class'=>'patient_form','enctype' => 'multipart/form-data'));?>
		<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 105px 0 0;">
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
		        select{
		        	width: 91% !important;
		        }
		    </style>
			<div class="myfileupload-buttonbar ">
	            <label class="myui-button">
	                <span >Choose File</span>
					<?php echo $this->Form->input('upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image'));?>
				</label>
			</div>
		</div>
		<br/>
		<div id="profile-div">
			<table id="profile-table" class="profile-table-class" style="width:55%;">
			<tr><td><h2>PROFILE</h2></td><td></td></tr>
				<?php echo $this->Form->hidden('id',/*$title,*/array('label'=>false, 'type'=>'text','div'=>false));?>
				<?php echo $this->Form->input('image',array('type' => 'hidden','label'=>false,'div'=>false));?>
				<?php echo $this->Form->input('new_image',array('type' => 'hidden','label'=>false,'div'=>false,'class' =>'webcam-input'));?>
							<tr class="id"><td><label>ID/Username:</label></td><td><?php echo $this->Form->input('myresultonline_id',array('label'=>false, 'type'=>'text','div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="title"><td><label>Title:</label></td><td><?php echo $this->Form->select('title_id',$title,array('label'=>false,'div'=>false,'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="last"><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="first"><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="middle"><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="gender"><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="marital"><td><label>Marital Status:</label></td><td><?php echo $this->Form->select('marital_status',array('S'=>'Single','M'=>'Married','W'=>'Widowed'),array('label'=>false,'div'=>false,'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="birth"><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false,'class'=>'datepicker','readonly'=>'readonly','type'=>'text'));?><i><span class="span-req" >*</span></i></td></tr>
			<tr class="specialty"><td><label>Specialty:</label></td><td><?php echo $this->Form->select('PersonEducationalBackground.education_major_id',$specialty,array('legend'=>false,'label'=>false,'div'=>false));?><i><span class="span-req" ></span></i></td></tr>
			<tr class="subspecialty"><td><label>Subspecialty:</label></td><td><?php echo $this->Form->select('PersonEducationalBackground.education_minor_id',$specialty,array('legend'=>false,'label'=>false,'div'=>false));?><i><span class="span-req" ></span></i></td></tr>
			</table>
		</div>
	</div>
</div>
		<h4 class="title" style="margin-bottom:10px"><span>Terms and Conditions</span></h4>
		<p>Use of this website is guided with the following terms and conditions:</p>
		<h6><a onclick="window.open('/Membership/view/terms_and_conditions')" style="cursor:pointer;">Terms and Conditions</a></h6>
		<div style="margin-bottom: 30px;">
			<p style="float: left; text-align: center;">
			<?php echo '<label for="PersonAgree"><strong>Accept</strong></label>'.$this->Form->input('agree',array('div'=>false,'label'=>false,'type'=>'checkbox', 'style'=>'float: left; margin: 5px 0px 0 0;'));?>
			This certifies that I've read and accept the terms and conditions of this website. </p>
		</div>
<!--		<h4 class="title"><span>Disclaimer</span></h4>-->
<!--		<div style="margin-bottom: 20px;">-->
<!--			<p style="text-align: center;">Author of this website. </p>-->
<!--		</div>-->
		<?php echo $this->Form->submit('Submit',array('class'=>'form_save',"onclick"=>"return false;"));?>
		<?php echo $this->Form->end();?>
</div>
         <?php echo $this->element('sidebar');?>
         
<script>
var person = {};
jQuery(document).ready(function(){
	jQuery('#take-photo').click(function(){
		jQuery( "#webcam-dialog" ).dialog('open');
	});
	jQuery('a.ui-dialog-titlebar-close ui-corner-all').click(function(){
		jQuery( "#webcam-dialog" ).dialog('close');
	});
	
//	jQuery('div.submit input.form_save').click(function(){
//		if(jQuery('#PersonAgree').is(':checked')){
//
//		}else{flashErrorMessage('Please read and accept the terms and conditions of the website. Thank you!');}
//	});
//
//	jQuery('#PersonAgree').change(function(){
//		if(jQuery(this).is(':checked')){
//			jQuery('.form_save').removeAttr('onclick');
//		}else{
//			jQuery('.form_save').attr('onclick','return false;');
//		}
//	});
	jQuery('div.submit input.form_save').click(function(){
		var checkForm = validationForm('Person');
		if(checkForm){
			if(jQuery('#PersonAgree').is(':checked')){
				jQuery('.form_save').attr('onclick','return false;');
			}else{flashErrorMessage('Please read and accept the terms and conditions of the website. Thank you!');}
		}else{flashErrorMessage('Some fields are required.');}
	});
	
	jQuery('#PersonAgree').change(function(){
		var checkForm = validationForm('Person');
		if(checkForm){
			if(jQuery(this).is(':checked')){
				jQuery('.form_save').removeAttr('onclick');
			}else{
				jQuery('.form_save').attr('onclick','return false;');
			}
		}else{flashErrorMessage('Some fields are required.');}
	});
	jQuery('.current-crumb').text(' SIGN UP');
	
	<?php if(isset($person)):?>
		person = <?php echo $this->Js->object($person);?>;
		jQuery.each(person['0']['People'],function(x,y){
			id = 'Person'+ camelize(x);
			if(x == 'sex'){
				jQuery('#'+id+y).attr('checked','checked');
				if(jQuery('#PersonSexM').is(":checked")){jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}
				if(jQuery('#PersonSexF').is(":checked")){jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}
			}else if(x == 'birthdate'){
				 var birth = new Date(y);
				 var y = $.datepicker.formatDate("mm/dd/yy", birth);
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
//			alert(id+'=>'+y);
		});
	<?php endif;?>
	jQuery('form#PatientProfile input').each(function(x,y){
//		alert(x+"=>"+y);
	});
	 currentdate = new Date();
	 startyear = parseInt(currentdate.getFullYear()) - 80;
	 endyear = parseInt(currentdate.getFullYear()) - 16;
	jQuery(".datepicker").datepicker({
		dateFormat:'mm/dd/yy',
		changeMonth:true,
		changeYear:true,
		yearRange:startyear+":"+endyear,
		defaultDate: '-80y'//startyear+'/'+(parseInt(currentdate.getMonth())+1)+'/'+currentdate.getDate()
		});
	
	$uploadImageButton = jQuery(".hiddenAdsFormSec .browse_image").clone();
	$uploadImageButton.change(updateImagePreview);
	
	jQuery(".browse_image").change(updateImagePreview);
	checkInput();
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
function validationForm(person){
	var result = true;
		if(person == "Person"){
			PersonLastnameInput = jQuery("#"+person+"Lastname").val();
			PersonFirstnameInput = jQuery("#"+person+"Firstname").val();
			PersonMiddlenameInput = jQuery("#"+person+"Middlename").val();

//			PersonMaritalInput = jQuery("#"+person+"MaritalStatus").val();
			PersonBirthdateInput = jQuery("#"+person+"Birthdate").val();
			
			PersonBirthdateInput = jQuery("#"+person+"Birthdate").val();
			
			BackgroundMajorInput = jQuery("#PersonEducationalBackgroundEducationMajorId").val();
			BackgroundMinorInput = jQuery("#PersonEducationalBackgroundEducationMinorId").val();
// 			if(PersonLastnameInput == "" || PersonFirstnameInput == "" || PersonMiddlenameInput == "" || PersonBirthdateInput == "" || BackgroundMajorInput == "" || BackgroundMinorInput == ""){result = false;}
			if(PersonLastnameInput == "" || PersonFirstnameInput == "" || PersonMiddlenameInput == "" || PersonBirthdateInput == ""){result = false;}
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

	//jQuery('#PersonEducationalBackgroundEducationMajorId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.province td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.specialty td:eq(1) i span.span-req').text() == "*"){jQuery('tr.specialty td:eq(1) i span.span-req').append('');}}else{jQuery('tr.specialty td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
	//jQuery('#PersonEducationalBackgroundEducationMinorId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.town td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.subspecialty td:eq(1) i span.span-req').text() == "*"){jQuery('tr.subspecialty td:eq(1) i span.span-req').append('');}}else{jQuery('tr.subspecialty td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

	jQuery('#ContactContact').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.contact td:eq(2) a i span.span-req').html('*').css('color','red');if(jQuery('tr.contact td:eq(2) a i span.span-req').text() == "*"){jQuery('tr.contact td:eq(2) a i span.span-req').append('');}}else{jQuery('tr.contact td:eq(2) a i span.span-req').html('&#10003;').css('color','#687719');}});
	

}
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function strLength(pass){
  var len = pass.length;
  return len;
}
</script>
 <style>
    select{
        width: 214px;
    }

	
</style>
