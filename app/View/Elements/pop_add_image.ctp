<div class="addImage-dialog" >	
	<div style="overflow: auto;" >		
		<form id="print_filter" action="" target="_blank" method="post"  accept-charset="utf-8">	
			<div style="margin-top:10px" class="print_selection">
				<div style="padding:3px; margin-bottom: 10px;" class="ui-dialog-titlebar">
					<h4>Add Image</h4>
					<script>
						var filelocation = "../../../js/jscam.swf";
					</script>
					<p class="actions" align="center" style="width:100%;min-width:100%;">
						<a href="#" id="open-photo"> Open image</a>
					</p>
					<?php echo $this->Form->input('upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image','style' => 'display:none;'));?>
					<?php //echo $this->Html->image('../media/articles/'.$this->data['Image']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
				</div>
				<div class="print_selections">
				</div>		
			</div>	
		</form>				
	</div>
</div>
<script>
	jQuery(document).ready(function(){
			//alert();
		});
</script>