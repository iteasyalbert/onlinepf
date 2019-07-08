<?php
App::uses('AppModel', 'Model');
/**
 * TitleCode Model
 *
 * @property Person $Person
 */
class TitleCode extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $displayField = 'display';
	
	public $hasMany = array(
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'title_id',
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

}
