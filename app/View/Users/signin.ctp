
<div class="content" style = "min-height:500px" >
	<?php echo $this->Form->create('User',array('autocomplete'=>'off'));?>
	
	<div id="profile" class="tabdiv">
		<div id="profile-div">
			<table id="profile-table">
			<tr><td><label>Username:</label></td><td><?php echo $this->Form->input('username',array('label'=>false,'div'=>false,'required'=>'required','placeholder'=>'Username'));?></td></tr>
			<tr><td><label>Password:</label></td><td><?php echo $this->Form->input('password',array('label'=>false,'div'=>false,'required'=>'required','placeholder'=>'Password'));?></td></tr>
			</table>
		</div>
		<?php echo $this->Form->submit('Submit');?>
        <?php echo $this->Form->end();?>
	</div>
</div>
