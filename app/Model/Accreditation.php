<?php
App::uses('AppModel', 'Model');
/**
 * Accreditation Model
 *
 * @property CompanyBranchAccreditation $CompanyBranchAccreditation
 */
class Accreditation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CompanyBranchAccreditation' => array(
			'className' => 'CompanyBranchAccreditation',
			'foreignKey' => 'accreditation_id',
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
