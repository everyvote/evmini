<?php
App::uses('AppModel', 'Model');
/**
 * Stance Model
 *
 */
class Stance extends AppModel {

/**
 * Validation rules
 *
 * @var array
 * ouiyhiuyghiuygiuygiuyg
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
