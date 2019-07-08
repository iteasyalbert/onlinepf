<?php
App::uses('AppModel', 'Model');
/**
 * Patient Model
 *
 * @property Internal $Internal
 * @property Person $Person
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 * @property PatientOrder $PatientOrder
 */
class Patient extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
//		'Internal' => array(
//			'className' => 'Internal',
//			'foreignKey' => 'internal_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'person_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
//		'User' => array(
//			'className' => 'User',
//			'foreignKey' => 'user_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'ValidatingUser' => array(
//			'className' => 'ValidatingUser',
//			'foreignKey' => 'validating_user_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LaboratoryPatientOrder' => array(
			'className' => 'LaboratoryPatientOrder',
			'foreignKey' => 'patient_id',
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
	public $validate = array(
		'firstname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter first name.',
			)		
		),
		'lastname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter last name.'
			)
		)
	);

}
