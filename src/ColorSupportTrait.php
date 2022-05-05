<?php
namespace co0lc0der\Lte3Widgets;

/**
 * Trait ColorSupportTrait
 * @package co0lc0der\Lte3Widgets
 */
trait ColorSupportTrait
{
	/**
	 * Bootstrap 4 colors
	 * @var array|string[]
	 */
	protected array $bs4Colors = ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'light', 'dark'];

	/**
	 * AdminLTE additional colors
	 * @var array|string[]
	 */
	protected array $addColors = ['indigo', 'lightblue', 'navy', 'purple', 'fuchsia', 'pink', 'maroon', 'orange', 'lime', 'teal', 'olive', 'black', 'gray-dark', 'gray', 'white'];

	/**
	 * color of a text in card header (Bootstrap 4 colors or additional colors of AdminLTE)
	 * @var string
	 */
	public string $color = '';

	/**
	 * @param string $color
	 * @return bool
	 */
	protected function isColor(string $color = ''): bool
	{
		return !empty($color) && (in_array($color, $this->bs4Colors) || in_array($color, $this->addColors));
	}

	/**
	 * @param string $color
	 * @return bool
	 */
	protected function isBs4Color(string $color = ''): bool
	{
		return !empty($color) && in_array($color, $this->bs4Colors);
	}
}
