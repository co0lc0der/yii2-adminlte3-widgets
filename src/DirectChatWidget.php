<?php
namespace co0lc0der\Lte3Widgets;

use yii\bootstrap\Html;

/**
 * Class DirectChatWidget
 * @package co0lc0der\Lte3Widgets
 */
class DirectChatWidget extends CardWidget
{
	/**
	 * chat messages color (Bootstrap 4 colors. 'success', 'danger' еtс.)
	 * @var string
	 */
	public string $chatColor = 'primary';

	/**
	 * author's name, this property is used to highlight author's messages with $chatColor
	 * @var string
	 */
	public string $author = '';

	/**
	 * array of messages
	 * message format: [username, datetime, user image, message]
	 * example: [
	 * [
	 *  'Alexander Pierce',
	 *  '23 Jan 2:00 pm',
	 *  '../assets/img/user1-128x128.jpg',
	 *  'Is this template really for free? That\'s unbelievable!',
	 * ],
	 * [
	 *  'Sarah Bullock',
	 *  '23 Jan 2:05 pm',
	 *  '../assets/img/user5-128x128.jpg',
	 *  'You better believe it!',
	 * ]
	 * ]
	 * @var array of arrays
	 */
	public array $messages = [];

	/**
	 * contacts list. if it is empty there will be no chat icon in the header of the chat
	 * contact format: [username, datetime, user image, message, url]
	 * example: [
	 * [
	 *  'Alexander Pierce',
	 *  '23 Jan 2:00 pm',
	 *  '../assets/img/user1-128x128.jpg',
	 *  'Is this template really for free? That\'s unbelievable!',
	 *  '#'
	 * ],
	 * [
	 *  'Sarah Bullock',
	 *  '23 Jan 2:05 pm',
	 *  '../assets/img/user5-128x128.jpg',
	 *  'You better believe it!',
	 *  '#link_to_profile'
	 * ]
	 * ]
	 * @var array of arrays
	 */
	public array $contacts = [];

	/**
	 * the message which will be shown if $messages is empty
	 * @var string
	 */
	public string $noMessages = 'There is no messages in the chat';

	/**
	 * URL to send a new message
	 * @var string
	 */
	public string $sendFormUrl = '';

	/**
	 * title of send button
	 * @var string
	 */
	public string $sendFormButtonTitle = 'Send';

	/**
	 * placeholder for send form
	 * @var string
	 */
	public string $sendFormPlaceholder = 'Type Message ...';

	/**
	 * @return void
	 */
	public function init()
	{
		if (!empty($this->contacts)) {
			$this->tools[] = CardToolsHelper::contactsButton();
		}

		parent::init();
	}

	/**
	 * @return string
	 */
	public function getContacts(): string
	{
		if (empty($this->contacts)) return '';

		$html = '';

		foreach ($this->contacts as $contact) {
			$image = Html::img($contact[2] ?? '', ['class' => 'contacts-list-img']);
			$date = Html::tag('small', $contact[1] ?? '', ['class' => 'contacts-list-date float-right']);
			$name = Html::tag('span', $contact[0] . $date, ['class' => 'contacts-list-name']);
			$text = Html::tag('span', Html::encode($contact[3] ?? ''), ['class' => 'contacts-list-msg']);
			$info = Html::tag('div', $name . $text, ['class' => 'contacts-list-info']);
			$link = Html::a($image . $info, $contact[4] ?? '#');
			$html .= Html::tag('li', $link);
		}

		$html = Html::tag('ul', $html, ['class' => 'contacts-list']);

		return Html::tag('div', $html, ['class' => 'direct-chat-contacts']);
	}

	/**
	 * @return string
	 */
	public function getMessages(): string
	{
		if (empty($this->messages)) return $this->noMessages;

		$html = '';

		foreach ($this->messages as $message) {
			$image = Html::img($message[2], ['class' => 'direct-chat-img', 'alt' => 'message user image']);
			$text = Html::tag('div', Html::encode($message[3]), ['class' => 'direct-chat-text']);

			if ($message[0] == $this->author) {
				$name = Html::tag('span', $message[0], ['class' => 'direct-chat-name float-right']);
				$date = Html::tag('span', $message[1], ['class' => 'direct-chat-timestamp float-left']);
				$info = Html::tag('div', $name . $date, ['class' => 'direct-chat-infos clearfix']);
				$html .= Html::tag('div', $info . $image . $text, ['class' => 'direct-chat-msg right']);
			} else {
				$name = Html::tag('span', $message[0], ['class' => 'direct-chat-name float-left']);
				$date = Html::tag('span', $message[1], ['class' => 'direct-chat-timestamp float-right']);
				$info = Html::tag('div', $name . $date, ['class' => 'direct-chat-infos clearfix']);
				$html .= Html::tag('div', $info . $image . $text, ['class' => 'direct-chat-msg']);
			}
		}

		return Html::tag('div', $html, ['class' => 'direct-chat-messages']);
	}

	/**
	 * @return string
	 */
	protected function getCardBody(): string
	{
		$html = $this->getMessages();
		$html .= $this->getContacts();
		$html .= $this->content;

		return Html::tag('div', $html, ['class' => $this->getCardBodyClass()]);
	}

	/**
	 * @return string
	 */
	protected function getCardFooter(): string
	{
		$input = Html::input('text', 'message', '', ['class' => 'form-control', 'placeholder' => $this->sendFormPlaceholder ?? '']);
		$button = Html::button($this->sendFormButtonTitle ?? 'Send', ['class' => "btn btn-{$this->chatColor}"]);
		$span = Html::tag('span', $button, ['class' => 'input-group-append']);
		$div = Html::tag('div', $input . $span, ['class' => 'input-group']);

		$html = Html::beginForm($this->sendFormUrl);
		$html .= $div;
		$html .= Html::endForm();

		return Html::tag('div', $html, ['class' => $this->getCardFooterClass()]);
	}

	/**
	 * @return string
	 */
	protected function getCardClass(): string
	{
		$class = "card direct-chat direct-chat-{$this->chatColor}";

		$class .= ($this->color && !$this->background && !$this->gradient) ? " card-{$this->color}" : '';
		$class .= ($this->outline && $this->color) ? ' card-outline' : '';
		$class .= ($this->background && $this->color) ? " bg-{$this->color}" : '';
		$class .= ($this->gradient && $this->color) ? " bg-gradient-{$this->color}" : '';
		$class .= ($this->shadow) ? " {$this->shadow}" : '';
		$class .= ($this->hide) ? ' collapsed-card' : '';

		return $class;
	}
}
