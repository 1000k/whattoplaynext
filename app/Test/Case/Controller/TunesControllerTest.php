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

	public function setUp() {
		parent::setUp();
		$this->tuneFixture = new TuneFixture();
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete();
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
		$stub_tune_id = 1;
		$Tunes = $this->__getMockedObjectSimulatingAjaxRequest($stub_tune_id);
		
		$result = $this->testAction(
			'/tunes/next',
			[
				'data' => ['enabled_books' => [1, 2]],
				'method' => 'post'
			]
		);

		$this->assertEquals($result['Tune'], $this->tuneFixture->records[0]);
		$this->assertArrayHasKey('Book', $result);
		$this->assertArrayHasKey('Sample', $result);
	}

	private function __getMockedObjectSimulatingAjaxRequest($stub_tune_id) {
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
			->will($this->returnValue($stub_tune_id));

		$Tunes->RequestHandler
			->expects($this->once())
			->method('isAjax')
			->will($this->returnValue(true));

		return $Tunes;
	}

}
