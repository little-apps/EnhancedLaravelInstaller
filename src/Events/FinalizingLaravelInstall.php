<?php

namespace LittleApps\EnhancedLaravelInstaller\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Collection;

class FinalizingLaravelInstall {
	use Dispatchable, InteractsWithSockets, SerializesModels;
	
	/**
	 * Contains the Laravel Installer configuration
	 *
	 * @var Illuminate\Support\Collection
	 */
	public $config;

	/**
	 * Constructor for FinalizingLaravelInstall event.
	 *
	 * @param Illuminate\Support\Collection $config Configuration for Laravel Installer
	 */
	public function __construct(Collection $config) {
		$this->config = $config;
	}


}
