<?php
App::uses('AppModel', 'Model');
/**
 * CompanyBranchAccreditation Model
 *
 * @property CompanyBranch $CompanyBranch
 * @property Accreditation $Accreditation
 */
class CompanyBranchAccreditation extends AppModel {


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
		'Accreditation' => array(
			'className' => 'Accreditation',
			'foreignKey' => 'accreditation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
