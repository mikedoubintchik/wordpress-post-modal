<?php

/**
 * Fired during plugin activation
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/includes
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class WP_Post_Modal_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        // set default state of styling to true
        if (get_option('wp_post_modal_breakpoint') === false || get_option('wp_post_modal_breakpoint') === '')
            update_option('wp_post_modal_breakpoint', '0');

        // set default wrapping to enabled
        if (get_option('wp_post_modal_wrapping') === false || get_option('wp_post_modal_wrapping') === '')
            update_option('wp_post_modal_wrapping', '0');

        // enable visual editor button by default
        if (get_option('wp_post_modal_button') === false || get_option('wp_post_modal_button') === '')
            update_option('wp_post_modal_button', '0');

        // redirect to settings page on activation
        add_option('wp-post-modal_do_activation_redirect', true);
    }
}
