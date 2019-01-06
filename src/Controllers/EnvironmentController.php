<?php

namespace LittleApps\EnhancedLaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use RachidLaasri\LaravelInstaller\Controllers\EnvironmentController as EnvironmentControllerBase;
use LittleApps\EnhancedLaravelInstaller\Events\EnvironmentSaving;
use LittleApps\EnhancedLaravelInstaller\Events\EnvironmentSaved;
use LittleApps\EnhancedLaravelInstaller\Helpers\EnvironmentManager;
use LittleApps\EnhancedLaravelInstaller\Environment\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Validation\ValidationException;

class EnvironmentController extends Controller {
	use ForwardsCalls;

	protected $envController;
	protected $envManager;

	public function __construct(EnvironmentControllerBase $envController, EnvironmentManager $envManager) {
		$this->envController = $envController;
		$this->envManager = $envManager;
	}

	/**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
		//$envConfig = $this->envManager->getEnvContent();
		$envConfig = config('installer.environment');
		$container = app(Factory::class)->make($envConfig);

        return view('vendor.installer.environment-wizard', compact('container'));
	}
	
	/**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request, Redirector $redirect)
    {
		$envConfig = config('installer.environment');
		$container = app(Factory::class)->make($envConfig);
		[$rules, $messages] = $container->getValidationRulesMessages();

		$messages['environment_custom.required_if'] = __('installer_messages.environment.wizard.form.name_required');

		try {
			$request->validate($rules->all(), $messages->all());
		} catch (ValidationException $e) {
			// LaravelInstaller does validation itself so it can pass $envConfig to the view, but $envConfig doesn't exist :S
			// We just need to pass the container (and the errors)
			return 
				view('vendor.installer.environment-wizard')
					->with(['container' => $container->setErrors($e->validator->errors())]);
		}

		event(new EnvironmentSaving($container, $request));

        $results = $this->envManager->saveFileWizard($container);

        event(new EnvironmentSaved($container, $request));

        return $redirect->route('LaravelInstaller::database')
                        ->with(['results' => $results]);
    }

	public function __call($method, $params) {
		return $this->forwardCallTo($this->envController, $method, $params);
	}
}