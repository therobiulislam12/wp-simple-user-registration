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
        ob_start();
        require_once __DIR__ . '/views/login.views.php';
        return ob_get_clean();
    }
}