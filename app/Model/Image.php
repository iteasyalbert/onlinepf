<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property PostContent $PostContent
 * @property User $User
 */
class Image extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PostContent' => array(
			'className' => 'PostContent',
			'foreignKey' => 'post_content_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
