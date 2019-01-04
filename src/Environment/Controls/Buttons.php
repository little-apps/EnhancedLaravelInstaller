<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Buttons extends Control {
	use Concerns\HasControls;

	public function getView() {
		return view('vendor.installer.environment-wizard.buttons');
	}
}