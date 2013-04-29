<?php
App::uses('AppController', 'Controller');
/**
 * Configs Controller
 *
 */
class ConfigsController extends AppController {
	public $uses = false;
	public $components = ['Cookie'];

	public function save() {
		$this->autoRender = false;

		$this->Cookie->write(
			'Config.enabled_books',
			$this->request->data['Config']['enabled_books']
		);
	}
}
