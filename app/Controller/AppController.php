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

    public $components = array('Session');
    private $facebook;
        public $showBack = FALSE;
    /**
     * Initialize common controller data
     */
    public function beforeFilter() {
        // Initialize User Data
        $this->_initUser();
    }

        public function beforeRender() {
            parent::beforeRender();
			
			
			// The following is a constant that represents a kind of constituency.
			// Could be university, town, government, club, etc.
			// Keep 'em lowercase and unpluralized for use.
        	$this->set('CONSTITUENCY', "university");
			
			
            $this->set('back', $this->showBack);

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

                //CPB
        if (!$facebookId) {
            $this->_redirectToLoginUrl();
        } else {
            // make sure the user is still logged in
            try {
                $me = $this->_facebook->api('/me');
                if ($me) {
                    //User is logged in
                }
            } catch (FacebookApiException $e) {
                //User is not logged in
                $this->_redirectToLoginUrl();
            }
            
        }
        
        $this->loadModel('User');

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
        App::import('Vendor', 'facebook');
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
            'fields' => 'id,name,username'
        ));
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,
            "http://graph.facebook.com/$facebookId/picture?type=large");

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);

        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);

        $data['User'] = array(
            'name'        => $me['name'],
            'image'       => $url,
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
            'redirect_uri' => 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'),
            'prev'         => 'http://www.facebook.com',
            'scope'        => 'user_about_me,publish_stream'
        ));
        echo "<script>top.location.href='$url';</script>";
        exit();
    }
	
	
	/**
	 * sendJson
	 * Serializes $content into json and sends it out.
	 * 
	 * @param $content
	 */
	protected function sendJSON($response)
	{
		Configure::write('debug', 2);
		
		$this->set('response', $response);
		
		$this->layout = '';
		
		$this->render('/Layouts/json');
		
	}
	
	/**
	 * selectorJSON
	 * 
	 * This is a dynamic view that returns the coorisponding
	 * model's {[id:name]} fields for use in a jQuery Autocomplete.
	 * 
	 * This may need to be overidden if the model doesn't have the name field.
	 * 
	 */
	public function selectorJSON() {
		
		// Obtain the model we're working with based on the controller name.
		$modelName = Inflector::singularize($this->name);
		$model = $this->$modelName;
		
		// Need to handle empty $_GET conditions
		$term = "";
		if (isset($_GET)  && !empty($_GET['term'])) :
		  $term = $_GET['term'];
        endif;
		
		// Obtain a simple list of {id:name}
		$places = $model->find('list', array('conditions' => array($modelName.".name LIKE" => "%".$term."%"),
													      'recursive' => 0, 'limit' => 10));
		
		$json = array();
		
		// Translate the model's output for jQuery Autocomplete
		foreach ($places as $key => $p) {
			
			$pair = new Object();
			
			$pair->id = $key;
			$pair->label = $p;
			$json[] = $pair;
			
		}
		
		
		// FIRE!
		$this->sendJson(json_encode($json));
		
	}
	
	
}

