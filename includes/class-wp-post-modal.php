<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/includes
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class WP_Post_Modal
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WP_Post_Modal_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{

		$this->plugin_name = 'wp-post-modal';
		$this->version     = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *q
	 * Include the following files that make up the plugin:
	 *
	 * - WP_Post_Modal_Loader. Orchestrates the hooks of the plugin.
	 * - WP_Post_Modal_i18n. Defines internationalization functionality.
	 * - WP_Post_Modal_Admin. Defines all hooks for the admin area.
	 * - WP_Post_Modal_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.`
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-post-modal-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-post-modal-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-wp-post-modal-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-wp-post-modal-public.php';

		$this->loader = new WP_Post_Modal_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WP_Post_Modal_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new WP_Post_Modal_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new WP_Post_Modal_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$this->loader->add_action('admin_menu', $plugin_admin, 'add_options_page');
		$this->loader->add_action('admin_init', $plugin_admin, 'register_setting');

		$this->loader->add_filter('plugin_action_links_' . plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php'), $plugin_admin, 'add_settings_link');

		$admin_installed_notice = get_option('dismiss_admin_notice_installed');
		if (empty($admin_installed_notice) || (time() - $admin_installed_notice > 60 * 60 * 24 * 15)) {
			$this->loader->add_filter('admin_notices', $plugin_admin, 'admin_notice_installed');
			$this->loader->add_filter('network_admin_notices', $plugin_admin, 'admin_notice_installed');
		}

		$admin_remote_notice = get_option('dismiss_admin_notice_remote');
		if (empty($admin_remote_notice) || (time() - $admin_installed_notice > 60 * 60 * 24 * 15)) {
			$this->loader->add_filter('admin_notices', $plugin_admin, 'admin_notice_remote');
			$this->loader->add_filter('network_admin_notices', $plugin_admin, 'admin_notice_remote');
		}

		if (get_option('wp_post_modal_button', true) !== '1') {
			$this->loader->add_filter('mce_buttons', $plugin_admin, 'register_custom_mce_buttons');
			$this->loader->add_filter("mce_external_plugins", $plugin_admin, "enqueue_custom_mce_scripts");
		}

		// redirect to settings pages on activation
		if (get_option('wp-post-modal_do_activation_redirect', false)) {
			add_filter('admin_init', function () {
				delete_option('wp-post-modal_do_activation_redirect');
				wp_redirect(admin_url('options-general.php?page=wp-post-modal'));
			});
		}

		$this->loader->add_action('wp_ajax_dismiss_admin_notice_installed',  $plugin_admin, 'dismiss_admin_notice_installed');

		$this->loader->add_action('wp_ajax_dismiss_admin_notice_remote',  $plugin_admin, 'dismiss_admin_notice_remote');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new WP_Post_Modal_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$this->loader->add_action('wp_footer', $plugin_public, 'modal_wrapper');

		if (!get_option('wp_post_modal_wrapping', true)) {
			$this->loader->add_action('the_content', $plugin_public, 'wrap_content');
		}

		$this->loader->add_action('rest_api_init', $plugin_public, 'any_post_api_route');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    WP_Post_Modal_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version()
	{
		return $this->version;
	}
}
