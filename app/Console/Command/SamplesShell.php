<?php
App::uses('Shell', 'Console');

/**
 * SamplesShell
 *
 * Handling `Samples` table.
 *
 * @package       app.Console.Command
 */
class SamplesShell extends AppShell {
	public $uses = ['Sample', 'YouTube'];
	public $tasks = ['TunesJson'];

	public function main() {
		$usage = <<<USAGE
Usage: cake samples COMMAND

commands
  update: Gets samples from YouTube API and updates Samples table.
USAGE;
		$this->out($usage);
	}

	public function update() {
		$data = $this->TunesJson->load();

		$tunes = array_unique(Hash::extract($data, '{s}.tunes.{n}'));
		sort($tunes);

		var_dump($tunes);

		// $samples = $this->YouTube->find('all', [
		// 	'conditions' => ['q' => 'Miles Davis jazz',]
		// ]);

		return true;
	}

}
