<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Workflow\Event\Builtin\OrderCommonEvent;

class AfterResendOrderEmailEvent extends OrderCommonEvent {

	/** Set name for your event */
	public function get_name(): string {
		return __( 'Order After Resend Email', 'shopmagic-example' );
	}

	/**
	 * Set a description for your event, which will be displayed when the event is selected in the automation.
	 */
	public function get_description(): string {
		return __( 'Triggered after order details are manually resent to customer.', 'shopmagic-example' );
	}

	/**
	 * Add hook for when the event should be triggered then initialize and run actions
	 */
	public function initialize(): void {
		add_action( 'woocommerce_after_resend_order_email', function ( $order ) {
			$this->resources->set( \WC_Order::class, $order );

			$this->trigger_automation();
		} );
	}
}
