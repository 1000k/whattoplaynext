<?php
App::uses('AppController', 'Controller');
/**
 * Configs Controller
 *
 */
class ConfigsController extends AppController {
	public $uses = false;
	public $components = ['Cookie', 'RequestHandler'];

	public function save() {
		$this->Cookie->write(
			'Config.enabled_books',
			$this->request->data['Config']['enabled_books']
		);

		$this->set('result', ['result' => 'OK']);
		$this->set('_serialize', 'result');
	}
}
