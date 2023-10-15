# DirectChatWidget

Since [v0.5](https://github.com/co0lc0der/yii2-adminlte3-widgets/releases/tag/v0.5)

This class is extended of [CardWidget](CardWidget.md) therefore it has the same properties but it has its own properties listed below.

## Public properties, its types and default values

**excluding CardWidget properties**

- `string $chatColor = 'primary'` - chat messages color ([Bootstrap 4 colors](https://getbootstrap.com/docs/4.6/utilities/colors/) or additional [colors of AdminLTE](https://adminlte.io/docs/3.1//layout.html))
- `string $author = ''` - author's name, this property is used to highlight author's messages with $chatColor
- `array $messages = []` - array of messages
- `array $contacts = []` - contacts list. if it is empty there will be no chat icon in the header of the chat
- `string $noMessages = 'There is no messages in the chat'` - the message which will be shown if $messages is empty
- `string $sendFormUrl = ''` - URL to send a new message
- `string $sendFormButtonTitle = 'Send'` - title of send button
- `string $sendFormPlaceholder = 'Type Message ...'` - placeholder for send form

## Example

```php
<?php DirectChatWidget::begin([
	'title' => 'Admin direct chat',
	'color' => 'info',
	'chatColor' => 'info',
	'close' => true,
	'author' => 'Admin',
	'sendFormPlaceholder' => 'Type your message here ...',
	'sendFormButtonTitle' => '<i class="fas fa-paper-plane"></i>',
	'tools' => [
		CardToolsHelper::label('3', [
			'class' => 'badge badge-dark',
			'title' => '3 new messages',
		]),
		// OR you can use classic array
		/*[
			'label',
			'3',
			[
				'class' => 'badge badge-dark',
				'title' => '3 new messages',
			],
		],*/
	],
	'messages' => [
		[
			'Admin',
			'23 Jan 2:00 pm',
			'../assets/img/user1-128x128.jpg',
			'Is this template really for free? That\'s unbelievable!',
		],
		[
			'Sarah Bullock',
			'23 Jan 2:04 pm',
			'../assets/img/user5-128x128.jpg',
			'You better believe it!',
		],
		[
			'Admin',
			'23 Jan 5:07 pm',
			'../assets/img/user1-128x128.jpg',
			'Working with AdminLTE on a great new app! Wanna join?',
		],
		[
			'Sarah Bullock',
			'23 Jan 6:10 pm',
			'../assets/img/user5-128x128.jpg',
			'I would love to.',
		],
		[
			'Admin',
			'25 Jan 1:00 pm',
			'../assets/img/user1-128x128.jpg',
			'test message!',
		],
	],
	'contacts' => [
		[
			'Admin',
			'1/28/2022',
			'../assets/img/user1-128x128.jpg',
			'How have you been? I was...',
			'#',
		],
		[
			'Sarah Bullock',
			'1/28/2022',
			'../assets/img/user5-128x128.jpg',
			'I will be waiting for...',
			'#link_to_profile',
		],
	],
]); ?>

<!-- you can manually put HTML messages here* -->
<!-- you can manually put HTML contacts here* -->

<?php DirectChatWidget::end(); ?>
```

\* - leave empty $messages and/or $contacts properties and see [AdminLTE documentation](https://adminlte.io/docs/3.1/components/direct-chat.html) for examples.

### Rendered DirectChat

![Rendered DirectChat](https://pics.code-notes.ru/directchat_example1.png "Rendered DirectChat")

### Rendered DirectChat (Contact list)

![Rendered DirectChat (Contact list)](https://pics.code-notes.ru/directchat_example2.png "Rendered DirectChat (Contact list)")

Back to [doc index](index.md) or [readme](../README.md)
