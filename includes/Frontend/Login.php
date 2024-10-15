<?php

namespace UserRegistration\Frontend;

/**
 * Handles the user login functionality for the front end.
 *
 * This class creates a shortcode for displaying a login form
 * and manages the login process for registered users.
 *
 * @since 1.0.0
 */
class Login {

    /**
     * Initializes the login functionality.
     *
     * Registers the `[ri-login-form]` shortcode, which renders the login form on the frontend.
     */
    public function __construct() {
        // create a login short code
        add_shortcode( 'ri-login-form', array( $this, 'sur_user_login' ) );

        // enqueue script
        add_action('wp_enqueue_scripts', array($this, 'sur_login_enqueue_scripts'));
    }


    public function sur_login_enqueue_scripts(){
        wp_register_script('sur-login-form', RI_USER_REGISTRATION_ASSETS_URL . '/js/login.js');
        wp_register_style('sur-login-form', RI_USER_REGISTRATION_ASSETS_URL . '/css/login.css');
    }

    /**
     * Renders the login form for the `[ri-login-form]` shortcode.
     *
     * This function captures the output of the login form HTML
     * by including the view file and returns it to be displayed
     * where the shortcode is used.
     *
     * @return string The HTML content of the login form.
     *
     * @since 1.0.0
     */
    public function sur_user_login() {
        wp_enqueue_script('sur-login-form');
        wp_enqueue_style('sur-login-form');
        ob_start();
        require_once __DIR__ . '/views/login.views.php';
        return ob_get_clean();
    }
}