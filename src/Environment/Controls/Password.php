<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Password extends Text {
	use Concerns\HasLabel;

	public function getInputExtras() {
		return data_get($this, 'extras.input', []);
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.password');
	}

	
}