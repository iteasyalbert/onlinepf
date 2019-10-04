

<div class="modal fade" id="changepwModal" role="dialog" data-backdrop="true">
    <div class="modal-dialog modal-md changepwModal">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          One Time Password
        </div>
        <div class="modal-body">
        	<form action="/users/change_password" method="post" id="UserChangePasswordForm">
			  <div class="form-group">
			    <input type="text" class="form-control" placeholder="Enter Security Code">
			  </div>
			  <button type="submit" class="btn btn-default changePass  btn-block">Submit</button>
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
		jQuery('#pf-submit').click(function(){
			jQuery('#changepwModal').modal('show');
			return false;
		});
	});
	
</script>