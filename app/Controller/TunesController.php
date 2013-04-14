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
		$options = array('conditions' => array('Tune.' . $this->Tune->primaryKey => $id));
		$this->set('tune', $this->Tune->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	// public function add() {
	// 	if ($this->request->is('post')) {
	// 		$this->Tune->create();
	// 		if ($this->Tune->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The tune has been saved'));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The tune could not be saved. Please, try again.'));
	// 		}
	// 	}
	// }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	// public function edit($id = null) {
	// 	if (!$this->Tune->exists($id)) {
	// 		throw new NotFoundException(__('Invalid tune'));
	// 	}
	// 	if ($this->request->is('post') || $this->request->is('put')) {
	// 		if ($this->Tune->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The tune has been saved'));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The tune could not be saved. Please, try again.'));
	// 		}
	// 	} else {
	// 		$options = array('conditions' => array('Tune.' . $this->Tune->primaryKey => $id));
	// 		$this->request->data = $this->Tune->find('first', $options);
	// 	}
	// }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tune->id = $id;
		if (!$this->Tune->exists()) {
			throw new NotFoundException(__('Invalid tune'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tune->delete()) {
			$this->Session->setFlash(__('Tune deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tune was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function next() {
		return $this->redirect(['controller' => 'tunes', 'action' => 'view', $this->Tune->random()]);
	}
}
