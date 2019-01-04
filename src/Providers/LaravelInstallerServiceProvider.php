<?php

namespace LittleApps\EnhancedLaravelInstaller\Providers;

use Illuminate\Support\ServiceProvider;
use LittleApps\EnhancedLaravelInstaller\Controllers\EnvironmentController;
use RachidLaasri\LaravelInstaller\Controllers\EnvironmentController as EnvironmentControllerBase;
use LittleApps\EnhancedLaravelInstaller\Environment\Factory as EnvironmentFactory;
use LittleApps\EnhancedLaravelInstaller\Helpers\EnvironmentManager;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->app->singleton(EnvironmentFactory::class, function($app) {
			return new EnvironmentFactory($app);
		});

		$this->app->extend(EnvironmentControllerBase::class, function ($envController) {
			$envManager = $this->app->make(EnvironmentManager::class);

			return new EnvironmentController($envController, $envManager);
		});
    }
}
