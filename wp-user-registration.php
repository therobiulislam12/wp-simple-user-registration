<?php

/**
 * Plugin Name:       Simple User Registration
 * Description:       Simple user registration with custom login page
 * Plugin URI:        https://robiul.net/simple-user-registration
 * Version:           1.0.0
 * Author:            Robiul Islam
 * Author URI:        https://robiul.net/about
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages
 * Text Domain:      ri-simple-user-registration
 */


if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Create Simple User Registration final class
 */
final class WP_User_Registration{

    /**
     * Plugin Version
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    const VERSION = "1.0.0";

    /**
     * Create $_instance
     * 
     * @since 1.0.0
     */
    public static $_instance = null;

    /**
     * Create class instance
     * @return WP_User_Registration
     * 
     * @since 1.0.0
     */
    public static function getInstance(){
        if(! self::$_instance){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

}

/**
 * Create function for class instance return
 * @return WP_User_Registration
 * 
 * @since 1.0.0
 */
function wp_simple_user_registration(){
    return WP_User_Registration::getInstance();
}

// kick off the function
wp_simple_user_registration();


