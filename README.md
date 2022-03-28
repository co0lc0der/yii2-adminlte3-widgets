# AdminLTE 3 widgets for Yii2

[![Latest Version](https://img.shields.io/github/release/co0lc0der/yii2-adminlte3-widgets?style=flat-square)](https://github.com/co0lc0der/yii2-adminlte3-widgets/release)
[![Packagist Downloads](https://img.shields.io/packagist/dt/co0lc0der/yii2-adminlte3-widgets?color=yellow&style=flat-square)](https://packagist.org/packages/co0lc0der/yii2-adminlte3-widgets)
[![GitHub license](https://img.shields.io/github/license/co0lc0der/yii2-adminlte3-widgets?style=flat-square)](https://github.com/co0lc0der/yii2-adminlte3-widgets/blob/main/LICENSE.md)

AdminLTE 3 widgets for Yii2. At present time the extension has CardWidget only. More widgets, helpers and Gii will be added in the future.

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
- `string $shadow = ''` - type of loading overlay ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
- `array $tools = []` - list of header custom tools (labels, buttons, links)

## TabsCardWidget

### Public properties, its types and default values

- `string $title` - title of a card, if title is empty tabs will be placed on the left side of the card header
- `string $color = ''` - color of a card header (Bootstrap 4 colors. 'success', 'danger' еtс.)
- `bool $outline = false` - makes an outlined card
- `bool $background = false` - makes a colored card, uses $color property (Bootstrap 4 colors)
- `bool $gradient = false` - makes a gradient card, uses $color property (Bootstrap 4 colors)
- `string $footer = ''` - content of card footer
- `string $shadow = ''` - type of loading overlay ('shadow-none', 'shadow-sm', 'shadow', 'shadow-lg')
- `array $tabs = []` - list of tabs (see an example below)

## Examples

### CardWidget

```php
<?php CardWidget::begin([
    'title' => 'Some title',    // title of a card
    'color' => 'dark',          // bootstrap color name 'success', 'danger' еtс.
    'gradient' => true,         // use gradient background
    'expand' => true,           // show maximize button in card header
    'footer' => 'some footer',  // content of card footer
    'collapse' => true,         // show collapse button in card header
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
            [
                'title' => 'Update it',
            ],
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

### TabsCardWidget

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