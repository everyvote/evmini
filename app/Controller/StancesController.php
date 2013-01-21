<?php
App::uses('AppController', 'Controller');
/**
 * Stances Controller
 *
 * @property Stance $Stance
 */
class StancesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Stance->recursive = 0;
		$this->set('stances', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Stance->id = $id;
		if (!$this->Stance->exists()) {
			throw new NotFoundException(__('Invalid stance'));
		}
		$this->set('stance', $this->Stance->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Stance->create();
			if ($this->Stance->save($this->request->data)) {
				$this->Session->setFlash(__('The stance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stance could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Stance->id = $id;
		if (!$this->Stance->exists()) {
			throw new NotFoundException(__('Invalid stance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Stance->save($this->request->data)) {
				$this->Session->setFlash(__('The stance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stance could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Stance->read(null, $id);
		}
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
		$this->Stance->id = $id;
		if (!$this->Stance->exists()) {
			throw new NotFoundException(__('Invalid stance'));
		}
		if ($this->Stance->delete()) {
			$this->Session->setFlash(__('Stance deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Stance was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
