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
			return new FileParser($this->app['files'], $this->app['literate-routes.parser']);
		});

		$this->app->bindShared('command.literate-routes.file-parser', function($app)
		{
			return new Console\LiterateRouteBuilderCommand($app['literate-routes.file-parser']);
		});

		$this->commands('command.literate-routes.file-parser');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
			'command.literate-routes.file-parser',
		);
	}

}
