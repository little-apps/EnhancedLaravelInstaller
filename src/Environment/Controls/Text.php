<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Text extends Option {
	use Concerns\HasLabel;

	public function getInputExtras() {
		return data_get($this, 'extras.input', []);
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.text');
	}

	
}