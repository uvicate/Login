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
		$this->setUrl($this->url);
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

	public function setUrl($url)
	{
		$this->url = $url;
		$this->authorize_endpoint = $this->url . 'authorize';
		$this->token_endpoint = $this->url . 'token';
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

	public function initContext()
	{
		$this->context = new \fkooman\OAuth\Client\Context($this->client_id . "@uvicate.com", array("login"));
	}

	public function getAccessToken()
	{
		$this->initContext();
		return $this->accessToken = $this->api->getAccessToken($this->context);
	}

	public function handleCallback()
	{

	}

	public function logout()
	{
		$this->initContext();
		$this->api->deleteAccessToken($this->context);
		$this->api->deleteRefreshToken($this->context);
	}

	public function verify()
	{
		$this->getRequest($this->url . 'credentials');
	}

	public function getRequest($url)
	{
		$accessToken = $this->getAccessToken();
		$client = new \Guzzle\Http\Client();
		$bearerAuth = new \fkooman\Guzzle\Plugin\BearerAuth\BearerAuth($accessToken->getAccessToken());
		$client->addSubscriber($bearerAuth);

		$response = $client->get($url)->send();
		return $response->json();
	}
}

?>