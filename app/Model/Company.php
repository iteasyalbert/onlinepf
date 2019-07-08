<?php
App::uses('AppModel', 'Model');
/**
 * Company Model
 *
 * @property Industry $Industry
 * @property CompanyBranch $CompanyBranch
 */
class Company extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Industry' => array(
			'className' => 'Industry',
			'foreignKey' => 'industry_id',
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
		'CompanyBranch' => array(
			'className' => 'CompanyBranch',
			'foreignKey' => 'company_id',
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
