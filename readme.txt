=== Simple Contactology Signup ===
Contributors: mordauk, contactology
Tags: Contactology, Newsletter, Email Marketing, Emails, Mailinglist
Requires at least: 3.3
Tested up to: 3.6
Stable tag: 1.0

Easily add a signup form for any of your Contactology Newsletter lists anywhere on your WordPress site.

== Description ==

This plugin makes it simple to add signup forms for your Contactology newsletter lists anywhere on your WordPress site.

Add signup forms anywhere with either a short code or a widget.

== Installation ==

= In The WordPress Dashboard =

1. Navigate to the 'Add New' plugin dashboard
2. Select `simple-contactology-signup.zip` from your computer
3. Upload
4. Activate the plugin in the WordPress Plugin Dashboard

= Using FTP =

1. Extract `simple-contactology-signup.zip` to your computer
2. Upload the `simple-contactology-signup` directory to your wp-content/plugins directory
3. Navigate to the WordPress Plugin Dashboard
4. Activate the plugin from this page

= Connecting Your Contactology Account =

1. Obtain your Contactology API key from within your Contactology account (Settings > API Keys)
2. In the WordPress Dahsboard, enter the API key in Settings > Contactology
3. Save the changes
4. You should now see a list of your Contactology Lists

= Adding the short code to a page =

1. Go to Settings > Contactology and copy the short code for the form you want to embed.
2. Paste the short code into the main content of any post or page.

= Showing a Signup Form with the Widget =

After you have entered your API key (see above), go to Appearance > Widgets and place the "Contactology Signup" widget in any widget area. Once you have done that, simply enter a widget title, select the list you want users subscribed to and enter a success message, which is shown after a user successfully subscribes.

= Customizing the Look of Your Signup Forms =

To customize the appearance of your signup forms (width, height, color, etc.), add new styles to your theme's CSS.

`
form#scs_form label {
 /* styling ALL your labels the same */

}

form#scs_form label[for="scs_email"] {
 /* styling the “Enter Your Email” label */

}

form#scs_form label[for="scs_fname"] {
 /* styling the “Enter Your First Name” label */

}

form#scs_form label[for="scs_lname"] {
 /* styling the “Enter Your Last Name” label */

}

form#scs_form input[type="submit"] {
 /* styling the submit button (not compatible with IE) */

}

form#scs_form input {
 /* styling the input boxes */

}
`

== Screenshots ==

1. The plugin settings screen. Enter your API key and choose the newsletter list here
2. The signup form widget
3. An example of the signup form in a sidebar (in the Twenty Twelve theme)


== Changelog ==

= 1.0 =
* Initial release