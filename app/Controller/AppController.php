<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
// app import was working before, not sure why its not any more, switched to require_once
//App::import('Vendor', 'facebook/facebook');
require_once(APP . 'Vendor/facebook/facebook.php');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	/**
	 * Holds instance of facebook sdk object
	 *
	 * @var Facebook
	 */
	protected $_facebook = null;
	
	/**
	 * Current user data
	 *
	 * @var array
	 */
	protected $_currentUser = null;
	
	/**
	 * Required Models
	 *
	 * @var array
	 */
	public $uses = array('User');

    public $helpers = array("Html", "Form", "TwitterBootstrap.TwitterBootstrap");
	
	/**
	 * Initialize common controller data
	 */
	public function beforeFilter() {
		// Initialize User Data
		// note: temporarily adding this to prevent errors for developers not using FB yet
		if ($_SERVER['SERVER_ADDR'] == '50.76.92.83') {
			$this->_initUser();
		}
	}
	
	/**
	 * Initialize user data
	 * 
	 * @author khoople
	 */
	private function _initUser() {
		$this->_initFacebook();
		$facebookId = $this->_facebook->getUser();
		
		// If can't get facebook uid, they must accept the app and/or login
		if (!$facebookId) {
			$this->_redirectToLoginUrl();
		}
		
		$user = $this->User->findByFacebookId($facebookId);
		
		if ($user) {
			$this->_currentUser = $user;
		} else {
			$this->_currentUser = $this->_createUser($facebookId);
		}
		
		$this->set('currentUser', $this->_currentUser);
	}
	
	/**
	 * Initialize facebook
	 * 
	 * @author khoople
	 */
	private function _initFacebook() {
		if (!$this->_facebook) {
			Configure::load('facebook', 'default');
			$options = Configure::read('Facebook');
			
			$this->_facebook = new Facebook($options);
		}
	}
	
	/**
	 * Create a new user and return user data.  This is basically to cache facebook data.
	 * 
	 * TODO: Need error trapping here badly
	 *
	 * @author khoople
	 * 
	 * @param int $facebookId
	 * @return array
	 */
	private function _createUser($facebookId){
		$me = $this->_facebook->api('/me', 'GET', array(
			'fields' => 'id,name,username,picture'		
		)); 
		
		$data['User'] = array(
			'name'        => $me['name'],
			'image'       => $me['picture']['data']['url'],
			'facebook_id' => $me['id']
		);
		
		// Create the new user
		$this->User->Save($data);
		
		// Populate ID into data
		$data['User']['id'] = $this->User->id;
		
		return $data;
	}
	
	/**
	 * Redirect user to the page where they grant access to our facebook app.
	 * 
	 * This uses javascript because it seems to be the only way.  Header redirect
	 * does NOT work.
	 * 
	 * @author khoople
	 */
	private function _redirectToLoginUrl() {
		$url = $this->_facebook->getLoginUrl(array(
			'canvas'       => 1,
			'fbconnect'    => 0,
			'redirect_uri' => 'http://apps.facebook.com/' . $this->_facebook->getAppId(),
			'prev'         => 'http://www.facebook.com'
		));
		echo "<script>top.location.href='$url';</script>";
		exit();
	}
}

