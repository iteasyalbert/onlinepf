	<div class="flasherrormesage">
	</div>
<div class="content">
	<img src="/img/wizard_confirmation.png" style="margin-bottom: 20px;width:100%;">
	<p>
		Thank you very much for signing up and showing interest on becoming a Patient Member of MyResultOnline (MRO). Your email address is your MRO-ID and login&rsquo;s username to MRO website in claiming your laboratory test results. To make sure that you have provided correct information and for security validation, a message was sent to your email address. Please check it now to continue your sign-up process.
	</p>
	<br/>

<?php
if($email):
?>	<br/>
	<h4>Resend Confirmation:</h4>
	<p>In case you are not able to receive the email, please click &ldquo;Resend Message&rdquo; button below.</p>

<?php
	echo $this->Form->create('User');
	echo $this->Form->hidden('myresultonline_id',array('type'=>'text','value'=>$email,'style'=>'padding:8px;width:250px;','div'=>false,'label' => false));
?>
			<div class="captcha-bkg" style="width:290px;height:135px;border:1px solid #bbaf9b;padding:5px;border-radius: 4px;">
		<div style="width:276px;height:120px;border:1px solid #bbaf9b;padding:5px;border-radius: 4px;background-color:#fffae4">
			<div style="width:98%;border: 1px solid #bbaf9b;padding:1px;text-align:center;background:white;border-radius:4px;">
				<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;'));?>
			</div>
			<?php echo '<p style="margin-top:2px;"><a href="#" id="a-reload">Can\'t read? Reload</a></p><br/>';?>
			<?php //echo '<p>Enter security code shown above:</p>';?>
			<?php echo $this->Form->input('User.captcha',array('placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?>
		</div>
	</div>
<?php
	echo $this->Form->submit(__('Resend Confirmation'));
	echo $this->Form->end();
endif;

?>
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
		jQuery('.current-crumb').text(' SIGN UP');
//		jQuery('#UserMyresultonlineId').val("");
	});
</script>