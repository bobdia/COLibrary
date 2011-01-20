<?php

// http://developer.klout.com/docs

class Klout extends HttpReq {
	public $data;
	
	public $twitterNames;
	public $apiKey;
	
	public $url = 'http://api.klout.com/1/';

	
	public function __construct($apiMethod, $twitterName, $apiKey = null) {
		$this->twitterName = $twitterName;
		if($apiKey) {
			$this->apiKey = $apiKey;
		}
	}
	
	protected function before() {
		if(is_array($this->twitterName)) {
			
		}
		$this->args['users'] = $this->twitterName;
		$this->args['key'] = $this->apiKey;
	}
	
	public function success() {
		$this->data = json_decode($this->body, true);
	}
	
}
?>