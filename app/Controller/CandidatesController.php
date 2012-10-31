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
		
		$votes = array(
				'positive'=>$this->Vote->find('count',array('conditions'=>array('Vote.candidacy_id = '=>$id, 'Vote.stances_id = ' => 1))),
				'negative'=>$this->Vote->find('count',array('conditions'=>array('Vote.candidacy_id = '=>$id, 'Vote.stances_id = ' => 3))),
				'casted'=>$this->Vote->find('first',array('conditions'=>array('Vote.candidacy_id = '=>$id, 'Vote.user_id = ' => $this->_currentUser['User']['id'])))
			);
        $this->set('votes', $votes);
		$this->set('all_votes', $this->Vote->findAllByCandidacyId($id));
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
	
	
	public function listByElection($id,$filter=0,$sorting=0) {
		$this->layout = 'ajax';
		$data = array();
		$this->loadModel('Vote');
		foreach($this->Candidate->find('all',array('conditions' => array('Candidate.election_id = '=>$id))) as $candidate) {
			$votes = array('Votes'=>array(
				'positive'=>$this->Vote->find('count',array('conditions'=>array('Vote.candidacy_id = '=>$candidate['Candidate']['id'], 'Vote.stances_id = ' => 1))),
				'negative'=>$this->Vote->find('count',array('conditions'=>array('Vote.candidacy_id = '=>$candidate['Candidate']['id'], 'Vote.stances_id = ' => 3))),
				'casted'=>$this->Vote->find('first',array('conditions'=>array('Vote.candidacy_id = '=>$candidate['Candidate']['id'], 'Vote.user_id = ' => $this->_currentUser['User']['id'])))
			));
			$data[] = array_merge($candidate, $votes);
		}
		$this->set('candidates', $data);
	}
	
	
	public function run($id) {
		$this->layout = 'ajax';
		$this->loadModel('Office');
		$office = $this->Office->read(null,$id);
		
		$data['user_id'] = $this->_currentUser['User']['id'];
		$data['office_id'] = $id;
		$data['about_text'] = mysql_escape_string($_POST["description"]);
		$data['election_id'] = $office['Office']['election_id'];
		
		$this->Candidate->Save($data);
	}
	
	public function leave($id) {
		$this->layout = 'ajax';
		$this->loadModel('Vote');
		$this->Vote->deleteAll(array('candidacy_id = '=>$this->_currentUser['User']['id']),false);
		$this->Candidate->deleteAll(array('Candidate.office_id = ' => $id, 'Candidate.user_id = '=>$this->_currentUser['User']['id']),false);
	}

	public function post($id) {
		$this->layout='ajax';
		$candidate = $this->Candidate->read(null,$id);
		$post_data = array(
        	'link' => "http://apps.facebook.com/483074268393372/candidates/view/".$id,
        	'message'=> $candidate['User']['name']." running for ".$candidate['Office']['name'],
        	'name' => $candidate['User']['name']." running for ".$candidate['Office']['name'],
        	'picture' => $candidate['User']['image'],
        	'description' => $candidate['Candidate']['about_text']
    	);
		try {
		  $this->_facebook->api('/me/feed','POST',$post_data);
		} catch(FacebookApiException $e) {
		  $e_type = $e->getType();
		  debug('Error: ' . $e_type);
		}
	}
	
}
