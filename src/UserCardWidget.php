<?php

namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;
use co0lc0der\Lte3Widget\CustomCssSupportTrait;
use co0lc0der\Lte3Widget\ColorSupportTrait;
use co0lc0der\Lte3Widget\ShadowSupportTrait;

/**
 * Class UserCardWidget
 * @package co0lc0der\Lte3Widgets
 */
class UserCardWidget extends \yii\base\Widget
{
	use CustomCssSupportTrait;
	use ColorSupportTrait;
	use ShadowSupportTrait;

	const TEXT_ALIGN = ['left', 'right', 'center'];

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
	 * user role or position
	 * @var string
	 */
	public string $position = '';

	/**
	 * color of a card header (Bootstrap 4 colors or additional colors of AdminLTE) or a path to background image
	 * @var string
	 */
	public string $background = 'info';

	/**
	 * @var bool
	 */
	protected bool $isBgColor = false;

	/**
	 * makes a gradient card, uses $color property (Bootstrap 4 colors or additional colors of AdminLTE)
	 * @var bool
	 */
	public bool $gradient = false;

	/**
	 * alignment of name and position ('left', 'right', 'center')
	 * @var string
	 */
	public string $textAlign = 'center';

	/**
	 * list of columns
	 * format: [title => text]
	 * [
	 *	'PROJECTS' => '24',
	 *	'FOLLOWERS' => '1,521',
	 *	'TASKS' => '135',
	 *	'COMPLETED PROJECTS' => '12',
	 * ]
	 * @var array
	 */
	public array $cols = [];

	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();

		$this->isBgColor = $this->isColor($this->background);
	}

	/**
	 * @return string
	 */
	public function run(): string
	{
		$html = Html::beginTag('div', ['class' => $this->getCardClass()]);

		$html .= $this->getCardHeader();
		$html .= $this->getUserImage();
		$html .= $this->getCardFooter();

		$html .= Html::endTag('div'); // the end of a card

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardHeader(): string
	{
		$alignClass = in_array($this->textAlign, self::TEXT_ALIGN) && ($this->textAlign == 'left' || $this->textAlign == 'right') ? " text-{$this->textAlign}" : '';
		$backImage = (!$this->isBgColor) ? "background: url('{$this->background}') center center;" : '';

		$html = Html::beginTag('div', ['class' => $this->getCardHeaderClass(), 'style' => $backImage]);
		$html .= (!empty($this->name)) ? Html::tag('h3', $this->name, ['class' => "widget-user-username{$alignClass}"]) : '';
		$html .= (!empty($this->position)) ? Html::tag('h5', $this->position, ['class' => "widget-user-desc{$alignClass}"]) : '';
		$html .= Html::endTag('div'); // the end of a card header

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardFooter(): string
	{
		return (!empty($this->cols)) ? Html::tag('div', $this->getCardCols(), ['class' => $this->getCardFooterClass()]) : '';
	}

	/**
	 * @return string
	 */
	protected function getUserImage(): string
	{
		if (empty($this->image)) return '';

		$image = Html::img($this->image, ['class' => 'img-circle elevation-2', 'alt' => 'User avatar']);

		return Html::tag('div', $image, ['class' => 'widget-user-image']);
	}

	/**
	 * @return string
	 */
	protected function getCardCols(): string
	{
		$html = '';
		$colsCount = count($this->cols);
		$counter = 0;

		foreach ($this->cols as $text => $title) {
			$counter++;
			$header = Html::tag('h5', Html::encode($title), ['class' => 'description-header']);
			$description = Html::tag('span', Html::encode($text), ['class' => 'description-text']);
			$block = Html::tag('div', $header . $description, ['class' => 'description-block']);
			$html .= Html::tag('div', $block, ['class' => ($counter < $colsCount) ? 'col-sm border-right' : 'col-sm']);
		}

		return Html::tag('div', $html, ['class' => 'row']);
	}

	/**
	 * @return string
	 */
	protected function getCardClass(): string
	{
		$class = 'card card-widget widget-user';
		$class .= $this->getShadowClass();

		return $class . $this->getCustomCssClass(0);
	}

	/**
	 * @return string
	 */
	protected function getCardHeaderClass(): string
	{
		$class = 'widget-user-header';
		if ($this->isBgColor) {
			$class .= ($this->gradient) ? " bg-gradient-{$this->background}" : " bg-{$this->background}";
		}
		$class .= $this->isColor($this->color) ? " text-{$this->color}" : '';

		return $class . $this->getCustomCssClass(1);
	}

	/**
	 * @return string
	 */
	protected function getCardFooterClass(): string
	{
		return 'card-footer' . $this->getCustomCssClass(4);
	}
}
