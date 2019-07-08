<?php
App::uses('AppModel', 'Model');
/**
 * TestGroupPrice Model
 *
 * @property TestGroup $TestGroup
 * @property PatientBatchOrderPackage $PatientBatchOrderPackage
 */
class LaboratoryTestGroupPrice extends AppModel {
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
		'LaboratoryTestGroup' => array(
			'className' => 'LaboratoryTestGroup',
			'foreignKey' => 'test_group_id',
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
			'foreignKey' => 'test_group_price_id',
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
