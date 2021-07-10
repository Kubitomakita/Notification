<?php
/**
 * Runner class
 * Responsible for running Triggers and executing Carriers.
 *
 * @package notification
 */

namespace BracketSpace\Notification\Core;

use BracketSpace\Notification\Core\Notification as CoreNotification;
use BracketSpace\Notification\Store\Notification as NotificationStore;
use BracketSpace\Notification\Interfaces\Triggerable;

/**
 * Runner class
 */
class Runner {

	/**
	 * Trigger instance
	 *
	 * @var Triggerable
	 */
	protected $trigger;

	/**
	 * Run ID
	 *
	 * @var string
	 */
	protected string $id;

	/**
	 * Storage for Trigger's Notifications
	 *
	 * @var CoreNotification[]
	 */
	protected $notifications = [];

	/**
	 * Constructor
	 *
	 * @since [Next]
	 * @param Triggerable $trigger Trigger in subject.
	 */
	final public function __construct( Triggerable $trigger ) {
		$this->trigger = $trigger;
	}

	/**
	 * Runs the action by setting the context.
	 *
	 * Adds the specific Carrier and corresponding Trigger
	 * to the Queue for later execution.
	 *
	 * @since  [Next]
	 * @param  mixed[] ...$context Callback args setting context.
	 * @return void
	 */
	public function run( ...$context ) {

		$this->set_notifications();

		// If no Notifications use the Trigger, bail.
		if ( ! $this->has_notifications() ) {
			return;
		}

		// Setup the Trigger context.
		if ( method_exists( $this->trigger, 'action' ) ) {
			$result = call_user_func_array( [ $this->trigger, 'action' ], $context );

			$class = get_class( $this->trigger );
			_deprecated_function(
				sprintf( '%s::action()', esc_html( $class ) ),
				'[Next]',
				sprintf( '%s::context()', esc_html( $class ) )
			);
		} elseif ( method_exists( $this->trigger, 'context' ) ) {
			$result = call_user_func_array( [ $this->trigger, 'context' ], $context );
		} else {
			$result = null;
		}

		if ( false === $result ) {
			$this->trigger->stop();
		}

		do_action( 'notification/trigger/action/did', $this->trigger, current_action() );

		if ( $this->trigger->is_stopped() ) {
			return;
		}

		// Setup merge tags.
		$this->trigger->setup_merge_tags();

		// Setup notifications and prepare the carriers.
		foreach ( $this->get_notifications() as $notification ) {

			if ( ! apply_filters( 'notification/should_send', true, $notification, $this->trigger ) ) {
				continue;
			}

			foreach ( $notification->get_enabled_carriers() as $carrier ) {
				$carrier->resolve_fields( $this->trigger );
				$carrier->prepare_data();

				// Optimize the Trigger class.
				$this->trigger->clear_merge_tags();

				do_action( 'notification/carrier/pre-send', $carrier, $this->trigger, $notification );

				if ( ! $carrier->is_suppressed() ) {
					/**
					 * If an item already exists in the queue, we are replacing it with the new version.
					 * This doesn't prevents the duplicates coming from two separate requests.
					 */
					Queue::add_replace( $carrier, $this->trigger );
				}
			}

			do_action_deprecated(
				'notification/sent',
				[ $notification, $this->trigger ],
				'[Next]',
				'notification/processed',
				'The hook just means the carriers has been processed and are about to be sent'
			);

			do_action( 'notification/processed', $notification );

		}

	}

	/**
	 * Attaches the Notifications to Trigger
	 *
	 * @return void
	 */
	public function set_notifications() {

		$notifications = new NotificationStore();

		foreach ( $notifications->with_trigger( $this->trigger->get_slug() ) as $notification ) {
			$this->attach_notification( $notification );
		}

	}

	/**
	 * Gets attached Notifications
	 *
	 * @return CoreNotification[]
	 */
	public function get_notifications() {
		return $this->notifications;
	}

	/**
	 * Check if Trigger has attached Notifications
	 *
	 * @return bool
	 */
	public function has_notifications() {
		return $this->get_notifications() !== [];
	}

	/**
	 * Attaches the Notification
	 *
	 * @param  CoreNotification $notification Notification class.
	 * @return void
	 */
	public function attach_notification( CoreNotification $notification ) {
		$this->notifications[ $notification->get_hash() ] = clone $notification;
	}

	/**
	 * Detaches the Notification
	 *
	 * @param  CoreNotification $notification Notification class.
	 * @return void
	 */
	public function detach_notification( CoreNotification $notification ) {
		if ( isset( $this->notifications[ $notification->get_hash() ] ) ) {
			unset( $this->notifications[ $notification->get_hash() ] );
		}
	}

	/**
	 * Detaches all the Notifications
	 *
	 * @return $this
	 */
	public function detach_all_notifications() {
		$this->notifications = [];
		return $this;
	}

}