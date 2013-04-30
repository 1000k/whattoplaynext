<?php
App::uses('AppController', 'Controller');
/**
 * Tunes Controller
 *
 * @property Tune $Tune
 */
class TunesController extends AppController {
	public $components = ['RequestHandler'];
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
		$enabled_books = isset($this->request->data['enabled_books']) ? $this->request->data['enabled_books'] : null;

		if ($this->RequestHandler->isAjax()) {
			$result = $this->Tune->getIdAtRandom($enabled_books);

			$this->set('result', $result);
			$this->set('_serialize', 'result');

			return $result;
		}

		// return true;
		return $this->redirect([
			'controller' => 'tunes',
			'action' => 'view',
			$this->Tune->getIdAtRandom($enabled_books)
		]);
	}
}
