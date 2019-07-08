<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<title><?php //echo $reports[$this->data['Report']['report_id']]['title']?></title>
	</head>
<body>
	<style>
	 
	 /*#ReportContent {font-size:12px;}*/
	 
		 #ReportContent table tbody tr td {border:1px solid black;margin:0px;padding:1px;height:20px;}
		 .alt {background:#fbfbfb;}
		 /*body {font-family:helvetica;font-size:8pt}*/
		 .rightjustify {text-align:right;}
		 .centeralign {text-align:center;}
		 table {border-spacing:0px; margin-top:10px;}
		 .total { }
		 .total td {border:none;border-top:2px solid black;font-weight:bold;}
		 @page  {
			header: html_myHTMLHeader1;
			footer: html_myHTMLFooter1;
			margin-header: 10mm;
			margin-footer: 4mm;
			margin-top: 150px;
			margin-left:10px;
			margin-right:10px;
		 	
		}
	
	</style>
	
		<htmlpageheader name="myHTMLHeader1">
	
				<div style="width:100%">
					<div style="width:24%;border:0px solid;float:left;text-align:center;">
					 &nbsp;LOGO HERE
					</div>
					<div style="width:50%;border:0px solid;float:left;text-align:center;">
						<span><b><?php echo $data['Laboratory'][$data['LaboratoryId']]['Company']['name']?></b></span><br/>
						<span><?php echo $data['Laboratory'][$data['LaboratoryId']]['Company']['website']?></span>
					</div>
					<div style="width:24%;border:0px solid;float:left;text-align:center;">
					 &nbsp;LOGO HERE
					</div>
				</div>
				
			<?php 
// 			$this->log($data,'debugs');
// 				if(isset($testresult['release_date']))
// 					{$release_datetime=date('m/d/Y g:i A',strtotime($testresult['release_date']." ".$testresult['release_time']));}
				
				
				echo $this->element('pdf/header',array(
				'patientData'=>array(
							'Person'=>$data['Patient']['Person'],
							'Patient'=>$data['Patient']['Patient'],
							'PatientOrder'=>$data['LaboratoryTestOrder'],
// 							'TestOrderResult'=>$data['LaboratoryTestOrderResults']['LaboratoryTestOrderResult'],
							'Physician'=>$data['Physicians'],
							'Laboratory'=>$data['Laboratory'],
// 							'Status'=>$testresult['order_type'],
// 							'CheckinDateTime'=>$testresult['TestResultSpecimen']['extract_date']." ".$testresult['TestResultSpecimen']['extract_time'],
// 							'Datetimeprocess'=>$testresult['TestResultSpecimen']['accepted_date']." ".$testresult['TestResultSpecimen']['accepted_time'],
// 							'CollectingUser'=>$user[$testresult['TestResultSpecimen']['extracting_user_id']]['name'],
// 							'TestResultExtraField'=>$testresult['TestResultExtraField'],
							'requested_datetime'=>current($data['LaboratoryPatientBatchOrders']['LaboratoryPatientBatchOrder']),
							'TestOrder'=>$data['LaboratoryTestOrderPackages']['LaboratoryTestOrderPackage'],
// 							'print_count'=>$print_count,
						),
				'patientOrderId' => $patientOrderId
					)
				); 
// 				$this->log($data,'debug');
			?>
		</htmlpageheader>
			<?php 
				echo $this->element('pdf/chemistry',array(
					'Result'=>$data['LaboratoryTestOrderResults']['LaboratoryTestOrderResult'],
					'testGroup'=>current($data['LaboratoryTestOrderPackages']['LaboratoryTestOrderPackage']),	
					'TestOrder'=>$data['LaboratoryTestOrderPackages']['LaboratoryTestOrderPackage'],
				)
			);
			?>
			<?php 
				echo $this->element('pdf/footer',array(
					'release_datetime'=>$data['LaboratoryTestOrder']['LaboratoryTestOrder']['release_date'].' '.$data['LaboratoryTestOrder']['LaboratoryTestOrder']['release_time'],
					'medtech'=>current($medtech['LaboratoryProfile']),
					'pathology'=>current($medtech['LaboratoryProfile']),
				
				));
			?>

</body>
</html>