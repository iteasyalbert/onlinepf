<?php
App::uses('AppModel', 'Model');
/**
 * TestOrderPackageMedicalReport Model
 *
 * @property TestOrderPackage $TestOrderPackage
 * @property MedicalReportTemplate $MedicalReportTemplate
 */
class LaboratoryTestOrderPackageMedicalReport extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryTestOrderPackage' => array(
			'className' => 'LaboratoryTestOrderPackage',
			'foreignKey' => 'test_order_package_id',
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
