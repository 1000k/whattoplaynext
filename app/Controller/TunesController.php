<?php
App::uses('AppController', 'Controller');
/**
 * Tunes Controller
 *
 * @property Tune $Tune
 */
class TunesController extends AppController {
	public $components = ['RequestHandler'];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->_setBooks();
	}

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
		$tune = $this->Tune->findById($id);

		$this->set([
			'tune' => $tune,
			'title_for_layout' => $tune['Tune']['name'] . ' | What to Play Next?'
		]);

		if ($this->RequestHandler->isAjax()) {
			$this->set('_serialize', 'tune');
			return true;
		}
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
