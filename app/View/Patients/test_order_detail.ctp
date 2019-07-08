<?php $testOrderPackages = array_values($testOrderPackages);?>
<?php foreach($testOrderPackages as $testGroupIndex=>$package):?>
	<table class = "test_group_detail" id="<?php echo $package['LaboratoryTestOrderPackage']['test_order_id']?>">
		<thead>
			<tr id="<?php echo $testGroupIndex;?>" class="test_group_index">
				<th colspan="5" id="<?php echo $package['LaboratoryTestGroup']['id'];?>" class="test_group" style="background-color; #4E4635;"><?php echo $package['LaboratoryTestGroup']['name'];?></th>
			</tr>
			<tr class="testGroupTr">
				<th>Test</th>
				<th>Value</th>
				<th>Unit</th>
				<th>SI Value</th>
				<th>SI Unit</th>
			</tr>
		</thead>
		<tbody>
			<?php $result = array_values($testOrderResults[$package['LaboratoryTestOrderPackage']['id']]);?>
			<?php foreach($result as $testOrderindex=>$test):?>
				<tr class="test_code" id="<?php echo $test['LaboratoryTest']['id'];?>" >
					<td class="name" id="<?php echo $testOrderindex?>"><?php echo $test['LaboratoryTest']['name'];?></td>
					<td><?php echo $test['LaboratoryTestOrderResult']['value'];?></td>
					<td><?php echo $test['LaboratoryTestOrderResult']['unit'];?></td>
					<td><?php echo $test['LaboratoryTestOrderResult']['si_value'];?></td>
					<td><?php echo $test['LaboratoryTestOrderResult']['si_unit'];?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php endforeach;?>
<style>

.testGroupTr th{
	background: rgb(196, 189, 146);
}

.testCode td{
	background: rgb(248, 243, 206);
}

</style>