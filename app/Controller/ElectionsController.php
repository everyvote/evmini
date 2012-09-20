<?php
App::uses('AppController', 'Controller');
/**
 * Elections Controller
 *
 */
class ElectionsController extends AppController {
    var $components = array('RequestHandler');
/**
 * Scaffold
 *
 * @var mixed
 */
	public function index() { 
		$this->set('elections', $this->Election->find('all'));
	}
	
	public function find() {
	    // incomplete
	    $constituencyId = $this->request->query['constituency_id'];
		$elections = $this->Election->findAllByConstituencyId($constituencyId);
		echo json_encode($elections);
		exit();
	}

}
