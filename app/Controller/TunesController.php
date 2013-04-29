<?php
App::uses('AppController', 'Controller');
/**
 * Tunes Controller
 *
 * @property Tune $Tune
 */
class TunesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	// public function index() {
	// 	$this->Tune->recursive = 0;
	// 	$this->set('tunes', $this->paginate());
	// }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tune->exists($id)) {
			throw new NotFoundException(__('Invalid tune'));
		}
		$options = [
			'conditions' => ['Tune.' . $this->Tune->primaryKey => $id]
		];
		$tune = $this->Tune->find('first', $options);
		$this->set([
			'tune' => $tune,
			'books' => $this->Tune->Book->find('list'),
			'title_for_layout' => $tune['Tune']['name']
		]);
	}

	public function next() {
		return $this->redirect(['controller' => 'tunes', 'action' => 'view', $this->Tune->random()]);
	}
}
