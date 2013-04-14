<?php
App::uses('Tune', 'Model');

/**
 * Tune Test Case
 *
 */
class TuneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tune'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tune = ClassRegistry::init('Tune');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tune);

		parent::tearDown();
	}

/**
 * @covers Tune::random
 */
	public function testRandom() {
		$this->markTestIncomplete();
	}

}
