<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchMember Model
 *
 * @property CompanyBranch $CompanyBranch
 * @property Users $Users
 * @property CompanyBranchMemberDuty $CompanyBranchMemberDuty
 */
class CompanyBranchMember extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	
	public $belongsTo = array(
		'CompanyBranch' => array(
			'className' => 'CompanyBranch',
			'foreignKey' => 'company_branch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CompanyBranchMemberDuty' => array(
			'className' => 'CompanyBranchMemberDuty',
			'foreignKey' => 'company_branch_member_id',
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
