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
App::uses('Xml', 'Utility');
class HCWServiceComponent extends Component {
	public $component;
	public $options = array();
	function __construct()
	{
		//Tempo
		Configure::write('Session.timeout',360);
		Configure::write('Session.cookieTimeout',360);
	}
	
	private $client;
	
	//var $controller;
	
	function initialize(Controller $controller)
	{ 
		//$this->controller = $controller;
	}	
	
	function connect()
	{
	      	//sfContext::getInstance()->getLogger()->info("{app_lis_webservice_wsdl_url} ".sfConfig::get("app_lis_webservice_wsdl_url"));
      		//sfContext::getInstance()->getLogger()->info("{app_lis_webservice_host} ".sfConfig::get("app_lis_webservice_host"));
      		//sfContext::getInstance()->getLogger()->info("{app_lis_webservice_port} ".sfConfig::get("app_lis_webservice_port"));
			$config = Configure::read('mumps');
// 			$this->log($config,'config');
      		try
			{
				ini_set('default_socket_timeout', 15);
				$this->client=@new Soapclient(
						$config['mumps.webservice_url'],
						array(
								'trace'=>1,
								'style'    => SOAP_DOCUMENT,
								'use'      => SOAP_LITERAL,
								'proxy_host' => $config['mumps.webservice_host'],
								'proxy_port' => $config['mumps.webservice_port'],
								'connection_timeout'=> 15,
								'exceptions'=>1,
								//'local_cert'=>file_get_contents($cert),
								//'passphrase'=>Configure::read("virtualbuddy.passphrase"),
								'login'=>$config['mumps.username'],
								'password'=>$config['mumps.password'],
								'cache_wsdl' => 0
						)
				);
//				$this->log('connected','debug');
			} catch (Exception $e)
			{
				$this->log($e->getMessage());
				//sfContext::getInstance()->getLogger()->err($e->getMessage());
				return false;
			}
			
			return true;
	}
	
	function getPatientByMRNo($PatientId)
	{
		ini_set('default_socket_timeout', 1000);
		try
		{
// 			App::import('Core', 'Xml');
			
			$params=array('MRNo'=>$PatientId,'compressed'=>0);
			
			$ret=$this->client->SearchPatientByMRNo($params);
			
			$this->log($ret,'debug');
			
			$xml = Xml::build($ret->SearchPatientByMRNoResult);
			$patient = Xml::toArray($xml);
			
			
//			$this->log($patient,'debug');
			
			return $patient;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getPatientByName($Name,$Start,$Limit,$LastPaperId)
	{
		
		ini_set('default_socket_timeout', 1000);
		try
		{
			// 			App::import('Core', 'Xml');
				
			$params=array('Name'=>$Name,'Start'=>$Start,'Limit'=>$Limit,'LastPaperId'=>$LastPaperId,'compressed'=>0);
 			$this->log($params,'params');
			$ret=$this->client->SearchPatientByName($params);
				
			//$this->log($ret,'debug');
				
			$xml = Xml::build($ret->SearchPatientByNameResult);
			$patient = Xml::toArray($xml);
				
				
// 			$this->log($patient,'debug');
				
			return $patient;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getCountPatientByName($Name)
	{
		ini_set('default_socket_timeout', 1000);
		try
		{
			// 			App::import('Core', 'Xml');
	
			$params=array('Name'=>$Name,'compressed'=>0);
	
			$ret=$this->client->CountSearchPatientByName($params);
	
			//$this->log($ret,'debug');
	
			$xml = Xml::build($ret->CountSearchPatientByNameResult);
			$patient = Xml::toArray($xml);
	
	
			//			$this->log($patient,'debug');
	
			return $patient;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getDoctorPatientByMRNo($doctorId, $patientId)
	{
//		$this->log($doctorId,'searchPatient');
		ini_set('default_socket_timeout', 1000);
		try
		{
			// 			App::import('Core', 'Xml');
				
			$params=array('DoctorId'=>$doctorId,'MRNo'=>$patientId,'compressed'=>0);
				
			$ret=$this->client->SearchPatientByDoctorMRNo($params);
			$this->log($ret,'searchPatient');
			$xml = Xml::build($ret->SearchPatientByDoctorMRNoResult);
			$patient = Xml::toArray($xml);
				
				
			//			$this->log($patient,'debug');
				
			return $patient;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getDoctorPatient($doctorId, $firstName, $lastName, $lastId)
	{
		ini_set('default_socket_timeout', 1000);
		try
		{
			// 			App::import('Core', 'Xml');
	
			$params=array('DoctorId'=>$doctorId,'FirstName'=>$firstName, 'LastName'=>$lastName, 'LastPatientId'=>$lastId, 'compressed'=>0);
	
			$ret=$this->client->SearchPatientByDoctor($params);
// 			$this->log($ret,'searchPatient');
			$xml = Xml::build($ret->SearchPatientByDoctorResult);
			$patient = Xml::toArray($xml);
			
	
			//			$this->log($patient,'debug');
	
			return $patient;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getPatientLaboratoryOrders($PatientId)
	{
		ini_set('default_socket_timeout', 5000);
		ini_set('max_execution_time', 0);
		try
		{
// 			App::import('Core', 'Xml');
				
			$params=array('PatientId'=>$PatientId,'compressed'=>0);
			$ret=$this->client->GetPatientLaboratoryOrders($params);
				
//			$this->log($ret,'TestOrders');
			//$xmltext = gzdecode($ret->GetLaboratoryOrdersResultResult);
			//$this->log($xmltext,'debug');
// 			$xml = new Xml($ret->GetPatientLaboratoryOrders);
// 			$testorder=$xml->toArray();

			$xml = Xml::build($ret->GetPatientLaboratoryOrdersResult);
			$testordertmp = Xml::toArray($xml);
			
			//$this->log($testorder,'TestOrders');
			$config = Configure::read('mumps');
			$datenowtimestamp = strtotime(date("Y-m-d H:i:s",strtotime('now')));
			$testorder['Orders']['Patient'] = $testordertmp['Orders']['Patient'];
			if(isset($testordertmp['Orders']['Order']['0'])){
				foreach ($testordertmp['Orders']['Order'] as $index=>$order){
					if(!empty($order['released_datetime'])){
						$timestamp = strtotime(
							date('Y-m-d H:i:s',strtotime(
									$order['released_datetime'].'+'.$config['weblis.viewthreshold'].' minutes'
								)
							)
						);
						
						if($datenowtimestamp > $timestamp){
							//$this->log($timestamp,'threshold');
							$testorder['Orders']['Order'][$index] = $order;
						}
					}

				}
			}else{
			
				if(!empty($testordertmp['Orders']['Order']['released_datetime'])){
				
						$timestamp = strtotime(
							date('Y-m-d H:i:s',strtotime(
									$testordertmp['Orders']['Order']['released_datetime'].'+'.$config['weblis.viewthreshold'].' minutes'
								)
							)
						);
						
						if($datenowtimestamp > $timestamp){
						
							//$this->log($timestamp,'threshold');
							$testorder['Orders']['Order']['0'] = $testordertmp['Orders']['Order'];
							//debug($testorder);
						}
					}
			}
//			$this->log($testorder,'TestOrders');
				
			return $testorder;
		} catch (Exception $e)
		{
			$this->log($e->getMessage(),'debug');
		}
	
		return false;
	}
	
	function MedTrakLogin($username, $password)
	{
		ini_set('default_socket_timeout', 1000);
		try
		{
			// 			App::import('Core', 'Xml');
				
			$params=array('UserName'=>$username,'Password'=>$password,'compressed'=>0);
				
			$ret=$this->client->MedtrakLogin($params);
				
//			$this->log($ret,'physician');
				
			$xml = Xml::build($ret->MedtrakLoginResult);
			$physician = Xml::toArray($xml);
				
				
//			$this->log($physician,'physician');
				
			return $physician;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getDoctorPatientBy320Days($doctorId)
	{
		ini_set('default_socket_timeout', 1000);
		try
		{
			// 			App::import('Core', 'Xml');
	
			$params=array('DoctorId'=>$doctorId, 'compressed'=>0);
	
			$ret=$this->client->GetPatiensLast320Days($params);
//			$this->log($ret,'GetPatiensLast320DaysResult');
			$xml = Xml::build($ret->GetPatiensLast320DaysResult);
			$patient = Xml::toArray($xml);
				
	
			//			$this->log($patient,'debug');
	
			return $patient;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
	
	function getLaboratoryOrdersResult($specimenId)
	{
		ini_set('default_socket_timeout', 1000);
		try
		{
// 			App::import('Core', 'Xml');
				
			$params=array('LabEpisode'=>$specimenId,'compressed'=>0);
				
			$ret=$this->client->GetLaboratoryOrdersResult($params);
				
			//$this->log($ret->GetLaboratoryOrdersResultResult,'debug');
			//$xmltext = gzdecode($ret->GetLaboratoryOrdersResultResult);
			//$this->log($xmltext,'debug');
			//$xml = new Xml($ret->GetLaboratoryOrdersResultResult);
				
// 			$tmptestorder=$xml->toArray();
			$xml = Xml::build($ret->GetLaboratoryOrdersResultResult);
			$tmptestorder = Xml::toArray($xml);
				
//			$this->log($tmptestorder,'debug2');
				
			$this->data=array(
					'TestOrder' => array(
							'id'=>$tmptestorder['Epvis']['LabEpisodeNumber'],
							'specimen_id'=>$tmptestorder['Epvis']['LabEpisodeNumber'],
							'order_status'=>1,
							'status'=>6,
							'summary_report'=>''
					),
					'PatientOrder'=>array(
							'specimen_id'=>$tmptestorder['Epvis']['LabEpisodeNumber'],
							'external_specimen_id'=>'',
							'patient_transaction_id'=>0,
							'entry_type'=>1,
							'branch_id'=>2,
							'patient_id'=>$tmptestorder['Epvis']['HospitalEpisodeURNumber'],
							'patient_type'=>1,
							'admission_id'=>null,
							'admission_date'=>null,
							'adminssion_time'=>null,
							'location_id' => 5,
							'date_requested'=>date('Y-m-d',strtotime($tmptestorder['Epvis']['DateTimeOfEntry'])),
							'time_requested'=>date('H:i:s',strtotime($tmptestorder['Epvis']['DateTimeOfEntry'])),
							'clinical_impression'=>'',
							'medical_department_id'=>null,
							'Patient'=>array(
									'last_name'=>$tmptestorder['Epvis']['Paper']['Name'],
									'first_name'=>$tmptestorder['Epvis']['Paper']['Name2'],
									'middle_name'=>$tmptestorder['Epvis']['Paper']['Name3'],
									'id'=>$tmptestorder['Epvis']['HospitalEpisodeURNumber'],
									'sex'=>$tmptestorder['Epvis']['Paper']['SexDR'],
									'birthdate'=>$tmptestorder['Epvis']['Paper']['DOB']
							),
							'Location'=>array(
									'name'=>'Emergency',
									'id'=> 5,
									'LocationGroupDetail'=>array(
											0=>array(
													'id'=>5,
													'location_group_id'=>5,
													'location_id'=>5,
													'LocationGroup'=>array(
															'name'=>'Emergency'
													)
											)
									)
							)
					),
					'PatientOrderPhysician'=>array(
							0=>array(
									'id'=>0,
									'Physican'=>array(
											'first_name'=>'Ronan',
											'last_name'=>'Colobong'
									)
							)
					),
					'TestResult'=>array(
					)
			);
				
				
			if (!isset($tmptestorder['Epvis']['Vists']['Vists'][0])) //one test result
			{
				$this->data['TestResult'][]=array(
						'id'=>0,
						'result_status'=>0,
						'test_group_id'=>'',
						'order_status'=>1,
						'release_level_id'=>1,
						'release_date'=>date('Y-m-d',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
						'release_time'=>date('Y-m-d',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
						'pathologist_user_id'=>0,
						'medtech_user_id'=>0,
						'order_type'=>0,
						'lab_notes'=>'',
						'printed' =>1,
						'TestGroup'=>array(
								'name'=>$tmptestorder['Epvis']['Vists']['Vists']['Ctts']['Name'],
								'test_group_form'=> '/test_group_form/hccbconly'
						),
						'TestResultSpecimen'=>array(
								'extract_date'=>date('Y-m-d',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
								'extract_time'=>date('H:i:s',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
								'extracting_user_id'=>0,
								'extracting_remarks'=>'',
								'accepted_date'=>date('Y-m-d',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
								'accepted_time'=>date('H:i:s',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
								'accepting_user_id'=>0,
								'checkin_user_id'=>0,
								'checkin_date'=>date('Y-m-d',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange'])),
								'checkin_time'=>date('H:i:s',strtotime($tmptestorder['Epvis']['Vists']['Vists']['DateTimeOfLastChange']))
						),
						'TestOrderDetail'=>array()
				);
					
				if (!isset($tmptestorder['Epvis']['Vists']['Vists']['Vistd'][0])) {
					$this->data['TestResult'][0]['TestOrderDetail'][]=array(
							'order_status' => 1,
							'test_id'=>$tmptestorder['Epvis']['Vists']['Vists']['Vistd']['Cttc']['Code'],
							'TestCode'=>array(
									'name'=>$tmptestorder['Epvis']['Vists']['Vists']['Vistd']['Cttc']['Desc']
							),
							'instrument_id'=>null,
							'result_type'=>2,
							'result_status'=>2,
							'result_count'=>1,
							'action_status'=>1,
							'status'=>1,
							'TestOrderResult'=>array(
									'status'=>0,
									'result_flag'=>(!empty($vistd['Flag'])?$vistd['Flag']:''),
									'value'=>$vistd['TestData'],
									'unit'=>(!empty($tmptestorder['Epvis']['Vists']['Vists']['Vistd']['Cttc']['Units'])?base64_decode($tmptestorder['Epvis']['Vists']['Vists']['Vistd']['Cttc']['Units']):''),
									'reference_range'=>$vistd['ReferenceRange'],
									'conventional_value'=>null,
									'conventional_unit'=>null,
									'conventional_reference_range'=>null,
									'cut_off'=>0,
									'remarks'=>''
							)
					);
				} else
				foreach($tmptestorder['Epvis']['Vists']['Vists']['Vistd'] as $keyvistd=>$vistd) { //check if only one
					$this->data['TestResult'][0]['TestOrderDetail'][]=array(
							'order_status' => 1,
							'test_id'=>$vistd['Cttc']['Code'],
							'TestCode'=>array(
									'name'=>$vistd['Cttc']['Desc']
							),
							'instrument_id'=>null,
							'result_type'=>2,
							'result_status'=>2,
							'result_count'=>1,
							'action_status'=>1,
							'status'=>1,
							'TestOrderResult'=>array(
									'status'=>0,
									'result_flag'=>(!empty($vistd['Flag'])?$vistd['Flag']:''),
									'value'=>$vistd['TestData'],
// 									'unit'=>base64_decode($vistd['Cttc']['Units']),
									'unit'=>(!empty($vistd['Vistd']['Cttc']['Units'])?base64_decode($vistd['Vistd']['Cttc']['Units']):''),
									'reference_range'=>$vistd['ReferenceRange'],
									'conventional_value'=>null,
									'conventional_unit'=>null,
									'conventional_reference_range'=>null,
									'cut_off'=>0,
									'remarks'=>''
							)
					);
				}
			} else {
		
				$testresultindex=0;
				foreach($tmptestorder['Epvis']['Vists']['Vists'] as $vistskey=>$vistsvalue) {
					$this->data['TestResult'][]=array(
							'id'=>0,
							'result_status'=>0,
							'test_group_id'=>'',
							'order_status'=>1,
							'release_level_id'=>1,
							'release_date'=>date('Y-m-d',strtotime($vistsvalue['DateTimeOfLastChange'])),
							'release_time'=>date('Y-m-d',strtotime($vistsvalue['DateTimeOfLastChange'])),
							'pathologist_user_id'=>0,
							'medtech_user_id'=>0,
							'order_type'=>0,
							'lab_notes'=>'',
							'printed' =>1,
							'TestGroup'=>array(
									'name'=>$vistsvalue['Ctts']['Name'],
									'test_group_form'=> '/test_group_form/hccbconly'
							),
							'TestResultSpecimen'=>array(
									'extract_date'=>date('Y-m-d',strtotime($vistsvalue['DateTimeOfLastChange'])),
									'extract_time'=>date('H:i:s',strtotime($vistsvalue['DateTimeOfLastChange'])),
									'extracting_user_id'=>0,
									'extracting_remarks'=>'',
									'accepted_date'=>date('Y-m-d',strtotime($vistsvalue['DateTimeOfLastChange'])),
									'accepted_time'=>date('H:i:s',strtotime($vistsvalue['DateTimeOfLastChange'])),
									'accepting_user_id'=>0,
									'checkin_user_id'=>0,
									'checkin_date'=>date('Y-m-d',strtotime($vistsvalue['DateTimeOfLastChange'])),
									'checkin_time'=>date('H:i:s',strtotime($vistsvalue['DateTimeOfLastChange']))
							),
							'TestOrderDetail'=>array()
					);
						
					if (!isset($vistsvalue['Vistd'][0])) {
						$this->data['TestResult'][$testresultindex]['TestOrderDetail'][]=array(
								'order_status' => 1,
								'test_id'=>$vistsvalue['Vistd']['Cttc']['Code'],
								'TestCode'=>array(
										'name'=>$vistsvalue['Vistd']['Cttc']['Desc']
								),
								'instrument_id'=>null,
								'result_type'=>2,
								'result_status'=>2,
								'result_count'=>1,
								'action_status'=>1,
								'status'=>1,
								'TestOrderResult'=>array(
										'status'=>0,
										'result_flag'=>(!empty($vistsvalue['Vistd']['Flag'])?$vistsvalue['Vistd']['Flag']:''),
										'value'=>$vistsvalue['Vistd']['TestData'],
										'unit'=>(!empty($vistsvalue['Vistd']['Cttc']['Units'])?base64_decode($vistsvalue['Vistd']['Cttc']['Units']):''),
										'reference_range'=>$vistsvalue['Vistd']['ReferenceRange'],
										'conventional_value'=>null,
										'conventional_unit'=>null,
										'conventional_reference_range'=>null,
										'cut_off'=>0,
										'remarks'=>''
								)
						);
					} else {
						foreach($vistsvalue['Vistd'] as $keyvistd=>$vistd) { //check if only one
							$this->data['TestResult'][$testresultindex]['TestOrderDetail'][]=array(
									'order_status' => 1,
									'test_id'=>$vistd['Cttc']['Code'],
									'TestCode'=>array(
											'name'=>$vistd['Cttc']['Desc']
									),
									'instrument_id'=>null,
									'result_type'=>2,
									'result_status'=>2,
									'result_count'=>1,
									'action_status'=>1,
									'status'=>1,
									'TestOrderResult'=>array(
											'status'=>0,
											'result_flag'=>(!empty($vistd['Flag'])?$vistd['Flag']:''),
											'value'=>$vistd['TestData'],
											'unit'=>(!empty($vistd['Cttc']['Units'])?base64_decode($vistd['Cttc']['Units']):''),
											'reference_range'=>$vistd['ReferenceRange'],
											'conventional_value'=>null,
											'conventional_unit'=>null,
											'conventional_reference_range'=>null,
											'cut_off'=>0,
											'remarks'=>''
									)
							);
						}
					}
					$testresultindex++;
				}
			}
				
//			$this->log($this->data,'TestOrder');
			//Post to Mro Service
			
			return $this->data;
		} catch (Exception $e)
		{
			$this->log($e->getMessage());
		}
	
		return false;
	}
}
