<?php
App::uses('AppModel', 'Model');
/**
 * Constituent Model
 *
 * @property User $User
 * @property Constituency $Constituency
 */
class Constituent extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Constituency' => array(
			'className' => 'Constituency',
			'foreignKey' => 'constituency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
