<?php 
	$testresult = array();
	$laboratoryTestOrderPackage = current($TestOrder);
	$remark = $laboratoryTestOrderPackage['LaboratoryTestOrderPackage']['remarks'];
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
			'reference_range'=>$result['LaboratoryTestOrderResult']['si_reference_range'],
			'conventional_reference_range'=>$result['LaboratoryTestOrderResult']['conventional_reference_range'],
			'conventional_value'=>$result['LaboratoryTestOrderResult']['conventional_value'],
			'conventional_unit'=>$result['LaboratoryTestOrderResult']['conventional_unit'],
			'remarks'=>$result['LaboratoryTestOrderResult']['remarks'],

			);
	}
// 	$this->log($customizeform,'custom');

?>
<br><br>
<div id="body_frame" style="font-family:helvetica;">
	<table width = "100%">
		<tr>
			<td width = "20%"></td>
			<td width = "20%"></td>
			<td width = "20%"></td>
			<td width = "20%"></td>
			<td width = "20%"></td>
		</tr>
		<tr>
			<td colspan = "5" style = "font-family: text new roman; text-transform:uppercase; text-align:center; font-size: 15px">
			<b><?php echo $testGroup['LaboratoryTestGroup']['name'].' Report'?></b>
			</td>
		</tr>
		<tr>
			<td colspan = "5">&nbsp;</td>
		</tr>
		<tr>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-bottom: 1px solid thin; ">Test</td>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-bottom: 1px solid thin;">SI</td>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-bottom: 1px solid thin;">Normal Range</td>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-bottom: 1px solid thin;">Conventional</td>
			<td style = "font-size: 15px;  text-align: center; padding-bottom:10px; background-color:#E4E4E4; border-top: 1px solid thin; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;">Normal Range</td>
			
		</tr>
		<?php foreach($customizeform as $key => $value){ ?>
		<tr>
			<td style = "font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['name']; ?></td>
			<td style = "font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['result']; ?></td>
			<td style = "font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['reference_range'].'  '.$value['unit']; ?></td>
			<td style = "font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['conventional_value']; ?></td>
			<td style = "font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;"><?php echo $value['conventional_reference_range'].'  '.$value['conventional_unit']; ?></td>
		</tr>
	
		<?php } ?>
		<tr>
			<td style="font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin;  border-bottom: 1px solid thin;">
				<span>Remarks</span>
			</td>
			<td colspan="4" style="font-size: 12px; padding-bottom: 10px; border-left: 1px solid thin; border-right: 1px solid thin; border-bottom: 1px solid thin;">
				<?php echo $remark?>
			</td>
		</tr>
		

	</table>
</div>