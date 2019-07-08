<?php
App::uses('AppModel', 'Model');
class LaboratoryPatientOrderPhysician extends AppModel {
	public $belongsTo = array(
		'Physician'=>array(
			'className' => 'Physician',
			'foreignKey' => 'physician_id',
		),
		'LaboratoryPatientOrder'=>array(
			'className'=>'LaboratoryPatientOrder',
			'foreignKey'=>'patient_order_id'
		),
		'Laboratory'=>array(
				'className'=>'Laboratory',
				'foreignKey'=>'laboratory_id'
		)
	);

}
