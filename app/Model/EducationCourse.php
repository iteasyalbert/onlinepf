<?php
App::uses('AppModel', 'Model');
/**
 * EducationCourse Model
 *
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 * @property EducationCourseProfession $EducationCourseProfession
 */
class EducationCourse extends AppModel {
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
		'EducationCourseProfession' => array(
			'className' => 'EducationCourseProfession',
			'foreignKey' => 'education_course_id',
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
