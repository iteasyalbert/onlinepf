<?php
App::uses('AppModel', 'Model');
/**
 * TestSet Model
 *
 * @property Laboratory $Laboratory
 * @property TestConvertion $TestConvertion
 * @property TestGroupDetail $TestGroupDetail
 * @property TestInterpretation $TestInterpretation
 * @property TestOrderPackage $TestOrderPackage
 * @property TestReferenceRange $TestReferenceRange
 */
class LaboratoryTestSet extends AppModel {
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
		'LaboratoryTestConvertion' => array(
			'className' => 'LaboratoryTestConvertion',
			'foreignKey' => 'test_set_id',
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
			'foreignKey' => 'test_set_id',
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
		'LaboratoryTestInterpretation' => array(
			'className' => 'LaboratoryTestInterpretation',
			'foreignKey' => 'test_set_id',
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
			'foreignKey' => 'test_set_id',
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
		'LaboratoryTestReferenceRange' => array(
			'className' => 'LaboratoryTestReferenceRange',
			'foreignKey' => 'test_set_id',
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
