<?php
App::uses('AppModel', 'Model');
/**
 * MedicalReportTemplate Model
 *
 * @property User $User
 * @property ValidatingUser $ValidatingUser
 * @property TestOrderMedicalReport $TestOrderMedicalReport
 * @property TestOrderPackageMedicalReport $TestOrderPackageMedicalReport
 */
class MedicalReportTemplate extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LaboratoryTestOrderMedicalReport' => array(
			'className' => 'LaboratoryTestOrderMedicalReport',
			'foreignKey' => 'medical_report_template_id',
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
		'LaboratoryTestOrderPackageMedicalReport' => array(
			'className' => 'LaboratoryTestOrderPackageMedicalReport',
			'foreignKey' => 'medical_report_template_id',
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
