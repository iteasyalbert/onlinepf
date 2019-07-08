<?php
App::uses('AppModel', 'Model');
/**
 * PostTag Model
 *
 * @property User $User
 * @property Tag $Tag
 * @property PostContent $PostContent
 */
class PostTag extends AppModel {

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
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PostContent' => array(
			'className' => 'PostContent',
			'foreignKey' => 'post_content_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
