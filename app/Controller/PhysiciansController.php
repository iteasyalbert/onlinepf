<?php
App::uses('AppController', 'Controller');
class PhysiciansController extends AppController {
	var $uses = array('Patient','Physician','StreetCode','VillageCode','TownCityCode','ProvincialRegion','LaboratoryTestGroup','LaboratoryTestGroupPrice','InsuranceProviderProduct','Address','LaboratoryAddress','Laboratory','ProvincesStatesCode','ContactInformation','LaboratoryContactInformation');
	public $components = array('RequestHandler','HCWService','PaginatorArray','Common');
	function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function physician_profile(){
		// $this->log($this->Session->read('User.isAuthorized'), 'now');
		// $this->log($this->Session->read('User'), 'now');
		$this->layout = Configure::read('page_layout');
		if(!$this->Session->read('User.isAuthorized')){
			$this->redirect('/users/signout');
		}
	}

	public function getPatientOrders($page=null){
		$this->layout = false;
		// $this->log($this->data, 'myrequest');
		$myrequest = array();
		$myrequest['error']['message'] = "";
		$myrequest['error']['status'] = false;
		try {
			ini_set('default_socket_timeout', 10);
			
			$HttpSocket = new HttpSocket();
			$data = $this->data;

            $request = array(
            				'header' => array(
            					'Accept'=>'application/json',
            					'Content-Type' => 'application/json',
            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token'),
							),
						);
            // $data = json_encode($data);
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/physician/get_patients?page='.$page, $data,$request);
            $this->log(json_decode($response), 'apirespo_get_px_orders');
            $decoded_respo = json_decode($response);
            if($decoded_respo->success){
            	$filter = "";
				foreach ($this->data as $key => $value) {
					$filter .= $key.'='.$value;
				}
            	$send_audit = $this->addAuditLog('get_patient_orders',array(
					'success'=>true,
					'message'=>(empty($filter)?count($decoded_respo->data->data).' result(s) found using default filter.':count($decoded_respo->data->data).' result(s) found using filter '.$filter)
				));
		    	try {
					ini_set('default_socket_timeout', 10);
					
					$HttpSocket = new HttpSocket();
					$data = $send_audit;
		            $request = array(
										'header' => array('Content-Type' => 'application/json','Accept'=>'application/json',
									),
								);
		            $data = json_encode($data);
		            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				} catch (Exception $e) {
					$this->log($e->getMessage(), 'apirespo_audit_log');
				}
            	
            	$myrequest['data'] = $decoded_respo->data;
            }else{
            	$send_audit = $this->addAuditLog('get_patient_orders',array(
					'success'=>false,
					'message'=>$decoded_respo->message
				));
		    	try {
					ini_set('default_socket_timeout', 10);
					
					$HttpSocket = new HttpSocket();
					$data = $send_audit;
		            $request = array(
										'header' => array('Content-Type' => 'application/json','Accept'=>'application/json',
									),
								);
		            $data = json_encode($data);
		            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				} catch (Exception $e) {
					$this->log($e->getMessage(), 'apirespo_audit_log');
				}
            	$myrequest['error']['message'] = $decoded_respo->message;
            	$myrequest['error']['status'] = true;
            }
		} catch (Exception $e) {
			$myrequest['error']['message'] = $e->getMessage();
			$myrequest['error']['status'] = true;
			$this->log($e->getMessage(), 'apirespo_get_px_orders');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}

	public function getPrevResult(){
		$this->layout = false;
		// $this->log($this->data, 'myrequest');
		// $myrequest = array(
		//     'patient_id' => '000000000903258',
		//     'specimen_id' => '0000701348',
		//     'test_group_id' => 'hematologycbc',
		//     'release_date' => '2019-05-08'
		// );
		$myrequest = array();
		
		$myrequest['error']['message'] = "";
		$myrequest['error']['status'] = false;
		try {
			ini_set('default_socket_timeout', 10);
			
			$HttpSocket = new HttpSocket();
			$data = $this->data;

            $request = array(
										'header' => array('Content-Type' => 'application/json','Accept'=>'application/json',
									),
								);
		    // $data = json_encode($data);
            $response = $HttpSocket->get(Configure::read('get_prev_result_url').$this->data['patient_id'].'/'.$this->data['specimen_id'].'/'.$this->data['test_group_id'].'/'.$this->data['release_date'], $request);
            $this->log($response, 'apirespo_get_prev_result');
            $myrequest['data'] = json_decode($response);
		} catch (Exception $e) {
			$myrequest['error']['message'] = $e->getMessage();
			$myrequest['error']['status'] = true;
			$this->log($e->getMessage(), 'apirespo_get_prev_result');
		}
    	$this->set('data', $response);
    	// $this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}

	public function physician_viewPdfMro($filename=null){
		$this->response->file(WWW_ROOT.DS.'media/pdf/'.DS.$filename.'.pdf');
		//     	$this->response->file('webroot/media/pdf'.DS.$filename.'.pdf');
		$this->response->header('Content-Disposition', 'inline');
		return $this->response; 
	}
	
	/*public function physician_viewPdfMumps($filename=null){
		$config = Configure::read('mumps');
		//     	$this->response->file($config['weblis.pdfurl'].DS.$filename);
		$this->response->header('Location', $config['weblis.pdfurl'].DS.$filename);
		//     	$this->response->file('webroot/media/pdf'.DS.$filename.'.pdf');
		//     	$this->response->header('Content-Disposition', 'inline');
		return $this->response;
	
	
	
	}*/
	
	public function viewPdfStream($filename=null){
	
		$allowedEpisodes = $this->Session->read('allowedEpisode');
		ini_set('memory_limit', '512M');
		//     	debug($this->Auth->user('id'));
	
		if(in_array($filename, $allowedEpisodes)){
			$config = Configure::read('mumps');
	
			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();
			$results = $HttpSocket->get(
					$config['weblis.pdfurl'].'/'.$filename
					/* array(
					 'specimen_id' => $filename
					) */
			);
	
						$this->log($results,'1234');
			// 				$fp = fopen(WWW_ROOT.'media/pdf/'."$specimen_id.pdf", 'w');
			// 				fwrite($fp, $results);
			// 				fclose($fp);
	
			$pdflen = strlen($results);
	
			//telling the browser about the pdf document
			// 	    	header("Content-type: application/pdf");
			// 	    	header("Content-length: $pdflen");
			// 	    	header("Content-Disposition: inline; filename=$filename.pdf");
	/* 		$this->addAuditLog('physician.view_patient_order',array(
	    					'specimen_id'=>$filename,//specimen_id
	    			)); */
/* 			$patientTests = $this->Session->read('patientTests');
			$this->addAuditLog('physician.view_patient_order',array(
					'specimen_id'=>$filename,//specimen_id
					'tests'=>$patientTests['PatientOrder.test'][$filename]
			)); */
			
			$patientTests = $this->Session->read('patientTests');
			$patientEpisodesNumber = $this->Session->read('patientEpisodesNumber');
			$this->addAuditLog('physician.view_patient_order',array(
// 					'patient_mrn'=>$patientEpisodesNumber[$filename],
					'patient_mrn'=>str_replace("-", "", $patientEpisodesNumber[$filename]),
					'episode_number'=>$filename,//specimen_id
					'tests'=>$patientTests['PatientOrder.test'][$filename]
			));
			
			
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			// 	    	header("Content-Description: File Transfer");
			header("Content-Type: application/pdf");
			header("Content-length: $pdflen");
			header("Content-Disposition: inline; filename=$filename.pdf");
			// 	    	header("Content-Transfer-Encoding: binary");
			//output the document
			print($results);
		}else{
			//     		print("<html><body><h2>You're not allowed to access this file.</h2></body></html>");
			$this->render('/Errors/error400', 404);
		}
	
	
	}
	public function physician_viewPdf($filename=null){
    	if($this->RequestHandler->isAjax()){
    		$success = false;
    		$pathurl = "";
	    	$allowedEpisodes = $this->Session->read('allowedEpisode');
	    	ini_set('memory_limit', '512M');
	    	//     	debug($this->Auth->user('id'));
	    
	    	if(in_array($filename, $allowedEpisodes)){
	    		$config = Configure::read('mumps');
	    
	    		App::uses('HttpSocket', 'Network/Http');
	    		$HttpSocket = new HttpSocket();
	    		$results = $HttpSocket->get(
	    				$config['weblis.pdfurl'].'/'.$filename
	    				/* array(
	    				 'specimen_id' => $filename
	    				) */
	    		);
	    		try{
	    			$fp = fopen(WWW_ROOT.'media/pdf/'."$filename.pdf", 'w');
	    			fwrite($fp, $results);
	    			fclose($fp);
	    			$pathurl = 'media/pdf/'."$filename.pdf";
	    			$success = true;
	    			/* $this->addAuditLog('physician.view_patient_order',array(
	    					'specimen_id'=>$filename,//specimen_id
	    			)); */
	    			/* $patientTests = $this->Session->read('patientTests');
	    			$this->addAuditLog('physician.view_patient_order',array(
	    					'specimen_id'=>$filename,//specimen_id
	    					'tests'=>$patientTests['PatientOrder.test'][$filename]
	    			)); */
	    			
	    			$patientTests = $this->Session->read('patientTests');
	    			$patientEpisodesNumber = $this->Session->read('patientEpisodesNumber');
	    			$this->addAuditLog('physician.view_patient_order',array(
// 	    					'patient_mrn'=>$patientEpisodesNumber[$filename],
	    					'patient_mrn'=>str_replace("-", "", $patientEpisodesNumber[$filename]),
	    					'episode_number'=>$filename,//specimen_id
	    					'tests'=>$patientTests['PatientOrder.test'][$filename]
	    			));
	    		}catch (Exception $e) {
	    			$success = false;
				    $this->log($e->getMessage(),'debug');
				}
	    		
	    		
	    		/* $pdflen = strlen($results);
	    		header('Content-Description: File Transfer');
			    header('Content-Type: application/pdf');
			    header('Content-Disposition: inline; filename='.$filename);
			    header('Content-Transfer-Encoding: binary');
			    header('Accept-Ranges: bytes');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Pragma: public');
			    header('Content-Length: ' . $pdflen); */

	    		    		
// 	    		print($results);
	    		
	    	}else{
	    		$this->render('/Errors/error400', 404);
	    	}
	    	$this->set('data',$pathurl);
	    	$this->header('Content-Type: text/json');
	    	$this->render('/Common/json');
    	}
    
    
    }
	
    public function removePdf($filename=null){
    	if($this->RequestHandler->isAjax()){
    		$success = false;
    		ini_set('memory_limit', '512M');
    		 
    		$pathurl = WWW_ROOT.'media/pdf/'."$filename.pdf";
    		//$this->log($pathurl,'unlink');
    		if(file_exists($pathurl)){
    			unlink($pathurl);
    			//$this->log($pathurl,'unlink');
    			$success = true;
    		}
    		 
    		$this->set('data',$success);
    		$this->header('Content-Type: text/json');
    		$this->render('/Common/json');
    	}
    
    }
   	
	public function physician_profession(){
		if($this->RequestHandler->isAjax()){
			//$this->log($this->data,'teodybear');
			$this->layout = '';
			$result = true;
			$this->loadModel('PersonEducationalBackground');
			$this->loadModel('PhysicianProfile');
			if($this->data['PersonEducationalBackground'])
				if(!$this->PersonEducationalBackground->save($this->data['PersonEducationalBackground']))
					$result = false;
			if($this->data['PhysicianProfile'])
				if(!$this->PhysicianProfile->save($this->data['PhysicianProfile']))
					$result = false;

			$this->set('data',(string)$result);
	    	$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
	}
	
	public function search(){
		
		$addressFilter = false;
		$hmoFilter = false;
		$majorFilter = false;
		$hospFilter = false;
		
		$userid = $this->Auth->user('id');
		$user_role = $this->Auth->user('role');
		$this->loadModel('PersonAddress');
		$this->loadModel('PersonInsurance');
		$this->loadModel('Address');
//		if($this->Session->check('Auth.Person.'.$userid)){
		if(!empty($userid) && empty($this->data['Address']['province_state_id']) && empty($this->data['InsuranceProviderProduct']['id']) && empty($this->data['CompanyBranch']['id']) && empty($this->data['PersonEducationalBackground']['education_major_id'])){
			if($user_role==6 || $user_role==9){
				$currentPerson = $this->Session->read('Auth.Person.'.$userid);
				$this->PersonInsurance->unbindAllModel(array(),true);
				$currentPersonHmo = $this->PersonInsurance->find('first',array(
					'fields' => array('insurance_provider_product_id'),
					'conditions' => array(
						'person_id' => $currentPerson['id']
					)
				));
				
				if(isset($currentPersonHmo['PersonInsurance']['insurance_provider_product_id']) && strlen($currentPersonHmo['PersonInsurance']['insurance_provider_product_id']))
					if(!isset($this->request->data['InsuranceProviderProduct']['id']) || strlen($this->request->data['InsuranceProviderProduct']['id']) == 0)
						$this->request->data['InsuranceProviderProduct']['id']= $currentPersonHmo['PersonInsurance']['insurance_provider_product_id'];
				
				$currentPersonAddress = $this->PersonAddress->find('first',array(
					'fields' => array('address_id'),
					'conditions' => array(
						'person_id' => $currentPerson['id']
					),
				));
				if(isset($currentPersonAddress['PersonAddress']['address_id']) && strlen($currentPersonAddress['PersonAddress']['address_id'])){
					$this->Address->unbindAllModel(array(),true);
					$currentAddress = $this->Address->find('first',array(
						'fields' => array('province_state_id','town_city_id','village_id'),
						'conditions' => array(
							'id' => $currentPersonAddress['PersonAddress']['address_id']
						)
					));
					
					if(!isset($this->request->data['Address']['province_state_id']) || strlen($this->request->data['Address']['province_state_id']) == 0)
						$this->request->data['Address']['province_state_id'] = $currentAddress['Address']['province_state_id'];
					if(!isset($this->request->data['Address']['town_city_id']) || strlen($this->request->data['Address']['town_city_id']) == 0)
						$this->request->data['Address']['town_city_id'] = $currentAddress['Address']['town_city_id'];
					if(!isset($this->request->data['Address']['village_id']) || strlen($this->request->data['Address']['village_id']) == 0)
						$this->request->data['Address']['village_id'] = $currentAddress['Address']['village_id'];
				}
				
				$this->loadModel('Address');
//				$this->Address->unbindAllModel();
				$address = $this->Address->find('first',array(
					'fields' => array('ProvincesStatesCodeData.id','ProvincesStatesCodeData.name','TownCityCodeData.id','TownCityCodeData.name','VillageCodeData.id','VillageCodeData.name'),
					'conditions' => array('Person.id'=>$userid),
					'joins' => array(
						array('table' => 'village_codes','alias' => 'VillageCodeData','type' => 'left','conditions' => array('Address.village_id = VillageCodeData.id')),
						array('table' => 'town_city_codes','alias' => 'TownCityCodeData','type' => 'left','conditions' => array('Address.town_city_id = TownCityCodeData.id')),
						array('table' => 'provinces_states_codes','alias' => 'ProvincesStatesCodeData','type' => 'left','conditions' => array('Address.province_state_id = ProvincesStatesCodeData.id')),
						array('table' => 'person_addresses','alias' => 'PersonAddress','type' => 'left','conditions' => array('Address.id = PersonAddress.address_id')),
						array('table' => 'people','alias' => 'Person','type' => 'left','conditions' => array('PersonAddress.person_id = Person.id'))
					)
				));
				$province_id = (isset($address['ProvincesStatesCodeData']['id']))?$address['ProvincesStatesCodeData']['id']:'';
				$town_id = (isset($address['TownCityCodeData']['id']))?$address['TownCityCodeData']['id']:'';
				$village_id = (isset($address['VillageCodeData']['id']))?$address['VillageCodeData']['id']:'';
				
				$this->loadModel('InsuranceProviderProduct');
				$this->InsuranceProviderProduct->recursive=-1;
				$userHmo = $this->InsuranceProviderProduct->find('all',array(
					'fields' => array('InsuranceProviderProduct.id','InsuranceProviderProduct.name'),
					'conditions' => array('PersonIdentity.users_id'=>$userid),
					'joins' => array(
						array('table' => 'person_insurance','alias' => 'PersonInsurance','type' => 'left','conditions' => array('InsuranceProviderProduct.id = PersonInsurance.insurance_provider_product_id')),
						array('table' => 'person_identities','alias' => 'PersonIdentity','type' => 'left','conditions' => array('PersonInsurance.person_id = PersonIdentity.person_id')),
					)
				));
				$hmoFilterIds = array();
				foreach($userHmo as $key=>$hmo){
					$hmoFilterIds[] = $hmo['InsuranceProviderProduct']['id'];
				}
				$hmoFilter = $hmoFilterIds;
				$defaultHmo = (isset($hmoFilter[0]))?$hmoFilter[0]:'';
				
			}else{
				$this->loadModel('CompanyBranchMember');
				$this->CompanyBranchMember->recursive=-1;
				$userBranch = $this->CompanyBranchMember->find('first',array(
					'fields' => array('CompanyBranchMember.company_branch_id'),
					'conditions' => array('CompanyBranchMember.users_id'=>$userid)
				));
				$userBranchId = (!empty($userBranch))?$userBranch['CompanyBranchMember']['company_branch_id']:'';
				$this->loadModel('CompanyBranchAddress');
				$this->CompanyBranchAddress->recursive=-1;
				$userAddress = $this->CompanyBranchAddress->find('first',array(
					'fields' => array('VillageCode.id','VillageCode.name','TownCityCode.id','TownCityCode.name','ProvincesStatesCode.id','ProvincesStatesCode.name'),
					'conditions' => array('CompanyBranchAddress.company_branch_id'=>$userBranchId),
					'joins' => array(
						array('table'=>'addresses','alias'=>'Address','type'=>'left','conditions'=>array('CompanyBranchAddress.address_id = Address.id')),
						array('table'=>'village_codes','alias'=>'VillageCode','type'=>'left','conditions'=>array('VillageCode.id = Address.village_id')),
						array('table'=>'town_city_codes','alias'=>'TownCityCode','type'=>'left','conditions'=>array('TownCityCode.id = Address.town_city_id')),
						array('table'=>'provinces_states_codes','alias'=>'ProvincesStatesCode','type'=>'left','conditions'=>array('ProvincesStatesCode.id = Address.province_state_id')),
					)
				));
				$this->CompanyBranchAddress->recursive=0;
				$this->CompanyBranchMember->recursive=0;
				$province_id = $userAddress['ProvincesStatesCode']['id'];
				$town_id = $userAddress['TownCityCode']['id'];
				$village_id = $userAddress['VillageCode']['id'];
				$hmoFilter = (isset($hmo))?$hmo:'';;
				$defaultHmo = '';
				
			}
			$provinces = $this->ProvincesStatesCode->find('list');
			$defaultProvince = $province_id;
			$defaultTown = $town_id;
			$defaultVillage = $village_id;
			$this->set(compact('defaultProvince','provinces','defaultTown','defaultVillage','defaultHmo'));
			
			$this->request->data['Address']['province_state_id'] = $defaultProvince;
			$this->request->data['Address']['town_city_id'] = $defaultTown;
			$this->request->data['Address']['village_id'] = $defaultVillage;

		}
		
		$addressConditions = array();
		$addressConditionsArray = array();
		if(isset($this->request->data['Address'])){
			$addressConditions = $this->request->data['Address'];
			$addressConditions = array_filter($addressConditions,'strlen');
			
			if(!empty($addressConditions))
				$addressFilter = true;
		}
		
		$personByAddressIds = array();
		if(!empty($addressConditions)){
			$addressConditionsArray['Address.province_state_id'] = $addressConditions['province_state_id'];
			(!empty($addressConditions['town_city_id']))?$addressConditionsArray['Address.town_city_id'] = $addressConditions['town_city_id']:'';
			(!empty($addressConditions['village_id']))?$addressConditionsArray['Address.village_id'] = $addressConditions['village_id']:'';
			$this->loadModel('CompanyBranchAddress');
			$companyBranchAdd = $this->CompanyBranchAddress->find('all',array(
				'fields'=>array('CompanyBranch.id'),
				'conditions' => $addressConditions
			));
			$this->log($companyBranchAdd,'debug');
//			$personByAddressIds = $this->PersonAddress->find('all',array(
//				'fields' => array('person_id'),
//				'conditions' => $addressConditions
//			));
			$companyBranchMembers = array();
			$this->loadModel('CompanyBranchMember');
			foreach($companyBranchAdd as $key=>$value){
				$companyBranchMembers[$key] = $this->CompanyBranchMember->find('all',array(
					'fields'=>array('CompanyBranchMember.users_id'),
					'conditions'=>array('CompanyBranchMember.company_branch_id'=>$value['CompanyBranch']['id'])
				));
			}
			$this->log($companyBranchMembers,'debug');
			
			$this->loadModel('PersonIdentity');
			foreach($companyBranchMembers as $key=>$value){
				foreach($value as $key2=>$value2){
					$personByAddressIds[] = $this->PersonIdentity->find('first',array(
						'fields'=>array('PersonIdentity.person_id'),
						'conditions'=>array(
							'PersonIdentity.users_id'=>$value2['CompanyBranchMember']['users_id'],
							'PersonIdentity.posted'=>true
						)
					));
				}
			}
			$this->log($personByAddressIds,'debug');
		}
			
		$this->loadModel('PersonEducationalBackground');
		$this->loadModel('CompanyBranchMember');
		$this->loadModel('PersonIdentity');
		
		$personByAddressIds = Set::extract($personByAddressIds,'{n}.PersonIdentity.person_id');
//		debug($personByAddressIds);
		$insuranceConditions = array();
		$personByInsuranceIds = array();
		if(isset($this->request->data['InsuranceProviderProduct']['id']) && strlen($this->request->data['InsuranceProviderProduct']['id'])){
			$insuranceConditions = array('insurance_provider_product_id' => $this->request->data['InsuranceProviderProduct']['id']);
			$insuranceConditions = array_filter($insuranceConditions,'strlen');
			$hmoFilter = true;
		}
		if(!empty($insuranceConditions)){
			$this->loadModel('PersonInsurance');
			$personByInsuranceIds = $this->PersonInsurance->find('all',array(
				'field' => array('person_id'),
				'conditions' => $insuranceConditions
			));
			$personByInsuranceIds = Set::extract($personByInsuranceIds,'{n}.PersonInsurance.person_id');
			$personByInsuranceIds = is_array($personByInsuranceIds)?$personByInsuranceIds:array();
		}
		
		$personByMajors = array();
		if(isset($this->request->data['PersonEducationalBackground']['education_major_id']) && strlen($this->request->data['PersonEducationalBackground']['education_major_id'])){
			$this->PersonEducationalBackground->unbindAllModel(array(),true);
			
			$personByMajors = $this->PersonEducationalBackground->find('all',array(
				'fields' => array('person_id'),
				'conditions' => $this->data['PersonEducationalBackground']
			));
			
			$personByMajors = Set::extract($personByMajors,'{n}.PersonEducationalBackground.person_id');
			$personByMajors = is_array($personByMajors)?$personByMajors:array();
			$majorFilter = true;
		}
		
		$personByHosp = array();
		if(isset($this->request->data['CompanyBranch']['id']) && strlen($this->request->data['CompanyBranch']['id'])){
			$hospFilter = true;
			$this->loadModel('CompananyBranchMember');
			$this->CompananyBranchMember->unbindAllModel(array(),true);
			$memberIds = $this->CompanyBranchMember->find('all',array(
				'fields' => array(
					'CompanyBranchMember.users_id'
				),
				'conditions' => array(
					'CompanyBranch.id' => $this->request->data['CompanyBranch']['id']
				)
			));
			if(!empty($memberIds)){
				$personByHosp = $this->PersonIdentity->find('all',array(
					'fields' => array('person_id'),
					'conditions' => array(
						'users_id' => Set::extract($memberIds,'{n}.CompanyBranchMember.users_id')
					)
				));
				$personByHosp = Set::extract($personByHosp,'{n}.PersonIdentity.person_id');
				$personByHosp = is_array($personByHosp)?$personByHosp:array();
			}
			else
				$personByHosp = array();
		}
		
		/*if($hospFilter)
			$array[] = $personByHosp;
		if($majorFilter)
			$array[] = $personByMajors;
		if($hmoFilter)
			$array[] = $personByInsuranceIds;
		if($addressFilter)
			$array[] = $personByAddressIds;*/
			
		if((isset($this->data['Address']['province_state_id']) && !empty($this->data['Address']['province_state_id']))/* || isset($this->data['Address']['town_city_id']) || isset($this->data['Address']['village_id'])*/)
			if(!empty($personByAddressIds))
				$array['Address'] = $personByAddressIds;
			else
				$array['Address'] = array('0'=>'0');

		if(isset($this->data['InsuranceProviderProduct']['id']) && !empty($this->data['InsuranceProviderProduct']['id']))
			if(!empty($personByInsuranceIds))
				$array['HMO'] = $personByInsuranceIds;
			else
				$array['HMO'] = array('0'=>'0');

		if(isset($this->data['PersonEducationalBackground']['education_major_id']) && !empty($this->data['PersonEducationalBackground']['education_major_id']))
			if(!empty($personByMajors))
				$array['Specialty'] = $personByMajors;
			else
				$array['Specialty'] = array('0'=>'0');
						
		if(isset($this->data['CompanyBranch']['id']) && !empty($this->data['CompanyBranch']['id']))
			if(!empty($personByHosp))
				$array['Hospital'] = $personByHosp;
			else
				$array['Hospital'] = array('0'=>'0');
		
//		debug($array);
		$personId = array();
		if(!empty($array)){
			reset($array);
			$personId = current($array);
			while(next($array)){
				$personId = array_intersect($personId, current($array));
			}
		}
//		debug($personId);
		$companyMembers = array();
		$companyMemberDuties = array();
		$personIdentities = array();
		$personMajors = array();
		$days = array();
		$companyAddresses = array();
		$addresses = array();
		
		if(!(empty($personId) && ($majorFilter || $hmoFilter || $addressFilter || $hospFilter))){
		
			$personConditions = array();
			if(!empty($personId))
				$personConditions = array(
					'PersonIdentity.person_id' => $personId
				);
			else
				$personConditions = array(
					'User.status' => 1
				);
				
			$this->PersonIdentity->unbindAllModel(array('Person','User'),true);
			$this->paginate = array(
				'fields' => array(
					'PersonIdentity.*',
					'Physician.*',
					'Person.lastname',
					'Person.firstname',
					'Image.image',
					'Person.id',
				),
				'conditions' => $personConditions,
				'joins' => array(
					array(
						'table' => 'physicians',
						'alias' => 'Physician',
						'type' => 'inner',
						'conditions' => array(
							'Physician.users_id = PersonIdentity.users_id'
						)
					),
					array(
						'table' => 'person_images',
						'alias' => 'PersonImage',
						'type' => 'left',
						'conditions' => array(
							'PersonIdentity.person_id = PersonImage.person_id'
						)
					),
					array(
						'table' => 'images',
						'alias' => 'Image',
						'type' => 'left',
						'conditions' => array(
							'PersonImage.image_id = Image.id'
						)
					)
				),
				'order' => array(
					'Person.lastname' => 'ASC'
				),
				'recursive' => 1
			);
			
			$personIdentities = $this->paginate('PersonIdentity');
			
			if(empty($personId))
				$personId = Set::extract($personIdentities,'{n}.Person.id');
			
			$personIdentities = Set::combine($personIdentities,'{n}.PersonIdentity.users_id','{n}');
			
			$this->PersonEducationalBackground->unbindAllModel(array('EducationCourse'),true);
			$personMajors = $this->PersonEducationalBackground->find('all',array(
				'fields' => array(
					'PersonEducationalBackground.id',
					'PersonEducationalBackground.person_id',
					'EducationCourse.name'
				),
				'conditions' => array(
					'PersonEducationalBackground.person_id' => $personId
				)
			));
			$personMajors = Set::combine($personMajors,'{n}.PersonEducationalBackground.id','{n}.EducationCourse.name','{n}.PersonEducationalBackground.person_id');
			
			$this->CompanyBranchMember->unbindAllModel(array('CompanyBranch'));
			
			$companyMembers = $this->CompanyBranchMember->find('all',array(
				'fields' => array(
					'CompanyBranch.name',
					'CompanyBranch.id',
					'CompanyBranchMember.*'
				),
				'conditions' => array(
					'CompanyBranchMember.users_id' => array_keys($personIdentities)
				)
			));
			$this->loadModel('CompanyBranchMemberDuty');
			$this->CompanyBranchMemberDuty->unbindAllModel();
			
			$this->loadModel('CompanyBranchAddress');
			$this->CompanyBranchAddress->unbindAllModel();
			$companyAddresses = $this->CompanyBranchAddress->find('all',array(
				'fields' => array('company_branch_id','address_id'),
				'conditions' => array(
					'company_branch_id' =>  Set::extract($companyMembers,'{n}.CompanyBranchMember.company_branch_id')
				)
			));
			$companyAddresses = Set::combine($companyAddresses,'{n}.CompanyBranchAddress.company_branch_id','{n}');
			$this->loadModel('Address');
			$this->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'));
			$addresses = $this->Address->find('all',array(
				'fields' => array(
					'Address.id',
					'Address.floor',
					'Address.unit',
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
					'Address.id' => Set::extract($companyAddresses,'{n}.CompanyBranchAddress.address_id')
				)
			));
			$addresses = Set::combine($addresses,'{n}.Address.id','{n}');
	
			$companyMemberDuties = $this->CompanyBranchMemberDuty->find('all',array(
				'fields' => array(
					'day','start_time','end_time','id','company_branch_member_id'
				),
				'conditions' => array(
					'CompanyBranchMemberDuty.company_branch_member_id' => Set::extract($companyMembers,'{n}.CompanyBranchMember.id')
				)
			));
			$companyMembers = Set::combine($companyMembers,'{n}.CompanyBranchMember.id','{n}','{n}.CompanyBranchMember.users_id');
			$companyMemberDuties = Set::combine($companyMemberDuties,'{n}.CompanyBranchMemberDuty.id','{n}','{n}.CompanyBranchMemberDuty.company_branch_member_id');
			$days = $this->CompanyBranchMemberDuty->days;
		}
		
		
		$this->loadModel('EducationCourse');
		$specialties = $this->EducationCourse->find('list',array(
			'fields' => array('id','name'),
			'conditions' => array(
				'validated' => true
			)
		));
		
		$this->loadModel('InsuranceProviderProduct');
		$insuranceProducts = $this->InsuranceProviderProduct->find('list',array(
			'fields' => array('id','name'),
			'conditions' => array(
				'validated' => true
			)
		));
		
		$this->loadModel('ProvincesStatesCode');
		$provinces = $this->ProvincesStatesCode->find('list',array(
			'fields' => array('id','name'),
			'conditions' => array(
				'validated'
			),
			'order' => 'name ASC'
		));
		
		$townCities = array();
		$villages = array();
		
		if(isset($this->request->data['Address']['province_state_id']) && strlen($this->request->data['Address']['province_state_id'])){
			$this->loadModel('TownCityCode');
			$townCities = $this->TownCityCode->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'provinces_states_id' => $this->request->data['Address']['province_state_id']
				)
			));
		}else{
			$this->loadModel('TownCityCode');
			$townCities = $this->TownCityCode->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'provinces_states_id' => (isset($province_id))?$province_id:''
				)
			));
		}

		if(isset($this->request->data['Address']['town_city_id']) && strlen($this->request->data['Address']['town_city_id'])){
			$this->loadModel('VillageCode');
			$villages = $this->VillageCode->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'town_city_id' => $this->request->data['Address']['town_city_id']
				)
			));
		}else{
			$this->loadModel('VillageCode');
			$villages = $this->VillageCode->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'town_city_id' => (isset($town_id))?$town_id:''
				)
			));
		}
		
		$laboratories = array();
		$this->loadModel('CompanyBranch');
		
		$this->CompanyBranch->unbindAllModel();
		$laboratories = $this->CompanyBranch->find('list',array(
			'fields' => array('CompanyBranch.id','CompanyBranch.name'),
			'conditions' => array(
				'Laboratory.validated' => true
			),
			'joins' => array(
				array(
					'table' => 'laboratories',
					'alias' => 'Laboratory',
					'type' => 'inner',
					'conditions' => array(
						'CompanyBranch.id = Laboratory.company_branch_id'
					)
				)
			)
		));
		$this->loadModel('InsuranceProviderProduct');
		$insuranceProducts = $this->InsuranceProviderProduct->find('list',array(
			'fields' => array('id','name'),
			'conditions' => array(
				'validated' => true
			)
		));
		$this->set(compact('companyMembers','companyMemberDuties','personIdentities','personMajors','days','companyAddresses','addresses','specialties','insuranceProducts','provinces','townCities','villages','laboratories'));
		
	}
	/*
	public function search(){
		$user_id = $this->Auth->user('id');
		if(!empty($user_id) && empty($this->data)){
			$this->loadModel('Address');
			$this->Address->unbindAllModel(array('ProvincesStatesCode','TownCityCode','VillageCode',false));
			$address = $this->Address->find('all',array(
				'fields' => array(
					'ProvincesStatesCode.id',
					'ProvincesStatesCode.name',
					'TownCityCode.id',
					'TownCityCode.name',
					'VillageCode.id',
					'VillageCode.name'
				),
				'conditions' => array(
					'Person.id'=>$user_id
				),
				'joins' => array(
					array(
						'table' => 'person_addresses',
						'alias' => 'PersonAddress',
						'type' => 'left',
						'conditions' => array(
							'Address.id = PersonAddress.address_id'
						)
					),
					array(
						'table' => 'people',
						'alias' => 'Person',
						'type' => 'left',
						'conditions' => array(
							'PersonAddress.person_id = Person.id'
						)
					)
				)
			));
			foreach($address as $key=>$codes){
				$defaultprovince = $codes['ProvincesStatesCode']['id'];
				$defaulttown = $codes['TownCityCode']['id'];
				$defaultvillage = $codes['VillageCode']['id'];
				$defaulthmo = null;
				$defaultspecialty = null;
				$this->set(compact('defaultprovince','defaulttown','defaultvillage','defaulthmo','defaultspecialty'));
 			}
 			
 			$hmo = $this->InsuranceProviderProduct->find('list');
			$labtests = $this->LaboratoryTestGroup->find('list');
			$provinces = $this->ProvincesStatesCode->find('list');
			$this->set(compact('provinces','labtests','hmo'));
 			
 			if(!empty($this->passedArgs)){
				unset($this->passedArgs['page']);
				$info = array_filter($this->passedArgs,'strlen');
			}
			else if(!empty($this->data)){
				if(empty($this->data['Address']['province_state_id']) && empty($this->data['Address']['town_city_id']) && empty($this->data['Address']['village_id']) && empty($this->data['InsuranceProvider']['hmo']) && empty($this->data['Specialty']['name']) && empty($this->data['People']['lastname'])){
					$info = array('User.role'=>'6');
				}
				else{
				$filter = array();
				foreach($this->data as $firstkey=>$first):
					foreach($first as $secondkey=>$second):
						$filter[$firstkey.'.'.$secondkey] = $second;
					endforeach;
				endforeach;
				$info = array_filter($filter,'strlen');
				}
			}
			else{
				$info = array('Address.province_state_id'=>$defaultprovince,'Address.town_city_id'=>$defaulttown,'Address.village_id'=>$defaultvillage,'User.role'=>'6');
			}
			
			$filterparams = array();
			if(!empty($info) && $info<>'1=1')
				$filterparams = $info;
			else
				$filterparams = $this->passedArgs;
				
			$this->set('filterparams',$filterparams);

			$this->set('info',$info);
			
			debug($info);
			$this->set('physicians',$this->Common->getPhysicianDetails(null,$info,1));
		}
		else{

			$provinces = $this->ProvincesStatesCode->find('list');
			$hmo = $this->InsuranceProviderProduct->find('list');
			$labtests = $this->LaboratoryTestGroup->find('list');
			$defaultprovince = null;
			$defaulttown = null;
			$defaultvillage = null;
			$defaulthmo = null;
			$defaultspecialty = null;
			
			$this->set(compact('provinces','labtests','hmo','defaultprovince','defaulttown','defaultvillage','defaulthmo','defaultspecialty'));
			
			if(!empty($this->passedArgs)){
				unset($this->passedArgs['page']);
				$info = array_filter($this->passedArgs,'strlen');
			}
			else if(!empty($this->data)){
				if(empty($this->data['Address']['province_state_id']) && empty($this->data['Address']['town_city_id']) && empty($this->data['Address']['village_id']) && empty($this->data['InsuranceProvider']['hmo']) && empty($this->data['Specialty']['name']) && empty($this->data['People']['lastname'])){
					$info = array('User.role'=>'6');
				}
				else{
				$filter = array();
				foreach($this->data as $firstkey=>$first):
					foreach($first as $secondkey=>$second):
						$filter[$firstkey.'.'.$secondkey] = $second;
					endforeach;
				endforeach;
				$info = array_filter($filter,'strlen');
				}
			}
			else{
				$info = array('User.role'=>'6');
			}
			$filterparams = array();
			if(!empty($info) && $info<>'1=1')
				$filterparams = $info;
			else
				$filterparams = $this->passedArgs;
				
			$this->set('filterparams',$filterparams);

			$this->set('info',$info);
			debug($info);
			$this->set('physicians',$this->Common->getPhysicianDetails(null,$info,1));
		}
	}
	*/
	function physician(){
		if($this->RequestHandler->isAjax()){
			$filter = array('Address.province_state_id'=>$_POST['province'],'Address.town_city_id'=>$_POST['town'],'Address.village_id'=>$_POST['village'],'InsuranceProviderProduct.id'=>$_POST['hmo'],'Specialty.name'=>$_POST['specialty'],'User.role'=>$_POST['role']);
			$firstletter = $_POST['id'].'%';
			$info = array_filter($filter,'strlen');
//			if($info<>null)
//				$filterInfo = $info;
//			else
//				$filterInfo =  array('User.role'=>'6');
			if(!empty($this->passedArgs)){
				unset($this->passedArgs['page']);
				$info = array_filter($this->passedArgs,'strlen');
			}
			else if(!empty($info)){
				if(empty($info['Address.province_state_id']) && empty($info['Address.town_city_id']) && empty($info['Address.village_id']) && empty($info['InsuranceProviderProduct.id']) && empty($info['Specialty.name'])){
					$info = array('User.role'=>'6');
				}
				else{
				$filters = array();
				foreach($this->data as $firstkey=>$first):
					foreach($first as $secondkey=>$second):
						$filters[$firstkey.'.'.$secondkey] = $second;
					endforeach;
				endforeach;
				$info = array_filter($filters,'strlen');
				}
			}
			else{
				$info = array('User.role'=>'6');
			}

			$filterparams = array();
			if(!empty($info) && $info<>'1=1')
				$filterparams = $info;
			else
				$filterparams = $this->passedArgs;
				
			$this->set('filterparams',$filterparams);
			$data = $this->Common->getPhysicianDetails(null,$info,1,$firstletter);
			$this->set('physicians',$data);
		}
	}
	
	public function view($id=null,$lastname=null){
		$this->loadModel('Person');
		$this->Person->unbindAllModel(array(),true);
		$person = $this->Person->find('first',array(
			'fields' => array(
				'Person.*','Image.*'
			),
			'conditions' => array(
				'Person.id'=>$id
			),
			'joins'=>array(
				array(
					'table' => 'person_images',
					'alias' => 'PersonImage',
					'type' => 'LEFT',
					'conditions' => array(
						'Person.id = PersonImage.person_id',
					)
				),
				array(
					'table' => 'images',
					'alias' => 'Image',
					'type' => 'LEFT',
					'conditions' => array(
						'PersonImage.image_id = Image.id',
					)
				)
			)
		));
		
		if(empty($person) || Inflector::slug($person['Person']['lastname'])<>$lastname){
			$this->Session->setFlash('Physician not found');
			$this->redirect('/physicians/search');
		}
		
		$physician = array();//$this->Common->getPhysicianDetails($id,null,0);
		
		$this->loadModel('PersonIdentity');
		$this->PersonIdentity->unbindAllModel(array('Physician'),true);
		$physician = $this->PersonIdentity->find('first',array(
			'fields' => array(
				'PersonIdentity.*',
				'Physician.*',
			),
			'conditions' => array(
				'PersonIdentity.person_id' => $id
			),
			'joins' => array(
				array(
					'table' => 'physicians',
					'alias' => 'Physician',
					'type' => 'inner',
					'conditions' => array(
						'Physician.users_id = PersonIdentity.users_id'
					)
				)
			),
		));
		if(empty($physician) || !isset($physician['Physician']['id']) || strlen($physician['Physician']['id']) == 0 ){
			$this->Session->setFlash('Physician not found');
			$this->redirect('/physicians/search');
		}
		
		$this->loadModel('PhysicianProfile');
		$this->PhysicianProfile->unbindAllModel();
		$physicianProfile = $this->PhysicianProfile->find('first',array(
			'fields' => array(
				
			),
			'conditions' => array(
				'physician_id' => $physician['Physician']['id']
			)
		));
		
		$this->loadModel('PersonEducationalBackground');
		$this->PersonEducationalBackground->unbindAllModel(array('EducationCourse'),true);
		$personMajors = $this->PersonEducationalBackground->find('all',array(
			'fields' => array(
				'PersonEducationalBackground.id',
				'PersonEducationalBackground.person_id',
				'EducationCourse.name'
			),
			'conditions' => array(
				'PersonEducationalBackground.person_id' => $id
			)
		));
		$personMajors = Set::combine($personMajors,'{n}.PersonEducationalBackground.id','{n}.EducationCourse.name','{n}.PersonEducationalBackground.person_id');
		
		$this->loadModel('CompanyBranchMember');
		$this->CompanyBranchMember->unbindAllModel(array('CompanyBranch'));
		
		$companyMembers = $this->CompanyBranchMember->find('all',array(
			'fields' => array(
				'CompanyBranch.name',
				'CompanyBranch.id',
				'CompanyBranchMember.*'
			),
			'conditions' => array(
				'CompanyBranchMember.users_id' => $physician['Physician']['users_id']
			)
		));
		$this->loadModel('CompanyBranchMemberDuty');
		$this->CompanyBranchMemberDuty->unbindAllModel();
		
		$this->loadModel('CompanyBranchAddress');
		$this->loadModel('CompanyBranchContactInformation');
		$this->CompanyBranchAddress->unbindAllModel();
		$this->CompanyBranchContactInformation->unbindAllModel();

		$companyContacts = $this->CompanyBranchContactInformation->find('all',array(
			'fields' => array('company_branch_id','contact_id'),
			'conditions' => array(
				'company_branch_id' =>  Set::extract($companyMembers,'{n}.CompanyBranchMember.company_branch_id')
			)
		));
		
		$this->loadModel('ContactInformation');
		$this->ContactInformation->unbindAllModel();

		$contacts = $this->ContactInformation->find('all',array(
			'fields' => array(),
			'conditions' => array(
				'id' => Set::extract($companyContacts,'{n}.CompanyBranchContactInformation.contact_id')
			)
		));
		
		$contacts = Set::combine($contacts,'{n}.ContactInformation.id','{n}.ContactInformation');
		
		$companyContacts = Set::combine($companyContacts,'{n}.CompanyBranchContactInformation.contact_id','{n}.CompanyBranchContactInformation.contact_id','{n}.CompanyBranchContactInformation.company_branch_id');
		
		$companyAddresses = $this->CompanyBranchAddress->find('all',array(
			'fields' => array('company_branch_id','address_id'),
			'conditions' => array(
				'company_branch_id' =>  Set::extract($companyMembers,'{n}.CompanyBranchMember.company_branch_id')
			)
		));

		$companyAddresses = Set::combine($companyAddresses,'{n}.CompanyBranchAddress.company_branch_id','{n}');

		$this->loadModel('Address');
		$this->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'));
		$addresses = $this->Address->find('all',array(
			'fields' => array(
				'Address.id',
				'Address.floor',
				'Address.unit',
				'Address.longtitude',
				'Address.latitude',
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
				'Address.id' => Set::extract($companyAddresses,'{n}.CompanyBranchAddress.address_id')
			)
		));
		$addresses = Set::combine($addresses,'{n}.Address.id','{n}');

		$companyMemberDuties = $this->CompanyBranchMemberDuty->find('all',array(
			'fields' => array(
				'day','start_time','end_time','id','company_branch_member_id'
			),
			'conditions' => array(
				'CompanyBranchMemberDuty.company_branch_member_id' => Set::extract($companyMembers,'{n}.CompanyBranchMember.id')
			)
		));
		
		$companyMembers = Set::combine($companyMembers,'{n}.CompanyBranchMember.id','{n}','{n}.CompanyBranchMember.users_id');
		$companyMemberDuties = Set::combine($companyMemberDuties,'{n}.CompanyBranchMemberDuty.id','{n}','{n}.CompanyBranchMemberDuty.company_branch_member_id');
		$days = $this->CompanyBranchMemberDuty->days;
		
		$this->loadModel('PersonInsurance');
		$this->PersonInsurance->unbindAllModel(array('InsuranceProviderProduct'),true);
		$personInsurances = $this->PersonInsurance->find('all',array(
			'fields' => array(
//				'PersonInsurance.*',
				'InsuranceProviderProduct.name'
			),
			'conditions' => array(
				'person_id' => $id
			)
		));
		
		$this->loadModel('PersonOrganizationsAffiliation');
		$this->PersonOrganizationsAffiliation->unbindAllModel(array('OrganizationsAffiliation'),true);
		$personAffiliations = $this->PersonOrganizationsAffiliation->find('all',array(
			'fields' => array(
				'PersonOrganizationsAffiliation.*',
				'OrganizationsAffiliation.*'
			),
			'conditions' => array(
				'PersonOrganizationsAffiliation.person_id' => $id
			)
		));
		$contactTypes = $this->ContactInformation->types;
		$this->set(compact('physicianProfile','person','physician','companyMembers','companyMemberDuties','personIdentities','personMajors','days','companyAddresses','addresses','personInsurances','personAffiliations','contacts','companyContacts','contactTypes'));
		
	}
	
	public function getStatistics(){
		
		$physician = $this->Physician->find('first',array(
			'conditions' => array(
				'Physician.users_id' => $this->Auth->user('id')
			)
		));
		$address = false;
		
// 		debug($this->Common->getAllTestOrderPhysician(''));
		$physicianId = $physician['Physician']['id'];
		$conditions = array('LaboratoryPatientBatchPackageOrder.physician_id' => $physicianId);
		if($this->RequestHandler->isAjax()){
			if(isset($_POST['data']['Statistic']['start_date']) && strlen($_POST['data']['Statistic']['start_date']) && isset($_POST['data']['Statistic']['end_date']) && strlen($_POST['data']['Statistic']['end_date']) )
				$conditions['LaboratoryPatientBatchOrder.confirmed_date BETWEEN ? AND ?'] = array($_POST['data']['Statistic']['start_date'],$_POST['data']['Statistic']['end_date']);
			if(isset($_POST['data']['Statistic']['laboratory_id']) && strlen($_POST['data']['Statistic']['laboratory_id']))
				$conditions['LaboratoryPatientOrder.laboratory_id'] = $_POST['data']['Statistic']['laboratory_id'];
			if(isset($_POST['data']['Statistic']['test_group_id']) && strlen($_POST['data']['Statistic']['test_group_id']))
				$conditions['LaboratoryPatientBatchPackageOrder.test_group_id'] = $_POST['data']['Statistic']['test_group_id'];
		}
		
		$this->loadModel('LaboratoryPatientBatchPackageOrder');
		$this->LaboratoryPatientBatchPackageOrder->unbindAllModel();
		$results = $this->LaboratoryPatientBatchPackageOrder->find('all',array(
			'fields' => array(
				'count(*) as testgroup_count',
				'LaboratoryPatientBatchPackageOrder.id',
				'LaboratoryPatientBatchPackageOrder.test_group_id',
				'LaboratoryPatientOrder.laboratory_id'
			),
			'conditions' => $conditions,
			'group' => array('LaboratoryPatientOrder.laboratory_id','LaboratoryPatientBatchPackageOrder.test_group_id'),
			'joins' => array(
				array(
					'table' => 'laboratory_patient_batch_orders',
					'alias' => 'LaboratoryPatientBatchOrder',
					'type' => 'LEFT',
					'conditions' => array(
						'LaboratoryPatientBatchOrder.id = LaboratoryPatientBatchPackageOrder.patient_batch_order_id'
					)
				),
				array(
					'table' => 'laboratory_patient_orders',
					'alias' => 'LaboratoryPatientOrder',
					'type' => 'LEFT',
					'conditions' => array(
						'LaboratoryPatientOrder.id = LaboratoryPatientBatchOrder.patient_order_id'
					)
				),
			)
		));
		
		$testGroupIds = Set::extract($results,'{n}.LaboratoryPatientBatchPackageOrder.test_group_id');
		$laboratoryIds = Set::extract($results,'{n}.LaboratoryPatientOrder.laboratory_id');
		$results = Set::combine($results,'{n}.LaboratoryPatientBatchPackageOrder.id','{n}','{n}.LaboratoryPatientOrder.laboratory_id');
		
		$this->LaboratoryTestGroup->unbindAllModel();
		$testgroups = $this->LaboratoryTestGroup->find('list',array(
			'fields' => array('id','name'),
			'conditions' => array(
				'enabled' => true,
				'id' => $testGroupIds
			)
		));
		
		$this->loadModel('Laboratory');
		$this->Laboratory->unbindAllModel(array('CompanyBranch'));
		
		$laboratories = $this->Laboratory->find('all',array(
			'fields' => array('Laboratory.id','CompanyBranch.name'),
			'conditions' => array(
				'Laboratory.status' => true
			)
		));
		
		$laboratories = Set::combine($laboratories,'{n}.Laboratory.id','{n}.CompanyBranch.name');
		
		
		
		$data = array(
			'Stat' => $results,
			'LaboratoryTestGroup' => $testgroups,
			'Laboratory' => $laboratories
		);
		
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
	    	$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}else{
			$this->set(compact('results','testgroups','laboratories'));
		}
	}
	
	
	public function getPrescriptions(){
		
		$physician = $this->Physician->find('first',array(
			'conditions' => array(
				'Physician.users_id' => $this->Auth->user('id')
			)
		));
		$address = false;
		
		$physicianId = $physician['Physician']['id'];
		$conditions = array('LaboratoryPatientBatchPackageOrder.physician_id' => $physicianId);
		if($this->RequestHandler->isAjax()){
			if(isset($_POST['data']['Prescription']['start_date']) && strlen($_POST['data']['Prescription']['start_date']) && isset($_POST['data']['Prescription']['end_date']) && strlen($_POST['data']['Prescription']['end_date']) )
				$conditions['LaboratoryPatientBatchOrder.confirmed_date BETWEEN ? AND ?'] = array($_POST['data']['Prescription']['start_date'],$_POST['data']['Prescription']['end_date']);
		}
		
		$this->loadModel('LaboratoryPatientBatchPackageOrder');
		$this->LaboratoryPatientBatchPackageOrder->unbindAllModel();
		$results = $this->LaboratoryPatientBatchPackageOrder->find('all',array(
			'fields' => array(
				'LaboratoryPatientBatchPackageOrder.id',
				'LaboratoryPatientBatchPackageOrder.test_group_id',
				'LaboratoryPatientBatchOrder.requested_date',
				'LaboratoryPatientOrder.laboratory_id',
				'LaboratoryPatientOrder.laboratory_id',
				'Person.firstname',
				'Person.lastname',
				'Person.middlename',
			),
			'conditions' => $conditions,
			'joins' => array(
				array(
					'table' => 'laboratory_patient_batch_orders',
					'alias' => 'LaboratoryPatientBatchOrder',
					'type' => 'LEFT',
					'conditions' => array(
						'LaboratoryPatientBatchOrder.id = LaboratoryPatientBatchPackageOrder.patient_batch_order_id'
					)
				),
				array(
					'table' => 'laboratory_patient_orders',
					'alias' => 'LaboratoryPatientOrder',
					'type' => 'LEFT',
					'conditions' => array(
						'LaboratoryPatientOrder.id = LaboratoryPatientBatchOrder.patient_order_id'
					)
				),
				array(
					'table' => 'patients',
					'alias' => 'Patient',
					'type' => 'LEFT',
					'conditions' => array(
						'Patient.id = LaboratoryPatientOrder.patient_id'
					)
				),
				array(
					'table' => 'people',
					'alias' => 'Person',
					'type' => 'RIGHT',
					'conditions' => array(
						'Person.id = Patient.person_id'
					)
				)
			)
		));
		
		$testGroupIds = Set::extract($results,'{n}.LaboratoryPatientBatchPackageOrder.test_group_id');
		$laboratoryIds = Set::extract($results,'{n}.LaboratoryPatientOrder.laboratory_id');
		
		$this->LaboratoryTestGroup->unbindAllModel();
		$testgroups = $this->LaboratoryTestGroup->find('list',array(
			'fields' => array('id','name'),
			'conditions' => array(
				'enabled' => true,
				'id' => $testGroupIds
			)
		));
		
		$this->loadModel('Laboratory');
		$this->Laboratory->unbindAllModel(array('CompanyBranch'));
		
		$laboratories = $this->Laboratory->find('all',array(
			'fields' => array('Laboratory.id','CompanyBranch.name'),
			'conditions' => array(
				'Laboratory.status' => true
			)
		));
		
		$laboratories = Set::combine($laboratories,'{n}.Laboratory.id','{n}.CompanyBranch.name');
		
		$data = array(
			'Prescription' => $results,
			'LaboratoryTestGroup' => $testgroups,
			'Laboratory' => $laboratories
		);
		
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
	    	$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}else{
			$this->set(compact('results','testgroups','laboratories'));
		}
	}
	
	function getPhysicianPatients(){
// 		$this->log($this->request->data,'searchData');
		/* $doctorCache = $this->Session->read('medtrakLogin');
		$doctorId = $doctorCache['User.doctorId']; */
// 		$this->log($doctorId,'searchData');
		if(!empty($this->request->data['Patient']['labnumber'])){
			$this->request->data['Patient']['labnumber'] = str_replace('-', '', $this->request->data['Patient']['labnumber']);
		}
		$mrno=(isset($this->request->data['Patient']['labnumber']))?$this->request->data['Patient']['labnumber']:null;
		$firstname=$this->request->data['Patient']['firstname']?$this->request->data['Patient']['firstname']:null;
		$lastname=$this->request->data['Patient']['lastname']?$this->request->data['Patient']['lastname']:null;
		
		$lastId=(isset($this->request->data['Patient']['lastId']))?$this->request->data['Patient']['lastId']:null;
		
		
		$puserid = $this->Auth->user('id');
		
		$this->loadModel('Physician');
		$laboratories = $this->Physician->find('list',array(
				'fields'=>array('Physician.id','Physician.laboratory_id'),
				'conditions'=>array(
					'Physician.users_id'=>$puserid,
					'Physician.validated'=>1,
					'Physician.posted'=>1		
				)
		));
		
		
		// $this->log($mrno,'searchData');
		// $this->log($firstname,'searchData');
		// $this->log($lastname,'searchData');
		$people = array();
		if(!empty($firstname) && empty($lastname)){
			$people = $this->Common->searchPhysicianPatient($firstname,null,null,$puserid,$laboratories);
		}elseif(empty($firstname) && !empty($lastname)){
			$people = $this->Common->searchPhysicianPatient(null,$lastname,null,$puserid,$laboratories);
		}elseif(!empty($firstname) && !empty($lastname)){
			$people = $this->Common->searchPhysicianPatient($firstname,$lastname,null,$puserid,$laboratories);
		}elseif (!empty($mrno)){
			$people = $this->Common->searchPhysicianPatient(null,null,$mrno,$puserid,$laboratories);
		}
		
		
		//$people = $this->Common->searchPhysicianPatient($search,$puserid);
		//$testOrders = $this->Common->getAllTestOrderPhysician($userid,$puserid);
		//$persons = $this->Common->searchPhysicianPatient($search=null, $puserid=null);
		//debug($people);
		
		//$returnPatient = $this->__getPHCDoctorPatient($doctorId,$mrno,$firstname,$lastname,$lastId);
		$returnPatient = $people;
		/*
		 * Parse return data from Weblis GW
		 * 
		 */


		$tmppatients = array();
		foreach ($returnPatient as $pkey => $pvalue) {
			$tmppatients[$pvalue['Person']['myresultonline_id']] = $pvalue;
		}
		asort($tmppatients);
		$data = array('Patient' => array());
		if($tmppatients){
			$data['Patient'] = $tmppatients;
		}
		// $this->log($returnPatient,'searchData');

		
		
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
		

	}
	function getPhysicianPatients320Days(){
		/* $doctorCache = $this->Session->read('medtrakLogin');
		$doctorId = $doctorCache['User.doctorId'];	 */
// 		$returnPatient = $this->__getPHCDoctorPatient320Days($doctorId);
// 		$returnPatient = $this->__getWeblisDoctorPatient320Days();
		
		debug($this->request->data);
		$puserid = $this->Auth->user('id');
		$people = $this->Common->searchPhysicianPatient($search,$puserid);
		//$testOrders = $this->Common->getAllTestOrderPhysician($userid,$puserid);
		//$persons = $this->Common->searchPhysicianPatient($search=null, $puserid=null);
		debug($people);
		
		// 		$returnPatient = array();
		/*
		 * Parse return data from Weblis GW
		*
		*/
		$data = array('Patient' => array());
		if($returnPatient){
			$data['Patient'] = $returnPatient;
			/* $page = 1;
			$total = 2;
			$this->PaginatorArray = $this->Components->load('PaginatorArray');
			$slicedArray = array_slice($returnPatient['PaperAll'],($page - 1) * $this->PaginatorArray->limit ,$this->PaginatorArray->limit);
// 			$this->params['paging'] = $this->PaginatorArray->getParamsPaging('Page', $page,  $total,count($slicedArray));
// 			$this->helpers[] = 'Paginator';
			$data['Paginate']=$slicedArray; */
		}
	
	
	
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
	
	
	}
	function __getPHCDoctorPatient($doctorId,$mrno,$firstName,$lastName,$lastId){
	
		/* Get Patient User from WeblisGW
		 *
		*
		*/
// 		$this->log($doctorId,'doctorid');
// 		$this->log($mrno,'patientid');
		$config = Configure::read('mumps');
		$this->HeartCenterService = $this->Components->load('HCWService');
		if($this->HeartCenterService->connect()){
			$data = array();
			$tmppatient = array();
			if($doctorId && $mrno){
				$tmppatient = $this->HeartCenterService->getDoctorPatientByMRNo($doctorId,$mrno);
				$this->addAuditLog('physician.search_by_mrn',array(
						'doctor_id'=>$doctorId,
						'patient_mrn'=>str_replace("-", "", $mrno),//patient_id
				));
// 				$this->log($tmppatient,'patientSearch');
			}elseif($doctorId && $firstName && $lastName){
				$tmppatient = $this->HeartCenterService->getDoctorPatient($doctorId,$firstName,$lastName,$lastId);
				$this->addAuditLog('physician.search_by_name',array(
						'doctor_id'=>$doctorId,
						'patient_firstname'=>$firstName,
						'patient_lastname'=>$lastName,
				));
// 				$this->log($tmppatient,'patientSearch');
			}else{
				$tmppatient=array();
			}
			if(isset($tmppatient['Patients']['PaperAll']) && !empty($tmppatient['Patients']['PaperAll'])){
				//$data['User']
				$data['Person']['membership_type']=9;
				$data['Person']['username']=$mrno;
				$data['Person']['confirm_username']=$mrno;
				$data['Person']['password']=str_replace(' ','',strtolower($tmppatient['Patients']['PaperAll']['last_name']));
				$data['Person']['confirm_password']=str_replace(' ','',strtolower($tmppatient['Patients']['PaperAll']['last_name']));
				//$data['Person']
				$data['Person']['lastname']=$tmppatient['Patients']['PaperAll']['last_name'];
				$data['Person']['firstname']=$tmppatient['Patients']['PaperAll']['first_name'];
				$data['Person']['middlename']=$tmppatient['Patients']['PaperAll']['middle_name'];
				$data['Person']['birthdate']=date('m/d/Y',strtotime($tmppatient['Patients']['PaperAll']['birthdate']));
				$data['Person']['mrno']=(!empty($tmppatient['Patients']['PaperAll']['PaperPat']['ip_no']))?$tmppatient['Patients']['PaperAll']['PaperPat']['ip_no']:(!empty($tmppatient['Patients']['PaperAll']['PaperPat']['op_no']))?$tmppatient['Patients']['PaperAll']['PaperPat']['op_no']:'';
				$patientid=(!empty($tmppatient['Patients']['PaperAll']['PaperPat']['ip_no']))?$tmppatient['Patients']['PaperAll']['PaperPat']['ip_no']:(!empty($tmppatient['Patients']['PaperAll']['PaperPat']['op_no']))?$tmppatient['Patients']['PaperAll']['PaperPat']['op_no']:'';
				$this->addAuditLog('physician.view_patient',array(
						'patient_mrn'=>$patientid,//patient_id
				));
				
				$data['Person']['internal_id']=$tmppatient['Patients']['PaperAll']['id'];
				$data['Person']['laboratory_id']=$config['online.laboratory_id'];
				return $data;
			}
			return false;
		}else{
			return false;
		}
	
	
	
	}
	
	function __getPHCDoctorPatient320Days($doctorId){
	
		/* Get Patient User from WeblisGW
		 *
		*
		*/
		//$this->log($doctorId,'doctorid');
		$config = Configure::read('mumps');
		$this->HeartCenterService = $this->Components->load('HCWService');
		if($this->HeartCenterService->connect()){
			$data = array();
			$tmppatient = array();
			if($doctorId){
				$tmppatient = $this->HeartCenterService->getDoctorPatientBy320Days($doctorId);
 				$this->log($tmppatient,'patientSearch320');
			}else{
				$tmppatient=array();
			}
			if(isset($tmppatient['Patients']['PaperAll']) && !empty($tmppatient['Patients']['PaperAll'])){
				//$data['User'
// 				$this->log($tmppatient,'patient');
				/*foreach ($tmppatient['Patients']['PaperAll'] as $key=>&$patient){
					$data['PaperAll'][$key]['Person']['lastname']=$patient['last_name'];
					$data['PaperAll'][$key]['Person']['firstname']=$patient['first_name'];
					$data['PaperAll'][$key]['Person']['middlename']=$patient['middle_name'];
					$data['PaperAll'][$key]['Person']['birthdate']=date('m/d/Y',strtotime($patient['birthdate']));
					$data['PaperAll'][$key]['Person']['mrno']=(!empty($patient['PaperPat']['ip_no']))?$patient['PaperPat']['ip_no']:(!empty($patient['PaperPat']['op_no']))?$patient['PaperPat']['op_no']:'';
					$data['PaperAll'][$key]['Person']['internal_id']=$patient['id'];
					$data['PaperAll'][$key]['Person']['laboratory_id']=$config['online.laboratory_id'];
				}*/
				$fArr = array(".",",".":","'","?","`","@","#","$","%","^","&","*","(",")","-","+");
				$replace = "";
				foreach ($tmppatient['Patients']['PaperAll'] as $key=>&$patient){
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['lastname']=$patient['last_name'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['firstname']=$patient['first_name'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['middlename']=$patient['middle_name'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['birthdate']=date('m/d/Y',strtotime($patient['birthdate']));
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['mrno']=(!empty($patient['PaperPat']['ip_no']))?$patient['PaperPat']['ip_no']:(!empty($patient['PaperPat']['op_no']))?$patient['PaperPat']['op_no']:'';
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['internal_id']=$patient['id'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['laboratory_id']=$config['online.laboratory_id'];
					$patientids[]=(!empty($patient['PaperPat']['ip_no']))?$patient['PaperPat']['ip_no']:(!empty($patient['PaperPat']['op_no']))?$patient['PaperPat']['op_no']:'';
				}
				sort($data['PaperAll']);
				$data['PaperAll'] = array_values($data['PaperAll']);
				
				$this->addAuditLog('physician.load_patient',array(
						'patient_mrn'=>str_replace("-", "", $patientids),//patient_id
				));
				
				return $data;
			}
			return $tmppatient;
			//return false;
		}else{
			return false;
		}
	
	}
	function __profile($userid,$puserid,$luserid,$cuserid,$options,$fields){
		$testOrders = array();
		$persons = $this->Common->getUserDetails($userid,$fields,$options);
		// 		$this->log($persons,'lablogs');
		$person = array_shift($persons);
	
		$personIds = array();
	
		if(isset($person['id']))
			$personIds[] = $person['id'];
		if(isset($person['LaboratoryProfile']) && !empty($person['LaboratoryProfile']))
			$personIds = array_merge($personIds,Set::extract($person['LaboratoryProfile'],'{n}.id'));
	
		$userid = current($userid);
		$this->request->data = array('Person' => $person);
		$this->Patient->unbindAllModel(array(),false);
		$patient = $this->Patient->find('all',array(
				'conditions' => array('person_id'=>$personIds)
		));
		$patientIds = Set::extract($patient,'{n}.Patient.id');
		$patientId = (current($patientIds));
		$patientInternalIds = Set::extract($patient,'{n}.Patient.internal_id');
		$patientInternalId = (current($patientInternalIds));
		// 		$testOrders = $this->Common->getTestOrders(array(),array('LaboratoryTestOrder' => array('LaboratoryPatientOrder.patient_id' => $patientIds)),array('LaboratoryTestOrder','Laboratory'/* 'LaboratoryTestOrderPackage' */));
		// 		extract($testOrders);
		 
		if($puserid){//physician user id
			$testOrders = $this->Common->getAllTestOrderPhysician($userid,$puserid);
		}elseif($luserid){//laboratory user id
			$testOrders = $this->Common->getAllTestOrderLaboratory($userid,$luserid);
		}elseif($cuserid){//corporate user id
			//Pending
		}else{//default query patient user id
			$testOrdersWeblis = $this->Common->getAllTestOrders($userid);
			//debug($testOrdersWeblis);
			//$this->log($testOrdersWeblis,'testOrdersWeblis');
			//$testOrdersMumps = $this->__getPHCPatientOrder($patientInternalId);
			//$testOrders = array_merge($testOrdersWeblis,$testOrdersMumps);
			$testOrders = $testOrdersWeblis;
		}
		// 		debug($testOrders);
	
		// 		foreach($testOrders as $key=>&$orders){
		foreach($testOrders as $key=>&$laboratory){
			$lab = $this->Common->getLaboratoryDetails($laboratory['Laboratory']['company_branch_id']);
			$laboratories[$laboratory['Laboratory']['company_branch_id']]=current($lab);
		}
		// 		}
		// 		$this->log($laboratories,'lablogs');
		// 		laboratories = $this->Common->getLabDetails();
		// 		debug($testOrders);
		/*$LaboratoryTestGroups = Set::combine($testOrderPackages,'/LaboratoryTestGroup/id','/LaboratoryTestGroup/name');
			$testOrderPackages = Set::combine($testOrderPackages,'/LaboratoryTestOrderPackage/id','/LaboratoryTestGroup/name','/LaboratoryTestOrderPackage/test_order_id');*/
		$LaboratoryTestGroups=array();
		$testOrderPackages=array();
		//		debug($testOrderPackages);
		return compact('person','patient','testOrders','testOrderPackages','LaboratoryTestGroups','testOrderResults','laboratories');
	}
	
	public function  __getWeblisDoctorPatient320Days(){
		$this->layout = 'nazareth';

		
	}
	
	public function checklogin() {
		if($this->RequestHandler->isAjax()){
			$this->autoRender = false;
			// $physicianUser = $this->Session->read('medtrakLogin');
			$physicianUser = $this->Session->read('Auth.User');
			$this->log($physicianUser, 'nolnow');
			if(!empty($physicianUser['id']) && isset($physicianUser['id'])){
				$loggedIn = 1;
			} else {
				$loggedIn = 0;
			}
			return $loggedIn;
		}
	}
	
	
}
