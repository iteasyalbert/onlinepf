<?php
App::uses('File', 'Utility');
App::uses('HttpSocket', 'Network/Http');
class AppController extends Controller{
    var $uses = array('Item', 'Question', 'Post');
    var $components = array(
    		'RequestHandler',
    // 		'Auth' => array(
		  //       'authenticate' => array(
		  //           'Form' => array(
		  //               'fields' => array('username' => 'username'),
    // 					 'userModel' => 'User',
		  //           )
		  //       ),
		  //       'loginError' => 'Invalid username or password!',
		  //       'authError' => 'You are not authorized to access that module.',
				// 'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		  //       'authorize' => array('Controller')
		  //   ),
    		'Common',
		    'Session',
		    'Cookie'
// 		    'Security'//Keep it commented. Conflict with AuthComponent
    	);
    	
   	var $helpers = array('Form', 'Html', 'Js', 'Time','Session');
   	  
	function stringToSlug($str) {
		$str = Inflector::slug($str);
		$str = strtolower($str);
		return $str;
	}
 
	function beforeFilter()
	{
		
	}

	function isAuthorized(){
		//if page has prefix, checks role
		if(isset($this->params['prefix']) && strlen($this->params['prefix'])){
			$prefix= $this->params['prefix'];
			if (($prefix=="laboratory") && ($this->Auth->user('role') == 3)){
				return true;
			}else if(($prefix=="patient") && ($this->Auth->user('role') == 9)){
				return true;
			}else if(($prefix=="physician") && ($this->Auth->user('role')== 6)){
				return true;
			}else if(($prefix=="hospital") && ($this->Auth->user('role')== 7)){
				return true;
			}else if(($prefix=="corporate") && ($this->Auth->user('role')== 11)){
				return true;
			}else if(($prefix=="superadmin") && ($this->Auth->user('role')== 0)){
				return true;
			}else if(($prefix=="admin") && ($this->Auth->user('role')== 1)){
				return true;
			}else if(($prefix=="resultviewer") && ($this->Auth->user('role')== 20)){
				return true;
			}else if(($prefix=="sales") && ($this->Auth->user('role')== 10)){
				return true;
			}else if(($prefix=="accounting") && ($this->Auth->user('role')== 15)){
				return true;
			}else{
				return false;
			}
		}

		//else, allow user
		return true;
	
	}
	
	function addAuditLog($action, $remarks=null, $table=null)
	{
		// $this->loadModel('AuditLog');
		$audit=array();
		$agent=$this->getBrowser();
		$audit['datetime']=date('Y-m-d H:i:s');
		$audit['url']=$this->here;
		$audit['action']=$action;
		$audit['ip_address']=$this->RequestHandler->getClientIp();
		$audit['browser']=$agent['name'];
		$audit['browser_version']=$agent['version'];
		$audit['device']=$agent['device'];
		$audit['device_os']=$agent['os'];
		if (is_array($remarks))
			$audit['remarks']=json_encode($remarks);
		else
			$audit['remarks']=$remarks;
		$audit['table']=$table;
		// $this->AuditLog->save($audit);
		return $audit;
	}
	
	function getBrowser()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		$operatingsystem= "";
		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
		
		//do something with this information
		if( $iPod || $iPhone ){
			$operatingsystem = "ios";
			//browser reported as an iPhone/iPod touch -- do something here
		}else if($iPad){
			$operatingsystem = "ios";
			//browser reported as an iPad -- do something here
		}else if($Android){
			$operatingsystem = "android";
			//browser reported as an Android device -- do something here
		}else if($webOS){
			$operatingsystem = "webos";
			//browser reported as a webOS device -- do something here
		}else{
			$operatingsystem = "windows";
		}
		
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
	
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
	
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
	
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
	
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
	
		return array(
				'userAgent' => $u_agent,
				'name'      => $bname,
				'version'   => $version,
				'platform'  => $platform,
				'pattern'    => $pattern,
				'os'=> $operatingsystem,
				'device' => $this->getDevice()
		);
	}
	
	function getDevice(){
		$tablet_browser = 0;
		$mobile_browser = 0;
		
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		}
		
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		}
		
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
		}
		
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
				'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
				'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
				'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
				'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
				'newt','noki','palm','pana','pant','phil','play','port','prox',
				'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
				'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
				'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
				'wapr','webc','winw','winw','xda ','xda-');
		
		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}
		
		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
			$mobile_browser++;
			//Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}
		
		if ($tablet_browser > 0) {
			// do something for tablet devices
			return 'tablet';
		}
		else if ($mobile_browser > 0) {
			// do something for mobile devices
			return 'mobile';
		}
		else {
			// do something for everything else
			return 'windows';
		}
		
	}
}
?>