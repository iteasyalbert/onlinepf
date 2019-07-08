<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchInfo Model
 *
 * @property CompanyBranch $CompanyBranch
 */
class CompanyBranchInfo extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'company_branch_info';


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
		)
	);
}
