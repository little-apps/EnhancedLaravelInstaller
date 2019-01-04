<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

use Illuminate\Contracts\Support\Renderable;
use ArrayAccess;

abstract class Control implements ArrayAccess {
	/**
	 * The ID of this control
	 *
	 * @var string
	 */
	protected $id;
	
	/**
	 * Contains the parameters specified in the config for this control
	 *
	 * @var Illuminate\Support\Collection
	 */
	protected $params;
	
	/**
	 * Parent control
	 *
	 * @var static
	 */
	protected $parent;

	/**
	 * Constructor for Control
	 *
	 * @param string $id
	 * @param array $params
	 */
	public function __construct($id, $params) {
		$this->id = $id;
		$this->params = collect($params);

		$traits = class_uses_recursive(static::class);

		if (in_array(Concerns\HasControls::class, $traits))
			$this->controls = collect();
	}

	/**
	 * Sets the parent control
	 *
	 * @param Control $parent
	 * @return static
	 */
	public function setParent(Control $parent) {
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Gets the parent control
	 *
	 * @return static
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Gets the ID of the control
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Gets the parameters for the control
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function getParams() {
		return collect($this->params);
	}

	public function __isset($key) {
		return $this->offsetExists($key);
	}

	public function __get($key) {
		return $this->offsetGet($key);
	}

	public function offsetExists($offset) {
		return isset($this->params[$offset]);
	}

	public function offsetGet($offset) {
		return $this->params[$offset];
	}

	public function offsetSet($offset, $value) {
		return;
	}

	public function offsetUnset($offset) {
		return;
	}

	/**
	 * Gets the view for the option.
	 *
	 * @return Illuminate\Contracts\View\View
	 */
	abstract public function getView();

	/**
	 * Makes the view for the Control with 'control' set to this instance.
	 *
	 * @return Illuminate\Contracts\View\View
	 */
	public function makeView() {
		return 
			$this->getView()
				->with('control', $this);
	}
}