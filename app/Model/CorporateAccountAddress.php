<?php
App::uses('AppModel', 'Model');
/**
 * CorporateAccountAddress Model
 *
 * @property CorporateAccount $CorporateAccount
 * @property Address $Address
 */
class CorporateAccountAddress extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CorporateAccount' => array(
			'className' => 'CorporateAccount',
			'foreignKey' => 'corporate_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'address_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
