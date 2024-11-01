<?php

// displays the Contactology signup form
function scs_signup_form($redirect, $list_id, $message) {
	global $post;

	$options = get_option( 'scs_settings' );

	if( empty( $message ) ) {
		$message = __('You have been successfully subscribed', 'contactology');
	}
	if( empty( $redirect ) ) {
		if ( is_singular() ) :
			$redirect =  get_permalink($post->ID);
		else :
			$redirect = 'http';
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $redirect .= "s";
			$redirect .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") $redirect .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			else $redirect .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		endif;
	}
	ob_start();
		if(isset( $_GET['submitted'] ) && $_GET['submitted'] == '1') {
			echo '<p>' . $message . '</p>';
		} else {
			if( ! empty( $options['api_key'] ) ) { ?>
			<form id="scs_form" action="" method="post">
				<?php if( !isset($options['disable_names'])) { ?>
					<div>
						<label for="scs_fname"><?php _e('Enter your first name', 'contactology'); ?></label><br/>
						<input name="scs_fname" id="scs_fname" type="text" placeholder="<?php _e('Your first name', 'contactology'); ?>"/>
					</div>
					<div>
						<label for="scs_lname"><?php _e('Enter your last name', 'contactology'); ?></label><br/>
						<input name="scs_lname" id="scs_lname" type="text" placeholder="<?php _e('Your last name', 'contactology'); ?>"/>
					</div>
				<?php } ?>
				<div>
					<label for="scs_email"><?php _e('Enter your email', 'contactology'); ?></label><br/>
					<input name="scs_email" id="scs_email" type="text" placeholder="<?php _e('Email Address', 'contactology'); ?>"/>
				</div>
				<div>
					<input type="hidden" name="redirect" value="<?php echo $redirect; ?>"/>
					<input type="hidden" name="action" value="scs_signup"/>
					<input type="hidden" name="scs_list_id" value="<?php echo $list_id; ?>"/>
					<input type="submit" value="<?php _e('Sign Up', 'contactology'); ?>"/>
				</div>
			</form>
			<?php
		}
	}
	return ob_get_clean();
}

function scs_form_shortcode($atts, $content = null ) {

	extract( shortcode_atts( array(
		'redirect' => '',
		'list' => 1,
		'message' => __('You have been successfully subscribed.', 'contactology')
	), $atts ) );

	if( $redirect == '' ) {
		$redirect = add_query_arg('submitted', 'yes', get_permalink());
	}

	$lists = scs_get_lists();
	$i = 0;

	foreach($lists as $id => $list_name) {
		if($i == ($list-1) ) {
			$list_id = $id;
		}
		$i++;
	}

	return scs_signup_form($redirect, $list_id, $message);
}
add_shortcode('contactology', 'scs_form_shortcode');