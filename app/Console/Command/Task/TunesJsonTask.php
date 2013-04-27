<?php
class TunesJsonTask extends Shell {
	public $uses = false;

/**
 * Load `tunes.json`.
 *
 * @return array Decoded `tunes.json`
 */
	public function load() {
		$data_json = file_get_contents(APPLIBS . '/tunes.json');

		if ($data_json === false) {
			$this->error('Failed to read json file.');
		}

		if (($data = json_decode($data_json)) === false) {
			$this->error('Failed to parse json.');
		}

		return $data;
	}
}