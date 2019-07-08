<?php
App::uses('AppModel', 'Model');
/**
 * LaboratoryAcceptedInsurance Model
 *
 * @property Laboratory $Laboratory
 * @property InsuranceProviderProduct $InsuranceProviderProduct
 */
class LaboratoryAcceptedInsurance extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'laboratory_accepted_insurance';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Laboratory' => array(
			'className' => 'Laboratory',
			'foreignKey' => 'laboratory_id',
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
