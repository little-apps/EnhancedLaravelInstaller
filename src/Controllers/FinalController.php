<?php

namespace LittleApps\EnhancedLaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Controllers\FinalController as FinalControllerBase;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Helpers\FinalInstallManager;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;
use LittleApps\EnhancedLaravelInstaller\Events\FinalizingLaravelInstall;
use Illuminate\Support\Traits\ForwardsCalls;

class FinalController extends Controller
{
	use ForwardsCalls;

	protected $finalController;

	public function __construct(FinalControllerBase $finalController) {
		$this->finalController = $finalController;
	}

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
		$parentView = $this->finalController->finish($fileManager, $finalInstall, $environment);

		$config = collect(config('installer'));

		$finalMessages = 
			collect([$parentView->finalMessages])
				->concat(event(new FinalizingLaravelInstall($config)));

        return $parentView->with('finalMessages', $finalMessages->implode("\n"));
	}
	
	public function __call($method, $params) {
		return $this->forwardCallTo($this->finalController, $method, $params);
	}
}
