<?php
App::uses('LimSoap','LimSoap');

class LaboratoryService extends LimSoap  {
	public static function registerServices($server, $baseendpoint, $namespace)
	{
		$server->register(
				'LaboratoryService.getBasicInfo', //function
				array(	'executiontoken' => 'tns:ExecutionToken',
						'id'=>'xsd:long'), //laboratory_id	
				array('return' => 'tns:LaboratoryResult'), 		//return
				$namespace,
				$baseendpoint.'/getBasicInfo' 	//endpoint
		);	

		$server->register(
				'LaboratoryService.getDetailInfo', //function
				array(	'executiontoken' => 'tns:ExecutionToken',
						'id'=>'xsd:long'), //laboratory_id	
				array('return' => 'tns:LaboratoryDetailResult'), 		//return
				$namespace,
				$baseendpoint.'/getDetailInfo' 	//endpoint
				
		);
		
		$server->register(
				'LaboratoryService.registerApplicationKey',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken',
					'id' => 'xsd:long',
					'applicationkey' => 'xsd:string'
				),
				array('return' => 'tns:ResultToken'), 		//return
				$namespace,
				$baseendpoint.'/registerApplicationKey' 	//endpoint
		);		
	}
	
	public static function registerComplexTypes($server, $servicepath)
	{
		/*LimSoap::addComplexType($server, 'ExecutionToken');
		LimSoap::addComplexType($server, 'Laboratory');
		LimSoap::addComplexType($server, 'Laboratories');
		LimSoap::addComplexType($server, 'CompanyBranchContactInformation');
		LimSoap::addComplexType($server, 'CompanyBranchContactInformations');
		LimSoap::addComplexType($server, 'CompanyBranchAddress');
		LimSoap::addComplexType($server, 'CompanyBranchAddresses');		
		LimSoap::addComplexType($server, 'CompanyBranchOperatingHour');
		LimSoap::addComplexType($server, 'CompanyBranchOperatingHours');
		LimSoap::addComplexType($server, 'LaboratoryAcceptedInsurance');
		LimSoap::addComplexType($server, 'LaboratoryAcceptedInsurances');
		LimSoap::addComplexType($server, 'CompanyBranchDetail');
		LimSoap::addComplexType($server, 'CompanyBranchDetails');	

		
		LimSoap::addComplexType($server, 'LaboratoryResult');
		LimSoap::addComplexType($server, 'LaboratoryDetailResult');*/
	}	
	
	function getBasicInfo($executiontoken, $laboratoryid)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		App::import('Model',array('Model','Laboratory'));
		
		$laboratoryModel = new Laboratory();
		
		$laboratoryModel->Behaviors->load('Containable');
		$laboratory=$laboratoryModel->find('first',array(
			'conditions'=>array('Laboratory.id'=>$laboratoryid),
			'contain'=>array(
				'CompanyBranch'=>array(
					'Company'=>array(
						'Industry'
					)
				)
			)
		));
		
		//$log = $laboratoryModel->getDataSource()->getLog(false, false);
		//debug($log);
		
		if ($laboratory)
		{
			$laboratoryModel->log($laboratory,'debug');
			
			$laboratory['Laboratory']['CompanyBranch']=$laboratory['CompanyBranch'];
			unset($laboratory['CompanyBranch']);
			$resultToken=$this->__createResultToken($executiontoken,1,$laboratory);			
			
			return $resultToken;
		}
		
		return $this->__createResultToken($executiontoken);		
	}
	
	function getDetailInfo($executiontoken, $companyBranchId)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		App::import('Model',array('Model','CompanyBranch'));
		
		
		$companyBranchModel = new CompanyBranch();
		
		$companyBranchModel->Behaviors->load('Containable');
		$labInfo=$companyBranchModel->find('first',array(
			'fields'=>array('id'),
			'conditions'=>array('CompanyBranch.id'=>$companyBranchId),
			'contain'=>array(
				'CompanyBranchInfo',
				'CompanyBranchAddress'=>array(
					'Address' => array (
						'StreetCode'
					)
				),
				'CompanyBranchContactInformation'=>array(
					'ContactInformation'
				),	
				'CompanyBranchService'=>array(
					'Service'
				),					
				'CompanyBranchOperatingHour',
				'CompanyBranchAccreditation'=>array(
					'Accreditation'
				),
				//'LaboratoryAcceptedInsurance'
				//Todo:other info
			)
		));
		
		//debug($labInfo);
		
		if ($labInfo)
		{
			$labInfo['id']=$labInfo['CompanyBranch']['id'];
			unset($labInfo['CompanyBranch']);
			$companyBranchModel->log(array('CompanyDetail'=>$labInfo),'debug');
			$resultToken=$this->__createResultToken($executiontoken,1,array('LaboratoryDetail'=>array('CompanyDetail'=>$labInfo)));
			return $resultToken;
		}
		
		return null;
	}
	
	function registerApplicationKey($executiontoken, $id, $applicationkey)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		
		$valid=$this->__validateKeys($applicationkey);
			
		if (!$valid)
			return $this->__createDummyResultToken();
					
		
		//App::import('Model',array('Model','User','Person','PersonIdentification','PersonAddress','PersonAlias','PersonInsurance','PersonContactInformation','ContactInformation','Address'));
		App::import('Model',array('Model','CompanyBranch'));
		
		$companyBranchModel = new CompanyBranch();	
		
		$companyBranch = $companyBranchModel->find('first',array(
			'conditions'=>array('id'=>$id),
			'recursive'=>-1
		));
		
		if ($companyBranch)
		{
			$session = $this->__getsession();
			//debug($session);
			$companyBranchMember = $companyBranchModel->CompanyBranchMember->find('first',array(
				'company_branch_id'=>$id,
				'users_id'=>$session['user']['id']
			));
			
			if ($companyBranchMember)
			{
				$companyBranch = array();
				$companyBranch['id'] = $id;
				$companyBranch['application_key']=$applicationkey;
				if ($companyBranchModel->save($companyBranch)) {
					$resultToken=$this->__createResultToken($executiontoken,1);
					return $resultToken['ResultToken'];
				}			
					
			} else
				return $this->__createDummyResultToken();
		}
		
		
		
		
		
		
		return $this->__createDummyResultToken();
	}	
}