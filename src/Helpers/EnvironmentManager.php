<?php

namespace LittleApps\EnhancedLaravelInstaller\Helpers;

use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager as EnvironmentManagerBase;
use LittleApps\EnhancedLaravelInstaller\Environment\Container;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class EnvironmentManager {
	use ForwardsCalls;

	protected $environmentManager;

	protected $envPath;
	protected $envExamplePath;

	public function __construct(EnvironmentManagerBase $environmentManager) {
		$this->environmentManager = $environmentManager;

		$this->envPath = App::environmentFilePath();
		$this->envExamplePath = App::environmentPath().DIRECTORY_SEPARATOR.'.env.example';
	}

    /**
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath() {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath() {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFileClassic(Request $input)
    {
        return $this->environmentManager->saveFileClassic($input);
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Container $container
     * @return string
     */
    public function saveFileWizard(Container $container)
    {
		$results = trans('installer_messages.environment.success');

		$envFileConfig = collect();
		
		foreach ($container->getEnvConfig() as $key => $value) {
			$envFileConfig->push(sprintf('%s=%s', $key, $this->sanitizeEnvValue($value)));
		}

		try {
            file_put_contents($this->envPath, $envFileConfig->implode(PHP_EOL));

        } catch(Exception $e) {
            $results = trans('installer_messages.environment.errors');
        }

        return $results;
	}

	/**
	 * Sanitizes env value so it can be rendered in .env file
	 *
	 * @param mixed $value
	 * @return string
	 */
	protected function sanitizeEnvValue($value) {
		if (is_string($value)) {
			if ($value == '')
				$value = '(empty)';
			else if (preg_match('/\s/', $value) > 0)
				$value = "'" . $value . "'";
		}
		else if (is_bool($value))
			$value = $value ? 'true' : 'false';
		else if (is_null($value))
			$value = '(null)';
		
		return (string) $value;
	}
	
	public function __call($method, $params) {
		return $this->forwardCallTo($this->environmentManager, $method, $params);
	}
}