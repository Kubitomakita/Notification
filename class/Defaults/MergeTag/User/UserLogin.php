<?php
/**
 * User login merge tag
 *
 * Requirements:
 * - Trigger property `user_object` or any other passed as
 * `property_name` parameter. Must be an object, preferabely WP_User
 *
 * @package notification
 */

namespace underDEV\Notification\Defaults\MergeTag\User;

use underDEV\Notification\Defaults\MergeTag\StringTag;

/**
 * User login merge tag class
 */
class UserLogin extends StringTag {

	/**
	 * Trigger property to get the user data from
	 *
	 * @var string
	 */
	protected $property_name = 'user_object';

	/**
     * Merge tag constructor
     *
     * @since [Next]
     * @param array $params merge tag configuration params.
     */
    public function __construct( $params = array() ) {

    	if ( isset( $params['property_name'] ) && ! empty( $params['property_name'] ) ) {
    		$this->property_name = $params['property_name'];
    	}

    	$args = wp_parse_args( $params, array(
			'slug'        => 'user_login',
			'name'        => __( 'User login' ),
			'description' => __( 'johndoe' ),
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->{ $this->property_name }->user_login;
			},
		) );

    	parent::__construct( $args );

	}

	/**
	 * Function for checking requirements
	 *
	 * @return boolean
	 */
	public function check_requirements( ) {
		return isset( $this->trigger->{ $this->property_name }->user_login );
	}

}
