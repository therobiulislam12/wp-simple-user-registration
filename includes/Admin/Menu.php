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