<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

use Illuminate\Http\Request;

/**
 * A Option is a Control that contains a value.
 */
abstract class Option extends Control {
	/**
	 * The Request object
	 *
	 * @var Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Constructor for Option
	 *
	 * @param string $id
	 * @param array $params
	 * @param Request $request
	 */
	public function __construct($id, $params, Request $request) {
		parent::__construct($id, $params);

		$this->request = $request;
	}

	/**
	 * Creates a view for the Option with 'option' set to this instance.
	 * 
	 * @inheritDoc
	 */
	public function makeView() {
		return 
			$this->getView()
				->with('option', $this);
	}

	/**
	 * Gets the default value
	 *
	 * @return mixed
	 */
	public function getDefaultValue() {
		return isset($this->default) ? $this->default : null;
	}

	/**
	 * Gets the value
	 *
	 * @return mixed
	 */
	public function getValue() {
		return $this->request->input($this->id) ?? $this->getDefaultValue();
	}

	/**
	 * Gets the validation rules for the Option
	 *
	 * @return array
	 */
	public function getRules() {
		return $this->rules ?? [];
	}

	/**
	 * Gets any custom messages for validation
	 *
	 * @return array
	 */
	public function getMessages() {
		return isset($this->messages) ? $this->messages : [];
	}
}