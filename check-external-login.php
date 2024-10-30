<?php
/*
    Plugin Name: Check External Login
    Description: Allow to check if user is logged in another website
    Author: Vigicorp
    Version: 1.0
    Author URI: https://www.vigicorp.fr
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('CEL_DIR', plugin_dir_path(__FILE__));
define('CEL_VERSION', '1.0');

new CheckExternalLogin();

class CheckExternalLogin
{
    public function __construct()
    {
        add_action("admin_menu", [$this, 'adminMenu']);

        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    }

    public function adminMenu()
    {
        add_options_page(__('Check external login'), __('Check external login'), 'manage_options', 'check-external-login-settings', [$this, 'adminPage']);
    }

    public function adminPage()
    {
        require CEL_DIR.'includes/admin.php';
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('check-external-login-js', plugin_dir_url( __FILE__ ) . 'js/check-external-login.js', [], CEL_VERSION);

        wp_localize_script('check-external-login-js', 'celUrl', get_option('check_external_login_url'));
    }
}
