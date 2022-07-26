<?php

namespace co0lc0der\Lte3Widgets;

/**
 * Trait CustomCssSupportTrait
 * @package co0lc0der\Lte3Widgets
 */
trait CustomCssSupportTrait
{
	/**
	 * additional CSS classes
	 * format: [
	 *  0 => 'classes-for-card-wrapper',
	 *  1 => 'classes-for-card-header',
	 *  2 => 'classes-for-card-title',
	 *  3 => 'classes-for-card-body',
	 *  4 => 'classes-for-card-footer',
	 * ]
	 * @var array|string[]
	 */
	public array $cssClasses = [];

	/**
	 * @return string
	 */
	protected function getCustonCssClass(int $index): string
	{
		return (isset($this->cssClasses[$index]) && !empty($this->cssClasses[$index])) ? " {$this->cssClasses[$index]}" : '';
	}
}
