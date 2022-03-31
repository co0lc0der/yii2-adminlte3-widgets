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
	 * type of card shadow
	 * ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
	 * @var string
	 */
	public string $shadow = '';

	use CardToolsSupportTrait;

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
		$this->registerJs();
		$content = ob_get_clean();
		$html = Html::beginTag('div', ['class' => $this->getCardClass(), 'data-widget' => 'card-widget']);

		$html .= $this->getCardHeader();
		$html .= $this->getCardBody($content);
		$html .= $this->getCardFooter();

		if ($this->ajaxLoad) {
			$overlay = ($this->ajaxOverlay == 'dark') ? 'overlay dark' : 'overlay';
			$html .= ($this->ajaxLoad) ? Html::tag('div', '<i class="fas fa-2x fa-sync-alt fa-spin"></i>', ['class' => $overlay, 'data-ajax-load-url' => $this->ajaxLoad]) : '';
		}

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
		$html .= $this->getCardTools();
		$html .= Html::endTag('div'); // the end of a card header

		return $html;
	}

	/**
	 * @return string
	 */
	private function getCardTitle(): string
	{
		return (!empty($this->title)) ? Html::tag('h3', Html::encode($this->title), ['class' => 'card-title']) : '';
	}

	/**
	 * @param string $content
	 * @return string
	 */
	private function getCardBody(string $content = ''): string
	{
		return (!empty($content)) ? Html::tag('div', $content, ['class' => $this->getCardBodyClass()]) : '';
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
		$class .= ($this->hide) ? ' collapsed-card' : '';

		return $class;
	}

	/**
	 * @return string
	 */
	private function getCardHeaderClass(): string
	{
		return 'card-header';
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

	/**
	 * @return void
	 */
	private function registerJs(): void
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
