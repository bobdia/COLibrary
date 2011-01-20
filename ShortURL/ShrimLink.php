<?php

// http://shr.im/api/

class ShrimLink extends Shrim {
	
	public $shortUrl;
	public $longUrl;
	public $privateUrl;
	
	// methods: view, post, edit, delete
	public function __construct($apiMethod, $shortUrl=null, $longUrl = null, $privateUrl = false) {
		$this->apiMethod = $apiMethod;
		$this->shortUrl = $shortUrl;
		$this->longUrl = $longUrl;
		$this->privateUrl = $privateUrl;
	}
	
	protected function before() {
		$this->args['api_user'] = $this->apiUser;
		$this->args['api_key'] = $this->apiKey;
		
		if ($this->apiMethod == 'view') {
			$this->args['alias'] = $this->shortUrl;
		} elseif ($this->apiMethod == 'post') {
			$this->args['url_src'] = $this->longUrl;
			if($this->shortUrl) {
				$this->args['url_min'] = $this->shortUrl;
			}
			$this->args['is_private'] = (int) $this->privateUrl;
		} elseif ($this->apiMethod == 'edit') {
			$this->args['url_src'] = $this->longUrl;
			$this->args['url_min'] = $this->shortUrl;
		} elseif ($this->apiMethod == 'delete') {
			$this->args['url_min'] = $this->shortUrl;
		}
		
		$this->url .= $this->apiVersion . '/' . $this->apiMethod . '.' . $this->apiFormat;
	}

}

?>