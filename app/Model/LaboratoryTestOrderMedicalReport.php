<?php
App::uses('AppModel', 'Model');
/**
 * TestOrderMedicalReport Model
 *
 * @property TestOrder $TestOrder
 * @property MedicalReportTemplate $MedicalReportTemplate
 */
class LaboratoryTestOrderMedicalReport extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryTestOrder' => array(
			'className' => 'LaboratoryTestOrder',
			'foreignKey' => 'test_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LaboratoryMedicalReportTemplate' => array(
			'className' => 'LaboratoryMedicalReportTemplate',
			'foreignKey' => 'medical_report_template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
