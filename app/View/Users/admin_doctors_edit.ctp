<?php 
	echo $this->Html->script('ckeditor/ckeditor.js'); 
	echo $this->Html->script('ckeditor/adapters/jquery.js');
?>
<div class="enquiry-form" style="width:600px;position:absolute;margin-top:10px;">
	<?php echo $this->Form->create('PostContent',array('autocomplete'=>'off'));?>
	<?php 
		foreach($doctors as $key=>$value){
	?>
		<div id="ajax_message"></div>	
			<?php echo '<br/><h4 style="margin-bottom: 4px;">
								<strong>Title</strong>
							</h4>
			 				<label style="margin-bottom: 15px;"><b>*Note:</b>  This is the title of "Doctors"</label>'.
							$this->Form->input('title',array('label'=>false,'type'=>'text', 'class'=>'ckeditor', 'default'=>$value['PostContent']['title']));?>
			<?php echo '<br/><h4 style="margin-bottom: 4px;">
								<strong>Description</strong>
							</h4> 
							<label style="margin-bottom: 15px;"><b>*Note:</b> This is the description of "Doctors"</label>'.
							$this->Form->input('description',array('label'=>false,'type'=>'textarea', 'class'=>'ckeditor', 'default'=>$value['PostContent']['description']));?>
			<?php echo '<br/><h4 style="margin-bottom: 4px;">
								<strong>Content</strong>
							</h4> 
							<label style="margin-bottom: 15px;"><b>*Note:</b> This is the content of "Doctors"</label>'.
							$this->Form->input('content',array('label'=>false,'type'=>'textarea', 'class'=>'ckeditor', 'default'=>$value['PostContent']['content']));?>
			<?php echo '<br/><h4 style="margin-bottom: 4px;">
								<strong>Status</strong>
							</h4> 
							<label style="margin-bottom: 15px;"><b>*Note:</b> This is the status of "Doctors"</label>'.
							$this->Form->input('status',array('label'=>false,'type'=>'checkbox', 'class'=>'ckeditor', 'default'=>$value['PostContent']['status']));?>			
			<p><?php echo $this->Form->hidden('entry_datetime', array('value'=>date('Y-m-d H:i:s')))?></p>
			<p><?php echo $this->Form->submit('submit',array('style'=>'float:none;'));?></p>
		<?php 
		}
		?>		
	<?php echo $this->Form->end();?>
</div>