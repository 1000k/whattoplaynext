<?php
/**
 * BooksTuneFixture
 *
 */
class BooksTuneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'book_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'tune_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
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
			'book_id' => 1,
			'tune_id' => 1
		),
		array(
			'id' => 2,
			'book_id' => 2,
			'tune_id' => 2
		),
		array(
			'id' => 3,
			'book_id' => 3,
			'tune_id' => 3
		),
		array(
			'id' => 4,
			'book_id' => 4,
			'tune_id' => 4
		),
		array(
			'id' => 5,
			'book_id' => 5,
			'tune_id' => 5
		),
		array(
			'id' => 6,
			'book_id' => 6,
			'tune_id' => 6
		),
		array(
			'id' => 7,
			'book_id' => 7,
			'tune_id' => 7
		),
		array(
			'id' => 8,
			'book_id' => 8,
			'tune_id' => 8
		),
		array(
			'id' => 9,
			'book_id' => 9,
			'tune_id' => 9
		),
		array(
			'id' => 10,
			'book_id' => 10,
			'tune_id' => 10
		),
	);

}
