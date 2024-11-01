<?php

// get an array of all Contactology subscription lists
function scs_get_lists() {

	$options = get_option( 'scs_settings' );

	if ( ! empty( $options['api_key'] ) ) {

		$lists = array();

		if ( ! class_exists( 'Contactology' ) ) {
			require_once SCS_PLUGIN_DIR . '/includes/class.Contactology.php';
		}
		$api = new Contactology( $options['api_key'] );
		$list_data = $api->List_Get_Active_Lists();
		if ( $list_data ) :
			foreach ( $list_data as $key => $list ) :
				$lists[$list['listId']] = $list['name'];
			endforeach;
		endif;
		return $lists;

	}
	return false;
}

// process the subscribe to list form
function scs_check_for_email_signup() {
	// only proceed with this function if we are posting from our email subscribe form
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'scs_signup' ) {

		// setup the email and name varaibles
		$email = strip_tags( $_POST['scs_email'] );
		$fname = isset( $_POST['scs_fname'] ) ? strip_tags( $_POST['scs_fname'] ) : '';
		$lname = isset( $_POST['scs_lname'] ) ? strip_tags( $_POST['scs_lname'] ) : '';

		// check for a valid email
		if ( !is_email( $email ) ) {
			wp_die( __( 'Your email address is invalid. Click back and enter a valid email address.', 'contactology' ), __( 'Invalid Email', 'contactology' ) );
		}

		// check for a name
		if ( isset( $_POST['scs_fname'] ) && strlen( trim( $fname ) ) <= 0 ) {
			wp_die( __( 'Enter your name. Click back and enter your name.', 'contactology' ), __( 'No Name', 'contactology' ) );
		}

		// check for a last name
		if ( empty( $lname ) ) {
			$lname = '';
		}

		// send this email to Contactology
		if( scs_subscribe_email( $email, $fname, $lname, $_POST['scs_list_id'] ) )
			wp_redirect( add_query_arg( 'submitted', '1', $_POST['redirect'] ) );
		else
			wp_redirect( add_query_arg( 'submitted', '0', $_POST['redirect'] ) );
		exit;
	}
}
add_action( 'init', 'scs_check_for_email_signup' );

// adds an email to the Contactology subscription list
function scs_subscribe_email( $email, $fname, $lname, $list_id ) {

	$options = get_option( 'scs_settings' );

	if ( ! empty( $options['api_key'] ) ) {

		if ( ! class_exists( 'Contactology' ) ) {
			require_once SCS_PLUGIN_DIR . '/includes/class.Contactology.php';
		}

		$api = new Contactology( $options['api_key'] );

		$emails = array(
			array( 'email' => $email, 'first_name' => $fname, 'last_name' => $lname )
		);

		if( $api->List_Import_Contacts( $list_id, 'Simple Contactology Signup for WordPress', $emails ) )
			return true;

	}
	return false;
}