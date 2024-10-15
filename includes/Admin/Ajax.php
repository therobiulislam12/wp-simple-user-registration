<?php

namespace UserRegistration\Admin;

class Ajax {
    public function __construct() {
        add_action( 'wp_ajax_simple_user_login', array( $this, 'sur_user_login_ajax' ) );
    }

    public function sur_user_login_ajax() {
        echo "something";

        exit;
    }
}