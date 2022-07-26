<?php

namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;
use co0lc0der\Lte3Widget\CardToolsSupportTrait;
use co0lc0der\Lte3Widget\ShadowSupportTrait;
use co0lc0der\Lte3Widget\ColorSupportTrait;
use co0lc0der\Lte3Widget\CustomCssSupportTrait;

/**
 * Class ContactCardWidget
 * @package co0lc0der\Lte3Widgets
 */
class ContactCardWidget extends \yii\base\Widget
{
	use CardToolsSupportTrait;
	use ShadowSupportTrait;
	use ColorSupportTrait;
	use CustomCssSupportTrait;

	/**
	 * username
	 * @var string
	 */
	public string $name = '';

	/**
	 * user image
	 * @var string
	 */
	public string $image = '';

	/**
	 * user role or position (title of a card)
	 * @var string
	 */
	public string $position = '';

	/**
	 * about user
	 * format: ['Web Designer', 'UX'] or string
	 * @var array|string
	 */
	public $about = '';

	/**
	 * about title
	 * @var string
	 */
	public string $aboutTitle = 'About: ';

	/**
	 * separator of about user if it is an array
	 * @var string
	 */
	public string $aboutSeparator = ' / ';

	/**
	 * list of rows
	 * format: FontAwesome icon => text
	 * @var array
	 */
	public array $info = [];

	/**
	 * makes an outlined card
	 * @var bool
	 */
	public bool $outline = false;

	/**
	 * content of card footer
	 * it can be some string or an array of buttons
	 * @var string|array
	 */
	public $footer = '';

	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();

		$this->addStandardTools();
	}

	/**
	 * @return string
	 */
	public function run(): string
	{
		$html = Html::beginTag('div', ['class' => $this->getCardClass()]);

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
		$html .= $this->getCardTools();
		$html .= Html::endTag('div'); // the end of a card header

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardTitle(): string
	{
		return (!empty($this->position)) ? Html::encode($this->position) : '';
	}

	/**
	 * @param string $content
	 * @return string
	 */
	protected function getCardBody(string $content = ''): string
	{
		$inner = Html::tag('b', Html::encode($this->name));
		$html = (!empty($this->name)) ? Html::tag('h2', $inner, ['class' => 'lead']) : '';
		$html .= (!empty($this->about)) ? $this->getUserAbout() : '';
		$html .= (!empty($this->info)) ? $this->getUserInfo() : '';

		$html = Html::tag('div', $html, ['class' => (empty($this->image)) ? 'col-12' : 'col-7']);
		$html .= (!empty($this->image)) ? $this->getUserImage() : '';

		$html = Html::tag('div', $html, ['class' => 'row']);

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
	protected function getUserImage(): string
	{
		if (empty($this->image)) return '';

		$image = Html::img($this->image, ['class' => 'img-fluid img-circle', 'alt' => 'user-avatar']);

		return Html::tag('div', $image, ['class' => 'col-5 text-center']);
	}

	/**
	 * @return string
	 */
	protected function getUserAbout(): string
	{
		if (empty($this->about)) return '';

		$about = Html::tag('b', Html::encode($this->aboutTitle));

		if (is_array($this->about)) {
			$about .= implode($this->aboutSeparator, $this->about);
		} else {
			$about .= $this->about; //Html::encode($this->about)?
		}

		return Html::tag('p', $about, ['class' => 'text-muted text-sm']);
	}

	/**
	 * @return string
	 */
	protected function getUserInfo(): string
	{
		$html = '';

		foreach ($this->info as $icon => $info) {
			$inner = '';

			if (!empty($icon)) {
				$inner = Html::tag('i', '', ['class' => "fas fa-lg {$icon}"]);
				$inner = Html::tag('span', $inner, ['class' => 'fa-li']);
			}

			$inner .= $info;
			$html .= Html::tag('li', $inner, ['class' => 'small mb-1']);
		}

		return (!empty($html)) ? Html::tag('ul', $html, ['class' => "ml-4 mb-0 fa-ul text-muted"]) : '';
	}

	/**
	 * @return string
	 */
	protected function getCardClass(): string
	{
		$class = 'card d-flex flex-fill';

		if ($this->isColor($this->color)) {
			$class .= " card-{$this->color}";
			$class .= ($this->outline) ? ' card-outline' : '';
		}
		$class .= $this->getShadowClass();
		$class .= ($this->hide) ? ' collapsed-card' : '';

		return $class . $this->getCustomCssClass(0);
	}

	/**
	 * @return string
	 */
	protected function getCardHeaderClass(): string
	{
		return 'card-header text-muted border-bottom-0' . $this->getCustomCssClass(1);
	}

	/**
	 * @return string
	 */
	protected function getCardBodyClass(): string
	{
		return 'card-body pt-0' . $this->getCustomCssClass(3);
	}

	/**
	 * @return string
	 */
	protected function getCardFooterClass(): string
	{
		return 'card-footer' . $this->getCustomCssClass(4);
	}
}
