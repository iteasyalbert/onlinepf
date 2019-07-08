<?php $this->set('title_for_layout', 'Online Services');?>
<style type="text/css">
	.resultDiv {
		background: #C14646;
		margin: 10px 12px;
		font-family: Arial;
		//padding: 10px;
		border-radius: 10px;
		min-height: 300px;
		color: #FFF;
		font-size: 12px;
	}
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
		width: 42%;
		background: #E88D8D;
		color: #000;
		padding: 5px;
		margin-left : 8px;
		margin-right: 8px;
		margin-bottom : 8px;
		margin-top: -60px;
		border: 1px solid #333;
		border-radius: 5px;
		display: inline-block;
		float: right;
		vertical-align: top;
	}
	.login ul {
		list-style: none;
		width: 70%;
		margin: 10px auto;
		padding-top: 5px;
	}
	.login ul li {
		padding-bottom: 10px;
	}
	.login ul input[type=text],.login ul input[type=password] {
		width: 100%;
		padding: 4px 6px;
	}
	.login ul input[type=submit] {
		padding: 3px 5px;
		width: 80px;
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
<br/>
	<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'login','autocomplete'=>'off'));?>
		<div id="ajax_message"></div>	
						<div class="resultDiv">
							<div class="importants">
	                    		<span style="font-size: 13px;"><b>IMPORTANT: PLEASE READ</b></span>
	                    		<ul class="list-import"><br/>
									<li>Certain examination results depending upon on the nature and sensitivity may NOT BE VIEWABLE ONLINE to protect patient privacy and safety. For these tests ask your doctor or secure the official report as necessary.</li><br/><br/>
								</ul>
							</div>
                    		<div class="instructions">
	                    		<span style="font-size: 13px;"><b>LOGIN INSTRUCTIONS</b></span>
	                    		<ul class="list-instruct">
	                    			<br/>
									<li>
	                    				FOR PATIENTS <br/>
	                    				<ul>
	                    					<li>Your <i>Username</i> is the MRN printed on the receipt given to you</li>
	                    					<li>Your <i>Password</i> is your last name in all capital letters.</li>
	                    				</ul>
	                    			</li><br/>
									
	                    			<li>
	                    				FOR DOCTORS<br/>
	                    				<ul>
	                    					<li>Your <i>Username</i> and <i>Password</i> is the unique ID provided to you by PHC. Kindly contact PHC in case you don't have your ID.</li>
	                    				</ul>
	                    			</li><br/>
									
	                    			<li>
	                    				On your first login, you will be prompted to change your password for security purposes.
	                    			</li><br/>
									
	                    			<li>
	                    				Password can be changed anytime once logged-in by clicking <i>Change Password</i>.
	                    			</li><br/>
									
	                    			<li>
	                    				If you have any trouble accessing your results on-line, do not hesitate to call us at <i>925-2401 local 3214-3215</i> or email us at <i>inquiry@phc.gov.ph</i>. We would love to hear from you!
	                    			</li><br/>
	                    		</ul>
								
								
	                    		<span style="font-size: 13px;"><b>CONFIDENTIALITY AND DISCLAIMER</b></span>
	                    		<ul class="list-instruct">
								<br/>
	                    			<li> Your information is safe with us. All PHC staff are committed to secure, protect and treat private your personal information and your test results. It is our priority at PHC to secure and protect your information from any unauthorized access.</li><br/>
	                    			<li> With a unique username and password protocol, outsiders cannot access your record because the system is protected by a tight, secure and sophisticated networks of 'firewall' to prevent <i>hacking</i>.</li><br/>
	                    			<li> Using a Linux-based system, PHC assures that stored data and files being sent to your computers are free of viruses. Moreover,  all access to our system and your accounts are recorded.</li>
	                    		</ul>
                    		</div>
                    		<div class="login"><br/><br/><br/>
                    			<span style="padding-left: 25px;"><b>Login for Patients and Doctors Online Result's Viewing</b><br/></span><br/>
                    			<ul>
                    				<?php if(isset($errormessage)):?>
                    				<li style="text-align:center;width: 243px; height: 25px; border: 1px solid #C14646; padding: 1px;border-radius: 5px;">
                    				<b><span style="color: #F00; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333">
                    				<?php 
                    					echo $errormessage['message'];
                    				?></span></b>
                    				</li><br/>
                    				<li>
                    				<?php endif;?>
                    					<div><b>Username</b></div>
                    					<div><?php echo $this->Form->input('username',array('id' => 'username','type' => 'text','label'=>false,'div'=>false,'placeholder'=>'Username'));?></div>
                    				</li><br/>
                    				<li>
                    					<div><b>Password</b></div>
                    					<div><?php echo $this->Form->input('password',array('id' => 'password','type' => 'password','label'=>false,'div'=>false,'placeholder'=>'Password'));?></div>
                    				</li><br/>
                    				<li>
                    					<div class="captcha-bkg" style="width:243px;height:135px;border:1px solid #C14646;padding:5px;border-radius: 5px;">
											<div style="width:230px;height:120px;border:1px solid #C14646;padding:5px;border-radius: 4px;background-color:#">
												<div style="width:98%;border: 1px solid #C14646;padding:1px;text-align:center;background:white;border-radius:4px;">
													<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;width:220px;'));?>
												</div>
												<?php echo '<p style="margin-top:2px;"><a href="/Users/login" id="a-reload">Can\'t read? Reload</a></p><br/>';?>
												<?php echo '<p>Enter security code shown above:</p>';?>
												<?php echo $this->Form->input('User.captcha',array('required'=>'required','placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'div'=>true,'style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?>
											</div>
										</div>
                    				</li><br/>
                    				<li>
                    					<div align="center"><input type="Submit" name="login" value="Login" /></div>
                    				</li><br/><br/><br/>
                    			</ul>
                    			
                    		</div>
                    		
                    	</div>	
	<?php echo $this->Form->end();?>

