<?php //phpinfo();?>
<!-- /module accordion -->
<style type="text/css">
	.modal {
		position: relative;
	   top: 50px;
	}
</style>
<div class="container-fluid" >
  <div class="row">
		<?php //phpinfo()?>
		<!-- page-title -->
		<h1>Online Laboratory Results</h1>
		<!-- /page-title -->

		<div class="col-sm-6 col-md-6">
			<p>
				<b>Login Instructions:</b></p>
			<p style="padding:0px;margin: 0px;">
				<b>PATIENTS</b></p>
			<p style="padding:0px;margin: 0px;padding-left: 20px;">
				<b>Username</b> &ndash; Hospital Number</p>
			<p style="padding-left: 20px;">
				<b>Password</b> &ndash; Your birthdate (mmddyyyy) e.g. 02221969</p>
			<p style="padding:0px;margin: 0px;">
				<b>DOCTORS</b></p>
			<p style="padding:0px;margin: 0px;padding-left: 20px;">
				<b>Username</b> &ndash; Doctor's ID provided by the hospital</p>
			<p style="padding-left: 20px;">
				<b>Password</b> &ndash; Your birthdate (mmddyyyy) e.g. 02221969</p>
			<p>
				<b>CAPTCHA</b> &ndash; This is to distinguish if you are a human and not a machine and to
thwart spam and automated extraction of data. CAPTCHA is case-sensitive. </p>
			<p>
				<b>Security Code</b> &ndash; This will be sent via SMS to the cellphone number provided to the hospital and valid only for 24 hours.</p>
			<p>
				<b>Note:</b> If you have problems accessing your Laboratory examination results online, please call the Laboratory Department at 874-8515 (Local 151). Make sure pop-ups is enabled in your browser.</p>
			<p>
				&nbsp;</p>
			<p>
				<b>Confidentiality and Disclaimer</b></p>
			<p>
				To protect patient&rsquo;s privacy and safety, certain examination results may not be available online depending on their nature and sensitivity as determined by PHMC-LP. For these examinations, proceed to Laboratory to secure the official result.
			</p>
			<p>
				PHMC-LP recognizes and values your data privacy rights in compliance with Data Privacy Act and its implementing rules and regulations. Laboratory examination results and any information transmitted with PHMC-LP are confidential and intended solely for the use of the authorized individuals whom username, password and security code are provided.
			</p>	
			<p>
				Once examination result is duly issued/released to authorized individuals, or patient/doctor concerned in accordance with the stringent rules of PHMC-LP, the same shall be handled by the said authorized individuals, or patient/doctor concerned with utmost confidentiality in accordance with data privacy laws. Otherwise, said authorized individual, or patient/doctor concerned shall be liable for any misuse or data loss.
			</p>

			
		</div>
		
		<div class="col-sm-6 col-md-6">
			<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'login','autocomplete'=>'off'));?>
				<div id="ajax_message"></div>	
				<div class="container col-sm-12 col-md-12 login">
					<h4>Login for Patients and Doctors</h4>
					
						<?php if(isset($errormessage)):?>
						<!-- <div style="text-align:center;width: 100%; height: 25px; border: 1px solid red; padding: 1px;border-radius: 5px;">
							<b><span style="color: red; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif; ">
							<?php 
								echo $errormessage['message'];
							?></span></b>
							</div><br/> -->
						<?php endif;?>
						
						<div class="form-group">
						  <label for="email">Username</label>
						  <?php echo $this->Form->input('username',array('id' => 'username','type' => 'text', 'label'=>false,'div'=>false, 'placeholder'=>"Hospital Number/Doctor's ID", 'class'=>'form-control'));?>
						</div>
						<div class="form-group">
						  <label for="password">Password</label>
						  <?php echo $this->Form->input('password',array('id' => 'password','type' => 'password', 'label'=>false,'div'=>false, 'placeholder'=>'Birthdate', 'class'=>'form-control'));?>
						</div>
						
						<div class="form-group">
							<div class="captcha-bkg" style="width:100%;height:auto;border:1px solid #3695EB !important;padding:5px;border-radius: 5px;">
								<div style="width:100%;height:auto;border:1px solid #3695EB !important;padding:5px;border-radius: 4px;background-color:#">
									<div style="width:100%;border: 1px solid #3695EB !important;padding:1px;text-align:center;background:white;border-radius:4px;">
										<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('style'=>'height:50px;','id'=>'img-captcha','width'=>100,'vspace'=>2,'class'=>'form-control'));?>
									</div>
									<?php echo '<p style="margin-top:2px;"><a href="/Users/login" id="a-reload">Can\'t read? Reload</a></p>';?>
									<?php echo '<p>Enter CAPTCHA shown above:</p>';?>
									<?php echo $this->Form->input('User.captcha',array('required'=>'required','placeholder'=>'CAPTCHA','autocomplete'=>'off','label'=>false,'div'=>true, 'class'=>'form-control'));?>
								</div>
							</div>
						</div>
						<!-- <div class="form-group"><a href="/nazareth/Users/forgot_password_phc">Forgot Password</a></div> -->
						<button type="submit" class="btn btn-default" id="login-submit">Submit</button>
                    	
                    				
				</div>	
			<?php echo $this->Form->end();?>
		</div>

		<!-- Image of receipt here -->
		<!-- <div class="page-content entry-content" itemprop="articleBody" style="width:35%; float: right; border:2px solid #3695EB !important; padding:20px;">
	
			<img src="media/heart.png">
			
		</div> -->
<!-- /.post-content -->
	</div><!-- /.type-page -->
				
				        
</div>

<div class="modal fade" id="resultModal" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          	<?php
    //       		$patientUser = $this->Session->read('Auth.Person');
    //       		// debug($patientUser);
    //       		if(!empty($patientUser)){
				// 	echo ($this->Session->read('Auth.User.role')==6?'Doctor : ': 'Patient : ').strtoupper($patientUser['firstname'].' '.$patientUser['middlename'].' '.$patientUser['lastname']);
				// }
          	 ?>
          	<span style="font-size: 10px;" id="pname"></span>	
          
        </div>
        <div class="modal-body">
          	<div id="pdfFrame" title="Result Viewer" class="embed-responsive embed-responsive-16by9">
				<?php echo  $this->element('vcode_form');?>
			</div>
        </div>
       <!--  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
</div>				
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#username').focus();
		jQuery('#UserLoginForm').submit(function(){
			if(jQuery('#UserLoginForm:input') != ''){
				jQuery('#login-submit').html('Loading...').prop('disabled', true);
				jQuery.ajax({
					url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'ajax_signin', 'patient' => false)); ?>",
					data:jQuery('#UserLoginForm').serialize(),
					type: 'POST',
					dataType : 'json',
					async:false,
					beforeSend: function( xhr ) {
				    	xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
				    	jQuery('#login-submit').html('Loading...').prop('disabled', true);
				  	},	
					success:function(data){
						console.log(data);
						if(!data.status && data.verified){ // If verified proceed
							if(data.role == 6)
								window.location.replace("http://"+url+"/physician/physicians/profile");
							else if(data.role == 9)
								window.location.replace("http://"+url+"/patient/patients/profile");
							else if(data.role == 1)
								window.location.replace("http://"+url+"/admin");
						}
						else if(data.status) // Display error message
							alert(data.message);
						else{ // Show OTP modal
							jQuery("#pname").html(data.message);
							// jQuery('#resultModal').modal({backdrop: 'static', keyboard: false}) ;
							jQuery('#resultModal').modal('show');
							jQuery("#UserPin").focus();
						}
						
						jQuery('#login-submit').html('Submit').prop('disabled', false);
					}
				});
			}else
				alert('Please fill out this form.');
			return false;
		});
	});
	
</script>
				

