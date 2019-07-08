<style type="text/css">
	.changepwModal {
	  position: relative;
	  top: 180px;
	  right: auto;
	  bottom: 0;
	  left: auto;
	  z-index: 10040;
	  overflow: auto;
	  overflow-y: auto;
	}
</style>

<div class="modal fade" id="changepwModal" role="dialog" data-backdrop="true">
    <div class="modal-dialog modal-md changepwModal">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          Change password form
        </div>
        <div class="modal-body">
        	<form action="/users/change_password" method="post" id="UserChangePasswordForm">
			  <div class="form-group">
			    <input type="text" class="form-control" id="username" placeholder="Username" name="data[User][username]">
			  </div>
			  <div class="form-group">
			    <input type="password" class="form-control" id="oldpwd" placeholder="Old Password" name="data[User][old_password]">
			  </div>
			  <div class="form-group">
			    <input type="password" class="form-control" id="newpwd" placeholder="New Password" name="data[User][password]">
			  </div>
			  <div class="form-group">
			    <input type="password" class="form-control" id="confirmpwd" placeholder="Confirm Password" name="data[User][confirm_password]">
			  </div>
			  <button type="submit" class="btn btn-default changePass">Submit</button>
			</form>
        </div><!-- 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
</div>	


<script>
	jQuery(document).ready(function(){
		jQuery('#change-password').click(function(){
			jQuery('#changepwModal').modal('show');
		});
		jQuery('button.changePass').click(function(){
			if(jQuery('#UserChangePasswordForm:input') != ''){
				if(jQuery("#confirmpwd").val() == jQuery("#newpwd").val()){
					
						jQuery.ajax({
				            url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_password', 'patient' => false)); ?>",
				    		data:jQuery('#UserChangePasswordForm').serialize(),
							type: 'POST',
							dataType : 'json',
							success:function(data){
								console.log(data.error.status);
								if(data.error.status)
									data.message;
								else{
									if(data.data.success){
										jQuery('#changepwModal').modal('hide');
										alert('Password has been changed. Please log in again.');
										window.location.replace('/users/signout');
									}else
										alert(data.data.message)
								}
				            },
				            error: function (xhr, ajaxOptions, thrownError) {
						        alert(thrownError);
						    }
				        });
					
				}else
					alert("Please make sure your passwords match.")
			}else
				alert('Please complete all fields');

			return false;
		});
	});
	
</script>