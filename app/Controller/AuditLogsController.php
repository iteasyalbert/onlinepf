<?php
/**
 * Users Controller
 *
 * @property User $User
 */
class AuditLogsController extends AppController {
	var $name = 'AuditLogs';
	public $components = array('RequestHandler','Session','Cookie');
	var $helpers = array('Session');
	function beforeFilter(){
		// parent::beforeFilter();
		// $this->Auth->allow('login','admin_login','signin','ajax_signin','logout','forgot_password_vcode','get_result_vcode','forgot_password_reset');
		
	}

	function admin_index($page=null){
		// $this->layout = Configure::read('page_layout');
		if(!$this->Session->read('User.isAuthorized') && $this->Session->read('User.role') <> 'ROLE_ADMIN'){
			$this->redirect('/users/signout');
		}
	}

	function getAuditLogs($page=null){
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
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/audit_log/index?page='.$page, $data,$request);
            $this->log(json_decode($response), 'apirespo_get_users');
            $decoded_respo = json_decode($response);
            if($decoded_respo->success){
            	$filter = "";
				foreach ($this->data as $key => $value) {
					$filter .= $key.'='.$value;
				}
            	$send_audit = $this->addAuditLog('get_audit_logs',array(
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
            	$send_audit = $this->addAuditLog('get_audit_logs',array(
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
			$this->log($e->getMessage(), 'apirespo_audit_log');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}

	function admin_utilization($page=null){
		// $this->layout = Configure::read('page_layout');
		if(!$this->Session->read('User.isAuthorized') && $this->Session->read('User.role') <> 'ROLE_ADMIN'){
			$this->redirect('/users/signout');
		}
	}

	function getUtilization(){
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
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/audit_log/utilization', $data,$request);
            $this->log(json_decode($response), 'get_audit_logs');
            $decoded_respo = json_decode($response);
            $myrequest['data'] = $decoded_respo;
    //         if($decoded_respo->success){
    //         	$filter = "";
				// foreach ($this->data as $key => $value) {
				// 	$filter .= $key.'='.$value;
				// }
    //         	$send_audit = $this->addAuditLog('get_audit_logs',array(
				// 	'success'=>true,
				// 	'message'=>(empty($filter)?count($decoded_respo->data->data).' result(s) found using default filter.':count($decoded_respo->data->data).' result(s) found using filter '.$filter)
				// ));
		  //   	try {
				// 	ini_set('default_socket_timeout', 10);
					
				// 	$HttpSocket = new HttpSocket();
				// 	$data = $send_audit;
		  //           $request = array(
				// 						'header' => array('Content-Type' => 'application/json','Accept'=>'application/json',
				// 					),
				// 				);
		  //           $data = json_encode($data);
		  //           $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				// } catch (Exception $e) {
				// 	$this->log($e->getMessage(), 'apirespo_audit_log');
				// }
            	
    //         	$myrequest['data'] = $decoded_respo->data;
    //         }else{
    //         	$send_audit = $this->addAuditLog('get_audit_logs',array(
				// 	'success'=>false,
				// 	'message'=>$decoded_respo->message
				// ));
		  //   	try {
				// 	ini_set('default_socket_timeout', 10);
					
				// 	$HttpSocket = new HttpSocket();
				// 	$data = $send_audit;
		  //           $request = array(
				// 						'header' => array('Content-Type' => 'application/json','Accept'=>'application/json',
				// 					),
				// 				);
		  //           $data = json_encode($data);
		  //           $response = $HttpSocket->post(Configure::read('api.domain_name').'/user/audit', $data, $request);
				// } catch (Exception $e) {
				// 	$this->log($e->getMessage(), 'apirespo_audit_log');
				// }
    //         	$myrequest['error']['message'] = $decoded_respo->message;
    //         	$myrequest['error']['status'] = true;
    //         }
		} catch (Exception $e) {
			$myrequest['error']['message'] = $e->getMessage();
			$myrequest['error']['status'] = true;
			$this->log($e->getMessage(), 'get_audit_logs');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}
	function phptojson(){
		$this->layout = false;
		$data['Transaction']['0']['PatientVisit']['id'] = '12345678';
		$data['Transaction']['0']['PatientVisit']['patient_id'] = '000123';
		$data['Transaction']['0']['PatientVisit']['patient_type'] = '1';
		$data['Transaction']['0']['PatientVisit']['chief_complaint'] = 'SEVERE BLEEDING';
		$data['Transaction']['0']['PatientVisit']['created_at'] = '2019-07-05 09:07:39';
		$data['Transaction']['0']['PatientVisit']['mgh_datetime'] = '2019-07-05 09:07:39';
		$data['Transaction']['0']['PatientVisit']['untag_mgh_datetime'] = '2019-07-05 09:07:39';
		$data['Transaction']['0']['PatientVisit']['cancel_datetime'] = '2019-07-05 09:07:39';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['id'] = '1';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['patient_visit_id'] = '12345678';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['consultant_type_id'] = '1002';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['practitioner_id'] = '1001';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['pf_amount'] = '0.00';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['discount'] = '0.00';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['instrument_fee'] = '0.00';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['created_at'] = '2019-07-05 09:07:39';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['id'] = '1001';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['last_name'] = 'BELO';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['first_name'] = 'VICKY';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['middle_name'] = null;
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['birthdate'] = '1994-05-14 00:00:00';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['age'] = '55';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['sex'] = 'F';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['license_number'] = '001515';
		$data['Transaction']['0']['PatientVisit']['PatientCareProvider']['0']['Practitioner']['contact_numbers'] = '09178045641';
		$data['Transaction']['0']['Patient']['id'] = '000321';
		$data['Transaction']['0']['Patient']['last_name'] = 'FRANCCISCO';
		$data['Transaction']['0']['Patient']['first_name'] = 'NOLIE';
		$data['Transaction']['0']['Patient']['middle_name'] = 'PAPA';
		$data['Transaction']['0']['Patient']['birthdate'] = '1994-05-14 00:00:00';
		$data['Transaction']['0']['Patient']['age'] = '25';
		$data['Transaction']['0']['Patient']['sex'] = 'M';
		$data['Transaction']['0']['Patient']['marital_status'] = 'S';
		$data['Transaction']['0']['Patient']['registered_date'] = '2019-07-05';
		$data['Transaction']['0']['Patient']['registered_time'] = '09:07:39';
		$this->set('data', $data);
		$this->render('/Common/json');
	}
}