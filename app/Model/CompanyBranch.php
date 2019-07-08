<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranch Model
 *
 * @property Company $Company
 * @property CompanyBranchAccreditation $CompanyBranchAccreditation
 * @property CompanyBranchAddress $CompanyBranchAddress
 * @property CompanyBranchContactInformation $CompanyBranchContactInformation
 * @property CompanyBranchInfo $CompanyBranchInfo
 * @property CompanyBranchMember $CompanyBranchMember
 * @property CompanyBranchOperatingHour $CompanyBranchOperatingHour
 * @property CompanyBranchService $CompanyBranchService
 * @property InsuranceProvider $InsuranceProvider
 * @property Laboratory $Laboratory
 * @property LaboratoryCorporatePartner $LaboratoryCorporatePartner
 * @property PersonWorkExperience $PersonWorkExperience
 * @property School $School
 */
class CompanyBranch extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $virtualFields  = array('branch' => 'CompanyBranch.name');
	
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
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
		'CompanyBranchAccreditation' => array(
			'className' => 'CompanyBranchAccreditation',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CompanyBranchAddress' => array(
			'className' => 'CompanyBranchAddress',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CompanyBranchContactInformation' => array(
			'className' => 'CompanyBranchContactInformation',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'CompanyBranchMember' => array(
			'className' => 'CompanyBranchMember',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CompanyBranchOperatingHour' => array(
			'className' => 'CompanyBranchOperatingHour',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CompanyBranchService' => array(
			'className' => 'CompanyBranchService',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'InsuranceProvider' => array(
			'className' => 'InsuranceProvider',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'LaboratoryCorporatePartner' => array(
			'className' => 'LaboratoryCorporatePartner',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonWorkExperience' => array(
			'className' => 'PersonWorkExperience',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'company_branch_id',
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

	var $hasOne = array(
		'Laboratory' => array(
				'className' => 'Laboratory',
				'foreignKey' => 'company_branch_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
		'CorporateAccount' => array(
				'className' => 'CorporateAccount',
				'foreignKey' => 'company_branch_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		),
		'CompanyBranchInfo' => array(
			'className' => 'CompanyBranchInfo',
			'foreignKey' => 'company_branch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),		
	);
}
