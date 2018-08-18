<?php 
namespace core;

class Request
{
	const METHOD_POST = 'POST';
	const METHOD_GET = 'GET';
	private $get;
	private $post;
	private $server;
	private $cookie;
	private $file;
	private $session;

	public function __construct($get, $post, $server, $cookie, $file, $session)
	{
		$this->get = $get;
		$this->post = $post;
		$this->server = $server;
		$this->cookie = $cookie;
		$this->file = $file;
		$this->session = $session;
	}

	public function gets($key = null)
	{
		if(!$key) {
			return $this->get;
		}
		if(isset($this->get[$key])) {
			return $this->get[$key];
		}
		return null;
	}

	public function post($key = null)
	{
		if(!$key) {
			return $this->get;
		}
		if(isset($this->get[$key])) {
			return $this->get[$key];
		}
		return null;
	}

	public function isPost()
	{
			return $this->server['REQUEST_METHOD'] === self::METHOD_POST;
	}
}