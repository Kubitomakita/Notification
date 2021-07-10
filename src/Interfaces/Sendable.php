<?php
/**
 * Sendable interface class
 *
 * @package notification
 */

namespace BracketSpace\Notification\Interfaces;

/**
 * Sendable interface
 */
interface Sendable extends Nameable {

	/**
	 * Sends the carrier
	 *
	 * @param  Triggerable $trigger trigger object.
	 * @return void
	 */
	public function send( Triggerable $trigger );

	/**
	 * Generates an unique hash for carrier instance
	 *
	 * @return string
	 */
	public function hash();

	/**
	 * Gets form fields array
	 *
	 * @return Fillable[] fields
	 */
	public function get_form_fields();

	/**
	 * Checks if Carrier is enabled
	 *
	 * @return bool
	 */
	public function is_enabled();

	/**
	 * Checks if Carrier is active
	 *
	 * @return bool
	 */
	public function is_active();

	/**
	 * Sets data from array
	 *
	 * @param  array<string,mixed> $data Data with keys matched with Field names.
	 * @return $this
	 */
	public function set_data( $data );

	/**
	 * Enables the Carrier
	 *
	 * @return $this
	 */
	public function enable();

	/**
	 * Disables the Carrier
	 *
	 * @return $this
	 */
	public function disable();

	/**
	 * Gets form fields array
	 *
	 * @param  string $field_name Field name.
	 * @return mixed              Field object or null.
	 */
	public function get_form_field( $field_name );

}
