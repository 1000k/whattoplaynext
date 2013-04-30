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

		$stub_tune_id = 1;
		$Tunes->Tune->expects($this->once())
			->method('getIdAtRandom')
			->will($this->returnValue($stub_tune_id));

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

		$expected_url = Router::url("/tunes/view/{$stub_tune_id}", true);
		$this->assertEquals($result['result'], 'OK');
		$this->assertEquals($result['url'], $expected_url);
	}

}
