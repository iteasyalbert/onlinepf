<?php $controller = $this->params['controller'];
	if($controller == 'laboratories' || $controller == 'Laboratories')
		$action = 'laboratory';
	if($controller == 'hospitals' || $controller == 'Hospitals')
		$action = 'hospital';
	if($controller == 'physicians' || $controller == 'Physicians')
		$action = 'physician';
		
	$letter = array_combine(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
?>
	<table>
		<tr>
			<td style="width:5%"><h2 style="width:100px;margin:0px;">Letter</h2></td>
			<td style="width:95%"><?php echo $this->Form->input('letters',array('options'=>$letter,'empty'=>'--select a letter--','label'=>false,'div'=>false,'style'=>array('width'=>'150px')));?></td>
		</tr>
	</table>
	
<script type="text/javascript">
	jQuery('#letters').change(function(){				
		var id = jQuery(this).val();
		var province = jQuery('#address_select_1').val();
		var town = jQuery('#address_select_2').val();
		var village = jQuery('#address_select_3').val();
		var hmo = jQuery('#hmo').val();
		var labtest = jQuery('#labtest').val();
		var type = jQuery('#class').val();
		if(id!=''){
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>$controller,'action'=>$action));?>',
			data:{'province':province,'town':town,'village':village,'hmo':hmo,'test':labtest,'class':type,'id':id},
			type: 'POST',
			dataType : 'html',
			success:function(data){	
				jQuery('#ajax').empty().append(data);	
			},	
			error:function(data){
//				alert(data);
			}	
		});
		}
	});	
</script>
	