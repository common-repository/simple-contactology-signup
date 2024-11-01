<?php

// register the plugin settings
function scs_register_settings() {
	// register our option
	register_setting( 'scs_settings_group', 'scs_settings' );
}
add_action( 'admin_init', 'scs_register_settings', 100 );

function scs_settings_menu() {
	// add settings page
	add_options_page(__('Contactology', 'contactology'), __('Contactology', 'contactology'),'manage_options', 'contactology', 'scs_settings_page');
}
add_action('admin_menu', 'scs_settings_menu', 100);

function scs_settings_page() {

	$options = get_option( 'scs_settings' );

	?>
	<div class="wrap">
		<h2><?php _e('Contactology Settings', 'contactology'); ?></h2>
		<?php
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
			echo '<div class="updated"><p>' . __('Settings saved', 'contactology') . '</p></div>';
		}
		?>
		<form method="post" action="options.php" class="poptions_form">
			<?php settings_fields( 'scs_settings_group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scop="row">
						<label for="scs_settings[api_key]"><?php _e( 'Contactology API Key', 'contactology' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" id="scs_settings[api_key]" style="width: 300px;" name="scs_settings[api_key]" value="<?php if(isset($options['api_key'])) { echo esc_attr($options['api_key']); } ?>"/>
						<p class="description"><?php _e('Enter your Contactology API key to enable a newsletter signup option with the registration form.', 'contactology'); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<span><?php _e( 'Email Lists', 'contactology' ); ?></span>
					</th>
					<td>
						<?php $lists = scs_get_lists(); ?>
						<ul>
							<?php
								if($lists) :
									$i = 1;
									foreach($lists as $id => $list_name) :
										echo '<li>' . $list_name . ' - <strong>[contactology list="' . $i . '"]</strong></li>';
										$i++;
									endforeach;
								else : ?>
							<li><?php _e('You must enter your API and Client ID keys before lists are shown.', 'contactology'); ?></li>
						<?php endif; ?>
						</ul>
						<p class="description"><?php _e('Place the short code shown beside any list in a post or page to display the signup form, or use the dedicated widget.', 'contactology'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scop="row">
						<label for="scs_settings[disable_names]"><?php _e( 'Disable Names', 'contactology' ); ?></label>
					</th>
					<td>
						<input class="checkbox" type="checkbox" id="scs_settings[disable_names]" name="scs_settings[disable_names]" value="1" <?php checked(1, isset( $options['disable_names'] ) ); ?>/>
						<span class="description"><?php _e('Disable the First and Last Name fields?', 'contactology'); ?></span>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>

		</form>
	</div><!--end .wrap-->
	<?php
}