<?php
App::uses('AppModel', 'Model');
/**
 * LaboratoryCorporatePartner Model
 *
 * @property Laboratory $Laboratory
 * @property CorporateAccount $CorporateAccount
 */
class LaboratoryCorporatePartner extends AppModel {

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
		'CorporateAccount' => array(
			'className' => 'CorporateAccount',
			'foreignKey' => 'corporate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
