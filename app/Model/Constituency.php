<?php
App::uses('AppModel', 'Model');
/**
 * Constituency Model
 *
 * @property Constituency $ParentConstituency
 * @property Constituency $ChildConstituency
 * @property Constituent $Constituent
 * @property Election $Election
 * @property Office $Office
 */
class Constituency extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Define Tree Behavior
 *
 */
        public $actsAs = array('Tree');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentConstituency' => array(
			'className' => 'Constituency',
			'foreignKey' => 'parent_id',
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
		'ChildConstituency' => array(
			'className' => 'Constituency',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Constituent' => array(
			'className' => 'Constituent',
			'foreignKey' => 'constituency_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Election' => array(
			'className' => 'Election',
			'foreignKey' => 'constituency_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Office' => array(
			'className' => 'Office',
			'foreignKey' => 'constituency_id',
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
	
	/**
	 * Finds a constituency matching the term by name
	 *
	 * TODO: Cache me.  For now this is probably faster than querying by name field every time.
	 * 
	 * @param string $term
	 */
	public function search($term) {
		$term = trim($term);
		$constituencies = $this->find('all', array(
			'fields' => array('id', 'name'),
			'recursive' => -1
		));
		$results = array();
		foreach ($constituencies as $c) {
			if (false !== strpos($c['Constituency']['name'], $term)) {
				$results[] = array(
					'label' => $c['Constituency']['name'],
					'value' => $c['Constituency']['id']
				);
			}
		}
		
		return $results;
	}

}
