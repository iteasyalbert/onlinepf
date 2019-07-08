<?php
App::uses('AppModel', 'Model');
/**
 * PatientBatchOrderDetail Model
 *
 * @property PatientBatchOrderPackage $PatientBatchOrderPackage
 * @property Test $Test
 */
class LaboratoryPatientBatchOrderDetail extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryPatientBatchPackageOrder' => array(
			'className' => 'LaboratoryPatientBatchPackageOrder',
			'foreignKey' => 'patient_batch_order_package_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LaboratoryTest' => array(
			'className' => 'LaboratoryTest',
			'foreignKey' => 'test_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
