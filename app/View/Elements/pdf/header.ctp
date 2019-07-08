<?php ?>
<div id="header_patient">

<table style='margin-top:0px;width:100%; border-top: 1px solid thin; border-bottom: 1px solid thin;font-size:10px' border = "0" >
		<tr style = "padding-top: %">
			<td width = "10%"></td>
			<td width = "30%"></td>
			<td width = "1%"></td>
			<td width = "10%"></td>
			<td width = "4%"></td>
			<td width = "1%"></td>
			<td width = "5%"></td>
			<td width = "5%"></td>
			<td width = "1%"></td>
			<td width = "1%"></td>
			<td width = "17%"></td>
		</tr>
		<tr>
			<td colspan = "11">&nbsp;</td>
		</tr>
		<tr>
			<td style = "font-size:12px">Patient Name</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			<?php echo $patientData['Person']['lastname'].', '.$patientData['Person']['firstname'].' '.$patientData['Person']['middlename']?>
			</td>
			<td></td>
			<td style = "font-size:12px">Age</td>
			<td style = "text-transform:uppercase;font-size:12px">:

			</td>
			<td></td>
			<td style = "font-size:12px">Gender</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			<?php echo $patientData['Person']['sex']?>
			</td>
			<td></td>
			<td style = "font-size:12px">Data Requested</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			<?php echo $patientData['requested_datetime']['LaboratoryPatientBatchOrder']['requested_date'].' '.$patientData['requested_datetime']['LaboratoryPatientBatchOrder']['requested_time']?>
			</td>
		</tr>
		<tr>
			<td style = "font-size:12px">Patient ID</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			<?php echo $patientData['Patient']['id']?>
			<td></td>
			<td style = "font-size:12px">Height</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			</td>
			<td></td>
			<td style = "font-size:12px">Weight</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			</td>
			<td></td>
			<td style = "font-size:12px">Data Released</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			<?php 
				foreach ($patientData['TestOrder'] as $key=>$testorder){
					if($testorder['LaboratoryTestOrderPackage']['test_order_id'] == $patientOrderId){
						echo $testorder['LaboratoryTestOrderPackage']['release_date'].' '.$testorder['LaboratoryTestOrderPackage']['release_time'];
					}
				}
			?>
			</td>
		</tr>
		<tr>
			<td style = "font-size:12px">Sample ID</td>
			<td>: <?php echo $patientData['PatientOrder']['LaboratoryPatientOrder']['id']?></td>	
			<td></td>
			<td style = "font-size:12px">Physicians</td>
			<td colspan = "5" style = "text-transform:uppercase;font-size:12px">:
			 </td>
			
			<td style = "font-size:12px">Address</td>
			<td style = "text-transform:uppercase;font-size:12px">:
			
		</tr>
		<tr>
			<td colspan = "11">&nbsp;</td>
		</tr>
	</table> 	
</div>
