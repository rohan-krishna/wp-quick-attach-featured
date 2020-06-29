<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/rohan-krishna
 * @since      1.0.0
 *
 * @package    Quick_Attach_Featured_Image
 * @subpackage Quick_Attach_Featured_Image/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Quick_Attach_Featured_Image
 * @subpackage Quick_Attach_Featured_Image/includes
 * @author     Rohan Krishna <phonemg30993@gmail.com>
 */
class Quick_Attach_Featured_Image_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'quick-attach-featured-image',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
