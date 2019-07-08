<?php
App::uses('AppModel', 'Model');
/**
 * OrganizationsAffliation Model
 *
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 */
class OrganizationsAffliation extends AppModel {
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ValidatingUser' => array(
			'className' => 'ValidatingUser',
			'foreignKey' => 'validating_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
