<?php
App::uses('AppModel', 'Model');
class LaboratoryPatientPackageOrder extends AppModel {
	public $hasMany = array(
		'LaboratoryPatientPackageDetail'=>array(
			'className'=>'LaboratoryPatientPackageDetail',
			'foreignKey'=>'patient_order_detail_id',
			'dependent'=>true
		)
	);	
	
	public $belongsTo = array(
		'LaboratoryPatientBatchPackageOrder'=>array(
			'className' => 'LaboratoryPatientBatchPackageOrder',
			'foreignKey' => 'patient_batch_package_order_id',
			'dependent'=>true
		),
		'LaboratoryTestGroup'=>array(
			'className' => 'LaboratoryTestGroup',
			'foreignKey' => 'test_group_id'
		),
		'LaboratoryPackage'=>array(
			'className' => 'LaboratoryPackage',
			'foreignKey' => 'package_id'
		),		
	);
	
}
