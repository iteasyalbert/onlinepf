<?php
App::uses('AppModel', 'Model');
/**
 * TestOrderResult Model
 *
 * @property TestOrderPackage $TestOrderPackage
 * @property Test $Test
 */
class LaboratoryTestOrderResult extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryTestOrderPackage' => array(
			'className' => 'LaboratoryTestOrderPackage',
			'foreignKey' => 'test_order_package_id',
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
