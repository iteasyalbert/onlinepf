<?php
App::uses('AppModel', 'Model');
/**
 * LaboratoryPatientBatchOrderDiscount Model
 *
 * @property PatientBatchOrder $PatientBatchOrder
 * @property Discount $Discount
 */
class LaboratoryPatientBatchOrderDiscount extends AppModel {
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LaboratoryPatientBatchOrder' => array(
			'className' => 'LaboratoryPatientBatchOrder',
			'foreignKey' => 'patient_batch_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Discount' => array(
			'className' => 'Discount',
			'foreignKey' => 'discount_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
