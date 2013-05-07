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
		$books = $this->Tune->Book->find('list');

		$result = [
			'tune' => $tune,
			'books' => $books,
			'title_for_layout' => $tune['Tune']['name']
		];
		$this->set('result', $result);
		$this->set('_serialize', 'result');
	}

	public function next() {
		$enabled_books = isset($this->request->data['enabled_books']) ? $this->request->data['enabled_books'] : null;

		if ($this->RequestHandler->isAjax()) {
			$tune_id = $this->Tune->getIdAtRandom($enabled_books);
			$result = $this->Tune->findById($tune_id);

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
