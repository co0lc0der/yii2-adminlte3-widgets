# ProfileCardWidget

Since [v0.3](https://github.com/co0lc0der/yii2-adminlte3-widgets/releases/tag/v0.3)

This class is extended of [CardWidget](CardWidget.md) therefore it has the same properties but it has its own properties listed below.

## Public properties (excluding CardWidget properties), its types and default values

- `string $name` - username
- `string $image = ''` - user image
- `string $position = ''` - user role or position
- `array $rows = []` - list of rows (see an example below)

## Example

```php
<?php ProfileCardWidget::begin([
	'name' => 'Jonathan Burke Jr.',
	'position' => 'Software Engineer',
	'image' => '../avatars/user2-160x160.jpg',
	'color' => 'info',
	'outline' => true,
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
]); ?>

<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>

<?php ProfileCardWidget::end();?>
```

### Rendered ProfileCard

<<<<<<< HEAD
![Rendered ProfileCard](http://pics.code-notes.pro/profilecard_example.png "Rendered ProfileCard")
=======
![Rendered ProfileCard](https://pics.code-notes.ru/profilecard_example.png "Rendered ProfileCard")
>>>>>>> d2642029e0e442efd17ceeda396c514dc4855cdb

Back to [doc index](index.md) or [readme](../README.md)
