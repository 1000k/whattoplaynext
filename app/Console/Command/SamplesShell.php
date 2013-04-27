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
	public $uses = ['Sample', 'Tune', 'YouTube'];
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
		$source = $this->TunesJson->load();

		$tunes = array_unique(Hash::extract($source, '{s}.tunes.{n}'));
		sort($tunes);

		foreach ($tunes as $tune) {
			$this->out("'{$tune}'...");

			$tune_id = $this->Tune->getIdByName($tune);
			if (!$tune_id) {
				$this->out('Not found in Tunes table. Ignored.');
				continue;
			}

			$records = $this->YouTube->find('all', [
				'conditions' => ['q' => "{$tune} jazz"]
			]);

			if (count($records['YouTube']) < 1) {
				$this->out('No results hit on YouTube.');
				continue;
			} else {
				if ($this->Sample->deleteAll(['Sample.tune_id' => $tune_id], false)) {
					$this->out("Deleted Sample records where tune_id = {$tune_id}.");
				}

				foreach ($records['YouTube'] as $cnt => $record) {
					$title = $record['title'];
					$video_id = $record['videoId'];
					$thumbnail_url = $record['thumbnailUrl'];

					if (!$this->YouTube->downloadThumbnail(
						$thumbnail_url,
						$video_id
					)) {
						$this->out("Failed to download '{$thumbnail_url}'.");
						continue;
					}

					$this->out("Downloaded thumbnail of {$tune}[{$cnt}] (videoId: {$video_id})...");

					$this->Sample->create();
					$sample_record = [
						'Sample' => [
							'tune_id' => $tune_id,
							'title' => $title,
							'type' => 'youtube',
							'url' => $video_id,
							'thumbnail' => "{$video_id}.jpg"
						]
					];
					if (!$this->Sample->save($sample_record)) {
						$this->out('Failed to save Sample record.');
						continue;
					}

					$this->out("Sample.id = {$this->Sample->id} saved.");
				}
			}
		}

		$this->out('Done.');
		return true;
	}

}
