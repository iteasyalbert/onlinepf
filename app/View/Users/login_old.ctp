
<!-- /module accordion -->
<style>
	.themify_builder .accordion-2361-0-0-1 .ui.module-accordion {  } 
</style>
<div id="content" style="float: left; width:100%;">
    <div id="page-2361" class="type-page" itemscope="" itemtype="http://schema.org/Article">
			
		<!-- page-title -->
		<h1 class="page-title" itemprop="name">Result Online</h1>
		<!-- /page-title -->

		<div class="page-content entry-content" itemprop="articleBody" style="float: left; width:60%;">
			<p><b>Important: Please Read.</b></p>
			<p>Certain examination results depending upon on the nature and sensitivity may <b>NOT BE VIEWABLE ONLINE</b> to protect patient privacy and safety. For these tests ask your doctor or secure the official report as necessary..</p>
			
			<p><b>Login Instruction: USERNAME AND PASSWORD ARE ALL CAPITALS LETTERS</b></p>
			<p><b><ul><li>For Patients:</ul> </li></b></p>
			<ul>
				<p>? Your <i><b>Username</b> is the PatientID printed on the receipt given to you or see it in your result form header <br />(eg.12-550-234)<br />
				? Your <i><b>Password</b></i> is your first name in all capital letters without space.</p>

			</ul>
			
			<p><b><ul><li> For Doctors: </li></ul></b></p>
			<ul>	
				? Your <i><b>Username</b></i> is your first letter of your first name plus last name (No Space).<br />
				? Your <i><b>Password</b></i> is your last name. <br />
				? All new doctors required to change their password.
			</ul>

			
				<b>
				<ul>
					<li></b> On your first login, you will be prompted to change your password for security purposes.</li>
				</ul>
				<b><ul><li></b> Password can be changed anytime once logged-in by clicking <i>Change Password</i>.</li></ul>
				<b><ul><li></b> If you have any trouble accessing your results on-line, do not hesitate to call us at <i>925-2401 local 3214-3215</i> or email us at <i>inquiry@phc.gov.ph</i>. We would love to hear from you!.</li></ul>
			</p>
			<p>
				<b>CONFIDENTIALITY AND DISCLAIMER</b>
			</p>
			<p>
				Your information is safe with us. All Nazareth staff are committed to secure, protect and treat private your personal information and your test results. It is our priority at PHC to secure and protect your information from any unauthorized access.<br/><br \>
				With a unique username and password protocol, outsiders cannot access your record because the system is protected by a tight, secure and sophisticated networks of 'firewall' to prevent <i>hacking</i>.<br><br \>
				Using a Linux-based system, PHC assures that stored data and files being sent to your computers are free of viruses. Moreover,  all access to our system and your accounts are recorded.
			
			</p>
			
			<div id="themify_builder_content-2361" data-postid="2361" class="themify_builder_content themify_builder_content-2361 themify_builder themify_builder_front">
				
			<!-- module_row -->
				
			<!-- /module_row -->
		</div>
		<!-- /themify_builder_content -->								
		<!-- comments -->
		<!-- /comments -->
			
		</div>
		
		<div class="page-content entry-content" itemprop="articleBody" style="width:auto; float: right; border:2px solid #6FBC8E !important; padding:20px;">
			<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'login','autocomplete'=>'off'));?>
						<div id="ajax_message"></div>	
							<div class="login">
                    			<span style=""><b>Login for Patients and Doctors Online Result's Viewing</b><br/></span><br/>
                    			
                    				<?php if(isset($errormessage)):?>
                    				<div style="text-align:center;width: 100%; height: 25px; border: 1px solid #6FBC8E; padding: 1px;border-radius: 5px;">
	                    				<b><span style="color: #6FBC8E; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333">
	                    				<?php 
	                    					echo $errormessage['message'];
	                    				?></span></b>
	                    				</div><br/>
                    				<?php endif;?>
                    				<div>
                    					<div><b>Username</b></div>
                    					<div><?php echo $this->Form->input('username',array('id' => 'username','type' => 'text','label'=>false,'div'=>false,'placeholder'=>'Username','style'=>'width:90%'));?></div>
                    				</div><br/>
                    				<div>
                    					<div><b>Password</b></div>
                    					<div><?php echo $this->Form->input('password',array('id' => 'password','label'=>false,'div'=>false,'placeholder'=>'Password','style'=>'width:90%'));?></div>
                    				</div><br/>
                    				<div>
	                    				<div class="captcha-bkg" style="width:100%;height:auto;border:1px solid #6FBC8E !important;padding:5px;border-radius: 5px;">
											<div style="width:96%;height:auto;border:1px solid #6FBC8E !important;padding:5px;border-radius: 4px;background-color:#">
												<div style="width:98%;border: 1px solid #6FBC8E !important;padding:1px;text-align:center;background:white;border-radius:4px;">
													<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;width:220px;'));?>
												</div>
												<?php echo '<p style="margin-top:2px;"><a href="/Users/login" id="a-reload">Can\'t read? Reload</a></p>';?>
												<?php echo '<p>Enter security code shown above:</p>';?>
												<?php echo $this->Form->input('User.captcha',array('required'=>'required','placeholder'=>'Security code here','autocomplete'=>'off','label'=>false,'div'=>true,'style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?>
											</div>
										</div>
                    				</div><br/>
                    				<div>
                    					<div align="left"><input type="Submit" name="login" value="Login" /></div>
                    				</div>
                    			
                    			
                    		</div>	
						<?php echo $this->Form->end();?>
		</div>

		<!-- Image of receipt here -->
		<!-- <div class="page-content entry-content" itemprop="articleBody" style="width:35%; float: right; border:2px solid #6FBC8E !important; padding:20px;">
	
			<img src="media/heart.png">
			
		</div> -->
<!-- /.post-content -->
	</div><!-- /.type-page -->
				
				        
</div>
					

