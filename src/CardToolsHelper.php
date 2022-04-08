<?php
namespace co0lc0der\Lte3Widgets;

/**
 * Class CardToolsHelper
 * @package co0lc0der\Lte3Widgets
 */
class CardToolsHelper
{
	/**
	 * @param string $title
	 * @param array $options
	 * @return array
	 */
	public static function createButton(string $title = '', array $options = []): array
	{
		return [
			'link',
			($title) ? "<i class=\"fas fa-plus mr-2\"></i>{$title}" : "<i class=\"fas fa-plus\"></i>",
			['create'],
			array_merge([
				'class' => 'btn btn-tool bg-success',
				'title' => $title,
			], $options),
		];
	}

	/**
	 * @param int $id
	 * @param string $title
	 * @param array $options
	 * @return array
	 */
	public static function profileButton(int $id, string $title = '', array $options = []): array
	{
		return [
			'link',
			($title) ? "<i class=\"fas fa-id-card mr-2\"></i>{$title}" : "<i class=\"fas fa-id-card\"></i>",
			['profile', 'id' => $id],
			array_merge([
				'class' => 'btn btn-tool bg-primary',
				'title' => $title,
			], $options),
		];
	}

	/**
	 * @param int $id
	 * @param string $title
	 * @param array $options
	 * @return array
	 */
	public static function updateButton(int $id, string $title = '', array $options = []): array
	{
		return [
			'link',
			($title) ? "<i class=\"fas fa-pencil-alt mr-2\"></i>{$title}" : "<i class=\"fas fa-pencil-alt\"></i>",
			['update', 'id' => $id],
			array_merge([
				'class' => 'btn btn-tool bg-warning',
				'title' => $title,
			], $options),
		];
	}

	/**
	 * @param int $id
	 * @param string $title
	 * @param array $options
	 * @return array
	 */
	public static function deleteButton(int $id, string $title = '', array $options = []): array
	{
		return [
			'link',
			($title) ? "<i class=\"fas fa-trash mr-2\"></i>{$title}" : "<i class=\"fas fa-trash\"></i>",
			['delete', 'id' => $id],
			array_merge([
				'class' => 'btn btn-tool bg-danger',
				'title' => $title,
				'data' => [
					'confirm' => 'Do you really want to delete this?',
					'method' => 'post',
				],
			], $options),
		];
	}

	/**
	 * @param bool $hide
	 * @param array $options
	 * @return array
	 */
	public static function collapseButton(bool $hide = false, array $options = []): array
	{
		return [
			'button',
			($hide) ? '<i class="fas fa-plus"></i>' : '<i class="fas fa-minus"></i>',
			array_merge([
				'data-card-widget' => 'collapse',
				'title' => 'Collapse/Restore',
			], $options),
		];
	}

	/**
	 * @param array $options
	 * @return array
	 */
	public static function expandButton(array $options = []): array
	{
		return [
			'button',
			'<i class="fas fa-expand"></i>',
			array_merge([
				'data-card-widget' => 'maximize',
				'title' => 'Maximize',
			], $options),
		];
	}

	/**
	 * @param array $options
	 * @return array
	 */
	public static function closeButton(array $options = []): array
	{
		return [
			'button',
			'<i class="fas fa-times"></i>',
			array_merge([
				'data-card-widget' => 'remove',
				'title' => 'Close',
			], $options),

		];
	}

	/**
	 * @param string $source
	 * @param array $options
	 * @return array
	 */
	public static function refreshButton(string $source = '#', array $options = []): array
	{
		return [
			'button',
			'<i class="fas fa-sync-alt"></i>',
			array_merge([
				'data-source' => $source,
				'data-source-selector' => '#card-refresh-content',
				'data-card-widget' => 'card-refresh',
				'title' => 'Refresh',
			], $options),
		];
	}

	/**
	 * @param array $options
	 * @return array
	 */
	public static function contactsButton(array $options = []): array
	{
		return [
			'button',
			'<i class="fas fa-comments"></i>',
			array_merge([
				'data-widget' => 'chat-pane-toggle',
				'title' => 'Contacts',
			], $options),
		];
	}
}
