<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Member $Member
 * @property PersonIdentity $PersonIdentity
 * @property Physician $Physician
 * @property Privilege $Privilege
 */
class User extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $roles = array(
		'super admin'=>1,
		'owner'=>2,
		'administrator'=>3,
		'medtech'=>4,
		'physician'=>5,
		'patient'=>6,
		'hospital'=>7,
		'sale'=>8
	);
	
	public $hasMany = array(
		'CompanyBranchMember' => array(
			'className' => 'CompanyBranchMember',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PersonIdentity' => array(
			'className' => 'PersonIdentity',
			'foreignKey' => 'users_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Physician' => array(
			'className' => 'Physician',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Privilege' => array(
			'className' => 'Privilege',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
		var $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter username. ',
			),
			'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Username already exists, please enter new username. '
            ),
//             'email' => array(
//                 'rule' => 'email',
//                 'message' => 'Invalid username, please use your personal email address. '
//             ),
		),
		'password'=>array(
			'notempty'=>array(
				'rule'=>array('notempty'),
				'message'=>'Please enter password. '
			),
//			'maxlength' => array(
//				'rule' => array('maxlength',20),
//				'message' => 'Password must not exceed 20 characters.'
//			),
			'minlength' => array(
				'rule' => array('minlength',2),
				'message' => 'Password must be at least 5 characters. ',
			),
		),
// 		'captcha'=>array(
// 				'rule' => array('matchCaptcha'),
// 				'message'=>'Failed validating human check. '
// 		)
	);
	var $captcha = ''; //intializing captcha var

//	var $validate = array(
//			'captcha'=>array(
//				'rule' => array('matchCaptcha'),
//				'message'=>'Failed validating human check.'
//			),
//		);

	function matchCaptcha($inputValue)	{
		return $inputValue['captcha']==$this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
	}

	function setCaptcha($value)	{
		$this->captcha = $value; //setting captcha value
	}

	function getCaptcha()	{
		return $this->captcha; //getting captcha value
	}

}
