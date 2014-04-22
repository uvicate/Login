<?php namespace Uvicate\OAuth;

use Illuminate\Support\Facades\Facade;

class ClientFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'uvicateOauthClient'; }

}

?>