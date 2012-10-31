<?php
App::uses('AppController', 'Controller');
/**
 * Elections Controller
 *
 * @property Election $Election
 */
class ElectionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Election->recursive = 0;
		$this->set('elections', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Election->id = $id;
		if (!$this->Election->exists()) {
			throw new NotFoundException(__('Invalid election'));
		}
		$this->set('election', $this->Election->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Election->create();
			if ($this->Election->save($this->request->data)) {
				$this->Session->setFlash(__('The election has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The election could not be saved. Please, try again.'));
			}
		}
		$constituencies = $this->Election->Constituency->find('list');
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
		$this->Election->id = $id;
		if (!$this->Election->exists()) {
			throw new NotFoundException(__('Invalid election'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Election->save($this->request->data)) {
				$this->Session->setFlash(__('The election has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The election could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Election->read(null, $id);
		}
		$constituencies = $this->Election->Constituency->find('list');
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
		$this->Election->id = $id;
		if (!$this->Election->exists()) {
			throw new NotFoundException(__('Invalid election'));
		}
		if ($this->Election->delete()) {
			$this->Session->setFlash(__('Election deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Election was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * listByConstituency method
 *
 * @param int $id
 * @return void
 */
	public function listByConstituency($id) {
		$this->layout = 'ajax';
		$data = $this->Election->find('all',array('conditions' => array('Election.constituency_id = '=>$id)));
		$this->set('elections', $data);
	}
	
	public function load($id=null) {
		$this->layout='ajax';
		$this->Election->id = $id;
		$this->loadModel('Office');
		$this->loadModel('Candidate');
		$candidate = $this->Candidate->find('first',array('conditions'=>array('Candidate.election_id = ' => $id, 'Candidate.user_id = '=>$this->_currentUser['User']['id'])));
		if($candidate) {
			$candidate = $candidate['Candidate']['office_id'];
		}
		else {
			$candidate = false;
		}
		if (!$this->Election->exists()) {
			throw new NotFoundException(__('Invalid election'));
		}
		$election = $this->Election->read(null, $id);
		$data = array(
			"description"=>$election['Election']['description'],
			"moderate"=>$election['Election']['user_id']==$this->_currentUser['User']['id'] ? true : false,
			"offices"=>$this->Office->find('all',array('conditions' => array('Office.election_id = '=>$id))),
			"run" =>  $candidate
		);
		$this->set('election', $data);
	}
}
