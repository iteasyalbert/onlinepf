<div align="center">
	<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'validate_vcode','autocomplete'=>'off'));?>
		<div >
			<div class="form-group">
			  <label for="email">Enter the security code that was sent to your cellphone number thru SMS.</label>
			  <input type="text" name="data[User][pin]" class="form-control input-sm pin" id="UserPin" placeHolder="Security code" autocomplete="off" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 150px;" />
			</div>
			<div class="form-group">
				<button id="submitvcode" type="button" class="btn btn-default">Submit </button>
			</div>
		</div>
	<?php echo $this->Form->end();?>
</div>


<script>
jQuery(document).ready(function(){
	url = window.location.hostname;
	//console.log(url);
	jQuery('#resultModal').on('hidden.bs.modal', function () {
		jQuery("#password").val('');
	});
	jQuery("#UserPin").focus();
	jQuery("#UserPin").on( "keydown", function(e) {
		if(e.which == 13)
			jQuery("#submitvcode").trigger('click');
	})
	jQuery("#submitvcode").click(function(){
		send_this= {
		 "User":{
					"pin" : jQuery('#UserPin').val(),
					"username" : jQuery('#username').val(),
					"password" : jQuery('#password').val()
				}
		};
		if(jQuery("#UserPin").val() != ''){
			jQuery("#submitvcode").html('Please wait...').prop('disabled', true);
			jQuery.ajax({
				url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'validate_vcode', 'patient' => false)); ?>",
				data: send_this,
				type: 'POST',
				dataType : 'json',
				async:false,
				success:function(data2){
					// console.log(data2.status);
					if(data2.status != "success"){
						alert(data2.status);
						jQuery("#submitvcode").html('Submit').prop('disabled', false);
					}
					else{
						if(data2.role == 'ROLE_PHYSICIAN')
							window.location.replace("http://"+url+"/physician/physicians/profile");
						else if(data2.role == 'ROLE_PATIENT')
							window.location.replace("http://"+url+"/patient/patients/profile");
					}
				}
			});
		}else
			alert('Please enter your PIN');
		return false;
	});
});
</script>