# UserCardWidget

Since [v0.6](https://github.com/co0lc0der/yii2-adminlte3-widgets/releases/tag/v0.6)

**Pay attention!** You should use `echo` and `widget()` method when you work with the widget. It uses [ShadowSupport](ShadowSupportTrait.md), [ColorSupport](ColorSupportTrait.md) and [CustomCssSupport](CustomCssSupportTrait.md) traits.

## Public properties, its types and default values

- `string $name` - username
- `string $image = ''` - user image
- `string $position = ''` - user role or position
- `string $background = 'info'` - color of a card header ([Bootstrap 4 colors](https://getbootstrap.com/docs/4.6/utilities/colors/) or additional [colors of AdminLTE](https://adminlte.io/docs/3.1//layout.html)) or a path to background image
- `bool $gradient = false` - makes a gradient card, uses $background property
- `array $cols = []` - list of columns, format: [title => text] (see an example below)
-	`string $textAlign = 'center'` - alignment of name and position ('left', 'right', 'center').

## Example 1

```php
<?= UserCardWidget::widget([
	'name' => 'Jonathan Burke Jr.',
	'position' => 'Software developer',
	'image' => '../avatars/user2-160x160.jpg',
	'shadow' => 'shadow-sm',
	'background' => 'navy',
	'textAlign' => 'left',
	'cols' => [
		'PROJECTS' => '24',
		'FOLLOWERS' => '1,521',
		'TASKS' => '135',
		'COMPLETED PROJECTS' => '12',
	],
]); ?>
```

### Rendered UserCard with background color

![Rendered UserCard with background color](https://pics.code-notes.ru/usercard_example1.png "Rendered UserCard with background color")

## Example 2

```php
<?= UserCardWidget::widget([
	'name' => 'Sarah Bullock',
	'position' => 'UI/UX designer',
	'image' => '../assets/img/user5-128x128.jpg',
	'color' => 'white',
	'shadow' => 'shadow-sm',
	'background' => '../assets/img/photo1.png',
	'textAlign' => 'right',
	'cols' => [
		'PROJECTS' => '16',
		'FOLLOWERS' => '1,710',
		'PRODUCTS' => '25',
	],
]); ?>
```

### Rendered UserCard with background image

![Rendered UserCard with background image](https://pics.code-notes.ru/usercard_example2.png "Rendered UserCard with background image")

Back to [doc index](index.md) or [readme](../README.md)
