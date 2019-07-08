<?php
App::uses('AppModel', 'Model');
/**
 * DownloadableFile Model
 *
 * @property DownloadFile $DownloadFile
 */
class DownloadableFile extends AppModel {
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
		'DownloadRole' => array(
			'className' => 'DownloadRole',
			'foreignKey' => 'file_id',
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
