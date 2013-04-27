<?php
App::uses('Sample', 'Model');

/**
 * Sample Test Case
 *
 */
class SampleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sample',
		'app.tune',
		'app.book',
		'app.books_tune'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sample = ClassRegistry::init('Sample');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sample);

		parent::tearDown();
	}

	public function testDummy() {
		$this->markTestIncomplete();
	}

}
