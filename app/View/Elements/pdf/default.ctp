<?php 
	$testresult = array();
	foreach($Result as $resultdatakey=>$result)
	{
		$testresult[$result['LaboratoryTestOrderResult']['test_id']] = array(
			'value'=>$result['LaboratoryTestOrderResult']['value']
			);
		$customizeform[$result['LaboratoryTestOrderResult']['test_id']]=array(
			'test_id'=>$result['LaboratoryTestOrderResult']['test_id'],
			'name'=>$result['LaboratoryTest']['name'],
			'result'=>$result['LaboratoryTestOrderResult']['si_value'],
			'result_flag'=>$result['LaboratoryTestOrderResult']['result_flag'],
			'unit'=>$result['LaboratoryTestOrderResult']['si_unit'],
			'remarks'=>$result['LaboratoryTestOrderResult']['remarks'],
			'reference_range'=>$result['LaboratoryTestOrderResult']['si_reference_range'],
			'conventional_reference_range'=>$result['LaboratoryTestOrderResult']['conventional_reference_range'],
			'conventional_value'=>$result['LaboratoryTestOrderResult']['conventional_value'],
			'conventional_unit'=>$result['LaboratoryTestOrderResult']['conventional_unit'],

			);
	}
// 	$this->log($customizeform,'custom');

?>
<br><br>
<div id="body_frame">
	<table width = "100%">
		<tr>
			<td width = "25%"></td>
			<td width = "25%"></td>
			<td width = "50%"></td>
			
		</tr>
		<tr>
			<td colspan = "3" style = "font-family: text new roman; text-transform:uppercase; text-align:center; font-size: 15px">
			<b><?php echo $testGroup['TestGroup']['LaboratoryTestGroup']['name'].' Report'?></b>
			</td>
		</tr>
		<tr>
			<td colspan = "3">&nbsp;</td>
		</tr>
		<tr>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;">Test</td>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;">Result</td>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;">Normal Range</td>
		</tr>
		<?php foreach($customizeform as $key => $value){ ?>
		<tr>
			<td style = "font-size: 15px; padding-bottom: 10px; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['name']; ?></td>
			<td style = "font-size: 15px; padding-bottom: 10px; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['result']; ?>
				</td>
			<td style = "font-size: 15px; padding-bottom: 10px; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['reference_range'].'  '.$value['unit']; ?></td>
			
		</tr>
	
		<?php } ?>
		

	</table>
</div>