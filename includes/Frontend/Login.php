<?php 

namespace UserRegistration\Frontend;

class Login{
    public function __construct(){
        // create a login short code
        add_shortcode('ri-login-form', array($this,'sur_user_login'));
    }

    public function sur_user_login(){
        echo 'Short Code working';
    }
}