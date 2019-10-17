<style type="text/css">
	.HmoConsultantPfDiv {
		border: 6px solid #23374d;
		border-radius: 5px;
	}
</style>

<div class="modal fade" id="addModal" role="dialog" data-backdrop="true">
    <div class="modal-dialog modal-lg addModal">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          Add Consultant Type Form
        </div>
        <div class="modal-body">
        	<form ng-submit="addSubmit(ConsultantType)" name="ConsultantType" id="ConsultantTypeForm" >
        		<div class="HmoDiv">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="ID" name="data[ConsultantType][external_id]" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Name" name="data[ConsultantType][name]" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Default PF Amount" name="data[ConsultantType][default_pf_amount]" required>
					</div>
				</div>
				<!-- <button type="button" class="btn btn-default btn-block" id="addHmoConsultantPF">Add HMO Consultant PF</button> -->
				<button type="submit" class="btn btn-primary btn-block">Save</button>
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
		jQuery('#add').click(function(){
			jQuery('#addModal').modal('show');
			// jQuery('#addHmoConsultantPF').trigger('click');
		});
		// var hmo_consultant_index = 0;
		// jQuery('#addHmoConsultantPF').click(function(e){ //on add 
		// 	e.preventDefault();
		// 	jQuery('.HmoDiv').append(
		// 		'<div class="HmoConsultantPfDiv">'+
		// 			'<button type="button" class="btn btn-danger btn-block deleteHmoConsultantPF">Delete HMO Consultant PF</button>'+
		// 			'<hr>'+
		// 			'<div class="form-group">'+
		// 				// '<input type="text" class="form-control" placeholder="Consultant Type" name="data[HmoConsultantPf]['+hmo_consultant_index+'][consultant_type_id]" required>'+
		// 				'<select class="form-control" name="data[HmoConsultantPf]['+hmo_consultant_index+'][consultant_type_id]" >'+
		// 	              <?php foreach ($consultant_types->data as $ct_key => $ct_value) { ?>
		// 	                '<option value="<?php echo $ct_value;?>" <?php echo ($ct_value == $value->consultant_type_id?'selected':'') ; ?> ><?php echo $ct_key;?></option>'+
		// 	              <?php } ?>
		// 	            '</select>'+
		// 			'</div>'+
		// 			'<div class="form-group">'+
		// 				'<input type="text" class="form-control" placeholder="Amount" name="data[HmoConsultantPf]['+hmo_consultant_index+'][amount]" required>'+
		// 			'</div>'+
		// 			'<hr>'+
		// 		'</div>'
		// 	);
		// 	jQuery('.deleteHmoConsultantPF').click(function(e){ //on delete
		// 		e.preventDefault();
		// 		jQuery(this).parent().remove(); 
		// 	});
		// 	hmo_consultant_index++;
		// });
		// jQuery('.deleteHmoConsultantPF').click(function(e){ //on delete
		// 	e.preventDefault();
		// 	console.log('here');
		// 	jQuery(this).parent().remove(); 
		// });
		
	});
</script>