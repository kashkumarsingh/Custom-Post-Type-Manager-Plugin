<?php
/**
 * Plugin Name: Custom Post Types Manager
 * Description: A plugin to register custom post types and taxonomies for any theme.
 * Version: 1.0
 * Author: Kashkumar Singh
 * Author URI: https://yourwebsite.com
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define constants for the plugin.
 */
define('CPT_MANAGER_VERSION', '1.0');
define('CPT_MANAGER_TEXT_DOMAIN', 'cpt-manager');

/**
 * Include the CPT Manager logic file.
 */
require_once plugin_dir_path(__FILE__) . 'includes/cpt-manager.php';
require_once plugin_dir_path(__FILE__) . 'includes/cpt-config.php';


/**
 * Initialize the plugin.
 */
function cpt_manager_init() {
    cpt_manager_register_post_types();
    cpt_manager_register_taxonomies();
}

// Hook into the 'init' action to register post types and taxonomies
add_action('init', 'cpt_manager_init');
