<?php
App::uses('AppModel', 'Model');
/**
 * YouTube Model
 */
class YouTube extends AppModel {
	public $useDbConfig = 'youtube';

/**
 * Stores information of sample into 'Samples' table.
 *
 * @param int $tune_id
 * @param array $opts [videoId, title, thumbnail] is needed
 * @return bool true if successful
 */
	public function store($tune_id, $opts) {
		return true;
	}
}