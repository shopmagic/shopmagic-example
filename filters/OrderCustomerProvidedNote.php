<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Workflow\Filter\Builtin\OrderFilter;
use WPDesk\ShopMagic\Workflow\Filter\ComparisonType\BoolType;
use WPDesk\ShopMagic\Workflow\Filter\ComparisonType\ComparisonType;
use WPDesk\ShopMagic\Workflow\Filter\ComparisonType\StringType;

final class OrderCustomerProvidedNote extends OrderFilter {

	/**
	 * Set name for your filter
	 *
	 * @return mixed|string|void
	 */
	public function get_name(): string {
		return __( 'Order - Customer Provided Note', 'shopmagic-example' );
	}

	/**
	 * Validate filter based on the value set in the filter options in the automation
	 *
	 * @return bool
	 */
	public function passed(): bool {
		if ( $this->resources->has( \WC_Order::class ) ) {
			$order = $this->resources->get( \WC_Order::class );

			return $this->get_type()->passed(
				$this->fields_data->get( StringType::VALUE_KEY ),
				null,
				$order->get_customer_note() ? 'yes' : 'no'
			);
		}

		return false;
	}

	/**
	 * Set comparison type which you want to use
	 */
	protected function get_type(): ComparisonType {
		return new BoolType();
	}
}
