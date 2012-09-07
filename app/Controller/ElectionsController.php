<?php
App::uses('AppController', 'Controller');
/**
 * Elections Controller
 *
 */
class ElectionsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public function index() { 
		$this->set('elections', $this->Election->find('all'));
	}

}
