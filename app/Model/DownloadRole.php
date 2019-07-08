<?php
App::uses('AppModel', 'Model');
/**
 * DownloadRole Model
 *
 * @property DownloadableFile $DownloadableFile
 */
class DownloadRole extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DownloadableFile' => array(
			'className' => 'DownloadableFile',
			'foreignKey' => 'file_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
