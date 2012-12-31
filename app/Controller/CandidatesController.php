<?php

App::uses('AppController', 'Controller');

/**
 * Candidates Controller
 *
 * @property Candidate $Candidate
 */
class CandidatesController extends AppController {

    public $helpers = array("Html", "Form", "Partials.Partial", "EvText");

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

    public function view($id = null, $electionID = null) {
        $this->Candidate->id = $id;
        if (!$this->Candidate->exists()) {
            throw new NotFoundException(__('Invalid candidate'));
        }
        $candidate = $this->Candidate->read(null, $id);
        $constituancy = $this->Candidate->Election->find('first', array('id' => $candidate['Candidate']['election_id']));

        $this->showBack = TRUE;
        //Get associated votes and comments to display
        $this->loadModel('Vote');
        $this->loadModel('Comment');

        $votes = array(
            'positive' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $id, 'Vote.stances_id = ' => 1))),
            'negative' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $id, 'Vote.stances_id = ' => 3))),
            'casted' => $this->Vote->find('first', array('conditions' => array('Vote.candidacy_id = ' => $id, 'Vote.user_id = ' => $this->_currentUser['User']['id'])))
        );

        // Get all votes
        $all_votes = $this->Vote->findAllByCandidacyId($id);

        // Get comments
        $this->Comment->order = 'Comment.date DESC';
        $comments = $this->Comment->findAllByCandidacyId($id);

        // Get all the elections for this user.
        $allConstituencies = $this->Candidate->find('all', array('conditions' => array('Candidate.user_id' => $this->_currentUser['User']['id']),
            'recursive' => 2));

        $this->set(compact('candidate', 'votes', 'all_votes', 'allConstituencies','electionID', 'comments'));

        //$this->Session->write('electionID', $candidate['Candidate']['election_id']);
        //$this->Session->write('constituentID', $constituancy['Constituency']['id']);
        //$this->Session->write('officeID', $candidate['Candidate']['office_id']);
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

    public function listByElection($id, $filter = 0, $sorting = 0) {
        $this->layout = 'ajax';
        $data = array();
        $this->loadModel('Vote');
        $conditions[] = array('Candidate.election_id = ' => $id);

        if ($filter != 0) :
            $conditions[] = array('Office.id' => $filter);
        endif;

        $order = array('Election.startdate');
        if ($sorting == '2'):
            $order = array('User.name');
        endif;
        foreach ($this->Candidate->find('all', array('conditions' => $conditions, 'order' => $order)) as $candidate) {
            $votes = array('Votes' => array(
                    'positive' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $candidate['Candidate']['id'], 'Vote.stances_id = ' => 1))),
                    'negative' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $candidate['Candidate']['id'], 'Vote.stances_id = ' => 3))),
                    'casted' => $this->Vote->find('first', array('conditions' => array('Vote.candidacy_id = ' => $candidate['Candidate']['id'], 'Vote.user_id = ' => $this->_currentUser['User']['id'])))
                    ));
            $data[] = array_merge($candidate, $votes);
        }

        // Sorting to work around db design issues

        if ($sorting == 3 || $sorting == 4) :
            $sortedCandidates = array();
            $cnt = 1;
                foreach ($data as $sorted) :
                    if ($sorting == 3 ) :
                        $sortedCandidates[$sorted['Votes']['positive'] . "." . $cnt] = $sorted;
                    else:
                        $sortedCandidates[$sorted['Votes']['negative'] . "." . $cnt] = $sorted;
                    endif;
                    $cnt++;
                endforeach;
            krsort($sortedCandidates);
            $data = $sortedCandidates;
        endif;

        $this->set('candidates', $data);
    }

    function editAbout($id = null) {
        $this->layout = 'ajax';
        $this->Candidate->id = $id;
        $this->Candidate->save(array('about_text' => $_POST['description']));

        return true;
    }

    public function run($id) {
        $this->layout = 'ajax';
        $this->loadModel('Office');
        $office = $this->Office->read(null,$id);

        $data['user_id'] = $this->_currentUser['User']['id'];
        $data['office_id'] = $id;
        $data['about_text'] = $_POST["description"];
        $data['election_id'] = $office['Office']['election_id'];

        $this->Candidate->Save($data);
    }

    public function leave($id) {
        $this->layout = 'ajax';
        $this->loadModel('Vote');
        $this->Vote->deleteAll(array('Candidacy.user_id = '=>$this->_currentUser['User']['id']),false);
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

    public function addComment() {
        if ($this->request->is('post')) {
            $this->loadModel('Comment');
            $this->Comment->create();
            $comment['Comment'] = array(
               'user_id' => $this->_currentUser['User']['id'],
               'candidacy_id' => $this->request->data('candidate_id'),
               'body' => $this->request->data('comment'),
               'date' => date('Y-m-d H:i:s')
            );
            $this->Comment->save($comment);
        }
        $this->redirect(array('controller' => 'candidates', 'action' => 'view', $this->request->data('candidate_id'), $this->request->data('election_id')));
        exit();
    }
}
