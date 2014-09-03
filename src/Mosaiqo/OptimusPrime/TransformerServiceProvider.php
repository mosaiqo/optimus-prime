<?php namespace Mosaiqo\OptimusPrime;

use Illuminate\Support\ServiceProvider;

class TransformerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Mosaiqo\OptimusPrime\Contracts\Transformer', 'Mosaiqo\OptimusPrime\Transformer');
		$this->registerArtisanCommand();
	}

	/**
	 * Register the Artisan command
	 *
	 * @return void
	 */
	public function registerArtisanCommand()
	{
		$this->app->bindShared('optimus-prime.transformer.make', function($app)
		{
			return $app->make('Mosaiqo\OptimusPrime\Console\TransformerGenerate');
		});

		$this->commands('optimus-prime.transformer.make');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
