<?php

namespace UserRegistration\Admin;

class Ajax {
    public function __construct() {
        add_action( 'wp_ajax_simple_user_login', array( $this, 'sur_user_login_ajax' ) );
        add_action( 'wp_ajax_nopriv_simple_user_login', array( $this, 'sur_user_login_ajax' ) );
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
            wp_send_json($user->get_error_message(), 403);
        }

        wp_send_json( ['redirect_url' => home_url('dashboard')], 200 );

    }
}