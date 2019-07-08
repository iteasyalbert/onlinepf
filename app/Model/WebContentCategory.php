<?php
App::uses('AppModel', 'Model');
/**
 * WebContentCategory Model
 *
 * @property User $User
 * @property WebType $WebType
 */
class WebContentCategory extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WebContentType' => array(
			'className' => 'WebContentType',
			'foreignKey' => 'web_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
