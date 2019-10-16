<?php //debug($data);?>
<style type="text/css">
  .HmoConsultantPfDiv {
    border: 6px solid #23374d;
    border-radius: 5px;
  }
</style>
<?php //$this->log($data['data']->HmoConsultantTypePfs, 'apirespo_hmo_edit');?>
<div class="row">
  <div >
    <form action="/admin/hmo/edit" method="POST">
      <div class="HmoDiv">
        <input type="hidden" name="data[Hmo][id]" value="<?php echo $data['data']->Hmo->id;?>" >
        <div class="form-group">
          <input type="text" class="form-control" placeholder="ID" name="data[Hmo][external_id]" value="<?php echo $data['data']->Hmo->external_id;?>" >
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Name" name="data[Hmo][name]" value="<?php echo $data['data']->Hmo->name;?>" >
        </div>
      </div>
      
      <?php foreach ($data['data']->HmoConsultantTypePfs as $key => $value) { ?>
        <div class="HmoConsultantPfDiv">
          <button type="button" class="btn btn-danger btn-block deleteHmoConsultantPF">Delete HMO Consultant PF</button>
          <hr>
          <input type="hidden" name="data[HmoConsultantPf][<?php echo $key;?>][id]" value="<?php echo $value->id;?>">
          <div class="form-group">
            <select class="form-control" name="data[HmoConsultantPf][<?php echo $key;?>][consultant_type_id]" value="<?php echo $value->consultant_type_id;?>" >
              <?php foreach ($data['data']->ConsultantTypes as $ct_key => $ct_value) { ?>
                <option value="<?php echo $ct_value;?>" <?php echo ($ct_value == $value->consultant_type_id?'selected':'') ; ?> ><?php echo $ct_key;?></option>
              <?php } ?>
            </select>
            <!-- <input type="text" class="form-control" placeholder="Consultant Type" name="data[HmoConsultantPf][<?php echo $key;?>][consultant_type_id]" value="<?php echo $value->consultant_type_id;?>"> -->
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Amount" name="data[HmoConsultantPf][<?php echo $key;?>][amount]" value="<?php echo $value->default_pf_amount;?>">
          </div>
          <hr>
        </div>
      <?php } ?>
      <button type="button" class="btn btn-success btn-block" id="addHmoConsultantPF">Add HMO Consultant PF</button>
      <button type="submit" class="btn btn-primary btn-block">Save</button>
    </form>
    <!-- <form action="/admin/hmo/edit" method="POST">
      <div class="form-group">
        <label for="id">ID</label>
        <input type="text" name="data[Hmo][id]" class="form-control" id="id" value="<?php echo $data['data']->id;?>" readonly>
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="data[Hmo][name]" class="form-control" id="name" value="<?php echo $data['data']->name;?>" >
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="data[Hmo][description]" class="form-control" id="description" value="<?php echo $data['data']->description;?>" >
      </div>
      <div class="form-group">
        <label for="default_pf_amount">PF Amount</label>
        <input type="text" name="data[Hmo][default_pf_amount]" class="form-control" id="default_pf_amount" value="<?php echo $data['data']->default_pf_amount;?>" >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form> -->
  </div>
</div>

<script>
  
  
  jQuery(document).ready(function(){
    jQuery('#add-hmo').click(function(){
      jQuery('#addHmoModal').modal('show');
      jQuery('#addHmoConsultantPF').trigger('click');
    });
    var hmo_consultant_index = "<?php echo count($data['data']->HmoConsultantTypePfs )?>";
    jQuery('#addHmoConsultantPF').click(function(e){ //on add 
      e.preventDefault();
      jQuery('.HmoDiv').append(
        '<div class="HmoConsultantPfDiv" >'+
          '<button type="button" class="btn btn-danger btn-block deleteHmoConsultantPFNew">Delete HMO Consultant PF</button>'+
          '<hr>'+
          '<div class="form-group">'+
            '<select class="form-control" name="data[HmoConsultantPf]['+hmo_consultant_index+'][consultant_type_id]" >'+
              <?php foreach ($data['data']->ConsultantTypes as $ct_key => $ct_value) { ?>
                '<option value="<?php echo $ct_value;?>" <?php echo ($ct_value == $value->consultant_type_id?'selected':'') ; ?> ><?php echo $ct_key;?></option>'+
              <?php } ?>
            '</select>'+
          '</div>'+
          '<div class="form-group">'+
            '<input type="text" class="form-control" placeholder="Amount" name="data[HmoConsultantPf]['+hmo_consultant_index+'][amount]" required>'+
          '</div>'+
          '<hr>'+
        '</div>'
      );
      jQuery('.deleteHmoConsultantPFNew').click(function(e){ //on add bind this
        e.preventDefault();
        jQuery(this).parent().remove(); 
      });
      hmo_consultant_index++;
    });
    jQuery('.deleteHmoConsultantPF').click(function(e){ //on load bind this
      e.preventDefault();
      currentElement = jQuery(this);
      var r = confirm("Are you sure you want to delete?");
      if (r == true) {
        jQuery.ajax({
          url:'/admin/hmo_consultant_type_pfs/delete/'+jQuery(this).parent().find('input[type=hidden]').val(),
          dataType:'json',
          success:function(data){
            currentElement.parent().remove();
          },
          error:function(jqXHR, textStatus, errorThrown){
              alert('There was an error communicating webserver, please contact your administrator. '+errorThrown);             
          }
        });
      } else {
        txt = "You pressed Cancel!";
      }
    });
    
  });
</script>