<?php
App::uses('LimSoap','LimSoap');

class UserService extends LimSoap {
	
	public static function registerServices($server, $baseendpoint, $namespace=null)
	{
		
		$server->register(
				'UserService.login',					//function
				array(
					'applicationkey' => 'xsd:string', 
					'username'=>'xsd:string', 
					'password'=>'xsd:string', 
					'datetime'=>'xsd:dateTime',
					'token'=>'xsd:string'
				),
				array('return' => 'tns:ResultToken'), 		//return
				$namespace,
				$baseendpoint.'/login' 	//endpoint
		);
		
		$server->register(
				'UserService.logout',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken'
				),
				array('return' => 'tns:ResultToken'), 		//return
				$namespace,
				$baseendpoint.'/logout' 	//endpoint
		);		

		$server->register(
				'UserService.getUser',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken',
					'username'=>'xsd:string'
				),
				array('return' => 'tns:UserResult'), 		//return
				$namespace,
				$baseendpoint.'/getUser' 	//endpoint
		);			
		
		$server->register(
				'UserService.getUserIdentities',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken',
					'username'=>'xsd:string'
				),
				array('return' => 'tns:UserIdentitiesResult'), 		//return
				$namespace,
				$baseendpoint.'/getUserIdentities' 	//endpoint
		);		

		$server->register(
				'UserService.getBasicInfo',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken',
					'id'=>'xsd:int'
				),
				array('return' => 'tns:PersonResult'), 		//return
				$namespace,
				$baseendpoint.'/getBasicInfo' 	//endpoint
		);
		
		$server->register(
				'UserService.getDetailInfo',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken',
					'id'=>'xsd:long' //personid
				),
				array('return' => 'tns:PersonDetailResult'), 		//return
				$namespace,
				$baseendpoint.'/getDetailInfo' 	//endpoint
		);	

		$server->register( //get user Laboratory membership
				'UserService.getMemberships',					//function
				array(
					'executiontoken' => 'tns:ExecutionToken', 
					'id'=>'xsd:long' //userid
				),
				array('return' => 'tns:MembershipsResult'), 		//return
				$namespace,
				$baseendpoint.'/getMemberships' 	//endpoint
		);	


	}
	
	public static function registerComplexTypes($server, $servicepath)
	{
		LimSoap::addComplexType($server);
		/*LimSoap::addComplexType($server, 'AccessToken');
		LimSoap::addComplexType($server, 'ResultToken');
		LimSoap::addComplexType($server, 'ExecutionToken');
		LimSoap::addComplexType($server, 'ContactInformation');
		LimSoap::addComplexType($server, 'ContactInformations');
		LimSoap::addComplexType($server, 'Address');
		LimSoap::addComplexType($server, 'Addresses');
		LimSoap::addComplexType($server, 'Person');
		LimSoap::addComplexType($server, 'People');
		LimSoap::addComplexType($server, 'PersonIdentity');
		LimSoap::addComplexType($server, 'PersonIdentities');
		LimSoap::addComplexType($server, 'PersonIdentification');
		LimSoap::addComplexType($server, 'PersonIdentifications');
		LimSoap::addComplexType($server, 'PersonAddress');
		LimSoap::addComplexType($server, 'PersonAddresses');
		LimSoap::addComplexType($server, 'PersonAlias');
		LimSoap::addComplexType($server, 'PersonAliases');
		LimSoap::addComplexType($server, 'PersonContactInformation');
		LimSoap::addComplexType($server, 'PersonContactInformations');
		LimSoap::addComplexType($server, 'PersonInsurance');
		LimSoap::addComplexType($server, 'PersonInsurances');		
		LimSoap::addComplexType($server, 'PersonDetail');
		LimSoap::addComplexType($server, 'PersonDetails');
		LimSoap::addComplexType($server, 'Membership');
		LimSoap::addComplexType($server, 'Memberships');
		
		LimSoap::addComplexType($server, 'User');
		LimSoap::addComplexType($server, 'UserIdentities');
		LimSoap::addComplexType($server, 'UserResult');
		LimSoap::addComplexType($server, 'UserIdentitiesResult');
		LimSoap::addComplexType($server, 'PersonResult');
		LimSoap::addComplexType($server, 'PersonDetailResult');		
		LimSoap::addComplexType($server, 'MembershipsResult');*/
	}

	function getUser($executiontoken, $username)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		App::import('Model',array('Model','User'));
		$userModel = new User();	
		
		$user=$userModel->find('first',array(
			'conditions'=>array('username'=>$username),
			'recursive'=>-1
		));
		
		if ($user)
		{
			$resultToken=$this->__createResultToken($executiontoken,1,$user);
			
			$userModel->log($resultToken,'debug');
			
			return $resultToken;
		}
		
		return $this->__createResultToken($executiontoken);		
	}	
	
	function getUserIdentities($executiontoken, $username)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		App::import('Model',array('Model','User'));
		$userModel = new User();	
		
		$userModel->Behaviors->load('Containable');
		$user=$userModel->find('first',array(
			'conditions'=>array('username'=>$username),
			'contain'=>array(
				'PersonIdentity'=>array(
					'User'=>array('id'),
					'Person'
				)
			)
		));
		
		if ($user)
		{
			$user['User']['PersonIdentity']=$user['PersonIdentity'];
			unset($user['PersonIdentity']);

			
			$resultToken=$this->__createResultToken($executiontoken,1,array('UserIdentities'=>$user['User']));
			
			$userModel->log($resultToken,'debug');
			
			return $resultToken;
		}
		
		return $this->__createResultToken($executiontoken);		
	}
	
	function getBasicInfo($executiontoken, $personid)
	{	
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		App::import('Model',array('Model','Person'));
		$personModel = new Person();	
		
		$person=$personModel->find('first',array(
			'conditions'=>array('id'=>$personid),
			'recursive'=>-1
		));
		
		if ($person)
		{
			//LimSoap::__computechecksum($person['Person']);
			$personModel->log($person,'debug');
			$resultToken=$this->__createResultToken($executiontoken,1,$person);
			
			return $resultToken;
		}
		
		return $this->__createResultToken($executiontoken);
	}
	
	function getDetailInfo($executiontoken, $personid)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		//App::import('Model',array('Model','User','Person','PersonIdentification','PersonAddress','PersonAlias','PersonInsurance','PersonContactInformation','ContactInformation','Address'));
		App::import('Model',array('Model','Person'));
		
		$personModel = new Person();
		
		$personModel->log('here','debug');
		
		$personModel->Behaviors->load('Containable');
		$personInfo=$personModel->find('first',array(
			'fields'=>array('id'),
			'conditions'=>array('id'=>$personid),
			'contain'=>array(
				'PersonIdentification'=>array(
					'IdentificationType'
				),
				'PersonAddress'=>array(
					'Address' => array (
						'StreetCode'
					)
				),
				'PersonAlias',
				'PersonInsurance',
				'PersonMark',
				'PersonContactInformation'=>array(
					'ContactInformation'
				)
			)
		));
		
		
		if ($personInfo)
		{
			$personInfo['id']=$personInfo['Person']['id'];
			
			$resultToken=$this->__createResultToken($executiontoken,1,array('PersonDetail'=>$personInfo));
			
			$personModel->log($resultToken,'debug');			
			
			return $resultToken;
		}
		
		return $this->__createResultToken($executiontoken);
	}
	
	function getMemberships($executiontoken, $userid)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		App::import('Model',array('Model','CompanyBranchMember'));
		
		
		$memberModel = new CompanyBranchMember();
		
		$memberModel->Behaviors->load('Containable');
		$members=$memberModel->find('all',array(
			'conditions'=>array('users_id'=>$userid),
			'contain'=>array(
				'CompanyBranch'=>array(
					'Company',
					'Laboratory'
				),
				'User'=>array(
					'fields'=>array('id')
				)
			)
		));
		
		if ($members)
		{
			//$membership['Membership']=$members['Member'];
			$membership=array();
			foreach($members as $key=>$member)
			{
				$member['CompanyBranchMember']['CompanyBranch'] = $member['CompanyBranch'];
				$member['CompanyBranchMember']['User'] = $member['User'];
				unset($member['CompanyBranch']);
				unset($member['User']);
				$membership[]=$member['CompanyBranchMember'];
			}
			
			$resultToken=$this->__createResultToken($executiontoken,1,array('CompanyBranchMembers'=>$membership));			
			
			return $resultToken;
		}
		
		return $this->__createResultToken($executiontoken);
	}	
	
	function get()
	{
		return 'test';
	}
	
	
	
	function login($applicationkey, $username, $password, $datetime, $token)
	{
		$valid=true;
		//query if token was already generated return failure if used
		
		
		//validate application key if this was generated by application
		
		$valid=$this->__validateKeys($applicationkey);
			
		if (!$valid)
			return $this->__createDummyResultToken();
			
		$valid=$this->__validateToken($token);
		
		if (!$valid)
			return $this->__createDummyResultToken();

		CakeLog::write('debug','userlogin');
		CakeLog::write('debug',$applicationkey);
		CakeLog::write('debug',$username);
		CakeLog::write('debug',$password);
		CakeLog::write('debug',$datetime);
		CakeLog::write('debug',$token);
		
		
		$textpassword=$this->__decryptPassword($token, $password);
		CakeLog::write('debug',$this->__encryptPassword($token, $textpassword));
		//$truepassword='asdf';
		
		App::uses('Security', 'Utility');
		CakeLog::write('debug', $textpassword);
		CakeLog::write('debug', Security::hash($textpassword,null,true));
		//$hashpassword=Security::hash($textpassword,null,true);
		$hashpassword=$textpassword;
		
		
		App::import('Model',array('Model','User'));
		$userModel = new User();
		$users=$userModel->find('first',array(
			'conditions'=>array(
				'username'=>$username,
				'password'=>$hashpassword
			),
			'recursive'=>0
		));
		
		CakeLog::write('debug',print_r($users,true));
		
		if (!$users)
			return $this->__createDummyResultToken();
			
		//provide access token here
		$accessToken=$this->__generateAccessToken($username,$textpassword,$datetime,$token);
		//todo: save $accessToken with expiration
		Configure::write('Session.timeout',15);
		Configure::write('Session.cookieTimeout',15);
		$this->__createsession($users, $accessToken);
		
		CakeLog::write('debug',print_r($accessToken,true));

		return $accessToken; //valid
	}
	
	
	function logout($executiontoken)
	{		
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}	

		$resultToken=$this->__createResultToken($executiontoken,1);
		if ($this->__destroysession()) {
			return $resultToken['ResultToken'];
		}
		
		return array('ResultToken'=>$this->__createDummyResultToken());
	}
		
	
}
