<?php
App::uses('AppModel', 'Model');
class LaboratoryPatientBatchPackageOrderDiscount extends AppModel {
	public $belongsTo = array(
		'LaboratoryPatientBatchPackageOrder'=>array(
			'className' => 'LaboratoryPatientBatchPackageOrder',
			'foreignKey' => 'patient_batch_package_order_id',
			'dependent' =>true
		),
		'LaboratoryDiscount'=>array(
			'className'=>'LaboratoryDiscount',
			'foreignKey'=>'discount_id'
		)
	);

}
?>