<?php

$config=array(
	'webpost.debug'=>1,
	'webpost.template'=>'mro',
	'webpost.auth'=>1,
	'webpost.authhash',
	'webpost.settings'=>array(
		'username'=>'patient_id',//default is email/email_address //patient id or hospital id
		'password'=>'first_name',//default is last_name
		'case'=>'uppercase',//default is uppercase
		'trim'=>true,
	)
);

/*
 *  type
 *  	date
 *  	test_groups -> list of test groups
 * 		departments 
 * 
 */


?>