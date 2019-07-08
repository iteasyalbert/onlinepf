<?php
App::uses('AppModel', 'Model');
/**
 * InsuranceProviderProduct Model
 *
 * @property InsuranceProvider $InsuranceProvider
 * @property LaboratoryAcceptedInsurance $LaboratoryAcceptedInsurance
 * @property PersonInsurance $PersonInsurance
 */
class InsuranceProviderProduct extends AppModel {

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
		'InsuranceProvider' => array(
			'className' => 'InsuranceProvider',
			'foreignKey' => 'insurance_provider_id',
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
		'LaboratoryAcceptedInsurance' => array(
			'className' => 'LaboratoryAcceptedInsurance',
			'foreignKey' => 'insurance_provider_product_id',
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
		'PersonInsurance' => array(
			'className' => 'PersonInsurance',
			'foreignKey' => 'insurance_provider_product_id',
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
