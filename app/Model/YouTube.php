<?php
App::uses('AppModel', 'Model');
/**
 * YouTube Model
 */
class YouTube extends AppModel {
	public $useDbConfig = 'youtube';

	public $thumbnail_dir = null;

/**
 * Stores information of sample into 'Samples' table.
 *
 * @param int $tune_id
 * @param array $opts [videoId, title, thumbnail] is needed
 * @return bool true if successful
 */
	public function store($tune_id, $opts) {
		if (!$this->thumbnail_dir) {
			$this->thumbnail_dir = IMAGES . 'samples';
		}

		var_dump($this->thumbnail_dir);

		$this->downloadThumbnail($opts['thumbnail']);

		return true;
	}

	protected function downloadThumbnail($url) {
		var_dump($this->thumbnail_dir . DS . "DUMMY1234.jpg");
		touch($this->thumbnail_dir . DS . "DUMMY1234.jpg");
		return true;
	}

	protected function uso() {
		return false;
	}
}