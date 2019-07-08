<?php
App::uses('AppModel', 'Model');
/**
 * PatientBatchOrderPackage Model
 *
 * @property PatientBatchOrder $PatientBatchOrder
 * @property Package $Package
 * @property TestGroup $TestGroup
 * @property TestGroupPrice $TestGroupPrice
 * @property Physician $Physician
 * @property PatientBatchOrderDetail $PatientBatchOrderDetail
 * @property TestOrderPackage $TestOrderPackage
 */
class LaboratoryPatientBatchOrderPackage extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryPatientBatchOrder' => array(
			'className' => 'LaboratoryPatientBatchOrder',
			'foreignKey' => 'patient_batch_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LaboratoryPackage' => array(
			'className' => 'LaboratoryPackage',
			'foreignKey' => 'package_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LaboratoryTestGroup' => array(
			'className' => 'LaboratoryTestGroup',
			'foreignKey' => 'test_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LaboratoryTestGroupPrice' => array(
			'className' => 'LaboratoryTestGroupPrice',
			'foreignKey' => 'test_group_price_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Physician' => array(
			'className' => 'Physician',
			'foreignKey' => 'physician_id',
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
		'LaboratoryPatientBatchOrderDetail' => array(
			'className' => 'LaboratoryPatientBatchOrderDetail',
			'foreignKey' => 'patient_batch_order_package_id',
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
		'LaboratoryTestOrderPackage' => array(
			'className' => 'LaboratoryTestOrderPackage',
			'foreignKey' => 'patient_batch_order_package_id',
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
