<?php
App::uses('AppModel', 'Model');
/**
 * CorporateAccountContactInformation Model
 *
 * @property CorporateAccount $CorporateAccount
 * @property Contact $Contact
 */
class CorporateAccountContactInformation extends AppModel {


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
		'Contact' => array(
			'className' => 'Contact',
			'foreignKey' => 'contact_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
