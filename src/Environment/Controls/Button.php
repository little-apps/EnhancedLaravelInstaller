<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

use Illuminate\Support\HtmlString;

class Button extends Control {
	/**
	 * Gets content inside the button
	 *
	 * @return Illuminate\Support\HtmlString
	 */
	public function getButtonContent() {

		if (is_string($this->label))
			$label = __($this->$label);
		else 
			$label =
				__($this->label['text']) . 
				(isset($this->label['icon']) ? '<i class="' . e($this->label['icon']) . '" aria-hidden="true"></i>' : '');

		return new HtmlString($label);
	}

	/**
	 * Gets any extra button attributes
	 *
	 * @return array
	 */
	public function getButtonExtras() {
		return isset($this->extras['button']) ? $this->extras['button'] : [];
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.button');
	}
}