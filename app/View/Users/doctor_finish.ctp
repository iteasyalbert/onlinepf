<style>
	p{line-height: 20px !important}
</style>
<div class="content">
	<img src="/img/wizard_finish.png" style="margin-bottom: 20px;width:100%;">
	<?php echo $this->Form->create('Physician')?>
	<p>Congratulations! You are now a Physician Member of MyResultOnline. </p><br/>
	<p>You can now access your patient&rsquo;s laboratory results who are also members of MRO. You can also participate on &lsquo;Ask a Question&rsquo; of MRO wherein you can reply on questions from other members. You can also post your comments on any articles featured on MRO website. &lsquo;Write an Article&rsquo; on your account lets you share, your own articles to other members and at the same time promote your own clinic.</p><br/>
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