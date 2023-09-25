# CardWidget

This is the basic class. It uses [CardToolsSupport](CardToolsSupportTrait.md), [ShadowSupport](ShadowSupportTrait.md), [ColorSupport](ColorSupportTrait.md) and [CustomCssSupport](CustomCssSupportTrait.md) traits.

## Public properties, its types and default values

- `string $id = ''` - id of a card
- `string $title = ''` - title of a card
- `bool $outline = false` - makes an outlined card
- `bool $background = false` - makes a colored card, uses $color property ([Bootstrap 4 colors](https://getbootstrap.com/docs/4.6/utilities/colors/) or additional [colors of AdminLTE](https://adminlte.io/docs/3.1//layout.html))
- `bool $gradient = false` - makes a gradient card, uses $color property
- `array|string $footer = ''` - content of card footer
- `string $ajaxLoad = ''` - URL for loading data, if it is not empty it shows a spinner before data loaded
- `string $ajaxOverlay = 'overlay'` - type of loading overlay ('overlay', 'dark')

## Example 1

```php
<?php CardWidget::begin([
    'id' => 'some-id',          // id of a card
	'title' => 'Some title',    // title of a card
	'color' => 'dark',          // bootstrap color name 'success', 'danger' еtс.
	'gradient' => true,         // use gradient background
	'expand' => true,           // show maximize button in card header
	'footer' => 'some footer',  // content of card footer
	'shadow' => 'shadow-sm',    // use small shadow
	'close' => true,            // show close button in card header
	'tools' => [                // array with config to add custom labels, buttons or links
		CardToolsHelper::label('new', [
			'class' => 'badge badge-primary',
			'title' => 'New',
		]),
		// OR you can use classic array
		/*[
			'label',
			'new',
			[
				'class' => 'badge badge-primary',
				'title' => 'New',
			],
		],*/
		CardToolsHelper::a(['update', 'id' => 1], 'pencil-alt', '', ['title' => 'Update it']),
		// OR you can use classic array
		/*[
			'link',
			'<i class="fas fa-pencil-alt"></i>',
			['update', 'id' => 1],
			['title' => 'Update it'],
		],*/
		CardToolsHelper::button('cog', '', ['title' => 'some tooltip']),
		// OR you can use classic array
		/*[
			'button',
			'<i class="fas fa-cog"></i>',
			['title' => 'some tooltip'],
		],*/
	],
]); ?>

<?= 'some content'; ?>

<?php CardWidget::end(); ?>
```

### Rendered card

![Rendered card](https://code-notes.ru/card_example.png "Rendered card")

## Example 2

```php
<?php CardWidget::begin([
	'title' => 'Folders',
	'cssClasses' => [3 => 'p-0'],
]); ?>

<ul class="nav nav-pills flex-column">
	<li class="nav-item active">
		<a href="#" class="nav-link">
			<i class="fas fa-inbox"></i> Inbox
			<span class="badge bg-primary float-right">12</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="#" class="nav-link">
			<i class="far fa-envelope"></i> Sent
		</a>
	</li>
	<li class="nav-item">
		<a href="#" class="nav-link">
			<i class="far fa-file-alt"></i> Drafts
			<span class="badge bg-warning float-right">3</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="#" class="nav-link">
			<i class="far fa-trash-alt"></i> Trash
		</a>
	</li>
</ul>

<?php CardWidget::end(); ?>
```

### Rendered card

![Rendered card](https://code-notes.ru/card_example2.png "Rendered card")

## Header dropdown button and footer button example

Support since v0.5.2. Use `['---']` to put a divider into header dropdown menu. Array format:

```php
['URL', 'link content', ['options']],
['---'],
['#', 'item 3', ['title' => 'THIS IS ITEM #3!']],
```

```php
<?php CardWidget::begin([
	'title' => 'Create Actions',
	'color' => 'lime',
	'outline' => true,
	'collapse' => false,
	'cssClasses' => [4 => 'p-1'],
	'footer' => [
		[
			'<i class="fas fa-comments"></i>',
			'bg-secondary',
			['update', 'id' => 1],
		],
	],
	'tools' => [
		CardToolsHelper::submenu([
			['#1', 'item 1'],
			['#2', 'item 2'],
			['---'],
			['#3', 'item 3', ['title' => 'THIS IS ITEM #3!']],
		], 'bars', true),
		// OR you can use classic array
		/*[
			[
				['#1', 'item 1'],
				['#2', 'item 2'],
				['---'],
				['#3', 'item 3', ['title' => 'THIS IS ITEM #3!']],
			],
			'bars',
			true,
		],*/
	],
]); ?>
	<p>
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
		Aenean commodo ligula eget dolor. Aenean massa.
		Com sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
	</p>
<?php CardWidget::end(); ?>
```

### Rendered card

![Rendered card](https://code-notes.ru/dropdown_example.png "Rendered card")

Back to [doc index](index.md) or [readme](../README.md)
