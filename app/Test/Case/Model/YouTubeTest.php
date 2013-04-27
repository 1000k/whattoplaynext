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
 * @covers YouTube::downloadThumbnail
 * @covers YouTube::_download
 */
	public function testDownloadThumbnail() {
		$model = $this->getMockForModel('YouTube', ['_download']);
		$model->expects($this->once())
			->method('_download')
			->will($this->returnValue("dummyfile"));

		$root = vfsStream::setup('samples');	// => vfs://samples/
		$thumbnail_dir = vfsStream::url('samples');
		$model->thumbnail_dir = $thumbnail_dir;

		$video_id = 'DUMMY1234';
		$thumbnail_url = 'http://dummy/dummy.jpg';

		$result = $model->downloadThumbnail($thumbnail_url, $video_id);

		$this->assertGreaterThan(0, $result);
		$this->assertTrue(file_exists(vfsStream::url('samples/DUMMY1234.jpg')));
	}

}
