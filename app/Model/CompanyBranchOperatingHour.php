<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchOperatingHour Model
 *
 * @property CompanyBranch $CompanyBranch
 * @property User $User
 */
class CompanyBranchOperatingHour extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $days = array(
		1 => 'Monday', 
		2 => 'Tuesday', 
		3 => 'Wednesday', 
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday',
		7 => 'Sunday'
	);
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
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
