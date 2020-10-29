<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Filter\Builtin\OrderFilter;
use WPDesk\ShopMagic\Filter\ComparisionType\BoolType;
use WPDesk\ShopMagic\Filter\ComparisionType\ComparisionType;
use WPDesk\ShopMagic\Filter\ComparisionType\StringType;

final class OrderCustomerProvidedNote extends OrderFilter {

	/**
	 * Set name for your filter
	 *
	 * @return mixed|string|void
	 */
	public function get_name() {
		return __( 'Order - Customer Provided Note', 'shopmagic-example' );
	}

	/**
	 * Validate filter based on the value set in the filter options in the automation
	 *
	 * @return bool
	 */
	public function passed(): bool {
		return $this->get_type()->passed(
			$this->fields_data->get( StringType::VALUE_KEY ),
			null,
			$this->get_order()->get_customer_note() ? 'yes' : 'no'
		);
	}

	/**
	 * Set comparison type which you want to use
	 *
	 * @return BoolType|ComparisionType
	 */
	protected function get_type() {
		return new BoolType();
	}
}
