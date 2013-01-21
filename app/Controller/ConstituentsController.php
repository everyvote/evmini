<?php
App::uses('AppController', 'Controller');
/**
 * Constituents Controller
 *
 * @property Constituent $Constituent
 */
class ConstituentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Constituent->recursive = 0;
		$this->set('constituents', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Constituent->id = $id;
		if (!$this->Constituent->exists()) {
			throw new NotFoundException(__('Invalid constituent'));
		}
		$this->set('constituent', $this->Constituent->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Constituent->create();
			if ($this->Constituent->save($this->request->data)) {
				$this->Session->setFlash(__('The constituent has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The constituent could not be saved. Please, try again.'));
			}
		}
		$constituencies = $this->Constituent->Constituency->find('list');
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
		$this->Constituent->id = $id;
		if (!$this->Constituent->exists()) {
			throw new NotFoundException(__('Invalid constituent'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Constituent->save($this->request->data)) {
				$this->Session->setFlash(__('The constituent has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The constituent could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Constituent->read(null, $id);
		}
		$constituencies = $this->Constituent->Constituency->find('list');
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
		$this->Constituent->id = $id;
		if (!$this->Constituent->exists()) {
			throw new NotFoundException(__('Invalid constituent'));
		}
		if ($this->Constituent->delete()) {
			$this->Session->setFlash(__('Constituent deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Constituent was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
