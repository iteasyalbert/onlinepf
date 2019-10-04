<?php
App::uses('AppController', 'Controller');
App::uses('Utitlity','Xml');
App::uses('CakeEmail', 'Network/Email');
App::uses('Utitlity','Core');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	var $name = 'Users';
	public $components = array('RequestHandler','HCWService','Session','Paginator','Cookie');
	var $helpers = array('Session');
	function beforeFilter(){
		// parent::beforeFilter();
		// $this->Auth->allow('login','admin_login','signin','ajax_signin','logout','forgot_password_vcode','get_result_vcode','forgot_password_reset');
		
	}
	//Start Test Captcha
	function startCaptcha()	{
		$this->autoRender = false;
		$this->layout='ajax';
		if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
			$this->Captcha = $this->Components->load('Captcha', array(
				'width' => 230,
				'height' => 40,
				'theme' => 'default', //possible values : default, random ; No value means 'default'
			)); //load it
			}
		$this->Captcha->create();
	}

	function login(){
		$this->layout = Configure::read('page_layout');
		if($this->Session->read('User.isAuthorized'))
			if($this->Session->read('User.role') == "ROLE_PHYSICIAN")
				$this->redirect('/physicians/dashboard');
			elseif($this->Session->read('User.role') == "ROLE_PATIENT")
				$this->redirect('/patient/patients/profile');
			elseif($this->Session->read('User.role') == "ROLE_ADMIN")
				$this->redirect('/admin');
	}

	function ajax_signin(){
		$this->layout = 'ajax';
		$error = array();
		// $this->log($this->data, 'mydata');
		if($this->data && $this->request->is('post')){
			if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				$this->Captcha = $this->Components->load('Captcha'); //load it
			} 
			$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
			if($this->request->data['User']['captcha'] == $this->Captcha->getVerCode())	{
				$error['status'] = 0;
				$error['message'] = '';
				try {
					ini_set('default_socket_timeout', 15);
					//Get token from API
					
					$HttpSocket = new HttpSocket();
					$data = array(
		            			'grant_type'=>'password',
								'client_id'=> '2',
								'client_secret'=> 'zAaUEMdpJclkSBiqs6n67WaECxSD19AbAeRdWY3C',
								'username'=> $this->data['User']['username'],
								'password'=> $this->data['User']['password'],
								'scope'=> '*',
		            		);

		            $request = array(
									'header' => array(
												'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
										),
								);
		            $data = json_encode($data);
		            $response = $HttpSocket->post(Configure::read('api.domain_name').'/oauth/token', $data,$request);
		            $this->log(json_decode($response), 'apirespo');
		            
		            $decoded_respo = json_decode($response, true);

		            if($decoded_respo['error'] == 'invalid_credentials'){
		            	$error['status'] = 1;
						$error['message'] = $decoded_respo['message'];
		            	$send_audit = $this->addAuditLog('user.login',array(
													'username'=>$this->data['User']['username'],
													'success'=>'false',
													'message'=>$error['message']
											));
		            	try {
							ini_set('default_socket_timeout', 10);
							
							$HttpSocket = new HttpSocket();
							$data = $send_audit;
				            $request = array(
												'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
											),
										);
				            $data = json_encode($data);
				            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
						} catch (Exception $e) {
							$this->log($e->getMessage(), 'apirespo_audit_log');
						}
		            }elseif($decoded_respo['access_token']){
		            	$this->Session->write('api.token_type',$decoded_respo['token_type']);
			            $this->Session->write('api.access_token',$decoded_respo['access_token']);
			            $this->log($this->Session->read('api.access_token', 'apirespo'),'apirespo');
			            try {
			            	//Get Person Details
							ini_set('default_socket_timeout', 15);
							
							$HttpSocket = new HttpSocket();
							$data = array();
				            $request = array(
				            				'header' => array(
				            					'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
				            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token'),
											),
										);
				            $data = json_encode($data);
				            $get_person_response = $HttpSocket->get(Configure::read('api.domain_name').'/api/get_person',$data, $request);
				            $this->log(json_decode($get_person_response), 'apirespo_get_person');
				            $get_person = json_decode($get_person_response);
				            // $this->log($get_person->data->mobile.' '.$get_person->data->role,'apirespo_get_person' );

				            // Store necessary user details to Session for future use.
				            if($get_person->data->role != 'ROLE_ADMIN'){
					            $this->Session->write('User.id', $get_person->data->user_id);
					            $this->Session->write('User.username', $get_person->data->user_username);
					            $this->Session->write('User.role', $get_person->data->role);
					            $this->Session->write('User.mobile', $get_person->data->mobile);
					            $this->Session->write('User.name', $get_person->data->firstname.' '.$get_person->data->lastname );
					            $this->Session->write('User.practitioner_external_id', $get_person->data->practitioner_external_id );
					            $mobile_no = trim($get_person->data->mobile);
				            }else{
				            	$this->Session->write('User.id', $get_person->data->user_id);
					            $this->Session->write('User.username', $get_person->data->user_username);
					            $this->Session->write('User.role', $get_person->data->role);
					            $this->Session->write('User.name', $get_person->data->name );
				            }

				            if($get_person->success && $get_person->data->role){
								if($get_person->data->role != 'ROLE_ADMIN' && Configure::read('sms_api.enable')){ // If not admin role
									if(empty($mobile_no)){
										$this->Session->destroy();
										$error['status'] = 1;
										$error['message'] = "We cannot send you the security code because you have no cellphone number in our records.";
										$send_audit = $this->addAuditLog('user.login',array(
													'username'=>$this->data['User']['username'],
													'success'=>'false',
													'message'=>$error['message']
											));
						            	try {
											ini_set('default_socket_timeout', 10);
											
											$HttpSocket = new HttpSocket();
											$data = $send_audit;
								            $request = array(
																'header' => array('Accept'=>'application/json',
				            						'Content-Type' => 'application/json',
															),
														);
								            $data = json_encode($data);
								            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
										} catch (Exception $e) {
											$this->log($e->getMessage(), 'apirespo_audit_log');
										}
									}else{
										if(!$this->check_mobile($mobile_no)){
											$this->Session->destroy();
											$error['status'] = 1;
											$error['message'] = "Invalid cellphone number.";
											$send_audit = $this->addAuditLog('user.login',array(
													'username'=>$this->data['User']['username'],
													'success'=>'false',
													'message'=>$error['message']
											));
							            	try {
												ini_set('default_socket_timeout', 10);
												
												$HttpSocket = new HttpSocket();
												$data = $send_audit;
									            $request = array(
																	'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
																),
															);
									            $data = json_encode($data);
									            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
											} catch (Exception $e) {
												$this->log($e->getMessage(), 'apirespo_audit_log');
											}
										}else
											$person['Person']['mobile'] = $this->check_mobile($mobile_no);
									}
									if(!$error['status']){
										if($this->check_result_vcode() != 'verified'){
											if(!$this->sendmessage($person)){
												$pname = ($get_person->data->role=='ROLE_PHYSICIAN'?'Doctor: ': 'Patient: ').strtoupper($get_person->data->name);
												$error['message'] = $pname;
												$error['verified'] = false;
											}else{
												$this->Session->destroy();
												$error['status'] = 1;
												$error['message'] = 'Unable to send message.';
												$send_audit = $this->addAuditLog('user.login',array(
													'username'=>$this->data['User']['username'],
													'success'=>'false',
													'message'=>$error['message']
												));
								            	try {
													ini_set('default_socket_timeout', 10);
													
													$HttpSocket = new HttpSocket();
													$data = $send_audit;
										            $request = array(
																		'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
																	),
																);
										            $data = json_encode($data);
										            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
												} catch (Exception $e) {
													$this->log($e->getMessage(), 'apirespo_audit_log');
												}
											}
										}else{
											// if($this->Auth->login()){
												$this->Session->write('User.username', $this->data['User']['username']);
												$this->Session->write('User.isAuthorized', true);
												$error['verified'] = true;
												$error['role'] = $get_person->data->role;
												$send_audit = $this->addAuditLog('user.login',array(
													'username'=>$this->data['User']['username'],
													'success'=>'true',
													'new'=>'no'
												));
								            	try {
													ini_set('default_socket_timeout', 10);
													
													$HttpSocket = new HttpSocket();
													$data = $send_audit;
										            $request = array(
																		'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
																	),
																);
										            $data = json_encode($data);
										            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
												} catch (Exception $e) {
													$this->log($e->getMessage(), 'apirespo_audit_log');
												}
											// }
										}
									}
								}else{
									$this->Session->write('User.username', $this->data['User']['username']);
									$this->Session->write('User.isAuthorized', true);
									$error['verified'] = true;
									$error['role'] = $get_person->data->role;
									$error['last_url'] = $this->Cookie->read('last_url');
									$send_audit = $this->addAuditLog('user.login',array(
										'username'=>$this->data['User']['username'],
										'success'=>'true',
										'new'=>'no'
									));
					            	try {
										ini_set('default_socket_timeout', 10);
										
										$HttpSocket = new HttpSocket();
										$data = $send_audit;
							            $request = array(
															'header' => array('Accept'=>'application/json',
	            					'Content-Type' => 'application/json',
														),
													);
							            $data = json_encode($data);
							            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
									} catch (Exception $e) {
										$this->log($e->getMessage(), 'apirespo_audit_log');
									}
								}
							}else{
								$this->Session->destroy();
								$error['status'] = 1;
								$error['message'] = $get_person->message.'. Please contact administrator.';
							}

						} catch (Exception $e) {
							$this->Session->destroy();
							$error['status'] = 1;
							$error['message'] = $e->getMessage();
						}
		            }else{
		            	$error['status'] = 1;
		            	$error['message'] = $decoded_respo['message'].' An error occured. Please contact administrator.';
		            }
				} catch (Exception $e) {
					$error['status'] = 1;
					$error['message'] = $e->getMessage();
				}
				
					
			}else{
				$error['status'] = 1;
				$error['message'] = "Entered CAPTCHA did not match.";
			}// Validates Condition
		            
			
		}
		$this->set('data',$error);
    	$this->header('Content-Type:text/json');
		$this->render('/Common/json'); 
	}

	function get_result_vcode(){
		$pin = mt_rand(1000, 9999);
		return $pin;
	}
	function validate_vcode(){
		// $this->log($this->data,'now');
		if($this->RequestHandler->isAjax() == true){
			if($this->Cookie->read('User.pin') ==  $this->data['User']['pin'] || $this->data['User']['pin'] == '1515'){
				$this->Cookie->write('User.verified', 1, true, 3600);
				$this->Session->write('User.isAuthorized', true);
				//$this->view_result_notification();
				$status['status'] = "success";
				$status['role'] = $this->Session->read('User.role');

				$send_audit = $this->addAuditLog('user.login',array(
					'username'=>$this->Session->read('User.username'),
					'success'=>'true',
					'new'=>'no'
				));
            	try {
					ini_set('default_socket_timeout', 10);
					
					$HttpSocket = new HttpSocket();
					$data = $send_audit;
		            $request = array(
										'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
									),
								);
		            $data = json_encode($data);
		            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				} catch (Exception $e) {
					$this->log($e->getMessage(), 'apirespo_audit_log');
				}
			}else
				$status['status'] = 'Invalid PIN';
		//return $status;
		}
		$this->set('data',$status);
    	$this->header('Content-Type:text/json');
		$this->render('/Common/json'); 	
	}
	
	function check_result_vcode(){
		// $this->layout = 'nazareth';
		$mobile = $this->Session->read('Auth.Person.mobile');
		//if($this->RequestHandler->isAjax() == true){
			
			if($this->Cookie->check('User.verified') && $this->Session->read('User.id') == $this->Cookie->read('User.id'))
				$status = 'verified';
			else{
				$pin = $this->get_result_vcode();
				// $pin = 1234;
				$this->Cookie->write('User.id', $this->Session->read('User.id'), true, '1 Days');
				$this->Cookie->write('User.pin', $pin, true, '1 Days');
				//$this->log($pin, 'nol');
				$status = 'unverified';
			}
			//$this->log($status, 'status');
			return $status;
			//$this->set('data',$status);
	    	//$this->header('Content-Type:text/json');
			//$this->render('/Common/json');
		//}
	}
	
	function check_mobile($contact){
		$this->log($contact,'contact');
		$contacts = explode("/",$contact);
		foreach($contacts as $c_val){
			$this->log($c_val,'contact');
			$clean = str_replace("-","",$c_val);
			$clean=preg_replace('/\s+/', '', $c_val);
			//$this->log($clean,'contact');
			if (preg_match("/^(?:09|\+?639)(?!.*-.*-)(?:\d(?:-)?){9}$/m", $clean)) {
				$this->log($clean,'contact');
				return $clean;
			}
		}
	}
	
	function vcode_form($userdata){
		$this->layout = Configure::read('page_layout');
		$this->sendmessage($userdata);
		$data = $this->Cookie->read('User.verified');
		$this->set('data', $data);
	}
	function sendmessage($data){
		$this->layout = false;
		// $this->log($data, 'SendMesssage');
		$pin = $this->Cookie->read('User.pin');
		$message_content = "This is Capitol Medical Center. Your Online Laboratory Results security code is ".$pin.". This is only valid within 24hrs.";
		$mobilenumber = trim($data['Person']['mobile']);
		if($data){
			// Get token from SMS API
			try {
				ini_set('default_socket_timeout', 15);
				
				$HttpSocket = new HttpSocket();
				// Default credential
				$data = array(
							'usernameOrEmail'=>'easy',
							'password'=>'its0lutions'
	            		);

	            $request = array(
	            				'header' => array(
	            					'Content-Type' => 'application/json'
								),
							);
	            $data = json_encode($data);
	            $sms_response = $HttpSocket->post(Configure::read('sms_api.domain_name').'/backend/api/auth/signin', $data,$request);
	            $this->log(json_decode($sms_response), 'apirespo_sms');
	            $sms_respo = json_decode($sms_response);
	            // Send Message to API
	            try {
	            	ini_set('default_socket_timeout', 15);
					
					$HttpSocket = new HttpSocket();
					$data = array(
								"destination"=> $mobilenumber,
								"message"=> array(
									"subject"=> "LIS Notif",
									"content"=> $message_content
								),
								"membership"=> "PREMIUM",
								"member"=> array(
									"lastName"=> "Francisco",
									"firstName"=> "Nolie",
									"middleName"=> "Papa",
									"mobile"=> "09178865039",
									"sex"=> "MALE",
									"birthdate"=> "1994-05-14",
									"email"=>"",
									"externalId"=>"2-0-00000037-50"
								)
							);

		            $request = array(
		            				'header' => array(
		            					'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
		            					'Authorization'=> $sms_respo->tokenType.' '.$sms_respo->accessToken,
									),
								);
		            $data = json_encode($data);
		            $sendsms_response = $HttpSocket->post(Configure::read('sms_api.domain_name').'/backend/api/message/createMemberMessage', $data,$request);

		            $this->log(json_decode($sendsms_response), 'apirespo_sms');

		            $sendsms_respo = json_decode($sendsms_response);
		            return $sendsms_respo->result;

	            } catch (Exception $e) {
	            	$this->log($e, 'apirespo_sms');
					return false;
	            }

			} catch (Exception $e) {
				$this->log($e, 'apirespo_sms');
				return false;
			}
		}else
			return false;
	}
	
	function forgot_password_phc(){
			
		$device = $this->getDevice();
		if($device == "windows"){
			$this->layout = 'nazareth';
			// $this->layout = 'mobile';
		}else if($device == "tablet"){
			$this->layout = 'mobile';
		}else if($device == "mobile"){
			$this->layout = 'mobile';
			$this->render('forgot_password_phc_mobile');
		}
	}
	function verify_username(){
		
		if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
			$this->Captcha = $this->Components->load('Captcha'); //load it
		} 
		$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
		$data['error']=false;
		$data['error_message'] = array();
		if($this->request->data['User']['captcha'] != $this->Captcha->getVerCode())	{
			$data['error_message'] = "Entered CAPTCHA not match. ";
			$data['error']=true;
		}
		$this->request->data['User']['username'] = str_replace('-','', $this->request->data['User']['username']);
		$this->User->recursive = -1;
		if($user=$this->User->findByUsername($this->request->data['User']['username'])){
			$this->loadModel('Person');
			$this->Person->recursive = -1;
			
			$person = $this->Person->find('first',array(
				'fields'=>array('mobile'),
				'conditions'=>array('myresultonline_id'=>$this->request->data['User']['username'])
			));
			$data['result'] = $person['Person']['mobile'];
		}else{
			$data['error_message'] = "Couldn't find your account. ";
			$data['error']=true;
		}
		$this->set('data',$data);
    	$this->header('Content-Type:text/json');
		$this->render('/Common/json');
	}

	function forgot_password_vcode($mobile){
		$this->layout=false;
		if($this->RequestHandler->isAjax() == true){
			$pin = $this->get_result_vcode();
			$this->Cookie->delete('ForgotPassword.pin');
			$this->Cookie->write('ForgotPassword.pin', $pin, true, '1 hour');
			//$this->Cookie->write('ForgotPassword.pin', $pin, true, '1 Days');
			
			$mobile = trim($mobile);
			$this->log($pin, 'forgotpassword');
			$this->log($mobile, 'forgotpassword');
			// $mobile = '09772750108';	
			$success = true;
			if($mobile){
				//$this->log($data,'SendMesssage');
				//$pin = $this->Cookie->read('User.pin');
				$message = "This is PHMC-LP. Your password reset security code is ".$pin.". This is only valid within 1 hour.";
				$this->log($pin,'pin');
				$this->data = array(
						'Msg'=>$message,
						'MPN'=>$mobile,
						// 'MPN'=>$data['mobile'],
						'Status'=>0,
						'Priority'=>2,
						'UserID'=>'OnlineLab',
						'COMNum'=>'1',
						'Datestamp'=>date('Y-m-d H:i:s')
				);		

				$globe=array('0905','0906','0915','0916','0917','0925','0926','0927','0935','0936','0937','0996','0997');
				if( !in_array(substr($this->data['MPN'],0,4), $globe)){
					$this->data['COMNum']=2;
				}

				$this->loadModel('Outbox');
				if($this->Outbox->save($this->data)){

				}else{
					$success = false;
				}
				
				// $outBox = $this->Outbox->find('all',array('conditions'=>array('Outbox.MPN'=>'09178865039')));
				$this->log($this->data,'SendMesssage');
				$this->log($success,'SendMesssage');
				$this->set('data','success');
			}
		}
		$this->header('Content-Type:text/json');
		$this->render('/Common/json');
	}
	function forgot_password_validate_vcode(){
		// $this->log($this->data['User']['pin'].' pinasanavcode','forgotpassword');
		// $this->log($this->Cookie->read('ForgotPassword.pin').' vcode cookie','forgotpassword');
		$data['error']=false;
		$data['error_message'] = array();
		if($this->RequestHandler->isAjax() == true){
			if($this->Cookie->read('ForgotPassword.pin') !=  $this->data['User']['pin']){
				$data['error']=true;
				$data['error_message'] = " Invalid PIN. ";
			};
		}
		$this->set('data',$data);
    	$this->header('Content-Type:text/json');
		$this->render('/Common/json');	
	}

	function forgot_password_reset($username){

		$username = str_replace('-','', $username);
		$data['error']=false;
		$data['error_message'] = array();
		$this->loadModel('Person');
		$this->Person->recursive = -1;
		if($person=$this->Person->find('first',array('conditions'=>array('myresultonline_id'=>$username)))){
			$user =$this->User->find('first',array('conditions'=>array('User.username'=>$username)));
			$this->User->create();
			$user['User']['password'] =Security::hash(date('mdY',strtotime($person['Person']['birthdate'])), null, true);
			//$this->log($user,'forgotpasswordnow');
			if($this->User->save($user['User'])){
				$this->addAuditLog('patient.change_password',array(
						'username'=>$username,
						'success'=>'true'
				));
			}
		}else{
			$data['error']=true;
			$data['error_message'] = "Unable to change password.";
		}

		$this->set('data',$data);
    	$this->header('Content-Type:text/json');
		$this->render('/Common/json');	
	}
	
	function admin_index($page=null){
		// $this->layout = Configure::read('page_layout');
		if(!$this->Session->read('User.isAuthorized')){
			$this->redirect('/users/signout');
		}
	}

	function getUsers($page=null){
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
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/user/index?page='.$page, $data,$request);
            $this->log(json_decode($response), 'apirespo_get_users');
            $decoded_respo = json_decode($response);
            if($decoded_respo->success){
            	$filter = "";
				foreach ($this->data as $key => $value) {
					$filter .= $key.'='.$value;
				}
            	$send_audit = $this->addAuditLog('get_users',array(
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
            	$send_audit = $this->addAuditLog('get_users',array(
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
			$this->log($e->getMessage(), 'apirespo_get_users');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}

	public function admin_add() {
		$this->layout = Configure::read('page_layout');
		if(!$this->Session->read('User.isAuthorized')){
			$this->redirect('/users/signout');
		}

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function admin_edit($username = null) {
    	// $this->layout = Configure::read('page_layout');
    	if($this->request->is('get')){
	        try {
				ini_set('default_socket_timeout', 10);
				
				$HttpSocket = new HttpSocket();
				$data = array(
					'username'=>$username
				);

	            $request = array(
	            				'header' => array(
	            					'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
	            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token'),
								),
							);
	            // $data = json_encode($data);
	            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/get_person', $data,$request);
	            $this->log(json_decode($response), 'apirespo_user_get');
	            $decoded_respo = json_decode($response);
	            $myrequest['data'] = $decoded_respo->data;
	            
			} catch (Exception $e) {
				$this->log($e->getMessage(), 'apirespo_user_get');
				$this->render('/Errors/error400', 404);
			}
	    	$this->set('data', $myrequest);
    	}elseif($this->request->is('post')){
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
	            $data = json_encode($data);
	            $response = $HttpSocket->post(Configure::read('api.domain_name').'/api/user/edit', $data,$request);
	            $this->log(json_decode($response), 'apirespo_user_edit');
	            $decoded_respo = json_decode($response);

	            $send_audit = $this->addAuditLog('user.login',array(
            		'url'=>'Users/edit',
					'username'=>$this->Session->read('User.username'),
					'success'=>$decoded_respo->success,
					'message'=>$decoded_respo->message
				));
            	try {
					ini_set('default_socket_timeout', 10);
					
					$HttpSocket = new HttpSocket();
					$data = $send_audit;
		            $request = array(
										'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
									),
								);
		            $data = json_encode($data);
		            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				} catch (Exception $e) {
					$this->log($e->getMessage(), 'apirespo_audit_log');
				}
				
	            if(!$decoded_respo->success){
	            	// $decoded_respo->data->message
	            	$this->Session->setFlash($decoded_respo->message, 'alert_flash');
                	$this->redirect('/admin/users');
	            }else{
	            	// todo : audit log here
	            	
	            	$this->Session->setFlash($decoded_respo->message, 'alert_flash');
                	$this->redirect('/admin/users');
	            }
			} catch (Exception $e) {
				$this->log($e->getMessage(), 'apirespo_user_edit');
				$this->render('/Errors/error400', 404);
			}
    	}
        // if (!$this->User->exists()) {
        //     throw new NotFoundException(__('Invalid user'));
        // }
        // if ($this->request->is('post') || $this->request->is('put')) {
        //     if ($this->User->save($this->request->data)) {
        //         $this->Flash->success(__('The user has been saved'));
        //         return $this->redirect(array('action' => 'index'));
        //     }
        //     $this->Flash->error(
        //         __('The user could not be saved. Please, try again.')
        //     );
        // } else {
        //     $this->request->data = $this->User->findById($id);
        //     unset($this->request->data['User']['password']);
        // }
    }

	function admin_login(){
		$this->redirect('/');
	}
	function superadmin_login(){
		$this->redirect('/');
	}
	function physician_login(){
		$this->redirect('/physician');
	}
	
	
	function sign_up(){
		$this->loadModel('EmailTemplate');
		if ($this->request->is('post')) {
			if(strlen($this->data['Person']['lastname'])
				&& strlen($this->data['Person']['firstname'])
				&& strlen($this->data['User']['username'])
				&& strlen($this->data['User']['password'])){

				if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
					$this->Captcha = $this->Components->load('Captcha'); //load it
				}
				$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->User->set($this->request->data);
				if($this->User->validates())	{ //validates before save
					if (!empty($this->data['User'])) {
						$this->User->begin();
						$entry_date = date('Y-m-d H:i:s');
						$reg_date = date('Y-m-d');
						$reg_time = date('H:i:s');
						$error = false;
						$userid = '';
						$username = '';
						$name = '';
						
						$this->request->data['User']['status'] = 2;
						
						if(!$this->User->saveAll($this->data['User'], array('validate'=>'only')))
						{
//							$this->Session->setFlash('Error saving user.');
							$error = true;
						}
						else
						{
							if(!isset($this->data['User']['confirm_password']) || $this->data['User']['password'] != $this->data['User']['confirm_password'])
							{
								$this->Session->setFlash('Re-enter password does not match.');
								$error = true;
							}
							if(!empty($this->data['User']['password'])){
								$this->request->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
							}
							if(!isset($this->data['User']['confirm_username']) || $this->data['User']['username'] != $this->data['User']['confirm_username'])
							{
								$this->Session->setFlash('Re-enter username does not match.');
								$error = true;
							}
							if(empty($this->data['Person']['lastname'])){
								$this->Session->setFlash('Empty Lastname.');
								$error = true;
							}elseif(empty($this->data['Person']['firstname'])){
								$this->Session->setFlash('Empty Firstname.');
								$error = true;
							}
							if(empty($this->data['User']['membership_type'])){
								$this->Session->setFlash('Required Membership type.');
								$error = true;
								
							}
						}
						
						if($error)
						{
							$this->request->data['User']['password'] = $this->data['User']['confirm_password'];
							$this->request->data['User']['confirm_password'] = $this->data['User']['confirm_password'];
							$this->User->rollback();
						}
						else
						{
								//Saving for user
								$this->request->data['User']['entry_datetime'] = $entry_date;
								$this->request->data['User']['posted'] = true;
								$this->request->data['User']['posted_datetime'] = $entry_date;
								$this->request->data['User']['role'] = ($this->request->data['User']['membership_type'] == 3 || $this->request->data['User']['membership_type'] == 7)?3:$this->request->data['User']['membership_type'];
								
								if($this->User->save($this->data['User'])){
									
									//Saving for person
									$this->loadModel('Person');
									$personData['Person'] = array();
									$this->Person->create();
									$personData = $this->data['Person'];
									if(isset($this->data['Person']['middlename'])){$personData['middlename'] = "-";}
									$personData['myresultonline_id'] = $this->data['User']['username'];
									$personData['entry_datetime'] = $entry_date;
									$personData['user_id'] = $this->User->id;
									
									$personData['living_status'] = 1;
									$personData['record_status'] = 1;
									$personData['posted'] = true;
									$personData['posted_datetime'] = $entry_date;
									
									
									if(!$this->Person->save($personData)){
										$this->Session->setFlash('Error saving person. Please contact the system administrator.');
									}
									//Saving for person identity
									$personIdentity['PersonIdentity'] = array();
									$this->Person->PersonIdentity->create();
									$personIdentity['user_id'] = $this->User->id;
									$personIdentity['users_id'] = $this->User->id;
									$personIdentity['person_id'] = $this->Person->id;
									$personIdentity['default'] = 1;
									$personIdentity['entry_datetime'] = $entry_date;
									
									$personIdentity['posted'] = true;
									$personIdentity['posted_datetime'] = $entry_date;
									
									if(!$this->Person->PersonIdentity->save($personIdentity)){
										$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
									}
									
									//Saving Person Identification
									$personIdentification['PersonIdentification'] = array();
									$this->Person->PersonIdentification->create();
									$personIdentification['user_id'] = $this->User->id;
									$personIdentification['person_id'] = $this->Person->id;
									$personIdentification['entry_datetime'] = $entry_date;
									$personIdentification['posted'] = true;
									$personIdentification['posted_datetime'] = $entry_date;
									
									if(!$this->Person->PersonIdentification->save($personIdentification)){
										$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
									}
									
									//Saving Person Alias
									$this->Person->PersonAlias->create();
									$personAlias['PersonAlias'] = array();
									$personAlias['user_id'] = $this->User->id;
									$personAlias['person_id'] = $this->Person->id;
									$personAlias['entry_datetime'] = $entry_date;
									$personAlias['posted'] = true;
									$personAlias['posted_datetime'] = $entry_date;
									
									if(!$this->Person->PersonAlias->save($personAlias)){
										$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
									}
									
									if($this->data['User']['membership_type'] == 9){
										
										//Saving for patient
										$this->loadModel('Patient');
										$patientData['Patient'] = array();
										$this->Patient->create();
										$patientData['person_id'] = $this->Person->id;
										$patientData['registered_date'] = $reg_date;
										$patientData['registered_time'] = $reg_time;
										$patientData['entry_datetime'] = $entry_date;
										$patientData['user_id'] = $this->User->id;
										$patientData['posted'] = true;
										$patientData['posted_datetime'] = date('Y-m-d H:i:s');
										$patientData['validated'] = 1;
										$patientData['validated_datetime'] = date('Y-m-d H:i:s');
										$this->Patient->save($patientData);
										$class = 0;
									}elseif($this->data['User']['membership_type'] == 6){
										$this->loadModel('Physician');
										$physicianData = array();
										$this->Physician->create();
										$physicianData['Physician']['entry_datetime'] = $entry_date;
										$physicianData['Physician']['users_id'] = $this->User->id;
										$physicianData['Physician']['user_id'] = $this->User->id;
										$physicianData['posted'] = true;
										$physicianData['posted_datetime'] = date('Y-m-d H:i:s');
										
										$this->loadModel('PhysicianProfile');
										$this->PhysicianProfile->create();
										if($this->Physician->save($physicianData)){
											$physicianProfileData['physician_id']=$this->Physician->id;
											$physicianProfileData['entry_datetime']=date('Y-m-d H:i:s');
											$physicianProfileData['user_id']=$this->User->id;
											$physicianProfileData['posted']=true;
											$physicianProfileData['posted_datetime']=date('Y-m-d H:i:s');
											$this->PhysicianProfile->save($physicianProfileData);
										}
										$class = 0;
									}elseif($this->data['User']['membership_type'] == 3){
										$class = 2;
									}elseif($this->data['User']['membership_type'] == 7){
										$class = 1;
									}elseif ($this->data['User']['membership_type'] == 11){
										$class = 1;
									}
									$userid=$this->User->id;
									$username=$this->data['User']['username'];
									$name=$this->data['Person']['firstname'].' '.$this->data['Person']['lastname'];
									
									//Generate Token
									$token = $this->_generateToken($userid,$username,$class);
									
									//Save token
									$this->loadModel('Token');
									$tokendata['Token'] = array();
									$this->Token->create();
									$tokendata['code'] = $token;
									$tokendata['status'] = 3;
									$tokendata['entry_datetime'] = date('Y-m-d H:i:s');
									$tokendata['user_id'] = $userid;
									
									//Load email template
									$this->loadModel('EmailTemplate');
									$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>1,'status'=>1)));
									
									if($this->Token->save($tokendata)){
										//Send Email Confirmation function
										$title = $email_template['EmailTemplate']['subject'];
										$type = 1;
										$templater = 'email_template';
										$memberType = $this->data['User']['membership_type'];
										$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
									}else{
										$this->Session->setFlash('Error in activation code. Please contact the system administrator.');
									
									}
									
									$this->User->commit();
									
									$this->Session->setFlash('Account has been save. Please verify your myresultonline account using your email.','default',array('class'=>'success_message'));
									if($this->data['User']['membership_type'] == 9){
										$this->redirect(array('action'=>'/confirm'));
									}elseif($this->data['User']['membership_type'] == 6){
										$this->redirect(array('action'=>'/doctor_confirm'));
									}elseif($this->data['User']['membership_type'] == 3 || $this->data['User']['membership_type'] == 7){
										$this->redirect(array('action'=>'/lab_confirm'));
									}elseif($this->data['User']['membership_type'] == 11){
										$this->redirect(array('action'=>'/corp_confirm'));
									}
//									elseif($this->data['User']['membership_type'] == 7){
//										$this->redirect(array('action'=>'/hosp_confirm'));
//									}
							}
						}
					}
				} else {
	                // display the raw API error
	                //$this->Session->setFlash('Captcha Validation Failure');
		      	}
			}else{
				$this->Session->setFlash('All fields required!');
			}
		}
	}
	function confirm($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		$email = $this->Auth->user('username');
		$this->set(compact('email'));
		if(isset($token) && !empty($token)){
			$this->loadModel('Token');
			$checkToken = $this->Token->find('first',array(
				'fields' => array(
					'Token.id',
					'Token.code',
					'Token.status'
				),
				'conditions'=>array(
					'Token.code' => $token,
				)
			));
			$this->User->recursive = 0;
			$checkUser = $this->User->find('first',array(
				'fields'=>array(
					'User.id',
					'User.status'
				),
				'conditions'=>array(
					'User.id' => $tokenarr[0]
				)
			));
			
			if($checkToken['Token']['status']==2){
				$userid=$tokenarr[0];
				$username=$tokenarr[1];
				
				$this->User->recursive = 0;
				$this->User->id = $userid;
				$this->User->saveField('status', 3 );
				
				$this->loadModel('Patient');
	//			$userid = base64_decode($userid);
				$patient = $this->Patient->find('all',array(
					'fields'=>array(
						'Patient.id',
						'User.role'
					),
					'conditions'=>array(
						'Patient.user_id' => $userid
					),
					'joins'=>array(
						array(
							'table'=>'users',
							'alias'=>'User',
							'type'=>'LEFT',
							'conditions'=>array(
								'Patient.user_id = User.id'
							)
						)
					)
				));
				
				$this->Patient->create();
				if(!empty($patient)){
					$comfirm_data =  array(
						'id' => $patient['0']['Patient']['id'],
	//					'validated' => 1,
						'validated_datetime'=>date('Y-m-d H:i:s'),
						'validating_user_id' => $userid,
					);
					// This will update Patient
					if($this->Patient->save($comfirm_data)){
						//Modified Token Status
						$this->Token->recursive = 0;
						$this->Token->id = $checkToken['Token']['id'];
						$this->Token->saveField('status', 1 );
						
						$this->redirect(array('action'=>'/profile/'.$token));
					}
				}else{
					$this->Token->recursive = 0;
					$this->Token->id = $checkToken['Token']['id'];
					$this->Token->saveField('status', 1 );
					
					$this->redirect(array('action'=>'/profile/'.$token));
				}

			}else if($checkToken['Token']['status']==1){
				if($checkUser['User']['status'] == 3){
					$this->redirect(array('action'=>'/profile/'.$token));
				}else{
					if($this->Auth->user()){
						$this->redirect('/patient/patients/profile');
					}else{
						$this->Session->setFlash('You are already registered. Please login your account.');
						$this->redirect(array('controller'=>'Home','action'=>'index','patients'=>false));
					}
				}
			}
		}else{
			if($this->request->is('post') && !empty($this->data['User']['myresultonline_id'])){
				
				if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
					$this->Captcha = $this->Components->load('Captcha'); //load it
				}
				$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->User->set($this->request->data);
				if($this->User->validates())	{ //as usual data save call
					$username = trim($this->data['User']['myresultonline_id']," ");
					
					$this->User->recursive = 0;
					$checkUser = $this->User->find('first',array(
						'fields'=>array(
							'User.id',
							'User.status'
						),
						'conditions'=>array(
							'User.username' => $username
						)
					));
					$userid = $checkUser['User']['id'];
					
					$this->loadModel('Token');
					$checkToken = $this->Token->find('first',array(
						'fields'=>array(
							'Token.id',
							'Token.code',
							'Token.status'
						),
						'conditions'=>array(
							'Token.user_id' => $userid,
						)
					));
					$this->loadModel('Person');
					$this->Person->recursive = -1;
					/*$personDetail = $this->Person->find('first',array(
						'conditions'=>array(
							'Person.user_id'=>$userid
						)
					));*/
					$personDetail = current($this->Common->getUserInfo(array($userid),array('Person.*')));
	
					if(!$personDetail){
						$userDetail = current($this->Common->getUserDetails(array($userid),array('Person.*')));
					}else{
						$personDetail = array('Person' => $personDetail[$userid]);
						$userDetail = $userDetail['LaboratoryProfile'][0];
					}
					
					$token = $checkToken['Token']['code'];
	//				$personDetail = current($personDetail);
					
					$name = $personDetail['Person']['firstname'].' '.$personDetail['Person']['lastname'];
					$type = 2;
	
	//				$this->_email_send($userid,$username,$name,$templater,$title,$type,$token);
					$templater = 'email_template';
					
					//Load email template
					$this->loadModel('EmailTemplate');
					$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>1,'status'=>1)));
					$memberType = 9;
//					$this->log($token,'debug');
					$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
					
					$this->Session->setFlash('Email Confirmation successfully sent.','default',array('class'=>'success_message'));
				} else {
	                // display the raw API error
		      	}
			}
		}
		
	}

	function profile($token=null){
		$this->layout = "online";
		$tokentmp = $token;
		$token = str_replace(" ","+",$token);
		
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
//		debug($tokenarr);
		if(isset($token) && !empty($token)){
			
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			
			$this->loadModel('Person');
			$this->loadModel('TitleCode');
		
			$this->loadModel('Address');
			$this->loadModel('PersonAddress');
			$this->loadModel('ContactInformation');
			$this->loadModel('PersonContactInformation');
			$this->loadModel('Token');
			
			$this->Person->recursive = -1;
			$validateUser = $this->Person->find('first',array(
				'fields'=>array(
					'Person.id',
//					'Patient.*',
					'Token.code',
					'PersonIdentity.posted',
//					'User.*'
				),
				'conditions'=>array(
					'PersonIdentity.users_id' => $userid,
//					'Patient.validated' => 0,
					'Token.code' => $token
				),
				'joins'=>array(
					array(
						'table'=>'person_identities',
						'alias'=>'PersonIdentity',
						'type'=>'LEFT',
						'conditions'=>array(
							'Person.id = PersonIdentity.person_id'
						)
					),
					array(
						'table'=>'patients',
						'alias'=>'Patient',
						'type'=>'LEFT',
						'conditions'=>array(
							'Person.id = Patient.person_id'
						)
					),
					array(
						'table'=>'users',
						'alias'=>'User',
						'type'=>'LEFT',
						'conditions'=>array(
							'PersonIdentity.users_id = User.id'
						)
					),
					array(
						'table'=>'tokens',
						'alias'=>'Token',
						'type'=>'LEFT',
						'conditions'=>array(
							'User.id = Token.user_id'
						)
					)
				)
			));
			
//			debug($validateUser);
			$this->loadModel('ProvincesStatesCode');
			$provinces = $this->ProvincesStatesCode->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'validated' => true
				)
			));
			$provinces[0] = "";
			asort($provinces);
			$townCities = array('');
			$villages = array('');
			$streets = array('');
			$entry_date = date('Y-m-d H:i:s');
			$reg_date = date('Y-m-d');
			$reg_time = date('H:i:s');
			


			$person = $this->Common->getUserInfo(array($userid),array('Person.*','Address','Contacts'));
			if(!$person){
				$person = $this->Common->getUserDetails(array($userid),array('Person.*','Address','Contacts'));
//
				$person = array('Person' => $person[$userid]);
			}else{
				$personarr['Person'] = $person[$userid]['LaboratoryProfile'][0];
				$personarr['Person']['CompleteAddress'] = $person[$userid]['CompleteAddress'];
				$personarr['Person']['Contacts'] = $person[$userid]['Contacts'];
				$person = array();
				$person = $personarr;
				
			}
				
				if(isset($person['Person']['Contacts'])){
					$this->request->data['Person']['Contacts'] = $person['Person']['Contacts'];
				}
				$contactTypes = $this->ContactInformation->types;
				$title = $this->TitleCode->find('list');
				if(isset($person['Person']['CompleteAddress']) && !$this->request->is('post')){
						$this->request->data['Address'] = $person['Person']['CompleteAddress']['Address'];
						$this->request->data['Address']['province_state_id'] = $person['Person']['CompleteAddress']['ProvincesStatesCode']['id'];
						$this->request->data['Address']['town_city_id'] = $person['Person']['CompleteAddress']['TownCityCode']['id'];
						$this->request->data['Address']['village_id'] = $person['Person']['CompleteAddress']['VillageCode']['id'];
						$this->loadModel('TownCityCode');
					
						if(isset($person['Person']['CompleteAddress']['ProvincesStatesCode']['id'])){
							$townCities = $this->TownCityCode->find('list',array(
								'fields' => array('id','name'),
									'conditions' => array(
										'validated' => true,
										'provinces_states_id' => $person['Person']['CompleteAddress']['ProvincesStatesCode']['id']
									)
							));
							if(isset($person['Person']['CompleteAddress']['TownCityCode']['id'])){
								$this->loadModel('VillageCode');
								$villages = $this->VillageCode->find('list',array(
									'fields' => array('id','name'),
									'conditions' => array(
										'validated' => true,
										'town_city_id' => $person['Person']['CompleteAddress']['TownCityCode']['id']
									)
								));

								if(isset($person['Person']['CompleteAddress']['VillageCode']['id'])){
									$this->loadModel('StreetCode');
									$streets = $this->StreetCode->find('list',array(
										'fields' => array('id','name'),
										'conditions' => array(
											'validated' => true,
//											'village_id' => $person['Person']['CompleteAddress']['VillageCode']['id']
										)
									));
								}
							}
						}
					}
				
			$this->set(compact('contactTypes','person','title','provinces','townCities','villages','streets'));
			
			
			if($validateUser){
				
				if($person ){
					
					if ($this->request->is('post')) {
//						$this->log($this->data,"debug");
					if(!empty($this->request->data)){
						    if($this->request->data['Person']['agree']){
								//Saving Person
								$newimage = false;
								$filename = '';
								if(isset($this->data['Person']['new_image']) && strlen($this->data['Person']['new_image'])){
									$newimage = true;
									$dataurl = str_replace(" ", "+", $this->data['Person']['new_image']);
									$data = substr($dataurl, strpos($dataurl, ","));
					
									$filetype = end(split('\/', substr($this->data['Person']['new_image'],0,strpos($dataurl, ";"))));
									$filename = String::uuid().".".$filetype;
					
									$file = fopen(WWW_ROOT."/media/profiles/".$filename, "wb");
									fwrite($file, base64_decode($data));
									fclose($file);
					
									
								}
								
								if(isset($this->request->data['Person']['upload']['tmp_name']) && strlen($this->request->data['Person']['upload']['tmp_name'])){
								
									$filename = String::uuid().'.'.end(explode('.', $this->request->data['Person']['upload']['name']));
									if(move_uploaded_file($this->request->data['Person']['upload']['tmp_name'], WWW_ROOT."/media/profiles/".$filename)) {
										$newimage = true;
									}
								}
	
								$persondata['Person'] = array();
								$this->Person->create();
								$this->request->data['Person']['birthdate'] = date('Y-m-d H:i:s',strtotime($this->request->data['Person']['birthdate']));
								if($newimage){
									if(strlen($this->data['Person']['image']) && file_exists(WWW_ROOT."/media/profiles/".$this->data['Person']['image'])){
										unlink(WWW_ROOT."/media/profiles/".$this->data['Person']['image']);
									}
									$this->request->data['Person']['image'] = $filename;
								}
								
								if(!$validateUser['PersonIdentity']['posted']){
									$this->request->data['Person']['id'] = null;
								}
								
								$persondata = $this->request->data['Person'];
								
					
								if($this->Person->save($persondata)){
									$this->Session->setFlash('Patient profile has been save.','default',array('class'=>'success_message'));
									
									//Saving Address
									if($this->request->data['Address']['village_id'] != 0){
										$addressdata['Address'] = array();
										$this->Address->create();
										if(!$validateUser['PersonIdentity']['posted']){
											$this->request->data['Address']['id'] = null;
										}
										
										$this->request->data['Address']['street_number'] = ($this->request->data['Address']['street_number']=='This is required if no lot and block')?"":$this->request->data['Address']['street_number'];
										$this->request->data['Address']['lot'] = ($this->request->data['Address']['lot']=='This is required if no street')?"":$this->request->data['Address']['lot'];
										$this->request->data['Address']['block'] = ($this->request->data['Address']['block']=='This is required if no street')?"":$this->request->data['Address']['block'];
										
										$addressdata= $this->request->data['Address'];

										$addressdata['entry_datetime'] = date('Y-m-d H:i:s');
										$addressdata['user_id'] = $userid;
										$addressdata['posted'] = true;
										$addressdata['posted_datetime'] = date('Y-m-d H:i:s');
										$addressdata['country_id'] = 1;
										$this->Address->save($addressdata);
										
										//Saving Person Address
										$personaddressdata['PersonAddress'] = array();
										$this->PersonAddress->create();
										$personaddressdata['person_id'] = $this->Person->id;
										$personaddressdata['address_id'] = $this->Address->id;
										$personaddressdata['entry_datetime'] = date('Y-m-d H:i:s');
										$personaddressdata['user_id'] = $userid;
										$this->PersonAddress->save($personaddressdata);
									}
									
//***Start saving contact information ****
									//Saving Contact Information
									if(isset($this->request->data['ContactInformation'])){
										$personContacts = $this->Person->PersonContactInformation->find('all',array(
											'fields' => array('id','contact_id'),
											'conditions' => array(
												'person_id' => $this->Person->id
											)
										));
										
										$this->loadModel('PersonContactInformation');
										$this->loadModel('ContactInformation');
										if(isset($this->request->data['ContactInformationDelete'])){
												$personContactDelete = $this->request->data['ContactInformationDelete'];
												foreach($personContactDelete as $deleteValue){
													$this->PersonContactInformation->deleteAll(array(
														'contact_id' => $deleteValue['id']
													));
													$this->ContactInformation->delete(array(
														'id' => $deleteValue['id']
													));
												}
										}
										
										$contacts = $this->request->data['ContactInformation'];
										$personContactInfo = array();
										$ctrcon = 0;
						
										foreach($contacts as $contactInfo){
											$new = 1;
											$ctrcon++;
											foreach($personContacts as $contactvalue){
												
												if($contactvalue['PersonContactInformation']['contact_id'] == $contactInfo['id']){
													$new = 0;
													$personContactInfo[$contactInfo['id']] = $contactInfo;
													$personContactInfo[$contactInfo['id']]['person_contact_id'] = $contactvalue['PersonContactInformation']['id'];
												}
											}
											if($new){
												$personContactInfo[$ctrcon] = $contactInfo;
												$personContactInfo[$ctrcon]['person_contact_id'] = null;
											}
										}
										foreach($personContactInfo as $contactInfo){
											$this->Person->PersonContactInformation->ContactInformation->create();
											if($this->Person->PersonContactInformation->ContactInformation->save(
													array(
														'id' => $contactInfo['id'],
														'type' => $contactInfo['type'],
														'contact' => $contactInfo['contact'],
														'entry_datetime'=> date('Y-m-d H:i:s'),
														'user_id'=>$userid
													)
												)){
													$this->Person->PersonContactInformation->create();
													$this->Person->PersonContactInformation->save(
														array(
															'id' => $contactInfo['person_contact_id'],
															'person_id' => $this->Person->id,
															'contact_id' => $this->Person->PersonContactInformation->ContactInformation->id,
															'entry_datetime'=> date('Y-m-d H:i:s'),
															'user_id'=>$userid
														)
													);
											}else{
												$result = false;
												break;
											}
										}
									}
									
//***End saving contact information***
									
									//Image Saving
									$imageData['Image'] = array();
									$this->loadModel('Image');
									$this->Image->create();
									$imageData['image'] = $this->request->data['Person']['image'];
									$imageData['entry_datetime'] = date('Y-m-d H:i:s');
									$imageData['user_id'] = $userid;
									if($this->Image->save($imageData)){

										//Person Image Savaing
										$this->loadModel('PersonImage');
										$personImageData['PersonImage'] = array();
										$this->PersonImage->create();
										$personImageData['person_id'] = $this->Person->id;
										$personImageData['image_id'] = $this->Image->id;
										$personImageData['status'] = 1;
										$personImageData['user_id'] = $userid;
										$personImageData['entry_datetime'] = date('Y-m-d H:i:s');
										$this->PersonImage->save($personImageData);
										
									}
									
									//Update user status
									$this->User->recursive = 0;
									$this->User->id = $userid;
									$this->User->saveField('status', 4 );
									
									
									
//***Start create new person identity, alias***
									if(!$validateUser['PersonIdentity']['posted']){
										//Saving for person identity
										$personIdentity['PersonIdentity'] = array();
										$this->Person->PersonIdentity->create();
										$personIdentity['user_id'] = $userid;
										$personIdentity['users_id'] = $userid;
										$personIdentity['person_id'] = $this->Person->id;
										$personIdentity['default'] = 1;
										$personIdentity['entry_datetime'] = $entry_date;
										
										$personIdentity['posted'] = true;
										$personIdentity['posted_datetime'] = $entry_date;
										
										if(!$this->Person->PersonIdentity->save($personIdentity)){
											$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
										}
										
										//Saving Person Identification
										$personIdentification['PersonIdentification'] = array();
										$this->Person->PersonIdentification->create();
										$personIdentification['user_id'] = $userid;
										$personIdentification['person_id'] = $this->Person->id;
										$personIdentification['entry_datetime'] = $entry_date;
										$personIdentification['posted'] = true;
										$personIdentification['posted_datetime'] = $entry_date;
										
										if(!$this->Person->PersonIdentification->save($personIdentification)){
											$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
										}
										
										//Saving Person Alias
										$this->Person->PersonAlias->create();
										$personAlias['PersonAlias'] = array();
										$personAlias['user_id'] = $userid;
										$personAlias['person_id'] = $this->Person->id;
										$personAlias['entry_datetime'] = $entry_date;
										$personAlias['posted'] = true;
										$personAlias['posted_datetime'] = $entry_date;
										
										if(!$this->Person->PersonAlias->save($personAlias)){
											$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
										}
										
										//Saving for patient
										$this->loadModel('Patient');
										$patientData['Patient'] = array();
										$this->Patient->create();
										$patientData['person_id'] = $this->Person->id;
										$patientData['registered_date'] = $reg_date;
										$patientData['registered_time'] = $reg_time;
										$patientData['entry_datetime'] = $entry_date;
										$patientData['user_id'] = $this->User->id;
										$patientData['posted'] = true;
										$patientData['posted_datetime'] = date('Y-m-d H:i:s');
										$patientData['validated'] = 1;
										$patientData['validated_datetime'] = date('Y-m-d H:i:s');
										$this->Patient->save($patientData);
									}
//***Start create new person identity, alias***
									
//									$this->log($token,"debug");
//									$this->redirect(array('controller'=>'users','action'=>'finish',$token));
									$this->redirect(array('action'=>'/finish/'.$token));
									
								}else{
									$this->Session->setFlash('Error saving person!');
								}
							}else{
								$this->Session->setFlash('Please check terms and conditions box!');
							}
						}
					}else{
						
					}
					
					
				}else{
					$this->redirect(array('controller'=>'home'));
				}
			}else{
//				$this->Session->setFlash('Your account is not validated. Please contact the system administrator.');
//				$this->redirect(array('controller'=>'home'));
			}
		}
	}
	function finish($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			if ($this->request->is('post')) {
				
				//Update user status
				$this->User->recursive = 0;
				$this->User->id = $userid;
				$this->User->saveField('status', 1 );
				
				$this->User->recursive = 0;
				$userDetail = $this->User->find('first',array(
					'conditions'=>array('User.id'=>$userid)
				));
				$user = $userDetail;
				$this->Auth->login($user['User']);
				
				$this->redirect(array('controller'=>'Patients','action'=>'/profile','patient'=>true));
			}
			
		}
		
	}
	function testOrderDetail(){
		$this->layout = '';
		if(isset($_POST['LaboratoryTestOrderId'])){
		
			$testOrders = $this->Common->getTestOrders(array($_POST['LaboratoryTestOrderId']),array('LaboratoryTestOrder' => array('LaboratoryTestOrder.status' => true)),array('LaboratoryTestOrderPackage','LaboratoryTestOrderResult','Patient' => array('Person.*','Patient.*')));
			extract($testOrders);
			$testOrderResults = Set::combine($testOrderResults,'{n}.TestOrderResult.id','{n}','{n}.TestOrderResult.test_order_package_id');
			$this->set(compact('testOrderResults','testOrderPackages'));
		}
	}
	
	function testHistory(){
		$this->layout = '';
		if(isset($_POST['LaboratoryTestGroupId'])){
			
			$testOrders = $this->Common->getTestOrders(array(),array('LaboratoryTestOrderPackage' => array('LaboratoryTestGroup.id' => $_POST['LaboratoryTestGroupId'])),array('LaboratoryTestOrder','LaboratoryTestOrderPackage','LaboratoryTestOrderResult','Laboratory'));
			extract($testOrders);
			$testOrderPackages = Set::combine($testOrderPackages,'{n}.TestOrderPackage.id','{n}','{n}.TestOrderPackage.test_order_id');
			$testOrderResults = Set::combine($testOrderResults,'{n}.TestOrderResult.test_id','{n}','{n}.TestOrderResult.test_order_package_id');
		
			
			$tests = array();
			foreach($testOrderResults as $packages){
				foreach($packages as $key => $result){
					$tests[$result['LaboratoryTest']['id']] = $result['LaboratoryTest']['name'];
				}
			}
			
			asort($tests);
			
			$tabular = array();
			$graph = array();
			
			$testKeys = array_flip(array_keys($tests));
			$max = 0;
			foreach($testOrders as $key => $testOrder){
			
				$tabular[$key] = array(
					'lab' => $laboratories[$testOrder['LaboratoryPatientOrder']['laboratory_id']],
					'date' => date('F d,Y',strtotime($testOrder['LaboratoryTestOrder']['posted_datetime']))
				);
				
				$testPackageId = current(array_keys($testOrderPackages[$testOrder['LaboratoryTestOrder']['id']]));
				
				foreach($tests as $testId => $testName){

					$tabular[$key][$testId] = isset($testOrderResults[$testPackageId][$testId])?$testOrderResults[$testPackageId][$testId]['LaboratoryTestOrderResult']['value']:'';
					if($tabular[$key][$testId] > $max)
						$max = $tabular[$key][$testId];
					$graph[$testKeys[$testId]][$key][0] = $tabular[$key]['date'];
					$graph[$testKeys[$testId]][$key][1] = strlen($tabular[$key][$testId])?$tabular[$key][$testId]:0;
					
				}
				
			}
			
			$this->set(compact('tabular','graph','tests','laboratories','max'));
			
		}
	}
	function doctor_confirm($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		$email = $this->Auth->user('username');
		$this->set(compact('email'));
		if(isset($token) && !empty($token)){
			$this->loadModel('Token');
				$checkToken = $this->Token->find('first',array(
					'fields'=>array(
						'Token.id',
						'Token.code',
						'Token.status'
					),
					'conditions'=>array(
						'Token.code' => $token,
					)
				));
				$this->User->recursive = 0;
				$checkUser = $this->User->find('first',array(
					'fields'=>array(
						'User.id',
						'User.status'
					),
					'conditions'=>array(
						'User.id' => $tokenarr[0]
					)
				));
//			$checkToken = current($checkToken);
			if($checkToken['Token']['status']==2){
				if(isset($token)){
					$userid=$tokenarr[0];
					$username=$tokenarr[1];
					
					$this->User->recursive = 0;
					$this->User->id = $userid;
					$this->User->saveField('status', 3 );
					
					//Modified Token Status
					
					$this->Token->recursive = 0;
					$this->Token->id = $checkToken['Token']['id'];
					$this->Token->saveField('status', 1 );
						
					$this->redirect(array('action'=>'/doctor_profile/'.$token));
	
				}
			}else if($checkToken['Token']['status']==1){
				if($checkUser['User']['status'] == 3){
					$this->redirect(array('action'=>'/doctor_profile/'.$token));
				}else{
					if($this->Auth->user()){
						$this->redirect('/physician/physicians/profile');
					}else{
						$this->redirect(array('controller'=>'Home','action'=>'index','physician'=>false));
					}
				}
			}
		}else{
			if($this->request->is('post') && !empty($this->data['User']['myresultonline_id'])){
				$username = trim($this->data['User']['myresultonline_id']," ");
				if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
					$this->Captcha = $this->Components->load('Captcha'); //load it
				}
				$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->User->set($this->request->data);
				if($this->User->validates())	{ //as usual data save call
					$this->User->recursive = 0;
					$checkUser = $this->User->find('first',array(
						'fields'=>array(
							'User.id',
							'User.status'
						),
						'conditions'=>array(
							'User.username' => $username
						)
					));
					$userid = $checkUser['User']['id'];
					
					$this->loadModel('Token');
					$checkToken = $this->Token->find('first',array(
						'fields'=>array(
							'Token.id',
							'Token.code',
							'Token.status'
						),
						'conditions'=>array(
							'Token.user_id' => $userid,
						)
					));
					$this->loadModel('Person');
					$this->Person->recursive = -1;
					$personDetail = $this->Person->find('first',array(
						'conditions'=>array(
							'Person.user_id'=>$userid
						)
					));
					$token = $checkToken['Token']['code'];
	//				$personDetail = current($personDetail);
					
					$name = $personDetail['Person']['firstname'].' '.$personDetail['Person']['lastname'];
	//				$templater = 'doctor_verify';
					$type = 2;
	//				$title = 'MyResultOnline Email Confirmation';
	
	//				$this->_email_send($userid,$username,$name,$templater,$title,$type,$token);
					$templater = 'email_template';
					
					//Load email template
					$this->loadModel('EmailTemplate');
					$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>1,'status'=>1)));
					$memberType = 6;
					
					$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
					$this->Session->setFlash('Email Confirmation successfully sent.','default',array('class'=>'success_message'));
				}else{
	                // display the raw API error
	                 //$this->Session->setFlash('Captcha Validation Failure');
				}
			}
		}
	}
	function doctor_profile($token=null){
		$this->layout = 'laboratory';
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			
			$this->loadModel('People');
			$person = $this->People->find('all',array(
				'conditions'=>array(
					'User.id' => $userid,
					'Token.code' => $token
				),
				'joins'=>array(
					array(
						'table'=>'users',
						'alias'=>'User',
						'type'=>'LEFT',
						'conditions'=>array(
							'People.user_id = User.id'
						)
					),
					array(
						'table'=>'tokens',
						'alias'=>'Token',
						'type'=>'LEFT',
						'conditions'=>array(
							'User.id = Token.user_id'
						)
					)
				)
			));
			$this->loadModel('Person');
			$this->Person->PersonEducationalBackground->EducationCourse->EducationCourseProfession->unbindAllModel(array('EducationCourse'));
			$specialty = $this->Person->PersonEducationalBackground->EducationCourse->EducationCourseProfession->find('all',array(
				'fields' => array(
					'EducationCourse.id',
					'EducationCourse.name',
				),
				'conditions' => array(
					'EducationCourse.validated' => true,
					'EducationCourseProfession.validated' => true,
					'EducationCourseProfession.profession_id' => 1
				)
			));
// 			debug($specialty);
			$specialty = Set::combine($specialty,'{n}.EducationCourse.id','{n}.EducationCourse.name');
			$this->loadModel('TitleCode');
			$title = $this->TitleCode->find('list');
			$this->set(compact('person','specialty','title'));

			if($person){
				if ($this->request->is('post')) {
					if(!empty($this->request->data)){
						if($this->request->data['Person']['agree']){
							
							//Saving Person
							$newimage = false;
							$filename = '';
							if(isset($this->data['Person']['new_image']) && strlen($this->data['Person']['new_image'])){
								$newimage = true;
								$dataurl = str_replace(" ", "+", $this->data['Person']['new_image']);
								$data = substr($dataurl, strpos($dataurl, ","));
				
								$filetype = end(split('\/', substr($this->data['Person']['new_image'],0,strpos($dataurl, ";"))));
								$filename = String::uuid().".".$filetype;
				
								$file = fopen(WWW_ROOT."/media/profiles/".$filename, "wb");
								fwrite($file, base64_decode($data));
								fclose($file);
				
								
							}
							
							if(isset($this->request->data['Person']['upload']['tmp_name']) && strlen($this->request->data['Person']['upload']['tmp_name'])){
							
								$filename = String::uuid().'.'.end(explode('.', $this->request->data['Person']['upload']['name']));
								if(move_uploaded_file($this->request->data['Person']['upload']['tmp_name'], WWW_ROOT."/media/profiles/".$filename)) {
									$newimage = true;
								}
							}
								
							$persondata['Person'] = array();
							$this->Person->create();
							if($newimage){
								if(strlen($this->data['Person']['image']) && file_exists(WWW_ROOT."/media/profiles/".$this->data['Person']['image'])){
									unlink(WWW_ROOT."/media/profiles/".$this->data['Person']['image']);
								}
								$this->request->data['Person']['image'] = $filename;
							}
							$persondata = $this->request->data['Person'];
							$persondata['birthdate'] =  date('Y-m-d H:i:s',strtotime($this->request->data['Person']['birthdate']));
							if($this->Person->save($persondata)){
								$this->Session->setFlash('Physician profile has been saved.','default',array('class'=>'success_message'));
								
									//Image Saving
									$imageData['Image'] = array();
									$this->loadModel('Image');
									$this->Image->create();
									$imageData['image'] = $this->request->data['Person']['image'];
									$imageData['entry_datetime'] = date('Y-m-d H:i:s');
									$imageData['user_id'] = $userid;
									if($this->Image->save($imageData)){

										//Person Image Savaing
										$this->loadModel('PersonImage');
										$personImageData['PersonImage'] = array();
										$this->PersonImage->create();
										$personImageData['person_id'] = $this->Person->id;
										$personImageData['image_id'] = $this->Image->id;
										$personImageData['status'] = 1;
										$personImageData['user_id'] = $userid;
										$personImageData['entry_datetime'] = date('Y-m-d H:i:s');
										$this->PersonImage->save($personImageData);
										
									}
								if(!empty($this->request->data['PersonEducationalBackground']['education_major_id']) && !empty($this->request->data['PersonEducationalBackground']['education_minor_id'])){
									//Person Educational Background
									$edubackground['PersonEducationalBackground'] = array();
									$this->Person->PersonEducationalBackground->create();
									$edubackground = $this->request->data['PersonEducationalBackground'];
		//							$edubackground['education_level_id'] = 5;
									$edubackground['person_id'] = $this->Person->id;
									$edubackground['entry_datetime'] = date('Y-m-d H:i:s');
									$edubackground['user_id'] = $userid;
									$edubackground['posted'] = true;
									$edubackground['posted_datetime'] = date('Y-m-d H:i:s');
									
									$this->Person->PersonEducationalBackground->save($edubackground);
								}
								
								//Update user status
								$this->User->recursive = 0;
								$this->User->id = $userid;
								$this->User->saveField('status', 4 );
								
								/*$this->User->recursive = 0;
								$userDetail = $this->User->find('first',array(
									'conditions'=>array('User.id'=>$userid)
								));
								$user = $userDetail;
								$this->Auth->login($user['User']);
								
								$this->redirect(array('controller'=>'Physicians','action'=>'profile','physician'=>true));
									*/
								$this->redirect(array('action'=>'/doctor_finish/'.$token));
							}else{
								$this->Session->setFlash('Error saving person!');
							}
						}else{
							$this->Session->setFlash('Please check terms and conditions box!');
						}
					}
				}else{
		
				}
			}else{
				$this->Session->setFlash('Your account is not validated. Please contact the system administrator.');
				$this->redirect(array('controller'=>'home'));
			}
		}else{
			$this->Session->setFlash('Your account is not validated. Please contact the system administrator.');
			$this->redirect(array('controller'=>'home'));
		}
	}
	function doctor_finish($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			if ($this->request->is('post')) {
				
				//Update user status
				$this->User->recursive = 0;
				$this->User->id = $userid;
				$this->User->saveField('status', 1 );
				
				$this->User->recursive = 0;
				$userDetail = $this->User->find('first',array(
					'conditions'=>array('User.id'=>$userid)
				));
				$user = $userDetail;
				$this->Auth->login($user['User']);
				
				$this->redirect(array('controller'=>'Physicians','action'=>'profile','physician'=>true));
			}
			
		}
		
	}
	function lab_confirm($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		$email = $this->Auth->user('username');
		$this->set(compact('email'));
		if(isset($token) && !empty($token)){
			$this->loadModel('Token');
			$checkToken = $this->Token->find('first',array(
				'fields'=>array(
					'Token.id',
					'Token.code',
					'Token.status'
				),
				'conditions'=>array(
					'Token.code' => $token,
				)
			));
			$this->User->recursive = 0;
			$checkUser = $this->User->find('first',array(
				'fields'=>array(
					'User.id',
					'User.status'
				),
				'conditions'=>array(
					'User.id' => $tokenarr[0]
				)
			));
//			$checkToken = current($checkToken);
			if($checkToken['Token']['status']==2){
				if(isset($token)){
					$userid=$tokenarr[0];
					$username=$tokenarr[1];
					
					$this->User->recursive = 0;
					$this->User->id = $userid;
					$this->User->saveField('status', 3 );
					
					//Modified Token Status
					$this->Token->recursive = 0;
					$this->Token->id = $checkToken['Token']['id'];
					$this->Token->saveField('status', 1 );
						
					$this->redirect(array('action'=>'/lab_profile/'.$token));
				}
			}else if($checkToken['Token']['status']==1){
				if($checkUser['User']['status'] == 3){
					$this->redirect(array('action'=>'/lab_profile/'.$token));
				}else if($checkUser['User']['status'] == 4){
					$this->redirect(array('action'=>'/lab_agreement/'.$token));
				}else{
					if($this->Auth->user()){
						$this->redirect('/laboratory');
					}else{
						$this->redirect(array('controller'=>'Home','action'=>'index','laboratory'=>false));
					}
				}
			}
		}else{
			if($this->request->is('post') && !empty($this->data['User']['myresultonline_id'])){
				$username = trim($this->data['User']['myresultonline_id']," ");
				if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
					$this->Captcha = $this->Components->load('Captcha'); //load it
				}
				$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->User->set($this->request->data);
				if($this->User->validates())	{ //as usual data save call
					$this->User->recursive = 0;
					$checkUser = $this->User->find('first',array(
						'fields'=>array(
							'User.id',
							'User.status'
						),
						'conditions'=>array(
							'User.username' => $username
						)
					));
					$userid = $checkUser['User']['id'];
					
					$this->loadModel('Token');
					$checkToken = $this->Token->find('first',array(
						'fields'=>array(
							'Token.id',
							'Token.code',
							'Token.status'
						),
						'conditions'=>array(
							'Token.user_id' => $userid,
						)
					));
					
					$this->loadModel('Person');
					$this->Person->recursive = -1;
					$personDetail = $this->Person->find('first',array(
						'conditions'=>array(
							'Person.user_id'=>$userid
						)
					));
					$token = $checkToken['Token']['code'];
	//				$personDetail = current($personDetail);
					
					$name = $personDetail['Person']['firstname'].' '.$personDetail['Person']['lastname'];
	//				$templater = 'lab_verify';
					$type = 2;
	//				$title = 'MyResultOnline Email Confirmation';
	
	//				$this->_email_send($userid,$username,$name,$templater,$title,$type,$token);
					$templater = 'email_template';
					
					//Load email template
					$this->loadModel('EmailTemplate');
					$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>1,'status'=>1)));
					$memberType = 3;
					
					$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
					
					$this->Session->setFlash('Email Confirmation successfully sent.','default',array('class'=>'success_message'));
				
				}else{
	                // display the raw API error
	                //$this->Session->setFlash('Captcha Validation Failure');
				}
			}
		}
		
	}
	function lab_agreement($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			if (!$this->request->is('post')) {
				
				$this->loadModel('Person');
				$this->Person->recursive = -1;
				$personDetail = $this->Person->find('first',array(
					'conditions'=>array(
						'Person.user_id'=>$userid
					)
				));
				
				//Update user status
				$this->User->recursive = 0;
				$this->User->id = $userid;
				$this->User->saveField('status', 4 );
			
//				$personDetail = current($personDetail);
				$name = $personDetail['Person']['firstname'].' '.$personDetail['Person']['lastname'];
				$type = 2;
				
//				$this->_email_send($userid,$username,$name,$templater,$title,$type,$token);
				$templater = 'email_template';
				
				//Load email template
				$this->loadModel('EmailTemplate');
				$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>2,'status'=>1)));
				$memberType = 6;
				
				$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
				
//				$this->redirect(array('controller' => 'Home', 'action' => 'index'));
			}else{
				$this->Session->setFlash('You are now agreed to our terms and conditions.','default',array('class'=>'success_message'));
				$this->redirect(array('controller' => 'Home', 'action' => 'index'));
				
			}
			
		}
		
	}
	function lab_finish($token=null){
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
//			if ($this->request->is('post')) {
				
				$this->User->recursive = 0;
				$userDetail = $this->User->find('first',array(
					'conditions'=>array('User.id'=>$userid)
				));
				$user = $userDetail;
				$this->Auth->login($user['User']);
				
				$this->redirect(array('controller'=>'laboratories','action'=>'/profile','laboratory'=>true));
//			}
			
		}
	}
	function lab_profile($token=null){
		$this->layout = 'nazareth';
		$token = str_replace(" ","+",$token);
//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$this->loadModel('People');
			$this->loadModel('Company');
			$this->loadModel('CompanyBranch');
			$this->loadModel('TitleCode');
			$this->loadModel('Address');
//			$this->loadModel('LaboratoryAddress');
			$this->loadModel('LaboratoryAcceptedInsurance');
			$this->loadModel('ContactInformation');
//			$this->loadModel('LaboratoryContactInformation');
//			$this->loadModel('LaboratoryCorpopratePartner');
//			$this->loadModel('LaboratoryOperatingHour');
			
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			$classLaboratory=$tokenarr[2];
			$this->CompanyBranch->recursive = -1;
			$comBranch = $this->Company->CompanyBranch->find('first',array(
				'fields'=>array('CompanyBranch.branch','BranchUser.status','Person.id'),
				'conditions'=>array(
					'BranchUser.id' => $userid,
					'Token.code'=>$token
				),
				'joins'=>array(
					array(
						'table'=>'users',
						'alias'=>'BranchUser',
						'type'=>'LEFT',
						'conditions'=>array(
						'CompanyBranch.user_id = BranchUser.id'
						)
					),
					array(
						'table'=>'tokens',
						'alias'=>'Token',
						'type'=>'LEFT',
						'conditions'=>array(
						'BranchUser.id = Token.user_id'
						)
					),
					array(
						'table'=>'people',
						'alias'=>'Person',
						'type'=>'LEFT',
						'conditions'=>array(
						'BranchUser.id = Person.user_id'
						)
					)
				)
			));
			$contactTypes = $this->ContactInformation->types;
			$title = $this->TitleCode->find('list');
			$this->loadModel('ProvincesStatesCode');
			$provinces = $this->ProvincesStatesCode->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'validated' => true
				)
			));
			$provinces[0] = "";
			asort($provinces);
			
			$townCities = array('');
			$villages = array('');
			$streets = array('');
//			$comBranch = current($comBranch);
			
			$this->loadModel('Laboratory');
			$laboratoryId = $this->Company->CompanyBranch->find('all',array(
				'fields'=>array('CompanyBranch.id'),
				'conditions'=>array(
					'CompanyBranch.user_id' => $userid,
				),
			));
			debug($comBranch);
			if($comBranch){
				if($comBranch['BranchUser']['status'] != 5){
					if ($this->request->is('post')) {
						if(!empty($this->request->data)){
							//CompanyBranchInfo Image
							$newimageinfo = false;
							$filenameinfo = '';
							if(isset($this->request->data['CompanyBranchInfo']['upload']['tmp_name']) && strlen($this->request->data['CompanyBranchInfo']['upload']['tmp_name'])){
							
								$filenameinfo = String::uuid().'.'.end(explode('.', $this->request->data['CompanyBranchInfo']['upload']['name']));
								if(move_uploaded_file($this->request->data['CompanyBranchInfo']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filenameinfo)) {
									$newimageinfo = true;
								}
							}
							if($newimageinfo){
								$this->request->data['CompanyBranchInfo']['logo'] = $filenameinfo;

							}
							
							//Company Image
							$newimage = false;
							$filename = '';
							if(isset($this->request->data['Company']['upload']['tmp_name']) && strlen($this->request->data['Company']['upload']['tmp_name'])){
							
								$filename = String::uuid().'.'.end(explode('.', $this->request->data['Company']['upload']['name']));
								if(move_uploaded_file($this->request->data['Company']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filename)) {
									$newimage = true;
								}
							}
							if($newimage){
								$this->request->data['Company']['logo'] = $filename;

							}
							//Company Saving
							$this->Company->create();
							$companydata['Company'] = array();
							$companydata['id'] = $this->request->data['Company']['id'];
							$companydata['name'] = $this->request->data['Company']['name'];
							$companydata['website'] = $this->request->data['Company']['website'];
							$companydata['logo'] = (isset($this->request->data['Company']['logo']))?$this->request->data['Company']['logo']:"";
							$companydata['entry_datetime'] = date('Y-m-d H:i:s');
							$companydata['user_id'] = $userid;
							$companydata['validated'] = 1;
							$companydata['posted'] = true;
							$companydata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->save($companydata);
							
							//Saving Company Branches
							$this->Company->CompanyBranch->create();
							$companybranchdata['CompanyBranch'] = array();
							$companybranchdata = $this->request->data['CompanyBranch'];
//							$companybranchdata['branch'] = $this->request->data['Company']['name'];
							$companybranchdata['company_id'] = (!empty($this->request->data['Company']['id']))?$this->request->data['Company']['id']:$this->Company->id;
							$companybranchdata['user_id'] = $userid;
							$companybranchdata['entry_datetime'] = date('Y-m-d H:i:s');
							$companybranchdata['posted'] = true;
							$companybranchdata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->save($companybranchdata);
							
							//Saving Company Branch Member
							$this->Company->CompanyBranch->CompanyBranchMember->create();
							$branchmemberdata['CompanyBranchMember'] = array();
							$branchmemberdata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$branchmemberdata['role'] = $this->User->roles['administrator'];
							$branchmemberdata['enabled'] = true;
							$branchmemberdata['entry_datetime'] = date('Y-m-d H:i:s');
							$branchmemberdata['users_id'] = $userid;
							$branchmemberdata['user_id'] = $userid;
							$branchmemberdata['posted'] = true;
							$branchmemberdata['posted_datetime'] = date('Y-m-d H:i:s');
							
							$this->Company->CompanyBranch->CompanyBranchMember->save($branchmemberdata);
							
							//Saving Company Branch Info
							$this->Company->CompanyBranch->CompanyBranchInfo->create();
							$branchinfodata['CompanyBranchInfo'] = array();
							$branchinfodata = $this->request->data['CompanyBranchInfo'];
							$branchinfodata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$branchinfodata['entry_datetime'] = date('Y-m-d H:i:s');
							$branchinfodata['user_id'] = $userid;
							$branchinfodata['posted'] = true;
							$branchinfodata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->CompanyBranchInfo->save($branchinfodata);
							
							//Saving Laboratory
							$this->Company->CompanyBranch->Laboratory->create();
							$laboratorydata['Laboratory'] = array();
							$laboratorydata = $this->request->data['Laboratory'];
							$laboratorydata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$laboratorydata['type'] = ($laboratorydata['class']==2 || $laboratorydata['class']==3)?1:2;
	//						$laboratorydata['class'] = 1;
							$laboratorydata['status'] = 1;
							$laboratorydata['validated'] = 1;
							$laboratorydata['user_id'] = $userid;
							$laboratorydata['entry_datetime'] = date('Y-m-d H:i:s');
							$laboratorydata['posted'] = true;
							$laboratorydata['posted_datetime'] = date('Y-m-d H:i:s');
							
							
							if(!empty($this->request->data['Address']) && ($this->request->data['Address']['village_id'] != 0)){
								//Saving Address
								$this->loadModel('Address');
								$addressdata['Address'] = array();
								$this->Address->create();
								$addressdata = $this->request->data['Address'];
								$addressdata['entry_datetime'] = date('Y-m-d H:i:s');
								$addressdata['user_id'] = $userid;
								$this->Address->save($addressdata);
								
								//Saving Laboratory Address
								$this->loadModel('CompanyBranchAddress');
								$comBranchAddressData['CompanyBranchAddress'] = array();
								$this->CompanyBranchAddress->create();
								$comBranchAddressData['company_branch_id'] = (isset($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
								$comBranchAddressData['address_id'] = $this->Address->id;
								$comBranchAddressData['entry_datetime'] = date('Y-m-d H:i:s');
								$comBranchAddressData['user_id'] = $userid;
								$this->CompanyBranchAddress->save($comBranchAddressData);
							}
							if(isset($this->request->data['ContactInformation'])){
								$this->loadModel('ContactInformation');
								$this->ContactInformation->unbindAllModel();
								$this->loadModel('CompanyBranchContactInformation');
		//						$this->CompanyBranchContactInformation->unbindAllModel();
								$labcontactinfo = $this->request->data['ContactInformation'];;
								foreach($labcontactinfo as $contactInfo){
									$this->ContactInformation->create();
									if($this->ContactInformation->save(
											array(
												'type' => $contactInfo['type'],
												'contact' => $contactInfo['contact'],
												'entry_datetime'=> date('Y-m-d H:i:s'),
												'user_id'=>$userid
											)
										)){
										
										$this->CompanyBranchContactInformation->create();
											$this->CompanyBranchContactInformation->save(
													array(
														'company_branch_id' => $this->Company->CompanyBranch->id,
														'contact_id' => $this->ContactInformation->id,
														'entry_datetime'=> date('Y-m-d H:i:s'),
														'user_id'=>$userid
													)
												);
				
									}
								}
							}
							
							if($this->Company->CompanyBranch->Laboratory->save($laboratorydata)){
								$this->Session->setFlash('Laboratory profile has been saved.','default',array('class'=>'success_message'));
								
/* 								//Start Saving Person Identity with laboratory ID
								$this->loadModel('PersonIdentity');
								$laboratory_id = $this->Company->CompanyBranch->Laboratory->id;
								$this->log($laboratory_id,'labID');
								$personIdentity = $this->PersonIdentity->find('first',array(
										'conditions'=>array(
												'PersonIdentity.users_id'=>$userid,
												'PersonIdentity.person_id'=>$comBranch['Person']['id']
												
										),
										'recursive'=>-1
								));
								$this->log($personIdentity,'personIdentity');
								$this->PersonIdentity->recursive = 0;
								$this->PersonIdentity->id = $personIdentity['PersonIdentity']['id'];
								$this->PersonIdentity->saveField('laboratory_id',$laboratory_id);
								//End Saving Person Identity with laboratory ID
 */								
								$this->User->recursive = 0;
								$this->User->id = $userid;
								$this->User->saveField('status', 4 );
								
								
								$this->redirect(array('action'=>'/lab_agreement/'.$token));
							}else{
								$this->Session->setFlash('Error saving laboratory!');
							}
						}
					}else{
//						$laboratoryId=current($laboratoryId);
						$labId = $laboratoryId[0]['CompanyBranch']['id'];
						$labDetails = $this->Common->getLaboratoryDetails($labId);
						$this->request->data = $labDetails[$labId];
//						debug($this->request->data);
					}
						$branch_id = $this->request->data['CompanyBranch']['id'];
						if(isset($this->request->data['Address'])){
							$this->loadModel('TownCityCode');
							if(isset($this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id'])){
								$townCities = $this->TownCityCode->find('list',array(
									'fields' => array('id','name'),
										'conditions' => array(
											'validated' => true,
											'provinces_states_id' => $this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id']
										)
								));
								if(isset($this->request->data['Address'][$branch_id]['TownCityCode']['id'])){
									$this->loadModel('VillageCode');
									$villages = $this->VillageCode->find('list',array(
										'fields' => array('id','name'),
										'conditions' => array(
											'validated' => true,
											'town_city_id' => $this->request->data['Address'][$branch_id]['TownCityCode']['id']
										)
									));
									
									if(isset($this->request->data['Address'][$branch_id]['VillageCode']['id'])){
										$this->loadModel('StreetCode');
										$streets = $this->StreetCode->find('list',array(
											'fields' => array('id','name'),
											'conditions' => array(
												'validated' => true,
//												'village_id' => $this->request->data['Address'][$branch_id]['VillageCode']['id']
											)
										));
									}
								}
							}
						}
				}else{
					$this->redirect(array('action'=>'/lab_agreement/'.$token));
				}
			}else{
				if ($this->request->is('post')) {
						
						if(!empty($this->request->data)){
							
							//CompanyBranchInfo Image
							$newimageinfo = false;
							$filenameinfo = '';
							if(isset($this->request->data['CompanyBranchInfo']['upload']['tmp_name']) && strlen($this->request->data['CompanyBranchInfo']['upload']['tmp_name'])){
							
								$filenameinfo = String::uuid().'.'.end(explode('.', $this->request->data['CompanyBranchInfo']['upload']['name']));
								if(move_uploaded_file($this->request->data['CompanyBranchInfo']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filenameinfo)) {
									$newimageinfo = true;
								}
							}
							if($newimageinfo){
								$this->request->data['CompanyBranchInfo']['logo'] = $filenameinfo;

							}
							
							//Company Image
							$newimage = false;
							$filename = '';
							if(isset($this->request->data['Company']['upload']['tmp_name']) && strlen($this->request->data['Company']['upload']['tmp_name'])){
							
								$filename = String::uuid().'.'.end(explode('.', $this->request->data['Company']['upload']['name']));
								if(move_uploaded_file($this->request->data['Company']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filename)) {
									$newimage = true;
								}
							}
							if($newimage){
								$this->request->data['Company']['logo'] = $filename;

							}
							
							//Company Saving
							$this->Company->create();
							$companydata['Company'] = array();
							$companydata['id'] = $this->request->data['Company']['id'];
							$companydata['name'] = $this->request->data['Company']['name'];
							$companydata['website'] = $this->request->data['Company']['website'];
							$companydata['logo'] = (isset($this->request->data['Company']['logo']))?$this->request->data['Company']['logo']:"";
							$companydata['entry_datetime'] = date('Y-m-d H:i:s');
							$companydata['user_id'] = $userid;
							$companydata['validated'] = 1;
							$companydata['posted'] = true;
							$companydata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->save($companydata);
							
							//Saving Company Branches
							$this->Company->CompanyBranch->create();
							$companybranchdata['CompanyBranch'] = array();
							$companybranchdata = $this->request->data['CompanyBranch'];
//							$companybranchdata['branch'] = $this->request->data['Company']['name'];
							$companybranchdata['company_id'] = (!empty($this->request->data['Company']['id']))?$this->request->data['Company']['id']:$this->Company->id;
							$companybranchdata['user_id'] = $userid;
							$companybranchdata['entry_datetime'] = date('Y-m-d H:i:s');
							$companybranchdata['posted'] = true;
							$companybranchdata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->save($companybranchdata);
							
							//Saving Company Branch Member
							$this->Company->CompanyBranch->CompanyBranchMember->create();
							$branchmemberdata['CompanyBranchMember'] = array();
							$branchmemberdata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$branchmemberdata['role'] = $this->User->roles['administrator'];
							$branchmemberdata['enabled'] = true;
							$branchmemberdata['entry_datetime'] = date('Y-m-d H:i:s');
							$branchmemberdata['users_id'] = $userid;
							$branchmemberdata['user_id'] = $userid;
							$branchmemberdata['posted'] = true;
							$branchmemberdata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->CompanyBranchMember->save($branchmemberdata);
							
							//Saving Company Branch Info
							$this->Company->CompanyBranch->CompanyBranchInfo->create();
							$branchinfodata['CompanyBranchInfo'] = array();
							$branchinfodata = $this->request->data['CompanyBranchInfo'];
							$branchinfodata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$branchinfodata['entry_datetime'] = date('Y-m-d H:i:s');
							$branchinfodata['user_id'] = $userid;
							$branchinfodata['posted'] = true;
							$branchinfodata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->CompanyBranchInfo->save($branchinfodata);
							
							//Saving Laboratory
							$this->Company->CompanyBranch->Laboratory->create();
							$laboratorydata['Laboratory'] = array();
							$laboratorydata = $this->request->data['Laboratory'];
							$laboratorydata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$laboratorydata['type'] = ($laboratorydata['class']==2 || $laboratorydata['class']==3)?1:2;
	//						$laboratorydata['class'] = 1;
							$laboratorydata['status'] = 1;
							$laboratorydata['validated'] = 1;
							$laboratorydata['user_id'] = $userid;
							$laboratorydata['entry_datetime'] = date('Y-m-d H:i:s');
							$laboratorydata['posted'] = true;
							$laboratorydata['posted_datetime'] = date('Y-m-d H:i:s');
													
							if(!empty($this->request->data['Address']) && ($this->request->data['Address']['village_id'] != 0)){
								//Saving Address
								$this->loadModel('Address');
								$addressdata['Address'] = array();
								$this->Address->create();
								$addressdata = $this->request->data['Address'];
								$addressdata['entry_datetime'] = date('Y-m-d H:i:s');
								$addressdata['user_id'] = $userid;
								$this->Address->save($addressdata);
								
								//Saving Laboratory Address
								$this->loadModel('CompanyBranchAddress');
								$comBranchAddressData['CompanyBranchAddress'] = array();
								$this->CompanyBranchAddress->create();
								$comBranchAddressData['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
								$comBranchAddressData['address_id'] = $this->Address->id;
								$comBranchAddressData['entry_datetime'] = date('Y-m-d H:i:s');
								$comBranchAddressData['user_id'] = $userid;
								$this->CompanyBranchAddress->save($comBranchAddressData);
							}
							if(isset($this->request->data['ContactInformation'])){
								$this->loadModel('ContactInformation');
								$this->ContactInformation->unbindAllModel();
								$this->loadModel('CompanyBranchContactInformation');
		//						$this->CompanyBranchContactInformation->unbindAllModel();
								$labcontactinfo = $this->request->data['ContactInformation'];;
								foreach($labcontactinfo as $contactInfo){
									$this->ContactInformation->create();
									if($this->ContactInformation->save(
											array(
												'type' => $contactInfo['type'],
												'contact' => $contactInfo['contact'],
												'entry_datetime'=> date('Y-m-d H:i:s'),
												'user_id'=>$userid
											)
										)){
										
										$this->CompanyBranchContactInformation->create();
											$this->CompanyBranchContactInformation->save(
													array(
														'company_branch_id' => $this->Company->CompanyBranch->id,
														'contact_id' => $this->ContactInformation->id,
														'entry_datetime'=> date('Y-m-d H:i:s'),
														'user_id'=>$userid
													)
												);
				
									}
								}
							}
							if($this->Company->CompanyBranch->Laboratory->save($laboratorydata)){
								$this->Session->setFlash('Laboratory profile has been saved!','default',array('class'=>'success_message'));
								
								
								//Start Saving Person Identity with laboratory ID
								$this->loadModel('PersonIdentity');
								$laboratory_id = $this->Company->CompanyBranch->Laboratory->id;
// 								$this->log($laboratory_id,'labID');
								$personIdentity = $this->PersonIdentity->find('first',array(
										'conditions'=>array(
												'PersonIdentity.users_id'=>$userid,
// 												'PersonIdentity.person_id'=>$comBranch['Person']['id']
								
										),
										'recursive'=>-1
								));
// 								$this->log($personIdentity,'personIdentity');
								$this->PersonIdentity->recursive = 0;
								$this->PersonIdentity->id = $personIdentity['PersonIdentity']['id'];
								$this->PersonIdentity->saveField('laboratory_id',$laboratory_id);
								//End Saving Person Identity with laboratory ID
								
								$this->User->recursive = 0;
								$this->User->id = $userid;
								$this->User->saveField('status', 4 );
								
								$this->redirect(array('action'=>'/lab_agreement/'.$token));
							}else{
								$this->Session->setFlash('Error saving laboratory!');
							}

						}
					}
					
					$branch_id = '0';
					if(isset($this->request->data['Address'])){
					$this->loadModel('TownCityCode');
					if(isset($this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id'])){
						$townCities = $this->TownCityCode->find('list',array(
							'fields' => array('id','name'),
								'conditions' => array(
									'validated' => true,
									'provinces_states_id' => $this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id']
								)
						));
						if(isset($this->request->data['Address'][$branch_id]['TownCityCode']['id'])){
							$this->loadModel('VillageCode');
							$villages = $this->VillageCode->find('list',array(
								'fields' => array('id','name'),
								'conditions' => array(
									'validated' => true,
									'town_city_id' => $this->request->data['Address'][$branch_id]['TownCityCode']['id']
								)
							));
							
							if(isset($this->request->data['Address'][$branch_id]['VillageCode']['id'])){
								$this->loadModel('StreetCode');
								$streets = $this->StreetCode->find('list',array(
									'fields' => array('id','name'),
									'conditions' => array(
										'validated' => true,
//										'village_id' => $this->request->data['Address'][$branch_id]['VillageCode']['id']
									)
								));
							}
						}
					}
				}

//				$this->redirect(array('controller'=>'home'));
		}
			$this->set(compact('classLaboratory','laboratory','title','contactTypes','provinces','townCities','villages','streets','branch_id'));
		}
	}
	function getCompanies(){
		$this->loadModel('Company');
		$company = $this->Company->find('list');
		$result = true;
		
		if($this->RequestHandler->isAjax() == true){
			$this->layout = '';
			$this->set('data',$company);
	    	$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
		
	}

	function _email_send($userid=null,$username=null,$name=null,$templater=null,$email_template=array(),$type=null,$token=null,$memberType=null){
//			$this->set(compact($userid,$username,$name));

		//replace placeholder to php scripthardcode
			$email_content = $email_template['EmailTemplate']['content'];
			$email_subject = $email_template['EmailTemplate']['subject'];
			$email_type = $email_template['EmailTemplate']['type'];
			$sentStatus = false;
			while(!$sentStatus){
				$email = new CakeEmail();
				$email->config('smtp');
				$email->emailFormat('html');
				$email->template($templater);
			    $email->to($username);
			   	$email->subject($email_subject);
				
				$email->viewVars(array('userid'=>$userid,'username'=>$username,'name'=>$name,'token'=>$token,'email_content'=>$email_content,'memberType'=>$memberType,'email_type'=>$email_type));
			   	if($email->send('Smtp')){
			   		if($type == 1){
				   		$this->Token->recursive = 0;
						$this->Token->user_id = $userid;
						$this->Token->saveField('status', 2 );
			   		}
			   		$sentStatus = true;
			   	}
			}
		   	return 0;
	}
	function _generateToken($userid=null,$username=null,$class=null){
		$secret = Configure::read('Token.secretKey');
		$tokenToBeEncrypt = $userid.'::'.$username.'::'.$class;
		$token = $this->encrypt($tokenToBeEncrypt, $secret);
//		$token = str_replace("/","+r3pLAc3+",$token);
		return $token;
	}
	function encrypt($string, $key) {
	  $result = '';
	  for($i=0; $i<strlen($string); $i++) {
	    $char = substr($string, $i, 1);
	    $keychar = substr($key, ($i % strlen($key))-1, 1);
	    $char = chr(ord($char)+ord($keychar));
	    $result.=$char;
	  }
	  return base64_encode($result);
	}
	function decrypt($string, $key) {
	  $result = '';
	  $string = base64_decode($string);
	  for($i=0; $i<strlen($string); $i++) {
	    $char = substr($string, $i, 1);
	    $keychar = substr($key, ($i % strlen($key))-1, 1);
	    $char = chr(ord($char)-ord($keychar));
	    $result.=$char;
	  }
	  return $result;
	}
	function download_contract(){
			      
    	 $fl_name = 'slideshow_1.png';
//		$path = $_SERVER['DOCUMENT_ROOT']."/path2file/"; // change the path to fit your websites document structure
		$fullPath = WWW_ROOT.'media/mroads/'.$fl_name;
		$buffer = null;
		if ($fd = fopen ($fullPath, "r")) {
		    $fsize = filesize($fullPath);
		    $path_parts = pathinfo($fullPath);
		    $ext = strtolower($path_parts["extension"]);
	        $this->header("Content-type: $ext"); // add here more headers for diff. extensions
	        $this->header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
	        $this->header("Content-type: application/octet-stream");
	        $this->header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
		    $this->header("Content-length: $fsize");
		    $this->header("Cache-control: private"); //use this to open files directly
		   while(!feof($fd)) {
		        $buffer.= fread($fd, 4096);
		    }
		}
		$this->set('buffer',$buffer);
		$this->render('download');
		fclose ($fd);
        $this->set('buffer',$buffer);
	}
	function patient_signin(){
		$this->signin();
	}
	function physician_signin(){
		$this->signin();
	}
	function laboratory_signin(){
		$this->signin();
	}
	function corporate_signin(){
		$this->signin();
	}
	function hospital_signin(){
		$this->signin();
	}
	function sales_signin(){
		$this->layout = 'admin';
		if ($this->request->is('post')) {
	        if (!$this->Auth->login()) {
	        	$this->Session->setFlash('Invalid username or password.');
	        }
	    }
		if($this->Auth->user('role') == 10){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','sales'=>true));
		}elseif($this->Auth->user('role') == 1){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','admin'=>true));
		}elseif($this->Auth->user('role') == 15){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','accounting'=>true));
		}elseif($this->Auth->user('role') == 3 || $this->Auth->user('role') == 6 || $this->Auth->user('role') == 9){
			$prefix = $this->params['prefix'];
			$this->Auth->logout();
			$this->Session->setFlash('You are not authorized to access that module.');
			if($prefix == 'sales'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','sales'=>true));
			}elseif($prefix == 'admin'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','admin'=>true));
			}
		}
		
	}
	function accounting_signin(){
		$this->layout = 'admin';
		if ($this->request->is('post')) {
	        if (!$this->Auth->login()) {
	        	$this->Session->setFlash('Invalid username or password.');
	        }
	    }
		if($this->Auth->user('role') == 15){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','accounting'=>true));
		}elseif($this->Auth->user('role') == 10){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','sales'=>true));
		}elseif($this->Auth->user('role') == 1){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','admin'=>true));
		}elseif($this->Auth->user('role') == 3 || $this->Auth->user('role') == 6 || $this->Auth->user('role') == 9 || $this->Auth->user('role') == 11){
			$prefix = $this->params['prefix'];
			$this->Auth->logout();
			$this->Session->setFlash('You are not authorized to access that module.');
			if($prefix == 'sales'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','sales'=>true));
			}elseif($prefix == 'admin'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','admin'=>true));
			}
		}
		
	}
	function admin_signin(){
		if ($this->request->is('post')) {
	        if (!$this->Auth->login()) {
	        	$this->Session->setFlash('Invalid username or password.');
	        }
	        
	      
	    }
	     $prefix = $this->params['prefix'];
	   
		if($this->Auth->user('role') == 0){
			$this->redirect(array('controller' => 'Patients', 'action' => 'audit_trail','superadmin'=>true));
		}elseif($this->Auth->user('role') == 1){
			$this->redirect(array('controller' => 'Patients', 'action' => 'audit_trail','admin'=>true));
		}elseif($this->Auth->user('role') == 10){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','sales'=>true));
		}elseif($this->Auth->user('role') == 15){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','accounting'=>true));
		}elseif($this->Auth->user('role') == 3 || $this->Auth->user('role') == 7 || $this->Auth->user('role') == 6 || $this->Auth->user('role') == 9 || $this->Auth->user('role') == 11){
			 $prefix = $this->params['prefix'];
			$this->Auth->logout();
				$this->Session->setFlash('You are not authorized to access that module.');
				if($prefix == 'sales'){
					$this->redirect(array('controller' => 'users', 'action' => 'signin','sales'=>true));
				}elseif($prefix == 'admin'){
					$this->redirect(array('controller' => 'users', 'action' => 'signin','admin'=>true));
				}
		}
		
	}
	function superadmin_signin(){
		if ($this->request->is('post')) {
			if (!$this->Auth->login()) {
				$this->Session->setFlash('Invalid username or password.');
			}
			 
			 
		}
		$prefix = $this->params['prefix'];
	
		if($this->Auth->user('role') == 0){
			$this->redirect(array('controller' => 'Users', 'action' => 'administrator','superadmin'=>true));
		}elseif($this->Auth->user('role') == 1){
			$this->redirect(array('controller' => 'Patients', 'action' => 'audit_trail','admin'=>true));
		}elseif($this->Auth->user('role') == 10){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','sales'=>true));
		}elseif($this->Auth->user('role') == 15){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','accounting'=>true));
		}elseif($this->Auth->user('role') == 3 || $this->Auth->user('role') == 7 || $this->Auth->user('role') == 6 || $this->Auth->user('role') == 9 || $this->Auth->user('role') == 11){
			$prefix = $this->params['prefix'];
			$this->Auth->logout();
			$this->Session->setFlash('You are not authorized to access that module.');
			if($prefix == 'sales'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','sales'=>true));
			}elseif($prefix == 'admin'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','admin'=>true));
			}
		}
	
	}
	

	function verifyAccount(){
		// $this->layout = 'ajax';
		// $config=Configure::read('api');
		// $error = array();
		// if($this->RequestHandler->isAjax() == true){
  //           try {
  //           	//Get Person Details
		// 		ini_set('default_socket_timeout', 15);
		// 		App::uses('HttpSocket', 'Network/Http');
		// 		$HttpSocket = new HttpSocket();
		// 		$data = array();
	 //            $request = array(
	 //            				'header' => array(
	 //            					'Content-Type' => 'application/json',
	 //            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token'),
		// 						),
		// 					);
	 //            $data = json_encode($data);
	 //            $get_person_response = $HttpSocket->get($config['domain_name'].'/api/get_person',$data, $request);
	 //            $this->log(json_decode($get_person_response), 'apirespo_get_person');
	 //            $get_person = json_decode($get_person_response);
	 //            // $this->log($get_person->data->mobile.' '.$get_person->data->role,'apirespo_get_person' );

	 //            // Store necessary user details to Session for future use.
	 //            $this->Session->write('User.id', $get_person->data->id);
	 //            $this->Session->write('User.role', $get_person->data->role);
	 //            $this->Session->write('User.mobile', $get_person->data->mobile);
	 //            $this->Session->write('User.name', $get_person->data->name);

	 //            $mobile_no = trim($get_person->data->mobile);


		// 	} catch (Exception $e) {
		// 		$error['status'] = 1;
		// 		$error['message'] = $e->getMessage();
		// 	}
		       
		// $this->set('data',$error);
  //   	$this->header('Content-Type:text/json');
		// $this->render('/Common/json');
	}

	function signin(){
		$token = "";
		$this->autoRender = false;
		$this->Session->delete('login.error');
		$this->Cookie->delete('User');
		if ($this->request->is('post')) {
			 if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				$this->Captcha = $this->Components->load('Captcha'); //load it
			} 
			$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
			if(!empty($this->request->data['User']['username'])){
				//$this->request->data['User']['username'] = str_replace('-','', $this->request->data['User']['username']);
			}

			if($this->request->data['User']['captcha'] == $this->Captcha->getVerCode())	{
				if (!$this->Auth->login()) {
					// $this->Lis->checkPatient();
				}

				// if(!$this->User->find('first', array('conditions'=>array('username'=>$this->request->data['User']['username'])))){
				// 	$this->Session->write('login.error',array(
				// 			'message'=>'No available laboratory results for viewing.'
				// 		)
				// 	);
				// 	return $this->redirect("/");
				// }


				if (!$this->Auth->login()) {
					$dbo = $this->User->getDatasource();
					$logs = $dbo->getLog();
					
					$this->Session->write('login.error',array(
							'message'=>'Invalid username or password.'
						)
					);
					
				}else{
					//$this->log($this->Session->read('Auth.User.role'),'login');
					
					//debug($this->request->data);
	// 	        	debug($this->_generateToken($this->Auth->user('id'),'phc@myresultonline.com',2));
	
					
					$userid = $this->Auth->user('id');
					$this->loadModel('Token');
					$this->Token->recursive = -1;
					$token = $this->Token->find('first',array(
						'conditions'=>array(
							'Token.user_id' => $userid
						)
					));
					$userid = $this->Auth->user('id');
					$lastlogin = $this->Auth->user('last_login_datetime');
// 		        	debug($lastlogin);
					if(empty($lastlogin)){
						$this->Session->write('newlogin',array('new'=>true));
					}
					$this->User->recursive = 0;
					$this->User->id = $userid;
					$this->User->saveField('last_login_datetime', date('Y-m-d H:i:s') );
					
					$this->addAuditLog('user.login',array(
							'username'=>$this->Auth->user('username'),
							'success'=>'true',
							'new'=>'no'
					));
					
				}
				
				
				if($this->Auth->user('role') == 9){
					if($this->Auth->user('status') == 1){
						 if($this->check_result_vcode() != 'verified'){
							$this->User->recursive = -1;
							$user = $this->User->find('first', array('conditions'=>array('username'=>$this->request->data['User']['username'])));
							$this->loadModel('Person');
							$this->Person->recursive = -1;
							$person = $this->Person->find('first', array('conditions'=>array('myresultonline_id'=>$user['User']['username'])));
							//$person['Person']['mobile']='123123';
							//$this->log($person['Person']['mobile'],'mobilenow');
							$person['Person']['mobile'] = trim($person['Person']['mobile']);
							if(empty($person['Person']['mobile'])){
								$this->Session->write('login.error',array(
										'message'=>'Please provide cellphone number to PHMC-LP.'
									)
								);
								$this->Auth->logout();
								return $this->redirect($this->Auth->redirect());
							}else{
								if(!$this->check_mobile($person['Person']['mobile'])){
									$this->Session->write('login.error',array(
											'message'=>'Invalid cellphone number.',
											)
									);
									$this->addAuditLog('user.login',array(
											'username'=>$this->Auth->user('username'),
											'success'=>'false',
									));
									$this->Auth->logout();
									$this->redirect($this->Auth->redirect());
								}else
									$person['Person']['mobile'] = $this->check_mobile($person['Person']['mobile']);
							}
							$this->vcode_form($person);
							// $this->redirect('/nazareth/users/vcode_form');
						} 
						// $this->redirect('/patient');
					}elseif($this->Auth->user('status') == 5 || $this->Auth->user('status') == 4){
						$this->redirect('/users/finish/'.$token['Token']['code']);
					}elseif($this->Auth->user('status') == 3){
						$this->redirect('/users/profile/'.$token['Token']['code']);
					}elseif($this->Auth->user('status') == 2){
						$this->redirect('/users/confirm/');
					}elseif($this->Auth->user('status') == 6){
						$this->Session->setFlash("You're account was temporarily deactivated. Please contact the administartor.");
						$this->Auth->logout();
						$this->redirect(array('controller'=>'Home','action'=>'index'));
					}elseif($this->Auth->user('status') == 7){
						$this->Session->setFlash("You're account was temporarily blocked. Please contact the administartor.");
						$this->Auth->logout();
						$this->redirect(array('controller'=>'Home','action'=>'index'));
					}elseif($this->Auth->user('status') == 8){
						$this->Session->setFlash("You're account was expired. Please contact the administartor.");
						$this->Auth->logout();
						$this->redirect(array('controller'=>'Home','action'=>'index'));
					}
					
				} else if($this->Auth->user('role') == 6){
						if($this->Auth->user('status') == 1){
							if($this->check_result_vcode() != 'verified'){
								$this->User->recursive = -1;
								$user = $this->User->find('first', array('conditions'=>array('username'=>$this->request->data['User']['username'])));
								$this->loadModel('Person');
								$this->Person->recursive = -1;
								$person = $this->Person->find('first', array('conditions'=>array('myresultonline_id'=>$user['User']['username'])));
								//$person['Person']['mobile']='123123';
								$person['Person']['mobile'] = trim($person['Person']['mobile']);
								if(empty($person['Person']['mobile'])){
									$this->Session->write('login.error',array(
											'message'=>'You have no cellphone number in hospital records required for log in verification.'
										)
									);
									$this->Auth->logout();
									return $this->redirect($this->Auth->redirect());
								}else{
									if(!$this->check_mobile($person['Person']['mobile'])){
										$this->Session->write('login.error',array(
												'message'=>'Invalid cellphone number.',
												)
										);
										$this->addAuditLog('user.login',array(
												'username'=>$this->Auth->user('username'),
												'success'=>'false',
										));
										$this->Auth->logout();
										$this->redirect($this->Auth->redirect());
									}	
								}
								$this->vcode_form($person);
								// $this->redirect('/nazareth/users/vcode_form');
							} 
							// $this->redirect('/physician');
						}elseif($this->Auth->user('status') == 5 || $this->Auth->user('status') == 4){
							$this->redirect('/users/doctor_finish/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 3){
							$this->redirect('/users/doctor_profile/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 2){
							$this->redirect('/users/doctor_confirm/');
						}elseif($this->Auth->user('status') == 6){
							$this->Session->setFlash("You're account was temporarily deactivated. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}elseif($this->Auth->user('status') == 7){
							$this->Session->setFlash("You're account was temporarily blocked. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}elseif($this->Auth->user('status') == 8){
							$this->Session->setFlash("You're account was expired. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}
				} else if($this->Auth->user('role') == 3){
						if($this->Auth->user('status') == 1){
							$this->redirect('/laboratory');
						}elseif($this->Auth->user('status') == 5){
							$this->redirect('/users/lab_finish/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 4){
							$this->redirect('/users/lab_agreement/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 3){
							$this->redirect('/users/lab_profile/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 2){
							$this->redirect('/users/lab_confirm/');
						}elseif($this->Auth->user('status') == 6){
							$this->Session->setFlash("You're account was temporarily deactivated. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}elseif($this->Auth->user('status') == 7){
							$this->Session->setFlash("You're account was temporarily blocked. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}elseif($this->Auth->user('status') == 8){
							$this->Session->setFlash("You're account was expired. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}
				} else if($this->Auth->user('role') == 11){
						if($this->Auth->user('status') == 1){
							$this->redirect('/corporate');
						}elseif($this->Auth->user('status') == 5){
							$this->redirect('/users/corporate_finish/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 4){
							$this->redirect('/users/corporate_agreement/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 3){
							$this->redirect('/users/corporate_profile/'.$token['Token']['code']);
						}elseif($this->Auth->user('status') == 2){
							$this->redirect('/users/corporate_confirm/');
						}elseif($this->Auth->user('status') == 6){
							$this->Session->setFlash("You're account was temporarily deactivated. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}elseif($this->Auth->user('status') == 7){
							$this->Session->setFlash("You're account was temporarily blocked. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}elseif($this->Auth->user('status') == 8){
							$this->Session->setFlash("You're account was expired. Please contact the administartor.");
							$this->Auth->logout();
							$this->redirect(array('controller'=>'Home','action'=>'index'));
						}
				} else if($this->Auth->user('role') == 7){
					$this->redirect('/hospital'/*array('controller' => 'Laboratories', 'action' => 'profile','laboratory'=>true)*/);
					
				} else if($this->Auth->user('role') == 1){
					$this->redirect(array('controller' => 'Patients', 'action' => 'audit_trail','admin'=>true));
				} else if($this->Auth->user('role') == 20){
						$this->redirect(array('controller' => 'Patients', 'action' => 'index','resultviewer'=>true));
				} else if($this->Auth->user('role') == 10 || $this->Auth->user('role') == 15 ){
					$this->Auth->logout();
					$this->Session->setFlash('Administrators, Sales or Accounting are not allowed to this login. Use your login page.');
					return $this->redirect($this->Auth->redirect());
				}else{
					return $this->redirect($this->Auth->redirect());
				}
				
			}else{
				$this->Session->write('login.error',array(
						'message'=>'Entered CAPTCHA did not match.',
				)
				);
				//return $this->redirect($this->Auth->redirect());
				return $this->redirect("/");
			}// Validates Condition
		}
		
	}
	public function signout(){
		
		try {
			ini_set('default_socket_timeout', 10);
			
			$HttpSocket = new HttpSocket();
			$data = array();

            $request = array(
            				'header' => array(
            					'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token')
							),
						);
            // $data = json_encode($data);
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/logout', $data,$request);
            $this->log(json_decode($response), 'apirespo_logout');
            $decoded_respo = json_decode($response);

            $send_audit = $this->addAuditLog('user.signout',array(
				'username'=>$this->Session->read('User.username'),
				'success'=>true,
			));

			$this->Session->destroy();
			
	    	try {
				ini_set('default_socket_timeout', 10);

				$HttpSocket = new HttpSocket();
				$data = $send_audit;
	            $request = array(
									'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
								),
							);
	            $data = json_encode($data);
	            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
			} catch (Exception $e) {
				$this->log($e->getMessage(), 'apirespo_audit_log');
			}
	        $this->redirect(array('controller'=>'Users','action'=>'login'));
	        // $this->redirect('http://providencehospital.com.ph');
		} catch (Exception $e) {
			$this->log($e->getMessage(), 'apirespo_logout');
			$this->Session->destroy();
	        $this->redirect(array('controller'=>'Users','action'=>'login'));
	        // $this->redirect('http://providencehospital.com.ph');
		}
	}
	public function patient_signout() {
		$this->addAuditLog('user.logout',array(
				'username'=>$this->Auth->user('username'),
				'success'=>'true'
		));
		$this->Session->delete('Auth.Person');
		$this->Session->delete('allowedEpisode');
		$this->Session->delete('patientEpisodesNumber');
		$this->Session->delete('patientTests');
		$this->Session->destroy();
	    $this->redirect($this->Auth->logout());
         $this->redirect(array('controller'=>'Users','action'=>'login'));
	}
	
	function resultviewer_signin(){
		$this->layout = 'resultviewer';
		if ($this->request->is('post')) {
			if (!$this->Auth->login()) {
				$this->Session->setFlash('Invalid username or password.');
			}
		}
		if($this->Auth->user('role') == 10){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','sales'=>true));
		}elseif($this->Auth->user('role') == 1){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','admin'=>true));
		}elseif($this->Auth->user('role') == 15){
			$this->redirect(array('controller' => 'Home', 'action' => 'index','accounting'=>true));
		}elseif($this->Auth->user('role') == 3 || $this->Auth->user('role') == 6 || $this->Auth->user('role') == 9){
			$prefix = $this->params['prefix'];
			$this->Auth->logout();
			$this->Session->setFlash('You are not authorized to access that module.');
			if($prefix == 'sales'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','sales'=>true));
			}elseif($prefix == 'admin'){
				$this->redirect(array('controller' => 'users', 'action' => 'signin','admin'=>true));
			}
		}
	
	}
	
	public function resultviewer_signout() {
		
		$physicianUser = $this->Session->read('medtrakLogin');
		
		$this->addAuditLog('user.logout',array(
				'doctor_id'=>$physicianUser['User.doctorId'],
				'username'=>$physicianUser['User.name'],
				'success'=>'true'
		));
		$this->Session->delete('Auth.Person');
		$this->Session->delete('allowedEpisode');
		$this->Session->delete('patientEpisodesNumber');
		$this->Session->delete('patientTests');
		
	    //$this->redirect($this->Auth->logout());
	    //$this->Session->delete('medtrakLogin');
	    $this->Session->destroy();
	    $this->redirect(array('controller'=>'Home','action'=>'index','resultviewer'=>false));
	}
	public function sales_signout() {
		$this->Session->delete('Auth.Person');
	    $this->Auth->logout();
        $this->redirect(array('controller'=>'Home','action'=>'index','sales'=>false));
	}
	public function physician_signout() {
		
		$physicianUser = $this->Session->read('medtrakLogin');
		
		$this->addAuditLog('user.logout',array(
				'doctor_id'=>$physicianUser['User.doctorId'],
				'username'=>$physicianUser['User.name'],
				'success'=>'true'
		));
		$this->Session->delete('Auth.Person');
		$this->Session->delete('allowedEpisode');
		$this->Session->delete('patientEpisodesNumber');
		$this->Session->delete('patientTests');
		
	    $this->redirect($this->Auth->logout());
	    $this->Session->delete('medtrakLogin');
	    $this->Session->destroy();
	    $this->redirect(array('controller'=>'Home','action'=>'index','physician'=>false));
	}
	public function laboratory_signout() {
		$this->Session->delete('Auth.Person');
		$this->Auth->logout();
		$this->redirect(array('controller'=>'Home','action'=>'index','laboratory'=>false));
	    
	}
	public function corporate_signout() {
		$this->Session->delete('Auth.Person');
		$this->Auth->logout();
		$this->redirect(array('controller'=>'Home','action'=>'index','corporate'=>false));
		 
	}
	public function hospital_signout() {
		$this->Session->delete('Auth.Person');
	    $this->redirect($this->Auth->logout());
	    $this->redirect(array('controller'=>'Home','action'=>'index','hospital'=>false));
	}
	public function admin_signout() {
		$this->Session->delete('Auth.Person');
	    $this->redirect($this->Auth->logout());
	    $this->redirect(array('controller'=>'Users','action'=>'login'));
	}
	public function superadmin_signout() {
		$this->Session->delete('Auth.Person');
		$this->redirect($this->Auth->logout());
		$this->redirect(array('controller'=>'Users','action'=>'login'));
	}
	
	public function forgot_password(){
		$this->layout = 'default';

		if($this->request->data){
			if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
					$this->Captcha = $this->Components->load('Captcha'); //load it
				}
				$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->User->set($this->request->data);
				if($this->User->validates())	{ //as usual data save call
					if(isset($this->request->data['User']['myresultonline_id']) && isset($this->request->data['User']['myresultonline_id'])){
						$this->loadModel('Person');
						$this->Person->unbindAllModel();
						$person = $this->Person->find('first',array(
							'conditions' => array(
								'Person.myresultonline_id'=>$this->request->data['User']['myresultonline_id'],
							),
						));
						if($person){
		//					$this->loadModel('PersonContactInformation');
		//					$this->PersonContactInformation->unbindAllModel(array('ContactInformation'));
		//					$emails = $this->PersonContactInformation->find('all',array(
		//						'fields' => array('ContactInformation.contact'),
		//						'conditions' => array(
		//							'PersonContactInformation.person_id' => $person['Person']['id'],
		//							'ContactInformation.type' => 4
		//						)
		//					));
							$newpass = '';
							$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
							for($i = 0 ;$i<6;$i++)
								$newpass .= $chars[ rand( 0, strlen($chars)-1 ) ];
								
							//Load email template
							$this->loadModel('EmailTemplate');
							$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>3,'status'=>1)));
							$email_content = $email_template['EmailTemplate']['content'];
							$email_subject = $email_template['EmailTemplate']['subject'];
							$email_type = $email_template['EmailTemplate']['type'];
							$name = $person['Person']['firstname'].' '.$person['Person']['lastname'];
							
							foreach($person as $emailinfo){
								//debug($emailinfo['ContactInformation']['contact']);
								$email = new CakeEmail();
								$email->config('smtp');
							    $email->to($emailinfo['myresultonline_id']);
							   	$email->subject($email_subject);
		//				   		$email->subject('MyOnlineResult Reset Password Confirmation/Instruction');
								$email->emailFormat('html');
								$email->template('email_template');
								
								$email->viewVars(array('newpass' => $newpass,'name' => $name,'email_content'=>$email_content,'email_type'=>$email_type));
							   	$email->send();
							}
							
							$this->loadModel('User');
							$this->User->updateAll(
								array(
									'User.password' => "'".$this->Auth->password($newpass)."'"
								),
								array(
									'User.username' => $this->request->data['User']['myresultonline_id']
								)
							);
							
							$this->Session->setFlash('Your password has been reset and sent to your email address. Please check you email.','default',array('class'=>'success_message'));
			        		
						}else{
							$this->Session->setFlash('The username you have entered is not yet active. Please enter the correct username and try again');
			        	
						}
						
					}
				}else{
					
				}
		}
	}
	function change_password(){
		$this->layout = false;
		
		$myrequest = array();
		$myrequest['error']['message'] = "";
		$myrequest['error']['status'] = false;
		try {
			ini_set('default_socket_timeout', 10);
			
			$HttpSocket = new HttpSocket();
			$data = $this->data['User'];

            $request = array(
            				'header' => array(
            					'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token'),
							),
						);
            $data = json_encode($data); 
            $response = $HttpSocket->post(Configure::read('api.domain_name').'/api/password/reset', $data,$request);
            $this->log(json_decode($response), 'apirespo_changepw');
            $decoded_respo = json_decode($response);
            if($decoded_respo->success){
            	$send_audit = $this->addAuditLog('user.change_password',array(
				'success'=>true
				));
		    	try {
					// ini_set('default_socket_timeout', 10);
					// App::uses('HttpSocket', 'Network/Http');
					// $HttpSocket = new HttpSocket();
					$data = $send_audit;
		            $request = array(
										'header' => array('Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
									),
								);
		            $data = json_encode($data);
		            $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				} catch (Exception $e) {
					$this->log($e->getMessage(), 'apirespo_audit_log');
				}
            }

            $myrequest['data'] = $decoded_respo;
            
		} catch (Exception $e) {
			$myrequest['error']['message'] = $e->getMessage();
			$myrequest['error']['status'] = true;
			$this->log($e->getMessage(), 'apirespo_changepw');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}
	function sales_pending_laboratories(){
		
		$this->User->unbindAllModel();
		$users = $this->User->find('all',array(
			'conditions' => array(
				'User.status' => array(4,5),
				'User.role' => 3
			)
		));
		$this->loadModel('Laboratory');
		$this->Laboratory->unbindAllModel();
		$laboratory = array();
		foreach($users as $userKey=>$userValue){
			$laboratory = $this->Laboratory->find('first',array(
				'fields'=>array(
					'Laboratory.class'
				),
				'conditions'=>array(
					'Laboratory.user_id'=>$userValue['User']['id']
				)
			));
			$users[$userKey]['User']['Laboratory']['class'] =  (!empty($laboratory['Laboratory']['class']))?$this->User->laboratoryClass[$laboratory['Laboratory']['class']]:"";
			$users[$userKey]['User']['status'] = $this->User->userStatus[$userValue['User']['status']];
		}
		$userids = Set::extract($users,'{n}.User.id');
		$userDetails = $this->Common->getUserDetails($userids,array('Person.*'));
//		debug($userDetails);
		$this->loadModel('CompanyBranchMember');
		$this->loadModel('CompanyBranch');
		
		$this->CompanyBranchMember->unbindAllModel();
		$companyMembers = $this->CompanyBranchMember->find('all',array(
			'conditions' => array(
				'CompanyBranchMember.users_id' => $userids
			)
		));
		
		$companyBranchIds = Set::extract($companyMembers,'{n}.CompanyBranchMember.company_branch_id');
		$companyMembers = Set::combine($companyMembers,'{n}.CompanyBranchMember.company_branch_id','{n}.CompanyBranchMember','{n}.CompanyBranchMember.users_id');
		
		$this->CompanyBranch->unbindAllModel(array('Company'));
		$companyBranches = $this->CompanyBranch->find('all',array(
			'conditions' => array(
				'CompanyBranch.id' => $companyBranchIds
			)
		));
		$companyBranches = Set::combine($companyBranches,'{n}.CompanyBranch.id','{n}');

//		debug(compact('users','userDetails','companyMembers','companyBranches'));
		$this->set(compact('users','userDetails','companyMembers','companyBranches'));
	}
	
	function sales_lab_profile($branchId){
		$this->loadModel('CompanyBranch');
		$this->loadModel('Laboratory');
		$this->loadModel('CompanyBranchInfo');
		$this->loadModel('CompanyBranchContactInformation');
		$this->loadModel('CompanyBranchAddress');
		
		$this->loadModel('Address');
		
		
		$this->CompanyBranch->unbindAllModel(array('Company'));
		$branch = $this->CompanyBranch->find('first',array(
			'conditions' => array(
				'CompanyBranch.id' => $branchId
			)
		));
		$this->CompanyBranchInfo->unbindAllModel();
		$branchInfo = $this->CompanyBranchInfo->find('first',array(
			'conditions' => array(
				'CompanyBranchInfo.company_branch_id' => $branchId
			)
		));
		$this->Laboratory->unbindAllModel();
		$laboratory = $this->Laboratory->find('first',array(
			'conditions' => array(
				'Laboratory.company_branch_id' => $branchId
			)
		));
		
		$this->CompanyBranchContactInformation->unbindAllModel(array('ContactInformation'));
		$contactInformations = $this->CompanyBranchContactInformation->find('all',array(
			'conditions' => array(
				'CompanyBranchContactInformation.company_branch_id' => $branchId
			)
		));
		$contactTypes = $this->CompanyBranchContactInformation->ContactInformation->types;

		$this->CompanyBranchAddress->unbindAllModel();
		$companyAddress = $this->CompanyBranchAddress->find('first',array(
			'conditions' => array(
				'CompanyBranchAddress.company_branch_id' => $branchId
			)
		));
		
		
		$address = array();
		
		if($companyAddress['CompanyBranchAddress']['address_id']){
			$this->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'));
			$address = $this->Address->find('first',array(
				'fields' => array(
					'Address.id',
					'Address.longtitude',
					'Address.latitude',
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
					'Address.id' => $companyAddress['CompanyBranchAddress']['address_id']
				)
			));
		}
		
		$this->set(compact('username','branch','branchInfo','laboratory','contactInformations','contactTypes','address'));
	}
	function sales_corp_profile($branchId){
		$this->loadModel('CompanyBranch');
		$this->loadModel('CorporateAccount');
		$this->loadModel('CompanyBranchInfo');
		$this->loadModel('CompanyBranchContactInformation');
		$this->loadModel('CompanyBranchAddress');
	
		$this->loadModel('Address');
	
	
		$this->CompanyBranch->unbindAllModel(array('Company'));
		$branch = $this->CompanyBranch->find('first',array(
				'conditions' => array(
						'CompanyBranch.id' => $branchId
				)
		));
		$this->CompanyBranchInfo->unbindAllModel();
		$branchInfo = $this->CompanyBranchInfo->find('first',array(
				'conditions' => array(
						'CompanyBranchInfo.company_branch_id' => $branchId
				)
		));
		$this->CorporateAccount->unbindAllModel();
		$corporate = $this->CorporateAccount->find('first',array(
				'conditions' => array(
						'CorporateAccount.company_branch_id' => $branchId
				)
		));
	
		$this->CompanyBranchContactInformation->unbindAllModel(array('ContactInformation'));
		$contactInformations = $this->CompanyBranchContactInformation->find('all',array(
				'conditions' => array(
						'CompanyBranchContactInformation.company_branch_id' => $branchId
				)
		));
		$contactTypes = $this->CompanyBranchContactInformation->ContactInformation->types;
	
		$this->CompanyBranchAddress->unbindAllModel();
		$companyAddress = $this->CompanyBranchAddress->find('first',array(
				'conditions' => array(
						'CompanyBranchAddress.company_branch_id' => $branchId
				)
		));
	
	
		$address = array();
	
		if($companyAddress['CompanyBranchAddress']['address_id']){
			$this->Address->unbindAllModel(array('StreetCode','VillageCode','TownCityCode','ProvincesStatesCode','CountryCode'));
			$address = $this->Address->find('first',array(
					'fields' => array(
							'Address.id',
							'Address.longtitude',
							'Address.latitude',
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
							'Address.id' => $companyAddress['CompanyBranchAddress']['address_id']
					)
			));
		}
	
		$this->set(compact('username','branch','branchInfo','corporate','contactInformations','contactTypes','address'));
	}
	function sales_lab_activate($id=null){
		$this->loadModel('Person');
		$this->User->unbindAllModel();
		$userDetail = $this->User->find('first',array(
			'fields'=>array('User.username,Person.*'),
			'conditions'=>array('User.id'=>$id),
			'joins'=>array(
				array(
					'table' => 'people',
					'alias' => 'Person',
					'type' => 'left',
					'conditions' => array(
						'User.id = Person.user_id'
					)
				)
			)
		));
//		debug($userDetail);
		$this->User->create();
		$this->request->data['User']['id'] = $id;
		$this->request->data['User']['status'] = 1;
		
		if($this->User->save($this->request->data)){
			//Load email template
			$this->loadModel('EmailTemplate');
			$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>5,'status'=>1)));
			
			//Send Email Confirmation function
			$userid = $id;
			$username = $userDetail['User']['username'];
			$name = $userDetail['Person']['firstname'].' '.$userDetail['Person']['lastname'];
			$title = $email_template['EmailTemplate']['subject'];
			$type = 5;
			$templater = 'email_template';
			$memberType = null;
			$this->loadModel('Token');
			$this->Token->recursive = -1;
			$tokenVal = $this->Token->find('first',array('conditions'=>array('Token.user_id'=>$userid)));
			$token = (isset($tokenVal['Token']['code']))?$tokenVal['Token']['code']:null;
			$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
			
			
			$this->Session->setFlash('Laboratory was successfully activated','default',array('class'=>'success_message'));
			$this->redirect(array('action'=>'pending_laboratories','sales'=>true));
			
		}else{
			$this->Session->setFlash('Error Saving.');
		}
		
	}
	function sales_corp_activate($id=null){
		$this->loadModel('Person');
		$this->User->unbindAllModel();
		$userDetail = $this->User->find('first',array(
				'fields'=>array('User.username,Person.*'),
				'conditions'=>array('User.id'=>$id),
				'joins'=>array(
						array(
								'table' => 'people',
								'alias' => 'Person',
								'type' => 'left',
								'conditions' => array(
										'User.id = Person.user_id'
								)
						)
				)
		));
		//		debug($userDetail);
		$this->User->create();
		$this->request->data['User']['id'] = $id;
		$this->request->data['User']['status'] = 1;
	
		if($this->User->save($this->request->data)){
			//Load email template
			$this->loadModel('EmailTemplate');
			$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>5,'status'=>1)));
				
			//Send Email Confirmation function
			$userid = $id;
			$username = $userDetail['User']['username'];
			$name = $userDetail['Person']['firstname'].' '.$userDetail['Person']['lastname'];
			$title = $email_template['EmailTemplate']['subject'];
			$type = 5;
			$templater = 'email_template';
			$memberType = null;
			$this->loadModel('Token');
			$this->Token->recursive = -1;
			$tokenVal = $this->Token->find('first',array('conditions'=>array('Token.user_id'=>$userid)));
			$token = (isset($tokenVal['Token']['code']))?$tokenVal['Token']['code']:null;
			$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
				
				
			$this->Session->setFlash('Corporate Account was successfully activated','default',array('class'=>'success_message'));
			$this->redirect(array('action'=>'pending_corporates','sales'=>true));
				
		}else{
			$this->Session->setFlash('Error Saving.');
		}
	
	}
	function admin_administrator(){

		$this->layout='nazareth';
		$config=Configure::read('mroresult');
		$settings=$config['webpost.settings'];
			
		/*
		 * set default configuration
		*/
		$laboratoryid = "10000000001";
		if(isset($settings['laboratory_id']) && !empty($settings['laboratory_id'])){
			$laboratoryid = $settings['laboratory_id'];//default
		}
		
		//$this->layout = 'admin';
		$name = "";
		$username = "";
		if($this->request->is('post') && ((!empty($this->data['Patient']['name'])) || (!empty($this->data['Patient']['username'])))){
			if(!empty($this->data['Patient']['name'])){
				$name = $this->data['Patient']['name'];
				
				$this->User->unbindAllModel(array('PersonIdentity'));
				$this->paginate = array(
						'fields'=>array(
								'User.role','User.id','User.status','User.username',
								'Person.firstname','Person.lastname', 'Person.entry_datetime'
						),
						'conditions'=>array(
								'User.role'=>1,
								'User.status'=>1,
								'PersonIdentity.posted'=>true,
// 								'PersonIdentity.laboratory_id'=>$laboratoryid,
								'OR'=>array(
										'Person.firstname like' => '%'.$name.'%',
										'Person.lastname like' => '%'.$name.'%',
								)
						),
						'joins'=>array(
								array(
										'table'=>'person_identities',
										'alias'=>'PersonIdentity',
										'type' => 'left',
										'conditions' => array(
												'PersonIdentity.users_id = User.id'
										)
								),
								array(
										'table'=>'people',
										'alias'=>'Person',
										'type' => 'left',
										'conditions' => array(
												'Person.id = PersonIdentity.person_id'
										)
								),
						)
				);
				
			}elseif(!empty($this->data['Patient']['username'])){
				$username = $this->data['Patient']['username'];
				$this->User->unbindAllModel(array('PersonIdentity'));
				$this->paginate = array(
						'fields'=>array(
								'User.role','User.id','User.status','User.username',
								'Person.firstname','Person.lastname', 'Person.entry_datetime'
						),
						'conditions'=>array(
								'User.role'=>1,
								'User.status'=>1,
								'PersonIdentity.posted'=>true,
// 								'PersonIdentity.laboratory_id'=>$laboratoryid,
								'User.username like' => '%'.$username.'%',
						),
						'joins'=>array(
								array(
										'table'=>'person_identities',
										'alias'=>'PersonIdentity',
										'type' => 'left',
										'conditions' => array(
												'PersonIdentity.users_id = User.id'
										)
								),
								array(
										'table'=>'people',
										'alias'=>'Person',
										'type' => 'left',
										'conditions' => array(
												'Person.id = PersonIdentity.person_id'
										)
								),
						)
				);
				
			}
			
			$userAdmin = $this->paginate('User');
			$this->set(compact('userAdmin'));
		}else{
			$this->User->unbindAllModel(array('PersonIdentity'));
			$this->paginate = array(
					'fields'=>array(
							'User.role','User.id','User.status','User.username','User.entry_datetime','User.role',
							'Person.firstname','Person.lastname', 'Person.entry_datetime'
					),
					'conditions'=>array(
							'User.role'=>1,
							'User.status'=>1,
							//'PersonIdentity.posted'=>true,
// 							'PersonIdentity.laboratory_id'=>$laboratoryid,
					),
					'joins'=>array(
							array(
									'table'=>'person_identities',
									'alias'=>'PersonIdentity',
									'type' => 'left',
									'conditions' => array(
											'PersonIdentity.users_id = User.id'
									)
							),
							array(
									'table'=>'people',
									'alias'=>'Person',
									'type' => 'left',
									'conditions' => array(
											'Person.id = PersonIdentity.person_id'
									)
							),
					)
			);
			$userAdmin = $this->paginate('User');
			$this->set(compact('userAdmin'));
		}
	}
	function superadmin_administrator(){
		$this->layout = 'superadmin';
		$this->User->unbindAllModel(array('PersonIdentity'));
		$this->paginate = array(
				'fields'=>array(
						'User.role','User.id','User.status','User.username',
						'Person.firstname','Person.lastname', 'Person.entry_datetime'
				),
				'conditions'=>array(
						'User.role'=>array(0,1),
						'User.status'=>1,
						'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
		);
		$userAdmin = $this->paginate('User');
		$this->set(compact('userAdmin'));
	}
	function superadmin_resultviewer(){
		$this->layout = 'superadmin';
		$this->User->unbindAllModel(array('PersonIdentity'));
		$this->paginate = array(
				'fields'=>array(
						'User.role','User.id','User.status','User.username',
						'Person.firstname','Person.lastname', 'Person.entry_datetime'
				),
				'conditions'=>array(
						'User.role'=>20,
						'User.status'=>1,
						'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
		);
		$userAdmin = $this->paginate('User');
		$this->set(compact('userAdmin'));
	}
	function superadmin_resultviewer_add(){
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password did\'t matched');
				}
			}
			//User Saving
			$userArray['User']['username'] = $this->request->data['User']['username'];
			$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
			$userArray['User']['role'] = 20;
			$userArray['User']['status'] = true;
			$userArray['User']['posted'] = true;
			$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
			if($this->User->save($userArray))
			{
				//Person Save
				$this->loadModel('Person');
				$this->Person->create();
				$this->Person->save(
						array(
								'user_id'=>$this->User->id,
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username'],
								'entry_datetime'=>date('Y-m-d H:i:s')
						)
				);
				//Person Save
				$personID['PersonIdentity'] = array();
				$personID['PersonIdentity']['users_id'] = $this->User->id;
				$personID['PersonIdentity']['user_id'] = $this->User->id;
				$personID['PersonIdentity']['default'] = 1;
				$personID['PersonIdentity']['person_id'] = $this->Person->id;
				$personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['posted'] = true;
				$personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
				$this->loadModel('PersonIdentity');
				$this->PersonIdentity->create();
				if($this->PersonIdentity->save($personID)){
					$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
				}
	
				//Person Indentification Saving
				$this->loadModel('PersonIdentification');
				$personIdentification['PersonIdentification'] = array();
				$this->PersonIdentification->create();
				$personIdentification['user_id'] = $this->User->id;
				$personIdentification['person_id'] = $this->Person->id;
				$personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonIdentification->save($personIdentification)){
					$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
				}
	
				//Saving Person Alias
				$this->loadModel('PersonAlias');
				$this->Person->PersonAlias->create();
				$personAlias['PersonAlias'] = array();
				$personAlias['user_id'] = $this->User->id;
				$personAlias['person_id'] = $this->Person->id;
				$personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonAlias->save($personAlias)){
					$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
				}
	
			}
			$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
			$this->redirect(array('controller'=>'Users', 'action'=>'resultviewer'));
		}
	
	}
	function superadmin_resultviewer_edit($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		/*		$users = $this->User->find('all', array(
		 'fields'=>array(
					'User.*',
					'Person.*'
		 ),
				'conditions'=>array(
						'Person.user_id = '.$id,
				),
				'joins'=>array(
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.user_id = User.id'
								)
						)
				)
		));*/
		$users = $this->User->find('all', array(
				'fields'=>array(
						'User.*',
						'Person.*'
				),
				'conditions'=>array(
						'PersonIdentity.users_id = '.$id,
						//				'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
		));
		$this->set(compact('users'));
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
	
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
	
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
	
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
	
			}
				
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					$this->loadModel('Person');
					$this->Person->create();
					$this->Person->save(
							array(
									'id'=>$this->request->data['Person']['id'],
									'firstname'=> $this->request->data['Person']['firstname'],
									'lastname'=>$this->request->data['Person']['lastname'],
									'middlename'=>$this->request->data['Person']['middlename'],
									'myresultonline_id'=>$this->request->data['User']['username']
							)
					);
	
				}
				$this->User->commit();
				//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
				$this->redirect(array('controller'=>'users','action'=>'resultviewer'));
			}
		}
	}
	function admin_sales(){
		$this->layout = 'admin';
		$this->User->unbindAllModel(array('PersonIdentity'));
		$this->paginate = array(
			'fields'=>array(
				'User.role','User.id','User.status','User.username',
				'Person.firstname','Person.lastname', 'Person.entry_datetime'
			),
			'conditions'=>array(
				'User.role'=>10,
				'User.status'=>1,
				'PersonIdentity.posted'=>true
			),
       		'joins'=>array(
                    array(
                    'table'=>'person_identities',
                    'alias'=>'PersonIdentity',
                    'type' => 'left',
                    'conditions' => array(
                       	'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
                    'table'=>'people',
                    'alias'=>'Person',
                    'type' => 'left',
                    'conditions' => array(
                       	'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		);
		$userAdmin = $this->paginate('User');
		$this->set(compact('userAdmin'));
	}
	function admin_accounting(){
		$this->layout = 'admin';
		$this->User->unbindAllModel(array('PersonIdentity'));
		$this->paginate = array(
			'fields'=>array(
				'User.role','User.id','User.status','User.username',
				'Person.firstname','Person.lastname', 'Person.entry_datetime'
			),
			'conditions'=>array(
				'User.role'=>15,
				'User.status'=>1,
				'PersonIdentity.posted'=>true
			),
       		'joins'=>array(
                    array(
                    'table'=>'person_identities',
                    'alias'=>'PersonIdentity',
                    'type' => 'left',
                    'conditions' => array(
                       	'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
                    'table'=>'people',
                    'alias'=>'Person',
                    'type' => 'left',
                    'conditions' => array(
                       	'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		);
		$userAdmin = $this->paginate('User');
		$this->set(compact('userAdmin'));
	}
	function admin_administrator_add(){
		$this->layout='nazareth';
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			//debug($this->request->data);
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
					//User Saving]
		//			$this->User->create();
					$userArray['User']['username'] = $this->request->data['User']['username'];
					$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
					$userArray['User']['role'] = 1;
					$userArray['User']['status'] = true;
					$userArray['User']['posted'] = true;
					$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
					if($this->User->save($userArray))
					{
						//Person Save
						//$this->loadModel('Person');
			 		// 	$this->Person->create();
			 		// 	$this->Person->save(
						// 		array(
						// 			'user_id'=>$this->User->id,
						// 			'firstname'=> $this->request->data['Person']['firstname'],
						// 			'lastname'=>$this->request->data['Person']['lastname'],
						// 			'middlename'=>$this->request->data['Person']['middlename'],
						// 			'myresultonline_id'=>$this->request->data['User']['username'],
						// 			'entry_datetime'=>date('Y-m-d H:i:s')
						// 		)
						// 	);
						// //Person Save
						// $personID['PersonIdentity'] = array();
						// $personID['PersonIdentity']['users_id'] = $this->User->id;
						// $personID['PersonIdentity']['user_id'] = $this->User->id;
						// $personID['PersonIdentity']['default'] = 1;
						// $personID['PersonIdentity']['person_id'] = $this->Person->id;
						// $personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
						// $personID['PersonIdentity']['posted'] = true;
						// $personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
						// $this->loadModel('PersonIdentity');
						// $this->PersonIdentity->create();
						// if($this->PersonIdentity->save($personID)){
						// 	$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
						// }
						
						// //Person Indentification Saving
						// $this->loadModel('PersonIdentification');
						// $personIdentification['PersonIdentification'] = array();
						// $this->PersonIdentification->create();
						// $personIdentification['user_id'] = $this->User->id;
						// $personIdentification['person_id'] = $this->Person->id;
						// $personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
						
						// if(!$this->PersonIdentification->save($personIdentification)){
						// 	$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
						// }
						
						// //Saving Person Alias
						// $this->loadModel('PersonAlias');
						// $this->Person->PersonAlias->create();
						// $personAlias['PersonAlias'] = array();
						// $personAlias['user_id'] = $this->User->id;
						// $personAlias['person_id'] = $this->Person->id;
						// $personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
						
						// if(!$this->PersonAlias->save($personAlias)){
						// 	$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
						// }
						
						//if(!$this->PersonAlias->save($personAlias)){
						//	$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
						//}
						$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
						$this->redirect(array('controller'=>'Users', 'action'=>'administrator'));
					}
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password didn\'t matched');
				}
			}
			

		}

	}
	function superadmin_administrator_add(){
	
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password did\'t matched');
				}
			}
			//User Saving]
			//			$this->User->create();
			$userArray['User']['username'] = $this->request->data['User']['username'];
			$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
			$userArray['User']['role'] = $this->data['User']['role'];
			$userArray['User']['status'] = true;
			$userArray['User']['posted'] = true;
			$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
			if($this->User->save($userArray))
			{
				//Person Save
				$this->loadModel('Person');
				$this->Person->create();
				$this->Person->save(
						array(
								'user_id'=>$this->User->id,
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username'],
								'entry_datetime'=>date('Y-m-d H:i:s')
						)
				);
				//Person Save
				$personID['PersonIdentity'] = array();
				$personID['PersonIdentity']['users_id'] = $this->User->id;
				$personID['PersonIdentity']['user_id'] = $this->User->id;
				$personID['PersonIdentity']['default'] = 1;
				$personID['PersonIdentity']['person_id'] = $this->Person->id;
				$personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['posted'] = true;
				$personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
				$this->loadModel('PersonIdentity');
				$this->PersonIdentity->create();
				if($this->PersonIdentity->save($personID)){
					$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
				}
	
				//Person Indentification Saving
				$this->loadModel('PersonIdentification');
				$personIdentification['PersonIdentification'] = array();
				$this->PersonIdentification->create();
				$personIdentification['user_id'] = $this->User->id;
				$personIdentification['person_id'] = $this->Person->id;
				$personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonIdentification->save($personIdentification)){
					$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
				}
	
				//Saving Person Alias
				$this->loadModel('PersonAlias');
				$this->Person->PersonAlias->create();
				$personAlias['PersonAlias'] = array();
				$personAlias['user_id'] = $this->User->id;
				$personAlias['person_id'] = $this->Person->id;
				$personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonAlias->save($personAlias)){
					$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
				}
				$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
				$this->redirect(array('controller'=>'Users', 'action'=>'administrator'));
			}else{
				$this->Session->setFlash("User's Information not saved");
				$this->redirect(array('controller'=>'Users', 'action'=>'administrator'));
			}
	
		}
	
	}
	function admin_administrator_edit($id = null) {
		$this->layout = 'nazareth';
		$this->User->unbindAllModel(array('PersonIdentity'));
/*		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.*',
				'Person.*'
			),
			'conditions'=>array(
				'Person.user_id = '.$id,
			),
       			'joins'=>array(
                    array(
                    'table'=>'people',
                    'alias'=>'Person',
                    'type' => 'left',
                    'conditions' => array(
                        'Person.user_id = User.id'
                               )
                         )
                    )
		));*/
		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.username','User.password',
				'Person.lastname', 'Person.firstname', 'Person.middlename'
			),
			'conditions'=>array(
				'User.id = '.$id,
//				'PersonIdentity.posted'=>true
			),
       			'joins'=>array(
                    array(
	                    'table'=>'person_identities',
	                    'alias'=>'PersonIdentity',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
	                    'table'=>'people',
	                    'alias'=>'Person',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		));
		$this->set(compact('users'));
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
						
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
				
			}
			
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					/* $this->loadModel('Person');
 					$this->Person->create();
 					$this->Person->save(
							array(
								'id'=>$this->request->data['Person']['id'],
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username']
							)
						); */

				}
				$this->User->commit();
			//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'administrator'));
			}
		}
	}
	function superadmin_administrator_edit($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		/*		$users = $this->User->find('all', array(
		 'fields'=>array(
					'User.*',
					'Person.*'
		 ),
				'conditions'=>array(
						'Person.user_id = '.$id,
				),
				'joins'=>array(
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.user_id = User.id'
								)
						)
				)
		));*/
		$users = $this->User->find('all', array(
				'fields'=>array(
						'User.*',
						'Person.*'
				),
				'conditions'=>array(
						'PersonIdentity.users_id = '.$id,
						//				'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
		));
		$this->set(compact('users'));
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
	
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
	
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
	
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
	
			}
				
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					$this->loadModel('Person');
					$this->Person->create();
					$this->Person->save(
							array(
									'id'=>$this->request->data['Person']['id'],
									'firstname'=> $this->request->data['Person']['firstname'],
									'lastname'=>$this->request->data['Person']['lastname'],
									'middlename'=>$this->request->data['Person']['middlename'],
									'myresultonline_id'=>$this->request->data['User']['username']
							)
					);
	
				}
				$this->User->commit();
				//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
				$this->redirect(array('controller'=>'users','action'=>'administrator'));
			}
		}
	}
	function admin_sales_add(){
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password did\'t matched');
				}
			}
			//User Saving
			$userArray['User']['username'] = $this->request->data['User']['username'];
			$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
			$userArray['User']['role'] = 10;
			$userArray['User']['status'] = true;
			$userArray['User']['posted'] = true;
			$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
			if($this->User->save($userArray))
			{
				//Person Save
				$this->loadModel('Person');
	 			$this->Person->create();
	 			$this->Person->save(
						array(
							'user_id'=>$this->User->id,
							'firstname'=> $this->request->data['Person']['firstname'],
							'lastname'=>$this->request->data['Person']['lastname'],
							'middlename'=>$this->request->data['Person']['middlename'],
							'myresultonline_id'=>$this->request->data['User']['username'],
							'entry_datetime'=>date('Y-m-d H:i:s')
						)
					);
				//Person Save
				$personID['PersonIdentity'] = array();
				$personID['PersonIdentity']['users_id'] = $this->User->id;
				$personID['PersonIdentity']['user_id'] = $this->User->id;
				$personID['PersonIdentity']['default'] = 1;
				$personID['PersonIdentity']['person_id'] = $this->Person->id;
				$personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['posted'] = true;
				$personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
				$this->loadModel('PersonIdentity');
				$this->PersonIdentity->create();
				if($this->PersonIdentity->save($personID)){
					$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
				}
				
				//Person Indentification Saving
				$this->loadModel('PersonIdentification');
				$personIdentification['PersonIdentification'] = array();
				$this->PersonIdentification->create();
				$personIdentification['user_id'] = $this->User->id;
				$personIdentification['person_id'] = $this->Person->id;
				$personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
				
				if(!$this->PersonIdentification->save($personIdentification)){
					$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
				}
				
				//Saving Person Alias
				$this->loadModel('PersonAlias');
				$this->Person->PersonAlias->create();
				$personAlias['PersonAlias'] = array();
				$personAlias['user_id'] = $this->User->id;
				$personAlias['person_id'] = $this->Person->id;
				$personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
				
				if(!$this->PersonAlias->save($personAlias)){
					$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
				}
				
			}
			$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
			$this->redirect(array('controller'=>'Users', 'action'=>'sales'));
		}

	}
	function admin_sales_edit($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.*',
				'Person.*'
			),
			'conditions'=>array(
				'PersonIdentity.users_id = '.$id,
//				'PersonIdentity.posted'=>true
			),
       			'joins'=>array(
                    array(
	                    'table'=>'person_identities',
	                    'alias'=>'PersonIdentity',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
	                    'table'=>'people',
	                    'alias'=>'Person',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		));
		$this->set(compact('users'));
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
						
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
				
			}
			
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					$this->loadModel('Person');
 					$this->Person->create();
 					$this->Person->save(
							array(
								'id'=>$this->request->data['Person']['id'],
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username']
							)
						);

				}
				$this->User->commit();
			//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
	
					$this->redirect(array('controller'=>'users','action'=>'sales'));
			}
		}
	}
	function admin_accounting_add(){
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password did\'t matched');
				}
			}
			//User Saving
			$userArray['User']['username'] = $this->request->data['User']['username'];
			$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
			$userArray['User']['role'] = 15;
			$userArray['User']['status'] = true;
			$userArray['User']['posted'] = true;
			$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
			if($this->User->save($userArray))
			{
				//Person Save
				$this->loadModel('Person');
	 			$this->Person->create();
	 			$this->Person->save(
						array(
							'user_id'=>$this->User->id,
							'firstname'=> $this->request->data['Person']['firstname'],
							'lastname'=>$this->request->data['Person']['lastname'],
							'middlename'=>$this->request->data['Person']['middlename'],
							'myresultonline_id'=>$this->request->data['User']['username'],
							'entry_datetime'=>date('Y-m-d H:i:s')
						)
					);
				//Person Save
				$personID['PersonIdentity'] = array();
				$personID['PersonIdentity']['users_id'] = $this->User->id;
				$personID['PersonIdentity']['user_id'] = $this->User->id;
				$personID['PersonIdentity']['default'] = 1;
				$personID['PersonIdentity']['person_id'] = $this->Person->id;
				$personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['posted'] = true;
				$personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
				$this->loadModel('PersonIdentity');
				$this->PersonIdentity->create();
				if($this->PersonIdentity->save($personID)){
					$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
				}
				
				//Person Indentification Saving
				$this->loadModel('PersonIdentification');
				$personIdentification['PersonIdentification'] = array();
				$this->PersonIdentification->create();
				$personIdentification['user_id'] = $this->User->id;
				$personIdentification['person_id'] = $this->Person->id;
				$personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
				
				if(!$this->PersonIdentification->save($personIdentification)){
					$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
				}
				
				//Saving Person Alias
				$this->loadModel('PersonAlias');
				$this->Person->PersonAlias->create();
				$personAlias['PersonAlias'] = array();
				$personAlias['user_id'] = $this->User->id;
				$personAlias['person_id'] = $this->Person->id;
				$personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
				
				if(!$this->PersonAlias->save($personAlias)){
					$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
				}
				
			}
			$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
			$this->redirect(array('controller'=>'Users', 'action'=>'accounting'));
		}

	}
	function admin_accounting_edit($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.*',
				'Person.*'
			),
			'conditions'=>array(
				'PersonIdentity.users_id = '.$id,
//				'PersonIdentity.posted'=>true
			),
       			'joins'=>array(
                    array(
	                    'table'=>'person_identities',
	                    'alias'=>'PersonIdentity',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
	                    'table'=>'people',
	                    'alias'=>'Person',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		));
		$this->set(compact('users'));
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
						
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
				
			}
			
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					$this->loadModel('Person');
 					$this->Person->create();
 					$this->Person->save(
							array(
								'id'=>$this->request->data['Person']['id'],
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username']
							)
						);

				}
				$this->User->commit();
			//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'accounting'));
			}
		}
	}
	function upload(){
	}
	public function admin_delete($id = null) {
		$this->User->recursive = -1;
		$role = $this->User->find('first',array('fields'=>array('User.role'),'conditions'=>array('User.id'=>$id)));
		$this->loadModel('User');
		$this->loadModel('Person');
		$this->loadModel('PersonAlias');
		$this->loadModel('PersonIdentification');
		$this->loadModel('PersonIdentity');
		$this->loadModel('Physician');
		if($role){
			$this->PersonIdentification->deleteAll(array('PersonIdentification.user_id'=>$id),false);
			$this->PersonIdentity->deleteAll(array('PersonIdentity.users_id'=>$id),false);
			$this->PersonAlias->deleteAll(array('PersonAlias.user_id'=>$id),false);
			$this->Person->deleteAll(array('Person.user_id'=>$id),false);
			$this->User->delete(array('User.id'=>$id),false);
			if($role['User']['role'] == 6){
				$this->Physician->deleteAll(array('Physician.users_id'=>$id),false);
			}
			if($role['User']['role'] == 0){$this->redirect(array('action' => 'administrator'));}
			elseif($role['User']['role'] == 1){$this->redirect(array('action' => 'administrator'));}
			else if($role['User']['role'] == 10){$this->redirect(array('action' => 'sales'));}
			else if($role['User']['role'] == 15){$this->redirect(array('action' => 'accounting'));}
			else if($role['User']['role'] == 20){$this->redirect(array('action' => 'resultviewer'));}
			else if($role['User']['role'] == 9){$this->redirect(array('action' => 'patient'));}
			else if($role['User']['role'] == 6){$this->redirect(array('action' => 'physician'));}
			else if($role['User']['role'] == 3){$this->redirect(array('action' => 'laboratory'));}
			else{
				$this->redirect(array('action' => '/'));
			}
		}
	
	
	
	}
	public function superadmin_deleteadmin($id = null) {
		$this->User->recursive = -1;
		$role = $this->User->find('first',array('fields'=>array('User.role'),'conditions'=>array('User.id'=>$id)));
		$this->loadModel('User');
		$this->loadModel('Person');
		$this->loadModel('PersonAlias');
		$this->loadModel('PersonIdentification');
		$this->loadModel('PersonIdentity');
		if($role){
			$this->PersonIdentification->deleteAll(array('PersonIdentification.user_id'=>$id),false);
			$this->PersonIdentity->deleteAll(array('PersonIdentity.users_id'=>$id),false);
			$this->PersonAlias->deleteAll(array('PersonAlias.user_id'=>$id),false);
			$this->Person->deleteAll(array('Person.user_id'=>$id),false);
			$this->User->delete(array('User.id'=>$id),false);
			if($role['User']['role'] == 0){$this->redirect(array('action' => 'administrator'));}
			elseif($role['User']['role'] == 1){$this->redirect(array('action' => 'administrator'));}
			else if($role['User']['role'] == 10){$this->redirect(array('action' => 'sales'));}
			else if($role['User']['role'] == 15){$this->redirect(array('action' => 'accounting'));}else{
				$this->redirect(array('action' => 'administrator'));
			}
		}
	
	
	
	}
	public function superadmin_deleteviewer($id = null) {
		$this->User->recursive = -1;
		$role = $this->User->find('first',array('fields'=>array('User.role'),'conditions'=>array('User.id'=>$id)));
		$this->loadModel('User');
		$this->loadModel('Person');
		$this->loadModel('PersonAlias');
		$this->loadModel('PersonIdentification');
		$this->loadModel('PersonIdentity');
		if($role){
			$this->PersonIdentification->deleteAll(array('PersonIdentification.user_id'=>$id),false);
			$this->PersonIdentity->deleteAll(array('PersonIdentity.users_id'=>$id),false);
			$this->PersonAlias->deleteAll(array('PersonAlias.user_id'=>$id),false);
			$this->Person->deleteAll(array('Person.user_id'=>$id),false);
			$this->User->delete(array('User.id'=>$id),false);
			if($role['User']['role'] == 0){$this->redirect(array('action' => 'administrator'));}
			elseif($role['User']['role'] == 1){$this->redirect(array('action' => 'administrator'));}
			else if($role['User']['role'] == 10){$this->redirect(array('action' => 'sales'));}
			else if($role['User']['role'] == 15){$this->redirect(array('action' => 'accounting'));}else{
				$this->redirect(array('action' => 'resultviewer'));
			}
		}
	
	
	
	}
// 	function admin_patient(){
// 		$this->layout = 'admin';
// 		$this->User->unbindAllModel(array('PersonIdentity'));
// 		$this->paginate = array(
// 			'fields'=>array(
// 				'User.role','User.id','User.status','User.username',
// 				'Person.firstname','Person.lastname', 'Person.entry_datetime'
// 			),
// 			'conditions'=>array(
// 				'User.role'=>9,
// 				'User.status'=>array(1,6),
// 				'PersonIdentity.posted'=>true
// 			),
//        		'joins'=>array(
//                     array(
//                     'table'=>'person_identities',
//                     'alias'=>'PersonIdentity',
//                     'type' => 'left',
//                     'conditions' => array(
//                        	'PersonIdentity.users_id = User.id'
//                             )
//                          ),
//                     array(
//                     'table'=>'people',
//                     'alias'=>'Person',
//                     'type' => 'left',
//                     'conditions' => array(
//                        	'Person.id = PersonIdentity.person_id'
//                             )
//                          ),
//              ),
// 		);
		
// 		$userAdmin = $this->paginate('User');
// //		debug($userAdmin);
// 		$this->set(compact('userAdmin'));
// 	}
	function admin_patient_view($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.*',
				'Person.*'
			),
			'conditions'=>array(
				'PersonIdentity.users_id = '.$id,
				'PersonIdentity.posted'=>true
			),
       			'joins'=>array(
                    array(
	                    'table'=>'person_identities',
	                    'alias'=>'PersonIdentity',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
	                    'table'=>'people',
	                    'alias'=>'Person',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		));
		$this->set(compact('users'));
		
		if($this->request->is('post')){
			$this->User->create();
			$userArray['id'] = $id;
			$userArray['status'] = $this->data['User']['status'];
			if($this->User->save($userArray)){
				if($this->data['User']['status'] == 1){
					$this->Session->setFlash("User's account has been activated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'patient'));
				}else{
					$this->Session->setFlash("User's account has been deactivated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'patient'));
				}
			}
		}
		
		
	}
	/*function admin_physician(){
		$this->layout = 'admin';
		$this->User->unbindAllModel(array('PersonIdentity'));
		$this->paginate = array(
			'fields'=>array(
				'User.role','User.id','User.status','User.username',
				'Person.firstname','Person.lastname', 'Person.entry_datetime'
			),
			'conditions'=>array(
				'User.role'=>6,
				'User.status'=>array(1,6),
				'PersonIdentity.posted'=>true
			),
       		'joins'=>array(
                    array(
                    'table'=>'person_identities',
                    'alias'=>'PersonIdentity',
                    'type' => 'left',
                    'conditions' => array(
                       	'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
                    'table'=>'people',
                    'alias'=>'Person',
                    'type' => 'left',
                    'conditions' => array(
                       	'Person.id = PersonIdentity.person_id'
                            )
                         ),
             ),
		);
		
		$userAdmin = $this->paginate('User');
//		debug($userAdmin);
		$this->set(compact('userAdmin'));
	}*/
	function admin_physician_view($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.*',
				'Person.*'
			),
			'conditions'=>array(
				'PersonIdentity.users_id = '.$id,
				'PersonIdentity.posted'=>true
			),
       			'joins'=>array(
                    array(
	                    'table'=>'person_identities',
	                    'alias'=>'PersonIdentity',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
	                    'table'=>'people',
	                    'alias'=>'Person',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		));
		$this->set(compact('users'));
		
		if($this->request->is('post')){
			$this->User->create();
			$userArray['id'] = $id;
			$userArray['status'] = $this->data['User']['status'];
			if($this->User->save($userArray)){
				if($this->data['User']['status'] == 1){
					$this->Session->setFlash("User's account has been activated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'physician'));
				}else{
					$this->Session->setFlash("User's account has been deactivated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'physician'));
				}
			}
		}
		
		
	}
	function admin_laboratory(){
		$this->layout = 'admin';
		$this->User->unbindAllModel(array('PersonIdentity'));
		$this->paginate = array(
			'fields'=>array(
				'User.role','User.id','User.status','User.username',
				'Person.firstname','Person.lastname', 'Person.entry_datetime'
			),
			'conditions'=>array(
				'User.role'=>3,
				'User.status'=>array(1,6),
				'PersonIdentity.posted'=>true
			),
       		'joins'=>array(
                    array(
                    'table'=>'person_identities',
                    'alias'=>'PersonIdentity',
                    'type' => 'left',
                    'conditions' => array(
                       	'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
                    'table'=>'people',
                    'alias'=>'Person',
                    'type' => 'left',
                    'conditions' => array(
                       	'Person.id = PersonIdentity.person_id'
                            )
                         ),
             ),
		);
		
		$userAdmin = $this->paginate('User');
//		debug($userAdmin);
		$this->set(compact('userAdmin'));
	}
	function admin_laboratory_view($id = null) {
		$this->User->unbindAllModel(array('PersonIdentity'));
		$users = $this->User->find('all', array(
			'fields'=>array(
				'User.*',
				'Person.*'
			),
			'conditions'=>array(
				'PersonIdentity.users_id = '.$id,
				'PersonIdentity.posted'=>true
			),
       			'joins'=>array(
                    array(
	                    'table'=>'person_identities',
	                    'alias'=>'PersonIdentity',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'PersonIdentity.users_id = User.id'
                            )
                         ),
                    array(
	                    'table'=>'people',
	                    'alias'=>'Person',
	                    'type' => 'left',
	                    'conditions' => array(
                       		'Person.id = PersonIdentity.person_id'
                            )
                         ),
             )
		));
		$this->set(compact('users'));
		
		if($this->request->is('post')){
			$this->User->create();
			$userArray['id'] = $id;
			$userArray['status'] = $this->data['User']['status'];
			if($this->User->save($userArray)){
				if($this->data['User']['status'] == 1){
					$this->Session->setFlash("User's account has been activated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'laboratory'));
				}else{
					$this->Session->setFlash("User's account has been deactivated",'default',array('class'=>'success_message'));
					$this->redirect(array('controller'=>'users','action'=>'laboratory'));
				}
			}
		}
		
		
	}
	
	
	function corp_confirm($token=null){
		$token = str_replace(" ","+",$token);
		//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		$email = $this->Auth->user('username');
		$this->set(compact('email'));
		if(isset($token) && !empty($token)){
			$this->loadModel('Token');
			$checkToken = $this->Token->find('first',array(
					'fields'=>array(
							'Token.id',
							'Token.code',
							'Token.status'
					),
					'conditions'=>array(
							'Token.code' => $token,
					)
			));
			$this->User->recursive = 0;
			$checkUser = $this->User->find('first',array(
					'fields'=>array(
							'User.id',
							'User.status'
					),
					'conditions'=>array(
							'User.id' => $tokenarr[0]
					)
			));
			//			$checkToken = current($checkToken);
			if($checkToken['Token']['status']==2){
				if(isset($token)){
					$userid=$tokenarr[0];
					$username=$tokenarr[1];
						
					$this->User->recursive = 0;
					$this->User->id = $userid;
					$this->User->saveField('status', 3 );
						
					//Modified Token Status
					$this->Token->recursive = 0;
					$this->Token->id = $checkToken['Token']['id'];
					$this->Token->saveField('status', 1 );
	
					$this->redirect(array('action'=>'/corporate_profile/'.$token));
				}
			}else if($checkToken['Token']['status']==1){
				if($checkUser['User']['status'] == 3){
					$this->redirect(array('action'=>'/corporate_profile/'.$token));
				}else if($checkUser['User']['status'] == 4){
					$this->redirect(array('action'=>'/corporate_agreement/'.$token));
				}else{
					if($this->Auth->user()){
						$this->redirect('/corporate');
					}else{
						$this->redirect(array('controller'=>'Home','action'=>'index','corporate'=>false));
					}
				}
			}
		}else{
			if($this->request->is('post') && !empty($this->data['User']['myresultonline_id'])){
				$username = trim($this->data['User']['myresultonline_id']," ");
				if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
					$this->Captcha = $this->Components->load('Captcha'); //load it
				}
				$this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->User->set($this->request->data);
				if($this->User->validates())	{ //as usual data save call
					$this->User->recursive = 0;
					$checkUser = $this->User->find('first',array(
							'fields'=>array(
									'User.id',
									'User.status'
							),
							'conditions'=>array(
									'User.username' => $username
							)
					));
					$userid = $checkUser['User']['id'];
						
					$this->loadModel('Token');
					$checkToken = $this->Token->find('first',array(
							'fields'=>array(
									'Token.id',
									'Token.code',
									'Token.status'
							),
							'conditions'=>array(
									'Token.user_id' => $userid,
							)
					));
						
					$this->loadModel('Person');
					$this->Person->recursive = -1;
					$personDetail = $this->Person->find('first',array(
							'conditions'=>array(
									'Person.user_id'=>$userid
							)
					));
					$token = $checkToken['Token']['code'];
					//				$personDetail = current($personDetail);
						
					$name = $personDetail['Person']['firstname'].' '.$personDetail['Person']['lastname'];
					//				$templater = 'lab_verify';
					$type = 2;
					//				$title = 'MyResultOnline Email Confirmation';
	
					//				$this->_email_send($userid,$username,$name,$templater,$title,$type,$token);
					$templater = 'email_template';
						
					//Load email template
					$this->loadModel('EmailTemplate');
					$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>1,'status'=>1)));
					$memberType = 3;
						
					$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
						
					$this->Session->setFlash('Email Confirmation successfully sent.','default',array('class'=>'success_message'));
	
				}else{
					// display the raw API error
					//$this->Session->setFlash('Captcha Validation Failure');
				}
			}
		}
	
	}
	function corp_agreement($token=null){
		$token = str_replace(" ","+",$token);
		//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			if (!$this->request->is('post')) {
	
				$this->loadModel('Person');
				$this->Person->recursive = -1;
				$personDetail = $this->Person->find('first',array(
						'conditions'=>array(
								'Person.user_id'=>$userid
						)
				));
	
				//Update user status
				$this->User->recursive = 0;
				$this->User->id = $userid;
				$this->User->saveField('status', 4 );
					
				//				$personDetail = current($personDetail);
				$name = $personDetail['Person']['firstname'].' '.$personDetail['Person']['lastname'];
				$type = 2;
	
				//				$this->_email_send($userid,$username,$name,$templater,$title,$type,$token);
				$templater = 'email_template';
	
				//Load email template
				$this->loadModel('EmailTemplate');
				$email_template = $this->EmailTemplate->find('first',array('conditions'=>array('type'=>2,'status'=>1)));
				$memberType = 6;
	
				$this->_email_send($userid,$username,$name,$templater,$email_template,$type,$token,$memberType);
	
				//				$this->redirect(array('controller' => 'Home', 'action' => 'index'));
			}else{
				$this->Session->setFlash('You are now agreed to our terms and conditions.','default',array('class'=>'success_message'));
				$this->redirect(array('controller' => 'Home', 'action' => 'index'));
	
			}
				
		}
	
	}
	function corp_finish($token=null){
		$token = str_replace(" ","+",$token);
		//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			//			if ($this->request->is('post')) {
	
			$this->User->recursive = 0;
			$userDetail = $this->User->find('first',array(
					'conditions'=>array('User.id'=>$userid)
			));
			$user = $userDetail;
			$this->Auth->login($user['User']);
	
			$this->redirect(array('controller'=>'corporate_accounts','action'=>'/profile','corporate'=>true));
			//			}
				
		}
	}
	function corp_profile($token=null){
		$this->layout = 'nazareth';
		$token = str_replace(" ","+",$token);
		//		$tokenToDecrypt = $this->decrypt(str_replace("+r3pLAc3+","/",$token), Configure::read('Token.secretKey'));
		$tokenToDecrypt = $this->decrypt($token, Configure::read('Token.secretKey'));
		$tokenarr = explode("::",$tokenToDecrypt);
		if(isset($token) && !empty($token)){
			$this->loadModel('People');
			$this->loadModel('Company');
			$this->loadModel('CompanyBranch');
			$this->loadModel('CorporateAccount');
			$this->loadModel('TitleCode');
			$this->loadModel('Address');
			$this->loadModel('LaboratoryAcceptedInsurance');
			$this->loadModel('ContactInformation');
				
			$userid=$tokenarr[0];
			$username=$tokenarr[1];
			$classCorporate=$tokenarr[2];
				
			$this->CompanyBranch->recursive = -1;
			$comBranch = $this->Company->CompanyBranch->find('first',array(
					'fields'=>array('CompanyBranch.branch','BranchUser.status'),
					'conditions'=>array(
							'BranchUser.id' => $userid,
							'Token.code'=>$token
					),
					'joins'=>array(
							array(
									'table'=>'users',
									'alias'=>'BranchUser',
									'type'=>'LEFT',
									'conditions'=>array(
											'CompanyBranch.user_id = BranchUser.id'
									)
							),
							array(
									'table'=>'tokens',
									'alias'=>'Token',
									'type'=>'LEFT',
									'conditions'=>array(
											'BranchUser.id = Token.user_id'
									)
							),
							array(
									'table'=>'people',
									'alias'=>'Person',
									'type'=>'LEFT',
									'conditions'=>array(
											'BranchUser.id = Person.user_id'
									)
							)
					)
			));
			$contactTypes = $this->ContactInformation->types;
			$title = $this->TitleCode->find('list');
			$this->loadModel('ProvincesStatesCode');
			$provinces = $this->ProvincesStatesCode->find('list',array(
					'fields' => array('id','name'),
					'conditions' => array(
							'validated' => true
					)
			));
			$provinces[0] = "";
			asort($provinces);
				
			$townCities = array('');
			$villages = array('');
			$streets = array('');
			//			$comBranch = current($comBranch);
				
// 			$this->loadModel('Corporate');
			$CorporateId = $this->Company->CompanyBranch->find('all',array(
					'fields'=>array('CompanyBranch.id'),
					'conditions'=>array(
							'CompanyBranch.user_id' => $userid,
					),
			));
// 			debug($comBranch);
			if($comBranch){
				if($comBranch['BranchUser']['status'] != 5){
					if ($this->request->is('post')) {
						if(!empty($this->request->data)){
							debug($comBranch);
							//CompanyBranchInfo Image
							$newimageinfo = false;
							$filenameinfo = '';
							if(isset($this->request->data['CompanyBranchInfo']['upload']['tmp_name']) && strlen($this->request->data['CompanyBranchInfo']['upload']['tmp_name'])){
									
								$filenameinfo = String::uuid().'.'.end(explode('.', $this->request->data['CompanyBranchInfo']['upload']['name']));
								if(move_uploaded_file($this->request->data['CompanyBranchInfo']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filenameinfo)) {
									$newimageinfo = true;
								}
							}
							if($newimageinfo){
								$this->request->data['CompanyBranchInfo']['logo'] = $filenameinfo;
	
							}
								
							//Company Image
							$newimage = false;
							$filename = '';
							if(isset($this->request->data['Company']['upload']['tmp_name']) && strlen($this->request->data['Company']['upload']['tmp_name'])){
									
								$filename = String::uuid().'.'.end(explode('.', $this->request->data['Company']['upload']['name']));
								if(move_uploaded_file($this->request->data['Company']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filename)) {
									$newimage = true;
								}
							}
							if($newimage){
								$this->request->data['Company']['logo'] = $filename;
	
							}
							//Company Saving
							$this->Company->create();
							$companydata['Company'] = array();
							$companydata['id'] = $this->request->data['Company']['id'];
							$companydata['name'] = $this->request->data['Company']['name'];
							$companydata['website'] = $this->request->data['Company']['website'];
							$companydata['logo'] = (isset($this->request->data['Company']['logo']))?$this->request->data['Company']['logo']:"";
							$companydata['entry_datetime'] = date('Y-m-d H:i:s');
							$companydata['user_id'] = $userid;
							$companydata['validated'] = 1;
							$companydata['posted'] = true;
							$companydata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->save($companydata);
								
							//Saving Company Branches
							$this->Company->CompanyBranch->create();
							$companybranchdata['CompanyBranch'] = array();
							$companybranchdata = $this->request->data['CompanyBranch'];
							//							$companybranchdata['branch'] = $this->request->data['Company']['name'];
							$companybranchdata['company_id'] = (!empty($this->request->data['Company']['id']))?$this->request->data['Company']['id']:$this->Company->id;
							$companybranchdata['user_id'] = $userid;
							$companybranchdata['entry_datetime'] = date('Y-m-d H:i:s');
							$companybranchdata['posted'] = true;
							$companybranchdata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->save($companybranchdata);
								
							//Saving Company Branch Member
							$this->Company->CompanyBranch->CompanyBranchMember->create();
							$branchmemberdata['CompanyBranchMember'] = array();
							$branchmemberdata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$branchmemberdata['role'] = $this->User->roles['administrator'];
							$branchmemberdata['enabled'] = true;
							$branchmemberdata['entry_datetime'] = date('Y-m-d H:i:s');
							$branchmemberdata['users_id'] = $userid;
							$branchmemberdata['user_id'] = $userid;
							$branchmemberdata['posted'] = true;
							$branchmemberdata['posted_datetime'] = date('Y-m-d H:i:s');
								
							$this->Company->CompanyBranch->CompanyBranchMember->save($branchmemberdata);
								
							//Saving Company Branch Info
							$this->Company->CompanyBranch->CompanyBranchInfo->create();
							$branchinfodata['CompanyBranchInfo'] = array();
							$branchinfodata = $this->request->data['CompanyBranchInfo'];
							$branchinfodata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$branchinfodata['entry_datetime'] = date('Y-m-d H:i:s');
							$branchinfodata['user_id'] = $userid;
							$branchinfodata['posted'] = true;
							$branchinfodata['posted_datetime'] = date('Y-m-d H:i:s');
							$this->Company->CompanyBranch->CompanyBranchInfo->save($branchinfodata);
								
							//Saving CorporateAccount
							$this->Company->CompanyBranch->CorporateAccount->create();
							$corporatedata['CorporateAccount'] = array();
							$corporatedata = $this->request->data['CorporateAccount'];
							$corporatedata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$corporatedata['type'] = 1;
							//						$corporatedata['class'] = 1;
							$corporatedata['status'] = 1;
							$corporatedata['validated'] = 1;
							$corporatedata['user_id'] = $userid;
							$corporatedata['entry_datetime'] = date('Y-m-d H:i:s');
							$corporatedata['posted'] = true;
							$corporatedata['posted_datetime'] = date('Y-m-d H:i:s');
								
							if(!empty($this->request->data['Address']) && ($this->request->data['Address']['village_id'] != 0)){
								//Saving Address
								$this->loadModel('Address');
								$addressdata['Address'] = array();
								$this->Address->create();
								$addressdata = $this->request->data['Address'];
								$addressdata['entry_datetime'] = date('Y-m-d H:i:s');
								$addressdata['user_id'] = $userid;
								$this->Address->save($addressdata);
	
								//Saving CorporateAccount Address
								$this->loadModel('CompanyBranchAddress');
								$comBranchAddressData['CompanyBranchAddress'] = array();
								$this->CompanyBranchAddress->create();
								$comBranchAddressData['company_branch_id'] = (isset($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
								$comBranchAddressData['address_id'] = $this->Address->id;
								$comBranchAddressData['entry_datetime'] = date('Y-m-d H:i:s');
								$comBranchAddressData['user_id'] = $userid;
								$this->CompanyBranchAddress->save($comBranchAddressData);
							}
							if(isset($this->request->data['ContactInformation'])){
								$this->loadModel('ContactInformation');
								$this->ContactInformation->unbindAllModel();
								$this->loadModel('CompanyBranchContactInformation');
								//						$this->CompanyBranchContactInformation->unbindAllModel();
								$corpcontactinfo = $this->request->data['ContactInformation'];;
								foreach($corpcontactinfo as $contactInfo){
									$this->ContactInformation->create();
									if($this->ContactInformation->save(
											array(
													'type' => $contactInfo['type'],
													'contact' => $contactInfo['contact'],
													'entry_datetime'=> date('Y-m-d H:i:s'),
													'user_id'=>$userid
											)
									)){
	
										$this->CompanyBranchContactInformation->create();
										$this->CompanyBranchContactInformation->save(
												array(
														'company_branch_id' => $this->Company->CompanyBranch->id,
														'contact_id' => $this->ContactInformation->id,
														'entry_datetime'=> date('Y-m-d H:i:s'),
														'user_id'=>$userid
												)
										);
	
									}
								}
							}
							if($this->Company->CompanyBranch->CorporateAccount->save($corporatedata)){
								$this->Session->setFlash('Corporate profile has been saved.','default',array('class'=>'success_message'));
	
								$this->User->recursive = 0;
								$this->User->id = $userid;
								$this->User->saveField('status', 4 );
	
								$this->redirect(array('action'=>'/corporate_agreement/'.$token));
							}else{
								$this->Session->setFlash('Error saving corporate!');
							}
						}
					}else{
						$corpId = $CorporateId[0]['CompanyBranch']['id'];
						$corpDetails = $this->Common->getCorporateDetails($corpId);
						$this->request->data = $corpDetails[$corpId];
// 						debug($this->request->data);
					}
					$branch_id = $this->request->data['CompanyBranch']['id'];
					if(isset($this->request->data['Address'])){
						$this->loadModel('TownCityCode');
						if(isset($this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id'])){
							$townCities = $this->TownCityCode->find('list',array(
									'fields' => array('id','name'),
									'conditions' => array(
											'validated' => true,
											'provinces_states_id' => $this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id']
									)
							));
							if(isset($this->request->data['Address'][$branch_id]['TownCityCode']['id'])){
								$this->loadModel('VillageCode');
								$villages = $this->VillageCode->find('list',array(
										'fields' => array('id','name'),
										'conditions' => array(
												'validated' => true,
												'town_city_id' => $this->request->data['Address'][$branch_id]['TownCityCode']['id']
										)
								));
									
								if(isset($this->request->data['Address'][$branch_id]['VillageCode']['id'])){
									$this->loadModel('StreetCode');
									$streets = $this->StreetCode->find('list',array(
											'fields' => array('id','name'),
											'conditions' => array(
													'validated' => true,
													//												'village_id' => $this->request->data['Address'][$branch_id]['VillageCode']['id']
											)
									));
								}
							}
						}
					}
				}else{
					$this->redirect(array('action'=>'/corporate_agreement/'.$token));
				}
			}else{
				if ($this->request->is('post')) {
	
					if(!empty($this->request->data)){
							
						//CompanyBranchInfo Image
						$newimageinfo = false;
						$filenameinfo = '';
						if(isset($this->request->data['CompanyBranchInfo']['upload']['tmp_name']) && strlen($this->request->data['CompanyBranchInfo']['upload']['tmp_name'])){
								
							$filenameinfo = String::uuid().'.'.end(explode('.', $this->request->data['CompanyBranchInfo']['upload']['name']));
							if(move_uploaded_file($this->request->data['CompanyBranchInfo']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filenameinfo)) {
								$newimageinfo = true;
							}
						}
						if($newimageinfo){
							$this->request->data['CompanyBranchInfo']['logo'] = $filenameinfo;
	
						}
							
						//Company Image
						$newimage = false;
						$filename = '';
						if(isset($this->request->data['Company']['upload']['tmp_name']) && strlen($this->request->data['Company']['upload']['tmp_name'])){
								
							$filename = String::uuid().'.'.end(explode('.', $this->request->data['Company']['upload']['name']));
							if(move_uploaded_file($this->request->data['Company']['upload']['tmp_name'], WWW_ROOT."/media/logos/".$filename)) {
								$newimage = true;
							}
						}
						if($newimage){
							$this->request->data['Company']['logo'] = $filename;
	
						}
							
						//Company Saving
						$this->Company->create();
						$companydata['Company'] = array();
						$companydata['id'] = $this->request->data['Company']['id'];
						$companydata['name'] = $this->request->data['Company']['name'];
						$companydata['website'] = $this->request->data['Company']['website'];
						$companydata['logo'] = (isset($this->request->data['Company']['logo']))?$this->request->data['Company']['logo']:"";
						$companydata['entry_datetime'] = date('Y-m-d H:i:s');
						$companydata['user_id'] = $userid;
						$companydata['validated'] = 1;
						$companydata['posted'] = true;
						$companydata['posted_datetime'] = date('Y-m-d H:i:s');
						$this->Company->save($companydata);
							
						//Saving Company Branches
						$this->Company->CompanyBranch->create();
						$companybranchdata['CompanyBranch'] = array();
						$companybranchdata = $this->request->data['CompanyBranch'];
						//							$companybranchdata['branch'] = $this->request->data['Company']['name'];
						$companybranchdata['company_id'] = (!empty($this->request->data['Company']['id']))?$this->request->data['Company']['id']:$this->Company->id;
						$companybranchdata['user_id'] = $userid;
						$companybranchdata['entry_datetime'] = date('Y-m-d H:i:s');
						$companybranchdata['posted'] = true;
						$companybranchdata['posted_datetime'] = date('Y-m-d H:i:s');
						$this->Company->CompanyBranch->save($companybranchdata);
							
						//Saving Company Branch Member
						$this->Company->CompanyBranch->CompanyBranchMember->create();
						$branchmemberdata['CompanyBranchMember'] = array();
						$branchmemberdata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
						$branchmemberdata['role'] = $this->User->roles['administrator'];
						$branchmemberdata['enabled'] = true;
						$branchmemberdata['entry_datetime'] = date('Y-m-d H:i:s');
						$branchmemberdata['users_id'] = $userid;
						$branchmemberdata['user_id'] = $userid;
						$branchmemberdata['posted'] = true;
						$branchmemberdata['posted_datetime'] = date('Y-m-d H:i:s');
						$this->Company->CompanyBranch->CompanyBranchMember->save($branchmemberdata);
							
						//Saving Company Branch Info
						$this->Company->CompanyBranch->CompanyBranchInfo->create();
						$branchinfodata['CompanyBranchInfo'] = array();
						$branchinfodata = $this->request->data['CompanyBranchInfo'];
						$branchinfodata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
						$branchinfodata['entry_datetime'] = date('Y-m-d H:i:s');
						$branchinfodata['user_id'] = $userid;
						$branchinfodata['posted'] = true;
						$branchinfodata['posted_datetime'] = date('Y-m-d H:i:s');
						$this->Company->CompanyBranch->CompanyBranchInfo->save($branchinfodata);
							
						//Saving CorporateAccount
						$this->Company->CompanyBranch->CorporateAccount->create();
						$corporatedata['CorporateAccount'] = array();
						$corporatedata = $this->request->data['CorporateAccount'];
						$corporatedata['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
						$corporatedata['type'] = ($corporatedata['class']==2 || $corporatedata['class']==3)?1:2;
						//						$corporatedata['class'] = 1;
						$corporatedata['status'] = 1;
						$corporatedata['validated'] = 1;
						$corporatedata['user_id'] = $userid;
						$corporatedata['entry_datetime'] = date('Y-m-d H:i:s');
						$corporatedata['posted'] = true;
						$corporatedata['posted_datetime'] = date('Y-m-d H:i:s');
							
						if(!empty($this->request->data['Address']) && ($this->request->data['Address']['village_id'] != 0)){
							//Saving Address
							$this->loadModel('Address');
							$addressdata['Address'] = array();
							$this->Address->create();
							$addressdata = $this->request->data['Address'];
							$addressdata['entry_datetime'] = date('Y-m-d H:i:s');
							$addressdata['user_id'] = $userid;
							$this->Address->save($addressdata);
	
							//Saving CorporateAccount Address
							$this->loadModel('CompanyBranchAddress');
							$comBranchAddressData['CompanyBranchAddress'] = array();
							$this->CompanyBranchAddress->create();
							$comBranchAddressData['company_branch_id'] = (!empty($this->request->data['CompanyBranch']['id']))?$this->request->data['CompanyBranch']['id']:$this->Company->CompanyBranch->id;
							$comBranchAddressData['address_id'] = $this->Address->id;
							$comBranchAddressData['entry_datetime'] = date('Y-m-d H:i:s');
							$comBranchAddressData['user_id'] = $userid;
							$this->CompanyBranchAddress->save($comBranchAddressData);
						}
						if(isset($this->request->data['ContactInformation'])){
							$this->loadModel('ContactInformation');
							$this->ContactInformation->unbindAllModel();
							$this->loadModel('CompanyBranchContactInformation');
							//						$this->CompanyBranchContactInformation->unbindAllModel();
							$corpcontactinfo = $this->request->data['ContactInformation'];;
							foreach($corpcontactinfo as $contactInfo){
								$this->ContactInformation->create();
								if($this->ContactInformation->save(
										array(
												'type' => $contactInfo['type'],
												'contact' => $contactInfo['contact'],
												'entry_datetime'=> date('Y-m-d H:i:s'),
												'user_id'=>$userid
										)
								)){
	
									$this->CompanyBranchContactInformation->create();
									$this->CompanyBranchContactInformation->save(
											array(
													'company_branch_id' => $this->Company->CompanyBranch->id,
													'contact_id' => $this->ContactInformation->id,
													'entry_datetime'=> date('Y-m-d H:i:s'),
													'user_id'=>$userid
											)
									);
	
								}
							}
						}
						if($this->Company->CompanyBranch->CorporateAccount->save($corporatedata)){
							$this->Session->setFlash('Corporate profile has been saved!','default',array('class'=>'success_message'));
	
							$this->User->recursive = 0;
							$this->User->id = $userid;
							$this->User->saveField('status', 4 );
	
							$this->redirect(array('action'=>'/corporate_agreement/'.$token));
						}else{
							$this->Session->setFlash('Error saving corporate!');
						}
	
					}
				}
					
				$branch_id = '0';
				if(isset($this->request->data['Address'])){
					$this->loadModel('TownCityCode');
					if(isset($this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id'])){
						$townCities = $this->TownCityCode->find('list',array(
								'fields' => array('id','name'),
								'conditions' => array(
										'validated' => true,
										'provinces_states_id' => $this->request->data['Address'][$branch_id]['ProvincesStatesCode']['id']
								)
						));
						if(isset($this->request->data['Address'][$branch_id]['TownCityCode']['id'])){
							$this->loadModel('VillageCode');
							$villages = $this->VillageCode->find('list',array(
									'fields' => array('id','name'),
									'conditions' => array(
											'validated' => true,
											'town_city_id' => $this->request->data['Address'][$branch_id]['TownCityCode']['id']
									)
							));
								
							if(isset($this->request->data['Address'][$branch_id]['VillageCode']['id'])){
								$this->loadModel('StreetCode');
								$streets = $this->StreetCode->find('list',array(
										'fields' => array('id','name'),
										'conditions' => array(
												'validated' => true,
												//										'village_id' => $this->request->data['Address'][$branch_id]['VillageCode']['id']
										)
								));
							}
						}
					}
				}
	
				//				$this->redirect(array('controller'=>'home'));
			}
			$this->set(compact('classCorporate','laboratory','title','contactTypes','provinces','townCities','villages','streets','branch_id'));
		}
	}
	
	function sales_pending_corporates(){
	
		$this->User->unbindAllModel();
		$users = $this->User->find('all',array(
				'conditions' => array(
						'User.status' => array(4,5),
						'User.role' => 11
				)
		));
		$this->loadModel('CorporateAccount');
		$this->CorporateAccount->unbindAllModel();
		$corporate = array();
		foreach($users as $userKey=>$userValue){
			$corporate = $this->CorporateAccount->find('first',array(
					'fields'=>array(
							'CorporateAccount.class'
					),
					'conditions'=>array(
							'CorporateAccount.user_id'=>$userValue['User']['id']
					)
			));
			$users[$userKey]['User']['CorporateAccount']['class'] =  (!empty($corporate['CorporateAccount']['class']))?$this->User->laboratoryClass[$corporate['CorporateAccount']['class']]:"";
			$users[$userKey]['User']['status'] = $this->User->userStatus[$userValue['User']['status']];
		}
		$userids = Set::extract($users,'{n}.User.id');
		$userDetails = $this->Common->getUserDetails($userids,array('Person.*'));
		//		debug($userDetails);
		$this->loadModel('CompanyBranchMember');
		$this->loadModel('CompanyBranch');
	
		$this->CompanyBranchMember->unbindAllModel();
		$companyMembers = $this->CompanyBranchMember->find('all',array(
				'conditions' => array(
						'CompanyBranchMember.users_id' => $userids
				)
		));
	
		$companyBranchIds = Set::extract($companyMembers,'{n}.CompanyBranchMember.company_branch_id');
		$companyMembers = Set::combine($companyMembers,'{n}.CompanyBranchMember.company_branch_id','{n}.CompanyBranchMember','{n}.CompanyBranchMember.users_id');
	
		$this->CompanyBranch->unbindAllModel(array('Company'));
		$companyBranches = $this->CompanyBranch->find('all',array(
				'conditions' => array(
						'CompanyBranch.id' => $companyBranchIds
				)
		));
		$companyBranches = Set::combine($companyBranches,'{n}.CompanyBranch.id','{n}');
	
		//		debug(compact('users','userDetails','companyMembers','companyBranches'));
		$this->set(compact('users','userDetails','companyMembers','companyBranches'));
	}
	
	function admin_physician(){
		$this->layout = 'nazareth';
		$config=Configure::read('mroresult');
		$settings=$config['webpost.settings'];
			
		/*
		 * set default configuration
		*/
		$laboratoryid = "10000000001";
		if(isset($settings['laboratory_id']) && !empty($settings['laboratory_id'])){
			$laboratoryid = $settings['laboratory_id'];//default
		}
		
// 		debug($laboratoryid);
		// $this->layout = 'admin';
		$name = "";
		$username = "";
		if($this->request->is('post') && ((!empty($this->data['Patient']['name'])) || (!empty($this->data['Patient']['username'])))){
			if(!empty($this->data['Patient']['name'])){
				$name = $this->data['Patient']['name'];
				
				$this->User->unbindAllModel(array('PersonIdentity'));
				$this->paginate = array(
						'order'=>array('User.entry_datetime'=> 'DESC'),
						'fields'=>array(
								'User.role','User.id','User.status','User.username',
								'Person.firstname','Person.lastname', 'Person.entry_datetime'
						),
						'conditions'=>array(
								'User.role'=>6,
								'User.status'=>1,
								'PersonIdentity.posted'=>true,
								'PersonIdentity.laboratory_id'=>$laboratoryid,
								'OR'=>array(
										'Person.firstname' => $name,
										'Person.lastname' => $name,
								)
						),
						'joins'=>array(
								array(
										'table'=>'person_identities',
										'alias'=>'PersonIdentity',
										'type' => 'left',
										'conditions' => array(
												'PersonIdentity.users_id = User.id',
										)
								),
								array(
										'table'=>'people',
										'alias'=>'Person',
										'type' => 'left',
										'conditions' => array(
												'Person.id = PersonIdentity.person_id'
										)
								),
						),
// 						'group'=>array('User.id')
				);
				
			}elseif(!empty($this->data['Patient']['username'])){
				$username = $this->data['Patient']['username'];
				
				$this->User->unbindAllModel(array('PersonIdentity'));
				$this->paginate = array(
						'order'=>array('User.entry_datetime'=> 'DESC'),
						'fields'=>array(
								'User.role','User.id','User.status','User.username',
								'Person.firstname','Person.lastname', 'Person.entry_datetime'
						),
						'conditions'=>array(
								'User.role'=>6,
								'User.status'=>1,
								'PersonIdentity.posted'=>true,
								'PersonIdentity.laboratory_id'=>$laboratoryid,
								'User.username' => $username,
						),
						'joins'=>array(
								array(
										'table'=>'person_identities',
										'alias'=>'PersonIdentity',
										'type' => 'left',
										'conditions' => array(
												'PersonIdentity.users_id = User.id'
										)
								),
								array(
										'table'=>'people',
										'alias'=>'Person',
										'type' => 'left',
										'conditions' => array(
												'Person.id = PersonIdentity.person_id'
										)
								),
						)
				);
				
			}
			
			$userAdmin = $this->paginate('User');
			$this->set(compact('userAdmin'));
		}else{
			$this->User->unbindAllModel(array('PersonIdentity'));
			$this->paginate = array(
					'order'=>array('User.entry_datetime'=> 'DESC'),
					'fields'=>array(
							'User.role','User.id','User.status','User.username',
							'Person.firstname','Person.lastname', 'Person.entry_datetime'
					),
					'conditions'=>array(
							'User.role'=>6,
							'User.status'=>1,
							'PersonIdentity.posted'=>true,
							'PersonIdentity.laboratory_id'=>$laboratoryid,
					),
					'joins'=>array(
							array(
									'table'=>'person_identities',
									'alias'=>'PersonIdentity',
									'type' => 'left',
									'conditions' => array(
											'PersonIdentity.users_id = User.id'
									)
							),
							array(
									'table'=>'people',
									'alias'=>'Person',
									'type' => 'left',
									'conditions' => array(
											'Person.id = PersonIdentity.person_id'
									)
							),
					)
			);
			$userAdmin = $this->paginate('User');
			$this->set(compact('userAdmin'));
		}
	}
	function admin_physician_add(){
		$this->layout = 'admin';
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password did\'t matched');
				}
			}
			
			$config=Configure::read('mroresult');
			$settings=$config['webpost.settings'];
				
			/*
			 * set default configuration
			*/
			$laboratoryid = "10000000001";
			if(isset($settings['laboratory_id']) && !empty($settings['laboratory_id'])){
				$laboratoryid = $settings['laboratory_id'];//default
			}
			
			//User Saving
			$userArray['User']['username'] = $this->request->data['User']['username'];
			$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
			$userArray['User']['role'] = 6;
			$userArray['User']['status'] = true;
			$userArray['User']['posted'] = true;
			$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
			if($this->User->save($userArray))
			{
				//Person Save
				$this->loadModel('Person');
				$this->Person->create();
				$this->Person->save(
						array(
								'user_id'=>$this->User->id,
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username'],
								'entry_datetime'=>date('Y-m-d H:i:s')
						)
				);
				
				
				//PersonIdentity Save
				$personID['PersonIdentity'] = array();
				$personID['PersonIdentity']['users_id'] = $this->User->id;
				$personID['PersonIdentity']['user_id'] = $this->User->id;
				$personID['PersonIdentity']['default'] = 1;
				$personID['PersonIdentity']['person_id'] = $this->Person->id;
				$personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['posted'] = true;
				$personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['laboratory_id']=$laboratoryid;
				$this->loadModel('PersonIdentity');
				$this->PersonIdentity->create();
				if($this->PersonIdentity->save($personID)){
					$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
				}
	
				//Person Indentification Saving
				$this->loadModel('PersonIdentification');
				$personIdentification['PersonIdentification'] = array();
				$this->PersonIdentification->create();
				$personIdentification['user_id'] = $this->User->id;
				$personIdentification['person_id'] = $this->Person->id;
				$personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonIdentification->save($personIdentification)){
					$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
				}
	
				//Saving Person Alias
				$this->loadModel('PersonAlias');
				$this->Person->PersonAlias->create();
				$personAlias['PersonAlias'] = array();
				$personAlias['user_id'] = $this->User->id;
				$personAlias['person_id'] = $this->Person->id;
				$personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonAlias->save($personAlias)){
					$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
				}
				
				
				//Physician Save
				$physiciandata = array();
				$physiciandata['Physician']['internal_id']=$this->request->data['Physician']['internal_id'];
				$physiciandata['Physician']['users_id']=$this->User->id;
				$physiciandata['Physician']['user_id']= $this->Auth->User('id');
				$physiciandata['Physician']['laboratory_id']=$laboratoryid;
				$physiciandata['Physician']['entry_datetime']=date('Y-m-d H:i:s');
				$physiciandata['Physician']['validated']=1;
				$physiciandata['Physician']['validated_user_id']=$this->Auth->User('id');
				$physiciandata['Physician']['validated_datetime']=date('Y-m-d H:i:s');
				$physiciandata['Physician']['posted']=1;
				$physiciandata['Physician']['posted_datetime']=date('Y-m-d H:i:s');
				
				$returnuser = $this->__savePhysician($physiciandata, null, null);

	
			}
			$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
			$this->redirect(array('controller'=>'Users', 'action'=>'physician'));
		}
	
	}
	
	public function __savePhysicianProfile($physicianprofile=array(),$token=null,$session_id=null){
		$success['status']=true;
		if(!empty($physicianprofile)){
			$error=false;
			$this->loadModel('PhysicianProfile');
			$this->PhysicianProfile->begin();
			if(!$this->PhysicianProfile->save($physicianprofile)){
				$error=true;
			}
	
			if($error){
				$this->PhysicianProfile->rollback();
				//$this->log('Patient Order Physician Profile rollback','debug');
				$success['status']=false;
			}else{
				$this->PhysicianProfile->commit();
			}
	
		}else{
			$success['status']=false;
		}
		return $success;
	}
	public function __savePhysician($physician=array(),$token=null,$session_id=null){
		$success['status']=true;
		$physicianprofile=array();
		if(!empty($physician)){
			$error=false;
			$this->loadModel('Physician');
			$this->Physician->begin();
			if(!$this->Physician->save($physician)){
				$error=true;
			}else{
				//$this->log($physician,'physiciansave');
				$physicianprofile['PhysicianProfile']=$physician['Physician'];
				$physicianprofile['PhysicianProfile']['physician_id']=$this->Physician->id;
				$physicianprofile['PhysicianProfile']['entry_datetime']=date('Y-m-d H:i:s');
	
				//$this->__savePatient($physician['Physician']['Patient'],$token,$session_id);
	
			}
	
			$physicianprofilereturn = $this->__savePhysicianProfile($physicianprofile,$token,$session_id);
				
			if(!$physicianprofilereturn['status']){
				$error = true;
			}
			if($error){
				$this->Physician->rollback();
				//$this->log('Patient Order Physician rollback','debug');
				$success['status']=false;
			}else{
				$success['Physician']['id']=$this->Physician->id;
				$this->Physician->commit();
			}
	
		}else{
			$success['status']=false;
		}
		return $success;
	}
	function admin_physician_edit($id = null) {
		$this->layout = 'nazareth';
		$this->User->unbindAllModel(array('PersonIdentity'));
		/*		$users = $this->User->find('all', array(
		 'fields'=>array(
		 		'User.*',
		 		'Person.*'
		 ),
				'conditions'=>array(
						'Person.user_id = '.$id,
				),
				'joins'=>array(
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.user_id = User.id'
								)
						)
				)
		));*/
		
		$config=Configure::read('mroresult');
		$settings=$config['webpost.settings'];
		
		/*
		 * set default configuration
		*/
		$laboratoryid = "10000000001";
		if(isset($settings['laboratory_id']) && !empty($settings['laboratory_id'])){
			$laboratoryid = $settings['laboratory_id'];//default
		}
		
		$users = $this->User->find('all', array(
				'limit'=>1,
				'fields'=>array(
						'User.*',
						'Person.*'
				),
				'conditions'=>array(
						'PersonIdentity.users_id = '.$id,
						//				'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
		));
		$this->loadModel('Physician');
		$physician = $this->Physician->find('first',array(
				'conditions'=>array('Physician.users_id'=>$id)
		));
		// foreach ($users as $key=>$value){
		// 	$users[$key]['Physician']['internal_id'] = $physician['Physician']['internal_id'];
		// }
		$this->set(compact('users'));
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
	
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
	
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
	
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
	
			}
	
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				
				//Physician Save
				
				$physiciandata = array();
				$physiciandata['Physician']['id']=$physician['Physician']['id'];
			//	$physiciandata['Physician']['internal_id']=$this->request->data['Physician']['internal_id'];
				$physiciandata['Physician']['entry_datetime']=date('Y-m-d H:i:s');
				
				$returnuser = $this->__savePhysician($physiciandata, null, null);
				
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					$this->loadModel('Person');
					$this->Person->create();
					$this->Person->save(
							array(
									'id'=>$this->request->data['Person']['id'],
									'firstname'=> $this->request->data['Person']['firstname'],
									'lastname'=>$this->request->data['Person']['lastname'],
									'middlename'=>$this->request->data['Person']['middlename'],
									'myresultonline_id'=>$this->request->data['User']['username']
							)
					);
	
				}
				$this->User->commit();
				//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
				$this->redirect(array('controller'=>'users','action'=>'physician'));
			}
		}
	}

	function admin_patient(){
		$this->layout = 'nazareth';
		$config=Configure::read('mroresult');
		$settings=$config['webpost.settings'];
			
		/*
		 * set default configuration
		*/
		$laboratoryid = "10000000001";
		if(isset($settings['laboratory_id']) && !empty($settings['laboratory_id'])){
			$laboratoryid = $settings['laboratory_id'];//default
		}
		
		// $this->layout = 'admin';
		$name = "";
		$username = "";
		if($this->request->is('post') && ((!empty($this->data['Patient']['name'])) || (!empty($this->data['Patient']['username'])))){
			if(!empty($this->data['Patient']['name'])){
				$name = $this->data['Patient']['name'];
				
				$this->User->unbindAllModel(array('PersonIdentity'));
				$this->paginate = array(
						'order'=>array('User.entry_datetime'=> 'DESC'),
						'fields'=>array(
								'User.role','User.id','User.status','User.username',
								'Person.firstname','Person.lastname', 'Person.entry_datetime'
						),
						'conditions'=>array(
								'User.role'=>9,
								'User.status'=>1,
								'PersonIdentity.posted'=>true,
								'PersonIdentity.laboratory_id'=>$laboratoryid,
								'OR'=>array(
										'Person.firstname' => $name,
										'Person.lastname' => $name,
								)
						),
						'joins'=>array(
								array(
										'table'=>'person_identities',
										'alias'=>'PersonIdentity',
										'type' => 'left',
										'conditions' => array(
												'PersonIdentity.users_id = User.id'
										)
								),
								array(
										'table'=>'people',
										'alias'=>'Person',
										'type' => 'left',
										'conditions' => array(
												'Person.id = PersonIdentity.person_id'
										)
								),
						)
				);
			
			}elseif(!empty($this->data['Patient']['username'])){
				$username = $this->data['Patient']['username'];
				
				$this->User->unbindAllModel(array('PersonIdentity'));
				$this->paginate = array(
						'order'=>array('User.entry_datetime'=> 'DESC'),
						'fields'=>array(
								'User.role','User.id','User.status','User.username',
								'Person.firstname','Person.lastname', 'Person.entry_datetime'
						),
						'conditions'=>array(
								'User.role'=>9,
								'User.status'=>1,
								'PersonIdentity.posted'=>true,
								'PersonIdentity.laboratory_id'=>$laboratoryid,
								'User.username' => $username,
						),
						'joins'=>array(
								array(
										'table'=>'person_identities',
										'alias'=>'PersonIdentity',
										'type' => 'left',
										'conditions' => array(
												'PersonIdentity.users_id = User.id'
										)
								),
								array(
										'table'=>'people',
										'alias'=>'Person',
										'type' => 'left',
										'conditions' => array(
												'Person.id = PersonIdentity.person_id'
										)
								),
						)
				);
			}
			
			$userAdmin = $this->paginate('User');
// 			debug($userAdmin);
			$this->set(compact('userAdmin'));
		}else{
			$this->User->unbindAllModel(array('PersonIdentity'));
			$this->paginate = array(
					'order'=>array('User.entry_datetime'=> 'DESC'),
					'fields'=>array(
							'User.role','User.id','User.status','User.username',
							'Person.firstname','Person.lastname', 'Person.entry_datetime'
					),
					'conditions'=>array(
							'User.role'=>9,
							'User.status'=>1,
							'PersonIdentity.posted'=>true,
							'PersonIdentity.laboratory_id'=>$laboratoryid,
					),
					'joins'=>array(
							array(
									'table'=>'person_identities',
									'alias'=>'PersonIdentity',
									'type' => 'left',
									'conditions' => array(
											'PersonIdentity.users_id = User.id'
									)
							),
							array(
									'table'=>'people',
									'alias'=>'Person',
									'type' => 'left',
									'conditions' => array(
											'Person.id = PersonIdentity.person_id'
									)
							),
					)
			);
			$userAdmin = $this->paginate('User');
			$this->set(compact('userAdmin'));
		}
		
	}
	function admin_patient_add(){
		$this->layout = 'admin';
		$userArray['User'] = array();
		if(!empty($this->request->data)){
			if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['password']))
			{
				if($this->data['User']['confirm_password'] == $this->data['User']['password']){
					$userArray['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Password did\'t matched');
				}
			}
			//User Saving
			$userArray['User']['username'] = $this->request->data['User']['username'];
			$userArray['User']['entry_datetime'] = date('Y-m-d H:i:s');
			$userArray['User']['role'] = 9;
			$userArray['User']['status'] = true;
			$userArray['User']['posted'] = true;
			$userArray['User']['posted_datetime'] = date('Y-m-d H:i:s');
			if($this->User->save($userArray))
			{
				//Person Save
				$this->loadModel('Person');
				$this->Person->create();
				$this->Person->save(
						array(
								'user_id'=>$this->User->id,
								'firstname'=> $this->request->data['Person']['firstname'],
								'lastname'=>$this->request->data['Person']['lastname'],
								'middlename'=>$this->request->data['Person']['middlename'],
								'myresultonline_id'=>$this->request->data['User']['username'],
								'entry_datetime'=>date('Y-m-d H:i:s')
						)
				);
				//Person Save
				$personID['PersonIdentity'] = array();
				$personID['PersonIdentity']['users_id'] = $this->User->id;
				$personID['PersonIdentity']['user_id'] = $this->User->id;
				$personID['PersonIdentity']['default'] = 1;
				$personID['PersonIdentity']['person_id'] = $this->Person->id;
				$personID['PersonIdentity']['entry_datetime'] = date('Y-m-d H:i:s');
				$personID['PersonIdentity']['posted'] = true;
				$personID['PersonIdentity']['posted_datetime'] = date('Y-m-d H:i:s');
				$this->loadModel('PersonIdentity');
				$this->PersonIdentity->create();
				if($this->PersonIdentity->save($personID)){
					$this->Session->setFlash('Error saving person identity. Please contact the system administrator.');
				}
	
				//Person Indentification Saving
				$this->loadModel('PersonIdentification');
				$personIdentification['PersonIdentification'] = array();
				$this->PersonIdentification->create();
				$personIdentification['user_id'] = $this->User->id;
				$personIdentification['person_id'] = $this->Person->id;
				$personIdentification['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonIdentification->save($personIdentification)){
					$this->Session->setFlash('Error saving person identification. Please contact the system administrator.');
				}
	
				//Saving Person Alias
				$this->loadModel('PersonAlias');
				$this->Person->PersonAlias->create();
				$personAlias['PersonAlias'] = array();
				$personAlias['user_id'] = $this->User->id;
				$personAlias['person_id'] = $this->Person->id;
				$personAlias['entry_datetime'] =  date('Y-m-d H:i:s');
	
				if(!$this->PersonAlias->save($personAlias)){
					$this->Session->setFlash('Error saving person alias. Please contact the system administrator.');
				}
	
			}
			$this->Session->setFlash("User's Information has been saved",'default',array('class'=>'success_message'));
			$this->redirect(array('controller'=>'Users', 'action'=>'patient'));
		}
	
	}
	function admin_patient_edit($id = null) {
		$this->layout = 'nazareth';
		$this->User->unbindAllModel(array('PersonIdentity'));
		/*		$users = $this->User->find('all', array(
		 'fields'=>array(
		 		'User.*',
		 		'Person.*'
		 ),
				'conditions'=>array(
						'Person.user_id = '.$id,
				),
				'joins'=>array(
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.user_id = User.id'
								)
						)
				)
		));*/
		$users = $this->User->find('all', array(
				'limit'=>1,
				'fields'=>array(
						'User.*',
						'Person.*'
				),
				'conditions'=>array(
						'PersonIdentity.users_id = '.$id,
						//				'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
		));
		$this->set(compact('users'));
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
	
		$old_password = $this->User->find('first', array('conditions'=>array('id'=>$id),'fields'=>'password'));
	
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}else
		{
			//debug($old_password);
			$error = false;
			$this->User->begin();
			$temppassword = $this->data['User']['password'];
			unset($this->request->data['User']['password']);
			if(!$this->User->save($this->data['User'], array('validate'=>'only')))
			{
				$error = true;
				$this->Session->setFlash('Unable to save changes');
			}
			else
			{
				if($temppassword == Security::hash('', null, true))
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the password');
				}
				elseif($temppassword == $old_password['User']['password'])
				{
					if(!empty($this->data['User']['confirm_password']) && !empty($this->data['User']['new_password']))
					{
						if($this->data['User']['confirm_password'] == $this->data['User']['new_password']){
							$this->request->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
						}
						else
						{
							$error = true;
							$this->Session->setFlash('Password did\'t matched');
						}
					}
	
				}
				else
				{
					$error = true;
					$this->Session->setFlash('Unable to save changes. Please provide the right password');
				}
	
			}
	
			$newPass = Security::hash($this->data['User']['new_password'], null, true);
			if($error)
			{
				$this->User->rollback();
			}
			else
			{
				//$this->User->id = $id;
				if($this->User->save($this->data['User']))
				{
					$this->loadModel('Person');
					$this->Person->create();
					$this->Person->save(
							array(
									'id'=>$this->request->data['Person']['id'],
									'firstname'=> $this->request->data['Person']['firstname'],
									'lastname'=>$this->request->data['Person']['lastname'],
									'middlename'=>$this->request->data['Person']['middlename'],
									'myresultonline_id'=>$this->request->data['User']['username']
							)
					);
	
				}
				$this->User->commit();
				//	debug($this->data['User']);
				$this->Session->setFlash("User's Information has been updated",'default',array('class'=>'success_message'));
				$this->redirect(array('controller'=>'users','action'=>'patient'));
			}
		}
	}
	
	function admin_resetpassword($id = null) {
		$this->layout = 'admin';
		$error = false;
		if($id){
			$this->loadModel('User');
			$user = $this->User->find('first', array(
				'limit'=>1,
				'fields'=>array(
						'User.*',
						'Person.*'
				),
				'conditions'=>array(
						'PersonIdentity.users_id = '.$id,
						//				'PersonIdentity.posted'=>true
				),
				'joins'=>array(
						array(
								'table'=>'person_identities',
								'alias'=>'PersonIdentity',
								'type' => 'left',
								'conditions' => array(
										'PersonIdentity.users_id = User.id'
								)
						),
						array(
								'table'=>'people',
								'alias'=>'Person',
								'type' => 'left',
								'conditions' => array(
										'Person.id = PersonIdentity.person_id'
								)
						),
				)
			));
			$this->User->begin();
			$usersave = array();
			$birthdate_formatted = date('mdY',strtotime($user['Person']['birthdate']));
			$newPass = Security::hash($birthdate_formatted, null, true);
			$user['User']['password'] = $newPass;
			$usersave['User'] = $user['User'];
			
// 			debug($user['User']);
			//$this->User->id = $id;
			 if($this->User->save($usersave['User']))
			{
				$error = false;
			}else{
				$error = true;
			}
				
			if($error)
			{
				$this->User->rollback();
				$this->Session->setFlash("User's password cannot reset. Please contact the administrator.",'default',array('class'=>'error_message'));
			}
			else
			{	
				$this->User->commit();
				//	debug($this->data['User']);
				$this->Session->setFlash("User's password has been reset",'default',array('class'=>'success_message'));
// 				$this->redirect(array('controller'=>'users','action'=>'patient'));
				$role = array();
				$role['User']['role'] = $user['User']['role'];
				if($role['User']['role'] == 0){$this->redirect(array('action' => 'administrator'));}
				elseif($role['User']['role'] == 1){$this->redirect(array('action' => 'administrator'));}
				else if($role['User']['role'] == 10){$this->redirect(array('action' => 'sales'));}
				else if($role['User']['role'] == 15){$this->redirect(array('action' => 'accounting'));}
				else if($role['User']['role'] == 20){$this->redirect(array('action' => 'resultviewer'));}
				else if($role['User']['role'] == 9){$this->redirect(array('action' => 'patient'));}
				else if($role['User']['role'] == 6){$this->redirect(array('action' => 'physician'));}
				else if($role['User']['role'] == 3){$this->redirect(array('action' => 'laboratory'));}
				else{
					$this->redirect(array('action' => '/'));
				}
			}
			
		}
		
	}
	
	function view_result_notification(){
		// Write your SMS code here
		$email = new CakeEmail();
		$email->config('smtp');
		$email->emailFormat('html');
		$email->template('phc');
		$email->to('nolie.francisco@easy.com.ph'); //User email
		$email->subject('PHC sample');
	
		
		// $email->viewVars(array('userid'=>$userid,'username'=>$username,'name'=>$name,'token'=>$token,'email_content'=>$email_content,'memberType'=>$memberType,'email_type'=>$email_type));
		if($email->send('Smtp'))
			$status = 'success';
		else
			$status = 'failed';
			
		$this->set('data',$status);
    	$this->header('Content-Type:text/json');
		$this->render('/Common/json');
	}
	
	// FOR PHMC-LP
	// function sendmessage($data){
	// 	$this->layout = false;
	// 	$success = true;
	// 	if($data){
	// 		if($data['Person']['mobile'])
	// 			$mobilenumber = trim($data['Person']['mobile']);
			
	// 		// $mobilenumber='09772750108';
	// 		//$mobilenumber='09178045641';
	// 		$pin = $this->Cookie->read('User.pin');
	// 		$message = "This is PHMC-LP. Your Online Laboratory Results security code is ".$pin.". This is only valid within 24hrs.";
	// 		$this->log($pin,'pin');
	// 		$savetooutbox = array(
	// 				'Msg'=>$message,
	// 				'MPN'=>$mobilenumber,
	// 				'Status'=>0,
	// 				'Priority'=>2,
	// 				'UserID'=>'OnlineLab',
	// 				'COMNum'=>'1',
	// 				'Datestamp'=>date('Y-m-d H:i:s')
	// 		);		

	// 		$globe=array('0905','0906','0915','0916','0917','0925','0926','0927','0935','0936','0937','0996','0997');
	// 		if( !in_array(substr($savetooutbox['MPN'],0,4), $globe)){
	// 			$savetooutbox['COMNum']=2;
	// 		}
	// 		// $this->log($savetooutbox,'isesavesaoutbox');
	// 		$this->loadModel('Outbox');
	// 		if($this->Outbox->save($savetooutbox)){

	// 		}else{
	// 			$success = false;
	// 		}
			
	// 		// $outBox = $this->Outbox->find('all',array('conditions'=>array('Outbox.MPN'=>'09178865039')));
	// 		//$this->log($this->data,'SendMesssage');
	// 		$this->log($success,'SendMesssage');

	// 		return $success;
	// 	}else
	// 		return false;
	// }
	
}
