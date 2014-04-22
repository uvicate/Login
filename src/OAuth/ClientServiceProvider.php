<?php namespace Uvicate\OAuth;

use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider {

/**
* Register the service provider.
*
* @return void
*/
public function register()
{
	// Register 'underlyingclass' instance container to our UnderlyingClass object
	$this->app['uvicateOauthClient'] = $this->app->share(function($app)
	{
		$client = new Client();

		return $client;
	});

	// Shortcut so developers don't need to add an Alias in app/config/app.php
	$this->app->booting(function()
	{
		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('uVicateOAuthClient', 'Uvicate\OAuth\ClientFacade');
	});
	}
}