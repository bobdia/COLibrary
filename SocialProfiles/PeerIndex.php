<?php

// http://dev.peerindex.net/docs/profile/show

class PeerIndex extends HttpReq {
	public $data;
	
	public $twitterName;
	public $apiKey;
	
	public $url = 'http://api.peerindex.net/1/profile/show.json';

	
	public function __construct($twitterName, $apiKey = null) {
		$this->twitterName = $twitterName;
		if($apiKey) {
			$this->apiKey = $apiKey;
		}
	}
	
	protected function before() {

		$this->args['id'] = $this->twitterName;
		$this->args['api_key'] = $this->apiKey;
	}
	
	public function success() {
		$this->data = json_decode($this->body, true);
	}
	
}
?>