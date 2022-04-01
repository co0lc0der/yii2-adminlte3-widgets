# AdminLTE 3 widgets for Yii2

[![Latest Version](https://img.shields.io/github/release/co0lc0der/yii2-adminlte3-widgets?style=flat-square)](https://github.com/co0lc0der/yii2-adminlte3-widgets/release)
[![Packagist Downloads](https://img.shields.io/packagist/dt/co0lc0der/yii2-adminlte3-widgets?color=yellow&style=flat-square)](https://packagist.org/packages/co0lc0der/yii2-adminlte3-widgets)
[![GitHub license](https://img.shields.io/github/license/co0lc0der/yii2-adminlte3-widgets?style=flat-square)](https://github.com/co0lc0der/yii2-adminlte3-widgets/blob/main/LICENSE.md)

AdminLTE 3 widgets for Yii2. At present time the extension includes

* [CardWidget](#cardwidget)
* [TabsCardWidget](#tabscardwidget)
* [ProfileCardWidget](#profilecardwidget)
* [ContactCardWidget](#contactcardwidget)
* [DirectChatWidget](#directchatwidget)

**Based on [AdminLTE 3.1.0](https://github.com/ColorlibHQ/AdminLTE/releases/tag/v3.1.0)** More widgets, helpers and Gii will be added in the future.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
composer require --prefer-dist co0lc0der/yii2-adminlte3-widgets "*"
```

or add

```js
"co0lc0der/yii2-adminlte3-widgets": "*"
```

to the require section of your `composer.json` file.

## CardWidget

### Public properties, its types and default values

- `string $title` - title of a card
- `string $color = ''` - color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
- `bool $outline = false` - makes an outlined card
- `bool $background = false` - makes a colored card, uses $color property (Bootstrap 4 colors)
- `bool $gradient = false` - makes a gradient card, uses $color property (Bootstrap 4 colors)
- `string $footer = ''` - content of card footer
- `bool $collapse = true` - show / hide collapse button inside card header
- `bool $hide = false` - show / hide a collapsed card after initialization
- `bool $expand = false` - show / hide maximize button inside card header
- `bool $close = false` - show / hide close button inside card header
- `string $ajaxLoad = ''` - URL for loading data, if it is not empty it shows a spinner before data loaded
- `string $ajaxOverlay = 'overlay'` - type of loading overlay ('overlay', 'dark')
- `string $shadow = ''` - type of card shadow ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
- `array $tools = []` - list of header custom tools (labels, buttons, links)

### Example

```php
<?php CardWidget::begin([
    'title' => 'Some title',    // title of a card
    'color' => 'dark',          // bootstrap color name 'success', 'danger' еtс.
    'gradient' => true,         // use gradient background
    'expand' => true,           // show maximize button in card header
    'footer' => 'some footer',  // content of card footer
    'shadow' => 'shadow-sm',    // use small shadow
    'close' => true,            // show close button in card header
    'tools' => [                // array with config to add custom labels, buttons or links
        [
            'label',
            'new',
            [
                'class' => 'badge badge-primary',
                'data-toggle' => 'tooltip',
                'title' => 'New',
            ],
        ],
        [
            'link',
            '<i class="fas fa-pencil-alt" aria-hidden="true"></i>',
            ['update', 'id' => 1],
            ['title' => 'Update it'],
        ],
        [
            'button',
            '<i class="fas fa-cog"></i>',
            [
                'class' => 'btn btn-tool',
                'title' => 'some tooltip',
            ],
        ]
    ],
]);
?>

<?= 'some content'; ?>

<?php CardWidget::end(); ?>
```

### Rendered card

![Rendered card](https://code-notes.ru/card_example.png "Rendered card")

## TabsCardWidget

### Public properties, its types and default values

- `string $title` - title of a card, if title is empty tabs will be placed on the left side of the card header
- `string $color = ''` - color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
- `bool $outline = false` - makes an outlined card
- `bool $background = false` - makes a colored card, uses $color property (Bootstrap 4 colors)
- `bool $gradient = false` - makes a gradient card, uses $color property (Bootstrap 4 colors)
- `string $footer = ''` - content of card footer
- `string $shadow = ''` - type of card shadow ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
- `array $tabs = []` - list of tabs (see an example below)

### Example

```php
<?= TabsCardWidget::widget([
    'title' => 'Tabs example',
    'footer' => 'some footer',
    'tabs' => [
        [
            'title' => 'Tab1',
            'id' => 'tab_1',
            'content' => 'A wonderful serenity has taken possession of my entire soul,
                like these sweet mornings of spring which I enjoy with my whole heart.',
            'active' => true,
        ],
        [
            'title' => 'Tab2',
            'id' => 'tab_2',
            'content' => 'The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary.',
        ]
    ]
]);
?>
```

### Rendered TabsCard

![Rendered TabsCard](https://code-notes.ru/tabscard_example.png "Rendered TabsCard")

### Rendered TabsCard without title

![Rendered TabsCard without title](https://code-notes.ru/tabscard_example2.png "Rendered TabsCard without title")

## ProfileCardWidget

### Public properties, its types and default values

- `string $name` - user name
- `string $image = ''` - user image
- `string $position = ''` - user role or position
- `string $color = ''` - color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
- `string $footer = ''` - content of card footer
- `string $shadow = ''` - type of card shadow ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
- `array $rows = []` - list of rows (see an example below)

### Example

```php
<?php ProfileCardWidget::begin([
    'name' => 'Jonathan Burke Jr.',
    'position' => 'Software Engineer',
    'image' => '../avatars/user2-160x160.jpg',
    'color' => 'info',
    'rows' => [
        'Followers' => [
            '1,521',
            '#url'
        ],
        'Following'	=> ['373'],
        'Friends'	=> ['3,127'],
        'Projects'	=> [
            '7',
            'https://example.com'
        ],
    ],
]);
?>

<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>

<?php ProfileCardWidget::end();?>
```

### Rendered ProfileCard

![Rendered ProfileCard](https://code-notes.ru/profilecard_example.png "Rendered ProfileCard")

## ContactCardWidget

### Public properties, its types and default values

- `string $name` - user name
- `string $image = ''` - user image
- `string $position = ''` - user role or position (title of a card)
- `$about = ''` - about user. format: array ['Web Designer', 'UX'] or string
- `string $aboutTitle = 'About: '` - about title
- `string $aboutSeparator = ' / '` - separator of about user if it is an array
- `array $info = []` - list of rows. format: FontAwesome icon => text
- `string $color = ''` - color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
- `bool $outline = false` - makes an outlined card
- `$footer = ''` - content of card footer, it can be some string or an array of buttons
- `string $shadow = ''` - type of card shadow ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
- `bool $collapse = true` - show / hide collapse button inside card header
- `bool $hide = false` - show / hide a collapsed card after initialization
- `bool $expand = false` - show / hide maximize button inside card header
- `bool $close = false` - show / hide close button inside card header
- `array $tools = []` - list of header custom tools (labels, buttons, links)

### Example

```php
<?= ContactCardWidget::widget([
    'name' => 'Jonathan Burke Jr.',
    'position' => 'Software Engineer',
    'image' => '../avatars/user2-160x160.jpg',
    'color' => 'info',
    'outline' => true,
    'close' => true,
    'aboutTitle' => 'Skills: ',
    'about' => ['Web Designer', 'UX', 'Graphic Artist', 'Coffee Lover'],
    'info' => [
        'fa-building' => 'Address: Demo Street 123, Demo City 04312, NJ',
        'fa-phone' => 'Phone #: <a href="tel:+80012122352">+ 800 - 12 12 23 52</a>',
        'fa-envelope' => 'Email: <a href="mailto:jonatan@example.com">jonatan@example.com</a>',
    ],
    'footer' => [
        [
            '<i class="fas fa-comments"></i>',
            'bg-teal',
            ['update', 'id' => 1],
            [],
        ],
        [
            '<i class="fas fa-user"></i> View profile',
            'btn-primary',
            '#profile',
            [],
        ],
    ],
]);
?>
```

### Rendered ContactCard

![Rendered ContactCard](https://code-notes.ru/contactcard_example.png "Rendered ContactCard")

## DirectChatWidget

This class is extended of CardWidget therefore it has the same properties but it has its own properties listed below.

### Public properties (excluding CardWidget properties), its types and default values

- `string $chatColor = 'primary'` - chat messages color (Bootstrap 4 colors. 'success', 'danger' еtс.)
- `string $author = ''` - author's name, this property is used to highlight author's messages with $chatColor
- `array $messages = []` - array of messages
- `array $contacts = []` - contacts list. if it is empty there will be no chat icon in the header of the chat
- `string $noMessages = 'There is no messages in the chat'` - the message which will be shown if $messages is empty
- `string $sendFormUrl = ''` - URL to send a new message
- `string $sendFormButtonTitle = 'Send'` - title of send button
- `string $sendFormPlaceholder = 'Type Message ...'` - placeholder for send form

### Example

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
        [
            'label',
            '3',
            [
                'class' => 'badge badge-dark',
                'title' => '3 new messages',
            ],
        ],
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
]);
?>

<!-- you can manually put html messages here -->
<!-- you can manually put html contacts here -->

<?php DirectChatWidget::end(); ?>
```

### Rendered DirectChat

![Rendered DirectChat](https://code-notes.ru/directchat_example1.png "Rendered DirectChat")

### Rendered DirectChat (Contact list)

![Rendered DirectChat (Contact list)](https://code-notes.ru/directchat_example2.png "Rendered DirectChat (Contact list)")
