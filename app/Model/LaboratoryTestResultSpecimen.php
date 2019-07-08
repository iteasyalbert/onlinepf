<?php
App::uses('AppModel', 'Model');
class LaboratoryTestResultSpecimen extends AppModel {
	public $belongsTo = array(
		'LaboratoryTestResult' => array(
			'className' => 'LaboratoryTestResult',
			'foreignKey' => 'test_result_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'LaboratoryTestResultSpecimenHistory' => array(
			'className' => 'LaboratoryTestResultSpecimenHistory',
			'foreignKey' => 'test_result_specimen_id',
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
