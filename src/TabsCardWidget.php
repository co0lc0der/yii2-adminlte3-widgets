<?php
namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;

/**
 * Class TabsCardWidget
 * @package co0lc0der\Lte3Widgets
 */
class TabsCardWidget extends \yii\base\Widget
{
	/**
	 * title of a card
	 * if title is empty tabs will be placed on the left side of the card header
	 * @var string
	 */
	public string $title;

	/**
	 * color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
	 * @var string
	 */
	public string $color = '';

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
	 * @var string
	 */
	public string $footer = '';

	/**
	 * type of card shadow
	 * ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
	 * @var string
	 */
	public string $shadow = '';

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
		$html = Html::beginTag('div', ['class' => $this->getCardClass()/*, 'data-widget' => 'card-widget'*/]);

		$html .= $this->getCardHeader();
		$html .= $this->getCardBody();
		$html .= $this->getCardFooter();

		$html .= Html::endTag('div'); // the end of a card

		return $html;
	}

	/**
	 * @return string
	 */
	private function getCardHeader(): string
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
	private function getCardTabs(): string
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
	private function getCardTitle(): string
	{
		$html = '';

		if (!empty($this->title)) {
			$class = (!empty($this->tabs)) ? 'card-title p-3' : 'card-title';
			$html = Html::tag('h3', Html::encode($this->title), ['class' => $class]);
		}

		return $html;
	}

	/**
	 * @return string
	 */
	private function getCardBody(): string
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
	private function getCardFooter(): string
	{
		return (!empty($this->footer)) ? Html::tag('div', $this->footer, ['class' => $this->getCardFooterClass()]) : '';
	}

	/**
	 * @return string
	 */
	private function getCardClass(): string
	{
		$class = "card";

		$class .= ($this->color && !$this->background && !$this->gradient) ? " card-{$this->color}" : '';
		$class .= ($this->outline && $this->color) ? ' card-outline' : '';
		$class .= ($this->background && $this->color) ? " bg-{$this->color}" : '';
		$class .= ($this->gradient && $this->color) ? " bg-gradient-{$this->color}" : '';
		$class .= ($this->shadow) ? " {$this->shadow}" : '';

		return $class;
	}

	/**
	 * @return string
	 */
	private function getCardHeaderClass(): string
	{
		$class = 'card-header';

		if (!empty($this->tabs)) {
			$class .= ' d-flex p-0';
		}

		return $class;
	}

	/**
	 * @return string
	 */
	private function getCardBodyClass(): string
	{
		return 'card-body';
	}

	/**
	 * @return string
	 */
	private function getCardFooterClass(): string
	{
		return 'card-footer';
	}
}
