<?php
App::uses('AppController', 'Controller');
/**
 * Offices Controller
 *
 * @property Office $Office
 */
class OfficesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Office->recursive = 0;
		$this->set('offices', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Office->id = $id;
		if (!$this->Office->exists()) {
			throw new NotFoundException(__('Invalid office'));
		}
		$this->set('office', $this->Office->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Office->create();
			if ($this->Office->save($this->request->data)) {
				$this->Session->setFlash(__('The office has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The office could not be saved. Please, try again.'));
			}
		}
		$constituencies = $this->Office->Constituency->find('list');
		$this->set(compact('constituencies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Office->id = $id;
		if (!$this->Office->exists()) {
			throw new NotFoundException(__('Invalid office'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Office->save($this->request->data)) {
				$this->Session->setFlash(__('The office has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The office could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Office->read(null, $id);
		}
		$constituencies = $this->Office->Constituency->find('list');
		$this->set(compact('constituencies'));
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
		$this->Office->id = $id;
		if (!$this->Office->exists()) {
			throw new NotFoundException(__('Invalid office'));
		}
		if ($this->Office->delete()) {
			$this->Session->setFlash(__('Office deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Office was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
