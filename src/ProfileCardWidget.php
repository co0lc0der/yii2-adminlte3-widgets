<?php
namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;

/**
 * Class ProfileCardWidget
 * @package co0lc0der\Lte3Widgets
 */
class ProfileCardWidget extends \yii\base\Widget
{
	/**
	 * user name
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
	 * color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
	 * @var string
	 */
	public string $color = '';

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

	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();

		ob_start();
	}

	/**
	 * @return string
	 */
	public function run(): string
	{
		$content = ob_get_clean();
		$html = Html::beginTag('div', ['class' => $this->getCardClass()]);

		$html .= $this->getCardBody($content);
		$html .= $this->getCardFooter();

		$html .= Html::endTag('div'); // the end of a card

		return $html;
	}

	/**
	 * @param string $content
	 * @return string
	 */
	private function getCardBody(string $content = ''): string
	{
		$html = $this->getUserImage();
		$html .= (!empty($this->name)) ? Html::tag('h3', Html::encode($this->name), ['class' => 'profile-username text-center']) : '';
		$html .= (!empty($this->position)) ? Html::tag('p', Html::encode($this->position), ['class' => 'text-muted text-center']) : '';
		$html .= (!empty($this->rows)) ? $this->getCardRows() : '';

		$html .= $content;

		return Html::tag('div', $html, ['class' => 'card-body box-profile']);
	}

	/**
	 * @return string
	 */
	private function getCardFooter(): string
	{
		return (!empty($this->footer)) ? Html::tag('div', $this->footer, ['class' => 'card-footer']) : '';
	}

	/**
	 * @return string
	 */
	private function getUserImage(): string
	{
		if (empty($this->image)) return '';

		$image = Html::img($this->image, ['class' => 'profile-user-img img-fluid img-circle', 'alt' => 'User profile picture']);

		return Html::tag('div', $image, ['class' => 'text-center']);
	}

	/**
	 * @return string
	 */
	private function getCardRows(): string
	{
		$html = '';

		foreach ($this->rows as $title => $row) {
			$inner = Html::tag('b', Html::encode($title));
			$inner .= Html::a($row[0] ?? '', $row[1] ?? '#', ['class' => 'float-right']);
			$html .= Html::tag('li', $inner, ['class' => 'list-group-item']);
		}

		return (!empty($html)) ? Html::tag('ul', $html, ['class' => "list-group list-group-unbordered mb-3"]) : '';
	}

	/**
	 * @return string
	 */
	private function getCardClass(): string
	{
		$class = "card";

		$class .= ($this->color) ? " card-{$this->color} card-outline" : '';
		$class .= ($this->shadow) ? " {$this->shadow}" : '';

		return $class;
	}
}
