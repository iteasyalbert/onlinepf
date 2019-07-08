<?php
App::uses('AppModel', 'Model');
/**
 * PersonEducationalBackground Model
 *
 * @property Person $Person
 * @property School $School
 * @property EducationLevel $EducationLevel
 * @property EducationDegree $EducationDegree
 * @property User $User
 * @property EducationCourse $EducationCourse
 */
class PersonEducationalBackground extends AppModel {

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
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EducationLevel' => array(
			'className' => 'EducationLevel',
			'foreignKey' => 'education_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EducationDegree' => array(
			'className' => 'EducationDegree',
			'foreignKey' => 'education_degree_id',
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
		'EducationCourse' => array(
			'className' => 'EducationCourse',
			'foreignKey' => 'education_major_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
