<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/includes
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class WP_Post_Modal_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		update_option('wp_post_modal_breakpoint', '');
		update_option('wp_post_modal_wrapping', '');
		update_option('wp_post_modal_button', '');
	}
}
