<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls;

class Radio extends Option {
	use Concerns\HasLabel;

	public function getDefaultValue() {
		return $this->default ?? $this->getParent()->getControls()->first()->getId() == $this->getId();
	}

	public function getValue() {
		return $this->request->has($this->getParent()->getId()) ? $this->request->input($this->getParent()->getId()) == $this->getId() : $this->getDefaultValue();
	}

	public function getView() {
		return view('vendor.installer.environment-wizard.radio');
	}
}