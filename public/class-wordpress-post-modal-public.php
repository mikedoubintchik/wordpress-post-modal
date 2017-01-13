<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    Wordpress_Post_Modal
 * @subpackage Wordpress_Post_Modal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Post_Modal
 * @subpackage Wordpress_Post_Modal/public
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class Wordpress_Post_Modal_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wordpress_Post_Modal_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wordpress_Post_Modal_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wordpress-post-modal-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wordpress_Post_Modal_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wordpress_Post_Modal_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wordpress-post-modal-public.js', array('jquery'), $this->version, false);

    }

    /**
     * Display Modal wrapper
     *
     * @since   1.0.0
     */
    public function modal_wrapper()
    {
        $HTML = '';
        $HTML .= '<div class="modal-wrapper">';
        $HTML .= '<div class="modal">';
        $HTML .= '<div class="close-modal">X</div>';
        $HTML .= '<div id="modal-content"></div>';
        $HTML .= '</div>';
        $HTML .= '</div>';

        echo $HTML;

    }

    /**
     * Wrap content
     *
     * @return string
     *
     * @since   1.0.0
     */
    public function wrap_content($content)
    {
        return '<div id="modal-ready" data-plugin-path="' . plugins_url() . '">' . $content . '</div>';
    }

}
