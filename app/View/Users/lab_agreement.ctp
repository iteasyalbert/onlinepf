<style>
	p{line-height: 20px !important}
</style>
<div class="content">
	<img src="/img/wizard_laboratory_agreement.png" style="margin-bottom: 20px;width:100%;">
	<?php echo $this->Form->create('Laboratory')?>
	<p>Thank you very much for completing your profile information.</p><br/>
	<p>MRO Team will contact you to complete your sign-up. They will assist you in processing the following requirements to confirm your membership application:</p>
		<ol>
			<li>
				<p>Additional Terms and Conditions</p><br/>
				<p>
					Aside from the Terms and Conditions posted on MRO Website that applies to all MRO Members and Users, there are additional Terms & Conditions for Hospital/Laboratory Members. This is to ensure that items like the system to be used by MRO, technical details, other benefits to Hospital/Laboratories, patient&rsquo;s benefits and charges, and other matters.
				</p><br/>
				<p>
					Additional Terms and Conditions shall be sent to you for reviewing and acceptance.
				</p>
			</li>
			<li>
				<p>Payment of Membership Fee</p><br/>
				<p>
					MRO will charge you minimal membership fee. This will be used in the implementation of Laboratory Information Manager (LIM) on your laboratory. LIM is the software that will send the test results to MRO and at the same time computerize some of your processes like generating of reports.  The exact amount is indicated on the Terms and Conditions that will be sent to you.
				</p>
			</li>
			<li>
				<p>Data Gathering</p><br/>
				<p>MRO Team will gather information from you like tests offered, format of results being released to patients, and doctors. This is to prepare the system for your laboratory operation with MRO services.</p>
			</li>
		</ol>
	<?php echo $this->Form->submit('Okay')?>
	<?php echo $this->Form->end(); ?>
</div>
         <?php echo $this->element('sidebar');?>
<script>
	jQuery(document).ready(function(){
		jQuery('.current-crumb').text(' SIGN UP');
	});
</script>