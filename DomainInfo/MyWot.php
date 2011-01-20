<?php

// http://www.mywot.com/wiki/API

class MyWot extends HttpReq {
	public $data;
	public $hosts;
	
	public $url = ' http://api.mywot.com/0.4/public_link_json';
	
	// must include at most 100 target names. Note: the full request path must also be less than 8 KiB or it will be rejected. 
	public function __construct($hosts) {
		$this->hosts = $hosts;
	}
	
	protected function before() {
		if(is_array($this->hosts)) {
			$this->hosts = implode('/', $this->hosts);
		}
		$this->args['hosts'] = $this->hosts . '/';
	}
	
	protected function success() {
		$this->data = json_decode($this->body, true);
	}

}

?>