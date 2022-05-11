# SocialWidget

Since [v0.6](https://github.com/co0lc0der/yii2-adminlte3-widgets/releases/tag/v0.6)

**Pay attention!** You should use `echo` and `widget()` method when you work with the widget. It uses [ShadowSupport](ShadowSupportTrait.md), [ColorSupport](ColorSupportTrait.md) and [CustomCssSupport](CustomCssSupportTrait.md) traits.

## Public properties, its types and default values

- `string $name` - username
- `string $image = ''` - user image
- `string $position = ''` - user role or position (title of a card)
- `bool $gradient = false` - makes a gradient card, uses $color property ([Bootstrap 4 colors](https://getbootstrap.com/docs/4.6/utilities/colors/) or additional [colors of AdminLTE](https://adminlte.io/docs/3.1//layout.html))
- `array $rows = []` - list of rows (see an example below).

## Example

```php
<?= SocialWidget::widget([
	'name' => 'Jonathan Burke Jr.',
	'position' => 'Senior backend developer',
	'image' => '../avatars/user2-160x160.jpg',
	'color' => 'lightblue',
	'shadow' => 'shadow',
	'rows' => [
		'Projects' => [
			'31',
			'#url',
			'primary'
		],
		'Tasks'	=> [
			'5',
			'#',
			'navy'
		],
		'Completed Projects' => [
			'12',
			'#',
			'success'
		],
		'Followers'	=> [
			'842',
			'https://example.com',
			'purple'
		],
	],
]); ?>
```

### Rendered SocialWidget

![Rendered SocialWidget](https://code-notes.ru/social_example.png "Rendered SocialWidget")

Back to [doc index](index.md) or [readme](../README.md)
