<?php
App::uses('Tune', 'Model');
// App::uses('ComponentCollection', 'Controller');
// App::uses('CookieComponent', 'Controller/Component');

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

		// $Collection = new ComponentCollection();
		// $this->CookieComponent = new CookieComponent($Collection);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tune, $_COOKIE);

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
 * @covers Tune::getIdAtRandom
 */
	public function testGetIdRandomConcerningConfigurationWhichToPickUp() {
		$enabled_book_ids = [1, 2];
		$_COOKIE[Configure::read('Cookie.name')]['Config']['enabled_books'] = $enabled_book_ids;

		$actual_tune_id = $this->Tune->getIdAtRandom();

		$picked_tunes = $this->Tune->BooksTune->find('list', [
			'fields' => ['BooksTune.tune_id'],
			'conditions' => ['BooksTune.book_id' => $enabled_book_ids]
		]);
		$this->assertContains($actual_tune_id, $picked_tunes);

		// Asserting not picked up from disabled book.
		$maybe_not_picked_tunes = $this->Tune->BooksTune->find('list', [
			'fields' => ['BooksTune.tune_id'],
			'conditions' => ['BooksTune.book_id' => 3]
		]);
		$this->assertNotContains($actual_tune_id, $maybe_not_picked_tunes);
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
