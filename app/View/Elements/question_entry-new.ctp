
	<label class="save"></label>
	<h2>Ask a question:</h2>
	<form id="QuestionForm" action="/Home/add_question"  method="post"  accept-charset="utf-8">
	<?php echo $this->Form->hidden('entry_datetime',array('value'=>date('Y-m-d H:i:s'), 'name'=>'data[Post][entry_datetime]'));?>
	<?php echo $this->Form->hidden('user_id',array('value'=>$uid, 'name'=>'data[Post][user_id]'));?>
	<?php echo $this->Form->hidden('type',array('value'=>3,'name'=>'data[Post][type]'));?>
	<p><?php echo $this->Form->input('title',array('label'=>false,'div'=>false, 'style'=>'width: 500px;', 'type'=>'text', 'name'=>'data[Post][title]'));?></p>
	<p><?php echo $this->Form->submit('Submit', array('id'=>'submitQuestion','onclick'=>'return false;'));?></p>

<script>
jQuery(document).ready(function(){
	jQuery('#submitQuestion').click(function(){
	var entry = jQuery('input#title').val();
	var user = jQuery('#user_id').val();

	if(entry == ''){
		jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
		flashErrorMessage("Please fill out the question field.");
	 	return false;
	}else if(user == ''){
		jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
		flashErrorMessage("You must log in to ask a question.");
		return false;
	}else{
		showLoadingMask("Saving Question...");
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'home','action'=>'add_question'));?>',
			data:jQuery('#QuestionForm').serialize(),
			type: 'POST',
			dataType : 'json',
			success:function(data){
				hideLoadingMask();
				if(data){
					jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
					flashSuccessMessage("You successfully submitted your question. We review first your question to prevent vulgar words.");
				}else{
					jQuery("#flashTemp").replaceWith('<div id="flashMessage" style="margin-bottom: 10px; padding: 10px; display: none;"></div>');
					flashSuccessMessage("Error Saving.");
				}
			}
		});
		
		}
	});

});
</script>
