<?php
App::uses('AppModel', 'Model');
/**
 * PersonInsurance Model
 *
 * @property Person $Person
 * @property InsuranceProviderProduct $InsuranceProviderProduct
 */
class PersonInsurance extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $useTable ='person_insurance';
	public $belongsTo = array(
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'person_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InsuranceProviderProduct' => array(
			'className' => 'InsuranceProviderProduct',
			'foreignKey' => 'insurance_provider_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
