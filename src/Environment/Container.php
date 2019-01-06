<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment;

use Illuminate\Support\Arr;
use LittleApps\EnhancedLaravelInstaller\Environment\Controls\Control;

class Container extends Control {
	use Controls\Concerns\HasControls;

	public function __construct() {
		parent::__construct(null, []);
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.steps');
	}

	/**
	 * Sets errors to be shared across all views
	 *
	 * @param array $errors
	 * @return static
	 */
	public function setErrors(array $errors) {
		// We can't rely on the Illuminate\View\Middleware\ShareErrorsFromSession middleware.
		// This is a package and it is unknown if the Laravel project has sessions configured.
		view()->share('errors', $errors);

		return $this;
	}

	/**
	 * Gets the env config variables
	 *
	 * @param LittleApps\EnhancedLaravelInstaller\Environment\Controls\Control $parent
	 * @return Illuminate\Support\Collection
	 */
	public function getEnvConfig($parent = null) {
		$parent = $parent ?? $this;

		$config = collect();

		foreach ($parent->getControls() as $control) {
			// Only options have env values
			if ($control instanceof Controls\Option && isset($control->envName)) {
				$config->put($control->envName, $control->getValue());
			}

			if (in_array(Controls\Concerns\HasControls::class, class_uses_recursive($control))) {
				$controlConfig = $this->getEnvConfig($control);

				$config = $config->merge($controlConfig);
			}
		}

		return $config;
	}

	/**
	 * Gets the validation rules and messages in the container
	 *
	 * @param LittleApps\EnhancedLaravelInstaller\Environment\Controls\Control $parent
	 * @return array The first element the rules and second element any custom messages for validation errors
	 */
	public function getValidationRulesMessages($parent = null) {
		$parent = $parent ?? $this;

		$rules = collect();
		$messages = collect();

		foreach ($parent->getControls() as $control) {
			// Only options have rules
			if ($control instanceof Controls\Option) {
				$rules->put($control->getId(), $control->getRules());
				$messages->put($control->getId(), $control->getMessages());
			}

			if (in_array(Controls\Concerns\HasControls::class, class_uses_recursive($control))) {
				[$controlRules, $controlMessages] = $this->getValidationRulesMessages($control);

				$rules = $rules->merge($controlRules);
				$messages = $messages->merge($controlMessages);
			}
		}

		return [$rules, $messages];
	}
}