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
 * If $enabled_books is given, this function will select tunes from only that.
 *
 * @param array $enabled_books Book ids to search. (If not given, search from all books)
 * @return integer Tune.id
 */
	public function getIdAtRandom($enabled_books = null) {
		$options = [
			'fields' => ['BooksTune.tune_id'],
			'recursive' => 0
		];

		if ($enabled_books) {
			$options += ['conditions' => ['BooksTune.book_id' => $enabled_books]];
		}
		
		$ids = $this->BooksTune->find('list', $options);
		
		return $ids[array_rand($ids, 1)];
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
