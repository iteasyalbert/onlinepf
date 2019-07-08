<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchMemberDuty Model
 *
 * @property CompanyBranchMember $CompanyBranchMember
 */
class CompanyBranchMemberDuty extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CompanyBranchMember' => array(
			'className' => 'CompanyBranchMember',
			'foreignKey' => 'company_branch_member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
