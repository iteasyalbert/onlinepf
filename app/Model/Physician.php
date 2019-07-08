<?php
App::uses('AppModel', 'Model');
/**
 * Physician Model
 *
 * @property Users $Users
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 * @property PatientBatchOrderPackage $PatientBatchOrderPackage
 * @property PhysicianProfile $PhysicianProfile
 */
class Physician extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Users' => array(
			'className' => 'Users',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		/* 'LaboratoryPatientBatchPackageOrder' => array(
			'className' => 'LaboratoryPatientBatchPackageOrder',
			'foreignKey' => 'physician_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		), */
		'PhysicianProfile' => array(
			'className' => 'PhysicianProfile',
			'foreignKey' => 'physician_id',
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
