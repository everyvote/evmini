<?php
App::uses('AppController', 'Controller');
/**
 * Constituencies Controller
 *
 */
class ConstituenciesController extends AppController {
	var $components = array('RequestHandler');
/**
 * Scaffold
 *
 * @var mixed
 */
    public function index() {
        
        
    }

	public function search() {
		$constituencies = array();
		if (!empty($this->request->query['term'])) {
			$constituencies = $this->Constituency->search($this->request->query['term']);
		}
		echo json_encode($constituencies);
		exit();
	}

}
