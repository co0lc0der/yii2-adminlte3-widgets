# TabsCardWidget

Since [v0.2](https://github.com/co0lc0der/yii2-adminlte3-widgets/releases/tag/v0.2)

**Pay attention!** You should use `echo` and `widget()` method when you work with the widget. It uses [ShadowSupport](ShadowSupportTrait.md), [ColorSupport](ColorSupportTrait.md) and [CustomCssSupport](CustomCssSupportTrait.md) traits.

## Public properties, its types and default values

- `string $title = ''` - title of a card, if title is empty tabs will be placed on the left side of the card header
- `bool $outline = false` - makes an outlined card
- `bool $background = false` - makes a colored card, uses $color property ([Bootstrap 4 colors](https://getbootstrap.com/docs/4.6/utilities/colors/) or additional [colors of AdminLTE](https://adminlte.io/docs/3.1//layout.html))
- `bool $gradient = false` - makes a gradient card, uses $color property
- `array|string $footer = ''` - content of card footer (array is supported since v0.6)
- `array $tabs = []` - list of tabs (see an example below)

## Example

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
]); ?>
```

### Rendered TabsCard

![Rendered TabsCard](http://pics.code-notes.pro/tabscard_example.png "Rendered TabsCard")

### Rendered TabsCard without title

![Rendered TabsCard without title](http://pics.code-notes.pro/tabscard_example2.png "Rendered TabsCard without title")

Back to [doc index](index.md) or [readme](../README.md)
