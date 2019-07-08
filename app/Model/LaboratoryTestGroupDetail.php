<?php
App::uses('AppModel', 'Model');
/**
 * TestGroupDetail Model
 *
 * @property TestGroup $TestGroup
 * @property Test $Test
 * @property TestSet $TestSet
 */
class LaboratoryTestGroupDetail extends AppModel {

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
		),
		'LaboratoryTest' => array(
			'className' => 'LaboratoryTest',
			'foreignKey' => 'test_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LaboratoryTestSet' => array(
			'className' => 'LaboratoryTestSet',
			'foreignKey' => 'test_set_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
