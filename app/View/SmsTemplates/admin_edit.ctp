<?php debug($data);?>
<?php //debug($this->request->data);?>

<div class="row lis-container">
  <div class="lis-center-container lis-login-container">
    <form action="/admin/sms_templates/edit" method="POST">
      <div class="form-group">
        <label for="id">ID</label>
        <input type="text" name="data[SmsTemplate][id]" class="form-control" id="id" value="<?php echo $data['data']->id;?>" readonly>
      </div>
      <div class="form-group">
        <label for="name">Content</label>
        <input type="text" name="data[SmsTemplate][content]" class="form-control" id="name" value="<?php echo $data['data']->content;?>" >
      </div>
      <div class="form-group">
        <label for="description">Type</label>
        <input type="text" name="data[SmsTemplate][type]" class="form-control" id="description" value="<?php echo $data['data']->type;?>" >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>
</div>