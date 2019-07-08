<?php
App::uses('AppModel', 'Model');
class LaboratoryPatientBatchPackageOrder extends AppModel {
	
	public $hasMany = array(
		'LaboratoryPatientPackageOrder'=>array(
			'className'=>'LaboratoryPatientPackageOrder',
			'foreignKey'=>'patient_batch_package_order_id',
			'dependent'=>true
		),
		'LaboratoryPatientBatchPackageOrderDiscount'=>array(
			'className' => 'LaboratoryPatientBatchPackageOrderDiscount',
			'foreignKey' => 'patient_batch_package_order_id',
			'dependent' =>true
		),		
	);
	
	public $belongsTo = array(
		'LaboratoryPatientOrder'=>array(
			'className' => 'LaboratoryPatientOrder',
			'foreignKey' => 'patient_order_id',
			'dependent'=>true
		)		
	);	
	
}
?>