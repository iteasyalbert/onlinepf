<?php
App::uses('AppModel', 'Model');
/**
 * InsuranceProvider Model
 *
 * @property InsuranceProviderProduct $InsuranceProviderProduct
 */
class InsuranceProvider extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	
	public $hasMany = array(
		'InsuranceProviderProduct' => array(
			'className' => 'InsuranceProviderProduct',
			'foreignKey' => 'insurance_provider_id',
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
	public $belongsTo = array(
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
