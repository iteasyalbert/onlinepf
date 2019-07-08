<?php
	if($email_type == 1){
		if($memberType == 9 || $memberType == 5){
			$linkvalue = "/users/confirm/".$token;
			$link = "http://myresultonline.com/users/confirm/".$token;
		}elseif($memberType == 6 || $memberType == 4){
			$linkvalue = "/users/doctor_confirm/".$token;
			$link = "http://myresultonline.com/users/doctor_confirm/".$token;
		}elseif($memberType == 3 || $memberType == 7){
			$linkvalue = "/users/lab_confirm/".$token;
			$link = "http://myresultonline.com/users/lab_confirm/".$token;
		}
		$url = $this->Html->url($linkvalue,true);
	}elseif($email_type == 2){
		$link = "/users/download_contract";
		$url = $this->Html->url($link,true);
	}elseif($email_type == 3 || $email_type == 5){
		$url = '';
		$link = '';
	}
	
	if(isset($name)){$email_content = str_replace("[[name]]",$name,$email_content);}
	if(isset($token)){$email_content = str_replace("[[token]]",$token,$email_content);}
	if(isset($newpass)){$email_content = str_replace("[[newpass]]",$newpass,$email_content);}
	$email_content = str_replace("[[url]]",$url,$email_content);
	$email_content = str_replace("[[link]]",$link,$email_content);
	$email_content = str_replace("[[download_contract]]",$url,$email_content);
	
	echo $email_content;
?>