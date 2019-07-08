<?php
/**
 * PostSecurity component
 *
 * Manages user logins and permissions.
 *
 * PHP 5
 */

App::uses('Component', 'Controller');
App::uses('Router', 'Routing');
class PostSecurityComponent extends Component {
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
		
	}
	
	
	function __validateKeys($key)
	{
		$fst = substr($key,0,4);
		$snd = substr($key,8,4);
		$trd = substr($key,16,4);
		$fth = substr($key,24,4);
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
		
		/*CakeLog::write('debug', 'key');
		CakeLog::write('debug', $fst);
		CakeLog::write('debug', $snd);
		CakeLog::write('debug', $trd);
		CakeLog::write('debug', $fth);
		CakeLog::write('debug',md5($fst.$snd.$trd.$fth));
		CakeLog::write('debug',substr($key,32));
		CakeLog::write('debug', $checksum);
		*/
		
		if ($checksum==substr($key,32))
		{
			return true;
		}

			
		return false;
	}
	
	function __validateExecutionToken($executiontoken)
	{
		$session = $this->__getsession();
		debug($session);
		//todo:save execution token
// 		debug($executiontoken);
		if ($this->__validateToken($executiontoken['token']))
		{
			$datetime=substr(str_replace("T"," ",$executiontoken['datetime']),0,19);
			$eToken = $this->__createToken(md5($session['accessToken']['token'].date("YmdHis",strtotime($datetime)).$executiontoken['random']));
	
			CakeLog::write('debug','test');

			CakeLog::write('debug',$executiontoken['token']);
			CakeLog::write('debug',$executiontoken['datetime']);
			CakeLog::write('debug',$executiontoken['random']);
			CakeLog::write('debug',$eToken);
			
			return ($executiontoken['token']==$eToken);
		}
		
		return false;
	}
	
	function __createDummyResultToken()
	{
		$now=date('c');
		$rand=rand().date('c');
		$md5=md5($rand);
		$token=sha1(rand().$rand);
		$result = array(
			'status'=>0,
			'datetime'=>$now,
			'random'=>$md5,
			'token'=>$token
		);
		
		return $result;
	}
	
	/*function __createFinalResultToken($executiontoken,$token,$status=1,$key,$return)
	{
		//$now=date('c');
		//$rand=rand().date('c');
		//$md5=md5($rand);
		//$token=substr(md5($md5).md5(rand()),11,40);
		
		//create time base on user timezone
		$now = date('c');
		$result['status']=$status;
		$result['datetime']=$now;
		$result['random']=md5(rand().$now);
		


		$datetime = $this->__createTimeFromUserTimezone($executiontoken['datetime'],$now);
		
		CakeLog::write('debug','execution token');
		CakeLog::write('debug',$token.date("YmdHis",$datetime).$result['random']);
		//compute result token
		$result['token'] = $this->__createToken(md5($token.date("YmdHis",$datetime).$result['random']),true);
		if ($return)
			return array('ResultToken'=>$result,"$key"=>$return);
		else
			return array('ResultToken'=>$result);
	}
	
	
	function __createResultToken($executiontoken,$status=0,$key=null,$return=null)
	{
		$session = $this->__getsession();
				
		//todo:save execution token
		
		if ($session) //must not be expired
		{
			return $this-> __createFinalResultToken($executiontoken,$session['accessToken']['token'],$status,$key,$return);
		} else
		{
			//return null; //session expired
			return $this-> __createFinalResultToken($executiontoken,$executiontoken['token'],100); //expired session
		}
		
	}*/

	function __computeDataChecksum($data)
	{
		
		/*foreach($data as $key=>$value)
		{
			if ($value)
		}*/
	}
	
	
	function __createFinalResultToken($executiontoken,$token,$status=1,$return)
	{
		//$now=date('c');
		//$rand=rand().date('c');
		//$md5=md5($rand);
		//$token=substr(md5($md5).md5(rand()),11,40);
		
		//create time base on user timezone
		$now = date('c');
		$result['status']=$status;
		$result['datetime']=$now;
		$result['random']=md5(rand().$now);
		


		$datetime = $this->__createTimeFromUserTimezone($executiontoken['datetime'],$now);
		
		CakeLog::write('debug','execution token');
		CakeLog::write('debug',$token.date("YmdHis",$datetime).$result['random']);
		//compute result token
		$result['token'] = $this->__createToken(md5($token.date("YmdHis",$datetime).$result['random']),true);
		
		$return['ResultToken']=$result;
		//debug($return);
		return $return;
	}
	
	
	function __createResultToken($executiontoken,$status=0,$return=null)
	{
		$session = $this->__getsession();
				
		//todo:save execution token
		
		if ($session) //must not be expired
		{
			return $this-> __createFinalResultToken($executiontoken,$session['accessToken']['token'],$status,$return);
		} else
		{
			//return null; //session expired
			return $this-> __createFinalResultToken($executiontoken,$executiontoken['token'],100,$return); //expired session
		}
		
	}
	
	function __createTimeFromUserTimezone($userdatetime,$datetime=null) //must be ISO 8601
	{
		/*if (!$datetime)
			$datetime=strtotime('now');
			
		$adjustmentindex=0;
		$adjustmentindex=strrpos($userdatetime,"+");
		
		if (!$adjustmentindex)
			$adjustmentindex=strrpos($userdatetime,"-");
		
		$retdatetime=null;
		if ($adjustmentindex)
		{
			$timeadjustment=substr($userdatetime,$adjustmentindex,3);
			CakeLog::write('debug',$timeadjustment);
			if ($timeadjustment != "+00" && $timeadjustment != "-00")
			{
				if ($timeadjustment != "+01" && $timeadjustment != "-01")
					$retdatetime=strtotime("$datetime $timeadjustment hours");
				else
					$retdatetime=strtotime("$datetime $timeadjustment hours");
			}
		}

		if (!$retdatetime)
			$retdatetime=strtotime('now');
		
		return $retdatetime;*/
		
		return strtotime('now');
	}
	
	function __validateToken($key)
	{
// 		debug($key);
		$fst = substr($key,4,4);
		$snd = substr($key,12,4);
		$trd = substr($key,20,4);
		$fth = substr($key,28,4);
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
		
		/*CakeLog::write('debug', 'token');
		CakeLog::write('debug', $fst);
		CakeLog::write('debug', $snd);
		CakeLog::write('debug', $trd);
		CakeLog::write('debug', $fth);
		CakeLog::write('debug',md5($fst.$snd.$trd.$fth));
		CakeLog::write('debug',substr($key,32));
		CakeLog::write('debug', $checksum);*/
		
		if ($checksum==substr($key,32))
		{
			return true;
		}

			
		return false;
	}
	
	function __generateAccessToken($username,$password,$execdatetime,$token)
	{
		/*$hash="";
		if (!$username && !$password && !$token)
			
		else
			$hash=md5($username.$password.$token);*/
		
		$now = date('c');
		$result['status']=1;
		$result['datetime']=$now;
		$result['random']=$hash=md5(rand().date("Y-m-d H:i:s").Configure::read('Security.salt'));;
		$datetime = $this->__createTimeFromUserTimezone($execdatetime,$now);
		$result['token'] = $this->__createToken(md5($token.date("YmdHis",$datetime).$result['random'].$password));
			
		return $result;
	}
	
	function __createToken($hash=null,$result=false)
	{
		
		if (!$hash)
			$hash=md5(rand().date("Y-m-d H:i:s:u").Configure::read('Security.salt'));
		
		if ($result)
		{
			$fst = substr($hash,4,6);
			$snd = substr($hash,12,6);
			$trd = substr($hash,20,6);
			$fth = substr($hash,28,4);
		}
		else {
			$fst = substr($hash,4,4);
			$snd = substr($hash,12,4);
			$trd = substr($hash,20,4);
			$fth = substr($hash,28,4);
		}
				
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
		
		return $hash.$checksum;
	}
	function __createApplicationKey($hash=null,$result=false)
	{
	
		if (!$hash)
			$hash=md5(rand().date("Y-m-d H:i:s:u").Configure::read('Security.salt'));
	
		if ($result)
		{
			$fst = substr($hash,0,6);
			$snd = substr($hash,8,6);
			$trd = substr($hash,16,6);
			$fth = substr($hash,24,4);
			
			

		}
		else {
			$fst = substr($hash,0,4);
			$snd = substr($hash,8,4);
			$trd = substr($hash,16,4);
			$fth = substr($hash,24,4);
		}
	
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
	
		return $hash.$checksum;
	}
	
	function __encryptPassword($token,$password,$base64=true)
	{
		$hash=substr($token,0,32);
		$checksum=substr($token,32);

		$hash=sha1(md5($hash).md5($checksum));

		$textpassword = $hash;
		//$password=base64_encode($password);
		for($i=0;$i<strlen($password);$i++)
		{
			$textpassword{$i} = $hash{$i} ^ $password{$i};
		}

		if ($base64)
			return base64_encode($textpassword);
		else
			return trim($textpassword);
	}
	
	function __decryptPassword($token,$password)
	{
		return $this->__encryptPassword($token,base64_decode($password),false);
	}
	
	function __getsession()
	{
		$session=CakeSession::read('myresultonline.session');
// 		if (!$session && $this->$debug && $_SERVER['REMOTE_ADDR'] == '127.0.0.1') //for debugging
		if (true)//!$session && env('HTTP_USER_AGENT') == 'LimDebugClient')
		{
			$session['user']['id']=1;
			$session['accessToken']['token']='c8a309db758788cb4a3bfca317c78c4eea2fc8fb';
			//sample token
            //<token xsi:type="xsd:string">e97d7081b5e2e16fee4c2ca01172c619f3dec17d</token>
            //<random xsi:type="xsd:string">3e59cd7731214f7eb7db2510b7e81694</random>
            //<datetime xsi:type="xsd:dateTime">2013-01-18T01:55:44+08:00</datetime>
			
		}
		
		CakeLog::write('debug','accessToken');
		CakeLog::write('debug',$session['accessToken']['token']);
		$this->log(env('HTTP_USER_AGENT'),'pdfsess');
		$this->log($session,'pdfsess');
		
		return $session;
	}
	
	function __createsession($user, $accessToken)
	{
		CakeSession::write('myresultonline.session',array('user'=>$user,'accessToken'=>$accessToken));
		$session=CakeSession::read('myresultonline.session');
		return true;
	}
	
	function __destroysession()
	{
		CakeSession::delete('myresultonline.session');
		return true;
	}
	
	
	function __computechecksum(&$data)
	{
		$sdata="";
		foreach($data as $key=>$value)
		{
			if ($value)
			{
				if (strpos($key,"date") >= 0)
				{
					$date = date("M/d/Y H:i:s",strtotime($value));
					$sdata = $date;
				} else
					$sdata.=$value;
			}
		}
		
		if ($sdata)
		{
			$data['checksum']=md5($sdata);
			//debug($data);
			return $data;
		}
		else
			return $data;
	}
	
	
	
}
