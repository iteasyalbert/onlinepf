<?php
App::uses('AppModel', 'Model');
/**
 * ActionCode Model
 *
 * @property TestOrderAuditLog $TestOrderAuditLog
 */
class ActionCode extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TestOrderAuditLog' => array(
			'className' => 'TestOrderAuditLog',
			'foreignKey' => 'action_id',
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
