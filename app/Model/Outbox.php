<?php
App::uses('AppModel', 'Model');
/**
 * CountryCode Model
 *
 * @property Address $Address
 */
class Outbox extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'Outbox';
	public $useDbConfig = 'infotext';
	public $useTable = 'Outbox';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
/**
 * hasMany associations
 *
 * @var array
 */	

}
