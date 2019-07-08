
<div class="flasherrormesage">
</div>
<div class="content">
	<?php if(isset($this->data['User']['membership_type']) && ($this->data['User']['membership_type'] == 3 || $this->data['User']['membership_type'] == 7)):?>
		<img id="wizard" src="/img/wizard_laboratory_username.png" style="margin-bottom: 20px;width:100%;">
	<?php else:?>
		<img id="wizard" src="/img/wizard_username.png" style="margin-bottom: 20px;width:100%;">
	<?php endif;?>
	<?php echo $this->Form->create('User',array('autocomplete'=>'off'));?>
	<div class="membership_type">
		<span style="font-weight: bold;">Membership Type:</span>
		<?php echo $this->Form->input('membership_type',array('value'=>(isset($this->data['User']['membership_type']))?$this->data['User']['membership_type']:9,'label'=>false,'type'=>'radio','div'=>false,'class'=>'membership-type','options'=>array('9'=>'PATIENT','6'=>'DOCTOR','3'=>'LABORATORY', '7'=>'HOSPITAL', '11'=>'CORPORATE'),'legend'=>false));?>
	</div>
	<?php
//		debug($this->data);
	?>
	<div id="profile" class="tabdiv" style="float:left;width:100%;">
		<div id="profile-div">
			<table id="profile-table" style="width:100%">
			<tr><td><h2>PROFILE</h2></td><td></td><td></td></tr>
			<tr class = "last"><td><label>Last Name:</label></td><td><?php echo $this->Form->input('Person.lastname',array('label'=>false,'div'=>false,'required'=>'required'));?></td><td><i><span class="span-req">*</span></i></td></tr>
			<tr class = "first"><td><label>First Name:</label></td><td><?php echo $this->Form->input('Person.firstname',array('label'=>false,'div'=>false,'required'=>'required'));?></td><td><i><span class="span-req">*</span></i></td></tr>
			<tr class = "user"><td><label>Email Address:</label></td><td><?php echo $this->Form->input('username',array('label'=>false,'div'=>false,'required'=>'required'));?></td><td><i><span class="span-req">*</span> <span class="span-mroid" style="color:#687719;">(This will be your MyResultOnline ID)</span></i></td></tr>
			<tr class = "confirm_user"><td><label>Re-Enter Email:</label></td><td><?php echo $this->Form->input('confirm_username',array('label'=>false,'div'=>false,'required'=>'required'));?></td><td><i><span class="span-req">*</span></i></td></tr>
			<tr class = "pass"><td><label>Password:</label></td><td><?php echo $this->Form->input('password',array('label'=>false,'div'=>false,'required'=>'required'));?></td><td><i><span class="span-req">*</span></i></td></tr>
			<tr class = "confirm_pass"><td><label>Re-Enter Password:</label></td><td><?php echo $this->Form->input('confirm_password',array('label'=>false,'div'=>false,'type'=>'password','required'=>'required'));?></td><td><i><span class="span-req">*</span></i></td></tr>
			</table>
		</div>
		<div class="captcha-bkg" style="width:290px;height:135px;border:1px solid #bbaf9b;padding:5px;border-radius: 4px;">
			<div style="width:276px;height:120px;border:1px solid #bbaf9b;padding:5px;border-radius: 4px;background-color:#fffae4">
				<div style="width:98%;border: 1px solid #bbaf9b;padding:1px;text-align:center;background:white;border-radius:4px;">
					<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;'));?>
				</div>
				<?php echo '<p style="margin-top:2px;"><a href="#" id="a-reload">Can\'t read? Reload</a></p><br/>';?>
				<?php //echo '<p>Enter security code shown above:</p>';?>
				<?php echo $this->Form->input('User.captcha',array('placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'div'=>true,'style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?>
			</div>
		</div>
		<?php echo $this->Form->submit('Submit');?>
        <?php echo $this->Form->end();?>
	</div>
</div>
<?php echo $this->element('sidebar');?>
<style></style>
<script>
jQuery('#a-reload').click(function() {
	var $captcha = $("#img-captcha");
    $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
	return false;
});
jQuery(document).ready(function(){
//	jQuery('.membership_type #UserMembershipType_').val(6);
	jQuery('.current-crumb').text(' SIGN UP');
//	jQuery('#PersonLastname').focus();
	jQuery('table#profile-table tr td:eq(0)').css({'width':'20%'});
	jQuery('table#profile-table tr td:eq(1)').css({'width':'43%'});
	jQuery('table#profile-table tr td:eq(2)').css({'width':'36%'});
	jQuery('div#profile-div table input[type="text"], div#profile-div table input[type="password"]').css('width','94%');
	jQuery('.membership_type .membership-type').change(function(){
		var mtype = jQuery(this).val();
		if(mtype == 3 || mtype == 7 || mtype == 11){
			jQuery('img#wizard').attr('src','/img/wizard_laboratory_username.png');
		}else if(mtype == 6 || mtype == 9){
			jQuery('img#wizard').attr('src','/img/wizard_username.png');
		}
	});
	checkInput();
});
var data = {};
function checkInput(){
	var inputUserVal = '';
	var inputPassVal = '';
	var result = "";
	jQuery('#PersonLastname').focusout(function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.last td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.last td:eq(2) i span.span-req').text() == "*"){jQuery('tr.last td:eq(2) i span.span-req').append(' ');}}else{jQuery('tr.last td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}});
	jQuery('#PersonFirstname').focusout(function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.first td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.first td:eq(2) i span.span-req').text() == "*"){jQuery('tr.first td:eq(2) i span.span-req').append(' ');}}else{jQuery('tr.first td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}});
	jQuery('#UserUsername').live('focusout',function(){inputUserVal = jQuery(this).val();if(inputUserVal == ''){jQuery('tr.user td:eq(2) i span.span-mroid').text('(This will be your M...)').attr('title','(This will be your MyResultOnline ID)');jQuery('tr.user td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.user td:eq(2) i span.span-req').text() == "*"){jQuery('tr.user td:eq(2) i span.span-mroid').text('(This will be your M...)').attr('title','(This will be your MyResultOnline ID)');jQuery('tr.user td:eq(2) i span.span-req').append(' ');}}else{if(IsEmail(inputUserVal)){jQuery('tr.user td:eq(2) i span.span-req').html('&#10003; ').css('color','#687719');jQuery('tr.user td:eq(2) i span.span-mroid').html('(This will be your MyResultOnline ID)');}else{jQuery('tr.user td:eq(2) i span.span-mroid').text('(This will be your My...)').attr('title','(This will be your MyResultOnline ID)');jQuery('tr.user td:eq(2) i span.span-req').text('* Invalid Email').css('color','red');}}});
	jQuery('#UserConfirmUsername').live('focusout',function(){var inputConUserVal = jQuery(this).val();if(inputConUserVal == ''){jQuery('tr.confirm_user td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.confirm_user td:eq(2) i span.span-req').text() == "*"){jQuery('tr.confirm_user td:eq(2) i span.span-req').append(' ');}}else{if(inputConUserVal == inputUserVal){jQuery('tr.confirm_user td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.confirm_user td:eq(2) i span.span-req').text('* Confirm email does not match').css('color','red');}}});
	jQuery('#UserPassword').live('focusout',function(){inputPassVal = jQuery(this).val();if(inputPassVal == ''){jQuery('tr.pass td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.pass td:eq(2) i span.span-req').text() == "*"){jQuery('tr.pass td:eq(2) i span.span-req').append(' ');}}else{if(strLength(inputPassVal) >= 5){jQuery('tr.pass td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.pass td:eq(2) i span.span-req').text('* Must be at least 5 characters').css('color','red');}}});
	jQuery('#UserConfirmPassword').live('focusout',function(){var inputConPassVal = jQuery(this).val();if(inputConPassVal == ''){jQuery('tr.confirm_pass td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.confirm_pass td:eq(2) i span.span-req').text() == "*"){jQuery('tr.confirm_pass td:eq(2) i span.span-req').append(' ');}}else{if(inputConPassVal == inputPassVal){jQuery('tr.confirm_pass td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.confirm_pass td:eq(2) i span.span-req').text('* Confirm password does not match').css('color','red');}}});

	data = <?php echo $this->Js->object($this->data);?>;
//	alert(JSON.stringify(data));
	if(data['User'] && data['Person']){
		jQuery('table#profile-table tbody tr td input').each(function(){
			id = jQuery(this).attr('id');
	//		result += $(this).attr('id')+'='+$(this).val();
			if(id == 'PersonLastname'){
				var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.last td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.last td:eq(2) i span.span-req').text() == "*"){jQuery('tr.last td:eq(2) i span.span-req').append(' ');}}else{jQuery('tr.last td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(id == 'PersonFirstname'){
				var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.first td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.first td:eq(2) i span.span-req').text() == "*"){jQuery('tr.first td:eq(2) i span.span-req').append(' ');}}else{jQuery('tr.first td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(id == 'UserUsername'){
				inputUserVal = jQuery(this).val();if(inputUserVal == ''){jQuery('tr.user td:eq(2) i span.span-mroid').text('(This will be your M...)').attr('title','(This will be your MyResultOnline ID)');jQuery('tr.user td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.user td:eq(2) i span.span-req').text() == "*"){jQuery('tr.user td:eq(2) i span.span-mroid').text('(This will be your M...)').attr('title','(This will be your MyResultOnline ID)');jQuery('tr.user td:eq(2) i span.span-req').append(' ');}}else{if(IsEmail(inputUserVal)){jQuery('tr.user td:eq(2) i span.span-req').html('&#10003; ').css('color','#687719');jQuery('tr.user td:eq(2) i span.span-mroid').html('(This will be your MyResultOnline ID)');}else{jQuery('tr.user td:eq(2) i span.span-mroid').text('(This will be your My...)').attr('title','(This will be your MyResultOnline ID)');jQuery('tr.user td:eq(2) i span.span-req').text('* Invalid Email').css('color','red');}}
			}else if(id == 'UserConfirmUsername'){
				var inputConUserVal = jQuery(this).val();if(inputConUserVal == ''){jQuery('tr.confirm_user td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.confirm_user td:eq(2) i span.span-req').text() == "*"){jQuery('tr.confirm_user td:eq(2) i span.span-req').append(' ');}}else{if(inputConUserVal == inputUserVal){jQuery('tr.confirm_user td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.confirm_user td:eq(2) i span.span-req').text('* Confirm email does not match').css('color','red');}}
			}else if(id == 'UserPassword'){
				inputPassVal = jQuery(this).val();if(inputPassVal == ''){jQuery('tr.pass td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.pass td:eq(2) i span.span-req').text() == "*"){jQuery('tr.pass td:eq(2) i span.span-req').append(' ');}}else{if(strLength(inputPassVal) >= 5){jQuery('tr.pass td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.pass td:eq(2) i span.span-req').text('* Must be at least 5 characters').css('color','red');}}
			}else if(id == 'UserConfirmPassword'){
				var inputConPassVal = jQuery(this).val();if(inputConPassVal == ''){jQuery('tr.confirm_pass td:eq(2) i span.span-req').html('* ').css('color','red');if(jQuery('tr.confirm_pass td:eq(2) i span.span-req').text() == "*"){jQuery('tr.confirm_pass td:eq(2) i span.span-req').append(' ');}}else{if(inputConPassVal == inputPassVal){jQuery('tr.confirm_pass td:eq(2) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.confirm_pass td:eq(2) i span.span-req').text('* Confirm password does not match').css('color','red');}}
			}
		});
	}

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