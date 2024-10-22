<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuration array for custom post types and taxonomies.
 *
 * @return array The configuration for post types and taxonomies.
 */
function cpt_manager_get_config() {
    return [
        'post_types' => [
            'faq' => [
                'labels' => cpt_manager_get_labels('FAQ', 'FAQs'),
                'supports' => ['title', 'editor', 'custom-fields'],
                'public' => true,
                'has_archive' => true,
                'rewrite' => ['slug' => 'faqs'],
                'hierarchical' => false,
                'show_in_rest' => true, // Enable REST API support
            ],
            'service' => [
                'labels' => cpt_manager_get_labels('Service', 'Services'),
                'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
                'public' => true,
                'has_archive' => true,
                'rewrite' => ['slug' => 'services'],
                'show_in_rest' => true, // Enable REST API support
            ],
            'boiler' => [
                'labels' => cpt_manager_get_labels('Boiler', 'Boilers'),
                'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
                'public' => true,
                'has_archive' => true,
                'rewrite' => ['slug' => 'boilers'],
                'show_in_rest' => true, // Enable REST API support
            ],
            'whymeraboiler' => [
                'labels' => cpt_manager_get_labels('Why Meraboiler', 'Why Choose Meraboiler'),
                'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
                'public' => true,
                'has_archive' => false,
                'menu_icon' => 'dashicons-star-filled',
                'show_in_rest' => true, // Enable REST API support
            ],
        ],
        'taxonomies' => [
            'faq_category' => [
                'post_type' => 'faq',
                'labels' => cpt_manager_get_labels('FAQ Category', 'FAQ Categories'),
                'args' => [
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'rewrite' => ['slug' => 'faq-category'],
                    'show_in_rest' => true, // Enable REST API support
                ],
            ],
        ],
    ];
}
