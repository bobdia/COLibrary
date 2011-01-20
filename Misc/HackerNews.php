<?php

// http://api.ihackernews.com/

class HackerNews extends HttpReq {
	public $data;
	
	public $apiMethod;
	public $arg;
	public $pages;
	
	protected $apiUrl = 'http://api.ihackernews.com/';
	protected $hnUrl = 'http://news.ycombinator.com/item?id=';
	protected $nextId;
	protected $apiMethods = array(
			// $arg is null
			'frontPage' => 'page',
			'newPage' => 'new',
			'newComments' => 'newcomments',
			'askHN' => 'ask',
			// $arg is post id
			'post' => 'post',
			// $arg is url
			'url' => 'getid',
			// $arg is username
			'threads' => 'threads',
			'submissions' => 'by',
			'profile' => 'profile',
	);
	
	public function __construct($apiMethod, $arg = null, $pages = null) {
		$this->apiMethod = $apiMethod;
		$this->arg = $arg;
		$this->pages = $pages;
	}
	

	
	protected function before() {
		if(!array_key_exists($this->apiMethod, $this->apiMethods)) {
			return;
		}
		
		$this->url = $this->apiUrl . '/' . $this->apiMethods[ $this->apiMethod ];
		
		if($this->apiMethod == 'url') {
			$this->args['url'] = $this->arg;
		} else {
			$this->url .= '/' . urlencode($this->arg);
			
			if($this->nextId) {
				$this->url .= '/' . $this->nextId;
			}
		}
	}
	
	protected function success() {
		$this->data = json_decode($this->body, true);
		
		if($this->pages > 1 && isset($this->data['nextId'])) {
			$this->nextId = $this->data['nextId'];
		}
		
	}

}