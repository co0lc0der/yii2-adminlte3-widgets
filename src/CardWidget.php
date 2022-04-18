<?php
namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;
use yii\web\View;

/**
 * Class CardWidget
 * @package co0lc0der\Lte3Widgets
 */
class CardWidget extends \yii\base\Widget
{
	const OVERLAY_TYPES = ['overlay', 'dark'];

	/**
	 * title of a card
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
	 * URL for loading data
	 * if it is not empty it shows a spinner before data loaded
	 * @var string
	 */
	public string $ajaxLoad = '';

	/**
	 * type of loading overlay ('overlay', 'dark')
	 * @var string
	 */
	public string $ajaxOverlay = 'overlay';

	/**
	 * additional CSS classes
	 * format: [
	 *  0 => 'classes-for-card-wrapper',
	 *  1 => 'classes-for-card-header',
	 *  2 => 'classes-for-card-title',
	 *  3 => 'classes-for-card-body',
	 *  4 => 'classes-for-card-footer',
	 * ]
	 * @var array
	 */
	public array $cssClasses = [];

	/**
	 * content of a card
	 * @var string
	 */
	protected string $content = '';

	use CardToolsSupportTrait;
	use ShadowSupportTrait;

	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();

		$this->addStandardTools();

		ob_start();
	}

	/**
	 * @return string
	 */
	public function run(): string
	{
		$this->content = ob_get_clean();
		$this->registerJs();
		$html = Html::beginTag('div', ['class' => $this->getCardClass(), 'data-widget' => 'card-widget']);

		$html .= $this->getCardHeader();
		$html .= $this->getCardBody();
		$html .= $this->getCardFooter();

		$html .= (!empty($this->ajaxLoad)) ? Html::tag('div', '<i class="fas fa-2x fa-sync-alt fa-spin"></i>', ['class' => $this->getOverlayClass(), 'data-ajax-load-url' => $this->ajaxLoad]) : '';

		$html .= Html::endTag('div'); // the end of a card

		return $html;
	}

	/**
	 * @return string
	 */
	protected function getCardHeader(): string
	{
		if (empty($this->title) && empty($this->tools)) return '';

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
		return (!empty($this->title)) ? Html::tag('h3', $this->title, ['class' => $this->getCardTitleClass()]) : '';
	}

	/**
	 * @return string
	 */
	protected function getCardBody(): string
	{
		return (!empty($this->content)) ? Html::tag('div', $this->content, ['class' => $this->getCardBodyClass()]) : '';
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
			$html = $this->footer;
		}

		return Html::tag('div', $html, ['class' => $this->getCardFooterClass()]);
	}

	/**
	 * @return string
	 */
	protected function getCardClass(): string
	{
		$class = 'card';

		$class .= ($this->color && !$this->background && !$this->gradient) ? " card-{$this->color}" : '';
		$class .= ($this->outline && $this->color) ? ' card-outline' : '';
		$class .= ($this->background && $this->color) ? " bg-{$this->color}" : '';
		$class .= ($this->gradient && $this->color) ? " bg-gradient-{$this->color}" : '';
		$class .= $this->getShadowClass();
		$class .= ($this->hide) ? ' collapsed-card' : '';
		$class .= (isset($this->cssClasses[0]) && !empty($this->cssClasses[0])) ? " {$this->cssClasses[0]}" : '';

		return $class;
	}

	/**
	 * @return string
	 */
	protected function getCardHeaderClass(): string
	{
		$class = 'card-header';
		$class .= (isset($this->cssClasses[1]) && !empty($this->cssClasses[1])) ? " {$this->cssClasses[1]}" : '';

		return $class;
	}

	/**
	 * @return string
	 */
	protected function getCardTitleClass(): string
	{
		$class = 'card-title';
		$class .= (isset($this->cssClasses[2]) && !empty($this->cssClasses[2])) ? " {$this->cssClasses[2]}" : '';

		return $class;
	}

	/**
	 * @return string
	 */
	protected function getCardBodyClass(): string
	{
		$class = 'card-body';
		$class .= (isset($this->cssClasses[3]) && !empty($this->cssClasses[3])) ? " {$this->cssClasses[3]}" : '';

		return $class;
	}

	/**
	 * @return string
	 */
	protected function getCardFooterClass(): string
	{
		$class = 'card-footer';
		$class .= (isset($this->cssClasses[4]) && !empty($this->cssClasses[4])) ? " {$this->cssClasses[4]}" : '';

		return $class;
	}

	/**
	 * @return string
	 */
	protected function getOverlayClass(): string
	{
		if (empty($this->ajaxOverlay) || !in_array($this->ajaxOverlay, self::OVERLAY_TYPES)) return '';

		return ($this->ajaxOverlay == 'dark') ? 'overlay dark' : 'overlay';
	}

	/**
	 * @return void
	 */
	protected function registerJs(): void
	{
		if ($this->ajaxLoad) {
			$this->view->registerJs("
        $.each($('[data-ajax-load-url]'), function(i, el) {
					let url = $(el).attr('data-ajax-load-url');
					$(el).siblings('.card-body').load(url, function() {
						$(el).remove();
					});
        });
      ", View::POS_READY, 'ajaxLoad');
		}
	}
}
