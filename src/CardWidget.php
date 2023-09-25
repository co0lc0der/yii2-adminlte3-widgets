<?php

namespace co0lc0der\Lte3Widgets;

use yii\bootstrap4\Html;
use yii\web\View;

/**
 * Class CardWidget
 * @package co0lc0der\Lte3Widgets
 */
class CardWidget extends \yii\base\Widget
{
	use CardToolsSupportTrait;
	use ShadowSupportTrait;
	use CustomCssSupportTrait;
	use ColorSupportTrait;

	const OVERLAY_TYPES = ['overlay', 'dark'];
	
	/**
	 * id of a card
	 * @var string
	 */
	public string $id;
	
	/**
	 * title of a card
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
	 * content of a card
	 * @var string
	 */
	protected string $content = '';

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

		$html = Html::beginTag('div', [
			'id' => empty($this->id) ? null : $this->id,
			'class' => $this->getCardClass(),
			'data-widget' => 'card-widget'
		]);

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
			$html = $this->footer; //Html::encode($this->footer)?
		}

		return Html::tag('div', $html, ['class' => $this->getCardFooterClass()]);
	}

	/**
	 * @return string
	 */
	protected function getCardClass(string $baseClass = 'card'): string
	{
		$class = $baseClass;

		if ($this->isColor($this->color)) {
			$class .= (!$this->background && !$this->gradient) ? " card-{$this->color}" : '';
			$class .= ($this->outline) ? ' card-outline' : '';
			$class .= ($this->background) ? " bg-{$this->color}" : '';
			$class .= ($this->gradient) ? " bg-gradient-{$this->color}" : '';
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
		return 'card-header' . $this->getCustomCssClass(1);
	}

	/**
	 * @return string
	 */
	protected function getCardTitleClass(): string
	{
		return 'card-title' . $this->getCustomCssClass(2);
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
