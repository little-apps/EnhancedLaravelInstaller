<?php

namespace LittleApps\EnhancedLaravelInstaller\Events;

use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved as EventBase;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use LittleApps\EnhancedLaravelInstaller\Environment\Container;
use Illuminate\Http\Request;

class EnvironmentSaved extends EventBase {
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Container containing options to be saved
	 *
	 * @var LittleApps\EnhancedLaravelInstaller\Environment\Container
	 */
	public $container;

	public function __construct(Container $container, Request $request) {
		parent::__construct($request);

		$this->container = $container;
	}
}