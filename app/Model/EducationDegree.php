<?php
App::uses('AppModel', 'Model');
/**
 * EducationDegree Model
 *
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 * @property PersonEducationalBackground $PersonEducationalBackground
 */
class EducationDegree extends AppModel {
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ValidatingUser' => array(
			'className' => 'ValidatingUser',
			'foreignKey' => 'validating_user_id',
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
		'PersonEducationalBackground' => array(
			'className' => 'PersonEducationalBackground',
			'foreignKey' => 'education_degree_id',
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
