	<label class="save"></label>
	<form id="QuestionForm" action="/Home/add_question"  method="post"  accept-charset="utf-8">
	<?php echo $this->Form->hidden('entry_datetime',array('value'=>date('Y-m-d H:i:s'), 'name'=>'data[Post][entry_datetime]'));?>
	<?php echo $this->Form->hidden('user_id',array('value'=>$uid, 'name'=>'data[Post][user_id]'));?>
	<?php echo $this->Form->hidden('type',array('value'=>3,'name'=>'data[Post][type]'));?>
	<p><?php echo '<h2>Ask a question:</h2>'.$this->Form->input('title',array('label'=>false,'div'=>false, 'style'=>'width: 55%;', 'type'=>'text', 'name'=>'data[Post][title]','required'=>'required','placeholder'=>'What is your question?'));?></p>
	<p><?php echo $this->Form->submit('Submit', array('id'=>'submitQuestion'/*,'onclick'=>'return false;'*/));?></p>

<script>
jQuery(document).ready(function(){
	jQuery('#submitQuestion').click(function(){
	var entry = jQuery('input#title').val();
	var user = jQuery('#user_id').val();

	if(entry && user && entry.length < 10){
		jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
		flashErrorMessage("Minimum characters for question is 10 characters.");
	 	return false;
	}
	if(entry == ''){
		jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
		flashErrorMessage("Please fill out the question field.");
	 	return false;
	
	}else if(user == ''){
		jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
		flashErrorMessage("You must log in to ask a question.");
		return false;
	}else{
		jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
//		flashSuccessMessage("You successfully submitted your question.");
		}
	});

});
</script>
