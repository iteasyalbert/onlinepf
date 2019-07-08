<?php echo $this->Session->flash();?>
<?php echo $this->Form->create("User");?>
<div style="width:290px;height:135px;border:1px solid;padding:5px;border-radius: 4px;background-color:rgb(184, 20, 20);">
	<div style="width:276px;height:120px;border:1px solid;padding:5px;border-radius: 4px;background-color:#fffae4">
		<div style="width:98%;border: 1px solid #bbaf9b;padding:1px;text-align:center;background:white;border-radius:4px;">
			<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2,'style'=>'height:45px;'));?>
		</div>
		<?php echo '<p style="margin-top:2px;"><a href="#" id="a-reload">Can\'t read? Reload</a></p><br/>';?>
		<?php //echo '<p>Enter security code shown above:</p>';?>
		<?php echo $this->Form->input('User.captcha',array('placeholder'=>'Enter security code shown above','autocomplete'=>'off','label'=>false,'error'=>false,'class'=>'','style'=>'width:96%;height:30px;border-radius: 4px;padding-right:0px;padding-top:0px;padding-top:0px;padding-bottom:0px;'));?>
	</div>
</div>
<?php echo $this->Form->submit(__(' Submit ',true));?>
<?php echo $this->Form->end();?>
<script>
jQuery('#a-reload').click(function() {
	var $captcha = $("#img-captcha");
    $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
	return false;
});
</script>