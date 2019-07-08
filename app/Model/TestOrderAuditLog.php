<?php
App::uses('AppModel', 'Model');
/**
 * TestOrderAuditLog Model
 *
 * @property TestOrder $TestOrder
 * @property Action $Action
 */
class TestOrderAuditLog extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryTestOrder' => array(
			'className' => 'LaboratoryTestOrder',
			'foreignKey' => 'test_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'action_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
