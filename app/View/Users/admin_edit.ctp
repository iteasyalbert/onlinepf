<?php //debug($data);?>
<?php //debug($this->request->data);?>

<div class="row lis-container">
  <div class="lis-center-container lis-login-container">
    <form action="/admin/users/edit" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="hidden" name="data[Person][id]" class="form-control" id="PersonId" value=<?php echo $data['data']->id;?> >
        <input type="text" name="data[User][username]" class="form-control" id="UserUsername" value=<?php echo $data['data']->myresultonline_id;?> readonly>
      </div>
      <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" name="data[Person][firstname]" class="form-control" id="firstname" value=<?php echo $data['data']->firstname;?> >
      </div>
      <div class="form-group">
        <label for="middlename">Middle Name</label>
        <input type="text" name="data[Person][middlename]" class="form-control" id="middlename" value=<?php echo $data['data']->middlename;?> >
      </div>
      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" name="data[Person][lastname]" class="form-control" id="lastname" value=<?php echo $data['data']->lastname;?> >
      </div>
      <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="text" name="data[Person][mobile]" class="form-control" id="mobile" value=<?php echo $data['data']->mobile;?> >
      </div>
      <div class="form-group">
        <label for="new">New Password</label>
        <input type="password" name="data[User][password]" class="form-control" id="password" >
      </div>
      <!-- <div class="form-group">
        <label for="new">Confirm Password</label>
        <input type="password" name="data[User][confirm_password]" class="form-control" id="confirm_password" >
      </div> -->
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>
</div>