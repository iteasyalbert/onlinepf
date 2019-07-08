<?php
App::uses('AppModel', 'Model');
/**
 * ContactInformation Model
 *
 * @property User $User
 * @property CompanyBranch $CompanyBranch
 * @property Person $Person
 */
class ContactInformation extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $types = array(
		1 => 'Telephone Number',
		2 => 'Mobile Number',
		3 => 'Fax Number',
		4 => 'Email Address'
	);
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'CompanyBranch' => array(
			'className' => 'CompanyBranch',
			'joinTable' => 'company_branch_contact_informations',
			'foreignKey' => 'contact_id',
			'associationForeignKey' => 'company_branch_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Person' => array(
			'className' => 'Person',
			'joinTable' => 'person_contact_informations',
			'foreignKey' => 'contact_id',
			'associationForeignKey' => 'person_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
