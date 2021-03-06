<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Constituencies Controller
 *
 * @property Constituency $Constituency
 */
class ConstituenciesController extends AppController {

    var $uses = array('Candidate', 'Constituency');
    
    public $helpers = array("Html", "Form", "TwitterBootstrap.TwitterBootstrap", "EvForm");

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $callback = $this->referer(null, true);
        $electionID = 0;
        $constituentID = 0;
        $officeID = 0;
        $this->Constituency->recursive = 0;
        
        $data = $this->Constituency->find('list', array('fields' =>	array('id', 'name') )    ); 

        $this->set('constituencies', $data);

        $allConstituencies = $this->Candidate->find('all', array('conditions' => array('Candidate.user_id' => $this->_currentUser['User']['id']),
                'recursive' => 2));

        $this->set(compact('allConstituencies'));
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


    public function loadLogo($id = null) {
        $this->layout='ajax';
        $this->Constituency->id = $id;
        if (!$this->Constituency->exists()) {
            throw new NotFoundException(__('Invalid constituency'));
        }
        $this->set('constituency', $this->Constituency->read(null, $id));
    }
    
    public function contact () {
    
        //$adminEmail = Configure::read('contactEmail');
        $adminEmail = 'contactus@everyvote.org';
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        } else {
            $contactData = $this->request->data;
            
            $email = new CakeEmail();
            $email->viewVars(array('university' => $contactData['university'], 'msg' => $contactData['message'], 'email' =>$contactData['email'], 'name' => $contactData['name']));
            $email->template('default')
                    ->emailFormat('html');
            $email->to($adminEmail)
                  ->subject($contactData['university'])
                  ->from($contactData['email'])
                  ->send();
                  
    
        }
        return;
    }
}
