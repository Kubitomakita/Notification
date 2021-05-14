<?php
/**
 * Triggerable interface class
 *
 * @package notification
 */

namespace BracketSpace\Notification\Interfaces;

use BracketSpace\Notification\Core\Notification;

/**
 * Triggerable interface
 */
interface Triggerable extends Nameable {

	/**
	 * Sets up the merge tags
	 *
	 * @return void
	 */
	public function setup_merge_tags();

	/**
	 * Gets Trigger's merge tags
	 *
	 * @param string $type    Optional, all|visible|hidden, default: all.
	 * @param bool   $grouped Optional, default: false.
	 * @return array<Taggable>
	 */
	public function get_merge_tags( $type = 'all', $grouped = false );

	/**
	 * Stops the trigger.
	 *
	 * @return void
	 */
	public function stop();

	/**
	 * Checks if trigger has been stopped
	 *
	 * @return boolean
	 */
	public function is_stopped() : bool;

	/**
	 * Gets Trigger actions
	 *
	 * @since [Next]
	 * @return array<int, array{tag: string, priority: int, accepted_args: int}>
	 */
	public function get_actions() : array;
}