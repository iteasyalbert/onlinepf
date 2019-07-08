<form id="forgot-pw">
  <span class="help-block">
    Enter your username to verify your account.
  </span>
  <div class="form-group has-feedback has-feedback-left">
      <?php echo $this->Form->input('username',array('type' => 'text', 'label'=>false,'div'=>false, 'class'=>'form-control username'));?>
      <i class="form-control-feedback glyphicon glyphicon-user"></i>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Submit</button>
</form>
<script type="text/javascript">
  function send_vcode(mobile){
    jQuery.ajax({
            url: '/nazareth/Users/forgot_password_vcode/'+mobile,
      type: 'GET',
      async:false,
      success:function(data){
        console.log('verification code has been sent.');
        
      }
    });
  }
  jQuery(document).ready(function(){
    jQuery('#forgot-pw :submit').click(function(e){ 
      e.preventDefault();
      userid = jQuery('#username').val();
    });
  });
</script>