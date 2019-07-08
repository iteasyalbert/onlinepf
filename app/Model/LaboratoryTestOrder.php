<?php
App::uses('AppModel', 'Model');
/**
 * TestOrder Model
 *
 * @property PatientOrder $PatientOrder
 * @property TestOrderAuditLog $TestOrderAuditLog
 * @property TestOrderMedicalReport $TestOrderMedicalReport
 * @property TestOrderPackage $TestOrderPackage
 */
class LaboratoryTestOrder extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'LaboratoryPatientOrder' => array(
			'className' => 'LaboratoryPatientOrder',
			'foreignKey' => 'id',
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
		'LaboratoryTestOrderAuditLog' => array(
			'className' => 'LaboratoryTestOrderAuditLog',
			'foreignKey' => 'test_order_id',
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
// 		'LaboratoryTestOrderMedicalReport' => array(
// 			'className' => 'LaboratoryTestOrderMedicalReport',
// 			'foreignKey' => 'test_order_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		),
// 		'LaboratoryTestOrderPackage' => array(
// 			'className' => 'LaboratoryTestOrderPackage',
// 			'foreignKey' => 'test_order_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		)
	);

}
