<?php
App::uses('AppModel', 'Model');
/**
 * LaboratoryPackageDetail Model
 *
 * @property PackageTestGroup $PackageTestGroup
 * @property Test $Test
 */
class LaboratoryPackageDetail extends AppModel {
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PackageTestGroup' => array(
			'className' => 'PackageTestGroup',
			'foreignKey' => 'package_test_group_id',
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
