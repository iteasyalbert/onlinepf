<?php
App::uses('AppModel', 'Model');
/**
 * Laboratory Model
 *
 * @property LaboratoryAcceptedInsurance $LaboratoryAcceptedInsurance
 * @property LaboratoryAddress $LaboratoryAddress
 * @property LaboratoryContactInformation $LaboratoryContactInformation
 * @property LaboratoryCorporatePartner $LaboratoryCorporatePartner
 * @property LaboratoryOperatingHour $LaboratoryOperatingHour
 * @property Member $Member
 * @property Package $Package
 * @property PatientOrder $PatientOrder
 * @property PersonIdentity $PersonIdentity
 * @property TestGroup $TestGroup
 * @property TestSet $TestSet
 * @property Test $Test
 */
class Laboratory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $classifications = array(
		1 => 'Hospital',
		2 => 'Laboratory',
		3 => 'Clinic',
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LaboratoryAcceptedInsurance' => array(
			'className' => 'LaboratoryAcceptedInsurance',
			'foreignKey' => 'laboratory_id',
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
		'LaboratoryCorporatePartner' => array(
			'className' => 'LaboratoryCorporatePartner',
			'foreignKey' => 'laboratory_id',
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
	/*	'Package' => array(
			'className' => 'Package',
			'foreignKey' => 'laboratory_id',
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
		*/
		'LaboratoryPatientOrder' => array(
			'className' => 'LaboratoryPatientOrder',
			'foreignKey' => 'laboratory_id',
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
		'PersonIdentity' => array(
			'className' => 'PersonIdentity',
			'foreignKey' => 'laboratory_id',
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
		'LaboratoryTestGroup' => array(
			'className' => 'LaboratoryTestGroup',
			'foreignKey' => 'laboratory_id',
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
		'LaboratoryTestSet' => array(
			'className' => 'LaboratoryTestSet',
			'foreignKey' => 'laboratory_id',
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
		'LaboratoryTest' => array(
			'className' => 'LaboratoryTest',
			'foreignKey' => 'laboratory_id',
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
	
	var $belongsTo=array(
		'CompanyBranch' => array(
			'className' => 'CompanyBranch',
			'foreignKey' => 'company_branch_id',
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
	
	function beforeSave($options = array()){
		
		if(!isset($this->data['Laboratory']['id']) || strlen($this->data['Laboratory']['id']) == 0){
			
			$newId = 0;
			$lastSavedId = $this->find('first',array(
				'fields' => array('max(Laboratory.id) as last_id'),
				'recursive' => 0
			));
			if(isset($lastSavedId[0]['last_id'])){
				$newId = $lastSavedId[0]['last_id'];
				if($newId < 10000000000 )
					$newId = 0;
			}
			
			$newId += 10000000000;
			$this->data['Laboratory']['id'] = $newId;
			
			
		}
		
		return true;
	}

}
