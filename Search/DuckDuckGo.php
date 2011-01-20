<?php

// http://duckduckgo.com/api.html

class DuckDuckGo extends HttpReq {

	public $data;
	
	public $query;
	public $disambig; // disambiguation

	public $url = 'http://api.duckduckgo.com/';

	public function __construct($query, $disambiguation=null) {
		$this->query = $query;
		if($disambiguation) {
			$this->disambig = true;
		}
	}
	
	protected function before() {
		$this->args['q'] = $this->query;
		if($this->disambig) {
			$this->args['d'] = '1';
		}
		$this->args['o'] = 'json';
	}
	
	public function success() {
		$this->data = json_decode($this->body, true);
	}
	
}

?>