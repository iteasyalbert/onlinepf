<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchContactInformation Model
 *
 * @property CompanyBranch $CompanyBranch
 * @property Contact $Contact
 * @property User $User
 */
class CompanyBranchContactInformation extends AppModel {

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
		'ContactInformation' => array(
				'className' => 'ContactInformation',
				'foreignKey' => 'contact_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		),			
		'CompanyBranch' => array(
			'className' => 'CompanyBranch',
			'foreignKey' => 'company_branch_id',
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
