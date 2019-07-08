<style>
	p{line-height: 20px !important}
</style>
<div class="flasherrormesage">
</div>
<p>Please enter your email address which you assigned as your MRO-ID and we will send you a temporary password. You can use the temporary password on logging-in to MRO. Please change the password in your first login to MRO.</p>
<br />
<br />
<h4>USERNAME / EMAIL:</h4>
<?php
echo $this->Form->create('User');
echo $this->Form->input('myresultonline_id',array('type' => 'text','style'=>'padding:8px;width:283px;','div'=>false,'label' => false,'required'=>'required','placeholder'=>'Enter your username or email address.'));
?>
<br/>
<br/>
	<div class="captcha-bkg" style="width:290px;height:135px;border:1px solid #bbaf9b;padding:5px;border-radius: 4px;">
		<div style="width:276px;height:120px;border:1px solid #bbaf9b;padding:5px;border-radius: 4px;background-color:#fffae4">
			<div style="width:98%;border: 1px solid #bbaf9b;padding:1px;text-align:center;background:white;border-radius:4px;">
				<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;'));?>
			</div>
			<?php echo '<p style="margin-top:2px;"><a href="#" id="a-reload">Can\'t read? Reload</a></p><br/>';?>
			<?php //echo '<p>Enter security code shown above:</p>';?>
			<?php echo $this->Form->input('User.captcha',array('placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'class'=>'','style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?>
		</div>
	</div>
<?php
echo $this->Form->submit(__('Submit'));
echo $this->Form->end();

?>
<style></style>
<script>
	jQuery(document).ready(function(){
		jQuery('.current-crumb').text(' Forgot Password');

		jQuery('#UserForgotPasswordForm').submit(function(){
			user = jQuery('#UserMyresultonlineId').val();
			if(user == ''){
				return false;
			}
		});

//		jQuery('#UserMyresultonlineId').val('');
	});
</script>
