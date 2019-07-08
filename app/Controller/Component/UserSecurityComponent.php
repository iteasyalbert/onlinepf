<?php
/**
 * UserSecurity component
 *
 * Manages user logins and permissions.
 *
 * PHP 5
 */

App::uses('Component', 'Controller');
App::uses('Router', 'Routing');
App::uses('PostSecurity', 'Controller/Component');
class UserSecurityComponent extends Component {
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
		$this->PostSecurity = new PostSecurityComponent(new PostSecurityComponent());
	}
	
	
	function getUser($executiontoken, $username)
	{
		
		if (!$this->PostSecurity->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
		}
	
		App::import('Model',array('Model','User'));
		$userModel = new User();
	
		$user=$userModel->find('first',array(
				'conditions'=>array('username'=>$username),
				'recursive'=>-1
		));
		
		if ($user)
		{
			$resultToken=$this->PostSecurity->__createResultToken($executiontoken,1,$user);
				
			$userModel->log($resultToken,'debug');
				
			return $resultToken;
		}
	
		return $this->PostSecurity->__createResultToken($executiontoken);
	}
	
	function getUserIdentities($executiontoken, $username)
	{
		if (!$this->PostSecurity->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
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
	
				
			$resultToken=$this->PostSecurity->__createResultToken($executiontoken,1,array('UserIdentities'=>$user['User']));
				
			$userModel->log($resultToken,'debug');
				
			return $resultToken;
		}
	
		return $this->PostSecurity->__createResultToken($executiontoken);
	}
	
	function getBasicInfo($executiontoken, $personid)
	{
		if (!$this->PostSecurity->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
		}
	
		App::import('Model',array('Model','Person'));
		$personModel = new Person();
	
		$person=$personModel->find('first',array(
				'conditions'=>array('id'=>$personid),
				'recursive'=>-1
		));
	
		if ($person)
		{
			$personModel->log($person,'debug');
			$resultToken=$this->PostSecurity->__createResultToken($executiontoken,1,$person);
				
			return $resultToken;
		}
	
		return $this->PostSecurity->__createResultToken($executiontoken);
	}
	
	function getDetailInfo($executiontoken, $personid)
	{
		if (!$this->PostSecurity->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
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
				
			$resultToken=$this->PostSecurity->__createResultToken($executiontoken,1,array('PersonDetail'=>$personInfo));
				
			$personModel->log($resultToken,'debug');
				
			return $resultToken;
		}
	
		return $this->PostSecurity->__createResultToken($executiontoken);
	}
	
	function getMemberships($executiontoken, $userid)
	{
		if (!$this->PostSecurity->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
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
				
			$resultToken=$this->PostSecurity->__createResultToken($executiontoken,1,array('CompanyBranchMembers'=>$membership));
				
			return $resultToken;
		}
	
		return $this->PostSecurity->__createResultToken($executiontoken);
	}
	
	function login($applicationkey, $username, $password, $datetime, $token)
	{
		$valid=true;
		//query if token was already generated return failure if used
	
	
		//validate application key if this was generated by application
	
		$valid=$this->PostSecurity->__validateKeys($applicationkey);
			
		if (!$valid)
			return $this->PostSecurity->__createDummyResultToken();
			
		$valid=$this->PostSecurity->__validateToken($token);
	
		if (!$valid)
			return $this->PostSecurity->__createDummyResultToken();
	
		CakeLog::write('debug','userlogin');
		CakeLog::write('debug',$applicationkey);
		CakeLog::write('debug',$username);
		CakeLog::write('debug',$password);
		CakeLog::write('debug',$datetime);
		CakeLog::write('debug',$token);
	
	
		$textpassword=$this->PostSecurity->__decryptPassword($token, $password);
		CakeLog::write('debug',$this->PostSecurity->__encryptPassword($token, $textpassword));
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
			return $this->PostSecurity->__createDummyResultToken();
			
		//provide access token here
		$accessToken=$this->PostSecurity->__generateAccessToken($username,$textpassword,$datetime,$token);
		//todo: save $accessToken with expiration
		Configure::write('Session.timeout',15);
		Configure::write('Session.cookieTimeout',15);
		$this->PostSecurity->__createsession($users, $accessToken);
		CakeLog::write('debug',print_r($accessToken,true));
	
		return $accessToken; //valid
	}
	
	
	function logout($executiontoken)
	{
		if (!$this->PostSecurity->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
		}
	
		$resultToken=$this->PostSecurity->__createResultToken($executiontoken,1);
		if ($this->PostSecurity->__destroysession()) {
			return $resultToken['ResultToken'];
		}
	
		return array('ResultToken'=>$this->PostSecurity->__createDummyResultToken());
	}
	
	
}
