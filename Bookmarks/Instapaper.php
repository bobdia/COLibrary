<?php

class Instapaper extends HttpReq {
	public $data;
	
	public $urlBookmark;
	public $title;
	public $comment;
	
	public $username;
	public $password;
	
	public $url = 'https://www.instapaper.com/api/add';
	public $method = 'post';
	
	public function __construct($urlBookmark, $title = null, $comment = null) {
		$this->urlBookmark = $urlBookmark;
		$this->title = $title;
		$this->comment = $comment;
	}
	
	protected function before() {
		$this->auth($this->username, $this->password);
	
		$this->args['url'] = $this->urlBookmark;
		if($this->title) {
			$this->args['title'] = $this->title;
		}
		if($this->comment) {
			$this->args['selection'] = $this->comment;
		}
	}
	
	public function success() {
		if($this->status == 201) {
			if(isset($this->headers[0]['content-location'], $this->headers[0]['x-instapaper-title'])) {
				$this->data = array( 
					'url' => $this->headers[0]['content-location'][0],
					'title' => $this->headers[0]['x-instapaper-title'][0]
				);
			}
		} else {
			$this->logError(1000, 'Failure. HTTP code: ' . $this->status);
		}
	}
	
}

?>