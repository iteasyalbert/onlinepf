<div class="testgroup-dialog" >	
	<div style="overflow: auto;" >
	<?php $controller = $this->params['controller'];debug($controller)?>		
		<form id="print_filter" class="<?php echo $controller;?>" action="" target="_blank" method="post"  accept-charset="utf-8">
	
			<div style="margin-top:10px" class="print_selection">
				<div style="padding:3px; margin-bottom: 10px;" class="ui-dialog-titlebar">
					<div class="input checkbox">
						<input id="stream" type="hidden" name="data[Save][stream]">
						<input type="hidden" value="0" id="print_all_" name="data[TestOrder][print_all]">
						<input type="checkbox" value="1" style="margin:1px" checked="checked" id="print_all" name="data[TestOrder][print_all]">
						<label for="print_all">Print All</label>
					</div>			
				</div>
				<div class="print_selections">
				</div>		
			</div>	
		</form>				
	</div>
</div>
<script>

	jQuery(document).ready(function(){		
		jQuery('.testgroup-dialog input').attr('checked','checked');		
	});

</script>
<style>
#print{
    background: url("../../img/btn-bg.jpg") repeat scroll 0 0 transparent;
    border: medium none;
    color: #FFFAE4;
    cursor: pointer;
    font: 18px 'Oswald',sans-serif;
    margin: 5px 0;
    overflow: visible;
    padding: 4px 17px;
    text-shadow: -1px -1px 0 #634E37;
    text-transform: uppercase;
    float: right;
}
.submit-save{
	margin-left: 76%;
}
</style>