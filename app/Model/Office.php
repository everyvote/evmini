<?php
App::uses('AppModel', 'Model');
/**
 * Office Model
 *
 * @property Constituency $Constituency
 * @property Candidacy $Candidacy
 */
class Office extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Constituency' => array(
			'className' => 'Constituency',
			'foreignKey' => 'constituency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Candidacy' => array(
			'className' => 'Candidacy',
			'foreignKey' => 'office_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
