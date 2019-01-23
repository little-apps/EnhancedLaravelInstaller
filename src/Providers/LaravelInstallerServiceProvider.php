<?php

namespace LittleApps\EnhancedLaravelInstaller\Providers;

use Illuminate\Support\ServiceProvider;
use LittleApps\EnhancedLaravelInstaller\Controllers\EnvironmentController;
use RachidLaasri\LaravelInstaller\Controllers\EnvironmentController as EnvironmentControllerBase;
use LittleApps\EnhancedLaravelInstaller\Controllers\FinalController;
use RachidLaasri\LaravelInstaller\Controllers\FinalController as FinalControllerBase;
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

		$this->app->extend(FinalControllerBase::class, function ($finalController) {
			return new FinalController($finalController);
		});

		$this->publishes([
			__DIR__.'/../config/installer.php' => config_path('installer.php')
		], 'enhanced-laravel-installer');

		$this->publishes([
            __DIR__.'/../lang' => base_path('resources/lang'),
		], 'enhanced-laravel-installer');
		
		$this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/installer'),
        ], 'enhanced-laravel-installer');
    }
}
