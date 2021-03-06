<?php
/**
 * Number field class
 *
 * @package notification
 */

namespace BracketSpace\Notification\Utils\Settings\CoreFields;

use BracketSpace\Notification\Utils\Settings\Field;

/**
 * Number class
 */
class Number {

	/**
	 * Number field
	 * Accepts addons: min, max, step
	 *
	 * @param  Field $field Field instance.
	 * @return void
	 */
	public function input( $field ) {

		echo '<label><input type="number" id="' . $field->input_id() . '" name="' . $field->input_name() . '" value="' . $field->value() . '" min="' . $field->addon( 'min' ) . '" max="' . $field->addon( 'max' ) . '" step="' . $field->addon( 'step' ) . '" class="widefat"></label>'; // phpcs:ignore

	}

	/**
	 * Sanitize input value
	 *
	 * @param  string $value saved value.
	 * @return int|float     sanitized number
	 */
	public function sanitize( $value ) {

		if ( ! is_numeric( $value ) ) {
			return 0;
		}

		return floatval( $value );

	}

}
