<?php
App::uses('AppModel', 'Model');
/**
 * Tune Model
 *
 */
class Tune extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
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

	public function random() {
		$max = $this->find('first', [
			'fields' => ['MAX(Tune.id) as max_id'],
		]);
		return rand(1, $max[0]['max_id']);
	}
}