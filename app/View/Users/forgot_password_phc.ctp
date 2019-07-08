<?php $this->set('title_for_layout', 'Online Services');?>
<style type="text/css">
	.instructions {
		display: inline-block;
		width: 50%;
		font-size: 11px;
		vertical-align: top;
		height:400px;
		text-align: justify;
		padding: 18px 3px 3px 29px;
	}
	.list-instruct li {
		list-style-type: circle;
		font-size: 12px;
		
	}
	.list-instruct ul {
		list-style-type: circle;
		font-size: 12px;
		padding-left: 20px;
	}
	
	.importants {
		display: inline-block;
		width: 50%;
		font-size: 11px;
		vertical-align: top;
		height:50px;
		text-align: justify;
		padding: 18px 3px 3px 29px;
	}
	.list-import li {
		list-style-type: circle;
		font-size: 12px;
		
	}
	.list-import ul {
		list-style-type: circle;
		font-size: 12px;
		padding-left: 20px;
	}
	.login {
		width: 98%;
		margin: auto;
		background: #E88D8D;
		color: #000;
		padding: 5px;
		border: 1px solid #333;
		border-radius: 5px;
		font-family: sans-serif;
	}
	

	input[type="text"],input[type="password"], textarea, select {
    border: 1px solid #CCC;
    padding: 4px;
    border-radius: 5px;
    color: #333;
	}
	input[type="text"]:hover,input[type="password"]:hover, textarea:hover, select:hover {
    border: 1px solid #C14646;
    padding: 4px;
    border-radius: 5px;
    color: #333;
	}
	
	i {color : yellow;}
input[type=text]:focus, input[type=password]:focus, input.text:focus, textarea:focus{ border-color:#C14646; }
	
</style>
<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'forgot_password_phc','autocomplete'=>'off'));?>
<div align="center" >
	<div  class="forgot_password">
		<h1 style="margin-bottom: 20px;font-weight: bold;">Account verification</h1>
	                    			
		
		<span class="errormessage"style="color: #F00; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif;">
		</span>
		

		<div>
			<div>
				Enter username: <?php echo $this->Form->input('username',array('id' => 'username','type' => 'text','label'=>false,'div'=>false,'placeholder'=>'Username'));?>
			</div>
		</div></br>

		<div class="captcha-bkg" style="width:300px;height:150px;border:1px solid #C14646;padding:5px;border-radius: 5px;">
			<div style="width:290px;height:140px;border:1px solid #C14646;padding:5px;border-radius: 4px;background-color:#">
				<div style="width:98%;border: 1px solid #C14646;padding:1px;text-align:center;background:white;border-radius:4px;">
					<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;width:220px;'));?>
				</div>
				<?php echo '<p style="margin-top:2px;"><a href="/nazareth/Users/forgot_password_phc" id="a-reload">Can\'t read? Reload</a></p>';?>
				<?php echo $this->Form->input('User.captcha',array('required'=>'required','placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'div'=>true,'style'=>'width:90%;'));?>
			</div>
		</div>
		<?php echo $this->Form->end('Submit');?>
	</div>
	
</div>	

<!--<div id="dialogModal">
	<div id="changepassword" title="Change Password" style="display:none">
				 <table  id="double-td-tbl2">
				 <?php echo $this->Form->create('User',array('action'=>'change_password','class'=>'changePasswordFrm'))?>
					<tr>
				 		<td>
				 			<?php echo $this->Form->input('id',array('type'=>'hidden','label'=>false,'class'=>'userid'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>Old Password</td>
				 		<td>
				 			<?php echo $this->Form->input('oldpassword',array('type'=>'password','label'=>false,'class'=>'oldpassword','placeholder'=>'Old Password'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>New Password</td>
				 		<td>
				 			<?php echo $this->Form->input('newpassword',array('type'=>'password','label'=>false,'class'=>'newpassword','placeholder'=>'New Password'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>Confirm New Password</td>
				 		<td>
				 			<?php echo $this->Form->input('confpassword',array('type'=>'password','label'=>false,'class'=>'confpassword','placeholder'=>'Confirm Password'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>
							<?php echo $this->Form->submit('Change',array('class'=>'changePass','onclick'=>' return false;'));?>
							<?php echo $this->Form->end();?>
				 		</td>
				 	</tr>
				 </table>
	</div>
</div>-->

<script type="text/javascript">
	function send_vcode(mobile){
		jQuery.ajax({
            url: '/nazareth/Users/forgot_password_vcode/'+mobile,
			type: 'GET',
			async:false,
			success:function(data){
				console.log('verification code has been sent.');
				
			}
		});
	}
	jQuery(document).ready(function(){
		jQuery('#username').focus();
		jQuery('#UserForgotPasswordPhcForm :submit').click(function(){  
			 userid = jQuery('#username').val();
			 jQuery.ajax({
                url: '/nazareth/Users/verify_username',
				type: 'POST',
				dataType : 'json',
				data: jQuery('#UserForgotPasswordPhcForm').serialize(),
				async:false,
				success:function(data){
					jQuery('.errormessage').html('').html(data.error_message);
					if(data.error)
						console.log('Error');
					else{
						jQuery(':input').focus();
						mobile_hint = data.result.trim();
						last_digits = mobile_hint.slice(-3);
						jQuery('.forgot_password').empty().append(
							"<h1 style='margin-bottom: 20px;font-weight: bold;'>Get a verification code</h1>"+
							"<span class='errormessage'style='color: #F00; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif;'></span>"+
							"</br><div>To get a verification code, first confirm the phone number you added to your account •••• ••• •"+last_digits+"."+"  </div></br>"+
							"</div><div>Enter mobile: <input type='text' class='mobile_number'></input></div>"+
							"<div class='submit'><input type='submit' value='Submit' class='mobile_submit'></div>"
							);
					}
					jQuery('.mobile_submit').click(function(){ 
						jQuery(':input').focus();
						mobilenumber = data.result;
						input_mobile = jQuery('.mobile_number').val();
						trimmed_m = mobilenumber.trim();
						trimmed_i_m = input_mobile.trim();
						if(trimmed_m==trimmed_i_m) {
							//mobile_number="09178045641";
							mobile_number=jQuery('.mobile_number').val();
							send_vcode(mobile_number);
							jQuery('.forgot_password').empty().append(
									"<h1 style='margin-bottom: 20px;font-weight: bold;'>Mobile Verification</h1>"+
									"<span class='errormessage'style='color: #F00; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif;'></span>"+
									"</br><div>You'll receive a verification code shortly.</div></br>"+
									"</div><div>Enter verification code: <input type='text' class='vcode' name='data[User][pin]'></input><span padding='4px;'><a href='#' class='resend_vcode'>Resend</a></span></div>"+
									"<div class='submit'><input type='submit' value='Submit' class='vcode_submit'></div>"
									);
							jQuery('.vcode_submit').click(function(){ 
								jQuery(':input').focus();
								jQuery.ajax({
						            url: '/nazareth/Users/forgot_password_validate_vcode',
									type: 'POST',
									async:false,
									dataType : 'json',
									data: jQuery('#UserForgotPasswordPhcForm').serialize(),
									success:function(data){
										if(data.error)
											alert(data.error_message);
										else{
											jQuery.ajax({
								                url: '/nazareth/Users/forgot_password_reset/'+userid,
												type: 'GET',
												dataType : 'json',
												async:false,
												success:function(data){
													if(data.error)
														alert(data.error_message);
													else{
														alert('Your password has been reset, it will be your birthdate with format mmddyyyy.');
														window.location="/";
													}
												}
											});
										}
									}
								});
								return false;
							});
							jQuery('.resend_vcode').click(function(){ 
								jQuery(':input').focus();
								send_vcode(mobile_number);
								return false;
							});
						}
						else{
							jQuery('.errormessage').html('').html('Mobile number didn\'t match to our record.');
						}
						return false;
					});

                   //console.log(data);
                }
            });
	   		return false;
		});
		/* jQuery('input.changePass').click(function(){
			jQuery.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_password', 'patient' => false)); ?>",
        		data:jQuery('.changePasswordFrm').serialize(),
				type: 'POST',
				dataType : 'json',
//				asynch:false,
				success:function(data){
                    if(data == 1){
                    	alert('You are successfully changed your password.');
                      	jQuery("#changepassword :password").each(function(){
            				jQuery(this).val('');
                        });
                    	jQuery( "#changepassword" ).dialog('close');
                    }else if(data == 2){
                    	alert('New password and Confirm new password are not match!.');
                    }else if(data == 3){
                    	alert('Incorrect old password entered. Please enter correct password.');
                    }else{
                    	alert('Unable to change password. Please complete all fields.');
                    }
                }
            });
		}); */
	});
</script>

