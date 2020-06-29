<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/rohan-krishna
 * @since             1.0.0
 * @package           Quick_Attach_Featured_Image
 *
 * @wordpress-plugin
 * Plugin Name:       Quick Attach Featured Image
 * Plugin URI:        https://github.com/rohan-krishna/wp-quick-attach-featured
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Rohan Krishna
 * Author URI:        https://github.com/rohan-krishna
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       quick-attach-featured-image
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'QUICK_ATTACH_FEATURED_IMAGE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-quick-attach-featured-image-activator.php
 */
function activate_quick_attach_featured_image() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quick-attach-featured-image-activator.php';
	Quick_Attach_Featured_Image_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-quick-attach-featured-image-deactivator.php
 */
function deactivate_quick_attach_featured_image() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quick-attach-featured-image-deactivator.php';
	Quick_Attach_Featured_Image_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_quick_attach_featured_image' );
register_deactivation_hook( __FILE__, 'deactivate_quick_attach_featured_image' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-quick-attach-featured-image.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_quick_attach_featured_image() {

	$plugin = new Quick_Attach_Featured_Image();
	$plugin->run();

}
run_quick_attach_featured_image();
