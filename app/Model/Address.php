<?php
App::uses('AppModel', 'Model');
/**
 * Address Model
 *
 * @property Street $Street
 * @property Village $Village
 * @property TownCity $TownCity
 * @property ProvinceState $ProvinceState
 * @property Country $Country
 */
class Address extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'StreetCode' => array(
			'className' => 'StreetCode',
			'foreignKey' => 'street_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'VillageCode' => array(
			'className' => 'VillageCode',
			'foreignKey' => 'village_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TownCityCode' => array(
			'className' => 'TownCityCode',
			'foreignKey' => 'town_city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProvincesStatesCode' => array(
			'className' => 'ProvincesStatesCode',
			'foreignKey' => 'province_state_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CountryCode' => array(
			'className' => 'CountryCode',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
