<?php
App::uses('TunesController', 'Controller');

/**
 * TunesController Test Case
 *
 */
class TunesControllerTest extends ControllerTestCase {

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
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * @covers TunesController::next()
 */
	public function testNextRedirectsWithGetRequest() {
		$result = $this->testAction(
			'/tunes/next',
			[
				'data' => ['enabled_books' => [1, 2]],
				'method' => 'get'
			]
		);

		$this->assertRegExp(
			'|tunes/view/\d+$|',
			$this->headers['Location']
		);
	}

/**
 * @covers TunesController::next()
 */
	public function testNextReturnsJsonWithAjaxCall() {
		$Tunes = $this->generate('Tunes', [
			'models' => [
				'Tune' => ['getIdAtRandom']
			],
			'components' => [
				'RequestHandler' => ['isAjax']
			]
		]);

		$Tunes->Tune->expects($this->once())
			->method('getIdAtRandom')
			->will($this->returnValue([2, 3]));

		$Tunes->RequestHandler
			->expects($this->once())
			->method('isAjax')
			->will($this->returnValue(true));

		$result = $this->testAction(
			'/tunes/next',
			[
				'data' => ['enabled_books' => [1, 2]],
				'method' => 'post'
			]
		);

		$this->assertEquals($result, [2, 3]);
	}

}
