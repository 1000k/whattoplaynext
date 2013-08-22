<?php
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'Google_Client', ['file' => 'google-api-php-client/src/Google_Client.php']);
App::import('Vendor', 'Google_YoutubeService', ['file' => 'google-api-php-client/src/contrib/Google_YouTubeService.php']);

/**
 * Datasource to handle with YouTube API.
 * Currently only the `read` function is implemented.
 */
class YouTubeSource extends DataSource {

/**
 * An optional description of your datasource
 */
	public $description = 'YouTube API datasource';

	public $config = [
		'apiKey' => '',
	];

	protected $_schema = [];

	public function __construct($config) {
		parent::__construct($config);
		$this->Http = new HttpSocket();

		$client = new Google_Client();
		$client->setDeveloperKey($this->config['apiKey']);
		$this->Youtube = new Google_YoutubeService($client);
	}


	public function listSources($data = null) {
		return null;
	}

	public function describe($model) {
		return $this->_schema;
	}

	public function calculate(Model $model, $func, $params = array()) {
		return 'COUNT';
	}

	public function read(Model $model, $queryData = array(), $recursive = null) {
		/**
		 * Here we do the actual count as instructed by our calculate()
		 * method above. We could either check the remote source or some
		 * other way to get the record count. Here we'll simply return 1 so
		 * ``update()`` and ``delete()`` will assume the record exists.
		 */
		if ($queryData['fields'] === 'COUNT') {
			return array(array(array('count' => 1)));
		}
		/**
		 * Now we get, decode and return the remote data.
		 */
		$queryData['conditions']['apiKey'] = $this->config['apiKey'];

		try {
			$response = $this->Youtube->search->listSearch(
				'id,snippet',
				[
					'q' => $queryData['conditions']['q'],
					'maxResults' => Configure::read('YouTube.max_search_result')
				]
			);

			$res = [];

			foreach ($response['items'] as $item) {
				if ($item['id']['kind'] === 'youtube#video') {
					$res[] = [
						'videoId' => $item['id']['videoId'],
						'title' => $item['snippet']['title'],
						'thumbnailUrl' => $item['snippet']['thumbnails']['medium']['url'],
					];
				}
			}
		} catch (Google_ServiceException  $e) {
			throw new CakeException('A Google service error occurred:' . $e->getMessage());
		} catch (Google_Exception $e) {
			throw new CakeException('A client error occurred:' . $e->getMessage());
		}
		
		return [$model->alias => $res];
	}

}
