<?php namespace Rtablada\LiterateRoutes;

use Illuminate\Support\ServiceProvider;

class LiterateRoutesServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('literate-routes.parser', function() {
			return new Parser;
		});
		$this->app->bindShared('literate-routes.file-parser', function() {
			return new FileParser($this->app['files', $this->app['literate-routes.parser']]);
		});
	}

}
