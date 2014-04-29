<?php

class LoginController extends BaseController {
	
	public static function start()
	{
		uVicateOAuthClient::set('client_id', 'your-key');
		uVicateOAuthClient::set('client_secret', 'your-secret');
		uVicateOAuthClient::initialize();
	}

	public function checkCredentials()
	{
		$this::start();
		$access = array('access' => false);
		$accessToken = uVicateOAuthClient::getAccessToken();
		if($accessToken !== false)
		{
			$access['access'] = true;
		}

		return $access;
	}
}