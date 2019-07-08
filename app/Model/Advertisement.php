<?php
App::uses('AppModel', 'Model');
/**
 * Advertisement Model
 *
 * @property User $User
 * @property Categorie $Categorie
 */
class Advertisement extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $statusAds = array(
		0 => 'New',
		1 => 'Published',
		2 => 'Pending',
		3 => 'Expired'
	);
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
		'Categorie' => array(
			'className' => 'Categorie',
			'foreignKey' => 'categorie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
