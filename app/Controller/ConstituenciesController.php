<?php
App::uses('AppController', 'Controller');
/**
 * Constituencies Controller
 *
 * @property Constituency $Constituency
 */
class ConstituenciesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Constituency->recursive = 0;
		$this->set('constituencies', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Constituency->id = $id;
		if (!$this->Constituency->exists()) {
			throw new NotFoundException(__('Invalid constituency'));
		}
		$this->set('constituency', $this->Constituency->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Constituency->create();
			if ($this->Constituency->save($this->request->data)) {
				$this->Session->setFlash(__('The constituency has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The constituency could not be saved. Please, try again.'));
			}
		}
		$parentConstituencies = $this->Constituency->ParentConstituency->find('list');
		$this->set(compact('parentConstituencies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Constituency->id = $id;
		if (!$this->Constituency->exists()) {
			throw new NotFoundException(__('Invalid constituency'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Constituency->save($this->request->data)) {
				$this->Session->setFlash(__('The constituency has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The constituency could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Constituency->read(null, $id);
		}
		$parentConstituencies = $this->Constituency->ParentConstituency->find('list');
		$this->set(compact('parentConstituencies'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Constituency->id = $id;
		if (!$this->Constituency->exists()) {
			throw new NotFoundException(__('Invalid constituency'));
		}
		if ($this->Constituency->delete()) {
			$this->Session->setFlash(__('Constituency deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Constituency was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
