<?php

// http://www.tastekid.com/page/api

class TasteKid extends HttpReq {
	public $data;
	public $query;
	public $verbose;
	// Allowed types are: "//music", "//movies", "//shows", "//books" and "//authors"
	public $resultType;
	
	public $url = 'http://www.tastekid.com/ask/ws';
	
	public function __construct($query, $verbose = true, $resultType = null) {
		$this->query = $query;
		$this->verbose = $verbose;
		$this->resultType = $resultType;
	}
	
	protected function before() {
		$this->args['q'] = $this->query;
		if($this->resultType) {
			$this->args['q'] .= ' //' . $this->resultType;
		}
		if($this->verbose) {
			$this->args['verbose'] = '1';
		}
		$this->args['format'] = 'JSON';
	}

	protected function success() {
		$this->data = json_decode($this->body, true);
	}
}

?>