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
        if (get_option('wp_post_modal_styling') === false || get_option('wp_post_modal_styling') === '')
            update_option('wp_post_modal_styling', '1');

        // TODO: redirect to settings page after plugin activation
        wp_redirect(admin_url('options-general.php?page=wp-post-modal'));
    }

}
