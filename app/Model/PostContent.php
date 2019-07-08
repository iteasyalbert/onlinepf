<?php
App::uses('AppModel', 'Model');
/**
 * PostContent Model
 *
 * @property Post $Post
 * @property Image $Image
 * @property PostTag $PostTag
 * @property Reply $Reply
 */
class PostContent extends AppModel {
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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'post_content_id',
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
		'PostTag' => array(
			'className' => 'PostTag',
			'foreignKey' => 'post_content_id',
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
		'Reply' => array(
			'className' => 'Reply',
			'foreignKey' => 'post_content_id',
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
	function beforeSave($options){
//		$this->loadModel('PostContent');
//		if(isset($this->data['PostContent']['slug']) && !empty($this->data['PostContent']['slug'])){
//			$validateSlug = $this->find('first',array('conditions'=>array('PostContent.slug'=>$this->data[$this->alias]['slug'])));
////			$this->log($validateSlug,'debug');
//			if($validateSlug){
//				$newSlug = $this->data[$this->alias]['slug'].$validateSlug['PostContent']['post_id'];
//					$this->data[$this->alias]['slug'] = $newSlug;
//			}
//		}
		return true;
	}


}
