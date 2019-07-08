<style>
	p{line-height: 20px !important}
</style>
<div class="content">
	<img src="/img/wizard_finish.png" style="margin-bottom: 20px;width:100%;">
	<?php echo $this->Form->create('Patient')?>
	<p>Congratulations! You are now a Patient Member of MyResultOnline. </p><br/>
	<p>Storage for your laboratory test results has been created. On your next visit to laboratories and hospitals that are MRO Member, your test results will be stored on MRO in which you can access anytime anywhere. They will ask your MRO-ID on your first visit to them.</p><br/>
	<p>You can now participate on &lsquo;Ask a Question&rsquo; of MRO wherein you can ask any health or medical related questions, and reply on questions from other members. You can also post your comments on any articles featured on MRO website. &lsquo;Write an Article&rsquo; on your account lets you share to other members your own articles.</p><br/>

	<?php if($logged_in):?>
		<p>Please click &lsquo;Go to Profile&rsquo; button below to open your newly created MRO account.</p><br/>
		<p><b>Mabuhay!</b></p><br/>
		<?php echo $this->Form->submit('Go to Profile');?>
	<?php else:?>
		<p>Please click &lsquo;Login&rsquo; button below to automatically login your newly created MRO account.</p><br/>
		<p><b>Mabuhay!</b></p><br/>
		<?php echo $this->Form->submit('Login');?>
	<?php endif;?>
	<?php echo $this->Form->end(); ?>
</div>
         <?php echo $this->element('sidebar');?>
<script>
	jQuery(document).ready(function(){
		jQuery('.current-crumb').text(' SIGN UP');
	});
</script>