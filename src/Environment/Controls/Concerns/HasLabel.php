<?php

namespace LittleApps\EnhancedLaravelInstaller\Environment\Controls\Concerns;

trait HasLabel {
	/**
	 * Gets the label text
	 *
	 * @return string|null
	 */
	public function getLabelText() {
		if (is_string($this->label))
			return $this->label;
		elseif (isset($this->label['text']))
			return $this->label['text'];
		
		return null;
	}

	/**
	 * Is there a link for the label?
	 *
	 * @return boolean
	 */
	public function hasLabelLink() {
		return isset($this->label['link']);
	}

	/**
	 * Gets the link for the label
	 *
	 * @return string
	 */
	public function getLabelLink() {
		return $this->label['link']['href'];
	}

	/**
	 * Gets the link text for the label
	 *
	 * @return void
	 */
	public function getLabelLinkText() {
		return $this->label['link']['text'];
	}

	/**
	 * Gets the link icon for the label
	 *
	 * @return string
	 */
	public function getLabelLinkIcon() {
		return $this->label['link']['icon'];
	}
}