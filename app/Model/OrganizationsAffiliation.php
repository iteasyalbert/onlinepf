<?php
App::uses('AppModel', 'Model');
/**
 * OrganizationsAffliation Model
 *
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 */
class OrganizationsAffiliation extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $useTable = 'organizations_affliations';
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
//		'User' => array(
//			'className' => 'User',
//			'foreignKey' => 'user_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
	);
}
