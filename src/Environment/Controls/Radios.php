<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Radios extends Option {
	use Concerns\HasLabel, Concerns\HasControls;

	public function getView() {
		return view('vendor.installer.environment-wizard.radios');
	}
}