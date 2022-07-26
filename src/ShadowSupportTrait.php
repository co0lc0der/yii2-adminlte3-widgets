<?php

namespace co0lc0der\Lte3Widgets;

/**
 * Trait ShadowSupportTrait
 * @package co0lc0der\Lte3Widgets
 */
trait ShadowSupportTrait
{
	/**
	 * @var array|string[]
	 */
	protected array $shadowTypes = ['shadow-none', 'shadow-sm', 'shadow', 'shadow-lg'];

	/**
	 * type of card shadow
	 * ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
	 * @var string
	 */
	public string $shadow = '';

	/**
	 * @return string
	 */
	protected function getShadowClass(): string
	{
		return (!empty($this->shadow) && in_array($this->shadow, $this->shadowTypes)) ? " {$this->shadow}" : '';
	}
}
