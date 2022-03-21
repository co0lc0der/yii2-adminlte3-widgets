<?php
namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;
use yii\web\View;

class CardWidget extends \yii\base\Widget
{
	public string $title;                 // title of a card
	public string $color = '';            // color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
	public bool $outline = false;         // makes an outlined card
	public bool $background = false;      // makes a colored card, uses $color property (Bootstrap 4 colors)
	public bool $gradient = false;        // makes a gradient card, uses $color property (Bootstrap 4 colors)
	public string $footer = '';           // content of card footer
	public bool $collapse = true;         // show/hide collapse button inside card header
	public bool $hide = false;            // show/hide a collapsed card after initialization
	public bool $expand = false;          // show/hide maximize button inside card header
	public bool $close = false;           // show/hide close button inside card header
	public string $ajaxLoad = '';         // show loading spinner
	public string $ajaxOverlay = 'overlay';// type of loading overlay ('overlay', 'dark')
	public string $shadow = '';           // type of loading overlay ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
	public array $items = [];             // list of header custom items (labels, buttons, links)

	public function init()
	{
		parent::init();

		if ($this->collapse) {
			$this->items[] = [
				'button',
				($this->hide) ? '<i class="fas fa-plus"></i>' : '<i class="fas fa-minus"></i>',
				[
					'class' => 'btn btn-tool',
					'data-card-widget' => 'collapse',
					'title' => 'Collapse/Развернуть',
				]
			];
		}

		if ($this->expand) {
			$this->items[] = [
				'button',
				'<i class="fas fa-expand"></i>',
				[
					'class' => 'btn btn-tool',
					'data-card-widget' => 'maximize',
					'title' => 'Maximize',
				]
			];
		}

		if ($this->close) {
			$this->items[] = [
				'button',
				'<i class="fas fa-times"></i>',
				[
					'class' => 'btn btn-tool',
					'data-card-widget' => 'remove',
					'title' => 'Close',
				]
			];
		}
		ob_start();
	}

	public function run(): string
	{
		$this->registerJs();
		$content = ob_get_clean();
		$html = Html::beginTag('div', ['class' => $this->getCardClass()]);

		$html .= Html::beginTag('div', ['class' => $this->getCardHeaderClass()]);
		$html .= (!empty($this->title)) ? Html::tag('h3', $this->title, ['class' => 'card-title']) : '';
		$html .= Html::tag('div', $this->getCardTools(), ['class' => 'card-tools']);
		$html .= Html::endTag('div'); // the end of a card header

		$html .= Html::tag('div', $content, ['class' => 'card-body']);
		$html .= ($this->footer) ? Html::tag('div', $this->footer, ['class' => 'card-footer']) : '';

		if ($this->ajaxLoad) {
			$overlay = ($this->ajaxOverlay == 'dark') ? 'overlay dark' : 'overlay';
			$html .= ($this->ajaxLoad) ? Html::tag('div', '<i class="fas fa-2x fa-sync-alt fa-spin"></i>', ['class' => $overlay, 'data-ajax-load-url' => $this->ajaxLoad]) : '';
		}

		$html .= Html::endTag('div'); // the end of a card

		return $html;
	}

	private function getCardClass(): string
	{
		$class = "card";

		$class .= ($this->color && !$this->outline && !$this->background && !$this->gradient) ? " card-{$this->color}" : '';
		$class .= ($this->outline && $this->color) ? ' card-outline' : '';
		$class .= ($this->background && $this->color) ? " bg-{$this->color}" : '';
		$class .= ($this->gradient && $this->color) ? " bg-gradient-{$this->color}" : '';
		$class .= ($this->shadow) ? " {$this->shadow}" : '';
		$class .= ($this->hide) ? ' collapsed-card' : '';

		return $class;
	}

	private function getCardHeaderClass(): string
	{
		$class = 'card-header';

		return $class;
	}

	private function getCardTools(): string
	{
		$html = '';

		if (is_array($this->items)){
			foreach ($this->items as $item){
				if ($item[0] == 'button') {
					$html .= Html::button($item[1], array_merge(['class' => 'btn btn-tool'], $item[2]));
				} else if ($item[0] == 'label') {
					$html .= Html::tag('span', $item[1], $item[2]);
				} else {
					$html .= Html::a($item[1], $item[2], array_merge(['class' => 'btn btn-tool'], $item[3]));
				}
			}
		}

		return $html;
	}

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

