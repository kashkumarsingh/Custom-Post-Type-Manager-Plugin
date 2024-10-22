<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Helper function to create labels for post types and taxonomies.
 *
 * @param string $singular Singular name.
 * @param string $plural   Plural name.
 * @return array The labels array.
 */
function cpt_manager_get_labels($singular, $plural) {
    return [
        'name'                  => __($plural, CPT_MANAGER_TEXT_DOMAIN),
        'singular_name'         => __($singular, CPT_MANAGER_TEXT_DOMAIN),
        'add_new_item'          => __('Add New ' . $singular, CPT_MANAGER_TEXT_DOMAIN),
        'edit_item'             => __('Edit ' . $singular, CPT_MANAGER_TEXT_DOMAIN),
        'new_item'              => __('New ' . $singular, CPT_MANAGER_TEXT_DOMAIN),
        'view_item'             => __('View ' . $singular, CPT_MANAGER_TEXT_DOMAIN),
        'search_items'          => __('Search ' . $plural, CPT_MANAGER_TEXT_DOMAIN),
        'not_found'             => __('No ' . strtolower($plural) . ' found', CPT_MANAGER_TEXT_DOMAIN),
        'not_found_in_trash'    => __('No ' . strtolower($plural) . ' found in Trash', CPT_MANAGER_TEXT_DOMAIN),
    ];
}

/**
 * Register custom post types based on the configuration.
 */
function cpt_manager_register_post_types() {
    $config = cpt_manager_get_config(); // Now imported from the config file

    foreach ($config['post_types'] as $post_type => $args) {
        register_post_type($post_type, $args);
    }
}

/**
 * Register custom taxonomies based on the configuration.
 */
function cpt_manager_register_taxonomies() {
    $config = cpt_manager_get_config(); // Now imported from the config file

    foreach ($config['taxonomies'] as $taxonomy => $data) {
        register_taxonomy($taxonomy, $data['post_type'], $data['args']);
    }
}
