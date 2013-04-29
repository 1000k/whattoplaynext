<?php
App::uses('ConfigsController', 'Controller');

/**
 * ConfigsController Test Case
 *
 */
class ConfigsControllerTest extends ControllerTestCase {

	public $fixtures = false;

/**
 * @covers ConfigsController::save
 */
	public function testSave() {
		$data = ['Config' => ['enabled_books' => [1, 3, 5]]];
		$result = $this->testAction('/configs/save', ['data' => $data, 'method' => 'post']);
		$this->assertEquals($this->controller->Cookie->read('Config.enabled_books'), [1, 3, 5]);
	}

/**
 * @covers ConfigsController::save
 */
	public function testSaveAcceptsEmptyArray() {
		$data = ['Config' => ['enabled_books' => []]];
		$result = $this->testAction('/configs/save', ['data' => $data, 'method' => 'post']);
		$this->assertEquals($this->controller->Cookie->read('Config.enabled_books'), []);
	}
}
