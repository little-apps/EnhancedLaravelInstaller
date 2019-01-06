<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Foundation\Application;
use LittleApps\EnhancedLaravelInstaller\Environment\Controls\Control;
use InvalidArgumentException;

class Factory {
	use Macroable;

	protected $app;

	public function __construct(Application $app) {
		$this->app = $app;
	}

	/**
	 * Creates Container instance from environment config
	 *
	 * @param array $config
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Container
	 */
	public function make($config) {
		$container = new Container();

		foreach (collect($config) as $id => $params) {
			$control = $this->makeControl($id, $params);
			$container->addControls($control);
		}

		return $container;
	}

	/**
	 * Creates a Control from the 'type' specified in the params
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Control
	 * @throws InvalidArgumentException Thrown if the type has no creation method
	 */
	public function makeControl($id, $params) {
		$type = $params['type'];
		$method = "create" . Str::studly($type) . "Control";

		if (!method_exists($this, $method) && !static::hasMacro($method))
        	throw new InvalidArgumentException("Control [$type] not supported.");

		return $this->$method($id, $params);
	}

	/**
	 * Creates a Step control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Step
	 */
	protected function createStepControl($id, $params) {
		return
			$this->app->makeWith(Controls\Step::class, compact('id', 'params'))
				->addControls($this->makeControls($params['controls']));
	}

	/**
	 * Creates a Tab control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Tab
	 */
	protected function createTabControl($id, $params) {
		return
			$this->app->makeWith(Controls\Tab::class, compact('id', 'params'))
				->addControls($this->makeControls($params['controls']));
	}

	/**
	 * Creates a Buttons control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Buttons
	 */
	protected function createButtonsControl($id, $params) {
		return
			$this->app->makeWith(Controls\Buttons::class, compact('id', 'params'))
				->addControls($this->makeControls($params['controls']));
	}

	/**
	 * Creates a Button control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Button
	 */
	protected function createButtonControl($id, $params) {
		return $this->app->makeWith(Controls\Button::class, compact('id', 'params'));
	}

	/**
	 * Creates a Text control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Text
	 */
	protected function createTextControl($id, $params) {
		return $this->app->makeWith(Controls\Text::class, compact('id', 'params'));
	}

	/**
	 * Creates a Password control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Password
	 */
	protected function createPasswordControl($id, $params) {
		return $this->app->makeWith(Controls\Password::class, compact('id', 'params'));
	}

	/**
	 * Creates a Select control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Select
	 */
	protected function createSelectControl($id, $params) {
		return $this->app->makeWith(Controls\Select::class, compact('id', 'params'));
	}

	/**
	 * Creates a Radios control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Radios
	 */
	protected function createRadiosControl($id, $params) {
		return
			$this->app->makeWith(Controls\Radios::class, compact('id', 'params'))
				->addControls($this->makeControls($params['controls'], ['type' => 'radio']));
	}

	/**
	 * Creates a Radio control
	 *
	 * @param string $id ID of control (does not have to be unique)
	 * @param array $params Parameters for control
	 * @return LittleApps\EnhancedLaravelInstaller\Environment\Controls\Radio
	 */
	protected function createRadioControl($id, $params) {
		return $this->app->makeWith(Controls\Radio::class, compact('id', 'params'));
	}

	/**
	 * Makes Controls from an array of params
	 *
	 * @param mixed $controls An array control parameters
	 * @param array $extra Any extra parameters to include in each control parameters
	 * @return Illuminate\Support\Collection
	 */
	protected function makeControls($controls, array $extra = []) {
		return
			collect($controls)->map(function($params, $key) use($extra) {
				return $this->makeControl($key, $params + $extra);
			});
	}
}