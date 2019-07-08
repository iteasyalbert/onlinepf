<?php
App::uses('AppModel', 'Model');
/**
 * WebContent Model
 *
 * @property WebType $WebType
 * @property WebCategory $WebCategory
 */
class WebContent extends AppModel {
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
		'WebContentType' => array(
			'className' => 'WebContentType',
			'foreignKey' => 'web_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WebContentCategory' => array(
			'className' => 'WebContentCategory',
			'foreignKey' => 'web_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
