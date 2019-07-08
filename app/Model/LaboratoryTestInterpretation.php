<?php
App::uses('AppModel', 'Model');
/**
 * TestInterpretation Model
 *
 * @property TestSet $TestSet
 * @property Test $Test
 */
class LaboratoryTestInterpretation extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryTestSet' => array(
			'className' => 'LaboratoryTestSet',
			'foreignKey' => 'test_set_id',
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
