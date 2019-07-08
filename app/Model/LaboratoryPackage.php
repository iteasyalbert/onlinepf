<?php
App::uses('AppModel', 'Model');
/**
 * LaboratoryPackage Model
 *
 * @property Laboratory $Laboratory
 */
class LaboratoryPackage extends AppModel {
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
}
