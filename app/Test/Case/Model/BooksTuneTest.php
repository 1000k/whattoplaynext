<?php
App::uses('BooksTune', 'Model');

/**
 * BooksTune Test Case
 *
 */
class BooksTuneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.books_tune',
		'app.book',
		'app.tune'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BooksTune = ClassRegistry::init('BooksTune');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BooksTune);

		parent::tearDown();
	}

	public function testDummy() {
		$this->markTestIncomplete();
	}

}
