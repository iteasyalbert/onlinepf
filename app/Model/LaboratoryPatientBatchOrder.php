<?php
App::uses('AppModel', 'Model');
/**
 * PatientBatchOrder Model
 *
 * @property PatientOrder $PatientOrder
 * @property PatientBatchOrderDiscount $PatientBatchOrderDiscount
 * @property PatientBatchOrderPackage $PatientBatchOrderPackage
 */
class LaboratoryPatientBatchOrder extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryPatientOrder' => array(
			'className' => 'LaboratoryPatientOrder',
			'foreignKey' => 'patient_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LaboratoryPatientBatchOrderDiscount' => array(
			'className' => 'LaboratoryPatientBatchOrderDiscount',
			'foreignKey' => 'patient_batch_order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'LaboratoryPatientBatchPackageOrder' => array(
			'className' => 'LaboratoryPatientBatchPackageOrder',
			'foreignKey' => 'patient_batch_order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
