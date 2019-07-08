<?php
class PatientService {
	//static $controller;
	
	public static function registerServices($server, $baseendpoint)
	{
		$server->register(
				'PatientService.get',					//function
				array(),								//parameters
				array('return' => 'xsd:string'), 		//return
				null,
				$baseendpoint.'/get' 	//endpoint
		);	
	}
	
	public static function registerComplexTypes($server, $servicepath)
	{
		
	}		
	
	function hello()
	{
		//method 1
		//App::import('Controller', 'LimsController');
        //self::$controller = new LimsController;
        //self::$controller->constructClasses();

		//method 2
		//App::uses('ClassRegistry','Utility');
		//$users=self::$controller->log(ClassRegistry::getObject('controller'),'debug');
		//self::$controller->log('ronan','debug');
		//$users=self::$controller->User->find('all');
		//self::$controller->log($users,'debug');
		//return 'ronan the pogi '.$users[0]['User']['username'];
		
		//method 3
		App::import('Model',array('Model','User'));
		$userModel = new User();
		$users=$userModel->find('all');
		//return 'ronan the pogi '.$users[0]['User']['username'];
		//$event = new EventObject();
		//$event->MemberNumber =1;
		//$event->WebMemberID =2;
		//return $event;
		
		return array('MemberNumber'=>3,'WebMemberID'=>4);
		
		//return array('MemberNumber'=>1,'WebNumber'=>2);
		//return new soap_val()
	}
	
	function get()
	{
		return 'Patient Get Richard';
	}
}
