<?php

namespace LittleApps\EnhancedLaravelInstaller\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use LittleApps\EnhancedLaravelInstaller\Environment\Container;
use Illuminate\Http\Request;

class EnvironmentSaving {
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Container containing options to be saved
	 *
	 * @var LittleApps\EnhancedLaravelInstaller\Environment\Container
	 */
	public $container;

	/**
	 * Request containing values
	 *
	 * @var Illuminate\Http\Request
	 */
	public $request;

	public function __construct(Container $container, Request $request) {
		$this->container = $container;
		$this->request = $request;
	}
}