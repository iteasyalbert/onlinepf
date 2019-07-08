<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchService Model
 *
 * @property CompanyBranch $CompanyBranch
 * @property Service $Service
 * @property User $User
 */
class CompanyBranchImage extends AppModel {

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