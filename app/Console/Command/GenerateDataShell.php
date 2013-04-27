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
	public $tasks = ['TunesJson'];

	public function main() {
		$this->out('Usage: cake GenerateData generate');
	}

	public function generate() {
		$data = $this->TunesJson->load();

		$this->__clearTables();

		foreach ($data as $book => $contents) {
			$this->out("Saving tunes on '{$book}'...");
			$this->Book->create([
				'name' => $book,
				'image_path' => $contents['image_path'],
				'url_amazon' => $contents['url_amazon'],
				'url_amazon_conversion_image' => $contents['url_amazon_conversion_image']
			]);

			if (!$this->Book->save()) {
				$this->error("Failed to save '{$book}' book.");
			}

			$book_id = $this->Book->id;

			foreach ($contents['tunes'] as $tune) {
				// Prevent to insert the same tune.
				if (!($tune_id = $this->Tune->getIdByName($tune))) {
					$this->Tune->create(['name' => $tune]);

					if (!$this->Tune->save()) {
						$this->error("Failed to save tune '{$tune}'.");
					}

					$tune_id = $this->Tune->id;
				}

				$this->BooksTune->create([
					'book_id' => $book_id,
					'tune_id' => $tune_id
				]);

				if (!$this->BooksTune->save()) {
					$this->error("Failed to save books_tunes.\nbook_id = {$book_id}, tune_id = {$tune_id}");
				}
			}
		}

		$this->hr();
		$this->out('Saved Books: ' . $this->Book->find('count'));
		$this->out('Saved BooksTunes: ' . $this->BooksTune->find('count'));
		$this->out('Saved Tunes: ' . $this->Tune->find('count'));
		$this->out("Done.");

		return true;
	}

	private function __clearTables() {
		foreach ($this->uses as $table) {
			$this->$table->deleteAll('1 = 1');
			$this->$table->query('ALTER TABLE ' . Inflector::tableize($table) . ' AUTO_INCREMENT = 1', false);
		}

		return true;
	}
}
