<?php
App::uses('AppModel', 'Model');
/**
 * PersonContactInformation Model
 *
 * @property Person $Person
 * @property Contact $Contact
 */
class PersonContactInformation extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'person_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ContactInformation' => array(
			'className' => 'ContactInformation',
			'foreignKey' => 'contact_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
