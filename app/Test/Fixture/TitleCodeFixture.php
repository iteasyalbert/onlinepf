<?php
/* TitleCode Fixture generated on: 2012-12-12 05:15:20 : 1355289320 */

/**
 * TitleCodeFixture
 *
 */
class TitleCodeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 19, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'display' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'text' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'entry_datetime' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 19, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'validated' => array('type' => 'boolean', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'validated_datetime' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'validating_user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 19, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'IX_title_codes' => array('column' => array('entry_datetime', 'user_id'), 'unique' => 0), 'IX_title_codes_1' => array('column' => array('user_id', 'entry_datetime'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'display' => 'Lorem ipsum dolor ',
			'text' => 'Lorem ipsum dolor ',
			'description' => 'Lorem ipsum do',
			'entry_datetime' => '2012-12-12 05:15:20',
			'user_id' => 1,
			'validated' => 1,
			'validated_datetime' => '2012-12-12 05:15:20',
			'validating_user_id' => 1
		),
	);
}
