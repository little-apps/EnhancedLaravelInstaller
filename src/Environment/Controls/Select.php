<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Select extends Option {
	use Concerns\HasLabel;

	public function getOptions() {
		return collect($this->options)->map(function($value, $key) {
			return __($value);
		});
	}

	public function getSelectExtras() {
		return data_get($this, 'extras.select', []);
	}

	public function getOptionExtras() {
		return data_get($this, 'extras.option', []);
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.select');
	}
}