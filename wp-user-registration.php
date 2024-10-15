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

// add auto loader
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Create Simple User Registration final class
 */
final class Simple_User_Registration {

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
     * @return Simple_User_Registration
     *
     * @since 1.0.0
     */
    public static function getInstance() {
        if ( !self::$_instance ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Plugin constructor
     *
     * @since 1.0.0
     */
    private function __construct() {

        // call all constant
        $this->define_constant();

        // activation hook
        register_activation_hook( RI_USER_REGISTRATION_FILE, array( $this, 'sur_activation' ) );

        // after plugins loaded call this hook
        add_action( 'plugins_loaded', array( $this, 'sur_init_plugin' ) );

    }

    /**
     * After complete install
     * @return void
     */
    public function sur_init_plugin() {

        if ( is_admin() ) {
            new UserRegistration\Admin();
        } else {
            new UserRegistration\Frontend();
        }
    }

    /**
     * when active plugin call this class
     *
     * @return
     *
     * @since 1.0.0
     */
    public function sur_activation() {

    }

    /**
     * Create all constant for reuse
     *
     * @return void
     * @since 1.0.0
     */
    public function define_constant() {
        define( 'RI_USER_REGISTRATION_VERSION', self::VERSION );
        define( 'RI_USER_REGISTRATION_FILE', __FILE__ );
        define( 'RI_USER_REGISTRATION_PATH', plugin_dir_path( __FILE__ ) );
        define( 'RI_USER_REGISTRATION_URL', plugins_url( '', RI_USER_REGISTRATION_FILE ) );
        define( 'RI_USER_REGISTRATION_ASSETS_URL', RI_USER_REGISTRATION_URL . '/assets' );
    }

}

/**
 * Create function for class instance return
 * @return Simple_User_Registration
 *
 * @since 1.0.0
 */
function wp_simple_user_registration() {
    return Simple_User_Registration::getInstance();
}

// kick off the function
wp_simple_user_registration();
