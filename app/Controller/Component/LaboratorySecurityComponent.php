<?php
/**
 * LaboratorySecurity component
 *
 * Manages user logins and permissions.
 *
 * PHP 5
 */

App::uses('Component', 'Controller');
App::uses('Router', 'Routing');
App::uses('PostSecurity', 'Controller/Component');
class LaboratorySecurityComponent extends Component {
	public $component;
	public $options = array();
	function __construct()
	{
		//Tempo
		Configure::write('Session.timeout',360);
		Configure::write('Session.cookieTimeout',360);
	}
	public function initialize($controller) {
		
		$this->controller = $controller;
		
	}
	
	function getLaboratoryBasicInfo($executiontoken, $laboratoryid)
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
	
	function getBranchDetailInfo($executiontoken, $companyBranchId)
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
