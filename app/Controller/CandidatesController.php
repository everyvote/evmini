<?php
App::uses('AppController', 'Controller');
/**
 * Candidates Controller
 *
 * @property Candidate $Candidate
 */
class CandidatesController extends AppController {

    public $helpers = array("Html", "Form", "Partials.Partial");

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Candidate->recursive = 0;
		$this->set('candidates', $this->paginate());

        //Get associated votes and comments to display
        $this->loadModel('Vote');
        $this->loadModel('Comment');

        //TODO: Grab votes and comments. Do a count of pos / neg votes as well as comments.

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

    //Check this out: http://book.cakephp.org/2.0/en/models/retrieving-your-data.html

	public function view($id = null) {
		$this->Candidate->id = $id;
		if (!$this->Candidate->exists()) {
			throw new NotFoundException(__('Invalid candidate'));
		}
		$this->set('candidate', $this->Candidate->read(null, $id));

        //Get associated votes and comments to display
        $this->loadModel('Vote');
        $this->loadModel('Comment');

        $this->set('votes', $this->Vote->findAllById($id));
        $this->set('comments', $this->Vote->findAllByCandidacyId($id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Candidate->create();
			if ($this->Candidate->save($this->request->data)) {
				$this->Session->setFlash(__('The candidate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The candidate could not be saved. Please, try again.'));
			}
		}
		$users = $this->Candidate->User->find('list');
		$elections = $this->Candidate->Election->find('list');
		$offices = $this->Candidate->Office->find('list');
		$this->set(compact('users', 'elections', 'offices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Candidate->id = $id;
		if (!$this->Candidate->exists()) {
			throw new NotFoundException(__('Invalid candidate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Candidate->save($this->request->data)) {
				$this->Session->setFlash(__('The candidate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The candidate could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Candidate->read(null, $id);
		}
		$users = $this->Candidate->User->find('list');
		$elections = $this->Candidate->Election->find('list');
		$offices = $this->Candidate->Office->find('list');
		$this->set(compact('users', 'elections', 'offices'));
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
		$this->Candidate->id = $id;
		if (!$this->Candidate->exists()) {
			throw new NotFoundException(__('Invalid candidate'));
		}
		if ($this->Candidate->delete()) {
			$this->Session->setFlash(__('Candidate deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Candidate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
