<?php
/**
 * TuneFixture
 *
 */
class TuneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name_UNIQUE' => array('column' => 'name', 'unique' => 1)
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
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet1'
		),
		array(
			'id' => 2,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet2'
		),
		array(
			'id' => 3,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet3'
		),
		array(
			'id' => 4,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet4'
		),
		array(
			'id' => 5,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet5'
		),
		array(
			'id' => 6,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet6'
		),
		array(
			'id' => 7,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet7'
		),
		array(
			'id' => 8,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet8'
		),
		array(
			'id' => 9,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet9'
		),
		array(
			'id' => 10,
			'created' => '2013-04-30 14:50:08',
			'modified' => '2013-04-30 14:50:08',
			'name' => 'Lorem ipsum dolor sit amet10'
		),
	);

}
