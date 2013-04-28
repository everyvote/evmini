<?php

App::uses('AppController', 'Controller');

/**
 * Votes Controller
 *
 * @property Vote $Vote
 */
class VotesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Vote->recursive = 0;
        $this->set('votes', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Vote->id = $id;
        if (!$this->Vote->exists()) {
            throw new NotFoundException(__('Invalid vote'));
        }
        $this->set('vote', $this->Vote->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Vote->create();
            if ($this->Vote->save($this->request->data)) {
                $this->Session->setFlash(__('The vote has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
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
        $this->Vote->id = $id;
        if (!$this->Vote->exists()) {
            throw new NotFoundException(__('Invalid vote'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Vote->save($this->request->data)) {
                $this->Session->setFlash(__('The vote has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Vote->read(null, $id);
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
        $this->Vote->id = $id;
        if (!$this->Vote->exists()) {
            throw new NotFoundException(__('Invalid vote'));
        }
        if ($this->Vote->delete()) {
            $this->Session->setFlash(__('Vote deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Vote was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function cast($candidate, $stance) {
        $this->layout = 'ajax';

        $data['user_id'] = $this->_currentUser['User']['id'];
        $data['candidacy_id'] = $candidate;
        $data['stances_id'] = $stance;
        $data['added'] = date('Y-m-d h:i:s');

        $votes = $this->Vote->find('first', array('conditions' => array('Vote.user_id' => $this->_currentUser['User']['id'],
                'Vote.candidacy_id' => $candidate)));
        if (!empty($votes)) :
            $this->Vote->delete($votes['Vote']['id']);
        else:
            $this->Vote->Save($data);
            // Send notification
            $this->notifyCandidate($candidate, ($stance == 1) ? "Supports" : "Opposes");
        endif;

        $votes = array('Votes' => array(
                'positive' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $candidate, 'Vote.stances_id = ' => 1))),
                'neutral' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $candidate, 'Vote.stances_id = ' => 2))),
                'negative' => $this->Vote->find('count', array('conditions' => array('Vote.candidacy_id = ' => $candidate, 'Vote.stances_id = ' => 3)))
                ));

        $this->set('votes', $votes);
    }

}
