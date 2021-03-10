<?php

namespace ShopMagicExample;

use WPDesk\ShopMagic\Action\BasicAction;
use ShopMagicVendor\WPDesk\Forms\Field;
use ShopMagicVendor\WPDesk\Forms\Field\SelectField;
use ShopMagicVendor\WPDesk\Forms\Field\TextAreaField;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\Event\Event;


final class AddOrderNoteAction extends BasicAction {

	/**
	 * Note type field name
	 *
	 */
	const PARAM_NOTE_TYPE = 'note_type';

	/**
	 * Note field name
	 *
	 */
	const PARAM_NOTE = 'note';

	/**
	 * We need order order data to add the note, so we nened to make sure that we get it
	 *
	 * @return string[]
	 */
	public function get_required_data_domains(): array {
		return [ \WC_Order::class ];
	}

	/**
	 * Add action name
	 *
	 * @return mixed|string|void
	 */
	public function get_name() {
		return __( 'Order Add Note', 'shopmagic-example' );
	}

	/**
	 * Add note and note type fields for the action
	 *
	 * @return array|Field[]
	 */
	public function get_fields(): array {
		return [
			( new SelectField() )
				->set_label( __( 'Note type', 'shopmagic-example' ) )
				->set_options( [
					'customer' => __( 'Note to customer', 'shopmagic-example' ),
					'private'  => __( 'Private note', 'shopmagic-example' )
				] )
				->set_name( self::PARAM_NOTE_TYPE ),
			( new TextAreaField() )
				->set_label( __( 'Note', 'shopmagic-example' ) )
				->set_name( self::PARAM_NOTE )
		];
	}


	/**
	 * Add note to order
	 *
	 * @param Automation $automation
	 * @param Event $event
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function execute( Automation $automation, Event $event ): bool {
		$note_type = $this->fields_data->get( self::PARAM_NOTE_TYPE );
		$note      = $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_NOTE ) );

		if ( ! $note || ! $note_type || ! $this->is_order_provided() ) {
			return false;
		}

		$order = $this->get_order();

		if ( ! $order instanceof \WC_Order ) {
			throw new \Exception(
				__( 'Note could not be added, because order was not found.', 'shopmagic-example' ),
			);
		}

		$order->add_order_note( $note, $note_type === 'customer', false );

		return true;
	}
}
