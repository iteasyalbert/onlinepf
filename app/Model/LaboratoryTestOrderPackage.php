<?php
App::uses('AppModel', 'Model');
/**
 * TestOrderPackage Model
 *
 * @property PatientBatchOrderPackage $PatientBatchOrderPackage
 * @property TestOrder $TestOrder
 * @property TestGroup $TestGroup
 * @property TestSet $TestSet
 * @property TestOrderPackageMedicalReport $TestOrderPackageMedicalReport
 * @property TestOrderResult $TestOrderResult
 */
class LaboratoryTestOrderPackage extends AppModel {

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
		'LaboratoryTestOrder' => array(
			'className' => 'LaboratoryTestOrder',
			'foreignKey' => 'test_order_id',
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
// 		'LaboratoryTestSet' => array(
// 			'className' => 'LaboratoryTestSet',
// 			'foreignKey' => 'test_set_id',
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => ''
// 		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LaboratoryTestOrderPackageMedicalReport' => array(
			'className' => 'LaboratoryTestOrderPackageMedicalReport',
			'foreignKey' => 'test_order_package_id',
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
		'LaboratoryTestOrderResult' => array(
			'className' => 'LaboratoryTestOrderResult',
			'foreignKey' => 'test_order_package_id',
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
