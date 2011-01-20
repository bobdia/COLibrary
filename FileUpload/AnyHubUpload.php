<?php

// http://ahb.me/page/api

class AnyHubUpload extends HttpReq {

	public $data;
	public $username;
	public $password;
	public $priv;
	public $mimetype;
	
	
	public $url = 'http://anyhub.net/api/';
	public $stringPost = false;
	
	public function __construct($filePath, $username = null, $password = null, $private = null, $mimetype = null) {
		$this->filePath = $filePath;
		$this->username = $username;
		$this->password = $password;
		$this->priv = $private;
		$this->mimetype = $mimetype;
	}
	
	protected function before() {
		$this->args['Filedata'] = '@' . $filepath;
		
		if($this->username && $this->password) {
			$this->args['username'] = $this->username;
			$this->args['password'] = $this->password;
		}
		
		if($this->priv) {
			$this->args['private'] = '1';
		}
		
		if($this->mimetype) {
			$this->args['mimetype'] = $this->mimetype;
		}
		
	}
	
	protected function success() {
		$this->data = json_decode($this->body, true);
	}
}

?>