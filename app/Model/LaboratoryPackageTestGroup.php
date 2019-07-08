<?php
App::uses('AppModel', 'Model');
/**
 * LaboratoryPackageTestGroup Model
 *
 * @property Package $Package
 * @property TestGroup $TestGroup
 */
class LaboratoryPackageTestGroup extends AppModel {
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Package' => array(
			'className' => 'Package',
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
		)
	);
}
