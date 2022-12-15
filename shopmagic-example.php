<?php
/**
 * Plugin Name: ShopMagic Example
 * Plugin URI: https://docs.shopmagic.app/collection/159-developer-docs?utm_source=shopmagic-example&utm_medium=plugin&utm_campaign=for-developers&utm_term=plugin-uri&utm_content=docs
 * Description: Example ShopMagic plugin to show how to add custom events, filters, actions and placeholders.
 * Version: 2.0.0
 * Author: WP Desk
 * Author URI: https://shopmagic.app/
 * Text Domain: shopmagic-example
 * Domain Path: /languages/
 * Requires at least: 5.0
 * Tested up to: 6.1
 * WC requires at least: 4.2
 * WC tested up to: 7.2
 * Requires PHP: 7.2
 * Copyright 2022 WP Desk Ltd
 **/

add_filter( 'shopmagic/core/events', 'shopmagic_add_custom_events' );
/**
 * Add custom events
 *
 * @param \WPDesk\ShopMagic\Event\Event[] $hashmap Hashmap with built in events.
 *
 * @return \WPDesk\ShopMagic\Event\Event[] Hashmap with appended events.
 */
function shopmagic_add_custom_events( array $hashmap ) {
	require_once( __DIR__ . '/events/AfterResendOrderEmailEvent.php' );

	$hashmap['custom_after_resend_order_email_event'] = new \ShopMagicExample\AfterResendOrderEmailEvent();

	return $hashmap;
}

add_filter( 'shopmagic/core/filters', 'shopmagic_add_custom_filters' );
/**
 * Add custom filters
 *
 * @param \WPDesk\ShopMagic\Filter\Filter[] $hashmap Hashmap with built in filters.
 *
 * @return \WPDesk\ShopMagic\Filter\Filter[] Hashmap with appended filters.
 */
function shopmagic_add_custom_filters( array $hashmap ) {
	require_once( __DIR__ . '/filters/OrderCustomerProvidedNote.php' );

	$hashmap['custom_order_customer_provided_note_filter'] = new \ShopMagicExample\OrderCustomerProvidedNote();

	return $hashmap;
}

add_filter( 'shopmagic/core/actions', 'shopmagic_add_custom_actions' );
/**
 * Add custom actions
 *
 * @param \WPDesk\ShopMagic\Action\Action[] $hashmap Hashmap with built in actions.
 *
 * @return \WPDesk\ShopMagic\Action\Action[] Hashmap with appended actions.
 */
function shopmagic_add_custom_actions( array $hashmap ) {
	require_once( __DIR__ . '/actions/AddOrderNoteAction.php' );

	$hashmap['custom_add_order_note_action'] = new \ShopMagicExample\AddOrderNoteAction();

	return $hashmap;
}

add_filter( 'shopmagic/core/placeholders', 'shopmagic_add_custom_placeholders' );
/**
 * Add custom placeholders
 *
 * @param \WPDesk\ShopMagic\Placeholder\Placeholder[] $hashmap Hashmap with built in placeholders.
 *
 * @return \WPDesk\ShopMagic\Placeholder\Placeholder[] Hashmap with appended placeholders.
 */
function shopmagic_add_custom_placeholders( array $hashmap ) {
	require_once( __DIR__ . '/placeholders/OrderNumberPlaceholder.php' );

	$hashmap[] = new \ShopMagicExample\OrderNumberPlaceholder();

	return $hashmap;
}
