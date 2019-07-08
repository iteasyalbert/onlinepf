<?php echo $this->Html->css('patient/style.css');?>
<div class="content">
	<img src="/img/wizard_laboratory_agreement.png" style="margin-bottom: 20px;width:100%;">
	<?php echo $this->Form->create('Laboratory')?>
	<p>Thank you for completing your profile.</p>
	<p>You are now on Step 4 on becoming a laboratory member of myResultOnline.com.</p>
	<p>An email was sent to you attaching the contract that we should both agreed. Our account manager will ..</p>
	<p>In case you are not able to receive the email. <a href="<?php echo $this->Html->url(array('action'=>'download_contract'));?>"><u>Click here</u></a> to download the contract.</p>
	<?php //echo $this->Form->input('filetemp',array('type'=>'file'));?>
	<?php echo $this->Form->submit('AGREE')?>
	<?php echo $this->Form->end(); ?>
</div>
         <?php echo $this->element('sidebar');?>
<script>
	jQuery(document).ready(function(){
		jQuery('.current-crumb').text(' SIGN UP');
	});
</script>