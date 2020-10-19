<?php
/**
 * Privacy ereased trigger
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\Trigger\Privacy;

/**
 * Data erased  trigger class
 */
class DataErased extends PrivacyTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( 'privacy/data-erased', __( 'Privacy Data Erased', 'notification' ) );

		$this->add_action( 'wp_privacy_personal_data_erased', 10, 1 );

		$this->set_description( __( 'Fires when user personal data is erased', 'notification' ) );

	}

	/**
	 * Assigns action callback args to object
	 *
	 * @param integer $request_id Request id.
	 */
	public function action( $request_id ) {

		$this->request             = wp_get_user_request( $request_id );
		$this->user_object         = get_userdata( $this->request->user_id );
		$this->data_operation_time = $this->cache( 'timestamp', time() );

	}

}