<?php
App::uses('AppModel', 'Model');
/**
 * ProvincialRegion Model
 *
 * @property ProvincesStatesCode $ProvincesStatesCode
 */
class ProvincialRegion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ProvincesStatesCode' => array(
			'className' => 'ProvincesStatesCode',
			'foreignKey' => 'provincial_region_id',
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
