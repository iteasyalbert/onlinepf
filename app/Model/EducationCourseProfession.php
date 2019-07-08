<?php
App::uses('AppModel', 'Model');
/**
 * EducationCourseProfession Model
 *
 * @property EducationCourse $EducationCourse
 * @property Profession $Profession
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 */
class EducationCourseProfession extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'EducationCourse' => array(
			'className' => 'EducationCourse',
			'foreignKey' => 'education_course_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Profession' => array(
			'className' => 'Profession',
			'foreignKey' => 'profession_id',
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
		'ValidatingUser' => array(
			'className' => 'ValidatingUser',
			'foreignKey' => 'validating_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
