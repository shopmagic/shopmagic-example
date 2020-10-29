<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Event\OrderCommonEvent;

class AfterResendOrderEmailEvent extends OrderCommonEvent {

	/**
	 * Set name for your event
	 *
	 * @return mixed|string|void
	 */
	public function get_name() {
		return __( 'Order After Resend Email', 'shopmagic-example' );
	}

	/**
	 * Optionally set a description for your event which will be displayed when the event is selected in the automation
	 *
	 * @return mixed|string|void
	 */
	public function get_description() {
		return __( 'Triggered after order details are manually resent to customer.', 'shopmagic-example' );
	}

	/**
	 * Add hook for when the event should be triggered then initialize and run actions
	 *
	 */
	public function initialize() {
		add_action( 'woocommerce_after_resend_order_email', function ( $order ) {
			$this->order = $order;

			$this->run_actions();
		} );
	}
}
