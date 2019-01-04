<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

use Illuminate\Support\Str;

class Tab extends Control {
	use Concerns\HasControls, Concerns\HasLabel;

	public function getRadioName() {
		return Str::snake($this->getParent()->id) . '_tab';
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.tab');
	}
}