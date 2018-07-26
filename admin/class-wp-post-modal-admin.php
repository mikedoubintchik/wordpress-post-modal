<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/admin
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class WP_Post_Modal_Admin {

	/**
	 * The options name to be used in this plugin
	 *
	 * @since    1.0.0
	 * @access    private
	 * @var    string $option_name Option name of this plugin
	 */
	private $option_name = 'wp_post_modal';

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
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-post-modal-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-post-modal-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'WP Post Popup Settings', 'wp-post-modal' ),
			__( 'WP Post Popup', 'wp-post-modal' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'wp-post-modal' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		// Close button
		add_settings_field(
			$this->option_name . '_close',
			__( 'Close Button', 'wp-post-modal' ),
			array( $this, $this->option_name . '_close_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_close' )
		);

		// Breakpoint
		add_settings_field(
			$this->option_name . '_breakpoint',
			__( 'Breakpoint', 'wp-post-modal' ),
			array( $this, $this->option_name . '_breakpoint_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_breakpoint' )
		);

		// Activate styling
		add_settings_field(
			$this->option_name . '_styling',
			__( 'Activate basic styling', 'wp-post-modal' ),
			array( $this, $this->option_name . '_styling_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_styling' )
		);

		// Update URL state in address bar
		add_settings_field(
			$this->option_name . '_urlstate',
			__( 'Dynamically update URL in address bar when modal is open', 'wp-post-modal' ),
			array( $this, $this->option_name . '_urlstate_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_urlstate' )
		);

		// Disable Visual Editor Button
		add_settings_field(
			$this->option_name . '_button',
			__( 'Disable Visual Editor Button', 'wp-post-modal' ),
			array( $this, $this->option_name . '_button_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_button' )
		);

		// styling example
		add_settings_section(
			$this->option_name . '_styling_example',
			__( 'Styling Example', 'wp-post-modal' ),
			array( $this, $this->option_name . '_styling_example_cb' ),
			$this->plugin_name
		);

		// Use legacy method
		add_settings_field(
			$this->option_name . '_legacy',
			__( 'Use Legacy Method', 'wp-post-modal' ),
			array( $this, $this->option_name . '_legacy_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_legacy' )
		);

		// Use iframe method for external links
		add_settings_field(
			$this->option_name . '_iframe',
			__( 'Use iFrame Method for external links', 'wp-post-modal' ),
			array( $this, $this->option_name . '_iframe_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_iframe' )
		);

		register_setting( $this->plugin_name, $this->option_name . '_close', array(
			$this,
			$this->option_name . '_sanitize_close'
		) );
		register_setting( $this->plugin_name, $this->option_name . '_breakpoint', array(
			$this,
			$this->option_name . '_sanitize_breakpoint'
		) );
		register_setting( $this->plugin_name, $this->option_name . '_styling', array(
			$this,
			$this->option_name . '_sanitize_styling'
		) );
		register_setting( $this->plugin_name, $this->option_name . '_urlstate', array(
			$this,
			$this->option_name . '_sanitize_urlstate'
		) );
		register_setting( $this->plugin_name, $this->option_name . '_button', array(
			$this,
			$this->option_name . '_sanitize_button'
		) );
		register_setting( $this->plugin_name, $this->option_name . '_legacy', array(
			$this,
			$this->option_name . '_sanitize_legacy'
		) );
		register_setting( $this->plugin_name, $this->option_name . '_iframe', array(
			$this,
			$this->option_name . '_sanitize_iframe'
		) );
	}

	/**
	 * Render the input for close button
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_close_cb() {
		$close = get_option( $this->option_name . '_close' );
		?>
        <fieldset>
            <label>
                <input type="text" size="40" name="<?php echo $this->option_name . '_close' ?>"
                       id="<?php echo $this->option_name . '_close' ?>"
                       value="<?php echo $close ?>" placeholder="Default is '×'"/>
            </label>
        </fieldset>
		<?php
	}

	/**
	 * Render the input for breakpoint
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_breakpoint_cb() {
		$breakpoint = get_option( $this->option_name . '_breakpoint' );
		?>
        <fieldset>
            <label>
                <input type="text" size="40" name="<?php echo $this->option_name . '_breakpoint' ?>"
                       id="<?php echo $this->option_name . '_breakpoint' ?>"
                       value="<?php echo $breakpoint ?>" placeholder="Enter number without 'px'"/>
            </label>
            <p>Below this value, the popup link will redirect to the page instead of opening the popup. Enter "0" if you
                want the popup to work on all screen sizes. If left blank, the default breakpoint is 768px.</p>
        </fieldset>
		<?php
	}

	/**
	 * Render the checkbox for styling
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_styling_cb() {
		$styling = get_option( $this->option_name . '_styling', true );
		?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_styling' ?>"
                       id="<?php echo $this->option_name . '_styling' ?>"
                       value="1" <?php echo checked( $styling, '1' ); ?> />
            </label>
        </fieldset>
        <a href="https://wp-post-modal.allureprojects.com/modal-css/" target="_blank">See CSS used for basic styling</a>
		<?php
	}

	/**
	 * Render the checkbox for styling
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_urlstate_cb() {
		$urlstate = get_option( $this->option_name . '_urlstate', true );
		?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_urlstate' ?>"
                       id="<?php echo $this->option_name . '_urlstate' ?>"
                       value="1" <?php echo checked( $urlstate, '1' ); ?> />
            </label>
        </fieldset>
		<?php
	}

	/**
	 * Render the checkbox for disabling TinyMCE button
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_button_cb() {
		$button = get_option( $this->option_name . '_button', true );
		?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_button' ?>"
                       id="<?php echo $this->option_name . '_button' ?>"
                       value="1" <?php echo checked( $button, '1' ); ?> />
            </label>
        </fieldset>
		<?php
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_general_cb() {
		echo '<p>' . __( 'A few options for the WP Post Popup plugin.', 'wp-post-modal' ) . '</p>';
	}

	/**
	 * Render the image for the styling example
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_styling_example_cb() {
		echo '<img src="' . plugins_url() . '/wp-post-modal/admin/images/modal-styling-example.jpg" width="300px" />';
	}

	/**
	 * Render the checkbox for legacy method
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_legacy_cb() {
		$legacy = get_option( $this->option_name . '_legacy', true );
		?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_legacy' ?>"
                       id="<?php echo $this->option_name . '_legacy' ?>"
                       value="1" <?php echo checked( $legacy, '1' ); ?> />
            </label>
        </fieldset>
        <p>Use this if the default method is not working OR if you are using custom templating</p>
		<?php
	}

	/**
	 * Render the checkbox for iframe method
	 *
	 * @since  1.0.0
	 */
	public function wp_post_modal_iframe_cb() {
		$iframe = get_option( $this->option_name . '_iframe', true );
		?>
        <fieldset>
            <label>
                <input type="checkbox" name="<?php echo $this->option_name . '_iframe' ?>"
                       id="<?php echo $this->option_name . '_iframe' ?>"
                       value="1" <?php echo checked( $iframe, '1' ); ?> />
            </label>
        </fieldset>
        <p>Use this if you want to load non-basic content pages into the iframe. For example, if you want to load a
            google spreadsheet into the popup. Alternatively, add the class <code>iframe</code> to your modal-link.</p>
		<?php
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/wp-post-modal-admin-display.php';
	}

	/**
	 * Add settings link to plugin page
	 *
	 * @param $links
	 *
	 * @return mixed
	 */
	public function add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=wp-post-modal">' . __( 'Settings' ) . '</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	/**
	 * Add Visual Editor button for popup links
	 *
	 * @param $buttons
	 *
	 * @return mixed
	 */
	public function register_custom_mce_buttons( $buttons ) {
		//register buttons with their id.
		array_push( $buttons, 'modal_link' );

		return $buttons;
	}

	public function enqueue_custom_mce_scripts( $plugin_array ) {
		//enqueue TinyMCE plugin script with its ID.
		$plugin_array['wp_post_modal'] = plugin_dir_url( __FILE__ ) . "js/mce-button.js";

		return $plugin_array;
	}

	/**
	 * Admin notice for plugin updated
	 */
	public function admin_notice_updated() {
		$user_id = get_current_user_id();
		$message = '<h4>WP Post Popup settings updated!</h4>';

		// when settings are updated
		if ( isset( $_GET['settings-updated'] ) ) {
			?>
            <div class="notice notice-success is-dismissible">
				<?php echo $message; ?>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
            </div>
			<?php
		}
	}

	/**
	 * Admin notice for plugin installed
	 */
	public function admin_notice_installed() {
		$message = '<h4>Thanks for installing WP Post Popup!</h4><p>Please <a href="https://wordpress.org/support/plugin/wp-post-modal/reviews/" target="_blank">click here</a> to give us a review :)</p>';
		?>
        <div class="notice notice-success is-dismissible admin-notice-installed hidden">
			<?php echo $message; ?>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
		<?php
	}

	/**
	 * Remote admin notice
	 */
	public function admin_notice_remote() {
		$notice_url = 'https://wp-post-modal.allureprojects.com/wp-json/wp/v2/pages/35';

		$message = json_decode( wp_remote_retrieve_body( wp_remote_get( $notice_url ) ), true )['content']['rendered'];

		if ( is_wp_error( $message ) ) {
			return false; // Bail early
		}

		?>
        <div class="notice notice-success is-dismissible admin-notice-remote hidden">
            <div class="notice-content">
				<?php echo $message; ?>
            </div>

            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
		<?php
	}
}
