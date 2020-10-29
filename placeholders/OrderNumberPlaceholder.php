<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;

class OrderNumberPlaceholder extends WooCommerceOrderBasedPlaceholder {

	/**
	 * Set name for the placeholder
	 *
	 * parent::get_slug() will return "order", so your placeholder will be "order.number"
	 *
	 * @return string
	 */
	public function get_slug() {
		return parent::get_slug() . '.number';
	}

	/**
	 * Display order formatted numer
	 *
	 * This is a simple placeholder without any parameters
	 *
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		return $this->is_order_provided() ? $this->get_order()->get_order_number() : '';
	}
}
