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

	public function main() {
		$usage = <<<USAGE
Usage: cake samples COMMAND

commands
  update: Gets samples from YouTube API and updates Samples table.
USAGE;
		$this->out($usage);
	}

	public function update() {
		$samples = $this->YouTube->find('all', [
			'conditions' => ['q' => 'Miles Davis jazz',]
		]);

		var_dump($samples);
		return true;
	}

}
