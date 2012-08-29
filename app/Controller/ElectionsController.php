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
		var_dump($this->Election->find('all'));

	}

}
