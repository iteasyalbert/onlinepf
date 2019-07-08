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
<div class="container">
	<div  class="forgot_password">
		<h1 style="margin-bottom: 20px;font-weight: bold;">Account verification</h1>
	                    			
		
		<span class="errormessage" style="color: black; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif;">
		</span>
		

		<div class="form-group">
			<div>
				Enter username: <?php echo $this->Form->input('username',array('id' => 'username','type' => 'text','label'=>false,'div'=>false,'placeholder'=>'Username','class'=>'form-control'));?>
			</div>
		</div>

		<div class="col-xs-12 no-padding captcha-bkg">
								<div style="width:100%;height:auto;">
									<div style="width:auto;height:auto;border: 1px solid #C14646;padding:1px;text-align:center;background:white;border-radius:4px;">
										<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:auto;width:100%;'));?>
									</div>
									<?php echo '<p style="margin-top:2px;"><a href="/Users/forgot_password_phc" id="a-reload">Can\'t read? Reload</a></p>';?>
									<?php echo '<p>Enter security code shown above:</p>';?>
									<!-- <?php echo $this->Form->input('User.captcha',array('required'=>'required','placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'div'=>true,'style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?> -->
									<input type="text" name="data[User][captcha]" type="text" class="form-control input-lg" id="captcha" style="margin-bottom: 5px !important;" placeHolder="Code" autocomplete="off" required="required" />
								</div>
							</div>
		<input type="Submit" name="submit" class="btn btn-danger btn-lg verify_username"  value="Submit" style="margin-bottom: 5px !important;width:100%;" />
	</div>
	
</div>	

<!-- <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
	                <h5 class="modal-title">Change Password</h5>
	            </div>
					<form action="/" class='changePasswordFrm'>
		 			<div class="form-group">
		 				<input type="hidden" name="data[User][id]" class="form-control userid">
		 			</div>
		 			<div class="form-group">
		 				<input type="password" name="data[User][newpassword]" class="form-control newpassword" placeholder="New Password">
		 			</div>
		 			<div class="form-group">
		 				<input type="password" name="data[User][confpassword]" class="form-control confpassword" placeholder="Confirm Password">
		 			</div>
					 <div class="modal-footer" style="margin:0px; padding:5px;">
		                <input type="submit" class="btn btn-danger btn-sm changePass" onclick="return false;">
		            </div>
				</form>
			</div>
	</div>
</div> -->

<script type="text/javascript">
	function send_vcode(mobile){
		jQuery.ajax({
            url: '/Users/forgot_password_vcode/'+mobile,
			type: 'GET',
			async:false,
			success:function(data){
				console.log('verification code has been sent.');
			}
		});
	}
	jQuery(document).ready(function(){
		jQuery('#username').focus();
		jQuery('.verify_username').click(function(){  
			 userid = jQuery('#username').val();
			 jQuery.ajax({
                url: '/Users/verify_username',
				type: 'POST',
				dataType : 'json',
				data: jQuery('#UserForgotPasswordPhcForm').serialize(),
				async:false,
				success:function(data){
					if(data.error)
						alert(data.error_message);
					else{
						jQuery(':input').focus();
						last_digits = data.result.slice(-3);
						jQuery('.forgot_password').empty().append(
							"<h1 style='margin-bottom: 20px;font-weight: bold;'>Get a verification code</h1>"+
							"</br><div class='form-group'>To get a verification code, first confirm the phone number you added to your account •••• ••• •"+last_digits+"."+"  </div>"+
							"<div class='form-group'><input type='text' placeholder='Enter mobile' class='form-control mobile_number'></input></div>"+
							"<div class='form-group submit'><input type='submit' value='Submit' class='form-control btn btn-danger btn-lg mobile_submit'></div>"
							);
					}
					jQuery('.mobile_submit').click(function(){ 
						jQuery(':input').focus();
						if(data.result==jQuery('.mobile_number').val()) {
							mobile_number=jQuery('.mobile_number').val();
							send_vcode(mobile_number);
							jQuery('.forgot_password').empty().append(
									"<h1 style='margin-bottom: 20px;font-weight: bold;'>Mobile Verification</h1>"+
									"<div class='form-group'> You'll receive a verification code shortly.</div>"+
									"<div class='form-group'><input type='text' placeholder='Enter verification code' class='form-control vcode' name='data[User][pin]' autocomplete='off' maxlength='4' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>"
									+"<span padding='4px;'><a href='#' class='resend_vcode'>Resend</a></span></div>"+
									"<div class='form-group submit'><input type='submit' value='Submit' class='form-control btn-danger btn-lg vcode_submit'></div>"
									);
							jQuery('.vcode_submit').click(function(){ 
								jQuery(':input').focus();
								jQuery.ajax({
						            url: '/Users/forgot_password_validate_vcode',
									type: 'POST',
									async:false,
									dataType : 'json',
									data: jQuery('#UserForgotPasswordPhcForm').serialize(),
									success:function(data){
										if(data.error)
											alert(data.error_message);
										else{
											// alert(userid);
											jQuery.ajax({
								                url: '/Users/forgot_password_reset/'+userid,
												type: 'GET',
												dataType : 'json',
												async:false,
												success:function(data){
													if(data.error)
														alert(data.error_message);
													else{
														alert('Your password has been reset, it will be your last name without any space.');
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
	});
</script>

