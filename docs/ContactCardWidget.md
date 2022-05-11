# ContactCardWidget

Since [v0.4](https://github.com/co0lc0der/yii2-adminlte3-widgets/releases/tag/v0.4)

**Pay attention!** You should use `echo` and `widget()` method when you work with the widget. It uses [CardToolsSupport](CardToolsSupportTrait.md), [ShadowSupport](ShadowSupportTrait.md), [ColorSupport](ColorSupportTrait.md) and [CustomCssSupport](CustomCssSupportTrait.md) traits.

## Public properties, its types and default values

- `string $name` - username
- `string $image = ''` - user image
- `string $position = ''` - user role or position (title of a card)
- `array|string $about = ''` - about user. format: array ['Web Designer', 'UX'] or string
- `string $aboutTitle = 'About: '` - about title
- `string $aboutSeparator = ' / '` - separator of about user if it is an array
- `array $info = []` - list of rows. format: FontAwesome icon => text
- `bool $outline = false` - makes an outlined card
- `string|array $footer = ''` - content of card footer, it can be some string or an array of buttons

## Example

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
]); ?>
```

### Rendered ContactCard

![Rendered ContactCard](https://code-notes.ru/contactcard_example.png "Rendered ContactCard")

Back to [doc index](index.md) or [readme](../README.md)
