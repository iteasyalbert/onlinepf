<?php
App::uses('AppModel', 'Model');
/**
 * CorporateAccount Model
 *
 * @property CompanyBranchAddress $CompanyBranchAddress
 * @property CompanyBranchContactInformation $CompanyBranchContactInformation
 * @property LaboratoryCorporatePartner $LaboratoryCorporatePartner
 * @property User $User
 */
class CorporateAccount extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $classifications = array(
			1 => 'Corporate'
	);
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LaboratoryCorporatePartner' => array(
			'className' => 'LaboratoryCorporatePartner',
			'foreignKey' => 'corporate_id',
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
		'CorporateAccountUser' => array(
			'className' => 'CorporateAccountUser',
			'foreignKey' => 'corporate_id',
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
	
	var $belongsTo=array(
			'CompanyBranch' => array(
					'className' => 'CompanyBranch',
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

}
