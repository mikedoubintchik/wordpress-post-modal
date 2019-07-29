<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/public
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class WP_Post_Modal_Public {

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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 *
	 * @since    1.0.0
	 *
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Post_Modal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Post_Modal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-post-modal-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Post_Modal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Post_Modal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-post-modal-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'fromPHP', array(
			'pluginUrl'        => plugin_dir_url( __FILE__ ),
			'breakpoint'       => ( get_option( 'wp_post_modal_breakpoint' ) != '' ? get_option( 'wp_post_modal_breakpoint' ) : '768' ),
			'styled'           => get_option( 'wp_post_modal_styling' ),
			'disableScrolling' => ( get_option( 'wp_post_modal_scrolling' ) === '1' ),
			'loader'           => get_option( 'wp_post_modal_loader' ),
			'ajax_url'         => admin_url( 'admin-ajax.php' ),
			'siteUrl'          => get_bloginfo( 'url' ),
			'restMethod'       => get_option( 'wp_post_modal_rest' ),
			'iframe'           => get_option( 'wp_post_modal_iframe' ),
			'urlState'         => get_option( 'wp_post_modal_urlstate' ),
			'containerID'      => '#' . ( get_option( 'wp_post_modal_container' ) ? get_option( 'wp_post_modal_container' ) : 'modal-ready' ),
			'isAdmin'          => is_admin()
		) );

	}

	/**
	 * Display Modal wrapper
	 *
	 * @since   1.0.0
	 */
	public function modal_wrapper() {
		$styled = ( get_option( 'wp_post_modal_styling' ) === '1' ? 'styled' : '' );

		$close = ( get_option( 'wp_post_modal_close' ) != '' ? get_option( 'wp_post_modal_close' ) : '×' );

		$HTML = '<div class="modal-wrapper ' . $styled . '" role="dialog" aria-modal="true"  aria-label="' . __( 'Popup Dialog', 'wp-post-modal' ) . '">';
		$HTML .= '<div class="modal">';
		$HTML .= '<button type="button" aria-label="' . __( 'Close', 'wp-post-modal' ) . '" class="close-modal"> ' . $close . ' </button>';
		$HTML .= '<div id="modal-content"></div>';
		$HTML .= '</div>';
		$HTML .= '</div>';

		echo $HTML;

	}

	/**
	 * Register API Route: Query Any Post Type
	 */
	public function any_post_api_route() {

		register_rest_route( $this->plugin_name . '/v1', '/any-post-type/', array(
			'methods'  => 'GET',
			'callback' => array( $this, 'get_content_by_slug' ),
			'args'     => array(
				'slug' => array(
					'required' => false
				)
			)
		) );

	}

	/**
	 *
	 * Get content by slug
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function get_content_by_slug( WP_REST_Request $request ) {
		// Visual Composer shortcodes
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			WPBMap::addAllMappedShortcodes();
		}

		// get slug from request
		$slug = $request['slug'];

		// get title by slug
		$return = get_page_by_path( $slug, ARRAY_A, get_post_types() );


		if ( $return['post_content'] ) {
			// render shortcodes from Visual Composer
			$return['post_content'] = apply_filters( 'the_content', $return['post_content'] );
			$response               = new WP_REST_Response( $return );
		} else {
			$response = new WP_Error( 'post_empty', 'Post is empty', array( 'status' => 404 ) );
		}

		return $response;
	}

	/**
	 * Wrap content in modal-ready ID
	 *
	 * @param $content
	 *
	 * @return string
	 *
	 * @since   1.0.0
	 */
	public function wrap_content( $content ) {
		if ( ! empty( $content ) ) {
			$div_id = apply_filters( 'define_wrapping_div_id', null ) ? apply_filters( 'define_wrapping_div_id', null ) : 'modal-ready';

			return '<div id="' . $div_id . '">' . $content . '</div>';
		}

		return false;
	}
}
