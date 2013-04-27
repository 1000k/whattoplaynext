<?php
App::uses('AppModel', 'Model');
/**
 * Tune Model
 *
 * @property Sample $Sample
 * @property Book $Book
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Sample' => array(
			'className' => 'Sample',
			'foreignKey' => 'tune_id',
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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className' => 'Book',
			'joinTable' => 'books_tunes',
			'foreignKey' => 'tune_id',
			'associationForeignKey' => 'book_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

/**
 * Picks up Tune.id randomly.
 *
 * @return integer Tune.id
 */
	public function random() {
		$max = $this->find('first', [
			'fields' => ['MAX(Tune.id) as max_id'],
		]);
		return rand(1, $max[0]['max_id']);
	}

/**
 * Get Tune.id by tune name.
 *
 * @param string $name
 * @return mixed Tune.id if found. False if not found.
 */
	public function getIdByName($name) {
		$record = $this->findByName($name);
		return isset($record['Tune']['id']) ? $record['Tune']['id'] : false;
	}
}
