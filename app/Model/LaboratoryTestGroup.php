<?php
App::uses('AppModel', 'Model');
/**
 * TestGroup Model
 *
 * @property Laboratory $Laboratory
 * @property PatientBatchOrderPackage $PatientBatchOrderPackage
 * @property TestGroupDetail $TestGroupDetail
 * @property TestGroupPrice $TestGroupPrice
 * @property TestOrderPackage $TestOrderPackage
 */
class LaboratoryTestGroup extends AppModel {
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
		'LaboratoryPatientBatchPackageOrder' => array(
			'className' => 'LaboratoryPatientBatchPackageOrder',
			'foreignKey' => 'test_group_id',
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
		'LaboratoryTestGroupDetail' => array(
			'className' => 'LaboratoryTestGroupDetail',
			'foreignKey' => 'test_group_id',
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
		'LaboratoryTestGroupPrice' => array(
			'className' => 'LaboratoryTestGroupPrice',
			'foreignKey' => 'test_group_id',
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
			'foreignKey' => 'test_group_id',
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
		'LaboratoryStandardTestGroup'=> array(
			'className' => 'LaboratoryStandardTestGroup',
			'foreignKey' => 'test_group_id',
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
		
	);

}
