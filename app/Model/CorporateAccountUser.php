<?php
App::uses('AppModel', 'Model');
/**
 * CorporateAccountUser Model
 *
 * @property CorporateAccount $CorporateAccount
 */
class CorporateAccountUser extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CorporateAccount' => array(
			'className' => 'CorporateAccount',
			'foreignKey' => 'corporate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
