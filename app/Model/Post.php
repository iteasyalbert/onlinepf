<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 * @property Category $Category
 * @property PostContent $PostContent
 */
class Post extends AppModel {
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
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
		'PostContent' => array(
			'className' => 'PostContent',
			'foreignKey' => 'post_id',
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
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'post_id',
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
	);
	function beforeSave($options){
////		$this->loadModel('PostContent');
//		if(isset($this->data[$this->alias]['slug'])){
//			$validateSlug = $this->find('first',array('conditions'=>array('Post.slug'=>$this->data[$this->alias]['slug'])));
////			$this->log($validateSlug,'debug');
//			if($validateSlug){
//				$newSlug = $this->data[$this->alias]['slug'].$validateSlug['Post']['id'];
//					$this->data[$this->alias]['slug'] = $newSlug;
//			}
//		}
		return true;
	}

}
