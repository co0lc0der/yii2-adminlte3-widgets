<?php

namespace co0lc0der\Lte3Widgets;

/**
 * Class CardToolsHelper
 * @package co0lc0der\Lte3Widgets
 */
class CardToolsHelper
{
	const DEFAULT_ICON = 'circle';
	const CREATE_TITLE = 'Create';
	const PROFILE_TITLE = 'Profile';
	const UPDATE_TITLE = 'Update';
	const DELETE_CONFIRM_TEXT = 'Do you really want to delete this?';
	const COLLAPSE_TITLE = 'Collapse/Restore';
	const EXPAND_TITLE = 'Maximize';
	const CLOSE_TITLE = 'Close';
	const REFRESH_TITLE = 'Refresh';
	const CONTACTS_TITLE = 'Contacts';

	/**
	 * @param string $icon FontAwesone icon (without 'fa-' prefix)
	 * @param string $title Title of a button and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function button(string $icon = self::DEFAULT_ICON, string $title = '', array $options = []): array
	{
		return [
			'button',
			($title) ? "<i class=\"fas fa-{$icon} mr-2\"></i>{$title}" : "<i class=\"fas fa-{$icon}\"></i>",
			array_merge([
				'title' => $title,
			], $options),
		];
	}

	/**
	 * @param string|array $url Yii standard URL
	 * @param string $icon FontAwesone icon (without 'fa-' prefix)
	 * @param string $title Title of a link and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function a($url = '#', string $icon = self::DEFAULT_ICON, string $title = '', array $options = []): array
	{
		return [
			'link',
			($title) ? "<i class=\"fas fa-{$icon} mr-2\"></i>{$title}" : "<i class=\"fas fa-{$icon}\"></i>",
			$url,
			array_merge([
				'title' => $title,
			], $options),
		];
	}

	/**
	 * @param string $title Title of a badge and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function label(string $title, array $options = []): array
	{
		return [
			'label',
			$title,
			array_merge([
				'title' => $title,
			], $options),
		];
	}

	/**
	 * @param string $title Title of a link and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function createButton(string $title = self::CREATE_TITLE, array $options = []): array
	{
		return CardToolsHelper::a('create', 'plus', $title, array_merge([
			'class' => 'btn btn-tool bg-success',
		], $options));
	}

	/**
	 * @param int $id User's ID for a profile link
	 * @param string $title Title of a link and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function profileButton(int $id, string $title = self::PROFILE_TITLE, array $options = []): array
	{
		return CardToolsHelper::a(['profile', 'id' => $id], 'id-card', $title, array_merge([
			'class' => 'btn btn-tool bg-primary',
		], $options));
	}

	/**
	 * @param int $id ID for an update link
	 * @param string $title Title of a link and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function updateButton(int $id, string $title = self::UPDATE_TITLE, array $options = []): array
	{
		return CardToolsHelper::a(['update', 'id' => $id], 'pencil-alt', $title, array_merge([
			'class' => 'btn btn-tool bg-warning',
		], $options));
	}

	/**
	 * @param int $id ID for a delete link
	 * @param string $title Title of a link and 'title' attribute
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function deleteButton(int $id, string $title = '', array $options = []): array
	{
		return CardToolsHelper::a(['delete', 'id' => $id], 'trash', $title, array_merge([
			'class' => 'btn btn-tool bg-danger',
			'data' => [
				'confirm' => self::DELETE_CONFIRM_TEXT,
				'method' => 'post',
			],
		], $options));
	}

	/**
	 * @param bool $hide Is this collapsed card?
	 * @param string $title 'title' attribute of a button
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function collapseButton(bool $hide = false, string $title = self::COLLAPSE_TITLE, array $options = []): array
	{
		return CardToolsHelper::button(($hide) ? 'plus' : 'minus', '', array_merge([
			'data-card-widget' => 'collapse',
			'title' => $title,
		], $options));
	}

	/**
	 * @param string $title 'title' attribute of a button
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function expandButton(string $title = self::EXPAND_TITLE, array $options = []): array
	{
		return CardToolsHelper::button('expand', '', array_merge([
			'data-card-widget' => 'maximize',
			'title' => $title,
		], $options));
	}

	/**
	 * @param string $title 'title' attribute of a button
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function closeButton(string $title = self::CLOSE_TITLE, array $options = []): array
	{
		return CardToolsHelper::button('times', '', array_merge([
			'data-card-widget' => 'remove',
			'title' => $title,
		], $options));
	}

	/**
	 * @param string $source URL for getting data
	 * @param string $title 'title' attribute of a button
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function refreshButton(string $source = '#', string $title = self::REFRESH_TITLE, array $options = []): array
	{
		return CardToolsHelper::button('sync-alt', '', array_merge([
			'data-source' => $source,
			'data-source-selector' => '#card-refresh-content',
			'data-card-widget' => 'card-refresh',
			'title' => $title,
		], $options));
	}

	/**
	 * @param string $title 'title' attribute of a button
	 * @param array $options Yii standard options for HTML tag
	 * @return array
	 */
	public static function contactsButton(string $title = self::CONTACTS_TITLE, array $options = []): array
	{
		return CardToolsHelper::button('comments', '', array_merge([
			'data-widget' => 'chat-pane-toggle',
			'title' => $title,
		], $options));
	}

	/**
	 * @param array $menu array of menu items
	 * @param string $icon FontAwesone icon (without 'fa-' prefix)
	 * @param bool $arrow show / hide a small arrow
	 * @return array
	 */
	public static function submenu(array $menu, string $icon = 'ellipsis-v', bool $arrow = false): array
	{
		return [
			$menu,
			$icon,
			$arrow,
		];
	}
}
