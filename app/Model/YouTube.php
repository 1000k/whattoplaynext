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
 * @param array $opts [videoId, title, thumbnailUrl] is needed
 * @return bool true if successful
 */
	public function store($tune_id, $opts) {
		$this->downloadThumbnail($opts['thumbnailUrl'], $opts['videoId']);

		return true;
	}

/**
 * Download thumbnail from the given url.
 *
 * @param string $url
 * @param string $video_id
 * @return mixed Bytes of written size if successful. False if something wrong.
 */
	public function downloadThumbnail($url, $video_id) {
		if (!$this->thumbnail_dir) {
			$this->thumbnail_dir = IMAGES . 'samples';
		}

		$file = $this->download($url);

		if (!$file) {
			return false;
		}

		return file_put_contents("{$this->thumbnail_dir}/{$video_id}.jpg", $file);
	}

	protected function download($url) {
		return file_get_contents($url);
	}

}