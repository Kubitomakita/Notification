<?php
/**
 * Recipients field class
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\Field;

/**
 * Recipients field class
 */
class RecipientsField extends RepeaterField {

	/**
	 * Field constructor
	 *
	 * @since 5.0.0
	 * @param array $params field configuration parameters.
	 */
	public function __construct( $params = [] ) {

		if ( ! isset( $params['carrier'] ) ) {
			trigger_error( 'RecipientsField requires carrier param', E_USER_ERROR );
		}

		$params = wp_parse_args( $params, [
			'carrier'          => '',
			'label'            => __( 'Recipients', 'notification' ),
			'name'             => 'recipients',
			'add_button_label' => __( 'Add recipient', 'notification' ),
			'css_class'        => '',
		] );

		$this->carrier = $params['carrier'];

		// add our CSS class required by JS.
		$params['css_class'] .= 'recipients-repeater';

		// add data attr for JS identification.
		$params['data_attr'] = [
			'carrier' => $this->carrier,
		];

		$recipients = notification_get_carrier_recipients( $this->carrier );

		if ( ! empty( $recipients ) ) {

			$first_recipient = array_values( $recipients )[0];
			$recipient_types = [];

			foreach ( (array) $recipients as $recipient ) {
				$recipient_types[ $recipient->get_slug() ] = $recipient->get_name();
			}

			$params['fields'] = [
				new SelectField( [
					'label'     => __( 'Type', 'notification' ),
					'name'      => 'type',
					'css_class' => 'recipient-type',
					'options'   => $recipient_types,
				] ),
			];

			$params['fields'][] = $first_recipient->input();

		}

		parent::__construct( $params );

	}

	/**
	 * Prints repeater row
	 *
	 * @since [Next] Added vue template.
	 * @since  5.0.0
	 * @return string
	 */
	public function row() {
		$html = '<template v-for="( field, key ) in fields">
					<recipient-row
					:field="field"
					:fields="fields"
					:type="type"
					:key-index="key"
					>
					</recipient-row>
				</template>';
		return $html;
	}

}
