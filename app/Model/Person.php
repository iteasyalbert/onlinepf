<?php
App::uses('AppModel', 'Model');
/**
 * Person Model
 *
 * @property Suffix $Suffix
 * @property TitleCode $TitleCode
 * @property Patient $Patient
 * @property PersonAddress $PersonAddress
 * @property PersonAlias $PersonAlias
 * @property PersonContactInformation $PersonContactInformation
 * @property PersonIdentification $PersonIdentification
 * @property PersonIdentity $PersonIdentity
 * @property PersonInsurance $PersonInsurance
 */
class Person extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
//	public $virtualFields = array('Person.age' => '0');
	public $belongsTo = array(
		'Suffix' => array(
			'className' => 'Suffix',
			'foreignKey' => 'suffix_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TitleCode' => array(
			'className' => 'TitleCode',
			'foreignKey' => 'title_id',
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
		'Patient' => array(
			'className' => 'Patient',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonAddress' => array(
			'className' => 'PersonAddress',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonAlias' => array(
			'className' => 'PersonAlias',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonContactInformation' => array(
			'className' => 'PersonContactInformation',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonIdentification' => array(
			'className' => 'PersonIdentification',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonIdentity' => array(
			'className' => 'PersonIdentity',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonInsurance' => array(
			'className' => 'PersonInsurance',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonMark' => array(
				'className' => 'PersonMark',
				'foreignKey' => 'person_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		),		
		'PersonImage' => array(
			'className' => 'PersonImage',
			'foreignKey' => 'person_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonEducationalBackground' => array(
			'className' => 'PersonEducationalBackground',
			'foreignKey' => 'person_id',
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
