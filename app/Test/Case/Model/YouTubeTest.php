<?php
App::uses('YouTube', 'Model');

/**
 * YouTube Test Case
 *
 */
class YouTubeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = false;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->YouTube = ClassRegistry::init('YouTube');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->YouTube);

		parent::tearDown();
	}

/**
 * @covers YouTube::store
 */
	public function testStore() {
		$res = $this->YouTube->store(1, [
			'videoId' => 'dummy',
			'title' => 'Dummy Title',
			'thumbnail' => 'http://dummy/dummy.jpg'
		]);

		$this->assertTrue($res);
	}

}
