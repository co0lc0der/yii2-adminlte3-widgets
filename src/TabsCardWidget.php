<?php

namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;
use co0lc0der\Lte3Widget\ShadowSupportTrait;
use co0lc0der\Lte3Widget\CustomCssSupportTrait;
use co0lc0der\Lte3Widget\ColorSupportTrait;

/**
 * Class TabsCardWidget
 * @package co0lc0der\Lte3Widgets
 */
class TabsCardWidget extends \yii\base\Widget
{
	use ShadowSupportTrait;
	use CustomCssSupportTrait;
	use ColorSupportTrait;

	/**
	 * title of a card
	 * if title is empty tabs will be placed on the left side of the card header
	 * @var string
	 */
	public string $title;

	/**
	 * makes an outlined card
	 * @var bool
	 */
	public bool $outline = false;

	/**
	 * makes a colored card, uses $color property (Bootstrap 4 colors)
	 * @var bool
	 */
	public bool $background = false;

	/**
	 * makes a gradient card, uses $color property (Bootstrap 4 colors)
	 * @var bool
	 */
	public bool $gradient = false;

	/**
	 * content of card footer
	 * @var string|array
	 */
	public $footer = '';

	/**
	 * list of tabs
	 * [
	 *  [
	 *	'title' => 'Tab1',
	 *	'id' => 'tab_1',
	 *	'content' => 'A wonderful serenity has taken possession of my entire soul,
	 *    like these sweet mornings of spring which I enjoy with my whole heart.',
	 *	'active' => true,
	 *	],
	 *	[
	 *    'title' => 'Tab2',
	 *    'id' => 'tab_2',
	 *    'content' => 'The European languages are members of the same family. Their separate existence is a myth.
	 *    For science, music, sport, etc, Europe uses the same vocabulary.',
	 *	]
	 * ]
	 * @var array
	 */
	public array $tabs = [];

	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * @return string
	 */
	public function run(): string
	{
		$html = Html::beginTag('div', ['class' => $this->getCardClass(), 'data-widget' => 'card-widget']);

		$html .= $this->getCardHeader();
		$html .= $this->getCardBody();
		$html .= $this->getCardFooter();

		$html .= Html::endTag('div'); // the end of a card

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardHeader(): string
	{
		$html = Html::beginTag('div', ['class' => $this->getCardHeaderClass()]);
		$html .= $this->getCardTitle();
		$html .= $this->getCardTabs();
		$html .= Html::endTag('div'); // the end of a card header

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardTabs(): string
	{
		$html = '';

		foreach ($this->tabs as $tab) {
			$class = (array_key_exists('active', $tab) && $tab['active']) ? 'nav-link active' : 'nav-link';
			$link = Html::a($tab['title'] ?? '', "#{$tab['id']}" ?? '#', ['class' => $class, 'data-toggle' => 'tab']);
			$html .= Html::tag('li', $link, ['class' => 'nav-item']);
		}

		$left = (!empty($this->title)) ? ' ml-auto' : '';

		return (!empty($html)) ? Html::tag('ul', $html, ['class' => "nav nav-pills{$left} p-2"]) : '';
	}

	/**
	 * @return string
	 */
	protected function getCardTitle(): string
	{
		return (!empty($this->title)) ? Html::tag('h3', Html::encode($this->title), ['class' => $this->getCardTitleClass()]) : '';
	}

	/**
	 * @return string
	 */
	protected function getCardBody(): string
	{
		$html = Html::beginTag('div', ['class' => 'tab-content']);

		foreach ($this->tabs as $tab) {
			$class = (array_key_exists('active', $tab) && $tab['active']) ? 'tab-pane active' : 'tab-pane';
			$html .= Html::tag('div', $tab['content'] ?? '', ['class' => $class, 'id' => $tab['id'] ?? '']);
		}

		$html .= Html::endTag('div');

		return Html::tag('div', $html, ['class' => $this->getCardBodyClass()]);
	}

	/**
	 * @return string
	 */
	protected function getCardFooter(): string
	{
		if (empty($this->footer)) return '';

		if (is_array($this->footer)) {
			$footer = '';
			foreach ($this->footer as $item) {
				$footer .= Html::a($item[0] ?? '', $item[2] ?? '#', array_merge(['class' => 'btn btn-sm ' . $item[1] ?? ''], $item[3] ?? [])) . ' ';
			}
			$html = Html::tag('div', $footer, ['class' => 'text-right']);
		} else {
			$html = $this->footer; //Html::encode($this->footer)?
		}

		return Html::tag('div', $html, ['class' => $this->getCardFooterClass()]);
	}

	/**
	 * @return string
	 */
	protected function getCardClass(): string
	{
		$class = "card";

		if ($this->isColor($this->color)) {
			$class .= (!$this->background && !$this->gradient) ? " card-{$this->color}" : '';
			$class .= ($this->outline) ? ' card-outline' : '';
			$class .= ($this->background) ? " bg-{$this->color}" : '';
			$class .= ($this->gradient) ? " bg-gradient-{$this->color}" : '';
		}
		$class .= $this->getShadowClass();

		return $class . $this->getCustomCssClass(0);
	}

	/**
	 * @return string
	 */
	protected function getCardHeaderClass(): string
	{
		$class = 'card-header';
		$class .= (!empty($this->tabs)) ? ' d-flex p-0' : '';

		return $class . $this->getCustomCssClass(1);
	}

	/**
	 * @return string
	 */
	protected function getCardTitleClass(): string
	{
		$class = 'card-title';
		$class .= (!empty($this->tabs)) ? ' p-3' : '';

		return $class . $this->getCustomCssClass(2);
	}

	/**
	 * @return string
	 */
	protected function getCardBodyClass(): string
	{
		return 'card-body' . $this->getCustomCssClass(3);
	}

	/**
	 * @return string
	 */
	protected function getCardFooterClass(): string
	{
		return 'card-footer' . $this->getCustomCssClass(4);
	}
}
