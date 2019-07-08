<?php

class CommonComponent extends Component {
	public $component;
	public $options = array();
	public function initialize(Controller $controller) {
		
		$this->controller = $controller;
		
	}
	public function getAllTestOrders($userid=null){
		$patientorder=array();
		$this->controller->loadModel('LaboratoryPatientOrder');
		$this->controller->loadModel('LaboratoryPatientOrderPhysician');
		$this->controller->loadModel('LaboratoryTestOrder');
		$this->controller->loadModel('LaboratoryTestResult');
	
		$this->controller->loadModel('PersonIdentity');
		$identities = $this->controller->PersonIdentity->find('all',array(
				'conditions'=>array(
						'PersonIdentity.users_id'=>$userid
				),
				'recursive'=>-1
		));
		
		foreach ($identities as $key=>&$identity){
			$this->controller->loadModel('Patient');
			$px=$this->controller->Patient->find('first',array(
					'conditions'=>array(
						'Patient.person_id'=>$identity['PersonIdentity']['person_id']	
					),
					'recursive'=>-1
			));
			
			$patientid = (isset($px['Patient']['id']))?$px['Patient']['id']:'';
			//debug($patientid);
			$patientorder[]=$this->controller->LaboratoryPatientOrder->find('all',array(
					'fields'=>array('Laboratory.*','Patient.*',
						'LaboratoryPatientOrder.id',
						'LaboratoryPatientOrder.laboratory_id',
						'LaboratoryPatientOrder.company_branch_id',
						'LaboratoryPatientOrder.internal_id',
						'LaboratoryPatientOrder.patient_id',
						'LaboratoryPatientOrder.total_amount_due',
						'LaboratoryPatientOrder.entry_datetime',
						'LaboratoryPatientOrder.user_id',
						'LaboratoryPatientOrder.status',
						'LaboratoryPatientOrder.posted',
						'LaboratoryPatientOrder.patient_transaction_id',
						'LaboratoryPatientOrder.specimen_id',
						'LaboratoryPatientOrder.external_specimen_id',
						'LaboratoryPatientOrder.other_specimen_id',
						'LaboratoryPatientOrder.link_order',
						'LaboratoryPatientOrder.linked_specimen_id',
						'LaboratoryPatientOrder.admission_id',
						'LaboratoryPatientOrder.admission_date',
						'LaboratoryPatientOrder.admission_time',
						'LaboratoryPatientOrder.location_id',
						'LaboratoryPatientOrder.date_requested',
						'LaboratoryPatientOrder.time_requested',
						'LaboratoryPatientOrder.references',
						'LaboratoryPatientOrder.comments',
						'LaboratoryPatientOrder.applied_discounts',
						'LaboratoryPatientOrder.comfirm_order',
						'LaboratoryPatientOrder.confirmation_date',
						'LaboratoryPatientOrder.confirmation_time',
						'LaboratoryPatientOrder.medical_department_id',
						'LaboratoryPatientOrderPhysician.id',
						'LaboratoryPatientOrderPhysician.patient_order_id',
						'LaboratoryPatientOrderPhysician.laboratory_id',
						'LaboratoryPatientOrderPhysician.physician_id',
						'LaboratoryPatientOrderPhysician.entry_datetime',
						'LaboratoryPatientOrderPhysician.user_id',
						'LaboratoryTestOrder.id',
						'LaboratoryTestOrder.patient_order_id',
						'LaboratoryTestOrder.status',
						'LaboratoryTestOrder.release_date',
						'LaboratoryTestOrder.release_time',
						'LaboratoryTestOrder.release_level_id',
						'LaboratoryTestOrder.entry_datetime',
						'LaboratoryTestOrder.user_id',
						'LaboratoryTestOrder.posted',
						'LaboratoryTestOrder.posted_datetime',
						
						'LaboratoryTestResult.id',
						'LaboratoryTestResult.test_order_id', 
						'LaboratoryTestResult.test_group_id', 
						'LaboratoryTestResult.order_type', 
						'LaboratoryTestResult.result_status', 
						'LaboratoryTestResult.remarks', 
						'LaboratoryTestResult.order_status', 
						'LaboratoryTestResult.release_level_id', 
						'LaboratoryTestResult.release_date', 
						'LaboratoryTestResult.release_time', 
						'LaboratoryTestResult.cancel_date', 
						'LaboratoryTestResult.cancel_time', 
						'LaboratoryTestResult.cancel_comments', 
						'LaboratoryTestResult.cancelling_user_id', 
						'LaboratoryTestResult.lab_notes', 
						'LaboratoryTestResult.medtech_user_id', 
						'LaboratoryTestResult.other_medtech_user_id', 
						'LaboratoryTestResult.pathologist_user_id', 
						'LaboratoryTestResult.pdf_result', 
						'LaboratoryTestResult.pdf_filename', 
						'LaboratoryTestResult.printed', 
						'LaboratoryTestResult.entry_datetime', 
						'LaboratoryTestResult.user_id'
						),
					'conditions'=>array(
							'LaboratoryPatientOrder.patient_id'=>$patientid
// 							'LaboratoryPatientOrder.id >'=>$endid
					),
					'joins'=>array(
							array(
									'table' => 'laboratory_test_orders',
									'alias' => 'LaboratoryTestOrder',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryTestOrder.patient_order_id'
									)
							),
							array(
									'table' => 'laboratory_test_results',
									'alias' => 'LaboratoryTestResult',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryTestOrder.id = LaboratoryTestResult.test_order_id'
									)
							),
							array(
									'table' => 'laboratory_patient_order_physicians',
									'alias' => 'LaboratoryPatientOrderPhysician',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id'
									)
							),
					),
// 					'limit' => 2
// 					'order' => array('LaboratoryTestOrder.id' => 'ASC')
			));
			//debug($patientorder);
		}
		$patientordertmp = array();
		$patientordertmp = array();
		foreach($patientorder as $idx1=>$orders){
			foreach($orders as $idx2=>$order){
				$patientordertmp[$order['LaboratoryTestOrder']['id']] = $order;
			}
		}
		krsort($patientordertmp);
		return $patientordertmp;
	}
	
	public function searchLaboratoryPatient($firstname=null,$lastname=null,$labnumber=null, $luserid=null, $laboratories=null){
		//$this->log($lastname,'searchData2');
		$this->controller->loadModel('Person');
		$this->controller->loadModel('User');
		//debug($laboratories);
		$persons = array();
		foreach($laboratories as $key=>$laboratory){
				
			if(empty($labnumber)){
				$persontmp = array();
				$persontmp = $this->controller->Person->find('all',array(
						'conditions'=>array(
								'OR'=>array(
										'Person.firstname' => $firstname,
										'Person.lastname' => $lastname
								),
								'Patient.laboratory_id'=>$laboratory,
// 								'Physician.users_id'=>$puserid
						),
						'recursive'=>-1,
						'joins'=>array(
								array(
										'table' => 'patients',
										'alias' => 'Patient',
										'type'  => 'INNER',
										'conditions' => array(
												'Person.id = Patient.person_id'
										)
								),
// 								array(
// 										'table' => 'laboratory_patient_orders',
// 										'alias' => 'LaboratoryPatientOrder',
// 										'type'  => 'LEFT',
// 										'conditions' => array(
// 												'Patient.id = LaboratoryPatientOrder.patient_id',
// 												'LaboratoryPatientOrder.laboratory_id'=>$laboratory,
// 										)
// 								),
								/*array(
										'table' => 'laboratory_patient_order_physicians',
										'alias' => 'LaboratoryPatientOrderPhysician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id',
												'LaboratoryPatientOrderPhysician.laboratory_id'=>$laboratory,
										)
								),
								array(
										'table' => 'physicians',
										'alias' => 'Physician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrderPhysician.physician_id = Physician.id',
												// 											'Physician.laboratory_id'=>$laboratory,
										)
								),*/
						)
				));
				$log = $this->controller->Person->getDataSource()->getLog(false, false);
				$this->log($log,'log');
				$persons = array_merge($persons, $persontmp);
				$this->log($persons,'personsearched');
			}else{
				$persontmp = array();
				$persontmp = $this->controller->Person->find('all',array(
						'conditions'=>array(
						// 								'OR'=>array(
								// 										'Person.firstname' => $firstname,
								// 										'Person.lastname' => $lastname
								// 								),
								'LaboratoryPatientOrder.specimen_id'=>$labnumber,
								'Patient.laboratory_id'=>$laboratory,
								//'Physician.users_id'=>$puserid
						),
						'recursive'=>-1,
						'joins'=>array(
								array(
										'table' => 'patients',
										'alias' => 'Patient',
										'type'  => 'INNER',
										'conditions' => array(
												'Person.id = Patient.person_id'
										)
								),
								array(
										'table' => 'laboratory_patient_orders',
										'alias' => 'LaboratoryPatientOrder',
										'type'  => 'INNER',
										'conditions' => array(
												'Patient.id = LaboratoryPatientOrder.patient_id',
												'LaboratoryPatientOrder.laboratory_id'=>$laboratory,
												//'LaboratoryPatientOrder.specimen_id'=>$labnumber,
										)
								),
								/* array(
										'table' => 'laboratory_patient_order_physicians',
										'alias' => 'LaboratoryPatientOrderPhysician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id',
												'LaboratoryPatientOrderPhysician.laboratory_id'=>$laboratory,
										)
								),
								array(
										'table' => 'physicians',
										'alias' => 'Physician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrderPhysician.physician_id = Physician.id',
												// 											'Physician.laboratory_id'=>$laboratory,
										)
								), */
						)
				));
				$persons = array_merge($persons, $persontmp);
				$this->log($persons,'personsearched');
			}
				
				
				
		}
	
		return $persons;
	}
	
	public function searchPhysicianPatient($firstname=null,$lastname=null,$labnumber=null, $puserid=null, $laboratories=null,$all = false){
		$this->controller->loadModel('Person');
		$this->controller->loadModel('User');
		$persons = array();
		foreach($laboratories as $key=>$laboratory){
			
			if(empty($labnumber)){
				$persontmp = array();
				$conditions = array();
				if(strlen($lastname) > 1){
					$conditions = array(
							'Person.lastname LIKE' => $lastname."%"
					);
				}elseif (strlen($firstname) > 1){
					$conditions = array(
							'Person.firstname LIKE' => $firstname."%"
					);
				}elseif($all){
					
				}else{
					$conditions = array('OR'=>array(
							'Person.firstname' => $firstname,
							'Person.lastname' => $lastname
					));
				}
				$persontmp = $this->controller->Person->find('all',array(
						'fields'=>array(
							'DISTINCT Person.*'		
						),
						'order'=>'Person.lastname ASC',
						'recursive'=>-1,
						'conditions'=>array(
								$conditions,
// 								'OR'=>array(
// 										'Person.firstname' => $firstname,
// 										'Person.lastname' => $lastname
// 								),
								'Patient.laboratory_id'=>$laboratory,
								'Physician.users_id'=>$puserid
						),
						'joins'=>array(
								array(
										'table' => 'patients',
										'alias' => 'Patient',
										'type'  => 'INNER',
										'conditions' => array(
												'Person.id = Patient.person_id'
										)
								),
								array(
										'table' => 'laboratory_patient_orders',
										'alias' => 'LaboratoryPatientOrder',
										'type'  => 'INNER',
										'conditions' => array(
												'Patient.id = LaboratoryPatientOrder.patient_id',
												'LaboratoryPatientOrder.laboratory_id'=>$laboratory,
										)
								),
								array(
										'table' => 'laboratory_patient_order_physicians',
										'alias' => 'LaboratoryPatientOrderPhysician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id',
												'LaboratoryPatientOrderPhysician.laboratory_id'=>$laboratory,
										)
								),
								array(
										'table' => 'physicians',
										'alias' => 'Physician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrderPhysician.physician_id = Physician.id',
	// 											'Physician.laboratory_id'=>$laboratory,
										)
								),
						)
				));
				$persons = array_merge($persons, $persontmp);
			}else{
				$persontmp = array();
				$persontmp = $this->controller->Person->find('all',array(
						'conditions'=>array(
// 								'OR'=>array(
// 										'Person.firstname' => $firstname,
// 										'Person.lastname' => $lastname
// 								),
								'LaboratoryPatientOrder.specimen_id'=>$labnumber,
								'Patient.laboratory_id'=>$laboratory,
								'Physician.users_id'=>$puserid
						),
						'order'=>'Person.lastname ASC',
						'joins'=>array(
								array(
										'table' => 'patients',
										'alias' => 'Patient',
										'type'  => 'INNER',
										'conditions' => array(
												'Person.id = Patient.person_id'
										)
								),
								array(
										'table' => 'laboratory_patient_orders',
										'alias' => 'LaboratoryPatientOrder',
										'type'  => 'INNER',
										'conditions' => array(
												'Patient.id = LaboratoryPatientOrder.patient_id',
												'LaboratoryPatientOrder.laboratory_id'=>$laboratory,
												//'LaboratoryPatientOrder.specimen_id'=>$labnumber,
										)
								),
								array(
										'table' => 'laboratory_patient_order_physicians',
										'alias' => 'LaboratoryPatientOrderPhysician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id',
												'LaboratoryPatientOrderPhysician.laboratory_id'=>$laboratory,
										)
								),
								array(
										'table' => 'physicians',
										'alias' => 'Physician',
										'type'  => 'INNER',
										'conditions' => array(
												'LaboratoryPatientOrderPhysician.physician_id = Physician.id',
												// 											'Physician.laboratory_id'=>$laboratory,
										)
								),
						)
				));
				$persons = array_merge($persons, $persontmp);
				//$this->log($persons,'personsearched');
			}
			
			
			
		}
		
		return $persons;
	}
	
	public function getAllTestOrderPhysician($userid=null,$puserid=null){

		$patientorder=array();
		$this->controller->loadModel('LaboratoryPatientOrder');
		$this->controller->loadModel('LaboratoryPatientOrderPhysician');
		$this->controller->loadModel('LaboratoryTestOrder');
		$this->controller->loadModel('LaboratoryTestResult');
		
		$this->controller->loadModel('PersonIdentity');
		$identities = $this->controller->PersonIdentity->find('all',array(
				'conditions'=>array(
						'PersonIdentity.users_id'=>$userid
				),
				'recursive'=>-1
		));
		
		$this->controller->loadModel('Physician');
		$physicians = $this->controller->Physician->find('list',array(
				'conditions' => array(
						'Physician.users_id' => $puserid
				),
				'recursive'=>-1
		));
		$physicianids=array();
		foreach ($physicians as $physician){
			$physicianids[]=$physician;
		}
		
		foreach ($identities as $key=>&$identity){
			$this->controller->loadModel('Patient');
			$px=$this->controller->Patient->find('first',array(
					'conditions'=>array(
							'Patient.person_id'=>$identity['PersonIdentity']['person_id']
					),
					'recursive'=>-1
			));
			
			$patientorder[]=$this->controller->LaboratoryPatientOrder->find('all',array(
					'fields'=>array('Laboratory.*','Patient.*',
					
						'LaboratoryPatientOrder.id',
						'LaboratoryPatientOrder.laboratory_id',
						'LaboratoryPatientOrder.company_branch_id',
						'LaboratoryPatientOrder.internal_id',
						'LaboratoryPatientOrder.patient_id',
						'LaboratoryPatientOrder.total_amount_due',
						'LaboratoryPatientOrder.entry_datetime',
						'LaboratoryPatientOrder.user_id',
						'LaboratoryPatientOrder.status',
						'LaboratoryPatientOrder.posted',
						'LaboratoryPatientOrder.patient_transaction_id',
						'LaboratoryPatientOrder.specimen_id',
						'LaboratoryPatientOrder.external_specimen_id',
						'LaboratoryPatientOrder.other_specimen_id',
						'LaboratoryPatientOrder.link_order',
						'LaboratoryPatientOrder.linked_specimen_id',
						'LaboratoryPatientOrder.admission_id',
						'LaboratoryPatientOrder.admission_date',
						'LaboratoryPatientOrder.admission_time',
						'LaboratoryPatientOrder.location_id',
						'LaboratoryPatientOrder.date_requested',
						'LaboratoryPatientOrder.time_requested',
						'LaboratoryPatientOrder.references',
						'LaboratoryPatientOrder.comments',
						'LaboratoryPatientOrder.applied_discounts',
						'LaboratoryPatientOrder.comfirm_order',
						'LaboratoryPatientOrder.confirmation_date',
						'LaboratoryPatientOrder.confirmation_time',
						'LaboratoryPatientOrder.medical_department_id',
						'LaboratoryPatientOrderPhysician.id',
						'LaboratoryPatientOrderPhysician.patient_order_id',
						'LaboratoryPatientOrderPhysician.laboratory_id',
						'LaboratoryPatientOrderPhysician.physician_id',
						'LaboratoryPatientOrderPhysician.entry_datetime',
						'LaboratoryPatientOrderPhysician.user_id',
						'LaboratoryTestOrder.id',
						'LaboratoryTestOrder.patient_order_id',
						'LaboratoryTestOrder.status',
						'LaboratoryTestOrder.release_date',
						'LaboratoryTestOrder.release_time',
						'LaboratoryTestOrder.release_level_id',
						'LaboratoryTestOrder.entry_datetime',
						'LaboratoryTestOrder.user_id',
						'LaboratoryTestOrder.posted',
						'LaboratoryTestOrder.posted_datetime',
						
						'LaboratoryTestResult.id',
						'LaboratoryTestResult.test_order_id', 
						'LaboratoryTestResult.test_group_id', 
						'LaboratoryTestResult.order_type', 
						'LaboratoryTestResult.result_status', 
						'LaboratoryTestResult.remarks', 
						'LaboratoryTestResult.order_status', 
						'LaboratoryTestResult.release_level_id', 
						'LaboratoryTestResult.release_date', 
						'LaboratoryTestResult.release_time', 
						'LaboratoryTestResult.cancel_date', 
						'LaboratoryTestResult.cancel_time', 
						'LaboratoryTestResult.cancel_comments', 
						'LaboratoryTestResult.cancelling_user_id', 
						'LaboratoryTestResult.lab_notes', 
						'LaboratoryTestResult.medtech_user_id', 
						'LaboratoryTestResult.other_medtech_user_id', 
						'LaboratoryTestResult.pathologist_user_id', 
						'LaboratoryTestResult.pdf_result', 
						'LaboratoryTestResult.pdf_filename', 
						'LaboratoryTestResult.printed', 
						'LaboratoryTestResult.entry_datetime', 
						'LaboratoryTestResult.user_id'
					),
					'order'=>array('LaboratoryTestResult.release_date DESC', 'LaboratoryTestResult.release_time DESC'),//this
					'conditions'=>array(
							'LaboratoryPatientOrder.patient_id'=>$px['Patient']['id'],
							'LaboratoryPatientOrderPhysician.physician_id'=>$physicianids
					),
					'joins'=>array(
							array(
									'table' => 'laboratory_test_orders',
									'alias' => 'LaboratoryTestOrder',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryTestOrder.patient_order_id'
									)
							),
							array(
									'table' => 'laboratory_test_results',
									'alias' => 'LaboratoryTestResult',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryTestOrder.id = LaboratoryTestResult.test_order_id'
									)
							),
							array(
									'table' => 'laboratory_patient_order_physicians',
									'alias' => 'LaboratoryPatientOrderPhysician',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id'
									)
							),
					),
					 			//		'order' => array('LaboratoryTestOrder.release_date??' => 'ASC')//lgay mu nga master anong column ska 
			));
			
		}
		$patientordertmp = array();
		foreach($patientorder as $idx1=>$orders){
			foreach($orders as $idx2=>$order){
				$patientordertmp[] = $order;
			}
		}
		
		//sort($patientordertmp);
		
		//$this->log($patientordertmp,'nol');
		return $patientordertmp;
		
	}
	
	public function getAllTestOrderLaboratory($userid=null,$luserid=null){
	
		$patientorder=array();
		$this->controller->loadModel('LaboratoryPatientOrder');
		$this->controller->loadModel('LaboratoryPatientOrderPhysician');
		$this->controller->loadModel('LaboratoryTestOrder');
		$this->controller->loadModel('LaboratoryTestResult');
	    //get patient identity
		$this->controller->loadModel('PersonIdentity');
		$identities = $this->controller->PersonIdentity->find('all',array(
				'conditions'=>array(
						'PersonIdentity.users_id'=>$userid
				),
				'recursive'=>-1
		));
		//get laboratory id
		$labIdentity = $this->controller->PersonIdentity->find('first',array(
				'conditions' => array(
						'PersonIdentity.users_id' => $luserid,
				),
				'recursive'=>-1,
				'order'=>array('PersonIdentity.entry_datetime')
		));
// 		$physicianids=array();
// 		foreach ($physicians as $physician){
// 			$physicianids[]=$physician;
// 		}
	
		foreach ($identities as $key=>&$identity){
			$this->controller->loadModel('Patient');
			$px=$this->controller->Patient->find('first',array(
					'conditions'=>array(
							'Patient.person_id'=>$identity['PersonIdentity']['person_id']
					),
					'recursive'=>-1
			));
			$patientorder[]=$this->controller->LaboratoryPatientOrder->find('all',array(
					'fields'=>array('Laboratory.*','Patient.*','LaboratoryPatientOrder.*','LaboratoryPatientOrderPhysician.*','LaboratoryTestOrder.*','LaboratoryTestResult.*'),
					'conditions'=>array(
							'LaboratoryPatientOrder.patient_id'=>$px['Patient']['id'],
							'LaboratoryPatientOrder.laboratory_id'=>$labIdentity['PersonIdentity']['laboratory_id']
					),
					'joins'=>array(
							array(
									'table' => 'laboratory_test_orders',
									'alias' => 'LaboratoryTestOrder',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryTestOrder.patient_order_id'
									)
							),
							array(
									'table' => 'laboratory_test_results',
									'alias' => 'LaboratoryTestResult',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryTestOrder.id = LaboratoryTestResult.test_order_id'
									)
							),
							array(
									'table' => 'laboratory_patient_order_physicians',
									'alias' => 'LaboratoryPatientOrderPhysician',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id'
									)
							),
					),
					// 					'order' => array('LaboratoryTestOrder.id' => 'ASC')
			));
		}
		$patientordertmp = array();
		$patientordertmp = array();
		foreach($patientorder as $idx1=>$orders){
			foreach($orders as $idx2=>$order){
				$patientordertmp[$order['LaboratoryTestOrder']['id']] = $order;
			}
		}
		krsort($patientordertmp);
		return $patientordertmp;
	
	}
	
	public function getAllTestOrderCorporate($userid=null,$cuserid=null){
	
		$patientorder=array();
		$this->controller->loadModel('LaboratoryPatientOrder');
		$this->controller->loadModel('LaboratoryPatientOrderPhysician');
		$this->controller->loadModel('LaboratoryTestOrder');
		$this->controller->loadModel('LaboratoryTestResult');
		//get patient identity
		$this->controller->loadModel('PersonIdentity');
		$identities = $this->controller->PersonIdentity->find('all',array(
				'conditions'=>array(
						'PersonIdentity.users_id'=>$userid
				),
				'recursive'=>-1
		));
		//get laboratory id
		$labIdentity = $this->controller->PersonIdentity->find('first',array(
				'conditions' => array(
						'PersonIdentity.users_id' => $cuserid,
				),
				'recursive'=>-1,
				'order'=>array('PersonIdentity.entry_datetime')
		));
		// 		$physicianids=array();
		// 		foreach ($physicians as $physician){
		// 			$physicianids[]=$physician;
		// 		}
	
		foreach ($identities as $key=>&$identity){
			$this->controller->loadModel('Patient');
			$px=$this->controller->Patient->find('first',array(
					'conditions'=>array(
							'Patient.person_id'=>$identity['PersonIdentity']['person_id']
					),
					'recursive'=>-1
			));
			$patientorder[]=$this->controller->LaboratoryPatientOrder->find('all',array(
					'fields'=>array('Laboratory.*','Patient.*','LaboratoryPatientOrder.*','LaboratoryPatientOrderPhysician.*','LaboratoryTestOrder.*','LaboratoryTestResult.*'),
					'conditions'=>array(
							'LaboratoryPatientOrder.patient_id'=>$px['Patient']['id'],
							'LaboratoryPatientOrder.laboratory_id'=>$labIdentity['PersonIdentity']['laboratory_id']
					),
					'joins'=>array(
							array(
									'table' => 'laboratory_test_orders',
									'alias' => 'LaboratoryTestOrder',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryTestOrder.patient_order_id'
									)
							),
							array(
									'table' => 'laboratory_test_results',
									'alias' => 'LaboratoryTestResult',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryTestOrder.id = LaboratoryTestResult.test_order_id'
									)
							),
							array(
									'table' => 'laboratory_patient_order_physicians',
									'alias' => 'LaboratoryPatientOrderPhysician',
									'type'  => 'LEFT',
									'conditions' => array(
											'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id'
									)
							),
					),
					// 					'order' => array('LaboratoryTestOrder.id' => 'ASC')
			));
		}
		$patientordertmp = array();
		$patientordertmp = array();
		foreach($patientorder as $idx1=>$orders){
			foreach($orders as $idx2=>$order){
				$patientordertmp[$order['LaboratoryTestOrder']['id']] = $order;
			}
		}
		krsort($patientordertmp);
		return $patientordertmp;
	
	}
	
	public function getTestOrderResults($personid=null){
		$patientorder=array();
		$this->controller->loadModel('LaboratoryPatientOrder');
		$this->controller->loadModel('LaboratoryTestOrder');
		$this->controller->loadModel('LaboratoryTestResult');
		
		$this->controller->loadModel('Patient');
		
		$patient =$this->controller->Patient->find('all',array(
				'conditions'=>array(
					'Patient.person_id'=>$personid			
				),
				'recursive'=>-1
		));
// 		debug($patient);
		foreach ($patient as $key=>&$px){
			$patientorder[]=$this->controller->LaboratoryPatientOrder->find('all',array(
				'fields'=>array('Laboratory.*','Patient.*','LaboratoryPatientOrder.*','LaboratoryTestOrder.*','LaboratoryTestResult.*'),
				'conditions'=>array('LaboratoryPatientOrder.patient_id'=>$px['Patient']['id']),
				'joins'=>array(
						array(
								'table' => 'laboratory_test_orders',
								'alias' => 'LaboratoryTestOrder',
								'type'  => 'LEFT',
								'conditions' => array(
										'LaboratoryPatientOrder.id = LaboratoryTestOrder.patient_order_id'
								)
						),
						array(
								'table' => 'laboratory_test_results',
								'alias' => 'LaboratoryTestResult',
								'type'  => 'LEFT',
								'conditions' => array(
										'LaboratoryTestOrder.id = LaboratoryTestResult.test_order_id'
								)
						)
				)
			));
		}
		return $patientorder;
	}
	
	public function getPosts($types = array(),$limit=null, $options = array(),$models = array()){
		
		$joinedModels = array('User');
		$this->options = array();
		if(!is_null($models) && !empty($models))
			$joinedModels = array_merge($joinedModels,$models);
			
			
		$this->options['conditions']['Post.type'] = $types;
		$this->options['conditions']['Post.status'] = 1;
		if($types['0'] == 7){
			$this->options['order']= 'Post.title ASC';
		}else{
			$this->options['order']= 'Post.entry_datetime DESC';
		}
		$this->options['fields']= array('Post.*','User.id','User.username');
		
		if(!is_null($limit))
			$this->options['limit'] = $limit;
		$conditions = $this->options;
		if(!empty($options))
			$conditions = array_merge_recursive($this->options,$options);
		
		$this->controller->loadModel('Post');
		
		//$this->controller->Post->unbindAllModel($joinedModels,false);
		$posts = $this->controller->Post->find('all',$conditions);
		
		return $posts;
		
	}
	
	public function getPostDetails($postids = array(),$models = array(),$options = array()){
		
		$this->controller->loadModel('PostContent');
		//$this->controller->PostContent->unbindAllModel($models,false);
		
		$postDetailOptions = array(
			'conditions' => array(
				'PostContent.post_id' => $postids,
				'PostContent.status' => 1
			)
		);
		
		if(!empty($options) && is_array($options))
			$postDetailOptions = array_merge_recursive($postDetailOptions,$options);

		$postDetails = $this->controller->PostContent->find('all',$postDetailOptions);
		
		$postDetails = Set::combine($postDetails,'{n}.PostContent.id','{n}','{n}.PostContent.post_id');
		
		return $postDetails;
		
	}
	
	public function getUserInfo($userids = array(),$fields = array(),$options=array()){
		$userfields = array('Person.id','Person.title_id', 'User.role','PersonIdentity.person_id','PersonIdentity.users_id','PersonIdentity.posted');
		$fields = array_merge($userfields,$fields);
		$this->controller->loadModel('PersonIdentity');
		$this->controller->loadModel('User');
		//$this->controller->PersonIdentity->unbindAllModel(array('Person',false , 'User'));
		$this->options = array();
		$hmo = false;
		$address = false;
		$contacts = false;
		$image = false;
		$organizations = false;
		$this->options = array();
	
		if(in_array('HMO',$fields)){
			$hmo = true;
			$fields = array_diff($fields, array('HMO'));
		}
		if(in_array('Address',$fields)){
			$address = true;
			$fields = array_diff($fields, array('Address'));
		}
		if(in_array('Contacts',$fields)){
			$contacts = true;
			$fields = array_diff($fields, array('Contacts'));
		}
		if(in_array('Organizations',$fields)){
			$organizations = true;
			$fields = array_diff($fields, array('Organizations'));
		}
		
		if(in_array('Image',$fields)){
			$image = true;
			$fields = array_diff($fields, array('Image'));
		}
		
		if(!empty($userids))
			$this->options = array('conditions' => array('PersonIdentity.users_id' => $userids,'PersonIdentity.posted'=>false));
		$this->options['fields'] = $fields;
		
		if(!empty($options))
			$this->options = array_merge_recursive($this->options,$options);
			
		$users = $this->controller->PersonIdentity->find('all',$this->options);
		
		$this->controller->loadModel('TitleCode');
		$titles = $this->controller->TitleCode->find('list',array(
			'conditions' => array(
				'TitleCode.validated' => true
			),
			'fields' => array(
				'TitleCode.id','TitleCode.display'
			)
		));
		
		if($hmo || $address || $image){
			$personUserIds = Set::combine($users,'{n}.Person.id','{n}.PersonIdentity.users_id');
		}
		
		$rawUsers= $users;
		$users = array();

		foreach($rawUsers as $user){
			if(!isset($users[$user['PersonIdentity']['users_id']])){
				$users[$user['PersonIdentity']['users_id']] = array(
					'LaboratoryProfile' => array()
				);
			}
			if($user['PersonIdentity']['posted']){
				$users[$user['PersonIdentity']['users_id']] = array_merge($users[$user['PersonIdentity']['users_id']],$user['Person'],$user['User']);
			}else{
				$users[$user['PersonIdentity']['users_id']]['LaboratoryProfile'][] = $user['Person'];
			}
		}
		
//		$users = Set::merge(/
//			Set::combine($users,'{n}.PersonIdentity.users_id'/*'{n}.Person.id'*/,'{n}.Person'),
//			Set::combine($users,'{n}.PersonIdentity.users_id'/*'{n}.Person.id'*/,'{n}.User')
//			);
		
		if(!empty($titles)){
			foreach($users as &$user){
				if(isset($user['title_id']) && isset($titles[$user['title_id']])){
					$user['titlecode'] = $titles[$user['title_id']];
				}
			}
		}
		if($image){
			
			$this->controller->loadModel('PersonImage');
			//$this->controller->PersonImage->unbindAllModel(array('Image'));
			
			$personImages = $this->controller->PersonImage->find('all',array(
				'fields' => array( 'Image.image','Image.id','PersonImage.person_id','PersonImage.id'),
				'conditions' => array(
					'PersonImage.person_id' => array_keys($personUserIds),
					'PersonImage.status' => true
				),
				'group' => array('PersonImage.person_id')
			));
			
			foreach($personImages as $image){
				$users[$personUserIds[$image['PersonImage']['person_id']]]['image'] = $image['Image']['image'];
				$users[$personUserIds[$image['PersonImage']['person_id']]]['image_id'] = $image['Image']['id'];
				$users[$personUserIds[$image['PersonImage']['person_id']]]['person_image_id'] = $image['PersonImage']['id'];
			}
		}
		if($hmo){
			$this->controller->loadModel('PersonInsurance');
			
			$personIns = $this->controller->PersonInsurance->find('all',array(
				'conditions' => array(
					'PersonInsurance.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonInsurance.id',
					'PersonInsurance.insurance_provider_product_id',
					'PersonInsurance.person_id','PersonInsurance.expiration_date','PersonInsurance.effectivity_date'
//					,'PersonInsurance.accreditation'
				)
			));
			$personIns = Set::combine($personIns,'{n}.PersonInsurance.id','{n}.PersonInsurance');
			
			$this->controller->loadModel('InsuranceProviderProduct');
			$this->controller->InsuranceProviderProduct->unbindAllModel();//array('InsuranceProvider'));
			$insProds = $this->controller->InsuranceProviderProduct->find('all',array(
				'fields' => array(
					'CompanyBranch.name',
					'InsuranceProviderProduct.*',
					'InsuranceProviderProduct.name',
					'InsuranceProvider.id'
				),
				'conditions'=> array(
					'InsuranceProviderProduct.id' => Set::extract($personIns,'{n}.insurance_provider_product_id')
				),
				'joins' => array(
					array(
						'table' => 'person_insurance',
						'alias' => 'PersonInsurance',
						'type' => 'LEFT',
						'conditions' => array(
							'PersonInsurance.insurance_provider_product_id' => 'InsuranceProviderProduct.id',
						)
					),
					array(
						'table' => 'insurance_providers',
						'alias' => 'InsuranceProvider',
						'type' => 'LEFT',
						'conditions' => array(
							'InsuranceProvider.id = InsuranceProviderProduct.insurance_provider_id',
						)
					),
					array(
						'table' => 'company_branches',
						'alias' => 'CompanyBranch',
						'type' => 'LEFT',
						'conditions' => array(
							'CompanyBranch.id = InsuranceProvider.company_branch_id',
						)
					)
				)
			));
			
			$insProds = Set::combine($insProds,'{n}.InsuranceProviderProduct.id','{n}');
			
			foreach($personIns as $ins){
				$insurances = $insProds[$ins['insurance_provider_product_id']];
				$insurances['PersonInsurance'] = $ins;
				$users[$personUserIds[$ins['person_id']]]['HMO'][] = $insurances;
			}
		}
		
		if($address){
			
			$this->controller->loadModel('PersonAddress');
			
			$addressIds = $this->controller->PersonAddress->find('all',array(
				'conditions' => array(
					'PersonAddress.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonAddress.address_id','PersonAddress.person_id','PersonAddress.id'
				)
			));
			
			$addressIds = Set::combine($addressIds,array('{0}_{1}','{n}.PersonAddress.person_id','{n}.PersonAddress.address_id'),'{n}.PersonAddress');
			
			$this->controller->loadModel('Address');
			//$this->controller->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'));
			$addresses = $this->controller->Address->find('all',array(
				'fields' => array(
					'Address.id',
					'Address.floor',
					'Address.unit',
					'Address.lot',
					'Address.block',
					'Address.building_apartment',
					'Address.street_number',
					'VillageCode.id',
					'ProvincesStatesCode.id',
					'CountryCode.id',
					'VillageCode.name',
					'TownCityCode.name',
					'TownCityCode.id',
					'ProvincesStatesCode.name',
					'CountryCode.name',
				),
				'conditions'=> array(
					'Address.id' => Set::extract($addressIds,'{s}.address_id')
				)
			));
			$addresses = Set::combine($addresses,'{n}.Address.id','{n}');
			
			foreach($addressIds as $address){
				$users[$personUserIds[$address['person_id']]]['CompleteAddress'] = $addresses[$address['address_id']];
				$users[$personUserIds[$address['person_id']]]['CompleteAddress']['Address']['person_address_id'] = $address['id'];
			}
		}
		
		if($contacts){
			
			$this->controller->loadModel('PersonContactInformation');
			
			$contactIds = $this->controller->PersonContactInformation->find('all',array(
				'conditions' => array(
					'PersonContactInformation.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonContactInformation.contact_id','PersonContactInformation.person_id','PersonContactInformation.id'
				)
			));
//			debug($contactIds);
			$contactIds = Set::combine($contactIds,array('{0}_{1}','{n}.PersonContactInformation.person_id','{n}.PersonContactInformation.contact_id'),'{n}.PersonContactInformation');
			
			$this->controller->loadModel('ContactInformation');
			$this->controller->ContactInformation->unbindAllModel();
			$contactInfos = $this->controller->ContactInformation->find('all',array(
				'fields' => array(
					'ContactInformation.id',
					'ContactInformation.type',
					'ContactInformation.contact',
				),
				'conditions'=> array(
					'ContactInformation.id' => Set::extract($contactIds,'{s}.contact_id')
				)
			));
			
			$contactTypes = $this->controller->ContactInformation->types;
			$contactInfos = Set::combine($contactInfos,'{n}.ContactInformation.id','{n}.ContactInformation');
			
			foreach($contactIds as $contacts){
				$contactInfos[$contacts['contact_id']]['type'] = $contactInfos[$contacts['contact_id']]['type'];
				$contactInfos[$contacts['contact_id']]['typename'] = $contactTypes[$contactInfos[$contacts['contact_id']]['type']];
				$contactInfos[$contacts['contact_id']]['person_contact_id'] = $contacts['id'];
				$users[$personUserIds[$contacts['person_id']]]['Contacts'][] = $contactInfos[$contacts['contact_id']];
			}
			
		}
		
		if($organizations){
		
			$this->controller->loadModel('PersonOrganizationsAffiliation');
			//$this->controller->PersonOrganizationsAffiliation->unbindAllModel();
			$personOrgAffs = $this->controller->PersonOrganizationsAffiliation->find('all',array(
				'conditions' => array(
					'PersonOrganizationsAffiliation.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonOrganizationsAffiliation.organization_id',
					'PersonOrganizationsAffiliation.person_id',
					'PersonOrganizationsAffiliation.date_member',
					'PersonOrganizationsAffiliation.id'
				)
			));
			
			$this->controller->loadModel('OrganizationsAffiliation');
			$organizations = $this->controller->OrganizationsAffiliation->find('all',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'id' => Set::extract($personOrgAffs,'{n}.PersonOrganizationsAffiliation.organization_id'),
				)
			));
			
			$organizations = Set::combine($organizations,'{n}.OrganizationsAffiliation.id','{n}');
			foreach($personOrgAffs as $personOrgAff){
				$users[$personUserIds[$personOrgAff['PersonOrganizationsAffiliation']['person_id']]]['Organizations'][] = array_merge($personOrgAff,$organizations[$personOrgAff['PersonOrganizationsAffiliation']['organization_id']]);
			}
		}
		return $users;
	}
	
	public function getUserDetails($userids = array(),$fields = array(),$options=array()){
	
		$userfields = array('Person.id','Person.title_id', 'User.role','PersonIdentity.person_id','PersonIdentity.users_id','PersonIdentity.posted');
		$fields = array_merge($userfields,$fields);
		$this->controller->loadModel('PersonIdentity');
		$this->controller->loadModel('User');
		//$this->controller->PersonIdentity->unbindAllModel(array('Person',false , 'User'));
		$this->options = array();
		$hmo = false;
		$address = false;
		$contacts = false;
		$image = false;
		$organizations = false;
		$this->options = array();
	
		if(in_array('HMO',$fields)){
			$hmo = true;
			$fields = array_diff($fields, array('HMO'));
		}
		if(in_array('Address',$fields)){
			$address = true;
			$fields = array_diff($fields, array('Address'));
		}
		if(in_array('Contacts',$fields)){
			$contacts = true;
			$fields = array_diff($fields, array('Contacts'));
		}
		if(in_array('Organizations',$fields)){
			$organizations = true;
			$fields = array_diff($fields, array('Organizations'));
		}
		
		if(in_array('Image',$fields)){
			$image = true;
			$fields = array_diff($fields, array('Image'));
		}
		
		if(!empty($userids))
			$this->options = array('conditions' => array('PersonIdentity.users_id' => $userids));
		$this->options['fields'] = $fields;
		
		if(!empty($options))
			$this->options = array_merge_recursive($this->options,$options);
			
		$users = $this->controller->PersonIdentity->find('all',$this->options);

		$this->controller->loadModel('TitleCode');
		$titles = $this->controller->TitleCode->find('list',array(
			'conditions' => array(
				'TitleCode.validated' => true
			),
			'fields' => array(
				'TitleCode.id','TitleCode.display'
			)
		));
		
		if($hmo || $address || $image){
			$personUserIds = Set::combine($users,'{n}.Person.id','{n}.PersonIdentity.users_id');
		}

		$rawUsers= $users;
		
		$users = array();

		foreach($rawUsers as $user){
			if(!isset($users[$user['PersonIdentity']['users_id']])){
				$users[$user['PersonIdentity']['users_id']] = array(
					'LaboratoryProfile' => array()
				);
			}
			
			if($user['PersonIdentity']['posted']){
				$users[$user['PersonIdentity']['users_id']] = array_merge($users[$user['PersonIdentity']['users_id']],$user['Person'],$user['User']);
				
			}else{
//
				
				$users[$user['PersonIdentity']['users_id']] = $user['Person'];
				$users[$user['PersonIdentity']['users_id']]['LaboratoryProfile'][] = $user['Person'];
				$users[$user['PersonIdentity']['users_id']] = array_merge($users[$user['PersonIdentity']['users_id']],$user['Person'],$user['User']);
//				$users[$user['PersonIdentity']['users_id']]['role'] = $user['User']['role'];
				
			}
		}

		
		if(!empty($titles)){
			foreach($users as &$user){
				if(isset($user['title_id']) && isset($titles[$user['title_id']])){
					$user['titlecode'] = $titles[$user['title_id']];
				}
			}
		}
		if($image){
			
			$this->controller->loadModel('PersonImage');
			//$this->controller->PersonImage->unbindAllModel(array('Image'));
			
			$personImages = $this->controller->PersonImage->find('all',array(
				'fields' => array( 'PersonImage.person_id','PersonImage.id'),
				'conditions' => array(
					'PersonImage.person_id' => array_keys($personUserIds),
					'PersonImage.status' => true
				),
				'group' => array('PersonImage.person_id','PersonImage.id'),
				'recursive' => -1
			));
			$pimageids = array();
			foreach($personImages as $image){
				$pimageids[] = $image['PersonImage']['image_id'];
			}
			$pimages = $this->controller->PersonImage->Image->find('list',array(
				'fields' => array( 'Image.id','Image.image'),
				'conditions' => array(
					'Image.id' => $pimageids
				),
				'recursive' => -1
			));
			foreach($personImages as &$image){
			
				if(isset($pimages[$image['PersonImage']['image_id']])){
					$image['Image'] = array(
						'id' => $image['PersonImage']['image_id'],
						'image' => $pimages[$image['PersonImage']['image_id']]
					);
				}
				$users[$personUserIds[$image['PersonImage']['person_id']]]['image'] = $image['Image']['image'];
				$users[$personUserIds[$image['PersonImage']['person_id']]]['image_id'] = $image['Image']['id'];
				$users[$personUserIds[$image['PersonImage']['person_id']]]['person_image_id'] = $image['PersonImage']['id'];
			}
		}
		if($hmo){
			$this->controller->loadModel('PersonInsurance');
			
			$personIns = $this->controller->PersonInsurance->find('all',array(
				'conditions' => array(
					'PersonInsurance.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonInsurance.id',
					'PersonInsurance.insurance_provider_product_id',
					'PersonInsurance.person_id','PersonInsurance.expiration_date','PersonInsurance.effectivity_date'
					,'PersonInsurance.insurance_number'
				)
			));
			$personIns = Set::combine($personIns,'{n}.PersonInsurance.id','{n}.PersonInsurance');
			
			$this->controller->loadModel('InsuranceProviderProduct');
			$this->controller->InsuranceProviderProduct->unbindAllModel();//array('InsuranceProvider'));
			$insProds  =array();
			
			$insProds = $this->controller->InsuranceProviderProduct->find('all',array(
				'fields' => array(
					'CompanyBranch.name',
				//	'InsuranceProviderProduct.*',
					'InsuranceProviderProduct.name',
					'InsuranceProviderProduct.insurance_provider_id',
					'InsuranceProviderProduct.id',
					'InsuranceProviderProduct.text',
					'InsuranceProviderProduct.description',
					'InsuranceProviderProduct.detail',
					'InsuranceProviderProduct.posted',
					'InsuranceProviderProduct.validated',
					'InsuranceProvider.id'
				),
				'conditions'=> array(
					'InsuranceProviderProduct.id' => Set::extract($personIns,'{n}.insurance_provider_product_id')
				),
				'joins' => array(
					array(
						'table' => 'person_insurance',
						'alias' => 'PersonInsurance',
						'type' => 'LEFT',
						'conditions' => array(
							'PersonInsurance.insurance_provider_product_id' => 'InsuranceProviderProduct.id',
						)
					),
					array(
						'table' => 'insurance_providers',
						'alias' => 'InsuranceProvider',
						'type' => 'LEFT',
						'conditions' => array(
							'InsuranceProvider.id = InsuranceProviderProduct.insurance_provider_id',
						)
					),
					array(
						'table' => 'company_branches',
						'alias' => 'CompanyBranch',
						'type' => 'LEFT',
						'conditions' => array(
							'CompanyBranch.id = InsuranceProvider.company_branch_id',
						)
					)
				)
			));
			
			$insProds = Set::combine($insProds,'{n}.InsuranceProviderProduct.id','{n}');
			
			foreach($personIns as $ins){
				$insurances = $insProds[$ins['insurance_provider_product_id']];
				$insurances['PersonInsurance'] = $ins;
				$users[$personUserIds[$ins['person_id']]]['HMO'][] = $insurances;
			}
		}
		
		if($address){
			
			$this->controller->loadModel('PersonAddress');
			
			$addressIds = $this->controller->PersonAddress->find('all',array(
				'conditions' => array(
					'PersonAddress.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonAddress.address_id','PersonAddress.person_id','PersonAddress.id'
				)
			));
			
			$addressIds = Set::combine($addressIds,array('{0}_{1}','{n}.PersonAddress.person_id','{n}.PersonAddress.address_id'),'{n}.PersonAddress');
			
			$this->controller->loadModel('Address');
			//$this->controller->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'));
			$addresses = $this->controller->Address->find('all',array(
				'fields' => array(
					'Address.id',
					'Address.floor',
					'Address.unit',
					'Address.lot',
					'Address.block',
					'Address.building_apartment',
					'Address.street_number',
					'VillageCode.id',
					'ProvincesStatesCode.id',
					'CountryCode.id',
					'VillageCode.name',
					'TownCityCode.name',
					'TownCityCode.id',
					'ProvincesStatesCode.name',
					'CountryCode.name',
				),
				'conditions'=> array(
					'Address.id' => Set::extract($addressIds,'{s}.address_id')
				)
			));
			$addresses = Set::combine($addresses,'{n}.Address.id','{n}');
			
			foreach($addressIds as $address){
				$users[$personUserIds[$address['person_id']]]['CompleteAddress'] = $addresses[$address['address_id']];
				$users[$personUserIds[$address['person_id']]]['CompleteAddress']['Address']['person_address_id'] = $address['id'];
			}
		}
		
		if($contacts){
			
			$this->controller->loadModel('PersonContactInformation');
			
			$contactIds = $this->controller->PersonContactInformation->find('all',array(
				'conditions' => array(
					'PersonContactInformation.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonContactInformation.contact_id','PersonContactInformation.person_id','PersonContactInformation.id'
				)
			));
//			debug($contactIds);
			$contactIds = Set::combine($contactIds,array('{0}_{1}','{n}.PersonContactInformation.person_id','{n}.PersonContactInformation.contact_id'),'{n}.PersonContactInformation');
			
			$this->controller->loadModel('ContactInformation');
			$this->controller->ContactInformation->unbindAllModel();
			$contactInfos = $this->controller->ContactInformation->find('all',array(
				'fields' => array(
					'ContactInformation.id',
					'ContactInformation.type',
					'ContactInformation.contact',
				),
				'conditions'=> array(
					'ContactInformation.id' => Set::extract($contactIds,'{s}.contact_id')
				)
			));
			
			$contactTypes = $this->controller->ContactInformation->types;
			$contactInfos = Set::combine($contactInfos,'{n}.ContactInformation.id','{n}.ContactInformation');
			
			foreach($contactIds as $contacts){
				$contactInfos[$contacts['contact_id']]['type'] = $contactInfos[$contacts['contact_id']]['type'];
				$contactInfos[$contacts['contact_id']]['typename'] = $contactTypes[$contactInfos[$contacts['contact_id']]['type']];
				$contactInfos[$contacts['contact_id']]['person_contact_id'] = $contacts['id'];
				$users[$personUserIds[$contacts['person_id']]]['Contacts'][] = $contactInfos[$contacts['contact_id']];
			}
			
		}
		
		if($organizations){
		
			$this->controller->loadModel('PersonOrganizationsAffiliation');
			//$this->controller->PersonOrganizationsAffiliation->unbindAllModel();
			$personOrgAffs = $this->controller->PersonOrganizationsAffiliation->find('all',array(
				'conditions' => array(
					'PersonOrganizationsAffiliation.person_id' => array_keys($personUserIds)
				),
				'fields' => array(
					'PersonOrganizationsAffiliation.organization_id',
					'PersonOrganizationsAffiliation.person_id',
					'PersonOrganizationsAffiliation.date_member',
					'PersonOrganizationsAffiliation.id'
				)
			));
			
			$this->controller->loadModel('OrganizationsAffiliation');
			$organizations = $this->controller->OrganizationsAffiliation->find('all',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'id' => Set::extract($personOrgAffs,'{n}.PersonOrganizationsAffiliation.organization_id'),
				)
			));
			
			$organizations = Set::combine($organizations,'{n}.OrganizationsAffiliation.id','{n}');
			foreach($personOrgAffs as $personOrgAff){
				$users[$personUserIds[$personOrgAff['PersonOrganizationsAffiliation']['person_id']]]['Organizations'][] = array_merge($personOrgAff,$organizations[$personOrgAff['PersonOrganizationsAffiliation']['organization_id']]);
			}
		}
		return $users;
	}
	
	function getPatientOrder($patientOrderId,$conditions = array(),$fields = array()){
		$patientOrders = array();
		$patientBatchOrders = array();
		$patientBatchOrderPackages = array();
		$patientBatchOrderDetails = array();
		$physicians = array();
		
		if(!is_object($this->controller->LaboratoryPatientOrder));
			$this->controller->loadModel('PatientBatchOrder');
			
		if(in_array('LaboratoryPatientOrder',$fields) || isset($fields['LaboratoryPatientOrder'])){
			$patientOrderConditions = array('LaboratoryPatientOrder.id' => $patientOrderId);
			$patientOrderFields = array(
				'LaboratoryPatientOrder.id',
				'LaboratoryPatientOrder.internal_id',
				'LaboratoryPatientOrder.total_amount_due',
				'LaboratoryPatientOrder.posted_datetime',
			);
			if(isset($fields['LaboratoryPatientOrder']))
				$patientOrderFields = array_merge($patientOrderFields,$fields['LaboratoryPatientOrder']);
			
			$patientOrders = $this->controller->LaboratoryPatientOrder->find('first',array(
				'conditions' => $patientOrderConditions,
				'fields' => $patientOrderFields,
				'recursive' => 0
			));
			
		}
		
		if(in_array('LaboratoryPatientBatchOrder',$fields) || isset($fields['LaboratoryPatientBatchOrder'])){
			$patientBatchOrderConditions = array(
				'LaboratoryPatientBatchOrder.patient_order_id' => $patientOrderId
			);
			
			if(isset($conditions['LaboratoryPatientBatchOrder']))
				$patientBatchOrderConditions = array_merge($patientBatchOrderConditions,$conditions['LaboratoryPatientBatchOrder']);
			
			$patientBatchOrderFields = array_merge(array(
				'LaboratoryPatientBatchOrder.id',
				'LaboratoryPatientBatchOrder.total',
				'LaboratoryPatientBatchOrder.reference_number',
				'LaboratoryPatientBatchOrder.requested_date',
				'LaboratoryPatientBatchOrder.requested_time',
			));
			
			if(isset($fields['LaboratoryPatientBatchOrder']))
				$patientBatchOrderFields = array_merge($patientBatchOrderFields,$fields['LaboratoryPatientBatchOrder']);
			
			$patientBatchOrders = $this->controller->LaboratoryPatientOrder->LaboratoryPatientBatchOrder->find('all',array(
				'conditions' => $patientBatchOrderConditions,
				'fields' => $patientBatchOrderFields,
				'recursive' => -1
			));
			
			//$patientBatchOrders = Set::combine($patientBatchOrders,'{n}.LaboratoryPatientBatchOrder.id','{n}.LaboratoryPatientBatchOrder');
			if(in_array('LaboratoryPatientBatchOrderPackage',$fields) || isset($fields['LaboratoryPatientBatchOrderPackage'])){
				$patientBatchOrderPackageConditions = array(
					'LaboratoryPatientBatchOrderPackage.patient_batch_order_id' => Set::extract($patientBatchOrders,'{n}.LaboratoryPatientBatchOrder.id')//array_keys($patientBatchOrders)
				);
				
				if(isset($conditions['LaboratoryPatientBatchOrderPackage']))
					$patientBatchOrderPackageConditions = array_merge($patientBatchOrderConditions,$conditions['LaboratoryPatientBatchOrderPackage']);
				
				$patientBatchOrderPackageFields = array_merge(array(
					'LaboratoryPatientBatchOrderPackage.id',
					'LaboratoryPatientBatchOrderPackage.patient_batch_order_id',
					'LaboratoryPatientBatchOrderPackage.test_group_id',
					'LaboratoryPatientBatchOrderPackage.test_group_price_id',
					'LaboratoryPatientBatchOrderPackage.physician_id',
					'LaboratoryPatientBatchOrderPackage.company_branch_id',
					'LaboratoryPatientBatchOrderPackage.price',
				));
				
				if(isset($fields['LaboratoryPatientBatchOrderPackage']))
					$patientBatchOrderPackageFields = array_merge($patientBatchOrderPackageFields,$fields['LaboratoryPatientBatchOrderPackage']);
				
				$patientBatchOrderPackages = $this->controller->LaboratoryPatientOrder->LaboratoryPatientBatchOrder->LaboratoryPatientBatchOrderPackage->find('all',array(
					'conditions' => $patientBatchOrderPackageConditions,
					'fields' => $patientBatchOrderPackageFields,
					'recursive' => -1
				));
				
				//$patientBatchOrderPackages = Set::combine($patientBatchOrderPackages, '{n}.LaboratoryPatientBatchOrderPackage.id','{n}.LaboratoryPatientBatchOrderPackage');
				if(in_array('LaboratoryPatientBatchOrderDetail',$fields) || isset($fields['LaboratoryPatientBatchOrderDetail'])){
					$patientBatchOrderPackageDetailConditions = array(
						'LaboratoryPatientBatchOrderDetail.patient_batch_order_package_id' => Set::extract($patientBatchOrderPackages,'/LaboratoryPatientBatchOrderPackage/id')//array_keys($patientBatchOrderPackages)
					);
					
					if(isset($conditions['LaboratoryPatientBatchOrderDetail']))
						$patientBatchOrderPackageDetailConditions = array_merge($patientBatchOrderConditions,$conditions['LaboratoryPatientBatchOrderDetail']);
					
					$patientBatchOrderPackageDetailFields = array_merge(array(
						'LaboratoryPatientBatchOrderDetail.id',
						'LaboratoryPatientBatchOrderDetail.patient_batch_order_package_id',
						'LaboratoryPatientBatchOrderDetail.test_id',
						'LaboratoryPatientBatchOrderDetail.test_id',
						'LaboratoryPatientBatchOrderDetail.price',
					));
					
					if(isset($fields['LaboratoryPatientBatchOrderDetail']))
						$patientBatchOrderPackageDetailFields = array_merge($patientBatchOrderPackageDetailFields,$fields['LaboratoryPatientBatchOrderDetail']);
					
					$patientBatchOrderDetails = $this->controller->LaboratoryPatientOrder->LaboratoryPatientBatchOrder->LaboratoryPatientBatchOrderPackage->LaboratoryPatientBatchOrderDetail->find('all',array(
						'conditions' => $patientBatchOrderPackageDetailConditions,
						'fields' => $patientBatchOrderPackageDetailFields,
						'recursive' => -1
					));
					
					//$patientBatchOrderDetails = Set::combine($patientBatchOrderDetails,'{n}.LaboratoryPatientBatchOrderDetail.id','{n}.LaboratoryPatientBatchOrderDetail');
					
				}
				
				if(in_array('Physician',$fields) || isset($fields['Physician'])){
					$physicianConditions = array(
						'Physician.id' => Set::extract($patientBatchOrderPackages,'/LaboratoryPatientBatchOrderPackage/physician_id')//array_keys($patientBatchOrderPackages)
					);
					
					if(isset($conditions['Physician']))
						$physicianConditions = array_merge($physicianConditions,$conditions['Physician']);
					
					$physicianFields = array_merge(array(
						'Physician.id',
						'Physician.users_id',
						
					));
					
					if(isset($fields['Physician']))
						$physicianFields = array_merge($physicianFields,$fields['Physician']);
					
					$physicians = $this->controller->LaboratoryPatientOrder->LaboratoryPatientBatchOrder->LaboratoryPatientBatchOrderPackage->Physician->find('all',array(
						'conditions' => $physicianConditions,
						'fields' => $physicianFields,
						'recursive' => -1
					));
					
					//$patientBatchOrderDetails = Set::combine($patientBatchOrderDetails,'{n}.LaboratoryPatientBatchOrderDetail.id','{n}.LaboratoryPatientBatchOrderDetail');
					
				}
			}
		}
		return compact('patientOrders','patientBatchOrders','patientBatchOrderPackages','patientBatchOrderDetails','physicians');
		
	}
	/*
	function getTestOrders($testOrderConditions = array(),$testResultConditions = array(),$testOrderFields = array(),$testResultFields = array()){
	
		$this->controller->loadModel('LaboratoryTestOrderPackage');
		$this->controller->LaboratoryTestOrderPackage->unbindAllModel(array('LaboratoryTestGroup','LaboratoryPatientOrder'),false);
		$testOrderPackages = $this->controller->LaboratoryTestOrderPackage->find('all',array(
			'conditions' => $testOrderConditions,
			'fields' => array_merge(array(
				'LaboratoryTestOrderPackage.*',
				'LaboratoryTestGroup.name',
				'LaboratoryTestGroup.id'
			),$testOrderFields)
		));
		
		$this->controller->loadModel('LaboratoryTestOrderResult');
		
		$this->controller->LaboratoryTestOrderPackage->unbindAllModel(array('LaboratoryTestGroup'),false);
		
		$testOrderResults = $this->controller->LaboratoryTestOrderResult->find('all',array(
			'conditions' => array_merge(array(
				'LaboratoryTestOrderResult.test_order_package_id' => Set::extract($testOrderPackages,'{n}.TestOrderPackage.id')
			),$testResultConditions),
			'fields' => array_merge(array(
				'LaboratoryTestOrderResult.*',
				'LaboratoryTest.name',
				'LaboratoryTest.id'
			),$testResultFields)
		));
		
		return compact('testOrderResults','testOrderPackages');
	}
	*/
	
	function getTestOrders($patientOrderIds=array(),$conditions = array(),$fields = array(),$customJoins = array()){
		$testOrderIds = $patientOrderIds;
// 		$patientOrderConditions = !empty($patientOrderIds)?array('LaboratoryTestOrder.patient_order_id' => $patientOrderIds):array();
// 		debug($patientOrderConditions);
// 		if(!empty($patientOrderConditions)){
// 			$this->controller->loadModel('LaboratoryTestOrder');
// 			$this->controller->LaboratoryTestOrder->unbindAllModel(array('LaboratoryPatientOrder'));
// 			$testOrderIds = $this->controller->LaboratoryTestOrder->find('all',array(
// 					'conditions' => $patientOrderConditions
// 				));
// 		}
		$testOrderConditions = !empty($testOrderIds)?array('LaboratoryTestOrder.id' => $testOrderIds):array();
		if(isset($conditions['LaboratoryTestOrder']))
			$testOrderConditions = array_merge_recursive($testOrderConditions,$conditions['LaboratoryTestOrder']);
// 		debug($testOrderConditions);
		if(!empty($testOrderConditions)){
			$this->controller->loadModel('LaboratoryTestOrder');
			$this->controller->LaboratoryTestOrder->unbindAllModel(array('LaboratoryPatientOrder'));
			$testOrders = $this->controller->LaboratoryTestOrder->find('all',array(
				'conditions' => $testOrderConditions
			));
			
			if(empty($testOrderIds))
				$testOrderIds = Set::extract($testOrders,'{n}.LaboratoryTestOrder.id');
		}
		if(in_array('LaboratoryTestOrderPackage',$fields) || isset($fields['LaboratoryTestOrderPackage'])){
			
			$testOrderPackageJoins = array();
			
			$testOrderPackageConditions = array();
			if(!empty($testOrderIds))
				$testOrderPackageConditions['LaboratoryTestOrderPackage.test_order_id'] = $testOrderIds;
			$testOrderPackageFields = array('LaboratoryTestOrderPackage.*','LaboratoryTestGroup.name','LaboratoryTestGroup.id');
			
			if(isset($conditions['LaboratoryTestOrderPackage']))
				$testOrderPackageConditions = array_merge_recursive($testOrderPackageConditions,$conditions['LaboratoryTestOrderPackage']);
				
			if(isset($fields['LaboratoryTestOrderPackage']))
				$testOrderPackageFields = array_merge($testOrderPackageFields,$fields['LaboratoryTestOrderPackage']);
			
			if(isset($customJoins['LaboratoryTestOrderPackage']))
				$testOrderPackageJoins = $customJoins['LaboratoryTestOrderPackage'];
				
			$this->controller->loadModel('LaboratoryTestOrderPackage');
			$this->controller->LaboratoryTestOrderPackage->unbindAllModel(array('LaboratoryTestGroup'),false);
			$testOrderPackages = $this->controller->LaboratoryTestOrderPackage->find('all',array(
				'conditions' => $testOrderPackageConditions,
				'fields' => $testOrderPackageFields,
				'joins' => $testOrderPackageJoins
			));
			
			$testOrderPackages = Set::combine($testOrderPackages,'{n}.LaboratoryTestOrderPackage.id','{n}');
			
			if(in_array('LaboratoryTestOrderResult',$fields) || isset($fields['LaboratoryTestOrderResult'])){
			
				$testOrderResultConditions = array('LaboratoryTestOrderResult.test_order_package_id'=>array_keys($testOrderPackages));
				if(isset($conditions['LaboratoryTestOrderResult']))
					$testOrderResultConditions = array_merge_recursive($testOrderResultConditions,$conditions['LaboratoryTestOrderResult']);
				
				$testOrderResultFields = array('LaboratoryTestOrderResult.*','LaboratoryTest.name','LaboratoryTest.id');
				if(isset($fields['LaboratoryTestOrderResult']))
					$testOrderResultFields = array_merge_recursive($testOrderResultFields,$fields['LaboratoryTestOrderResult']);
				
				$this->controller->loadModel('LaboratoryTestOrderResult');
				$testOrderResults = $this->controller->LaboratoryTestOrderResult->find('all',array(
					'conditions' => $testOrderResultConditions,
					'fields' => $testOrderResultFields
				));
// 				$testOrderResults = Set::combine($testOrderResults,'/LaboratoryTestOrderResult/id','/LaboratoryTestOrderResult/../.');
				
			}
			$testOrderConditions['LaboratoryTestOrder.id'] = Set::extract($testOrderPackages,'/LaboratoryTestOrderPackage/test_order_id');
		}
		
		if(!isset($testOrders) && (isset($fields['LaboratoryTestOrder']) || in_array('LaboratoryTestOrder',$fields))){
			$this->controller->loadModel('LaboratoryTestOrder');
			$this->controller->LaboratoryTestOrder->unbindAllModel(array('LaboratoryPatientOrder'));
			$testOrders = $this->controller->LaboratoryTestOrder->find('all',array(
				'conditions' => array_merge(
					$testOrderConditions
				)
			));
			
		}
		if(isset($testOrders) && !empty($testOrders)){
			
			$patientIds = Set::extract($testOrders,'/LaboratoryPatientOrder/patient_id');
			
			array_unique($patientIds);
			
			if(in_array('Patient',$fields) || isset($fields['Patient'])){
				
				$patientConditions = array('Patient.id' => $patientIds);
				if(isset($conditions['Patient']))
					$patientConditions = array_merge_recursive($patientConditions,$conditions['Patient']);
				
				$this->controller->Patient->unbindAllModel(array('Person'));
				$patientFields = array('Patient.id','Person.id');
				
				if(isset($fields['Patient']))
					$patientFields = array_merge($patientFields,$fields['Patient']);
				
				$patients = $this->controller->Patient->find('all',array(
					'conditions' => $patientConditions,
					'fields' => $patientFields
				));
				$patients = Set::combine($patients,'/Patient/id','/Patient/../.');
			}
			
			if(isset($fields['Laboratory']) || in_array('Laboratory',$fields)){
				$this->controller->loadModel('Laboratory');
				$this->controller->Laboratory->unbindAllModel(array('CompanyBranch'));
				$laboratories = $this->controller->Laboratory->find('all',array(
					'fields' => array(
						'Laboratory.id' ,'CompanyBranch.name' 
					),
					'conditions' => array(
						'Laboratory.id' => Set::extract($testOrders,'/LaboratoryPatientOrder/laboratory_id')
					),
					'joins'=>array(
							array('table' => 'company_branches',
									'alias' => 'CompanyBranches',
									'type' => 'inner',
									'conditions' => array(
											'Laboratory.company_branch_id = CompanyBranches.id'
									)
							)
					)
				));
				$laboratories = Set::combine($laboratories,'/Laboratory/id','/CompanyBranch/name');
				
			}
		}
		
		return compact('testOrders','patients','testOrderPackages','testOrderResults','laboratories');
	
	}
	
	public function searchLaboratoryName($labIds=null,$letterFilter=null,$page=null){
		$this->controller->loadModel('CompanyBranch');
		$this->controller->paginate = array(
			'limit' => 10,
			'page' => $page,
			'fields' => array('CompanyBranch.id','CompanyBranch.name'),
			'conditions' => array('CompanyBranch.id'=>$labIds/*,'CompanyBranch.name LIKE "'.$letterFilter.'"'*/),
			'order' => 'CompanyBranch.name'
		);
		$this->controller->CompanyBranch->unbindAllModel();
		$labInfo = $this->controller->paginate('CompanyBranch');
		$labInfo = Set::combine($labInfo,'{n}.CompanyBranch.id','{n}');
		return($labInfo);
	}
	
	public function searchLaboratoryAddress($labIds=null){
		$this->controller->loadModel('CompanyBranchAddress');
		$this->controller->CompanyBranchAddress->unbindAllModel();
		$address = $this->controller->CompanyBranchAddress->find('all',array(
			'fields' => array('CompanyBranchAddress.company_branch_id','Address.id','Address.floor','Address.unit','Address.longtitude','Address.latitude','Address.building_apartment','Address.street_number','StreetCode.name','VillageCode.name','TownCityCode.name','ProvincesStatesCode.name'),
			'conditions' => array('CompanyBranchAddress.company_branch_id'=>$labIds),
			'joins' => array(
				array('table'=>'addresses','alias'=>'Address','type'=>'left','conditions'=>array('Address.id=CompanyBranchAddress.address_id')),
				array('table'=>'street_codes','alias'=>'StreetCode','type'=>'left','conditions'=>array('Address.street_id=StreetCode.id')),
				array('table'=>'village_codes','alias'=>'VillageCode','type'=>'left','conditions'=>array('Address.village_id=VillageCode.id')),
				array('table'=>'town_city_codes','alias'=>'TownCityCode','type'=>'left','conditions'=>array('Address.town_city_id=TownCityCode.id')),
				array('table'=>'provinces_states_codes','alias'=>'ProvincesStatesCode','type'=>'left','conditions'=>array('Address.province_state_id=ProvincesStatesCode.id'))
			),
			'order' => 'CompanyBranchAddress.company_branch_id'
		));
		$address = Set::combine($address,'{n}.Address.id','{n}','{n}.CompanyBranchAddress.company_branch_id');
		return($address);
	}
	
	public function searchLaboratoryHmo($labIds=null){
		$this->controller->loadModel('InsuranceProviderProduct');
		$this->controller->InsuranceProviderProduct->unbindAllModel();
		$hmo = $this->controller->InsuranceProviderProduct->find('all',array(
			'fields' => array('Laboratory.company_branch_id','InsuranceProviderProduct.id','InsuranceProviderProduct.name'),
			'conditions' => array('Laboratory.company_branch_id'=>$labIds),
			'joins' => array(
				array('table'=>'laboratory_accepted_insurance','alias'=>'LaboratoryAcceptedInsurance','type'=>'left','conditions'=>array('InsuranceProviderProduct.id=LaboratoryAcceptedInsurance.insurance_provider_product_id')),
				array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('LaboratoryAcceptedInsurance.laboratory_id=Laboratory.id'))
			),
			'order' => 'Laboratory.company_branch_id'
		));
		$hmo = Set::combine($hmo,'{n}.InsuranceProviderProduct.id','{n}','{n}.Laboratory.company_branch_id');
		return($hmo);
	}
	
	public function searchLaboratoryService($labIds = null){
		$this->controller->loadModel('Service');
		$this->controller->Service->unbindAllModel();
		$service = $this->controller->Service->find('all',array(
			'fields' => array('CompanyBranchService.company_branch_id','Service.id','Service.name'),
			'conditions' => array('CompanyBranchService.company_branch_id'=>$labIds),
			'joins' => array(
				array('table'=>'company_branch_services','alias'=>'CompanyBranchService','type'=>'left','conditions'=>array('Service.id=CompanyBranchService.service_id'))
			),
			'order' => 'CompanyBranchService.company_branch_id'
		));
		$service = Set::combine($service,'{n}.Service.id','{n}','{n}.CompanyBranchService.company_branch_id');
		return($service);
	}
	
	public function searchLaboratoryContactInfo($labIds=null){
		$this->controller->loadModel('ContactInformation');
		$this->controller->ContactInformation->unbindAllModel();
		$contact = $this->controller->ContactInformation->find('all',array(
			'fields' => array('CompanyBranchContactInformation.company_branch_id','ContactInformation.id','ContactInformation.type','ContactInformation.contact'),
			'conditions' => array('CompanyBranchContactInformation.company_branch_id'=>$labIds),
			'joins' => array(
				array('table'=>'company_branch_contact_informations','alias'=>'CompanyBranchContactInformation','type'=>'left','conditions'=>array('ContactInformation.id=CompanyBranchContactInformation.contact_id'))
			)
		));
		$contact = Set::combine($contact,'{n}.ContactInformation.id','{n}','{n}.CompanyBranchContactInformation.company_branch_id');
		return($contact);
	}
	public function searchBranchInfo($labIds=null){
		$this->controller->loadModel('CompanyBranchInfo');
		$this->controller->CompanyBranchInfo->unbindAllModel();
		$branch_info = $this->controller->CompanyBranchInfo->find('all',array(
			'conditions' => array('CompanyBranchInfo.company_branch_id'=>$labIds)
		));
		$branch_info = Set::combine($branch_info,'{n}.CompanyBranchInfo.company_branch_id','{n}','{n}.CompanyBranchInfo.company_branch_id');
		return($branch_info);
	}
	public function getComBranchLaboratoryDetails($labId=null)
	{
		$labDetails = array();
		//Company
		$this->controller->loadModel('Company');
		$this->controller->Company->unbindAllModel();
		$compId = $this->controller->Company->find('first',array(
				'fields' => array('Company.id','Company.name','Company.logo','Company.website','Company.validated'),
				'conditions' => array('Laboratory.id'=>$labId),
				'joins' => array(
						array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id')),
						array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('Laboratory.company_branch_id=CompanyBranch.id'))
				)
		));
// 		debug($compId);
		$companyId = $compId['Company']['id'];
		//Company Branch
		$this->controller->loadModel('CompanyBranch');
		$this->controller->CompanyBranch->unbindAllModel(array(),true);
		$labInfo = $this->controller->CompanyBranch->find('all',array(
				'fields' => array('CompanyBranch.id','CompanyBranch.name','CompanyBranchInfo.id','CompanyBranchInfo.logo','CompanyBranchInfo.mission','CompanyBranchInfo.vision','CompanyBranchInfo.website'),
				'conditions' => array('CompanyBranch.id'=>$labId),
				'joins' => array(
						array('table'=>'company_branch_info','alias'=>'CompanyBranchInfo','type'=>'left','conditions'=>array('CompanyBranch.id=CompanyBranchInfo.company_branch_id'))
				)
		));
		
		$labInfo = Set::combine($labInfo,'{n}.CompanyBranch.id','{n}');
		$labInfo[$labId]['Company'] = $compId['Company'];
		//Company Branch Laboratory
		$this->controller->loadModel('Laboratory');
		$this->controller->Laboratory->unbindAllModel();
		$labInfos = current($this->controller->Laboratory->find('all',array(
				'fields' => array('Laboratory.id','Laboratory.type','Laboratory.class'),
				'conditions' => array('Laboratory.company_branch_id'=>$labId),
		))
		);
		$labInfo[$labId]['Laboratory'] = $labInfos['Laboratory'];
		//Company Branch Accreditation
		/*		$this->controller->loadModel('CompanyBranchAccreditation');
		 $this->controller->CompanyBranchAccreditation->unbindAllModel();
		$labInfoAccreditation = $this->controller->CompanyBranchAccreditation->find('all',array(
				'fields' => array('CompanyBranchAccreditation.*','Accreditation.*',),
				'conditions' => array('CompanyBranchAccreditation.company_branch_id'=>$labId),
				'joins'=>array(
						array('table'=>'accreditations','alias'=>'Accreditation','type'=>'left','conditions'=>array('CompanyBranchAccreditation.accreditation_id=Accreditation.id'))
				)
		)
		);
		$labInfo[$labId]['CompanyBranchAccreditation'] = $labInfoAccreditation;*/
		//		$labInfo[$labId]['CompanyBranchAccreditation']['Accreditation'] = $labInfoAccreditation['Accreditation'];
		//Company Branch Address
		$this->controller->loadModel('CompanyBranchAddress');
		$this->controller->CompanyBranchAddress->unbindAllModel();
		$labAddress = $this->controller->CompanyBranchAddress->find('all',array(
				'fields' => array('CompanyBranchAddress.id','CompanyBranchAddress.company_branch_id','Address.id','Address.latitude','Address.longtitude','Address.id','Address.lot','Address.block','Address.floor','Address.unit','Address.building_apartment','Address.street_number','StreetCode.id','StreetCode.name','VillageCode.id','VillageCode.name','TownCityCode.id','TownCityCode.name','ProvincesStatesCode.id','ProvincesStatesCode.name'),
				'conditions' => array('CompanyBranchAddress.company_branch_id'=>$labId),
				'joins' => array(
						array('table'=>'addresses','alias'=>'Address','type'=>'left','conditions'=>array('Address.id=CompanyBranchAddress.address_id')),
						array('table'=>'street_codes','alias'=>'StreetCode','type'=>'left','conditions'=>array('Address.street_id=StreetCode.id')),
						array('table'=>'village_codes','alias'=>'VillageCode','type'=>'left','conditions'=>array('Address.village_id=VillageCode.id')),
						array('table'=>'town_city_codes','alias'=>'TownCityCode','type'=>'left','conditions'=>array('Address.town_city_id=TownCityCode.id')),
						array('table'=>'provinces_states_codes','alias'=>'ProvincesStatesCode','type'=>'left','conditions'=>array('Address.province_state_id=ProvincesStatesCode.id')),
						array('table'=>'country_codes','alias'=>'CountryCode','type'=>'left','conditions'=>array('Address.country_id=CountryCode.id'))
				),
				'order' => 'CompanyBranchAddress.company_branch_id'
		));
		$labAddress = Set::combine($labAddress,'{n}.CompanyBranchAddress.company_branch_id','{n}');
		$labInfo[$labId]['Address'] = $labAddress;
		
		$this->controller->loadModel('InsuranceProviderProduct');
		$this->controller->InsuranceProviderProduct->unbindAllModel();
		$labHmo = $this->controller->InsuranceProviderProduct->find('all',array(
				'fields' => array('CompanyBranch.id,CompanyBranch.name,Laboratory.company_branch_id','LaboratoryAcceptedInsurance.id','LaboratoryAcceptedInsurance.laboratory_id','LaboratoryAcceptedInsurance.insurance_provider_product_id','LaboratoryAcceptedInsurance.validity_start_date ','LaboratoryAcceptedInsurance.validity_end_time ',
				//				'LaboratoryAcceptedInsurance.accreditation ',
						'InsuranceProviderProduct.id','InsuranceProviderProduct.insurance_provider_id','InsuranceProviderProduct.name','Company.name','Company.id'),
				'conditions' => array('Laboratory.company_branch_id'=>$labId),
				'joins' => array(
						array('table'=>'laboratory_accepted_insurance','alias'=>'LaboratoryAcceptedInsurance','type'=>'left','conditions'=>array('InsuranceProviderProduct.id=LaboratoryAcceptedInsurance.insurance_provider_product_id')),
						array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('LaboratoryAcceptedInsurance.laboratory_id=Laboratory.id')),
						array('table'=>'insurance_providers','alias'=>'InsuranceProvider','type'=>'left','conditions'=>array('InsuranceProviderProduct.insurance_provider_id=InsuranceProvider.id')),
						array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('InsuranceProvider.company_branch_id=CompanyBranch.id')),
						array('table'=>'companies','alias'=>'Company','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id'))
				),
				'order' => 'Laboratory.company_branch_id'
		));
		//		$labHmo = Set::combine($labHmo,'{n}.Laboratory.company_branch_id','{n}');
		$labInfo[$labId]['Hmo'] = $labHmo;
		
		$this->controller->loadModel('Service');
		$this->controller->Service->unbindAllModel();
		$labService = $this->controller->Service->find('all',array(
				'fields' => array('CompanyBranchService.company_branch_id','Service.id','Service.name'),
				'conditions' => array('CompanyBranchService.company_branch_id'=>$labId,'Service.type = 2'),
				'joins' => array(
						array('table'=>'company_branch_services','alias'=>'CompanyBranchService','type'=>'left','conditions'=>array('Service.id=CompanyBranchService.service_id'))
				),
				'order' => 'CompanyBranchService.company_branch_id'
		));
		$labService = Set::combine($labService,'{n}.CompanyBranchService.company_branch_id','{n}');
		$labInfo[$labId]['Services'] = $labService;
		
		$this->controller->loadModel('ContactInformation');
		$this->controller->ContactInformation->unbindAllModel();
		$labContact = $this->controller->ContactInformation->find('all',array(
				'fields' => array('CompanyBranchContactInformation.company_branch_id','ContactInformation.id','ContactInformation.type','ContactInformation.contact'),
				'conditions' => array('CompanyBranchContactInformation.company_branch_id'=>$labId),
				'joins' => array(
						array('table'=>'company_branch_contact_informations','alias'=>'CompanyBranchContactInformation','type'=>'left','conditions'=>array('ContactInformation.id=CompanyBranchContactInformation.contact_id'))
				)
		));
		
		$labContact = Set::combine($labContact,'{n}.ContactInformation.id','{n}');
		$labInfo[$labId]['Contacts'] = $labContact;
		
		$this->controller->loadModel('CompanyBranchContactInformation');
		$this->controller->CompanyBranchContactInformation->unbindAllModel();
		$contactTypes = $this->controller->CompanyBranchContactInformation->types;
		foreach($labContact as $contactId=>$contacts){
			$labInfo[$labId]['Contacts'][$contactId] = $labContact[$contactId];
			$labInfo[$labId]['Contacts'][$contactId]['ContactInformation']['typename'] = $contactTypes[$contacts['ContactInformation']['type']];
				
		}
		
		$this->controller->loadModel('Accreditation');
		$labAccreditation = $this->controller->Accreditation->find('all',array(
				'fields'=>array('Accreditation.id','Accreditation.name','CompanyBranchAccreditation.id','CompanyBranchAccreditation.accreditation_number','CompanyBranchAccreditation.company_branch_id','CompanyBranchAccreditation.accreditation_date','CompanyBranchAccreditation.accreditation_renewal_date','CompanyBranchAccreditation.accreditation_expiration_date'),
				'conditions'=>array('CompanyBranchAccreditation.company_branch_id'=>$labId),
				'joins'=>array(
						array('table'=>'company_branch_accreditations','alias'=>'CompanyBranchAccreditation','type'=>'left','conditions'=>array('CompanyBranchAccreditation.accreditation_id=Accreditation.id'))
				)
		));
		//		$labAccreditation = Set::combine($labAccreditation,'{n}.CompanyBranchAccreditation.company_branch_id','{n}');
		$labInfo[$labId]['Accreditations'] = $labAccreditation;
		
		
		$this->controller->loadModel('CompanyBranchImage');
		$data = array();
		$data= $this->controller->CompanyBranchImage->find('all',array(
				'fields'=>array(
						'CompanyBranchImage.id',
						'Image.image',
						'Image.thumbnail',
						'CompanyBranchImage.company_branch_id',
						'CompanyBranchImage.title',
						//'CompanyBranchImage.image_id',
						'CompanyBranchImage.description'
				),
				'conditions'=>array(
						'CompanyBranchImage.company_branch_id'=>$labId
				),
				'order'=>'CompanyBranchImage.entry_datetime',
				'joins'=>array(
						array(
								'table'=>'images',
								'alias'=>'Image',
								'type'=>'left',
								'conditions'=>array(
										'CompanyBranchImage.image_id=Image.id'
								)
						)
				)
		));
		
		$labInfo[$labId]['Image'] = $data;
		//		debug($labInfo);
		
		$labBranches = $this->controller->CompanyBranch->find('all',array(
				'fields' => array('CompanyBranch.id','CompanyBranch.name'),
				'conditions' => array('CompanyBranch.company_id'=>$companyId, 'CompanyBranch.id NOT'=>$labId)
		));
		$labBranches = Set::combine($labBranches,'{n}.CompanyBranch.id','{n}');
		//		debug($labBranches);
		$labInfo[$labId]['Branches'] = $labBranches;
		
		return($labInfo);
		
	}
	
	public function getLaboratoryDetails($branchId=null){
		$labDetails = array();
		//Company
		$this->controller->loadModel('Company');
		$this->controller->Company->unbindAllModel();
		$compId = $this->controller->Company->find('first',array(
			'fields' => array('Company.id','Company.name','Company.logo','Company.website','Company.validated'),
			'conditions' => array('CompanyBranch.id'=>$branchId),
			'joins' => array(
				array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id')),
// 				array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('Laboratory.company_branch_id=CompanyBranch.id'))
			)
		));
// 		debug($compId);
		$companyId = $compId['Company']['id'];
		//Company Branch
		$this->controller->loadModel('CompanyBranch');
		$this->controller->CompanyBranch->unbindAllModel(array(),true);
		$labInfo = $this->controller->CompanyBranch->find('all',array(
			'fields' => array('CompanyBranch.id','CompanyBranch.name','CompanyBranchInfo.id','CompanyBranchInfo.logo','CompanyBranchInfo.mission','CompanyBranchInfo.vision','CompanyBranchInfo.website'),
			'conditions' => array('CompanyBranch.id'=>$branchId),
			'joins' => array(
				array('table'=>'company_branch_info','alias'=>'CompanyBranchInfo','type'=>'left','conditions'=>array('CompanyBranch.id=CompanyBranchInfo.company_branch_id'))
			)
		));

		$labInfo = Set::combine($labInfo,'{n}.CompanyBranch.id','{n}');
		$labInfo[$branchId]['Company'] = $compId['Company'];
		//Company Branch Laboratory
		$this->controller->loadModel('Laboratory');
		$this->controller->Laboratory->unbindAllModel();
		$labInfos = current($this->controller->Laboratory->find('all',array(
			'fields' => array('Laboratory.id','Laboratory.type','Laboratory.class'),
			'conditions' => array('Laboratory.company_branch_id'=>$branchId),
			))
		);
		$labInfo[$branchId]['Laboratory'] = $labInfos['Laboratory'];
		//Company Branch Accreditation
/*		$this->controller->loadModel('CompanyBranchAccreditation');
		$this->controller->CompanyBranchAccreditation->unbindAllModel();
		$labInfoAccreditation = $this->controller->CompanyBranchAccreditation->find('all',array(
			'fields' => array('CompanyBranchAccreditation.*','Accreditation.*',),
			'conditions' => array('CompanyBranchAccreditation.company_branch_id'=>$branchId),
			'joins'=>array(
						array('table'=>'accreditations','alias'=>'Accreditation','type'=>'left','conditions'=>array('CompanyBranchAccreditation.accreditation_id=Accreditation.id'))
				)
			)
		);
		$labInfo[$branchId]['CompanyBranchAccreditation'] = $labInfoAccreditation;*/
//		$labInfo[$branchId]['CompanyBranchAccreditation']['Accreditation'] = $labInfoAccreditation['Accreditation'];
		//Company Branch Address
		$this->controller->loadModel('CompanyBranchAddress');
		$this->controller->CompanyBranchAddress->unbindAllModel();
		$labAddress = $this->controller->CompanyBranchAddress->find('all',array(
			'fields' => array('CompanyBranchAddress.id','CompanyBranchAddress.company_branch_id','Address.id','Address.latitude','Address.longtitude','Address.id','Address.lot','Address.block','Address.floor','Address.unit','Address.building_apartment','Address.street_number','StreetCode.id','StreetCode.name','VillageCode.id','VillageCode.name','TownCityCode.id','TownCityCode.name','ProvincesStatesCode.id','ProvincesStatesCode.name'),
			'conditions' => array('CompanyBranchAddress.company_branch_id'=>$branchId),
			'joins' => array(
				array('table'=>'addresses','alias'=>'Address','type'=>'left','conditions'=>array('Address.id=CompanyBranchAddress.address_id')),
				array('table'=>'street_codes','alias'=>'StreetCode','type'=>'left','conditions'=>array('Address.street_id=StreetCode.id')),
				array('table'=>'village_codes','alias'=>'VillageCode','type'=>'left','conditions'=>array('Address.village_id=VillageCode.id')),
				array('table'=>'town_city_codes','alias'=>'TownCityCode','type'=>'left','conditions'=>array('Address.town_city_id=TownCityCode.id')),
				array('table'=>'provinces_states_codes','alias'=>'ProvincesStatesCode','type'=>'left','conditions'=>array('Address.province_state_id=ProvincesStatesCode.id')),
				array('table'=>'country_codes','alias'=>'CountryCode','type'=>'left','conditions'=>array('Address.country_id=CountryCode.id'))
			),
			'order' => 'CompanyBranchAddress.company_branch_id'
		));
		$labAddress = Set::combine($labAddress,'{n}.CompanyBranchAddress.company_branch_id','{n}');
		$labInfo[$branchId]['Address'] = $labAddress;
	
		$this->controller->loadModel('InsuranceProviderProduct');
		$this->controller->InsuranceProviderProduct->unbindAllModel();
		$labHmo = $this->controller->InsuranceProviderProduct->find('all',array(
			'fields' => array('CompanyBranch.id','CompanyBranch.name','Laboratory.company_branch_id','LaboratoryAcceptedInsurance.id','LaboratoryAcceptedInsurance.laboratory_id','LaboratoryAcceptedInsurance.insurance_provider_product_id','LaboratoryAcceptedInsurance.validity_start_date ','LaboratoryAcceptedInsurance.validity_end_time ',
//				'LaboratoryAcceptedInsurance.accreditation ',
				'InsuranceProviderProduct.id','InsuranceProviderProduct.insurance_provider_id','InsuranceProviderProduct.name','Company.name','Company.id'),
				'conditions' => array('Laboratory.company_branch_id'=>$branchId),
			'joins' => array(
				array('table'=>'laboratory_accepted_insurance','alias'=>'LaboratoryAcceptedInsurance','type'=>'left','conditions'=>array('InsuranceProviderProduct.id=LaboratoryAcceptedInsurance.insurance_provider_product_id')),
				array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('LaboratoryAcceptedInsurance.laboratory_id=Laboratory.id')),
				array('table'=>'insurance_providers','alias'=>'InsuranceProvider','type'=>'left','conditions'=>array('InsuranceProviderProduct.insurance_provider_id=InsuranceProvider.id')),
				array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('InsuranceProvider.company_branch_id=CompanyBranch.id')),
				array('table'=>'companies','alias'=>'Company','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id'))
			),
			'order' => 'Laboratory.company_branch_id'
		));
//		$labHmo = Set::combine($labHmo,'{n}.Laboratory.company_branch_id','{n}');
		$labInfo[$branchId]['Hmo'] = $labHmo;
		
		$this->controller->loadModel('Service');
		$this->controller->Service->unbindAllModel();
		$labService = $this->controller->Service->find('all',array(
			'fields' => array('CompanyBranchService.company_branch_id','Service.id','Service.name'),
			'conditions' => array('CompanyBranchService.company_branch_id'=>$branchId,'Service.type = 2'),
			'joins' => array(
				array('table'=>'company_branch_services','alias'=>'CompanyBranchService','type'=>'left','conditions'=>array('Service.id=CompanyBranchService.service_id'))
			),
			'order' => 'CompanyBranchService.company_branch_id'
		));
		$labService = Set::combine($labService,'{n}.CompanyBranchService.company_branch_id','{n}');
		$labInfo[$branchId]['Services'] = $labService;
		
		$this->controller->loadModel('ContactInformation');
		$this->controller->ContactInformation->unbindAllModel();
		$labContact = $this->controller->ContactInformation->find('all',array(
			'fields' => array('CompanyBranchContactInformation.company_branch_id','ContactInformation.id','ContactInformation.type','ContactInformation.contact'),
			'conditions' => array('CompanyBranchContactInformation.company_branch_id'=>$branchId),
			'joins' => array(
				array('table'=>'company_branch_contact_informations','alias'=>'CompanyBranchContactInformation','type'=>'left','conditions'=>array('ContactInformation.id=CompanyBranchContactInformation.contact_id'))
			)
		));
		
		$labContact = Set::combine($labContact,'{n}.ContactInformation.id','{n}');
		$labInfo[$branchId]['Contacts'] = $labContact;
		
			$this->controller->loadModel('CompanyBranchContactInformation');
		$this->controller->CompanyBranchContactInformation->unbindAllModel();
		$contactTypes = $this->controller->CompanyBranchContactInformation->types;
		foreach($labContact as $contactId=>$contacts){
			$labInfo[$branchId]['Contacts'][$contactId] = $labContact[$contactId];
			$labInfo[$branchId]['Contacts'][$contactId]['ContactInformation']['typename'] = $contactTypes[$contacts['ContactInformation']['type']];
			
		}

		$this->controller->loadModel('Accreditation');
		$labAccreditation = $this->controller->Accreditation->find('all',array(
			'fields'=>array('Accreditation.id','Accreditation.name','CompanyBranchAccreditation.id','CompanyBranchAccreditation.accreditation_number','CompanyBranchAccreditation.company_branch_id','CompanyBranchAccreditation.accreditation_date','CompanyBranchAccreditation.accreditation_renewal_date','CompanyBranchAccreditation.accreditation_expiration_date'),
			'conditions'=>array('CompanyBranchAccreditation.company_branch_id'=>$branchId),
			'joins'=>array(
				array('table'=>'company_branch_accreditations','alias'=>'CompanyBranchAccreditation','type'=>'left','conditions'=>array('CompanyBranchAccreditation.accreditation_id=Accreditation.id'))
			)
		));
//		$labAccreditation = Set::combine($labAccreditation,'{n}.CompanyBranchAccreditation.company_branch_id','{n}');
		$labInfo[$branchId]['Accreditations'] = $labAccreditation;


		$this->controller->loadModel('CompanyBranchImage');
		$data = array();
		$data= $this->controller->CompanyBranchImage->find('all',array(
					'fields'=>array(
						'CompanyBranchImage.id',
						'Image.image',
						'Image.thumbnail',
						'CompanyBranchImage.company_branch_id',
						'CompanyBranchImage.title',
						//'CompanyBranchImage.image_id',
						'CompanyBranchImage.description'
					),
					'conditions'=>array(
						'CompanyBranchImage.company_branch_id'=>$branchId
					),
					'order'=>'CompanyBranchImage.entry_datetime',
					'joins'=>array(
						array(
						'table'=>'images',
						'alias'=>'Image',
						'type'=>'left',
						'conditions'=>array(
							'CompanyBranchImage.image_id=Image.id'
							)
						)
					)
			));
	
		$labInfo[$branchId]['Image'] = $data;
//		debug($labInfo);
		
		$labBranches = $this->controller->CompanyBranch->find('all',array(
			'fields' => array('CompanyBranch.id','CompanyBranch.name'),
			'conditions' => array('CompanyBranch.company_id'=>$companyId, 'CompanyBranch.id NOT'=>$branchId)
		));
		$labBranches = Set::combine($labBranches,'{n}.CompanyBranch.id','{n}');
//		debug($labBranches);
		$labInfo[$branchId]['Branches'] = $labBranches;
		
		return($labInfo);
	}
	
	public function getCorporateDetails($branchId=null){
		$labDetails = array();
		//Company
		$this->controller->loadModel('Company');
		$this->controller->Company->unbindAllModel();
		$compId = $this->controller->Company->find('first',array(
				'fields' => array('Company.id','Company.name','Company.logo','Company.website','Company.validated'),
				'conditions' => array('CompanyBranch.id'=>$branchId),
				'joins' => array(
						array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id')),
						// 				array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('Laboratory.company_branch_id=CompanyBranch.id'))
				)
		));
		// 		debug($compId);
		$companyId = $compId['Company']['id'];
		//Company Branch
		$this->controller->loadModel('CompanyBranch');
		$this->controller->CompanyBranch->unbindAllModel(array(),true);
		$corpInfo = $this->controller->CompanyBranch->find('all',array(
				'fields' => array('CompanyBranch.id','CompanyBranch.name','CompanyBranchInfo.id','CompanyBranchInfo.logo','CompanyBranchInfo.mission','CompanyBranchInfo.vision','CompanyBranchInfo.website'),
				'conditions' => array('CompanyBranch.id'=>$branchId),
				'joins' => array(
						array('table'=>'company_branch_info','alias'=>'CompanyBranchInfo','type'=>'left','conditions'=>array('CompanyBranch.id=CompanyBranchInfo.company_branch_id'))
				)
		));
	
		$corpInfo = Set::combine($corpInfo,'{n}.CompanyBranch.id','{n}');
		$corpInfo[$branchId]['Company'] = $compId['Company'];
		//Company Branch Laboratory
		$this->controller->loadModel('CorporateAccount');
		$this->controller->CorporateAccount->unbindAllModel();
		$corpInfos = current($this->controller->CorporateAccount->find('all',array(
				'fields' => array('CorporateAccount.id','CorporateAccount.type','CorporateAccount.class'),
				'conditions' => array('CorporateAccount.company_branch_id'=>$branchId),
		))
		);
		$corpInfo[$branchId]['CorporateAccount'] = $corpInfos['CorporateAccount'];
		//Company Branch Accreditation
		/*		$this->controller->loadModel('CompanyBranchAccreditation');
			$this->controller->CompanyBranchAccreditation->unbindAllModel();
		$corpInfoAccreditation = $this->controller->CompanyBranchAccreditation->find('all',array(
				'fields' => array('CompanyBranchAccreditation.*','Accreditation.*',),
				'conditions' => array('CompanyBranchAccreditation.company_branch_id'=>$branchId),
				'joins'=>array(
						array('table'=>'accreditations','alias'=>'Accreditation','type'=>'left','conditions'=>array('CompanyBranchAccreditation.accreditation_id=Accreditation.id'))
				)
		)
		);
		$corpInfo[$branchId]['CompanyBranchAccreditation'] = $corpInfoAccreditation;*/
		//		$corpInfo[$branchId]['CompanyBranchAccreditation']['Accreditation'] = $corpInfoAccreditation['Accreditation'];
		//Company Branch Address
		$this->controller->loadModel('CompanyBranchAddress');
		$this->controller->CompanyBranchAddress->unbindAllModel();
		$labAddress = $this->controller->CompanyBranchAddress->find('all',array(
				'fields' => array('CompanyBranchAddress.id','CompanyBranchAddress.company_branch_id','Address.id','Address.latitude','Address.longtitude','Address.id','Address.lot','Address.block','Address.floor','Address.unit','Address.building_apartment','Address.street_number','StreetCode.id','StreetCode.name','VillageCode.id','VillageCode.name','TownCityCode.id','TownCityCode.name','ProvincesStatesCode.id','ProvincesStatesCode.name'),
				'conditions' => array('CompanyBranchAddress.company_branch_id'=>$branchId),
				'joins' => array(
						array('table'=>'addresses','alias'=>'Address','type'=>'left','conditions'=>array('Address.id=CompanyBranchAddress.address_id')),
						array('table'=>'street_codes','alias'=>'StreetCode','type'=>'left','conditions'=>array('Address.street_id=StreetCode.id')),
						array('table'=>'village_codes','alias'=>'VillageCode','type'=>'left','conditions'=>array('Address.village_id=VillageCode.id')),
						array('table'=>'town_city_codes','alias'=>'TownCityCode','type'=>'left','conditions'=>array('Address.town_city_id=TownCityCode.id')),
						array('table'=>'provinces_states_codes','alias'=>'ProvincesStatesCode','type'=>'left','conditions'=>array('Address.province_state_id=ProvincesStatesCode.id')),
						array('table'=>'country_codes','alias'=>'CountryCode','type'=>'left','conditions'=>array('Address.country_id=CountryCode.id'))
				),
				'order' => 'CompanyBranchAddress.company_branch_id'
		));
		$labAddress = Set::combine($labAddress,'{n}.CompanyBranchAddress.company_branch_id','{n}');
		$corpInfo[$branchId]['Address'] = $labAddress;
	
		$this->controller->loadModel('InsuranceProviderProduct');
		$this->controller->InsuranceProviderProduct->unbindAllModel();
		$labHmo = $this->controller->InsuranceProviderProduct->find('all',array(
				'fields' => array('CompanyBranch.id,CompanyBranch.name,Laboratory.company_branch_id','LaboratoryAcceptedInsurance.id','LaboratoryAcceptedInsurance.laboratory_id','LaboratoryAcceptedInsurance.insurance_provider_product_id','LaboratoryAcceptedInsurance.validity_start_date ','LaboratoryAcceptedInsurance.validity_end_time ',
				//				'LaboratoryAcceptedInsurance.accreditation ',
						'InsuranceProviderProduct.id','InsuranceProviderProduct.insurance_provider_id','InsuranceProviderProduct.name','Company.name','Company.id'),
				'conditions' => array('Laboratory.company_branch_id'=>$branchId),
				'joins' => array(
						array('table'=>'laboratory_accepted_insurance','alias'=>'LaboratoryAcceptedInsurance','type'=>'left','conditions'=>array('InsuranceProviderProduct.id=LaboratoryAcceptedInsurance.insurance_provider_product_id')),
						array('table'=>'laboratories','alias'=>'Laboratory','type'=>'left','conditions'=>array('LaboratoryAcceptedInsurance.laboratory_id=Laboratory.id')),
						array('table'=>'insurance_providers','alias'=>'InsuranceProvider','type'=>'left','conditions'=>array('InsuranceProviderProduct.insurance_provider_id=InsuranceProvider.id')),
						array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('InsuranceProvider.company_branch_id=CompanyBranch.id')),
						array('table'=>'companies','alias'=>'Company','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id'))
				),
				'order' => 'Laboratory.company_branch_id'
		));
		//		$labHmo = Set::combine($labHmo,'{n}.Laboratory.company_branch_id','{n}');
		$corpInfo[$branchId]['Hmo'] = $labHmo;
	
		$this->controller->loadModel('Service');
		$this->controller->Service->unbindAllModel();
		$labService = $this->controller->Service->find('all',array(
				'fields' => array('CompanyBranchService.company_branch_id','Service.id','Service.name'),
				'conditions' => array('CompanyBranchService.company_branch_id'=>$branchId,'Service.type = 2'),
				'joins' => array(
						array('table'=>'company_branch_services','alias'=>'CompanyBranchService','type'=>'left','conditions'=>array('Service.id=CompanyBranchService.service_id'))
				),
				'order' => 'CompanyBranchService.company_branch_id'
		));
		$labService = Set::combine($labService,'{n}.CompanyBranchService.company_branch_id','{n}');
		$corpInfo[$branchId]['Services'] = $labService;
	
		$this->controller->loadModel('ContactInformation');
		$this->controller->ContactInformation->unbindAllModel();
		$labContact = $this->controller->ContactInformation->find('all',array(
				'fields' => array('CompanyBranchContactInformation.company_branch_id','ContactInformation.id','ContactInformation.type','ContactInformation.contact'),
				'conditions' => array('CompanyBranchContactInformation.company_branch_id'=>$branchId),
				'joins' => array(
						array('table'=>'company_branch_contact_informations','alias'=>'CompanyBranchContactInformation','type'=>'left','conditions'=>array('ContactInformation.id=CompanyBranchContactInformation.contact_id'))
				)
		));
	
		$labContact = Set::combine($labContact,'{n}.ContactInformation.id','{n}');
		$corpInfo[$branchId]['Contacts'] = $labContact;
	
		$this->controller->loadModel('CompanyBranchContactInformation');
		$this->controller->CompanyBranchContactInformation->unbindAllModel();
		$contactTypes = $this->controller->CompanyBranchContactInformation->types;
		foreach($labContact as $contactId=>$contacts){
			$corpInfo[$branchId]['Contacts'][$contactId] = $labContact[$contactId];
			$corpInfo[$branchId]['Contacts'][$contactId]['ContactInformation']['typename'] = $contactTypes[$contacts['ContactInformation']['type']];
				
		}
	
		$this->controller->loadModel('Accreditation');
		$labAccreditation = $this->controller->Accreditation->find('all',array(
				'fields'=>array('Accreditation.id','Accreditation.name','CompanyBranchAccreditation.id','CompanyBranchAccreditation.accreditation_number','CompanyBranchAccreditation.company_branch_id','CompanyBranchAccreditation.accreditation_date','CompanyBranchAccreditation.accreditation_renewal_date','CompanyBranchAccreditation.accreditation_expiration_date'),
				'conditions'=>array('CompanyBranchAccreditation.company_branch_id'=>$branchId),
				'joins'=>array(
						array('table'=>'company_branch_accreditations','alias'=>'CompanyBranchAccreditation','type'=>'left','conditions'=>array('CompanyBranchAccreditation.accreditation_id=Accreditation.id'))
				)
		));
		//		$labAccreditation = Set::combine($labAccreditation,'{n}.CompanyBranchAccreditation.company_branch_id','{n}');
		$corpInfo[$branchId]['Accreditations'] = $labAccreditation;
	
	
		$this->controller->loadModel('CompanyBranchImage');
		$data = array();
		$data= $this->controller->CompanyBranchImage->find('all',array(
				'fields'=>array(
						'CompanyBranchImage.id',
						'Image.image',
						'Image.thumbnail',
						'CompanyBranchImage.company_branch_id',
						'CompanyBranchImage.title',
						//'CompanyBranchImage.image_id',
						'CompanyBranchImage.description'
				),
				'conditions'=>array(
						'CompanyBranchImage.company_branch_id'=>$branchId
				),
				'order'=>'CompanyBranchImage.entry_datetime',
				'joins'=>array(
						array(
								'table'=>'images',
								'alias'=>'Image',
								'type'=>'left',
								'conditions'=>array(
										'CompanyBranchImage.image_id=Image.id'
								)
						)
				)
		));
	
		$corpInfo[$branchId]['Image'] = $data;
		//		debug($corpInfo);
	
		$labBranches = $this->controller->CompanyBranch->find('all',array(
				'fields' => array('CompanyBranch.id','CompanyBranch.name'),
				'conditions' => array('CompanyBranch.company_id'=>$companyId, 'CompanyBranch.id NOT'=>$branchId)
		));
		$labBranches = Set::combine($labBranches,'{n}.CompanyBranch.id','{n}');
		//		debug($labBranches);
		$corpInfo[$branchId]['Branches'] = $labBranches;
	
		return($corpInfo);
	}
	
	
	public function getLabDetails($labids = null,$filter = array(),$paginate){
//		debug($labids);
		if($paginate==1){	//with pagination
			if($labids){
				
			}
			if($filter){  //laboratory searching with pagination
				if(!empty($filter['Laboratory.name'])){
					$letterFilter = $filter['Laboratory.name']."%";
					unset($filter['Laboratory.name']);
					$info = array_filter($filter,'strlen');
				}
				else{
					$letterFilter = "%";
					unset($filter['Laboratory.name']);
					$info = array_filter($filter,'strlen');
				}
				
				$filterInfo = $filter;
				$this->controller->loadModel('Laboratory');
				$this->controller->paginate = array(
					'limit' => 20,
					'fields'=>array(
						'Laboratory.id',
						'Laboratory.name',
						'Address.floor',
						'Address.unit',
						'Address.building_apartment',
						'Address.street_number',
						'StreetCode.name',
						'VillageCode.name',
						'TownCityCode.name',
						'ProvincesStatesCode.name',
						'CountryCode.name',
						'InsuranceProviderProduct.id',
						'InsuranceProviderProduct.name'
					),
					'conditions' => array(
						$info,
						'Laboratory.id != ""',
						'Laboratory.name LIKE "'.$letterFilter.'"'
					),
					'joins' => array(
						array(
							'table' => 'laboratory_addresses',
							'alias' => 'LaboratoryAddress',
							'type' => 'left',
							'conditions' => array(
								'Laboratory.id = LaboratoryAddress.laboratory_id'
							)
						),
						array(
							'table' => 'addresses',
							'alias' => 'Address',
							'type' => 'left',
							'conditions' => array(
								'LaboratoryAddress.address_id = Address.id'
							)
						),
						array(
							'table' => 'street_codes',
							'alias' => 'StreetCode',
							'type' => 'left',
							'conditions' => array(
								'Address.street_id = StreetCode.id'
							)
						),
						array(
							'table' => 'village_codes',
							'alias' => 'VillageCode',
							'type' => 'left',
							'conditions' => array(
								'Address.village_id = VillageCode.id'
							)
						),
						array(
							'table' => 'town_city_codes',
							'alias' => 'TownCityCode',
							'type' => 'left',
							'conditions' => array(
								'Address.town_city_id = TownCityCode.id'
							)
						),
						array(
							'table' => 'provinces_states_codes',
							'alias' => 'ProvincesStatesCode',
							'type' => 'left',
							'conditions' => array(
								'Address.province_state_id = ProvincesStatesCode.id'
							)
						),
						array(
							'table' => 'country_codes',
							'alias' => 'CountryCode',
							'type' => 'left',
							'conditions' => array(
								'Address.country_id = CountryCode.id'
							)
						),
						array(
							'table' => 'laboratory_accepted_insurance',
							'alias' => 'LaboratoryAcceptedInsurance',
							'type' => 'left',
							'conditions' => array(
								'Laboratory.id = LaboratoryAcceptedInsurance.laboratory_id'
							)
						),
						array(
							'table' => 'insurance_provider_products',
							'alias' => 'InsuranceProviderProduct',
							'type' => 'left',
							'conditions' => array(
								'LaboratoryAcceptedInsurance.insurance_provider_product_id = InsuranceProviderProduct.id'
							)
						),
						array(
							'table' => 'test_groups',
							'alias' => 'LaboratoryTestGroup',
							'type' => 'left',
							'conditions' => array(
								'Laboratory.id = TestGroup.laboratory_id'
							)
						)
					),
					'order'=>'Laboratory.name'
				);
				$labfiltered = $this->controller->paginate('Laboratory');
				return($labfiltered);
			}
		}
		else{     //without pagination
			if($labids){    //get complete laboratory information
				$this->controller->loadModel('Laboratory');
				$labInfo = $this->controller->Laboratory->find('all',array(
					'fields' => array(
						'Laboratory.id',
						'Laboratory.name',
						'Laboratory.website',
						'Laboratory.logo',
						'Laboratory.class',
						'Laboratory.mission',
						'Laboratory.vision',
					),
					'conditions' => array(
						'Laboratory.id'=>$labids
					)
				));
				$labInfo = Set::combine($labInfo,'{n}.Laboratory.id','{n}');
//				debug($labInfo);
				
				$this->controller->loadModel('LaboratoryAddress');
				$addressIds = $this->controller->LaboratoryAddress->find('list', array(
					'fields' => array(
						'id'
					)
				));
				$this->controller->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'),false);
				$labAddress = $this->controller->Address->find('all',array(
					'fields' => array(
						'Address.id',
						'Address.floor',
						'Address.unit',
						'Address.building_apartment',
						'Address.street_number',
						'StreetCode.id',
						'StreetCode.name',
						'VillageCode.id',
						'VillageCode.name',
						'TownCityCode.id',
						'TownCityCode.name',
						'ProvincesStatesCode.id',
						'ProvincesStatesCode.name',
						'CountryCode.id',
						'CountryCode.name',
					),
					'conditions' => array(
						'Laboratory.id'=>$labids
					),
					'joins' => array(
						array(
							'table' => 'laboratory_addresses',
							'alias' => 'LaboratoryAddress',
							'type' => 'left',
							'conditions' => array(
								'Address.id = LaboratoryAddress.address_id'
							)
						),
						array(
							'table' => 'laboratories',
							'alias' => 'Laboratory',
							'type' => 'left',
							'conditions' => array(
								'LaboratoryAddress.laboratory_id = Laboratory.id'
							)
						)
					)
				));
				$labAddress = Set::combine($labAddress,'{n}.Address.id','{n}');
//				debug($labAddress);
				foreach($labAddress as $addressId=>$address){
					$labInfo[$labids]['Addresses'][$addressId] = $labAddress[$addressId];
				}
//				debug($labInfo);
				
				$this->controller->LaboratoryTestGroup->unbindAllModel(array('LaboratoryTestGroupPrice'),false);
				
				$labTests = $this->controller->LaboratoryTestGroup->find('all',array(
					'fields' => array(
						'LaboratoryTestGroup.id',
						'LaboratoryTestGroup.name',
						'LaboratoryTestGroupPrice.price'
					),
					'conditions' => array(
						'LaboratoryTestGroup.laboratory_id = '.$labids
					),
					'joins' => array(
						array(
							'table' => 'test_group_prices',
							'alias' => 'LaboratoryTestGroupPrice',
							'type' => 'left',
							'conditions' => array(
								'LaboratoryTestGroup.id = TestGroupPrice.test_group_id'
							)
						)
					)
				));
				$labTests = Set::combine($labTests,'{n}.TestGroup.id','{n}');
//				debug($labTests);
				foreach($labTests as $testId=>$tests){
					$labInfo[$labids]['LaboratoryTests'][$testId] = $labTests[$testId];
				}
				
				$this->controller->loadModel('ContactInformation');
				$labContacts = $this->controller->ContactInformation->find('all',array(
					'fields' => array(
						'ContactInformation.id',
						'ContactInformation.type',
						'ContactInformation.contact'
					),
					'conditions' => array(
						'LaboratoryContactInformation.laboratory_id'=>$labids
					),
					'joins' => array(
						array(
							'table' => 'laboratory_contact_informations',
							'alias' => 'LaboratoryContactInformation',
							'type' => 'left',
							'conditions' => array(
								'ContactInformation.id = LaboratoryContactInformation.contact_id'
							)
						)
					)
				));
				$contactTypes = $this->controller->ContactInformation->types;
				foreach($labContacts as $contactId=>$contacts){
					$labInfo[$labids]['Contact'][$contactId] = $labContacts[$contactId];
					$labInfo[$labids]['Contact'][$contactId]['ContactInformation']['typename'] = $contactTypes[$contacts['ContactInformation']['type']];
					
				}
				
				$this->controller->loadModel('InsuranceProvider');
				$labHmo = $this->controller->InsuranceProvider->find('all',array(
					'fields' => array(
						'InsuranceProviderProduct.name',
						'InsuranceProviderProduct.id',
						'InsuranceProvider.name',
						'InsuranceProvider.id',
						'LaboratoryAcceptedInsurance.id',
						'LaboratoryAcceptedInsurance.insurance_provider_product_id',
						'LaboratoryAcceptedInsurance.laboratory_id',
						'LaboratoryAcceptedInsurance.validity_start_date',
						'LaboratoryAcceptedInsurance.validity_end_time',
						'LaboratoryAcceptedInsurance.remarks',
//						'LaboratoryAcceptedInsurance.accreditation'
					),
					'conditions' => array(
						'LaboratoryAcceptedInsurance.laboratory_id'=>$labids
					),
					'joins' => array(
						array(
							'table' => 'insurance_provider_products',
							'alias' => 'InsuranceProviderProduct',
							'type' => 'left',
							'conditions' => array(
								'InsuranceProvider.id = InsuranceProviderProduct.insurance_provider_id'
							)
						),
						array(
							'table' => 'laboratory_accepted_insurance',
							'alias' => 'LaboratoryAcceptedInsurance',
							'type' => 'left',
							'conditions' => array(
								'InsuranceProviderProduct.id = LaboratoryAcceptedInsurance.insurance_provider_product_id'
							)
						)
					)
				));
				foreach($labHmo as $hmoId=>$hmo){
					$labInfo[$labids]['Hmo'][$hmoId] = $labHmo[$hmoId];
				}
//				debug($labInfo);
				return($labInfo);
			}
		}
		
	}
	
	public function getPhysicianDetails($physicianid = null,$physicianFilter = array(),$paginate){
		if($paginate==1){
			if($physicianid){
				
			}
			if($physicianFilter){
				if(!empty($physicianFilter['People.lastname'])){
					$letterFilter = $physicianFilter['People.lastname']."%";
					unset($physicianFilter['People.lastname']);
					$info = array_filter($physicianFilter,'strlen');
				}
				else{
					$letterFilter = "%";
					unset($physicianFilter['People.lastname']);
					$info = array_filter($physicianFilter,'strlen');
				}
				
				$this->controller->loadModel('People');
				$this->controller->paginate = array(
					'limit' => 20,
					'fields' => array(
						'People.id',
						'TitleCode.display',
						'People.firstname',
						'People.middlename',
						'People.lastname',
						'People.image',
						'Address.floor',
						'Address.unit',
						'Address.building_apartment',
						'Address.street_number',
						'StreetCode.name',
						'VillageCode.name',
						'TownCityCode.name',
						'ProvincesStatesCode.name',
						'CountryCode.name'
					),
					'conditions' => array(
						$info,
						'People.lastname LIKE "'.$letterFilter.'"'
					),
					'joins' => array(
						array(
							'table' => 'title_codes',
							'alias' => 'TitleCode',
							'type' => 'left',
							'conditions' => array(
								'People.title_id = TitleCode.id'
							)
						),
						array(
							'table' => 'person_identities',
							'alias' => 'PersonIdentity',
							'type' => 'left',
							'conditions' => array(
								'People.id = PersonIdentity.person_id'
							)
						),
						array(
							'table' => 'users',
							'alias' => 'User',
							'type' => 'left',
							'conditions' => array(
								'PersonIdentity.users_id = User.id'
							)
						),
						array(
							'table' => 'person_addresses',
							'alias' => 'PersonAddress',
							'type' => 'left',
							'conditions' => array(
								'People.id = PersonAddress.person_id'
							)
						),
						array(
							'table' => 'addresses',
							'alias' => 'Address',
							'type' => 'left',
							'conditions' => array(
								'PersonAddress.address_id = Address.id'
							)
						),
						array(
							'table' => 'street_codes',
							'alias' => 'StreetCode',
							'type' => 'left',
							'conditions' => array(
								'Address.street_id = StreetCode.id'
							)
						),
						array(
							'table' => 'village_codes',
							'alias' => 'VillageCode',
							'type' => 'left',
							'conditions' => array(
								'Address.village_id = VillageCode.id'
							)
						),
						array(
							'table' => 'town_city_codes',
							'alias' => 'TownCityCode',
							'type' => 'left',
							'conditions' => array(
								'Address.town_city_id = TownCityCode.id'
							)
						),
						array(
							'table' => 'provinces_states_codes',
							'alias' => 'ProvincesStatesCode',
							'type' => 'left',
							'conditions' => array(
								'Address.province_state_id = ProvincesStatesCode.id'
							)
						),
						array(
							'table' => 'country_codes',
							'alias' => 'CountryCode',
							'type' => 'left',
							'conditions' => array(
								'Address.country_id = CountryCode.id'
							)
						),
						array(
							'table' => 'person_insurance',
							'alias' => 'PersonInsurance',
							'type' => 'left',
							'conditions' => array(
								'People.id = PersonInsurance.person_id'
							)
						),
						array(
							'table' => 'insurance_provider_products',
							'alias' => 'InsuranceProviderProduct',
							'type' => 'left',
							'conditions' => array(
								'PersonInsurance.insurance_provider_product_id = InsuranceProviderProduct.id'
							)
						),
						array(
							'table' => 'insurance_providers',
							'alias' => 'InsuranceProvider',
							'type' => 'left',
							'conditions' => array(
								'InsuranceProviderProduct.insurance_provider_id = InsuranceProvider.id'
							)
						)
					),
					'group' =>'People.id',
					'order' => 'People.lastname'
				);
				
				$filteredDoctor = $this->controller->paginate('People');
				return($filteredDoctor);
				
			}
		}
		else{   //without pagination
			if($physicianid){  //get physician information
				$this->controller->loadModel('People');
				$physicianInfo = $this->controller->People->find('all',array(
					'fields' => array(
						'People.id',
						'People.myresultonline_id',
						'People.title_id',
						'People.lastname',
						'People.firstname',
						'People.middlename',
						'People.birthdate',
						'People.sex',
						'People.marital_status',
						'People.image',
						'User.username'
					),
					'conditions' => array(
						'People.id'=>$physicianid,
						'User.role = 6'
					),
					'joins' => array(
						array(
							'table' => 'person_identities',
							'alias' => 'PersonIdentity',
							'type' => 'left',
							'conditions' => array(
								'People.id = PersonIdentity.person_id'
							)
						),
						array(
							'table' => 'users',
							'alias' => 'User',
							'type' => 'left',
							'conditions' => array(
								'PersonIdentity.users_id = User.id'
							)
						),
					)
				));
				$physicianInfo = Set::combine($physicianInfo,'{n}.People.id','{n}');
//				return($physicianInfo);

				$this->controller->loadModel('InsuranceProvider');
				$this->controller->InsuranceProvider->recursive=-1;
				$physicianHmo = $this->controller->InsuranceProvider->find('all',array(
					'fields' => array(
						'InsuranceProvider.name',
						'InsuranceProviderProduct.name'
					),
					'conditions' => array(
						'People.id'=>$physicianid
					),
					'joins' => array(
						array(
							'table' => 'insurance_provider_products',
							'alias' => 'InsuranceProviderProduct',
							'type' => 'left',
							'conditions' => array(
								'InsuranceProvider.id = InsuranceProviderProduct.insurance_provider_id'
							)
						),
						array(
							'table' => 'person_insurance',
							'alias' => 'PersonInsurance',
							'type' => 'left',
							'conditions' => array(
								'InsuranceProviderProduct.id = PersonInsurance.insurance_provider_product_id'
							)
						),
						array(
							'table' => 'people',
							'alias' => 'People',
							'type' => 'left',
							'conditions' => array(
								'PersonInsurance.person_id = People.id'
							)
						)
					)
				));
//				return($physicianHmo);

				$this->controller->loadModel('Member');
				$physicianLabs = $this->controller->Member->find('all',array(
					'fields' => array(
						'Laboratory.id',
						'Laboratory.name',
						'VillageCode.name',
						'TownCityCode.name',
						'ProvincesStatesCode.name'
					),
					'conditions' => array(
						'Member.users_id'=>$physicianid
					),
					'joins' => array(
						array(
							'table' => 'laboratories',
							'alias' => 'Laboratory',
							'type' => 'left',
							'conditions' => array(
								'Laboratory.id = Member.laboratory_id'
							)
						),
						array(
							'table' => 'laboratory_addresses',
							'alias' => 'LaboratoryAddress',
							'type' => 'left',
							'conditions' => array(
								'Laboratory.id = LaboratoryAddress.laboratory_id'
							)
						),
						array(
							'table' => 'addresses',
							'alias' => 'Address',
							'type' => 'left',
							'conditions' => array(
								'LaboratoryAddress.address_id = Address.id'
							)
						),
						array(
							'table' => 'village_codes',
							'alias' => 'VillageCode',
							'type' => 'left',
							'conditions' => array(
								'Address.village_id = VillageCode.id'
							)
						),
						array(
							'table' => 'town_city_codes',
							'alias' => 'TownCityCode',
							'type' => 'left',
							'conditions' => array(
								'Address.town_city_id = TownCityCode.id'
							)
						),
						array(
							'table' => 'provinces_states_codes',
							'alias' => 'ProvincesStatesCode',
							'type' => 'left',
							'conditions' => array(
								'Address.province_state_id = ProvincesStatesCode.id'
							)
						)
					)
				));
			}
		}
	}
	function getRecentActivities($userid = array(),$mo,$userid,$models = array(),$options = array()){
		
		$this->controller->loadModel('PostContent');
		$this->controller->PostContent->unbindAllModel($models,false);
		$postDetailOptions = array(
			'conditions' => array(
				'PostContent.user_id' => $userid,
				'PostContent.entry_datetime LIKE' => $mo.'%',
			),
			'order'=>'PostContent.entry_datetime DESC'
		);
		
		if(!empty($options) && is_array($options))
			$postDetailOptions = array_merge_recursive($postDetailOptions,$options);

		$postDetails = $this->controller->PostContent->find('all',$postDetailOptions);
		
//		$postDetails = Set::combine($postDetails,'{n}.PostContent.id','{n}','{n}.PostContent.post_id');
		$postDetails = Set::combine($postDetails,'{n}.PostContent.entry_datetime','{n}');
		return $postDetails;
		
	}
	function getCompanyDetails($id=null,$option=array(),$condition=array()){
		$this->controller->loadModel('Company');
		$this->controller->loadModel('CompanyBranch');
		$this->controller->Company->unbindAllModel($option);
		$companyDetail = current($this->controller->Company->find('all',array(
			'conditions'=>array('Company.id'=>$id),
		)));
		//Include CompanyBranch
		if(in_array('CompanyBranch',$option)){
			$this->controller->Company->recursive = 0;
			
			$companyDetailTmp = array();
			$companyDetailTmp['Company'] = $companyDetail['Company'];
			
			foreach($companyDetail['CompanyBranch'] as $key=>$value){
				//Include CompanyBranchInfo
				if(in_array('CompanyBranchInfo',$option)){
					$this->controller->loadModel('CompanyBranchInfo');
					$companyDetailTmp['CompanyBranchDetail'][$value['id']] = $this->controller->CompanyBranchInfo->find('first',array(
						'conditions'=>array('CompanyBranchInfo.company_branch_id'=>$value['id'])
					));
				}else{
					$companyDetailTmp['CompanyBranchDetail'][$value['id']]['CompanyBranch'] = $value;
				}
				//IncludeCompanyAddresses
				if(in_array('CompanyBranchAddress',$option)){
					$this->controller->loadModel('CompanyBranchAddress');
					$this->controller->loadModel('Address');
					$this->controller->CompanyBranchAddress->unbindAllModel();
					$companyDetailTmp['CompanyBranchDetail'][$value['id']]['CompanyBranchAddress'] = $this->controller->CompanyBranchAddress->find('first',array(
						'fields'=>array('CompanyBranchAddress.id','CompanyBranchAddress.company_branch_id','CompanyBranchAddress.address_id','Address.*','ProvinceStatesCode.name','TownCityCode.name','VillageCode.name'),
						'conditions'=>array('CompanyBranchAddress.company_branch_id'=>$value['id']),
						'joins'=>array(
							array(
								'table' => 'addresses',
								'alias' => 'Address',
								'type' => 'left',
								'conditions' => array(
									'CompanyBranchAddress.address_id = Address.id'
								)
							),
							array(
								'table' => 'provinces_states_codes',
								'alias' => 'ProvinceStatesCode',
								'type' => 'left',
								'conditions' => array(
									'ProvinceStatesCode.id = Address.province_state_id'
								)
							),
							array(
								'table' => 'town_city_codes',
								'alias' => 'TownCityCode',
								'type' => 'left',
								'conditions' => array(
									'TownCityCode.id = Address.town_city_id'
								)
							),
							array(
								'table' => 'village_codes',
								'alias' => 'VillageCode',
								'type' => 'left',
								'conditions' => array(
									'VillageCode.id = Address.village_id'
								)
							)
						)
					));
				}
				if(in_array('CompanyBranchContactInformation',$option)){
					$this->controller->loadModel('CompanyBranchContactInformation');
					$this->controller->loadModel('ContactInformation');
					$this->controller->CompanyBranchContactInformation->unbindAllModel(array('ContactInformation'));
					$companyDetailTmp['CompanyBranchDetail'][$value['id']]['CompanyBranchContactInformation'] = $this->controller->CompanyBranchContactInformation->find('all',array(
//						'fields'=>array('ContactInformation.*'),
						'conditions'=>array('CompanyBranchContactInformation.company_branch_id'=>$value['id']),
					));
				}
			}
			$companyDetails = $companyDetailTmp;
		}else{
			$companyDetails = $companyDetail;
		}
		return $companyDetails;
	
	}
	
	public function getCorporateDetails2($branchId=null){
		$corpDetails = array();
		//Company
		$this->controller->loadModel('Company');
		$this->controller->Company->unbindAllModel();
		$compId = $this->controller->Company->find('first',array(
				'fields' => array('Company.id','Company.name','Company.logo','Company.website','Company.validated'),
				'conditions' => array('CompanyBranch.id'=>$branchId),
				'joins' => array(
						array('table'=>'company_branches','alias'=>'CompanyBranch','type'=>'left','conditions'=>array('CompanyBranch.company_id=Company.id')),
				)
		));
		// 		debug($compId);
		$companyId = $compId['Company']['id'];
		//Company Branch
		$this->controller->loadModel('CompanyBranch');
		$this->controller->CompanyBranch->unbindAllModel(array(),true);
		$corpInfo = $this->controller->CompanyBranch->find('all',array(
				'fields' => array('CompanyBranch.id','CompanyBranch.name','CompanyBranchInfo.id','CompanyBranchInfo.logo','CompanyBranchInfo.mission','CompanyBranchInfo.vision','CompanyBranchInfo.website'),
				'conditions' => array('CompanyBranch.id'=>$branchId),
				'joins' => array(
						array('table'=>'company_branch_info','alias'=>'CompanyBranchInfo','type'=>'left','conditions'=>array('CompanyBranch.id=CompanyBranchInfo.company_branch_id'))
				)
		));
		
		$corpInfo = Set::combine($corpInfo,'{n}.CompanyBranch.id','{n}');
		$corpInfo[$branchId]['Company'] = $compId['Company'];
		//Company Branch CorporateAccount
		$this->controller->loadModel('CorporateAccount');
		$this->controller->CorporateAccount->unbindAllModel();
		$corpInfos = current($this->controller->CorporateAccount->find('all',array(
				'fields' => array('CorporateAccount.id','CorporateAccount.type','CorporateAccount.class'),
				'conditions' => array('CorporateAccount.company_branch_id'=>$branchId),
		))
		);
		$corpInfo[$branchId]['CorporateAccount'] = $corpInfos['CorporateAccount'];

		$this->controller->loadModel('CompanyBranchAddress');
		$this->controller->CompanyBranchAddress->unbindAllModel();
		$corpAddress = $this->controller->CompanyBranchAddress->find('all',array(
				'fields' => array('CompanyBranchAddress.id','CompanyBranchAddress.company_branch_id','Address.id','Address.latitude','Address.longtitude','Address.id','Address.lot','Address.block','Address.floor','Address.unit','Address.building_apartment','Address.street_number','StreetCode.id','StreetCode.name','VillageCode.id','VillageCode.name','TownCityCode.id','TownCityCode.name','ProvincesStatesCode.id','ProvincesStatesCode.name'),
				'conditions' => array('CompanyBranchAddress.company_branch_id'=>$branchId),
				'joins' => array(
						array('table'=>'addresses','alias'=>'Address','type'=>'left','conditions'=>array('Address.id=CompanyBranchAddress.address_id')),
						array('table'=>'street_codes','alias'=>'StreetCode','type'=>'left','conditions'=>array('Address.street_id=StreetCode.id')),
						array('table'=>'village_codes','alias'=>'VillageCode','type'=>'left','conditions'=>array('Address.village_id=VillageCode.id')),
						array('table'=>'town_city_codes','alias'=>'TownCityCode','type'=>'left','conditions'=>array('Address.town_city_id=TownCityCode.id')),
						array('table'=>'provinces_states_codes','alias'=>'ProvincesStatesCode','type'=>'left','conditions'=>array('Address.province_state_id=ProvincesStatesCode.id')),
						array('table'=>'country_codes','alias'=>'CountryCode','type'=>'left','conditions'=>array('Address.country_id=CountryCode.id'))
				),
				'order' => 'CompanyBranchAddress.company_branch_id'
		));
		$corpAddress = Set::combine($corpAddress,'{n}.CompanyBranchAddress.company_branch_id','{n}');
		$corpInfo[$branchId]['Address'] = $corpAddress;
		
		$this->controller->loadModel('ContactInformation');
		$this->controller->ContactInformation->unbindAllModel();
		$corpContact = $this->controller->ContactInformation->find('all',array(
				'fields' => array('CompanyBranchContactInformation.company_branch_id','ContactInformation.id','ContactInformation.type','ContactInformation.contact'),
				'conditions' => array('CompanyBranchContactInformation.company_branch_id'=>$branchId),
				'joins' => array(
						array('table'=>'company_branch_contact_informations','alias'=>'CompanyBranchContactInformation','type'=>'left','conditions'=>array('ContactInformation.id=CompanyBranchContactInformation.contact_id'))
				)
		));
		
		$corpContact = Set::combine($corpContact,'{n}.ContactInformation.id','{n}');
		$corpInfo[$branchId]['Contacts'] = $corpContact;
		
		$this->controller->loadModel('CompanyBranchContactInformation');
		$this->controller->CompanyBranchContactInformation->unbindAllModel();
		$contactTypes = $this->controller->CompanyBranchContactInformation->types;
		foreach($corpContact as $contactId=>$contacts){
			$corpInfo[$branchId]['Contacts'][$contactId] = $corpContact[$contactId];
			$corpInfo[$branchId]['Contacts'][$contactId]['ContactInformation']['typename'] = $contactTypes[$contacts['ContactInformation']['type']];
				
		}
		
		
		$this->controller->loadModel('CompanyBranchImage');
		$data = array();
		$data= $this->controller->CompanyBranchImage->find('all',array(
				'fields'=>array(
						'CompanyBranchImage.id',
						'Image.image',
						'Image.thumbnail',
						'CompanyBranchImage.company_branch_id',
						'CompanyBranchImage.title',
						//'CompanyBranchImage.image_id',
						'CompanyBranchImage.description'
				),
				'conditions'=>array(
						'CompanyBranchImage.company_branch_id'=>$branchId
				),
				'order'=>'CompanyBranchImage.entry_datetime',
				'joins'=>array(
						array(
								'table'=>'images',
								'alias'=>'Image',
								'type'=>'left',
								'conditions'=>array(
										'CompanyBranchImage.image_id=Image.id'
								)
						)
				)
		));
		
		$corpInfo[$branchId]['Image'] = $data;
		//		debug($corpInfo);
		
		$corpBranches = $this->controller->CompanyBranch->find('all',array(
				'fields' => array('CompanyBranch.id','CompanyBranch.name'),
				'conditions' => array('CompanyBranch.company_id'=>$companyId, 'CompanyBranch.id NOT'=>$branchId)
		));
		$corpBranches = Set::combine($corpBranches,'{n}.CompanyBranch.id','{n}');
		//		debug($corpBranches);
		$corpInfo[$branchId]['Branches'] = $corpBranches;
		
		return($corpInfo);
		
	}
	
}
