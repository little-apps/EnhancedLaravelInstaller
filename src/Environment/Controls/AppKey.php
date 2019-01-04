<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

use Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class AppKey extends Text {
	use Concerns\HasLabel;

	public function getInputExtras() {
		return ['readonly' => 'readonly'] + parent::getInputExtras();
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.text');
	}

	public function getDefaultValue() {
		$output = new BufferedOutput;
		
		Artisan::call('key:generate', ['--show' => true], $output);

		return trim($output->fetch());
	}
}