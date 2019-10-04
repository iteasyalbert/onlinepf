<?php
/**
 * Users Controller
 *
 * @property User $User
 */
class ConfigurationsController extends AppController {
	var $name = 'Configurations';
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

	function getConfigurations($page=null){
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
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/configuration/index?page='.$page, $data,$request);
            $this->log(json_decode($response), 'apirespo_get_configurations');
            $decoded_respo = json_decode($response);
            if($decoded_respo->success){
            	$filter = "";
				foreach ($this->data as $key => $value) {
					$filter .= $key.'='.$value;
				}
            	$send_audit = $this->addAuditLog('configurations',array(
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
            	$send_audit = $this->addAuditLog('configurations',array(
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
			$this->log($e->getMessage(), 'apirespo_get_configurations');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}

	public function admin_edit($id = null) {
    	// $this->layout = Configure::read('page_layout');

    	if($this->request->is('get')){
	        try {
				ini_set('default_socket_timeout', 10);
				
				$HttpSocket = new HttpSocket();
				$data = array(
					'id'=>$id
				);
				debug($id);
	            $request = array(
	            				'header' => array(
	            					'Accept'=>'application/json',
				            					'Content-Type' => 'application/json',
	            					'Authorization'=> 'Bearer'.' '.$this->Session->read('api.access_token'),
								),
							);
	            // $data = json_encode($data);
	            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/configuration/edit?id='.$id, $data,$request);
	            $this->log(json_decode($response), 'apirespo_configuration_get');
	            $decoded_respo = json_decode($response);
	            $myrequest['data'] = $decoded_respo->data;
	            
			} catch (Exception $e) {
				$this->log($e->getMessage(), 'apirespo_configuration_get');
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
	            $response = $HttpSocket->post(Configure::read('api.domain_name').'/api/configuration/edit', $data,$request);
	            $this->log(json_decode($response), 'apirespo_configurations_edit');
	            $decoded_respo = json_decode($response);

	            $send_audit = $this->addAuditLog('configurations',array(
            		'url'=>'configurations/edit',
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
                	$this->redirect('/admin/configurations');
	            }else{
	            	// todo : audit log here
	            	
	            	$this->Session->setFlash($decoded_respo->message, 'alert_flash');
                	$this->redirect('/admin/configurations');
	            }
			} catch (Exception $e) {
				$this->log($e->getMessage(), 'apirespo_configurations_edit');
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
}