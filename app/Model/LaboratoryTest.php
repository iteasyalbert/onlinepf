<?php
App::uses('AppModel', 'Model');
/**
 * Test Model
 *
 * @property Laboratory $Laboratory
 * @property PackageDetail $PackageDetail
 * @property PatientBatchOrderDetail $PatientBatchOrderDetail
 * @property TestConvertion $TestConvertion
 * @property TestGroupDetail $TestGroupDetail
 * @property TestInterpretation $TestInterpretation
 * @property TestOrderResult $TestOrderResult
 * @property TestReferenceRange $TestReferenceRange
 */
class LaboratoryTest extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Laboratory' => array(
			'className' => 'Laboratory',
			'foreignKey' => 'laboratory_id',
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
// 		'LaboratoryPackageDetail' => array(
// 			'className' => 'LaboratoryPackageDetail',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryPatientBatchOrderDetail' => array(
// 			'className' => 'LaboratoryPatientBatchOrderDetail',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryTestConvertion' => array(
// 			'className' => 'LaboratoryTestConvertion',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryTestGroupDetail' => array(
// 			'className' => 'LaboratoryTestGroupDetail',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryTestInterpretation' => array(
// 			'className' => 'LaboratoryTestInterpretation',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryTestOrderResult' => array(
// 			'className' => 'LaboratoryTestOrderResult',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryTestReferenceRange' => array(
// 			'className' => 'LaboratoryTestReferenceRange',
// 			'foreignKey' => 'test_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		)
'LaboratoryStandardTest'=> array(
			'className' => 'LaboratoryStandardTest',
			'foreignKey' => 'test_id',
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
