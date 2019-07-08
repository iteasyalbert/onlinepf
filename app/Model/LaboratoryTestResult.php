<?php
App::uses('AppModel', 'Model');
class LaboratoryTestResult extends AppModel {
	public $hasMany = array(
		'LaboratoryTestOrderDetail'=>array(
			'className'=>'LaboratoryTestOrderDetail',
			'foreignKey'=>'test_result_id',
			'dependent'=>true
		),
		'LaboratoryTestResultReleaseLevel'=>array(
			'className'=>'LaboratoryTestResultReleaseLevel',
			'foreignKey'=>'test_result_id',
			'dependent'=>true
		),	
		'LaboratoryTestResultHistory'=>array(
			'className'=>'LaboratorytestOrderHistory',
			'foreignKey'=>'id',
			'dependent'=>true
		),
		'LaboratoryTestResultHistory'=>array(
			'className'=>'LaboratoryTestResultHistory',
			'foreignKey'=>'test_result_id'
		),	
// 		'LaboratoryTestResultLog'=>array(
// 				'className'=>'LaboratoryTestResultLog',
// 				'foreignKey'=>'test_result_id'
// 		),
// 		'LaboratoryTestResultExtraField'=>array(
// 			'className'=>'LaboratoryTestResultExtraField',
// 			'foreignKey'=>'test_result_id'
// 		),
// 		'LaboratoryTestResultPrintLog'=>array(
// 				'className'=>'LaboratoryTestResultPrintLog',
// 				'foreignKey'=>'test_result_id'
// 		),
	);
	
	public $order_type = array(
		'0'=>'Routine',
		'1'=>'Stat'
	);
	
	public $hasOne = array(
		'LaboratoryTestResultSpecimen'=>array(
			'className'=>'LaboratoryTestResultSpecimen',
			'foreignKey'=>'test_result_id'
		)
	);
	
	public $belongsTo = array(
		'LaboratoryTestGroup'=>array(
			'className'=>'LaboratoryTestGroup',
			'foreignKey'=>'test_group_id'
		),
		'LaboratoryReleaseLevel'=>array(
			'className'=>'LaboratoryReleaseLevel',
			'foreignKey'=>'release_level_id'
		),
		'User'=>array(
			'className'=>'User',
			'foreignKey'=>'pathologist_user_id'
		)
	);
	
		
	public $resultStatuses = array(
		0 => "No Result",
		1 => "Received Partial Results",
		2 => "Received All Results",
		3 => "Level Released",
		4 => "Released"
	);
	
	public $phlebowardingtest = array(
		'bloodgas',
		'createninceclearance',
		'bloodtyping',
		'crossmatching',
		'chemistry',
		'createninceclearance',
		'hams',
		'hemactbt',
		'hemaesr',
		'hematology',
		'serology',
		'hematologycbc',
		'immunology',
		'leprep',
		'pbs',
		'malarialsmear',
		'ptptt',
		'coombstest',
		'immfertility',
		'immhepatitis',
		'leprep',
		'ogct1hr',
		'ogtt2hr',
		'ogtt2hrnonpreg',
		'ogtt2hrpregnant',
		'ogtt3hr',
		'pbs'
	);

}
