<?php
App::uses('AppModel', 'Model');
/**
 * PhysicianProfile Model
 *
 * @property Physician $Physician
 * @property User $User
 */
class PhysicianProfile extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $useTable = "physician_profile";
	public $belongsTo = array(
		'Physician' => array(
			'className' => 'Physician',
			'foreignKey' => 'physician_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
