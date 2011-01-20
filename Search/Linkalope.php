<?php

// http://linkalope.com/api/
// Accepts Twitter search operators: http://search.twitter.com/operators

class Linkalope extends HttpReq {

	public $query;
	public $maxResults;
	
	public $data;
	
	public $url = 'http://linkalope.com/api/json/';
	
	public function __construct($query, $maxResults = null) {
		$this->query = $query;
		$this->maxResults = $maxResults;
	}
	
	protected function before() {
		$this->args['q'] = $this->query;
		if($this->maxResults) {
			$this->args['max'] = $this->maxResults;
		}
	}

	protected function success() {
		$this->data = json_decode($this->body, true);
	}
}

?>