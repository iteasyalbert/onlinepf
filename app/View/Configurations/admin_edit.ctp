<?php debug($data);?>
<?php //debug($this->request->data);?>

<div class="row lis-container">
  <div class="lis-center-container lis-login-container">
    <form action="/admin/configurations/edit" method="POST">
      <div class="form-group">
        <label for="id">ID</label>
        <input type="text" name="data[Configuration][id]" class="form-control" id="id" value="<?php echo $data['data']->id;?>" readonly>
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="data[Configuration][name]" class="form-control" id="name" value="<?php echo $data['data']->name;?>" >
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="data[Configuration][description]" class="form-control" id="description" value="<?php echo $data['data']->description;?>" >
      </div>
      <div class="form-group">
        <label for="value">Value</label>
        <input type="text" name="data[Configuration][value]" class="form-control" id="value" value="<?php echo $data['data']->value;?>" >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>
</div>