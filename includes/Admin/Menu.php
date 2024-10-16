<?php

namespace UserRegistration\Admin;

/**
 * Handles the admin menu functionality for the plugin.
 *
 * This class registers a custom admin page in the WordPress dashboard
 * and adds a settings link to the plugin's action links.
 *
 * @since 1.0.0
 */
class Menu {

    /**
     * Initializes the admin menu and settings actions.
     *
     * Menu constructor
     */
    public function __construct() {

        // admin menu register
        add_action( 'admin_menu', array( $this, 'sur_add_admin_page' ) );

        // settings action add
        add_filter( 'plugin_action_links_' . plugin_basename( RI_USER_REGISTRATION_FILE ), [$this, 'sur_plugin_page_options_add'] );

        // settings save
        add_action( 'admin_init', array( $this, 'sur_register_settings' ) );
    }

    /**
     * Register a settings for Simple User Registration plugin
     * @return void
     */
    public function sur_register_settings() {
        
        // Register the setting
        register_setting( 'simple_user_registration_config', 'sur_redirect_page_slug' );

        // Add a section
        add_settings_section(
            'sur_main_section',
            __( 'Main Settings', 'ri-simple-user-registration' ),
            array( $this, 'sur_section_callback' ),
            'simple_user_registration_config'
        );

        // Add a field to the section
        add_settings_field(
            'sur_redirect_page_slug',
            __( 'Set redirect page', 'ri-simple-user-registration' ),
            array( $this, 'sur_redirect_page_callback' ),
            'simple_user_registration_config',
            'sur_main_section'
        );
    }

    /**
     * Main Section callback code
     * 
     * @return void
     */
    public function sur_section_callback() {
        echo '<p>' . __('Main configuration settings for your plugin.', 'ri-simple-user-registration') . '</p>';
    }
    
    /**
     * add input field for redirect page
     * 
     * @return void
     */
    public function sur_redirect_page_callback() {

        $pages = get_posts([
            'post_type'      => 'page',
            'post_status'    => 'publish',  
            'posts_per_page' => -1 
        ]);
        
        // Get the current value of the option
        $slug = get_option('sur_redirect_page_slug');

        ?>

        <select name="sur_redirect_page_slug" id="sur_redirect_page_slug">
            <option value=""><?php _e( 'Select', 'ri-simple-user-registration' ); ?></option>
            <?php foreach( $pages as $page ): ?>
                <option value="<?php echo esc_attr( $page->post_name ); ?>" <?php selected( $slug, $page->post_name ); ?>>
                    <?php echo esc_html( $page->post_title ); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php
    }

    /**
     * Adds the "User Registration" page to the WordPress admin dashboard.
     * This page allows managing the settings for the Simple User Registration form.
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function sur_add_admin_page() {

        add_menu_page(
            __( 'User Registration', 'ri-simple-user-registration' ),
            __( 'User Registration', 'ri-simple-user-registration' ),
            'manage_options',
            'ri-simple-user-registration',
            array( $this, 'sur_user_registration_callback' ),
            'dashicons-groups',
            2
        );
    }

    /**
     * Renders the content of the User Registration admin page.
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function sur_user_registration_callback() {
        require_once __DIR__ . '/views/menu.views.php';
    }

    /**
     * Adds a "Settings" link to the plugin's action links on the plugins page.
     *
     * @param array $links The current plugin action links.
     * @return array Modified plugin action links with the "Settings" link added.
     *
     * @since 1.0.0
     */
    public function sur_plugin_page_options_add( $links ) {
        $settings_links = array(
            sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=ri-simple-user-registration' ), __( 'Settings', 'ri-simple-user-registration' ) ),
        );
        $links = array_merge( $settings_links, $links );
        return $links;
    }
}