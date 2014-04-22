<?php namespace Uvicate\OAuth;

class Client {
	public $url = 'http://users.uvicate.com/';
	public $authorize_endpoint;
	public $client_id;
	public $client_secret;
	public $token_endpoint;
	public $clientConfig;
	public $api;
	public $callback;
	public $context;
	public $accessToken;
	
	public function __construct()
	{
		$this->authorize_endpoint = $this->url . 'authorize';
		$this->token_endpoint = $this->url . 'token';
	}

	public function __get($property)
	{
		return $this->{$property};
	}

	public function get($property)
	{
		return $this->{$property};
	}

	public function __set($property, $value)
	{
		return $this->{$property} = $value;
	}

	public function set($property, $value)
	{
		return $this->{$property} = $value;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function initialize()
	{
		$this->clientConfig = new \fkooman\OAuth\Client\ClientConfig(
			array(
				"authorize_endpoint" => $this->authorize_endpoint,
				"client_id" => $this->client_id,
				"client_secret" => $this->client_secret,
				"token_endpoint" => $this->token_endpoint,
				)
		);

		$this->api = new \fkooman\OAuth\Client\Api("uvicate", $this->clientConfig, new \fkooman\OAuth\Client\SessionStorage(), new \Guzzle\Http\Client());

		$this->callback = new \fkooman\OAuth\Client\Callback("uvicate", $this->clientConfig, new \fkooman\OAuth\Client\SessionStorage(), new \Guzzle\Http\Client());
	}

	public function getAccessToken()
	{
		$this->context = new \fkooman\OAuth\Client\Context($this->client_id . "@uvicate.com", array("login"));
		return $this->accessToken = $this->api->getAccessToken($this->context);
	}

	public function handleCallback()
	{

	}

	public function logout()
	{

	}

	public function verify()
	{
		
	}
}

?>