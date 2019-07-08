<?php
App::uses('AppModel', 'Model');
/**
 * PersonIdentification Model
 *
 * @property Person $Person
 * @property IdentificationType $IdentificationType
 */
class PersonIdentification extends AppModel {

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
	public $belongsTo = array(
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'person_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'IdentificationType' => array(
			'className' => 'IdentificationType',
			'foreignKey' => 'identification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
