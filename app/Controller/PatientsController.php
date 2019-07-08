<?php
App::uses('AppController', 'Controller');
// App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));
/**
 * Patients Controller
 *
 * @property Patient $Patient
 */
class PatientsController extends AppController {
	
	public $uses = array('Person','PersonInsurance','Patient','LaboratoryPatientOrder','Laboratory');
	public $components = array('RequestHandler','HCWService','Paginator','Cookie');
	public $helpers = array('Html', 'Js');
	function beforeFilter()
	{
		parent::beforeFilter();
	}
	
	public function index(){
	
	
	}
	public function getPdf($specimenid){
		
		header("Content-Type: application/pdf");
		ini_set('memory_limit', '512M');
		
    	if($this->Session->read('User.isAuthorized')){
	    	try {
				ini_set('default_socket_timeout', 15);
				
				$HttpSocket = new HttpSocket();
	            $response = $HttpSocket->get(Configure::read('get_pdf_url').$specimenid);

		    	header("Content-Disposition: inline; filename=$specimenid.pdf");
		    	print($response);
		    	$send_audit = $this->addAuditLog('user.view_order',array(
					'specimen_id'=>$specimenid,
					'viewed_by'=>$this->Session->read('User.name')
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
			}catch (Exception $e) {
				$this->log($e->getMessage(), 'getpdf');
    			$this->render('/Errors/error400', 404);
			}
    	}else{
    		$this->redirect('/users/signout');
    	}
	}

	public function patient_profile(){
		// $this->log($this->Session->read('User.isAuthorized'), 'now');
		// $this->log($this->Session->read('User.role'), 'now');
		$this->layout = Configure::read('page_layout');
		if(!$this->Session->read('User.isAuthorized')){
			$this->redirect('/users/signout');
		}
	}

	public function getPatientOrders($page=null){
		$this->layout = false;
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
            $response = $HttpSocket->get(Configure::read('api.domain_name').'/api/get_patient_orders?page='.$page, $data,$request);
            $this->log(json_decode($response), 'apirespo_get_px_orders');
            $decoded_respo = json_decode($response);
            if($decoded_respo->success){
            	$filter = "";
				foreach ($this->data as $key => $value) {
					$filter .= $key.'='.$value;
				}
            	$send_audit = $this->addAuditLog('get_patient_orders',array(
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
            	$send_audit = $this->addAuditLog('get_patient_orders',array(
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
			$this->log($e->getMessage(), 'apirespo_get_px_orders');
		}
    	$this->set('data', $myrequest);
    	$this->header('Content-Type: text/json');
    	$this->render('/Common/json');
	}
	
	public function physician_profile(){
		if($this->RequestHandler->isAjax()){
			if(isset($_POST['Person']['id'])){
				$this->loadModel('PersonIdentity');
				$identityUserId = $this->PersonIdentity->find('first',array(
						'conditions'=>array('PersonIdentity.person_id'=>$_POST['Person']['id']),
						'recursive'=>-1
				));
				$userid = array($identityUserId['PersonIdentity']['users_id']);
				$puserid = $this->Auth->user('id');
				$options = array('conditions' => array('Person.id'=>$_POST['Person']['id']),'group'=>array('Person.id'));
				$fields = array('Person.*','Address','Image');
				extract($this->__profile($userid,$puserid,null,null,$options,$fields));
				$this->layout = '';
				$this->loadModel('LaboratoryTestGroup');
				$testgroups=$this->LaboratoryTestGroup->find('list');
				$this->set('data',compact('testgroups','person','LaboratoryTestGroups','testOrders','testOrderPackages','laboratories'));
				$this->log(compact('testgroups','person','LaboratoryTestGroups','testOrders','testOrderPackages','laboratories'),'physicianorder');
		    	$this->header('Content-Type:text/json');
				$this->render('/Common/json');
			}
		}
	}
	
	public function laboratory_profile(){
		if($this->RequestHandler->isAjax()){
			if(isset($_POST['Person']['id'])){
				$this->loadModel('PersonIdentity');
				$identityUserId = $this->PersonIdentity->find('first',array(
						'conditions'=>array('PersonIdentity.person_id'=>$_POST['Person']['id']),
						'recursive'=>-1
				));
				$userid = array($identityUserId['PersonIdentity']['users_id']);
				//$this->log($userid,'user');
				$luserid = $this->Auth->user('id');
				$options = array('conditions' => array('Person.id'=>$_POST['Person']['id']),'group'=>array('Person.id'));
				$fields = array('Person.*','Address','Image');
				extract($this->__profile($userid,null,$luserid,null,$options,$fields));
				$this->layout = '';
				$this->loadModel('LaboratoryTestGroup');
				$testgroups=$this->LaboratoryTestGroup->find('list');
				$this->set('data',compact('testgroups','person','LaboratoryTestGroups','testOrders','testOrderPackages','laboratories'));
				$this->header('Content-Type:text/json');
				$this->render('/Common/json');
			}
		}
	}
	
	public function resultviewer_index(){
		
		$this->layout = 'nazareth';
		
		$this->loadModel('Laboratory');
		$this->Laboratory->unbindAllModel(array('CompanyBranch'),false);
		
		$laboratories = $this->Laboratory->find('all',array(
			'fields' => array('Laboratory.id','CompanyBranch.name'),
			'conditions' => array(
				'Laboratory.status' => true
			),
			'joins'=>array(
					 array('table' => 'company_branches',
			            'alias' => 'CompanyBranch1',
			            'type' => 'inner',
			            'conditions' => array(
			            'Laboratory.company_branch_id = CompanyBranch1.id'
			        )
				)
			)
		));
		$laboratories = Set::combine($laboratories,'{n}.Laboratory.id','{n}.CompanyBranch.name');
		$this->set(compact('laboratories'));
	}
	
	function getActivity(){
		$mo = '';
		if(empty($_POST['data'])){
			$mo = date('Y-m',strtotime('now'));
		}else{
			$mo = $_POST['data'];
		}
		$userid = $this->Auth->user('id');
		$recentDetails = $this->Common->getRecentActivities($this->Auth->user('id'),$mo,$userid,array('Post','Reply'));

        $this->loadModel('Reply');

		$replies = $this->Reply->find('all',array(
			'conditions' => array(
					'Reply.user_id' => $userid,
					'Reply.entry_datetime LIKE' => $mo.'%'
//					'Reply.post_content_id'=>$postContentId
			),
			'fields' => array(
			),
			'order' => 'Reply.entry_datetime ASC'
		));
		
		$replyArr = array();
		$replyArr = $replies;
		foreach($replies as $key=>$value){
			$replyArr[$key]['Post'] = $this->Post->find('first',array('fields'=>array('Post.*'),'conditions'=>array('Post.id'=>$value['PostContent']['post_id'])));
			unset($replyArr[$key]['Post']['PostContent']);
			unset($replyArr[$key]['Post']['Image']);
		}
		$replies = Set::combine($replyArr,'{n}.Reply.entry_datetime','{n}');
		
		$recentActivity = array_merge($replies,$recentDetails);
		ksort($recentActivity);
		$recentActivities = array_reverse($recentActivity, true);
		
		
		if($this->RequestHandler->isAjax()){
			$this->set(compact('recentActivities','mo'));
		}else{
			$this->set(compact('recentActivities','mo'));
		}
		
	}
	function __profile($userid,$puserid,$luserid,$cuserid,$options,$fields,$page){
		$testOrders = array();
		$persons = $this->Common->getUserDetails($userid,$fields,$options);
// 		$this->log($persons,'lablogs');
		$person = array_shift($persons);
		$pagecount = 
		$personIds = array();
	
		if(isset($person['id']))
			$personIds[] = $person['id'];
		if(isset($person['LaboratoryProfile']) && !empty($person['LaboratoryProfile']))
			$personIds = array_merge($personIds,Set::extract($person['LaboratoryProfile'],'{n}.id'));
		
		$userid = current($userid);
		$this->request->data = array('Person' => $person);
		$this->Patient->unbindAllModel(array(),false);
		$patient = $this->Patient->find('all',array(
			'conditions' => array('person_id'=>$personIds)
		));
		$patientIds = Set::extract($patient,'{n}.Patient.id');
  	    $patientId = (current($patientIds));
  	    $patientInternalIds = Set::extract($patient,'{n}.Patient.internal_id');
  	    $patientInternalId = (current($patientInternalIds));
// 		$testOrders = $this->Common->getTestOrders(array(),array('LaboratoryTestOrder' => array('LaboratoryPatientOrder.patient_id' => $patientIds)),array('LaboratoryTestOrder','Laboratory'/* 'LaboratoryTestOrderPackage' */));
// 		extract($testOrders);
  	    
		if($puserid){//physician user id
			$testOrders = $this->Common->getAllTestOrderPhysician($userid,$puserid);
		}elseif($luserid){//laboratory user id
			$testOrders = $this->Common->getAllTestOrderLaboratory($userid,$luserid);
		}elseif($cuserid){//corporate user id
			//Pending
		}else{//default query patient user id
			$testOrdersWeblis = $this->Common->getAllTestOrders($userid);
			//debug($testOrdersWeblis);
			//$this->log($testOrdersWeblis,'testOrdersWeblis');
			//$testOrdersMumps = $this->__getPHCPatientOrder($patientInternalId);
			//$testOrders = array_merge($testOrdersWeblis,$testOrdersMumps);
			$testOrders = $testOrdersWeblis;
		}
		$testOrders = array_chunk($testOrders, 10);
		$pagecount = count($testOrders);
		
		//debug($page);
// 		debug(count($testOrders));
// 		debug($testOrders);
// 		$this->log($testOrders,'testOrders');
// 		foreach($testOrders as $key=>&$orders){
			foreach($testOrders[$page] as $key=>&$laboratory){
				$lab = $this->Common->getLaboratoryDetails($laboratory['Laboratory']['company_branch_id']);
				$laboratories[$laboratory['Laboratory']['company_branch_id']]=current($lab);
			}
// 		}
			
// 		$this->log($laboratories,'lablogs');
// 		laboratories = $this->Common->getLabDetails();
// 		debug($testOrders);

		/*$LaboratoryTestGroups = Set::combine($testOrderPackages,'/LaboratoryTestGroup/id','/LaboratoryTestGroup/name');
		$testOrderPackages = Set::combine($testOrderPackages,'/LaboratoryTestOrderPackage/id','/LaboratoryTestGroup/name','/LaboratoryTestOrderPackage/test_order_id');*/
		$LaboratoryTestGroups=array();
		$testOrderPackages=array();
//		debug($testOrderPackages);
		return compact('person','patient','testOrders','testOrderPackages','LaboratoryTestGroups','testOrderResults','laboratories','pagecount');
	}
	
    function __downloadPdf(){
            $download = 0;
            if (isset($this->params['data']['action']) && $this->params['data']['action']=="Save") $download=1;
            if(isset($this->data['Person']['body'])){
            $textbody = "".$this->data['Person']['body']."";
            }else if(isset($this->data['Person']['text_body'])){
            $textbody = "".$this->data['Person']['text_body']."";
            }
            $this->__getPdf($textbody,$download);
    }
   function __getPdf($textbody, $download){
            $text="";
            if ($text!="")
                    $text.="<div style='page-break-after:always;'></div>";
            $text.=
            "	<div style='position: absolute; z-index:-100; opacity: 0.05;  background-image: url(img/logo_bry.png); height:  100%; width: 100%'></div>
                <div style='z-index: 100'>
                        $textbody
                </div>
            ";
            require_once(APP. 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
            spl_autoload_register('DOMPDF_autoload');
            $dompdf = new DOMPDF();
            $dompdf->set_paper('a4', 'landscape');
            $dompdf->load_html(utf8_decode($text), Configure::read('App.encoding'));
            $dompdf->render();
            if($download == 1){
                $dompdf->stream("Test_History.pdf", array("Attachment" => 1));
            }else{
                $dompdf->stream("Test_History.pdf", array("Attachment" => 0));
            }
    }

    
    public function patient_viewPdfMro($filename=null){
		$config = Configure::read('mumps');
    	//     	$this->response->file($config['weblis.pdfurl'].DS.$filename);
    	$this->response->header('Location', $config['weblis.pdfurl'].DS.$filename);
    	//     	$this->response->file('webroot/media/pdf'.DS.$filename.'.pdf');
    	//     	$this->response->header('Content-Disposition', 'inline');
    	return $this->response;
    	
    	
    }
    public function viewPdfStream($filename=null){

    	$allowedEpisodes = $this->Session->read('allowedEpisode');
    	ini_set('memory_limit', '512M');
//     	debug($this->Auth->user('id'));
		
    	if(in_array($filename, $allowedEpisodes)  || $this->Auth->user('role') == 20 || $this->Auth->user('role') == 6){
	    	$config = Configure::read('mumps');
	    	
	    	App::uses('HttpSocket', 'Network/Http');
	    	$HttpSocket = new HttpSocket();
	    	$results = $HttpSocket->get(
	    			$config['weblis.pdfurl'].'/'.$filename
	    			/* array(
	    			 'specimen_id' => $filename
	    			) */
	    	);
	    	
	    	// 			debug($results);
	    	// 				$fp = fopen(WWW_ROOT.'media/pdf/'."$specimen_id.pdf", 'w');
	    	// 				fwrite($fp, $results);
	    	// 				fclose($fp);
	    	
	    	$pdflen = strlen($results);
	    	//$this->log($results,'1234');
	    	
	    	//telling the browser about the pdf document
// 	    	header("Content-type: application/pdf");
// 	    	header("Content-length: $pdflen");
// 	    	header("Content-Disposition: inline; filename=$filename.pdf"); 
	    	/* $patientTests = $this->Session->read('patientTests');
	    	$this->addAuditLog('patient.view_order',array(
	    			'specimen_id'=>$filename,//specimen_id
	    			'tests'=>$patientTests['PatientOrder.test'][$filename]
	    	)); */
	    	
	    	$patientTests = $this->Session->read('patientTests');
	    	$patientEpisodesNumber = $this->Session->read('patientEpisodesNumber');
	    	$this->addAuditLog('patient.view_order',array(
// 	    			'patient_mrn'=>$patientEpisodesNumber[$filename],
	    			'patient_mrn'=>str_replace("-", "", $patientEpisodesNumber[$filename]),
	    			'episode_number'=>$filename,//specimen_id
	    			'tests'=>$patientTests['PatientOrder.test'][$filename]
	    	));
	    	
	    	header("Pragma: public");
	    	header("Expires: 0");
	    	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    	header("Cache-Control: public");
// 	    	header("Content-Description: File Transfer");
	    	header("Content-Type: application/pdf");
	    	header("Content-length: $pdflen");
	    	header("Content-Disposition: inline; filename=$filename.pdf");
// 	    	header("Content-Transfer-Encoding: binary");
	    	//output the document
	    	print($results);
    	}else{
//     		print("<html><body><h2>You're not allowed to access this file.</h2></body></html>");
    		$this->render('/Errors/error400', 404);
    	}
    	 
    	 
    }
    public function patient_viewPdf($filename=null){
    	//if($this->RequestHandler->isAjax()){
    		$success = false;
    		$pathurl = "";
	    	$allowedEpisodes = $this->Session->read('allowedEpisode');
	    	ini_set('memory_limit', '512M');
	    	//     	debug($this->Auth->user('id'));
			$this->log($this->Auth->user('role'),'user');
			if(true){
	    	//if(in_array($filename, $allowedEpisodes)  || $this->Auth->user('role') == 20){
				
	    		$config = Configure::read('mumps');
	    
	    		App::uses('HttpSocket', 'Network/Http');
	    		$HttpSocket = new HttpSocket();
	    		$results = $HttpSocket->get(
	    				$config['weblis.pdfurl'].'/'.$filename
	    				/* array(
	    				 'specimen_id' => $filename
	    				) */
	    		);
	    		
	    		$this->log($results,'pdf');
	    		try{
	    			$fp = fopen(WWW_ROOT.'media/pdf/'."$filename.pdf", 'w');
	    			fwrite($fp, $results);
	    			fclose($fp);
	    			$pathurl = 'media/pdf/'."$filename.pdf";
	    			$success = true;
/* 	    			$this->addAuditLog('patient.view_order',array(
	    					'specimen_id'=>$filename,//specimen_id
	    			)); */
	    			$patientTests = $this->Session->read('patientTests');
	    			$patientEpisodesNumber = $this->Session->read('patientEpisodesNumber');
	    			$this->addAuditLog('patient.view_order',array(
	    					'patient_mrn'=>str_replace("-", "", $patientEpisodesNumber[$filename]),
	    					'episode_number'=>$filename,//specimen_id
	    					'tests'=>$patientTests['PatientOrder.test'][$filename]
	    			));
	    		}catch (Exception $e) {
	    			$success = false;
				    $this->log($e->getMessage(),'debug');
				}
	    		
	    		
	    		/* $pdflen = strlen($results);
	    		header('Content-Description: File Transfer');
			    header('Content-Type: application/pdf');
			    header('Content-Disposition: inline; filename='.$filename);
			    header('Content-Transfer-Encoding: binary');
			    header('Accept-Ranges: bytes');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Pragma: public');
			    header('Content-Length: ' . $pdflen); */

	    		    		
// 	    		print($results);
	    		
	    	}else{
	    		$this->render('/Errors/error400', 404);
	    	}
	    	$this->set('data',$pathurl);
	    	$this->header('Content-Type: text/json');
	    	$this->render('/Common/json');
    	//}
    
    
    }
	
	 public function resultviewer_viewPdf(){
    	if($this->RequestHandler->isAjax()){
    		$success = false;
    		$pathurl = "";
			$filename=$this->request->data['Patient']['specimenid'];
	    	$allowedEpisodes = $this->Session->read('allowedEpisode');
			$this->log($allowedEpisodes,'allowedEpisodes');
	    	ini_set('memory_limit', '512M');
	    	//     	debug($this->Auth->user('id'));
			$this->log($this->Auth->user('role'),'user');
	    	if(in_array($filename, $allowedEpisodes)  || $this->Auth->user('role') == 20){
				
	    		$config = Configure::read('mumps');
	    
	    		App::uses('HttpSocket', 'Network/Http');
	    		$HttpSocket = new HttpSocket();
	    		$results = $HttpSocket->get(
	    				$config['weblis.pdfurl'].'/'.$filename
	    				/* array(
	    				 'specimen_id' => $filename
	    				) */
	    		);
	    		try{
	    			$fp = fopen(WWW_ROOT.'media/pdf/'."$filename.pdf", 'w');
	    			fwrite($fp, $results);
	    			fclose($fp);
	    			$pathurl = 'media/pdf/'."$filename.pdf";
	    			$success = true;
/* 	    			$this->addAuditLog('patient.view_order',array(
	    					'specimen_id'=>$filename,//specimen_id
	    			)); */
	    			$patientTests = $this->Session->read('patientTests');
	    			$patientEpisodesNumber = $this->Session->read('patientEpisodesNumber');
	    			$this->addAuditLog('patient.view_order',array(
	    					'patient_mrn'=>str_replace("-", "", $patientEpisodesNumber[$filename]),
	    					'episode_number'=>$filename,//specimen_id
	    					'tests'=>$patientTests['PatientOrder.test'][$filename]
	    			));
	    		}catch (Exception $e) {
	    			$success = false;
				    $this->log($e->getMessage(),'debug');
				}
	    		
	    		
	    		/* $pdflen = strlen($results);
	    		header('Content-Description: File Transfer');
			    header('Content-Type: application/pdf');
			    header('Content-Disposition: inline; filename='.$filename);
			    header('Content-Transfer-Encoding: binary');
			    header('Accept-Ranges: bytes');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Pragma: public');
			    header('Content-Length: ' . $pdflen); */

	    		    		
// 	    		print($results);
	    		
	    	}else{
	    		$this->render('/Errors/error400', 404);
	    	}
	    	$this->set('data',$pathurl);
	    	$this->header('Content-Type: text/json');
	    	$this->render('/Common/json');
    	}
    
    
    }
	
    public function removePdf($filename=null){
    	if($this->RequestHandler->isAjax()){
    			$success = false;
    			ini_set('memory_limit', '512M');
    			
    				$pathurl = WWW_ROOT.'media/pdf/'."$filename.pdf";
					//$this->log($pathurl,'unlink');
    				if(file_exists($pathurl)){
    					unlink($pathurl);
						//$this->log($pathurl,'unlink');
    					$success = true;
    				}
    			
	    		$this->set('data',$success);
	    		$this->header('Content-Type: text/json');
	    		$this->render('/Common/json');
    	}
    
    }
    
    public function laboratory_viewPdf($filename=null){
    	$config = Configure::read('mumps');
    	
    	$this->response->file($config['weblis.pdfurl'].DS.$filename);
    	//     	$this->response->file('webroot/media/pdf'.DS.$filename.'.pdf');
    	$this->response->header('Content-Disposition', 'inline');
    	return $this->response;
    		
    		
    		
    }
    public function corporate_viewPdf($filename=null){
    	$config = Configure::read('mumps');
    	$this->response->file($config['weblis.pdfurl'].DS.$filename);
    	//     	$this->response->file('webroot/media/pdf'.DS.$filename.'.pdf');
    	$this->response->header('Content-Disposition', 'inline');
    	return $this->response;
    
    
    
    }
    public function physician_viewPdf($filename=null){
    	$config = Configure::read('mumps');
    	$this->response->file($config['weblis.pdfurl'].DS.$filename);
    	//     	$this->response->file('webroot/media/pdf'.DS.$filename.'.pdf');
    	$this->response->header('Content-Disposition', 'inline');
    	return $this->response;
    
    
    
    }

    function testOrderDetail(){
		$this->layout = '';
		if(isset($_POST['LaboratoryTestOrderId'])){
			$testOrders = $this->Common->getTestOrders(array($_POST['LaboratoryTestOrderId']),array('LaboratoryTestOrder' => array('LaboratoryTestOrder.status' => 3)),array(/*'LaboratoryTestOrder',*/ 'LaboratoryTestOrderPackage','LaboratoryTestOrderResult','Patient' => array('Person.*','Patient.*')));
//			$this->log($testOrders,'debug');
			extract($testOrders);
			
			
			$patientOrderId = current($testOrders);
			$patientOrderId = $patientOrderId["LaboratoryPatientOrder"]["id"];
			$patientOrders = $this->Common->getPatientOrder($patientOrderId,array(),array(/* 'LaboratoryPatientBatchOrder','LaboratoryPatientBatchPackageOrder', */'Physician'));
			extract($patientOrders);
			
// 			$patientBatchOrderPackages = Set::combine($patientBatchOrderPackages,'{n}.LaboratoryPatientBatchPackageOrder.id','{n}.LaboratoryPatientBatchPackageOrder');
			$physicians = Set::combine($physicians,'{n}.Physician.id','{n}.Physician.users_id');
		
			$technologiesIds = Set::extract($testOrderPackages,'/LaboratoryTestOrderPackage/technologies_user_id');
			$supervisorIds = Set::extract($testOrderPackages,'/LaboratoryTestOrderPackage/supervisor_user_id');
				
			$physicanIds = array_values($physicians);
			$peopleIds = array_merge($technologiesIds, $supervisorIds,$physicanIds);
			$peopleIds = $peopleIds;

			
			$people = $this->Common->getUserDetails($peopleIds,array('Person.firstname','Person.lastname','PersonIdentity.users_id')/*,array('conditions'=>array('PersonIdentity.posted' =>false)*/);
			$testOrderResults = Set::combine($testOrderResults,'/LaboratoryTestOrderResult/id','/LaboratoryTestOrderResult/../.','/LaboratoryTestOrderResult/test_order_package_id');
			$this->loadModel('TitleCode');
			$title = $this->TitleCode->find('list');
			if($this->RequestHandler->isAjax()){
				$this->set('data',compact(/*'testOrders',*/'testOrderResults','testOrderPackages','patients','physicians','people','patientBatchOrderPackages','title'));
				$this->header('Content-Type: text/json');
				$this->render('/Common/json');
			}
		}
	}
	
	function testHistory(){
		$this->layout = '';
		$print = 0;
		if (isset($this->data['action']) && $this->data['action']=="Print") {$print=1;}
//		debug($this->data);
		
		if(isset($_POST['LaboratoryTestGroupId'])){
			$userid = $this->Auth->user('id');
			$userids = array($userid);
			$options = array();
			if(isset($_POST['Person']['id'])){
				$userids = array();
				$options = array('conditions' => array('Person.id'=>$_POST['Person']['id']),'group'=>array('Person.id'));
			}
			$this->Patient->unbindAllModel(array(),false);
			$person = $this->Common->getUserDetails($userids,array('Person.*','Image'),$options);
			
			$person = array_shift($person);
			
			$personIds = array();
	
			if(isset($person['id']))
				$personIds[] = $person['id'];
			if(isset($person['LaboratoryProfile']) && !empty($person['LaboratoryProfile']))
				$personIds = array_merge($personIds,Set::extract($person['LaboratoryProfile'],'{n}.id'));
		
			$this->Patient->unbindAllModel(array(),false);
			$patient = $this->Patient->find('all',array(
				'conditions' => array('person_id'=>$personIds)
			));
			$patientIds = Set::extract($patient,'{n}.Patient.id');
			
			$LaboratoryTestGroupId = $_POST['LaboratoryTestGroupId'];
			$testOrders = $this->Common->getTestOrders(array(),array('LaboratoryTestOrderPackage' => array('LaboratoryTestGroup.id' => $LaboratoryTestGroupId,'LaboratoryPatientOrder.patient_id' =>$patientIds )),array('LaboratoryTestOrder','LaboratoryTestOrderPackage','LaboratoryTestOrderResult' => array('LaboratoryTest.standard_test_id'),'Laboratory'),
				array('LaboratoryTestOrderPackage'=>array(
					array(
						'table' => 'laboratory_test_orders',
						'alias' => 'LaboratoryTestOrder',
						'type' => 'LEFT',
						'conditions' => array(
							'LaboratoryTestOrder.id = LaboratoryTestOrderPackage.test_order_id'
						)
					),
					array(
						'table' => 'laboratory_patient_orders',
						'alias' => 'LaboratoryPatientOrder',
						'type' => 'LEFT',
						'conditions' => array(
							'LaboratoryTestOrder.id = LaboratoryPatientOrder.id'
						)
					)
				)));
			extract($testOrders);
			$testOrderPackages = Set::combine($testOrderPackages,'/LaboratoryTestOrderPackage/id','/LaboratoryTestOrderPackage/../.','/LaboratoryTestOrderPackage/test_order_id');
			
			$standardTestIds = array();
			$standardTestIds = Set::extract($testOrderResults,'/LaboratoryTest/standard_test_id');
			$testOrderResults = Set::combine($testOrderResults,'/LaboratoryTestOrderResult/test_id','/LaboratoryTestOrderResult/../.','/LaboratoryTestOrderResult/test_order_package_id');
			
			$this->loadModel('LaboratoryStandardTest');
			$standardTests = $this->LaboratoryStandardTest->find('list',array(
				'fields' => array('id','name'),
				'conditions' => array(
					'id' => $standardTestIds
				)
			));
			
			
			$tests = array();
			foreach($testOrderResults as $packages){
				foreach($packages as $key => $result){
					$tests[$result['LaboratoryTest']['id']] = isset($standardTests[$result['LaboratoryTest']['standard_test_id']])?$standardTests[$result['LaboratoryTest']['standard_test_id']]:$result['LaboratoryTest']['name'];
				}
			}
			asort($tests);
			$tabular = array();
			$graph = array();
			$testKeys = array_flip(array_keys($tests));
			$max = 0;
			foreach($testOrders as $key => $testOrder){
				$tabular[$key] = array(
					0/*'lab'*/ => $laboratories[$testOrder['LaboratoryPatientOrder']['laboratory_id']],
					1/*'date'*/ => date('M d,Y g:i A ',strtotime($testOrder['LaboratoryTestOrder']['posted_datetime']))
				);
				$testPackageId = current(array_keys($testOrderPackages[$testOrder['LaboratoryTestOrder']['id']]));
				foreach($tests as $testId => $testName){
					$tabular[$key][]/*[$testId]*/ = isset($testOrderResults[$testPackageId][$testId])?(int)$testOrderResults[$testPackageId][$testId]['LaboratoryTestOrderResult']['si_value']:'';
					if(end($tabular[$key]) > $max)
						$max = end($tabular[$key]);
					$graph[$testKeys[$testId]][$key][0] = $tabular[$key][1];
					$graph[$testKeys[$testId]][$key][1] = strlen(end($tabular[$key]))?end($tabular[$key]):0;
				}
			}
			//$this->set(compact('tabular','graph','tests','laboratories','max','LaboratoryTestGroupId','patientId'));
			if($this->RequestHandler->isAjax()){
				$this->set('data',compact('tabular','graph','tests','laboratories','max','LaboratoryTestGroupId','patientId'));
		    	$this->header('Content-Type:text/json');
				$this->render('/Common/json');
			}
		}
		if($print == 1){
			$this->layout=false;
			$this->render('test_history_print');
			return;
			$this->set('data',compact('tabular','graph','tests','laboratories','max','LaboratoryTestGroupId','patientId'));
			
		}
	}

	function updateProfile(){
		$result = true;
		$userid = $this->Auth->user('id');
		$result = true;
		$this->Person->begin();
		$currentdate = date('y-m-d H:i:s');
		
		if($this->Person->save($this->request->data['Person'])){
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
				
				unset($this->request->data['Person']['new_image']);

				
			}
			
			if(isset($this->request->data['Person']['upload']['tmp_name']) && strlen($this->request->data['Person']['upload']['tmp_name'])){
			
				$filename = String::uuid().'.'.end(explode('.', $this->request->data['Person']['upload']['name']));
				if(move_uploaded_file($this->request->data['Person']['upload']['tmp_name'], WWW_ROOT."/media/profiles/".$filename)) {
					$newimage = true;
				}else{
					$result = false;
				}

				unset($this->request->data['Person']['upload']);
			
			}
			if($newimage){
				if(strlen($this->data['Person']['image']) && file_exists(WWW_ROOT."/media/profiles/".$this->data['Person']['image'])){
					unlink(WWW_ROOT."/media/profiles/".$this->data['Person']['image']);
				}
				
				/*
				if(!$this->Person->saveField('image' , $filename)){
					$result = false;
				}else{
					$this->request->data['Person']['image'] = $filename;
				}
				*/
				
				
				
				$image = array(
					'id' => $this->request->data['Person']['image_id'],
					'entry_datetime' => $currentdate,
					'user_id' => $userid,
					'image' => $filename
				);
				
				if($this->Person->PersonImage->Image->save($image)){
					$personImage = array(
						'id' => $this->request->data['Person']['person_image_id'],
						'entry_datetime' => $currentdate,
						'person_id' => $this->Person->id,
						'image_id' => $this->Person->PersonImage->Image->id,
						'user_id' => $userid,
						'status' => true
					);
					if(!$this->Person->PersonImage->save($personImage))
						$result = false;
				}else
					$result = false;
				
			}
			
			
			if(isset($this->request->data['Person']['CompleteAddress']['Address'])){
				
				$this->request->data['Person']['CompleteAddress']['Address']['street_number'] = ($this->request->data['Person']['CompleteAddress']['Address']['street_number']=='This is required if no lot and block')?"":$this->request->data['Person']['CompleteAddress']['Address']['street_number'];
				$this->request->data['Person']['CompleteAddress']['Address']['lot'] = ($this->request->data['Person']['CompleteAddress']['Address']['lot']=='This is required if no street')?"":$this->request->data['Person']['CompleteAddress']['Address']['lot'];
				$this->request->data['Person']['CompleteAddress']['Address']['block'] = ($this->request->data['Person']['CompleteAddress']['Address']['block']=='This is required if no street')?"":$this->request->data['Person']['CompleteAddress']['Address']['block'];
				$address = $this->request->data['Person']['CompleteAddress']['Address'];
				if(isset($this->request->data['Person']['CompleteAddress']['ProvincesStatesCode']['id']))
					$address['province_state_id'] = $this->request->data['Person']['CompleteAddress']['ProvincesStatesCode']['id'];
				if(isset($this->request->data['Person']['CompleteAddress']['TownCityCode']['id']))
					$address['town_city_id'] = $this->request->data['Person']['CompleteAddress']['TownCityCode']['id'];
				if(isset($this->request->data['Person']['CompleteAddress']['VillageCode']['id']))
					$address['village_id'] = $this->request->data['Person']['CompleteAddress']['VillageCode']['id'];
				
				if(!$this->Person->PersonAddress->Address->save($address)){
					$result = false;
				}
				
				if(isset($this->request->data['Person']['CompleteAddress']['Address']['person_address_id']) && strlen($this->request->data['Person']['CompleteAddress']['Address']['person_address_id']) == 0){
					$personAddress = array(
						'person_id' => $this->Person->id,
						'address_id' => $this->Person->PersonAddress->Address->id
					);
					
					if(!$this->Person->PersonAddress->save($personAddress)){
						$result = false;
					}
				
				}
			}
			//Saving Contact Information

			if(isset($this->request->data['ContactInformation'])){
				$personContacts = $this->Person->PersonContactInformation->find('all',array(
					'fields' => array('id','contact_id'),
					'conditions' => array(
						'person_id' => $this->request->data['Person']['id']
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
									'person_id' => $this->request->data['Person']['id'],
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
		}else{
			$result = false;
		}
		if($result){
			$this->Person->commit();
			if($this->Session->check('Auth.Person'))
				$this->Session->delete('Auth.Person');
			$this->Session->write('Auth.Person',$this->request->data['Person']);
		} else
			$this->Person->rollback();
			
		if($this->RequestHandler->isAjax()){
			$this->layout = '';
			$this->set('data',array('response'=>array('result' => (string)$result)));
	    	$this->header('Content-Type:text/xml');
			$this->render('/Common/xml');
		}
		
	}
	
	
	
	function getPhysicianPatients(){
		$this->loadModel('Physician');
		
		$physicians = $this->Physician->find('list',array(
				'conditions' => array(
						'Physician.users_id' => $this->Auth->user('id')
				)
		));
		$physicianids=array();
		foreach ($physicians as $physician){
			$physicianids[]=$physician;
		}
		$data = array('Patient' => array());
		if($physicians){
			$address = false;
			$laboratory = false;
// 			$physicianId = $physician['Physician']['id'];
			$conditions = array('LaboratoryPatientOrderPhysician.physician_id' => $physicianids);
			$fields = array(
					'Person.id',
					'Person.firstname',
					'Person.lastname',
					'Person.middlename',
					'Patient.registered_date',
					'Patient.registered_time',
					'Patient.internal_id',
					'Person.birthdate',
					//				'Person.age',
					'Person.sex',
			);
			$joins = array(
					array(
							'table' => 'laboratory_patient_orders',
							'alias' => 'LaboratoryPatientOrder',
							'type' => 'LEFT',
							'conditions' => array(
									'LaboratoryPatientOrder.id = LaboratoryPatientOrderPhysician.patient_order_id'
							)
					),
					array(
							'table' => 'patients',
							'alias' => 'Patient',
							'type' => 'LEFT',
							'conditions' => array(
									'Patient.id = LaboratoryPatientOrder.patient_id'
							)
					),
					array(
							'table' => 'people',
							'alias' => 'Person',
							'type' => 'RIGHT',
							'conditions' => array(
									'Person.id = Patient.person_id'
							)
					)
			);
				
			if($this->RequestHandler->isAjax()){
				if(isset($_POST['data']['Patient']['start_date']) && strlen($_POST['data']['Patient']['start_date']) && isset($_POST['data']['Patient']['end_date']) && strlen($_POST['data']['Patient']['end_date']) )
					$conditions['Patient.registered_date BETWEEN ? AND ?'] = array($_POST['data']['Patient']['start_date'],$_POST['data']['Patient']['end_date']);
				if(isset($_POST['data']['Patient']['age']) && strlen($_POST['data']['Patient']['age']))
					$conditions['Person.age'] = $_POST['data']['Patient']['age'];
				if(isset($_POST['data']['Patient']['sex']) && strlen($_POST['data']['Patient']['sex']))
					$conditions['Person.sex'] = $_POST['data']['Patient']['sex'];
				if(isset($_POST['data']['Patient']['province_state_id']) && strlen($_POST['data']['Patient']['province_state_id']))
					$conditions['Address.province_state_id'] = $_POST['data']['Patient']['province_state_id'];
				if(isset($_POST['data']['Patient']['town_city_id']) && strlen($_POST['data']['Patient']['town_city_id']))
					$conditions['Address.town_city_id'] = $_POST['data']['Patient']['town_city_id'];
				if(isset($_POST['data']['Patient']['village_id']) && strlen($_POST['data']['Patient']['village_id']))
					$conditions['Address.village_id'] = $_POST['data']['Patient']['village_id'];
				if(isset($_POST['data']['Patient']['myresultonline_id']) && strlen($_POST['data']['Patient']['myresultonline_id']))
					$conditions['Person.myresultonline_id'] = $_POST['data']['Patient']['myresultonline_id'];
				if(isset($_POST['data']['Patient']['firstname']) && strlen($_POST['data']['Patient']['firstname']))
					$conditions['Person.firstname LIKE'] = '%'.$_POST['data']['Patient']['firstname'].'%';
				if(isset($_POST['data']['Patient']['lastname']) && strlen($_POST['data']['Patient']['lastname']))
					$conditions['Person.lastname LIKE'] = '%'.$_POST['data']['Patient']['lastname'].'%';
				if(isset($_POST['data']['Field']['laboratory'])){
					$laboratory = true;
// 					$fields = array_merge($fields,array(/*'Laboratory.name',*/'LaboratoryPatientBatchOrder.confirmed_date','LaboratoryPatientBatchOrder.confirmed_time'));
					//					$joins[] = array(
					//						'table' => 'laboratories',
					//						'alias' => 'Laboratory',
					//						'type' => 'LEFT',
					//						'conditions' => array(
					//							'LaboratoryPatientOrder.laboratory_id = Laboratory.id'
					//						)
					//					);
				}
		
				if(isset($_POST['data']['Field']['address'])){
					$address = true;
					$fields = array_merge($fields,array('Address.province_state_id','Address.town_city_id'));
					$joins[] = array(
							'table' => 'person_addresses',
							'alias' => 'PersonAddress',
							'type' => 'LEFT',
							'conditions' => array(
									'PersonAddress.person_id = Person.id'
							)
					);
					$joins[] = array(
							'table' => 'addresses',
							'alias' => 'Address',
							'type' => 'LEFT',
							'conditions' => array(
									'Address.id = PersonAddress.address_id'
							)
					);
				}
			}
				
			$fields = array_merge($fields,array(/*'Laboratory.name','LaboratoryPatientBatchOrder.confirmed_date','LaboratoryPatientBatchOrder.confirmed_time',*/'LaboratoryPatientOrder.laboratory_id'));
				
			$this->loadModel('LaboratoryPatientOrderPhysician');
			$this->LaboratoryPatientOrderPhysician->unbindAllModel();
			$results = $this->LaboratoryPatientOrderPhysician->find('all',array(
					'conditions' => $conditions,
					'fields' => $fields,
					'order' => array('LaboratoryPatientOrder.entry_datetime DESC'),
					'group' => array('LaboratoryPatientOrder.patient_id'),
					'joins' => $joins
			));
			
			$this->Laboratory->unbindAllModel(array('CompanyBranch'));
				
			$laboratories = $this->Laboratory->find('all',array(
					'conditions'=> array(
							'Laboratory.id' => Set::extract($results,'{n}.LaboratoryPatientOrder.laboratory_id')
					)
			));
			$laboratories = Set::combine($laboratories,'{n}.Laboratory.id','{n}.CompanyBranch.name');
			foreach($results as &$result){
				$result['Laboratory']['name'] = $laboratories[$result['LaboratoryPatientOrder']['laboratory_id']];
			}
			$data['Patient'] = $results;
				
			if($address){
		
				$provinceStateIds = Set::extract($results,'{n}.Address.province_state_id');
				$townCityIds = Set::extract($results,'{n}.Address.province_state_id');
				$this->loadModel('ProvincesStatesCode');
				$this->ProvincesStatesCode->unbindAllModel();
				$provinces = $this->ProvincesStatesCode->find('list',array(
						'fields' => array('id','name'),
						'conditions' => array(
								'id' => $provinceStateIds
						)
				));
		
				$this->loadModel('TownCityCode');
				$this->TownCityCode->unbindAllModel();
				$townCities = $this->TownCityCode->find('list',array(
						'fields' => array('id','name'),
						'conditions' => array(
								'id' => $townCityIds
						)
				));
		
				$data['Address'] = array(
						'Province' => $provinces,
						'TownCity' => $townCities
				);
			}
			if($laboratory){
		
			}
		}
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
		
	}
	
	function getLaboratoryPatients(){

// 		$this->loadModel('Physician');
		
// 		$physicians = $this->Physician->find('list',array(
// 				'conditions' => array(
// 						'Physician.users_id' => $this->Auth->user('id')
// 				)
// 		));
// 		$physicianids=array();
// 		foreach ($physicians as $physician){
// 			$physicianids[]=$physician;
// 		}
		$this->loadModel('PersonIdentity');

		$personIdentity = $this->PersonIdentity->find('first',array(
				'conditions' => array(
						'PersonIdentity.users_id' => $this->Auth->user('id')
				),
				'recursive'=>-1
		));
		$laboratory_id = $personIdentity['PersonIdentity']['laboratory_id'];
		$data = array('Patient' => array());
		if($personIdentity){
			$address = false;
			$laboratory = false;
			// 			$physicianId = $physician['Physician']['id'];
			$conditions = array('Patient.laboratory_id' => $laboratory_id);
			$fields = array(
					'Person.id',
					'Person.firstname',
					'Person.lastname',
					'Person.middlename',
					'Patient.registered_date',
					'Patient.registered_time',
					'Patient.internal_id',
					'Person.birthdate',
					//				'Person.age',
					'Person.sex',
			);
			$joins = array(
					array(
							'table' => 'laboratory_patient_orders',
							'alias' => 'LaboratoryPatientOrder',
							'type' => 'LEFT',
							'conditions' => array(
									'LaboratoryPatientOrder.patient_id = Patient.id'
							)
					),
					array(
							'table' => 'people',
							'alias' => 'Person',
							'type' => 'RIGHT',
							'conditions' => array(
									'Person.id = Patient.person_id'
							)
					)
			);
		
			if($this->RequestHandler->isAjax()){
				if(isset($_POST['data']['Patient']['start_date']) && strlen($_POST['data']['Patient']['start_date']) && isset($_POST['data']['Patient']['end_date']) && strlen($_POST['data']['Patient']['end_date']) )
					$conditions['Patient.registered_date BETWEEN ? AND ?'] = array($_POST['data']['Patient']['start_date'],$_POST['data']['Patient']['end_date']);
				if(isset($_POST['data']['Patient']['age']) && strlen($_POST['data']['Patient']['age']))
					$conditions['Person.age'] = $_POST['data']['Patient']['age'];
				if(isset($_POST['data']['Patient']['sex']) && strlen($_POST['data']['Patient']['sex']))
					$conditions['Person.sex'] = $_POST['data']['Patient']['sex'];
				if(isset($_POST['data']['Patient']['province_state_id']) && strlen($_POST['data']['Patient']['province_state_id']))
					$conditions['Address.province_state_id'] = $_POST['data']['Patient']['province_state_id'];
				if(isset($_POST['data']['Patient']['town_city_id']) && strlen($_POST['data']['Patient']['town_city_id']))
					$conditions['Address.town_city_id'] = $_POST['data']['Patient']['town_city_id'];
				if(isset($_POST['data']['Patient']['village_id']) && strlen($_POST['data']['Patient']['village_id']))
					$conditions['Address.village_id'] = $_POST['data']['Patient']['village_id'];
				if(isset($_POST['data']['Patient']['myresultonline_id']) && strlen($_POST['data']['Patient']['myresultonline_id']))
					$conditions['Person.myresultonline_id'] = $_POST['data']['Patient']['myresultonline_id'];
				if(isset($_POST['data']['Patient']['firstname']) && strlen($_POST['data']['Patient']['firstname']))
					$conditions['Person.firstname LIKE'] = '%'.$_POST['data']['Patient']['firstname'].'%';
				if(isset($_POST['data']['Patient']['lastname']) && strlen($_POST['data']['Patient']['lastname']))
					$conditions['Person.lastname LIKE'] = '%'.$_POST['data']['Patient']['lastname'].'%';
				if(isset($_POST['data']['Field']['laboratory'])){
					$laboratory = true;
					// 					$fields = array_merge($fields,array(/*'Laboratory.name',*/'LaboratoryPatientBatchOrder.confirmed_date','LaboratoryPatientBatchOrder.confirmed_time'));
					//					$joins[] = array(
					//						'table' => 'laboratories',
					//						'alias' => 'Laboratory',
					//						'type' => 'LEFT',
					//						'conditions' => array(
					//							'LaboratoryPatientOrder.laboratory_id = Laboratory.id'
					//						)
					//					);
				}
		
				if(isset($_POST['data']['Field']['address'])){
					$address = true;
					$fields = array_merge($fields,array('Address.province_state_id','Address.town_city_id'));
					$joins[] = array(
							'table' => 'person_addresses',
							'alias' => 'PersonAddress',
							'type' => 'LEFT',
							'conditions' => array(
									'PersonAddress.person_id = Person.id'
							)
					);
					$joins[] = array(
							'table' => 'addresses',
							'alias' => 'Address',
							'type' => 'LEFT',
							'conditions' => array(
									'Address.id = PersonAddress.address_id'
							)
					);
				}
			}
		
			$fields = array_merge($fields,array(/*'Laboratory.name','LaboratoryPatientBatchOrder.confirmed_date','LaboratoryPatientBatchOrder.confirmed_time',*/'LaboratoryPatientOrder.laboratory_id'));
		
			$this->loadModel('Patient');
			$this->Patient->unbindAllModel();
			$results = $this->Patient->find('all',array(
					'conditions' => $conditions,
					'fields' => $fields,
					'order' => array('LaboratoryPatientOrder.entry_datetime DESC'),
					'group' => array('LaboratoryPatientOrder.patient_id'),
					'joins' => $joins
			));
				
			$this->Laboratory->unbindAllModel(array('CompanyBranch'));
		
			$laboratories = $this->Laboratory->find('all',array(
					'conditions'=> array(
							'Laboratory.id' => Set::extract($results,'{n}.LaboratoryPatientOrder.laboratory_id')
					)
			));
			//$this->log($results,'result');
			
			$laboratories = Set::combine($laboratories,'{n}.Laboratory.id','{n}.CompanyBranch.name');
			foreach($results as &$result){
				$result['Laboratory']['name'] = $laboratories[$result['LaboratoryPatientOrder']['laboratory_id']];
			}
			$data['Patient'] = $results;
		
			if($address){
		
				$provinceStateIds = Set::extract($results,'{n}.Address.province_state_id');
				$townCityIds = Set::extract($results,'{n}.Address.province_state_id');
				$this->loadModel('ProvincesStatesCode');
				$this->ProvincesStatesCode->unbindAllModel();
				$provinces = $this->ProvincesStatesCode->find('list',array(
						'fields' => array('id','name'),
						'conditions' => array(
								'id' => $provinceStateIds
						)
				));
		
				$this->loadModel('TownCityCode');
				$this->TownCityCode->unbindAllModel();
				$townCities = $this->TownCityCode->find('list',array(
						'fields' => array('id','name'),
						'conditions' => array(
								'id' => $townCityIds
						)
				));
		
				$data['Address'] = array(
						'Province' => $provinces,
						'TownCity' => $townCities
				);
			}
			if($laboratory){
		
			}
		}
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
		
		
	}
	function getPatientOrderPHC(){
		$patientid = $this->request->data['Person']['id'];
		$data = array();
		$data['testOrders'] = $this->__getPHCPatientOrder($patientid);
		
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
		
		
	}
	
	function getPatientOrder(){
		$patientid = $this->request->data['Person']['id'];
		// $this->log($patientid,'testOrders');
		
		$this->loadModel('Person');
		$person = $this->Person->find('first',array(
				'conditions'=>array('Person.id'=>$patientid),
				'recursive'=>-1
		));
		//$this->log($person,'testOrders');
		
		$this->loadModel('User');
		$user = $this->User->find('first',array(
				'conditions'=>array('User.username'=>$person['Person']['myresultonline_id']),
				'recursive'=>-1
		));
		$this->loadModel('Patient');
		//$this->log($user,'patientid');
		/* $patient = $this->Patient->find('first',array(
				'conditions'=>array('Patient.internal_id'=>$patientid)
		));
		$luserid=$patient['Patient']['laboratory_id']; */
		$luserid = "";$puserid="";
		if($this->Auth->user('role') == 3 ){
			$luserid = $this->Auth->user('id');
		}elseif($this->Auth->user('role') == 6){
			$puserid=$this->Auth->user('id');
		}else{
			
		}
 		$userid=$user['User']['id'];
		
		//$this->log($userid,'testOrders');
		//$this->log($puserid,'testOrders');
		$data = array();
		
		if($puserid){//physician user id
			$testOrders = $this->Common->getAllTestOrderPhysician($userid,$puserid);
			//$this->log($testOrders,'testOrders');
		}elseif($luserid){//laboratory user id
			$testOrders = $this->Common->getAllTestOrderLaboratory($userid,$luserid);
		}elseif($cuserid){//corporate user id
			//Pending
		}else{//default query patient user id
			$testOrdersWeblis = $this->Common->getAllTestOrders($userid);
			//debug($testOrdersWeblis);
			//$this->log($testOrdersWeblis,'testOrdersWeblis');
			//$testOrdersMumps = $this->__getPHCPatientOrder($patientInternalId);
			//$testOrders = array_merge($testOrdersWeblis,$testOrdersMumps);
			$testOrders = $testOrdersWeblis;
		}
		
		$this->loadModel('LaboratoryTestGroup');
		//$this->log($testOrders,'testOrders');
		$testOrderstmp = array();
		foreach ($testOrders as $key=>&$value){
			$testgroup = $this->LaboratoryTestGroup->find('first',array(
					'conditions'=>array('LaboratoryTestGroup.id'=>$value['LaboratoryTestResult']['test_group_id']),
					'recursive'=>-1
			));
			$testOrderstmp[$key] = $value;
			//$this->log($value['LaboratoryTestResult']['test_group_id'],'testgroup');
			$testOrderstmp[$key]['LaboratoryPatientOrder']['description'] = $testgroup['LaboratoryTestGroup']['name'];
			
		}
		
		$this->log($testOrderstmp,'testgroup');
		
		$data['testOrders'] = $testOrderstmp;
		$this->log($data['testOrders'],'testOrders');
		foreach ($data['testOrders'] as $tokey => &$tovalue) {
			$tovalue['LaboratoryTestResult']['release_date'] = date('M d,Y ', strtotime($tovalue['LaboratoryTestResult']['release_date']));
			$tovalue['LaboratoryTestResult']['release_time'] = date('g:i a', strtotime($tovalue['LaboratoryTestResult']['release_time']));
		}
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
	}
	
	function searchPatient(){
		/*ini_set("max_input_time",0);
		set_time_limit(0);
		ini_set("memory_limit","1000M");*/
		$name = $this->request->data['Patient']['lastname'];
		$mrno = str_replace("-", "", $this->request->data['Patient']['mrno']);
		$data = array();
		if(!empty($name)){
			for($i=1;$i<1000;$i=$i+50){
				$this->Session->delete("PaperAll".$i);
				$this->Session->delete("LastPaperId");
			}
			$start = 1;
			$limit = 50;
			$lastpaperid = "";
			$patientcount = $this->__getPHCCountPatientByName($name);
			$data['Count'] = round((int)$patientcount['Total']);
			$data['Start'] = $start;
			$data['Patient'] = $this->__getPHCPatientByName($name,$start,$limit,$lastpaperid);
			$lastarray = end($data['Patient']['PaperAll']);
			//$current = current($data['Patient']['PaperAll']);
			$data['LastPaperId'] = (int)$lastarray['Person']['internal_id'];
			//$data['CurrentPaperId'] = (int)$current['Person']['internal_id'];
			$this->Session->write("PaperAll".$start, $data['LastPaperId']);
// 			$this->log($lastarray,'lastarray');
		}else if(!empty($mrno)){
			$data['Patient'] = $this->__getPHCPatientUser($mrno);
			unset($data['Patient']['PaperAll'][0]['Person']['password']);
			unset($data['Patient']['PaperAll'][0]['Person']['confirm_password']);
			//$this->log($data['Patient'],'patientsearch');
		}
		
		if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
	
	
	}
	
	function searchPatientByName(){
		/*ini_set("max_input_time",0);
		set_time_limit(0);
		ini_set("memory_limit","1000M");*/
		
		$this->log($this->request->data['Patient'],'parameter');
		$name = $this->request->data['Patient']['lastname'];
		$start = (int)$this->request->data['Patient']['start'];
		$limit = 50;
		$action = $this->request->data['Patient']['action'];
		if($action == "prev"){
			if($start == 1){
				$lastpaperid = "";
				$patientcount = $this->__getPHCCountPatientByName($name);
				$data['Count'] = round((int)$patientcount['Total']);
				$data['Start'] = $start;
				$data['Patient'] = $this->__getPHCPatientByName($name,$start,$limit,$lastpaperid);
				$lastarray = end($data['Patient']['PaperAll']);
				//$current = current($data['Patient']['PaperAll']);
				$data['LastPaperId'] = (int)$lastarray['Person']['internal_id'];
				//$data['CurrentPaperId'] = (int)$current['Person']['internal_id'];
				$this->Session->write("PaperAll".$start, $data['LastPaperId']);
			}else{
				$starttmp = $start;
				$starttmp2 = $start - 50;
				$lastpaperid = $this->Session->read("PaperAll".$starttmp2);
				$sesslastpaperid = $this->Session->read("LastPaperId");
				if($lastpaperid == $sesslastpaperid){
					$starttmp = $starttmp-50;
					$lastpaperid = $this->Session->read("PaperAll".$starttmp);
					
				}
				$data['StartTMP'] = $starttmp;
				$data['sesslastpaperid'] = $sesslastpaperid;
				$data['lastpaperid'] = $lastpaperid;
				
				$data['PrevSession'] = $this->Session->read("PaperAll".$starttmp);
				
				$patientcount = $this->__getPHCCountPatientByName($name);
				$data['Patient'] = $this->__getPHCPatientByName($name,$start,$limit,$lastpaperid);
				$lastarray = end($data['Patient']['PaperAll']);
				$data['LastPaperId'] = (int)$lastarray['Person']['internal_id'];

				$data['Count'] = round((int)$patientcount['Total']);
				$data['Action'] = $action;
				$sessionid = $this->Session->read("PaperAll".$start);

				$this->Session->write("PaperAll".$start, $data['LastPaperId']);

			
				$data['Start'] = (int)$start;
			}
		}else{
			$lastpaperid = $this->request->data['Patient']['lastpaperid'];
			
			$patientcount = $this->__getPHCCountPatientByName($name);
			$data['Patient'] = $this->__getPHCPatientByName($name,$start,$limit,$lastpaperid);
			$lastarray = end($data['Patient']['PaperAll']);
			
			$data['LastPaperId'] = (int)$lastarray['Person']['internal_id'];
			
			$data['Count'] = round((int)$patientcount['Total']);
			$data['Action'] = $action;
			//$sessionid = $this->Session->read("PaperAll".$start);

			$this->Session->write("PaperAll".$start, $data['LastPaperId']);
			$this->Session->write("LastPaperId", $data['LastPaperId']);			
			$data['Start'] = (int)$start;

		}
		
// 		return $data;
		  if($this->RequestHandler->isAjax()){
			$this->set('data',$data);
			$this->header('Content-Type:text/json');
			$this->render('/Common/json');
		}
	
	
	}
	function __getPHCPatientUser($mrno){
	
		/* Get Patient User from WeblisGW
		 *
		*
		*/
		// 		$this->log($mrno,'patientid');
		$config = Configure::read('mumps');
		$this->HeartCenterService = $this->Components->load('HCWService');
		if($this->HeartCenterService->connect()){
			$data = array();
			$tmppatient = array();
			$tmppatient = $this->HeartCenterService->getPatientByMRNo($mrno);
			//$this->log($tmppatient,'debug');
			if(isset($tmppatient['Patients']['PaperAll']) && !empty($tmppatient['Patients']['PaperAll'])){
				$data['PaperAll']['0']['Person']['membership_type']=9;
				$data['PaperAll']['0']['Person']['username']=$mrno;
				$data['PaperAll']['0']['Person']['mrno']=$mrno;
				$data['PaperAll']['0']['Person']['confirm_username']=$mrno;
				$data['PaperAll']['0']['Person']['password']=str_replace(' ','',strtoupper($tmppatient['Patients']['PaperAll']['last_name']));
				$data['PaperAll']['0']['Person']['confirm_password']=str_replace(' ','',strtoupper($tmppatient['Patients']['PaperAll']['last_name']));
				
				$data['PaperAll']['0']['Person']['lastname']=$tmppatient['Patients']['PaperAll']['last_name'];
				$data['PaperAll']['0']['Person']['firstname']=$tmppatient['Patients']['PaperAll']['first_name'];
				$data['PaperAll']['0']['Person']['middlename']=$tmppatient['Patients']['PaperAll']['middle_name'];
				$data['PaperAll']['0']['Person']['birthdate']=date('Y-m-d',strtotime($tmppatient['Patients']['PaperAll']['birthdate']));
				
				$data['PaperAll']['0']['Person']['internal_id']=$tmppatient['Patients']['PaperAll']['id'];
				$data['PaperAll']['0']['Person']['laboratory_id']=$config['online.laboratory_id'];
				return $data;
			}
			return false;
		}else{
			return false;
		}
	
	
	
	}
	function __getPHCPatientOrder($patientid){
	
		/* Get Patient User from WeblisGW
		 *
		*
		*/
		$config = Configure::read('mumps');
// 		$this->log($patientid,'patientid');
		$this->HeartCenterService = $this->Components->load('HCWService');
		if($this->HeartCenterService->connect()){
			$data = array();
			$tmppatientorder = array();
			$tmppatientorder = $this->HeartCenterService->getPatientLaboratoryOrders($patientid);
			$sessionepisode = array();
			if(isset($tmppatientorder['Orders']['Order'])){
			//Parse Data
	 			foreach ($tmppatientorder['Orders']['Order'] as $key=>&$order){
	 				
	 				if(isset($order['released_datetime']) && !empty($order['released_datetime'])){
					//Patient
					$data[$order['labepisodenumber']][$key]['Patient']=$tmppatientorder['Orders']['Patient'];
					$data[$order['labepisodenumber']][$key]['Patient']['internal_id']=$tmppatientorder['Orders']['Patient']['id'];
					
					
					//Laboratory
					$data[$order['labepisodenumber']][$key]['Laboratory']['id']=$config['online.laboratory_id'];
					$data[$order['labepisodenumber']][$key]['Laboratory']['company_branch_id']=$config['online.companybranch_id'];
					
					//LaboratoryPatientOrder
					$data[$order['labepisodenumber']][$key]['LaboratoryPatientOrder']=array(
						'specimen_id'=>$order['labepisodenumber'],
						'patient_mrn'=>$order['prn'],
						'laboratory_id'=>$config['online.laboratory_id'],
						'mumps'=>true,
						'description'=>$order['description'],
							
						
					);
					//LaboratoryPatientOrderPhysician
					
					//LaboratoryTestOrder
					$data[$order['labepisodenumber']][$key]['LaboratoryTestOrder']=array('posted_datetime'=>(isset($order['released_datetime']))?$order['released_datetime']:'');
					
					//LaboratoryTestResult
	// 				$data[$order['labepisodenumber']][$key]['LaboratoryTestResult']=array('description'=>$order['description']);
	 				
						$sessionepisode[$order['labepisodenumber']]=$order['labepisodenumber'];
	 				}
	 				
	 				$this->Session->write('allowedEpisode',$sessionepisode);
	 			} 
			}
			$tmpdata=array();
			$specimenids=array();
			$patientTests=array();
			$patientEpisodesNumber=array();
			foreach($data as $key=>&$value){
				$tmptests="";
				$testlist=array();
				foreach ($value as $testkey=>&$test){
					if(!isset($testlist[$test['LaboratoryPatientOrder']['description']]) && empty($testlist[$test['LaboratoryPatientOrder']['description']]) ){
						$testlist[$test['LaboratoryPatientOrder']['description']]=$test['LaboratoryPatientOrder']['description'];
						$tmptests.=$test['LaboratoryPatientOrder']['description'].', ';
					}
					
					$tmpdata[$key] = $test;
					
					$patientEpisodesNumber[$key]=$test['LaboratoryPatientOrder']['patient_mrn'];
				}
				$tmpdata[$key]['LaboratoryPatientOrder']['description'] = substr_replace($tmptests, "", -2);
				$patientTests[$key]=substr_replace($tmptests, "", -2);
				$specimenids[]=$key;
				
			}
			$this->Session->delete('patientTests');
			$this->Session->write('patientTests',array(
					'PatientOrder.test'=>$patientTests,
				)
			);
			
			$this->Session->delete('patientEpisodesNumber');
			$this->Session->write('patientEpisodesNumber',$patientEpisodesNumber);
			
// 			$this->log($specimenids,'patientorderkey');
			if($this->Auth->user('role') == 9){
				$action = 'patient.load_order';
			}else{
				$action = 'physician.load_patient_order';
			}
			/* $this->addAuditLog($action,array(
					'patient_mrn'=>$patientid,
					'specimen_id'=>$specimenids,//specimen_id
			)); */
// 			$data = $tmpdata;
			$newdata =array();
			$rdata =array();
			foreach ($tmpdata as $key=>&$value){
				$newdata[$value['LaboratoryTestOrder']['posted_datetime']]=$value;
				$newdata[$value['LaboratoryTestOrder']['posted_datetime']]['LaboratoryTestOrder']['posted_datetime'] = date('M d,Y g:i a',strtotime($value['LaboratoryTestOrder']['posted_datetime']));
				
				
			}
			krsort($newdata);
			foreach ($newdata as $key=>&$ndata){
				$rdata[]=$ndata;
			}
// 			$newdata=array_values($newdata);
			
// 			debug($newdata);
			return $rdata;
		}else{
			return false;
		}
	
	
	
	}
	
	function __getPHCPatientByName($name,$start,$limit,$lastpaperid){
	
		/* Get Patient User from WeblisGW
		 *
		*
		*/
		
		$config = Configure::read('mumps');
		$this->HeartCenterService = $this->Components->load('HCWService');
		if($this->HeartCenterService->connect()){
			$data = array();
			$tmppatient = array();
			$tmppatient = $this->HeartCenterService->getPatientByName($name,$start,$limit,$lastpaperid);
// 			$this->log($tmppatient,'data');
			//$this->log($tmppatient,'debug2');
			if(isset($tmppatient['Patients']['PaperAll']) && !empty($tmppatient['Patients']['PaperAll'])){
				$fArr = array(".",",".":","'","?","`","@","#","$","%","^","&","*","(",")","-","+");
				$replace = "";
				foreach ($tmppatient['Patients']['PaperAll'] as $key=>&$patient){
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['lastname']=$patient['last_name'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['firstname']=$patient['first_name'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['middlename']=$patient['middle_name'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['birthdate']=date('m/d/Y',strtotime($patient['birthdate']));
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['mrno']=(!empty($patient['PaperPat']['ip_no']))?$patient['PaperPat']['ip_no']:(!empty($patient['PaperPat']['op_no']))?$patient['PaperPat']['op_no']:'';
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['internal_id']=$patient['id'];
					$data['PaperAll'][str_replace($fArr, $replace, $patient['last_name'].$patient['first_name'])]['Person']['laboratory_id']=$config['online.laboratory_id'];
					$patientids[]=(!empty($patient['PaperPat']['ip_no']))?$patient['PaperPat']['ip_no']:(!empty($patient['PaperPat']['op_no']))?$patient['PaperPat']['op_no']:'';
				}
				sort($data['PaperAll']);
				$data['PaperAll'] = array_values($data['PaperAll']);
// 				$this->log($data,'data');
// 				$newdata['Patient'] = $data['PaperAll'];
				return $data;
			}
			return false;
		}else{
			return false;
		}
	
	
	
	}
	
	function __getPHCCountPatientByName($name){
	
		/* Get Patient User from WeblisGW
		 *
		*
		*/
		//$this->log($mrno,'patientid');
		$config = Configure::read('mumps');
		$this->HeartCenterService = $this->Components->load('HCWService');
		if($this->HeartCenterService->connect()){
			$data = array();
			$totalcount = array();
			$totalcount = $this->HeartCenterService->getCountPatientByName($name);
			$this->log($totalcount,'totalcount');
			//$this->log($tmppatient,'debug');
				return $totalcount;
		}else{
			return false;
		}
	
	
	
	}
	
	public function checklogin() {
		if($this->RequestHandler->isAjax()){
			$this->autoRender = false;
			if ($this->Auth->user()) {
				$loggedIn = 1;
			} else {
				$loggedIn = 0;
			}
			return $loggedIn;
		}
	}
	public function admin_audit_trail(){
		$this->layout = 'nazareth';

		$startdate=date('Y-m-d',strtotime('now'));
		$enddate=date('Y-m-d',strtotime($startdate));
		$specimenid="";
		$patient_id="";
		$specimensetting="enabled";
		$datesetting="enabled";
		$mrnsetting="enabled";
		
		$conditions=array();
		if($this->request->is('post')){
			if(!empty($this->data['Patient']['start_date']) && !empty($this->data['Patient']['end_date'])){
				$startdate=$this->data['Patient']['start_date'];
				$enddate=$this->data['Patient']['end_date'];
			}else{
				$startdate="";
				$enddate="";
			}
			if(!empty($this->data['Patient']['patient_id'])){
				$patient_id=str_replace("-","",$this->data['Patient']['patient_id']);
			}
			if(!empty($this->data['Patient']['specimen_id'])){
				$specimenid=$this->data['Patient']['specimen_id'];
			}
			
		}
		if(!empty($specimenid) && !empty($patient_id) && !empty($startdate) && !empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
			
			);
		}elseif(!empty($specimenid) && empty($patient_id) && !empty($startdate) && !empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
						
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
						
			);
		}elseif(empty($specimenid) && !empty($patient_id) && !empty($startdate) && !empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
		}elseif(!empty($patient_id) && empty($startdate) && empty($enddate)){
				$conditions = array(
						'NOT'=>array('AuditLog.action'=>array(
								'physician.load_patient',
						)),
						'User.role <>'=>1,
						'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
			
				);
				$physicianconditions = array(
						'NOT'=>array('AuditLog.action'=>array(
								'physician.load_patient',
						)),
						'AuditLog.user_id'=>'',
						'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
			
				);
		}elseif(!empty($specimenid) && empty($startdate) && empty($enddate)){
				$conditions = array(
						'NOT'=>array('AuditLog.action'=>array(
								'physician.load_patient',
						)),
						'User.role <>'=>1,
						'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
			
				);
				$physicianconditions = array(
						'NOT'=>array('AuditLog.action'=>array(
								'physician.load_patient',
						)),
						'AuditLog.user_id'=>'',
						'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
			
				);
		}else{
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(		
								'physician.load_patient',		
						)),		
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
		
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
						
			);
		}
		// debug($this->params['named']['page']);
		if($this->params['named']['page'])
			$conditions = array();

		// debug($conditions);
		$this->loadModel('AuditLog');
		$this->Paginator->settings = array(
				'order'=>array('AuditLog.datetime'=> 'DESC'),
				'fields'=>array('AuditLog.action','AuditLog.datetime','AuditLog.ip_address','AuditLog.device','AuditLog.device_os','AuditLog.browser','AuditLog.remarks','User.username','Person.lastname','Person.firstname','Person.middlename'),
				'conditions'=>$conditions,
				'recursive'=>-1,
				'limit' => 20,
				'joins'=>array(
						array(
								'table' => 'users',
								'alias' => 'User',
								'type' => 'INNER',
								'conditions' => array(
										'User.id = AuditLog.user_id'
								)
						),
						array(
								'table' => 'people',
								'alias' => 'Person',
								'type' => 'INNER',
								'conditions' => array(
										'User.username = Person.myresultonline_id'
								)
						),
				
				)
		);
		$auditlogstmp = $this->Paginator->paginate('AuditLog');
		$physicianlogs=array();
		/* $physicianlogs=$this->AuditLog->find('all',array(
				'conditions'=>$physicianconditions,
				'recursive'=>-1,
				'limit'=>10
		));*/
		$auditlogsmerge=array_merge($auditlogstmp,$physicianlogs); 
		$auditlogsnew=array();
		foreach ($auditlogsmerge as $key=>$logs){
			$auditlogsnew[$logs['AuditLog']['datetime']]=$logs;
		}
		krsort($auditlogsnew);
// 		debug(array_values($auditlogsnew));
		$auditlogs=array_values($auditlogsnew);
		$this->set(compact('auditlogs','id','startdate','enddate','specimenid','patient_id','specimensetting','datesetting','mrnsetting'));
	
	}
	
	public function superadmin_audit_trail(){
	
		$startdate=date('Y-m-d',strtotime('now'));
		$enddate=date('Y-m-d',strtotime($startdate));
		$specimenid="";
		$patient_id="";
		$specimensetting="enabled";
		$datesetting="enabled";
		$mrnsetting="enabled";
	
		$conditions=array();
		if($this->request->is('post')){
			if(!empty($this->data['Patient']['start_date']) && !empty($this->data['Patient']['end_date'])){
				$startdate=$this->data['Patient']['start_date'];
				$enddate=$this->data['Patient']['end_date'];
			}else{
				$startdate="";
				$enddate="";
			}
			if(!empty($this->data['Patient']['patient_id'])){
				$patient_id=str_replace("-","",$this->data['Patient']['patient_id']);
			}
			if(!empty($this->data['Patient']['specimen_id'])){
				$specimenid=$this->data['Patient']['specimen_id'];
			}
				
		}
		if(!empty($specimenid) && !empty($patient_id) && !empty($startdate) && !empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
	
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
		}elseif(!empty($specimenid) && empty($patient_id) && !empty($startdate) && !empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
	
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
	
			);
		}elseif(empty($specimenid) && !empty($patient_id) && !empty($startdate) && !empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
	
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
	
			);
		}elseif(!empty($patient_id) && empty($startdate) && empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
		}elseif(!empty($specimenid) && empty($startdate) && empty($enddate)){
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.remarks LIKE'=>'%'.$specimenid.'%',
						
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.remarks LIKE'=>'%'.$patient_id.'%',
						
			);
		}else{
			$conditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'User.role <>'=>1,
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
	
			);
			$physicianconditions = array(
					'NOT'=>array('AuditLog.action'=>array(
							'physician.load_patient',
					)),
					'AuditLog.user_id'=>'',
					'AuditLog.datetime >='=>$startdate.' '.'00:00:00',
					'AuditLog.datetime <'=>$enddate.' '.'23:59:59',
	
			);
		}
		$this->loadModel('AuditLog');
		$this->Paginator->settings = array(
				'fields'=>array('AuditLog.*','User.*','Person.*'),
				'conditions'=>$conditions,
				'recursive'=>-1,
				'limit' => 20,
				'joins'=>array(
						array(
								'table' => 'users',
								'alias' => 'User',
								'type' => 'INNER',
								'conditions' => array(
										'User.id = AuditLog.user_id'
								)
						),
						array(
								'table' => 'people',
								'alias' => 'Person',
								'type' => 'INNER',
								'conditions' => array(
										'User.username = Person.myresultonline_id'
								)
						),
	
				)
		);
		$auditlogstmp = $this->Paginator->paginate('AuditLog');
		$physicianlogs=array();
		/* $physicianlogs=$this->AuditLog->find('all',array(
		 'conditions'=>$physicianconditions,
				'recursive'=>-1,
				'limit'=>10
		));*/
		$auditlogsmerge=array_merge($auditlogstmp,$physicianlogs);
		$auditlogsnew=array();
		foreach ($auditlogsmerge as $key=>$logs){
			$auditlogsnew[$logs['AuditLog']['datetime']]=$logs;
		}
		krsort($auditlogsnew);
		// 		debug(array_values($auditlogsnew));
		$auditlogs=array_values($auditlogsnew);
		$this->set(compact('auditlogs','id','startdate','enddate','specimenid','patient_id','specimensetting','datesetting','mrnsetting'));
	
	}
	
	public function admin_index(){

		$startdate=date('Y-m-d',strtotime('now'));
		$enddate=date('Y-m-d',strtotime($startdate . ' +1 day'));
		$specimenid="";
		$mrnnumber="";
		
		$specimensetting="disabled";
		$datesetting="disabled";
		$mrnsetting="enabled";
		
		if($this->request->is('post')){
			if(!empty($this->data['Patient']['mrnumber'])){
				$mrnnumber=str_replace('-','',$this->data['Patient']['mrnumber']);
			}
		}
		
		if(empty($mrnnumber)){
			$this->loadModel('Person');
			$this->Paginator->settings = array(
					'fields'=>array('Person.*','User.*'),
					'conditions' => array(
							'User.role' => 9,
							'User.status' => 1
					),
					'recursive'=>-1,
					'limit' => 15,
					'joins'=>array(
							array(
									'table' => 'users',
									'alias' => 'User',
									'type' => 'INNER',
									'conditions' => array(
											'User.username = Person.myresultonline_id'
									)
							)
					)
			);
		}else{
			$this->loadModel('Person');
			$this->Paginator->settings = array(
					'fields'=>array('Person.*','User.*'),
					'conditions' => array(
							'User.role' => 9,
							'User.status' => 1,
							'User.username'=>$mrnnumber
					),
					'recursive'=>-1,
					'limit' => 15,
					'joins'=>array(
							array(
									'table' => 'users',
									'alias' => 'User',
									'type' => 'INNER',
									'conditions' => array(
											'User.username = Person.myresultonline_id'
									)
							)
					)
			);
		}
		$persons = $this->Paginator->paginate('Person');
		// 		debug($persons);
		
		$this->loadModel('AuditLog');
		$auditlogs=$this->AuditLog->find('all',array(
				'fields'=>array('AuditLog.*','User.*','Person.*'),
				'conditions'=>array('AuditLog.action'=>'user.login','User.role'=>9),
				'joins'=>array(
						array(
								'table' => 'users',
								'alias' => 'User',
								'type' => 'INNER',
								'conditions' => array(
										'User.id = AuditLog.user_id'
								)
						),
						array(
								'table' => 'people',
								'alias' => 'Person',
								'type' => 'INNER',
								'conditions' => array(
										'User.username = Person.myresultonline_id'
								)
						),
		
				)
		));
		// 		debug($auditlogs);
		$this->set(compact('persons','auditlogs','startdate','enddate','specimenid','mrnnumber','specimensetting','datesetting','mrnsetting'));
		
		
	}
	
	public function admin_viewlogdetails($id=null){
		
		$startdate=date('Y-m-d',strtotime('now'));
		$enddate=date('Y-m-d',strtotime($startdate . ' +1 day'));
		$specimenid="";
		$mrnnumber="";
		$specimensetting="disabled";
		$datesetting="enabled";
		$mrnsetting="disabled";
		if($this->request->is('post')){
			if(!empty($this->data['Patient']['start_date']) && !empty($this->data['Patient']['end_date'])){
				$startdate=$this->data['Patient']['start_date'];
				$enddate=$this->data['Patient']['end_date'];
			}
		}
		$this->loadModel('AuditLog');
		$this->Paginator->settings = array(
				'conditions'=>array(
						'AuditLog.action'=>'user.login','AuditLog.user_id'=>$id,
						'AuditLog.datetime >='=>$startdate,
						'AuditLog.datetime <'=>$enddate
				),
				'recursive'=>-1,
				'limit' => 15
		);
		$auditlogslogin = $this->Paginator->paginate('AuditLog');
		
		
		$this->set(compact('auditlogslogin','id','startdate','enddate','specimenid','mrnnumber','specimensetting','datesetting','mrnsetting'));
	}
	
	public function admin_viewlogorders($id=null){
		$this->loadModel('AuditLog');
		
		$startdate=date('Y-m-d',strtotime('now'));
		$enddate=date('Y-m-d',strtotime($startdate . ' +1 day'));
		$specimenid="";
		$mrnnumber="";
		$specimensetting="enabled";
		$datesetting="enabled";
		$mrnsetting="disabled";
		if($this->request->is('post')){
			if(!empty($this->data['Patient']['start_date']) && !empty($this->data['Patient']['end_date'])){
				$startdate=$this->data['Patient']['start_date'];
				$enddate=$this->data['Patient']['end_date'];
			}
			if(!empty($this->data['Patient']['specimen_id'])){
				$specimenid=$this->data['Patient']['specimen_id'];
			}
		}
		$this->loadModel('AuditLog');
		if(empty($specimenid)){
			$this->Paginator->settings = array(
					'conditions'=>array(
							'AuditLog.action'=>'patient.load_order','AuditLog.user_id'=>$id,
							'AuditLog.datetime >='=>$startdate,
							'AuditLog.datetime <'=>$enddate
					),
					'recursive'=>-1,
					'limit' => 15
			);
		}else{
			$this->Paginator->settings = array(
					'conditions'=>array(
							'AuditLog.action'=>'patient.load_order','AuditLog.user_id'=>$id,
							'AuditLog.datetime >='=>$startdate,
							'AuditLog.datetime <'=>$enddate,
							'AuditLog.remarks LIKE'=>'%'.$specimenid.'%'
					),
					'recursive'=>-1,
					'limit' => 15
			);
		}
		$auditlogsloadorders = $this->Paginator->paginate('AuditLog');
		
		$this->set(compact('auditlogsloadorders','id','startdate','enddate','specimenid','mrnnumber','specimensetting','datesetting','mrnsetting'));
	}
	
	public function admin_viewlogresults($id=null){
		
		$this->loadModel('AuditLog');
		
		$startdate=date('Y-m-d',strtotime('now'));
		$enddate=date('Y-m-d',strtotime($startdate . ' +1 day'));
		$specimenid="";
		$mrnnumber="";
		$specimensetting="enabled";
		$datesetting="enabled";
		$mrnsetting="disabled";
		if($this->request->is('post')){
			if(!empty($this->data['Patient']['start_date']) && !empty($this->data['Patient']['end_date'])){
				$startdate=$this->data['Patient']['start_date'];
				$enddate=$this->data['Patient']['end_date'];
			}
			if(!empty($this->data['Patient']['specimen_id'])){
				$specimenid=$this->data['Patient']['specimen_id'];
			}
		}
		$this->loadModel('AuditLog');
		if(empty($specimenid)){
			$this->Paginator->settings = array(
					'conditions'=>array(
							'AuditLog.action'=>'patient.view_order','AuditLog.user_id'=>$id,
							'AuditLog.datetime >='=>$startdate,
							'AuditLog.datetime <'=>$enddate
					),
					'recursive'=>-1,
					'limit' => 15
			);
		}else{
			$this->Paginator->settings = array(
					'conditions'=>array(
							'AuditLog.action'=>'patient.view_order','AuditLog.user_id'=>$id,
							'AuditLog.datetime >='=>$startdate,
							'AuditLog.datetime <'=>$enddate,
							'AuditLog.remarks LIKE'=>'%'.$specimenid.'%'
					),
					'recursive'=>-1,
					'limit' => 15
			);
		}
		$auditlogsresults = $this->Paginator->paginate('AuditLog');
		$this->set(compact('auditlogsresults','id','startdate','enddate','specimenid','mrnnumber','specimensetting','datesetting','mrnsetting'));
	}
		
}
