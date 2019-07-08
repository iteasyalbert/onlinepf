<?php
App::uses('LimSoap','LimSoap');

class LimPostingService extends LimSoap {
	
	function __construct()
	{
		//Tempo
		Configure::write('Session.timeout',360);
		Configure::write('Session.cookieTimeout',360);
	}

	public static function registerServices($server, $baseendpoint, $namespace=null)
	{
		$server->register(
				'LimPostingService.begin',					//function
		array(
					'executiontoken' => 'tns:ExecutionToken',
					'type'=>'xsd:int'
					),
					array('return' => 'tns:BeginLimPostingResult'), 		//return
					$namespace,
					$baseendpoint.'/begin' 	//endpoint
					);

					$server->register(
				'LimPostingService.commit',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/commit' 	//endpoint
					);

					$server->register(
				'LimPostingService.discard',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/discard' 	//endpoint
					);

					$server->register(
				'LimPostingService.user',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'user'=>'tns:User'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/user' 	//endpoint
					);
					
					$server->register(
							'LimPostingService.companyBranchMember',					//function
							array(
									'executiontoken' => 'tns:ExecutionToken',
									'session_id'=>'xsd:string',
									'company_branch_member'=>'tns:CompanyBranchMember'
							),
							array('return' => 'tns:ResultToken'), 		//return
							$namespace,
							$baseendpoint.'/companyBranchMember' 	//endpoint
					);					

					$server->register(
				'LimPostingService.streetCode',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'streetcode'=>'tns:StreetCode'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/streetCode' 	//endpoint
					);

					$server->register(
				'LimPostingService.address',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'address'=>'tns:Address'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/address' 	//endpoint
					);

					$server->register(
				'LimPostingService.personAddress',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'person_address'=>'tns:PersonAddress',
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/personAddress' 	//endpoint
					);

					$server->register(
				'LimPostingService.personContactInformation',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'person_contact_information'=>'tns:PersonContactInformation'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/personContactInformation' 	//endpoint
					);

					$server->register(
				'LimPostingService.contactInformation',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'contact_information'=>'tns:ContactInformation'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/contactInformation' 	//endpoint
					);

					$server->register(
				'LimPostingService.patient',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'patient'=>'tns:Patient'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/patient' 	//endpoint
					);

					$server->register(
				'LimPostingService.person',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'person'=>'tns:Person'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/person' 	//endpoint
					);

					$server->register(
				'LimPostingService.personIdentity',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'person_identity'=>'tns:PersonIdentity'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/personIdentity' 	//endpoint
					);
					
					$server->register(
				'LimPostingService.personMark',					//function
					array(
							'executiontoken' => 'tns:ExecutionToken',
							'session_id'=>'xsd:string',
							'person_mark'=>'tns:PersonMark'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/personMark' 	//endpoint
					);

					$server->register(
				'LimPostingService.personMarkImage',					//function
							array(
									'executiontoken' => 'tns:ExecutionToken',
									'session_id'=>'xsd:string',
									'id'=>'xsd:long',
									'part'=>'xsd:int',
									'image'=>'xsd:string',
							),
							array('return' => 'tns:ResultToken'), 		//return
							$namespace,
							$baseendpoint.'/personMarkImage' 	//endpoint
					);					

					$server->register(
				'LimPostingService.personDetail',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'person_detail'=>'tns:PersonDetail'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/personDetail' 	//endpoint
					);

					$server->register(
				'LimPostingService.patientOrder',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'patient_order'=>'tns:LaboratoryPatientOrder'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/patientOrder' 	//endpoint
					);

					$server->register(
				'LimPostingService.patientBatchOrder',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'patient_batch_order'=>'tns:LaboratoryPatientBatchOrder'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/patientBatchOrder' 	//endpoint
					);

					$server->register(
				'LimPostingService.package',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'package'=>'tns:LaboratoryPackage'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/package' 	//endpoint
					);

					$server->register(
				'LimPostingService.testSet',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_set'=>'tns:LaboratoryTestSet'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testSet' 	//endpoint
					);

					$server->register(
				'LimPostingService.testConvertion',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_convertion'=>'tns:LaboratoryTestConvertion'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testConvertion' 	//endpoint
					);

					$server->register(
				'LimPostingService.testInterpretation',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_interpreation'=>'tns:LaboratoryTestInterpretation'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testInterpretation' 	//endpoint
					);

					$server->register(
				'LimPostingService.testReferenceRange',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_reference_range'=>'tns:LaboratoryTestReferenceRange'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testReferenceRange' 	//endpoint
					);

					$server->register(
				'LimPostingService.testGroup',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_group'=>'tns:LaboratoryTestGroup'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testGroup' 	//endpoint
					);

					$server->register(
				'LimPostingService.testGroupDetail',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_group_detail'=>'tns:LaboratoryTestGroupDetail'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testGroupDetail' 	//endpoint
					);

					$server->register(
				'LimPostingService.test',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test'=>'tns:LaboratoryTest'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/test' 	//endpoint
					);

					$server->register(
				'LimPostingService.physician',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'physician'=>'tns:Physician'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/physician' 	//endpoint
					);

					$server->register(
				'LimPostingService.physicianProfile',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'physician_profile'=>'tns:PhysicianProfile'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/physicianProfile' 	//endpoint
					);

					$server->register(
				'LimPostingService.testGroupPrice',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_group_price'=>'tns:LaboratoryTestGroupPrice'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testGroupPrice' 	//endpoint
					);

					$server->register(
				'LimPostingService.packageTestGroup',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'package_test_group'=>'tns:LaboratoryPackageTestGroup'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/packageTestGroup' 	//endpoint
					);

					$server->register(
				'LimPostingService.packageDetail',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'package_detail'=>'tns:LaboratoryPackageDetail'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/packageDetail' 	//endpoint
					);

					$server->register(
				'LimPostingService.patientBatchOrderPackage',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'patient_batch_order_package'=>'tns:LaboratoryPatientBatchOrderPackage'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/patientBatchOrderPackage' 	//endpoint
					);

					$server->register(
				'LimPostingService.patientBatchOrderDiscount',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'patient_batch_order_discount'=>'tns:LaboratoryPatientBatchOrderDiscount'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/patientBatchOrderDiscount' 	//endpoint
					);

					$server->register(
				'LimPostingService.patientBatchOrderDetail',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'patient_batch_order_detail'=>'tns:LaboratoryPatientBatchOrderDetail'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/patientBatchOrderDetail' 	//endpoint
					);

					$server->register(
				'LimPostingService.testOrder',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_order'=>'tns:LaboratoryTestOrder'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testOrder' 	//endpoint
					);

					$server->register(
				'LimPostingService.testOrderPackage',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_order_package'=>'tns:LaboratoryTestOrderPackage'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testOrderPackage' 	//endpoint
					);

					$server->register(
				'LimPostingService.testOrderResult',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'test_order_result'=>'tns:LaboratoryTestOrderResult'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/testOrderResult' 	//endpoint
					);

					$server->register(
				'LimPostingService.discount',					//function
					array(
					'executiontoken' => 'tns:ExecutionToken',
					'session_id'=>'xsd:string',
					'discount'=>'tns:Discount'
					),
					array('return' => 'tns:ResultToken'), 		//return
					$namespace,
					$baseendpoint.'/discount' 	//endpoint
					);


	}

	public static function registerComplexTypes($server, $servicepath)
	{
		//LimSoap::addComplexType($server);
	}

	//type
	//  1 - patients
	//	2 - users
	//  3 - physicians

	//	20 - person_identities

	//	50 - people
	//	51 - person_addresses
	//	52 - person_contact_informations
	//	53 - addresses
	//	54 - contact_informations
	//	55 - street_codes

	//	70 - patient_orders
	//  71 - patient_batch_orders

	function begin($executiontoken, $type)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','posting begin type');
		CakeLog::write('debug',$type);

		$sesion=array();
		while (true)
		{
			//Todo: save ipaddress
			//		ipaddress must be checked before saving the post!!!!
			$session['BeginLimPosting']['session_id']=md5(String::uuid());
			$session['BeginLimPosting']['type']=$type;
			$sess=Cache::read($session['BeginLimPosting']['session_id']);
			CakeLog::write('debug',print_r($sess,true));
			if (empty($sess))
			{
				Cache::write($session['BeginLimPosting']['session_id'],
				array('BeginLimPosting'=>$session['BeginLimPosting'])
				);
				break;
			} else
			{
				//Todo: check if need removal
			}
				
			break;
		}


		if (!empty($session))
		{
			$resultToken=$this->__createResultToken($executiontoken,1,$session);
				
			return $resultToken;
		}

		return $this->__createResultToken($executiontoken);
	}

	function commit($executiontoken, $session_id)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		$sess=Cache::read($session_id);
		if (!isset($sess['Committing']))
		{
			$sess['Committing']=true;
			Cache::write($session_id,
				$sess
			);
		}
		else
			return $this->__createResultToken($executiontoken,2); //commiting
		
		
		CakeLog::write('debug','Commit Session');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($sess,true));
		
		$models = App::objects('model');
		App::import('Model',array('Model'));
		App::import('Model',$models );
		
		foreach($models as $key=>$model)
		{
			$this->$model = new $model; 
		}
		
		//App::import('Model',array('Model','PatientOrder'));
		//$patientOrderModel = new PatientOrder();
		
		$bSuccess = true;
		
		$this->LaboratoryPatientOrder->begin();
		
		if ($bSuccess && isset($sess['StreetCode']))
		{			
			foreach($sess['StreetCode'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);
				
				$bSuccess = $this->StreetCode->save($data);

				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving StreetCode Status:$bSuccess");
		}
		
		
		if ($bSuccess && isset($sess['Address']))
		{		
			foreach($sess['Address'] as $key=>$data)
			{
				if ($data['street_id'] == 0)
					unset($data['street_id']);
				
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$this->Address->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving Address Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['ContactInformation']))
		{
			foreach($sess['ContactInformation'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->ContactInformation->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving ContactInformation Status:$bSuccess");
		}
		
		
		if ($bSuccess && isset($sess['Person']))
		{
			foreach($sess['Person'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				if ($data['title_id'] == 0)
					unset($data['title_id']);
				
				if ($data['suffix_id'] == 0)
					unset($data['suffix_id']);
				
				$bSuccess = $this->Person->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving Person Status:$bSuccess");
		}	
		
		
		if ($bSuccess && isset($sess['PersonAddress']))
		{
			foreach($sess['PersonAddress'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->PersonAddress->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving PersonAddress Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['PersonContactInformation']))
		{
			foreach($sess['PersonContactInformation'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->PersonContactInformation->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving PersonContactInformation Status:$bSuccess");
		}

		if ($bSuccess && isset($sess['PersonMark']))
		{
			foreach($sess['PersonMark'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);
		
				$bSuccess = $this->PersonMark->save($data);
		
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving PersonMark Status:$bSuccess");
		}
		
		if ($bSuccess && isset($sess['PersonMarkImage']))
		{
			CakeLog::write('debug',print_r($sess['PersonMarkImage'],true));
			foreach($sess['PersonMarkImage'] as $id=>$data)
			{
				foreach($sess['PersonMark'] as $key=>$personmark)
				{
					if ($personmark['id']==$id)
					{
						CakeLog::write('debug',print_r("writing ".$personmark['filename'],true));
						$fh = fopen(WWW_ROOT."/img/".$personmark['filename'], 'a+');
						
						foreach($data as $key=>$image)
						{
							fwrite($fh,base64_decode($image));
						}	
						fclose($fh);
					}
				}
					
			}
			CakeLog::write('debug',"Saving PersonMarkImage Status:$bSuccess");
		}		
		
		
		//Todo: check for existing User and Identity to attach new data for the user 
		
		if ($bSuccess && isset($sess['User']))
		{
			foreach($sess['User'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->User->save($data);
				
				//App::import('Controller', 'LimsController');
				//self::$controller = new LimsController;
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving User Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['CompanyBranchMember']))
		{
			foreach($sess['CompanyBranchMember'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);
		
				$bSuccess = $this->CompanyBranchMember->save($data);
		
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving CompanyBranchMember Status:$bSuccess");
		}		
		
		
		if ($bSuccess && isset($sess['PersonIdentity']))
		{
			foreach($sess['PersonIdentity'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);
								
				$bSuccess = $this->PersonIdentity->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving PersonIdentity Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['Physician']))
		{
			foreach($sess['Physician'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->Physician->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving Physician Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['PhysicianProfile']))
		{
			foreach($sess['PhysicianProfile'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->PhysicianProfile->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving PhysicianProfile Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['Physician']))
		{
			foreach($sess['Physician'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);
				
				$bSuccess = $this->Physician->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving Physician Status:$bSuccess");
		}
		
		
		if ($bSuccess && isset($sess['Patient']))
		{
			foreach($sess['Patient'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);

				$data['registered_date'] = Date('%Y-%m-%d',strtotime($data['registered_date']));
				
				$bSuccess = $this->Patient->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving Patient Status:$bSuccess");
		}		
		

		if ($bSuccess && isset($sess['LaboratoryTest']))
		{
			foreach($sess['LaboratoryTest'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTest->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTest Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['LaboratoryTestGroup']))
		{
			foreach($sess['LaboratoryTestGroup'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestGroup->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestGroup Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['LaboratoryTestGroupPrice']))
		{
			foreach($sess['LaboratoryTestGroupPrice'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestGroupPrice->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestGroupPrice Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['LaboratoryTestGroupDetail']))
		{
			foreach($sess['LaboratoryTestGroupDetail'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestGroupDetail->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestGroupDetail Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['LaboratoryTestSet']))
		{
			foreach($sess['LaboratoryTestSet'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestSet->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestSet Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryTestConvertion']))
		{
			foreach($sess['LaboratoryTestConvertion'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestConvertion->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestConvertion Status:$bSuccess");
		}		
		

		if ($bSuccess && isset($sess['LaboratoryTestReferenceRange']))
		{
			foreach($sess['LaboratoryTestReferenceRange'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestReferenceRange->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestReferenceRange Status:$bSuccess");
		}		
		

		if ($bSuccess && isset($sess['LaboratoryTestInterpretation']))
		{
			foreach($sess['LaboratoryTestInterpretation'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestInterpretation->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestInterpretation Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryPackage']))
		{
			foreach($sess['LaboratoryPackage'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryPackage->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPackage Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['LaboratoryPackageTestGroup']))
		{
			foreach($sess['LaboratoryPackageTestGroup'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryPackageTestGroup->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPackageTestGroup Status:$bSuccess");
		}	
		

		if ($bSuccess && isset($sess['LaboratoryPackageDetail']))
		{
			foreach($sess['LaboratoryPackageDetail'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryPackageDetail->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPackageDetail Status:$bSuccess");
		}
		
		
		if ($bSuccess && isset($sess['LaboratoryPatientOrder']))
		{
			foreach($sess['LaboratoryPatientOrder'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				if ($data['company_branch_id']==0)
					unset($data['company_branch_id']);
				
				$bSuccess = $this->LaboratoryPatientOrder->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPatientOrder Status:$bSuccess");
		}		
		

		if ($bSuccess && isset($sess['LaboratoryPatientBatchOrder']))
		{
			foreach($sess['LaboratoryPatientBatchOrder'] as $key=>$data)
			{	
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);
				
				$bSuccess = $this->LaboratoryPatientBatchOrder->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPatientBatchOrder Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryPatientBatchOrderPackage']))
		{
			foreach($sess['LaboratoryPatientBatchOrderPackage'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				if (isset($data['physician_id']) && $data['physician_id'] == 0)
					unset($data['physician_id']);
				
				if (isset($data['supervisor_user_id']) && $data['supervisor_user_id'] == 0)
					unset($data['supervisor_user_id']);

				if (isset($data['technologies_user_id']) && $data['technologies_user_id'] == 0)
					unset($data['technologies_user_id']);				

				if (isset($data['company_branch_id']) && $data['company_branch_id'] == 0)
					unset($data['company_branch_id']);				
				
				
				if (isset($data['package_id']) && $data['package_id']==0)
					unset($data['package_id']);

				if (isset($data['test_group_price_id']) && $data['test_group_price_id']==0)
					unset($data['test_group_price_id']);				
				
				$bSuccess = $this->LaboratoryPatientBatchOrderPackage->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPatientBatchOrderPackage Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryPatientBatchOrderDetail']))
		{
			foreach($sess['LaboratoryPatientBatchOrderDetail'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryPatientBatchOrderDetail->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryPatientBatchOrderDetail Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryTestOrder']))
		{
			foreach($sess['LaboratoryTestOrder'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);

				if (isset($data['release_date'])) $data['release_date'] = date('Y-m-d',strtotime($data['release_date']));
				
				$bSuccess = $this->LaboratoryTestOrder->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestOrder Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryTestOrderPackage']))
		{
			foreach($sess['LaboratoryTestOrderPackage'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);

				if (isset($data['release_date'])) $data['release_date'] = date('Y-m-d',strtotime($data['release_date']));
				
				$bSuccess = $this->LaboratoryTestOrderPackage->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestOrderPackage Status:$bSuccess");
		}
		

		if ($bSuccess && isset($sess['LaboratoryTestOrderResult']))
		{
			foreach($sess['LaboratoryTestOrderResult'] as $key=>$data)
			{
				if (isset($data['entry_datetime']) && $data['entry_datetime'] == '0001-01-01T00:00:00') unset($data['entry_datetime']);
				if (isset($data['validated_datetime']) && $data['validated_datetime'] == '0001-01-01T00:00:00') unset($data['validated_datetime']);
				if (isset($data['posted_datetime']) && $data['posted_datetime'] == '0001-01-01T00:00:00') unset($data['posted_datetime']);				
				
				$bSuccess = $this->LaboratoryTestOrderResult->save($data);
				
				if (!$bSuccess) break;
			}
			CakeLog::write('debug',"Saving LaboratoryTestOrderResult Status:$bSuccess");
		}
		
		
		if ($bSuccess && isset($sess['User']))
		{
			
			App::import('Controller', 'Users');
			$usercontroller = new UsersController();
				
			foreach($sess['User'] as $key=>$data)
			{

				$token = $usercontroller->_generateToken($data['id'],$data['username'],0);
				$this->Token->create();
				$tokendata['code'] = $token;
				$tokendata['status'] = 3;
				$tokendata['entry_datetime'] = date('Y-m-d H:i:s');
				$tokendata['user_id'] = $data['id'];
				$this->Token->save($tokendata);
					
				$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>1,'status'=>1)));
					
				//Send Email Confirmation function
				$title = $email_template['EmailTemplate']['subject'];
				$type = 1;
				$templater = 'email_template';
				$memberType = $data['role'];

				$name='User';
				foreach($sess['Person'] as $pkey=>$pdata)
				{
					if ($pdata['myresultonline_id']==$data['username'])
					{
						$name=$pdata['firstname'].' '.$pdata['lastname'];
						break;
					}
						
				}
				
				CakeLog::write('debug',"Sending Email");
				CakeLog::write('debug',"id:{$data['id']}");
				CakeLog::write('debug',"username:{$data['username']}");
				CakeLog::write('debug',"name:$name");
				CakeLog::write('debug',"email_template:".print_r($templater,true));
				CakeLog::write('debug',"type:$type");
				CakeLog::write('debug',"token:$token");
				CakeLog::write('debug',"memberType:$memberType");

				$usercontroller->loadModel('Token');
				$usercontroller->_email_send($data['id'],$data['username'],$name,$templater,$email_template,$type,$token,$memberType);
			}
			
		}
		
		

		$log = $this->StreetCode->getDataSource()->getLog(false, false);
		$this->StreetCode->log($log, 'debug');
			
		/*$patientOrder=$patientOrderMdoel->find('first',array(
				'conditions'=>array(
						'username'=>$username,
						'password'=>$hashpassword
				),
				'recursive'=>0
		));*/		
		
		//$this->loadModel('PatientOrder');
		
		//Todo: will further improve
		//this is a generic data loader
		
		if ($bSuccess)
		{
			$this->StreetCode->log('Commit', 'debug');
			$this->LaboratoryPatientOrder->commit();
			
			//unset($sess['Commiting']);
			Cache::delete($session_id);
			$resulttoken = $this->__createResultToken($executiontoken,1);
		}
		else
		{
			unset($sess['Commiting']);
			Cache::write($session_id,
				$sess
			);
			
			$this->StreetCode->log('Rollback', 'debug');
			$this->LaboratoryPatientOrder->rollback();
			$resulttoken = $this->__createResultToken($executiontoken,0);
		}
		

		return $resulttoken['ResultToken'];
	}

	function discard($executiontoken, $session_id)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		$sess=Cache::read($session_id);
		CakeLog::write('debug','Commit Session');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($sess,true));

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}
	
	function personMark($executiontoken, $session_id, $person_mark)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		CakeLog::write('debug','Post Person Mark');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($person_mark,true));	

		$sess=Cache::read($session_id);
		
		if (!$sess)
			return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['PersonMark'][] = $person_mark;
		
		Cache::write($session_id, $sess);
		
		$resulttoken = $this->__createResultToken($executiontoken,1);
		
		return $resulttoken['ResultToken'];		
	}
	
	function personMarkImage($executiontoken, $session_id, $id, $part, $image)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
		
		CakeLog::write('debug','Post Person Mark Image');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($image,true));
		
		$sess=Cache::read($session_id);
		
		if (!$sess)
			return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['PersonMarkImage'][$id][$part] = $image;
		
		Cache::write($session_id, $sess);
		
		$resulttoken = $this->__createResultToken($executiontoken,1);
		
		return $resulttoken['ResultToken'];		
	}

	function patient($executiontoken, $session_id, $patient)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Patient');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($patient,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['Patient'][] = $patient;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function patientOrder($executiontoken, $session_id, $patient_order)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Patient Order');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($patient_order,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPatientOrder'][] = $patient_order;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}
	
	function testOrder($executiontoken, $session_id, $test_order)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Order');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_order,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestOrder'][] = $test_order;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function testOrderPackage($executiontoken, $session_id, $test_order_package)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Order Package');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_order_package,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestOrderPackage'][] = $test_order_package;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function testOrderResult($executiontoken, $session_id, $test_order_result)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Order Result');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_order_result,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestOrderResult'][] = $test_order_result;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}
	
	function physician($executiontoken, $session_id, $physician)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Physician');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($physician,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['Physician'][] = $physician;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function physicianProfile($executiontoken, $session_id, $physician_profile)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Physician Profile');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($physician_profile,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['PhysicianProfile'][] = $physician_profile;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}		
	
	function patientBatchOrder($executiontoken, $session_id, $patient_batch_order)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Patient Batch Order');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($patient_batch_order,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPatientBatchOrder'][] = $patient_batch_order;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function patientBatchOrderPackage($executiontoken, $session_id, $patient_batch_order_package)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Patient Batch Order Package');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($patient_batch_order_package,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPatientBatchOrderPackage'][] = $patient_batch_order_package;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function patientBatchOrderDetail($executiontoken, $session_id, $patient_batch_order_detail)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Patient Batch Order Detail');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($patient_batch_order_detail,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPatientBatchOrderDetail'][] = $patient_batch_order_detail;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function package($executiontoken, $session_id, $package)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Package');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($package,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPackage'][] = $package;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	

	function packageTestGroup($executiontoken, $session_id, $package_test_group)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Package Test Group');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($package_test_group,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPackageTestGroup'][] = $package_test_group;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function packageDetail($executiontoken, $session_id, $package_detail)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Package Detail');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($package_detail,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryPackageDetail'][] = $package_detail;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function testGroup($executiontoken, $session_id, $test_group)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Group');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_group,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestGroup'][] = $test_group;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function testGroupPrice($executiontoken, $session_id, $test_group_price)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Group Price');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_group_price,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestGroupPrice'][] = $test_group_price;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function testGroupDetail($executiontoken, $session_id, $test_group_detail)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Group Detail');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_group_detail,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestGroupDetail'][] = $test_group_detail;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	
	
	function test($executiontoken, $session_id, $test)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTest'][] = $test;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	

	function testSet($executiontoken, $session_id, $test_set)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Set');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_set,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestSet'][] = $test_set;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function testConvertion($executiontoken, $session_id, $test_convertion)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Convertion');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_convertion,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestConvertion'][] = $test_convertion;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function testReferenceRange($executiontoken, $session_id, $test_reference_range)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Reference Range');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_reference_range,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestReferenceRange'][] = $test_reference_range;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function testInterpretation($executiontoken, $session_id, $test_interpretation)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Test Interpretation');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($test_interpretation,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());
			
		$sess['LaboratoryTestInterpretation'][] = $test_interpretation;
		
		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	



	function person($executiontoken, $session_id, $person)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Person');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($person,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['Person'][]=$person;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function personAddress($executiontoken, $session_id, $person_address)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post PersonAddress');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($person_address,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['PersonAddress'][]=$person_address;


		Cache::write($session_id, $sess);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function address($executiontoken, $session_id, $address)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Address');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($address,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['Address'][]=$address;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function streetCode($executiontoken, $session_id, $streetcode)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Stree Code');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($streetcode,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['StreetCode'][]=$streetcode;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function personContactInformation($executiontoken, $session_id, $person_contact_information)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post PersonContactInformation');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($person_contact_information,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['PersonContactInformation'][]=$person_contact_information;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}

	function contactInformation($executiontoken, $session_id, $contact_information)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post ContactInformation');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($contact_information,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['ContactInformation'][]=$contact_information;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}
	
	function user($executiontoken, $session_id, $user)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post User');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($user,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['User'][]=$user;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}
	
	function companyBranchMember($executiontoken, $session_id, $company_branch_member)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}
	
		CakeLog::write('debug','Company Branch Member');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($company_branch_member,true));
	
		$sess=Cache::read($session_id);
	
		if (!$sess)
			return array('ResultToken'=>$this->__createDummyResultToken());
	
		$sess['CompanyBranchMember'][]=$company_branch_member;
	
	
		Cache::write($session_id,
		$sess
		);
	
		$resulttoken = $this->__createResultToken($executiontoken,1);
	
		return $resulttoken['ResultToken'];
	}

	function personIdentity($executiontoken, $session_id, $person_identity)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		CakeLog::write('debug','Post Peron Identity');
		CakeLog::write('debug',$session_id);
		CakeLog::write('debug',print_r($person_identity,true));

		$sess=Cache::read($session_id);

		if (!$sess)
		return array('ResultToken'=>$this->__createDummyResultToken());

		$sess['PersonIdentity'][]=$person_identity;


		Cache::write($session_id,
		$sess
		);

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}	

	function person_detail($executiontoken, $session_id, $person_detail)
	{
		if (!$this->__validateExecutionToken($executiontoken))
		{
			return array('ResultToken'=>$this->__createDummyResultToken());
		}

		$resulttoken = $this->__createResultToken($executiontoken,1);

		return $resulttoken['ResultToken'];
	}
}
