<?php 

namespace UserRegistration\Admin;

class Menu{
    public function __construct(){
        add_action('admin_menu', array($this, 'sur_add_admin_page'));
    }

    public function sur_add_admin_page(){
        add_menu_page(
            __('User Registration', 'ri-simple-user-registration'),
            __('User Registration', 'ri-simple-user-registration'),
            'manage_options',
            'ri-simple-user-registration',
            array($this, 'sur_user_registration_callback'),
            'dashicons-list-view',
            2
        );
    }


    public function sur_user_registration_callback(){
        echo '<div class="wrap"><h1>I am Working</h1></div>';
    }
}