<?php
App::uses('AppModel', 'Model');
class LaboratoryTestOrderDetail extends AppModel {
	public $hasOne = array(
		'LaboratoryTestOrderResult'=>array(
			'className' => 'LaboratoryTestOrderResult',
			'foreignKey' => 'test_order_detail_id',
			'dependent' => true
		)
	);
	
	public $hasMany = array(
		'LaboratoryTestOrderDetailHistory'=>array(
			'className' => 'LaboratoryTestOrderDetailHistory',
			'foreignKey' => 'test_order_detail_id',
			'dependent' => true
		)
	);	
	
	public $belongsTo = array(
		'LaboratoryTest'=>array(
			'class'=>'LaboratoryTest',
			'foreignKey'=>'test_id'
		),
		'LaboratoryTestGroup'=>array(
			'class'=>'LaboratoryTestGroup',
			'foreignKey'=>'panel_test_group_id'
		),
/*		'Instrument'=>array(
			'class'=>'Instrument',
			'foreignKey'=>'instrument_id'
		),		*/
	);
	
	public $actionStatuses = array(
		0=>'No Action Yet',
		1=>'Fetched',
		2=>'Pushed',
		3=>'Cancelled'
	);	
	
	public $resultTypes = array(
		0=>'Unknown',
		1=>'Instrument',
		2=>'Manual Entry',
	);	

	public $resultStatuses = array(
		0=>'No Result',
		1=>'Not Checked',
		2=>'Checked',
		3=>'Accepted',
		4=>'Rejected',
	);

}
