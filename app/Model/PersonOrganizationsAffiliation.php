<?php
App::uses('AppModel', 'Model');
/**
 * PersonOrganizationsAffiliation Model
 *
 * @property Person $Person
 * @property Organization $Organization
 * @property User $User
 */
class PersonOrganizationsAffiliation extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'person_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OrganizationsAffiliation' => array(
			'className' => 'OrganizationsAffiliation',
			'foreignKey' => 'organization_id',
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
