<?php
App::uses('Shell', 'Console');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class GenerateDataShell extends AppShell {
	public $uses = ['Book', 'BooksTune', 'Tune'];

	public function main() {
		$this->out('Usage: cake generatedata generate');
	}

	public function generate() {
		$data_json = file_get_contents(APPLIBS . '/tunes.json');
		if ($data_json === false) {
			$this->exitError('Failed to read json file.');
		}

		if (($data = json_decode($data_json)) === false) {
			$this->exitError('Failed to parse json.');
		}

		$this->clearTables();

		foreach ($data as $book => $contents) {
			$this->Book->create([
				'name' => $book,
				'image_path' => $contents->image_path,
				'url_amazon' => $contents->url_amazon,
				'url_amazon_conversion_image' => $contents->url_amazon_conversion_image
			]);

			if (!$this->Book->save()) {
				$this->exitError("Failed to save '{$book}' book.");
			}

			$book_id = $this->Book->id;

			foreach ($contents->tunes as $tune) {
				// Prevent to insert the same tune.
				if (!($tune_id = $this->getId($tune))) {
					$this->Tune->create(['name' => $tune]);

					if (!$this->Tune->save()) {
						$this->exitError("Failed to save tune '{$tune}'.");
					}

					$tune_id = $this->Tune->id;
				}

				$this->BooksTune->create([
					'book_id' => $book_id,
					'tune_id' => $tune_id
				]);

				if (!$this->BooksTune->save()) {
					$this->exitError("Failed to save books_tunes.\nbook_id = {$book_id}, tune_id = {$tune_id}");
				}
			}

		}

	}

	protected function exitError($message) {
		echo $message;
		exit;
	}

	private function getId($tune) {
		$record = $this->Tune->findByName($tune);
		return isset($record['Tune']['id']) ? $record['Tune']['id'] : false;
	}

	private function clearTables() {
		foreach ($this->uses as $table) {
			$this->$table->deleteAll('1 = 1');
			$this->$table->query('ALTER TABLE ' . Inflector::tableize($table) . ' AUTO_INCREMENT = 1', false);
		}

		return true;
	}
}
