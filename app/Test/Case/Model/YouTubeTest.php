<?php
App::uses('YouTube', 'Model');
App::uses('Sample', 'Model');

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
		$this->YouTube = ClassRegistry::init('YouTube');
		$this->Sample = ClassRegistry::init('Sample');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->YouTube, $this->Sample);

		parent::tearDown();
	}

/**
 * @covers YouTube::store
 */
	public function testStore() {
		$model = $this->getMockForModel('YouTube', ['uso']);
		$root = vfsStream::setup('samples');	// => vfs://samples/
		$thumbnail_dir = vfsStream::url('samples');
		$model->thumbnail_dir = $thumbnail_dir;
		$tune_id = 1;

		$opts = [
			'videoId' => 'DUMMY1234',
			'title' => 'Dummy Title',
			'thumbnail' => 'http://dummy/dummy.jpg'
		];
		$result = $model->store($tune_id, $opts);

		$this->assertTrue($result);
		$this->assertTrue(file_exists(vfsStream::url('samples/DUMMY1234.jpg')));
		$this->assertGreaterThan(0, $this->Sample->find('count', ['conditions' => ['Sample.id' => 1]]));
	}

}
