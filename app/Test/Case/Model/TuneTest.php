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
		'app.tune',
		'app.sample',
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
		$this->Tune = ClassRegistry::init('Tune');
		$this->tuneFixture = new TuneFixture();
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
 * @covers Tune::getIdAtRandom
 */
	public function testGetIdRandom() {
		$tunes = $this->tuneFixture->records;

		$id = $this->Tune->getIdAtRandom();

		// 0 < $id <= count($tunes)
		$this->assertGreaterThan(0, $id);
		$this->assertLessThanOrEqual(count($tunes), $id);
	}

/**
 * @covers Tune::getIdByName
 */
	public function testGetIdByName() {
		$this->assertEquals(
			$this->tuneFixture->records[0]['id'],
			$this->Tune->getIdByName($this->tuneFixture->records[0]['name'])
		);

		$this->assertFalse($this->Tune->getIdByName('NEVER EXISTED TUNE NAME'));
	}

}
