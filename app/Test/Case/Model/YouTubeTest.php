<?php
App::uses('YouTube', 'Model');

require_once APP . DS . 'Vendor' . DS. 'autoload.php';
use org\bovigo\vfs\vfsStream;

// App::import('Vendor', 'vfsStream', 'mikey179\vfsStream\src\main\php\org\bovigo\vfs');

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

		$root = vfsStream::setup();

		$this->assertTrue($res);
	}

}
