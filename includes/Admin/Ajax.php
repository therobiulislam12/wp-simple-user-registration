<?php

namespace UserRegistration\Admin;

class Ajax {
    public function __construct() {
        add_action( 'wp_ajax_simple_user_login', array( $this, 'sur_user_login_ajax' ) );
        add_action( 'wp_ajax_nopriv_simple_user_login', array( $this, 'sur_user_login_ajax' ) );

        add_action( 'wp_ajax_simple_user_registration', array( $this, 'sur_user_registration_ajax' ) );
        add_action( 'wp_ajax_nopriv_simple_user_registration', array( $this, 'sur_user_registration_ajax' ) );
    }

    public function sur_user_login_ajax() {
        check_ajax_referer( 'simple-user-login' );

        $username = isset( $_POST['username'] ) && !empty( $_POST['username'] ) ? wp_unslash( $_POST['username'] ) : '';
        $password = isset( $_POST['password'] ) && !empty( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';

        $credentials = [
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => false,
        ];

        $user = wp_signon( $credentials, false );

        if ( is_wp_error( $user ) ) {
            wp_send_json( $user->get_error_message(), 403 );
        }

        // redirect and message send
        $message = 'User created and logged in';
        $slug = get_option('sur_redirect_page_slug') ? home_url(get_option('sur_redirect_page_slug')) : admin_url();
        wp_send_json( ['redirect_url' => $slug, 'message' => $message], 200 );
    }

    public function sur_user_registration_ajax() {
        check_ajax_referer( 'simple-user-registration' );
    
        $first_name = isset( $_POST['first_name'] ) && !empty( $_POST['first_name'] ) ? wp_unslash( $_POST['first_name'] ) : '';
        $last_name = isset( $_POST['last_name'] ) && !empty( $_POST['last_name'] ) ? wp_unslash( $_POST['last_name'] ) : '';
        $username = isset( $_POST['username'] ) && !empty( $_POST['username'] ) ? wp_unslash( $_POST['username'] ) : '';
        $email = isset( $_POST['email'] ) && !empty( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
        $password = isset( $_POST['password'] ) && !empty( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
        $confirm_password = isset( $_POST['confirm_password'] ) && !empty( $_POST['confirm_password'] ) ? sanitize_text_field( $_POST['confirm_password'] ) : '';
    
        $user_id = username_exists( $username );
        $message = "";
    
        // Check if passwords match
        if ( $password !== $confirm_password ) {
            wp_send_json( ['message' => 'Passwords do not match'], 400 );
        }
    
        // Check if username or email exists
        if ( !$user_id && false == email_exists( $email ) ) {
            // Create the user
            $user_id = wp_create_user($username, $password, $email);
    
            if ( !is_wp_error( $user_id ) ) {

                // update meta data for this user
                wp_update_user([
                    'ID' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name
                ]);

                // Automatically log in user
                $credentials = [
                    'user_login'    => $username,
                    'user_password' => $password,
                    'remember'      => true,
                ];
    
                $user = wp_signon( $credentials, false );
    
                if ( is_wp_error( $user ) ) {
                    wp_send_json( ['message' => $user->get_error_message()], 403 );
                }
    
                // redirect and message send
                $message = 'User created and logged in';
                $slug = get_option('sur_redirect_page_slug') ? home_url(get_option('sur_redirect_page_slug')) : admin_url();
                wp_send_json( ['redirect_url' => $slug, 'message' => $message], 200 );
            } else {
                wp_send_json( ['message' => $user_id->get_error_message()], 400 );
            }
        } else {
            $message = 'User already exists';
            wp_send_json( ['message' => $message], 400 );
        }
    }
    
}