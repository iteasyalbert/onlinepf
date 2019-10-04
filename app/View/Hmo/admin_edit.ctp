<?php debug($data);?>
<?php //debug($this->request->data);?>

<div class="row lis-container">
  <div class="lis-center-container lis-login-container">
    <form action="/admin/hmo/edit" method="POST">
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
    </form>
  </div>
</div>