<?php
App::uses('AppModel', 'Model');
class LaboratoryTestResultSpecimenHistory extends AppModel {
	public $belongsTo = array(
		'LaboratoryTestResultSpecimen' => array(
			'className' => 'LaboratoryTestResultSpecimen',
			'foreignKey' => 'test_result_specimen_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
