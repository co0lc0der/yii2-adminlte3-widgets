<?php
namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;

/**
 * Class SocialWidget
 * @package co0lc0der\Lte3Widgets
 */
class SocialWidget extends \yii\base\Widget
{
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
	 * makes a gradient card, uses $color property (Bootstrap 4 colors or additional colors of AdminLTE)
	 * @var bool
	 */
	public bool $gradient = false;

	/**
	 * list of rows
	 * format: title => [count, URL]
	 * 'Followers' => [
	 *    '1,521',
	 *    '#url'
	 * 	],
	 * 	'Following'	=> ['373'],
	 * 	'Friends'	=> ['3,127'],
	 * 	'Projects'	=> [
	 * 	  '7',
	 * 	  'https://example.com'
	 * 	],
	 * @var array
	 */
	public array $rows = [];

	use CustomCssSupportTrait;
	use ColorSupportTrait;
	use ShadowSupportTrait;

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
		$html = Html::beginTag('div', ['class' => $this->getCardClass()]);

		$html .= $this->getCardHeader();
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
		$html .= $this->getUserImage();
		$html .= (!empty($this->name)) ? Html::tag('h3', $this->name, ['class' => 'widget-user-username']) : '';
		$html .= (!empty($this->position)) ? Html::tag('h5', $this->position, ['class' => 'widget-user-desc']) : '';
		$html .= Html::endTag('div'); // the end of a card header

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardFooter(): string
	{
		if (empty($this->rows)) return '';

		$html = $this->getCardRows();

		return Html::tag('div', $html, ['class' => $this->getCardFooterClass()]);
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
	protected function getCardRows(): string
	{
		$html = '';

		foreach ($this->rows as $title => $row) {
			$inner = Html::encode($title);
			$color = $row[2] ?? 'light';
			$inner .= Html::tag('span', $row[0] ?? '0', ['class' => "float-right badge bg-{$color}"]);
			$link = Html::a($inner, $row[1] ?? '#', ['class' => 'nav-link']);
			$html .= Html::tag('li', $link, ['class' => 'nav-item']);
		}

		return Html::tag('ul', $html, ['class' => "nav flex-column"]);
	}

	/**
	 * @return string
	 */
	protected function getCardClass(): string
	{
		$class = 'card card-widget widget-user-2';
		$class .= $this->getShadowClass();

		return $class . $this->getCustomCssClass(0);
	}

	/**
	 * @return string
	 */
	protected function getCardHeaderClass(): string
	{
		$class = 'widget-user-header';

		if ($this->isColor($this->color)) {
			$class .= ($this->gradient) ? " bg-gradient-{$this->color}" : " bg-{$this->color}";
		}

		return $class . $this->getCustomCssClass(1);
	}

	/**
	 * @return string
	 */
	protected function getCardFooterClass(): string
	{
		return 'card-footer p-0' . $this->getCustomCssClass(4);
	}
}
