<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

trait HasControls {
	protected $controls;

	/**
	 * Add controls to this control
	 *
	 * @param mixed $controls An array of controls or a Control for each parameter
	 * @return static
	 */
	public function addControls($controls) {
		$controls = 
			collect(Arr::flatten(func_get_args()))
				->each(function($control) {
					$control->setParent($this);
				});

		$this->controls = $this->controls->concat($controls);

		return $this;
	}

	/**
	 * Gets the controls inside this Control
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function getControls() {
		return collect($this->controls);
	}

	/**
	 * Renders each of the controls into HTML
	 *
	 * @return Illuminate\Support\HtmlString
	 */
	public function renderControls() {
		$controlsHtml = 
			$this->controls->map(function($control) {
				return $control->makeView()->render();
			})->implode('');

		return new HtmlString($controlsHtml);
	}
}