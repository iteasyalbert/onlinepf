<div class="container">
	<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'validate_vcode','autocomplete'=>'off'));?>
		<div class="container col-sm-4 col-md-4 login">
		</div>
		<div class="container col-sm-4 col-md-4 login">
			<h4>User Verification</h4>
			
				<?php if(isset($errormessage)):?>
				<div style="text-align:center;width: 100%; height: 25px; border: 1px solid #6FBC8E; padding: 1px;border-radius: 5px;">
					<b><span style="color: #6FBC8E; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333">
					<?php 
						echo $errormessage['message'];
					?></span></b>
					</div><br/>
				<?php endif;?>
				
				<div class="form-group">
				  <label for="email">Enter the security code</label>
				  <input type="text" name="data[User][pin]" class="form-control input-sm pin" id="UserPin" placeHolder="Security code" autocomplete="off" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 150px;" />
				</div>
				<div class="form-group">
					<button id="submitvcode" type="button" class="btn btn-default">Submit</button>
				</div>
		</div>
		<div class="container col-sm-4 col-md-4 login">
		</div>
	<?php echo $this->Form->end();?>
</div>


<script>
jQuery(document).ready(function(){
	jQuery("#UserPin").focus();
	jQuery("#UserPin").on( "keydown", function(e) {
		if(e.which == 13)
			jQuery("#submitvcode").trigger('click');
	})
	jQuery("#signout").hide();
	jQuery("#submitvcode").click(function(){
	//	alert(jQuery('#UserValidateVcodeForm').serialize());
		if(jQuery("#UserPin").val() != ''){
			jQuery.ajax({
				url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'validate_vcode', 'patient' => false)); ?>",
				data:jQuery('#UserValidateVcodeForm').serialize(),
				type: 'POST',
				dataType : 'json',
				async:false,
				success:function(data2){
					//setTimeout("jQuery('#pleaseWaitDialog').modal('hide')", 2000);
					if(data2 !== "success"){
						alert(data2);
						//setTimeout("jQuery('#pleaseWaitDialog').modal('hide')", 1000);
					}
					else{
						//alert(data2);
						role = "<?php echo $this->Session->read('Auth.Person.role')?>";
						//alert(role.trim());
						if(role == 6)
							window.location.replace("http://laboratoryresults.uphmc.com.ph/physician");
						else if(role == 9)
							window.location.replace("http://laboratoryresults.uphmc.com.ph/patient");
					}
					
					//verification_submit.text('Submit').attr('disabled',false);
					
					
					// jQuery('#changePasswordModalCloseBtn').click();
				}
			});
		}else
			alert('Please enter your PIN');
		return false;
	});
});
</script>