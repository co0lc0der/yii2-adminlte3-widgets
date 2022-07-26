<?php

namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;

/**
 * Trait CardToolsSupportTrait
 * @package co0lc0der\Lte3Widgets
 */
trait CardToolsSupportTrait
{
	/**
	 * show / hide collapse button inside card header
	 * @var bool
	 */
	public bool $collapse = true;

	/**
	 * show / hide a collapsed card after initialization
	 * @var bool
	 */
	public bool $hide = false;

	/**
	 * show / hide collapse button inside card header
	 * @var bool
	 */

	public bool $expand = false;

	/**
	 * show / hide close button inside card header
	 * @var bool
	 */
	public bool $close = false;

	/**
	 * list of header custom tools (labels, buttons, links)
	 * @var array
	 */
	public array $tools = [];

	/**
	 * @return string
	 */
	protected function getCardTools(): string
	{
		$html = '';

		if (is_array($this->tools)) {
			foreach ($this->tools as $item) {
				if (is_array($item[0])) {
					$html .= $this->makeSubmenu($item[0], $item[1] ?? 'ellipsis-v', $item[2] ?? false);
				} else if (is_string($item[0])) {
					if ($item[0] == 'button') {
						$html .= Html::button($item[1], array_merge(['class' => 'btn btn-tool', 'data-toggle' => 'tooltip'], $item[2]));
					} else if ($item[0] == 'label') {
						$html .= Html::tag('span', $item[1], array_merge(['class' => 'badge badge-light', 'data-toggle' => 'tooltip'], $item[2]));
					} else {
						$html .= Html::a($item[1], $item[2], array_merge(['class' => 'btn btn-tool', 'data-toggle' => 'tooltip'], $item[3]));
					}
				}
			}
		}

		return (!empty($html)) ? Html::tag('div', $html, ['class' => 'card-tools']) : '';
	}

	/**
	 * @param array $menu
	 * @param string $icon
	 * @param bool $arrow
	 * @return string
	 */
	private function makeSubmenu(array $menu, string $icon = 'ellipsis-v', bool $arrow = false): string
	{
		$arrowClass = ($arrow) ? ' dropdown-toggle' : '';

		$html = Html::button('<i class="fas fa-' . $icon . '"></i>', [
			'class' => 'btn btn-tool' . $arrowClass,
			'data-toggle' => 'dropdown',
			'data-offset' => '-52',
		]);

		$items = '';
		foreach ($menu as $item) {
			if ($item[0] !== '---') {
				$items .= Html::a($item[1], $item[0], array_merge(['class' => 'dropdown-item'], $item[2] ?? []));
			} else {
				$items .= Html::tag('div', '', ['class' => 'dropdown-divider']);
			}
		}

		$html .= Html::tag('div', $items, ['class' => 'dropdown-menu', 'role' => 'menu']);

		return Html::tag('div', $html, ['class' => 'btn-group']);
	}

	/**
	 * @return void
	 */
	protected function addStandardTools(): void
	{
		if ($this->collapse) {
			$this->tools[] = CardToolsHelper::collapseButton($this->hide);
		}

		if ($this->expand) {
			$this->tools[] = CardToolsHelper::expandButton();
		}

		if ($this->close) {
			$this->tools[] = CardToolsHelper::closeButton();
		}
	}
}
