<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Step extends Control {
	use Concerns\HasControls;

	public function getView() {
		return view('vendor.installer.environment-wizard.step');
	}
}