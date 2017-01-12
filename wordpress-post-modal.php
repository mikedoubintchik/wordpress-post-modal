<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://allurewebsolutions.com
 * @since             1.0.0
 * @package           Wordpress_Post_Modal
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Post Modal
 * Plugin URI:        https://allurewebsolutions.com
 * Description:       This plugin allows any content to be pulled into a modal window dynamically. To use, just create a link with class "modal-link".
 * Version:           1.0.0
 * Author:            Allure Web Solutions
 * Author URI:        https://allurewebsolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-post-modal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-post-modal-activator.php
 */
function activate_wordpress_post_modal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-post-modal-activator.php';
	Wordpress_Post_Modal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-post-modal-deactivator.php
 */
function deactivate_wordpress_post_modal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-post-modal-deactivator.php';
	Wordpress_Post_Modal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpress_post_modal' );
register_deactivation_hook( __FILE__, 'deactivate_wordpress_post_modal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-post-modal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordpress_post_modal() {

	$plugin = new Wordpress_Post_Modal();
	$plugin->run();

}
run_wordpress_post_modal();
