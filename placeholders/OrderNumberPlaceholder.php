<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Workflow\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;

class OrderNumberPlaceholder extends WooCommerceOrderBasedPlaceholder {

	/**
	 * Set name for the placeholder
	 *
	 * parent::get_slug() will return "order", so your placeholder will be "order.number"
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return 'number';
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
	public function value( array $parameters ): string {
		if ( $this->resources->has( \WC_Order::class ) ) {
			$order = $this->resources->get( \WC_Order::class );

			return $order->get_order_number();
		}

		return '';
	}

	public function get_description(): string {
		return __( 'Display order number. Defaults to order ID, but plugins for sequential order number can override this value.',
			'shopmagic-example' );
	}
}
